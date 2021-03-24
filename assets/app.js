/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

import EasyMDE from 'easymde';

import marked from 'marked';

var markdown_editor = document.getElementById("markdown-editor");
if(markdown_editor){
    var mk = new EasyMDE({
        element: markdown_editor,
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
    mk.toggleSideBySide();
}

if(window.location.pathname === "/upload" ) {
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

    document.addEventListener('DOMContentLoaded', function() {
        var data = $('.saved-template').data('isTemplate');
    });


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

    var scrapper = document.getElementById("upload-scrapper");
    var type =  scrapper.options[scrapper.selectedIndex].value;
    scrapper.addEventListener('click', function (){
       type = this.options[this.selectedIndex].value;
    });
    var scrapper_url = "/api/scrapper/" + type + "?url=";
    console.log(scrapper_url);

    var get_content = document.getElementById("content-url-button");

    get_content.addEventListener('click', function (){
        $.ajax({
            url: scrapper_url + document.getElementById("input-content-url").value,
            type: 'get',
            dataType: 'html',
            async: false,
            cache: false,
            success: function (data){
                var content = JSON.parse(data)['content_info'];
                contentInfo.value(content.substring(1));
                document.getElementById("image-from-scrapper").src = JSON.parse(data)['image'];
                document.getElementById("image_url").value = JSON.parse(data)['image'];
                document.getElementById("image-from-scrapper-content").classList.remove("d-none");
            }
        })
    });
    var uploadContent = document.getElementById("upload-content");
    var previewContent = document.getElementById("preview-content");
    var preview = document.getElementById("preview_btn");

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
        var previewImage = document.getElementById("preview-image");

        var previewShowMediaInfoBlock = document.getElementById("show-media-info-block");
        var previewNoMediaInfoBlock = document.getElementById("no-media-info-block");

        previewTorrentName.innerHTML = uploadTorrentName.value;
        previewReleaseInfo.innerHTML = marked(releaseDetails.value());
        previewContentInfo.innerHTML = marked(contentInfo.value());
        previewImage.src = document.getElementById("image-from-scrapper").src;
        formdata.set("preview", true);
        formdata.set("torrent_name", "hey");
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
}

