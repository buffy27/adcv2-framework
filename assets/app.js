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

if(window.location.pathname === "/upload") {

    var contentInfo = new EasyMDE({
        element: document.getElementById("content-info-markdown-editor"),
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

    var releaseDetails = new EasyMDE({
        element: document.getElementById("upload_form_release_details"),
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
    var rs = document.getElementById("release-details-markdown-editor");
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
    var scrapper_url = "/api/scrapper/" + scrapper.value + "?url=";
    var get_content = document.getElementById("content-url-button");

    get_content.addEventListener('click', function (){
        console.log(document.getElementById("input-content-url").value);
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
}
if(window.location.pathname === "/upload/preview") {
    document.getElementById("pm-parsed-message").innerHTML = marked(document.getElementById("pm-parsed-message").innerHTML);
    document.getElementById("content-movie-parsed-message").innerHTML = marked(document.getElementById("content-movie-parsed-message").innerHTML);
}

