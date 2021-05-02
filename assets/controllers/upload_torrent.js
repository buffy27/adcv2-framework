import EasyMDE from 'easymde';

import marked from 'marked';

let formdata = new FormData();
formdata.append("preview", true);
$('#upload_form_torrent_file').change(function () {
    if (formdata.has("upload_form[torrent_file]")) {
        formdata.delete("upload_form[torrent_file]");
    }
    if ($(this).prop('files').length > 0) {
        var file = $(this).prop('files')[0];
        formdata.append("upload_form[torrent_file]", file);
    }
});
var contentInfo = new EasyMDE({
    element: document.getElementById("upload_form_content_info"),
    promptURLs: true,
    tabSize: 4,
    spellChecker: true,
    nativeSpellcheck: true,
    sideBySideFullscreen: false,
    maxHeight: '200px',
    toolbar: [
        "bold", "italic", "strikethrough", "|",
        "code", "quote", "|",
        "ordered-list", "unordered-list", "|",
        "link", "image", "|",
        "horizontal-rule", "clean-block", "|",
        "side-by-side"
    ]
});
contentInfo.toggleSideBySide();
var rs_textarea = document.getElementById("upload_form_release_details");
var releaseDetails = new EasyMDE({
    element: rs_textarea,
    promptURLs: true,
    tabSize: 4,
    spellChecker: true,
    nativeSpellcheck: true,
    sideBySideFullscreen: false,
    inputStyle: "textarea",
    maxHeight: '300px',
    toolbar: [
        "bold", "italic", "strikethrough", "|",
        "code", "quote", "|",
        "ordered-list", "unordered-list", "|",
        "link", "image", "|",
        "horizontal-rule", "clean-block", "|",
        "side-by-side"
    ]
});
releaseDetails.toggleSideBySide();

console.log(releaseDetails);

var mi_textarea = document.getElementById("upload_form_mediainfo");
var mediainfo = new EasyMDE({
    element: mi_textarea,
    promptURLs: true,
    tabSize: 4,
    spellChecker: true,
    nativeSpellcheck: true,
    sideBySideFullscreen: false,
    inputStyle: "textarea",
    maxHeight: '300px',
    toolbar: [
        "bold", "italic", "strikethrough", "|",
        "code", "quote", "|",
        "ordered-list", "unordered-list", "|",
        "link", "image", "|",
        "horizontal-rule", "clean-block", "|",
        "side-by-side"
    ]
});
mediainfo.toggleSideBySide();

var template = null;
$.ajax(
    {
        url: "/api/template",
        type: 'get',
        dataType: 'html',
        async: false,
        cache: false,
        success: function (data) {
            template = JSON.parse(data);
        }
    });
var radiobtn = document.upload_form.template_radio;

releaseDetails.value(template['dvd_template'])
radiobtn[0].addEventListener('change', function (){
    releaseDetails.value(template['dvd_template']);
})
radiobtn[1].addEventListener('change', function (){
    releaseDetails.value(template['bdmv_template']);
})
radiobtn[2].addEventListener('change', function (){
    releaseDetails.value(template['uhd_template']);
})

var get_content = document.getElementById("content-url-button");

get_content.addEventListener('click', function (){
    var scrapper = document.getElementById("upload-scrapper");
    var scrapper_url = "/api/scrapper/" + scrapper.options[scrapper.selectedIndex].value + "?url=";

    $.ajax({
        url: encodeURI(scrapper_url + document.getElementById("upload_form_content_url").value),
        type: 'get',
        dataType: 'html',
        async: false,
        cache: false,
        success: function (data){
            var content = JSON.parse(data)['content_info'];
            contentInfo.value(content.substring(1));
            document.getElementById("image-from-scrapper").src = JSON.parse(data)['image'];
            document.getElementById("upload_form_content_poster").value = JSON.parse(data)['image'];
            document.getElementById("image-from-scrapper-content").classList.remove("d-none");
        }
    })
});
const uploadContent = document.getElementById("upload-content");
const previewContent = document.getElementById("preview-content");
const preview = document.getElementById("preview_btn");

preview.addEventListener('click', function (){
    uploadContent.classList.add("d-none");
    previewContent.classList.remove("d-none");

    var uploadTorrentName = document.querySelector("input[name='upload_form[torrent_name]']");
    var previewTorrentSize = document.getElementById("preview-torrent-size");
    var previewTorrentName = document.getElementById("preview-torrent-name");
    var previewTorrentInfohash = document.getElementById("preview-info-hash");
    var previewTorrentFiles = document.getElementById("preview-torrent-files");
    var previewContentInfo = document.getElementById("content-parsed-message");
    var previewReleaseInfo = document.getElementById("release-details");
    var previewMediainfo = document.getElementById("adc-torrent-mediainfo");
    var previewImage = document.getElementById("preview-image");

    var previewShowMediaInfoBlock = document.getElementById("show-media-info-block");
    var previewNoMediaInfoBlock = document.getElementById("no-media-info-block");

    previewTorrentName.innerHTML = uploadTorrentName.value;
    previewReleaseInfo.innerHTML = marked(releaseDetails.value());
    previewContentInfo.innerHTML = marked(contentInfo.value());
    previewImage.src = document.getElementById("image-from-scrapper").src;

    previewMediainfo.addEventListener('click', function (){
        var innerDiv = $('<pre class="m-0 pre-wrap"></pre>').html(marked(mediainfo.value()));
        var modal = $('.modal');
        modal.addClass('modal-sm');

        $('#simple-adc-modal-header').html('Media Info');
        $('#simple-adc-modal .modal-body').html(innerDiv[0].outerHTML);
        $("#simple-adc-modal").modal('show');
    })

    formdata.set("preview", true);
    $.ajax({
        url: "/upload",
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (result) {
            try {
                result = JSON.parse(result);
            } catch {}
            previewTorrentName.innerHTML = result['name'];
            previewTorrentSize.innerHTML = result['size'];
            previewTorrentInfohash.innerHTML = result['files']['info_hash'];
            previewTorrentFiles.innerHTML = result['files']['total'];
        }
    });
});

var upload_return = document.getElementById("upload_return");
upload_return.addEventListener('click',function (){
    uploadContent.classList.remove("d-none");
    previewContent.classList.add("d-none");
});