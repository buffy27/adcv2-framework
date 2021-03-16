(function (document, window) {
    let lastUploadEasyMDE = null;
    let lastUploadTemplateEasyMDE = null;
    let formdata = new FormData();
    formdata.append("preview", true);

    $(document).ready(function () {

        const source = document.getElementById("image_url");
        const result = document.getElementById("image-from-scrapper");

        const inputHandler = function(e) {
            result.src = e.target.value;
        };

        source.addEventListener("input", inputHandler);

        const uploadFormatTypeElem = document.getElementById("upload-format-type");
        const contentUrlButtonElem = document.getElementById("content-url-button");

        uploadFormatTypeElem.addEventListener("change", () => getContentTemplate(uploadFormatTypeElem));
        contentUrlButtonElem.addEventListener("click", () => getContentInfo());

        getContentTemplate(uploadFormatTypeElem);
        getDescriptionTemplate($("input[name=optradio]:checked").val());

        $('#torrent').change(function () {
            if (formdata.has("torrent_file")) {
                formdata.delete("torrent_file");
            }
            if ($(this).prop('files').length > 0) {
                file = $(this).prop('files')[0];
                formdata.append("torrent_file", file);
            }
        });
    });

    function togglePreviewTorrent(mediaInfoMDE) {
        var uploadContent = document.getElementById("upload-content");
        var previewContent = document.getElementById("preview-content");
        var imageFromScrapper = document.getElementById("image-from-scrapper");

        var uploadTorrentName = document.querySelector("input[name=torrent_name]");
        var previewTorrentName = document.getElementById("preview-torrent-name");
        var previewContentInfo = document.getElementById("content-movie-markdown-message");
        var previewReleaseInfo = document.getElementById("desc-markdown-message");
        var previewImage = document.getElementById("preview-image");
        var previewShowMediaInfoBlock = document.getElementById("show-media-info-block");
        var previewNoMediaInfoBlock = document.getElementById("no-media-info-block");

        if (uploadContent.classList.contains("d-none")) {
            uploadContent.classList.remove("d-none");
            previewContent.classList.add("d-none");
        } else {
            formdata.set("preview", true);
            $.ajax({
                url: '/upload',
                type: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                success: function (result) {
                    try {
                        result = JSON.parse(result);
                    } catch {}

                    console.log(result);

                    document.getElementById("preview-info-hash").innerHTML = result['info_hash'];
                    document.getElementById("preview-torrent-size").innerHTML = result['formated_size'];
                    document.getElementById("preview-torrent-files").innerHTML = result['numfiles'];
                    previewTorrentName.innerHTML = uploadTorrentName.value || result['name'] || "No Name";
                }
            });

            uploadContent.classList.add("d-none");
            previewContent.classList.remove("d-none");

            previewTorrentName.innerHTML = uploadTorrentName.value || "No Name";
            previewContentInfo.innerHTML = lastUploadEasyMDE.value() || document.getElementById("content-info-markdown-editor").value;
            previewReleaseInfo.innerHTML = lastUploadTemplateEasyMDE.value() || '---';
            previewImage.src = imageFromScrapper.src;

            if ((mediaInfoMDE.value() || "").trim() == "") {
                previewShowMediaInfoBlock.classList.add("d-none");
                previewNoMediaInfoBlock.classList.remove("d-none");
            } else {
                previewShowMediaInfoBlock.classList.remove("d-none");
                previewNoMediaInfoBlock.classList.add("d-none");

                document.getElementById("adc-torrent-mediainfo").innerHTML = mediaInfoMDE.value();
            }

            parseMarkdown("#content-movie-markdown-message", "#content-movie-parsed-message");
            parseMarkdown("#desc-markdown-message", "#pm-parsed-message");
        }
    }

    function getContentTemplate(element) {
        const contentInfoElem = document.getElementById("upload-content-info");
        const contentUrlElem = document.getElementById("content-url");
        const uploadFormatElem = document.getElementById("upload-format");

        contentInfoElem.showElement();
        contentUrlElem.showElement();
        uploadFormatElem.showElement();

        const text = element.options[element.selectedIndex].text;
        const contentUrlInputElem = document.getElementById("input-content-url").value;

        if (contentUrlInputElem != null) {
            contentUrlInputElem.value = "";
        }
        $.ajax({
            data: {
                "type": text
            },
            success: (data) => {
                console.log(data);
                data = JSON.parse(data);

                document.getElementById("content_name").innerHTML = data['content_name'];
                document.getElementById("content_small_text").innerHTML = data['content_small_text'];

                const contentInfoTextArea = document.getElementById("content-info-markdown-editor");
                if (lastUploadEasyMDE != null) {
                    lastUploadEasyMDE.toTextArea();
                }
                contentInfoTextArea.value = data['content_info'];

                lastUploadEasyMDE = window.loadEasyMde(contentInfoTextArea, 200);
            }
        });
    }
    function getContentInfo() {
        const formatTypeElem = document.getElementById("upload-format-type");
        const text = formatTypeElem.options[formatTypeElem.selectedIndex].value;
        const contentUrl = document.getElementById("input-content-url").value;

        if (text === "movie" || text === "anime") {
            showLoadingOverlay();
            try {
                $.ajax({
                    data: {
                        "type": text,
                        "scrp": "okey",
                        "content_url": contentUrl
                    },
                    success: (data) => {
                        if (lastUploadEasyMDE != null) {
                            lastUploadEasyMDE.toTextArea();
                        }
                        const contentInfoTextArea = document.getElementById("content-info-markdown-editor");
                        const parsedJSON = JSON.parse(data);
                        const imageFromScrapperElem = document.getElementById("image-from-scrapper");
                        const contentImageFromScrapperElem = document.getElementById("image-from-scrapper-content");

                        if (parsedJSON['image'] != null && parsedJSON['image'].trim() !== '') {
                            imageFromScrapperElem.src = parsedJSON['image'];
                            var image_url = document.getElementById("image_url");
                            image_url.value = parsedJSON['image'];
                            //image_url.classList.add("d-none");
                            contentImageFromScrapperElem.showElement();
                        } else {
                            contentImageFromScrapperElem.hideElement();
                        }

                        contentInfoTextArea.value = parsedJSON['content_info'];
                        lastUploadEasyMDE = window.loadEasyMde(contentInfoTextArea, 200);
                    },
                    // called after "error" and "success"
                    complete: () => {
                        hideLoadingOverlay();
                    }
                });
            } catch {
                hideLoadingOverlay();
            }
        }
    }

    function getDescriptionTemplate(select) {
        var desc_dvd = document.getElementById("desc_dvd");
        var desc_bdmv = document.getElementById("desc_bdmv");
        var desc_soundtrack = document.getElementById("desc_uhd");

        if (lastUploadTemplateEasyMDE != null) {
            lastUploadTemplateEasyMDE.toTextArea();
        }

        switch (select.value || select) {
            case "dvd":
                desc_dvd.classList.remove("d-none");
                desc_bdmv.classList.add("d-none");
                desc_soundtrack.classList.add("d-none");

                lastUploadTemplateEasyMDE = window.loadEasyMde('#template_dvd', 300);
                break;
            case "bdmv":
                desc_dvd.classList.add("d-none");
                desc_bdmv.classList.remove("d-none");
                desc_soundtrack.classList.add("d-none");

                lastUploadTemplateEasyMDE = window.loadEasyMde('#template_bdmv', 300);
                break;
            case "uhd":
                desc_dvd.classList.add("d-none");
                desc_bdmv.classList.add("d-none");
                desc_soundtrack.classList.remove("d-none");

                lastUploadTemplateEasyMDE = window.loadEasyMde('#template_uhd', 300);
                break;
        }
    }

    window.getDescriptionTemplate = getDescriptionTemplate;
    window.togglePreviewTorrent = togglePreviewTorrent;
})(document, window);
