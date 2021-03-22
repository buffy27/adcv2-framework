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
    element: document.getElementById("release-details-markdown-editor"),
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
        success: function(data)
        {
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


