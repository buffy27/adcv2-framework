import EasyMDE from 'easymde';
import jquery from 'jquery';
import '../jquery.modal.min';

var markdown_editor = document.getElementsByTagName("textarea");

var quick_comment = new EasyMDE({
    element: markdown_editor[0],
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
        "side-by-side"
    ]
});

quick_comment.toggleSideBySide();

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