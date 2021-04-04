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

import jquery from 'jquery';

import './jquery.modal.min';


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
console.log(mk)
console.log("hello");
const modal_data = document.getElementById("modal-data");
const modal_view = document.getElementById("modal-view");
if(modal_view) {
    modal_view.addEventListener('click', function () {
        var innerDiv = $('<pre class="m-0 pre-wrap"></pre>').html(marked(modal_data.innerHTML));
        var modal = $('.modal');
        modal.addClass('modal-sm');
        $('#simple-adc-modal-header').html('Media Info');
        $('#simple-adc-modal .modal-body').html(innerDiv[0].outerHTML);
        $("#simple-adc-modal").modal('show');
    });
}

const modal_data_peers = document.getElementById("peers-list");
const modal_view_peers = document.getElementById("adc-peers-list-view");
if(modal_view_peers) {
    modal_view_peers.addEventListener('click', function () {

        var innerDiv = $('<pre class="m-0 pre-wrap"></pre>').html(modal_data_peers.innerHTML);
        var modal = $('.modal');
        modal.addClass('modal-sm');
        $('#simple-adc-modal-header').html('Peers');
        $('#simple-adc-modal .modal-body').html(innerDiv[0].outerHTML);
        $("#simple-adc-modal").modal('show');
    });
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
}

