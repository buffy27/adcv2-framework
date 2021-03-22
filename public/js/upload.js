HTMLElement.prototype.showElement = function () {
    this.classList.remove("d-none");
}

$(document).ready(function(){
    /*
    CKEDITOR.addCss(".cke_editable{cursor:text; font-size: 10px; font-family: Arial, sans-serif;}");
    CKEDITOR.addCss(".cke_wysiwyg_frame, .cke_wysiwyg_div background-color: #FFFFFF;");
    CKEDITOR.replace( 'content', {
        fullPage: true,
        extraPlugins: 'font,panelbutton,colorbutton,colordialog,justify,indentblock,aparat,buyLink',
        // You may want to disable content filtering because if you use full page mode, you probably
        // want to  freely enter any HTML content in source mode without any limitations.
        allowedContent: true,
        autoGrow_onStartup: true,
        enterMode: CKEDITOR.ENTER_BR
    } );
    CKEDITOR.editorConfig = function( config ) {
        // Define changes to default configuration here.
        // For complete reference see:
        // http://docs.ckeditor.com/#!/api/CKEDITOR.config

        // The toolbar groups arrangement, optimized for two toolbar rows.
        config.toolbarGroups = [
            // { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
            // { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
            // { name: 'links' },
            // { name: 'insert' },
            // { name: 'forms' },
            { name: 'tools' },
            // { name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },

            // '/',
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            // { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
            { name: 'styles' },
            { name: 'others' }
            // { name: 'colors' },
            // { name: 'about' }
        ];

        // Remove some buttons provided by the standard plugins, which are
        // not needed in the Standard(s) toolbar.
        config.removeButtons = 'Underline,Subscript,Superscript';
        config.extraPlugins = 'markdown';  // this is the point!
        // Set the most common block elements.
        config.format_tags = 'p;h1;h2;h3;pre';

        // Simplify the dialog windows.
        config.removeDialogTabs = 'image:advanced;link:advanced';
    };
*/
    const contentUrlButtonElem = document.getElementById("content-url-button");
    contentUrlButtonElem.addEventListener("click", () => getContentInfo());

    var test = document.getElementById("upload_form_release_details");
    $.getJSON('/api/template', function (data){
        test.value = data['dvd_template'].replace(/(?:\r\n|\r|\n)/g, '<br>');
    })
});
    function showTorrentFiles(event, url, size) {
        event.preventDefault();

        setModalSize(size);

        var adcFileList = document.querySelector('#adc-files-list');
        if (adcFileList != null) {
            $.ajax({
                url: url,
                success: function (result) {
                    $("#adc-files-list").html(result);
                    showTorrentFilesPopup(adcFileList);
                }
            });
        } else {
            showTorrentFilesPopup(adcFileList);
        }
    }

    function showTorrentFilesPopup(adcFileList) {
        var innerDiv = $('<div class="inner-div"></div>').html(adcFileList.innerHTML);

        $('#simple-adc-modal-header').html('Torrent Files');

        $('#simple-adc-modal .modal-body').html(innerDiv[0].outerHTML);
        $('#simple-adc-modal .modal-body .inner-div').fancytree();

        $("#simple-adc-modal").modal();
    }
    function setModalSize(size) {
        if (size != 'sm' && size != 'md' && size != 'lg') {
            size = 'md';
        }
        var modal = $('.modal');
        modal.removeClass('modal-sm');
        modal.removeClass('modal-md');
        modal.removeClass('modal-lg');

        modal.addClass('modal-' + size);
    }
    function getDescriptionTemplate(value){
    var test = document.getElementById("upload_form_release_details");
    test.value = "hello what's up";
    console.log(test);
    /*
        $.getJSON("/api/template", function(data, status){

            if(value.id == "upload-format-dvd"){
                console.log(document.getElementById("upload_form_release_details"));
                document.getElementById("upload_form_release_details").value = data['dvd_template'];
            }
        });
*/
    }

    function getContentInfo(){
        const formatTypeElem = document.getElementById("upload-format-type");
        const text = formatTypeElem.options[formatTypeElem.selectedIndex].value;
        const content_textarea = document.getElementById("upload_form_content_info");
        $url = document.getElementById("input-content-url").value
        const contentImageFromScrapperElem = document.getElementById("image-from-scrapper-content");
        $.ajax({
            dataType: "json",
            url: "/api/scrapper/" + text + "?url=" + $url,
            success: (data) => {
                CKEDITOR.instances['upload_form_content_info'].setData(data['content_info']);

                var image_url = document.getElementById("image-from-scrapper");
                var image_url_input = document.getElementById("image_url");
                image_url.src = data['image'];
                image_url_input.value = data['image'];

                contentImageFromScrapperElem.showElement();
            }
        });
    }

