
HTMLElement.prototype.hideElement = function () {
    this.classList.add("d-none");
};
HTMLElement.prototype.showElement = function () {
    this.classList.remove("d-none");
}

let loadingOverlayElement = null;

function getLoadingOverlay() {
    return document.getElementById("loading-overlay");
}

function showLoadingOverlay() {
    if (loadingOverlayElement == null) {
        loadingOverlayElement = getLoadingOverlay();
    }
    loadingOverlayElement.showElement();
}

function hideLoadingOverlay() {
    if (loadingOverlayElement == null) {
        loadingOverlayElement = getLoadingOverlay();
    }
    loadingOverlayElement.hideElement();
}

function getTorrentList(status) {
    switch (status) {
        case "uploaded":
            var up = document.getElementById("uploaded_torrents");
            if(up.classList.contains("d-none")){
                up.classList.remove("d-none");
                if( $('#uploaded_torrents_table').is(':empty') ) {
                    $.get({
                        url: window.location.href,
                        data: "uploaded_torrents=1",
                        success: function (data) {
                            data = JSON.parse(data);
                            document.getElementById("uploaded_torrents_table").innerHTML = data.table;
                            document.getElementById("uploaded_torrents_total").innerHTML = data.total;
                        }
                    });
                }
            }else{
                up.classList.add("d-none");
            }
            break;
        case "seeding":
            var up = document.getElementById("seeding_torrents");
            if(up.classList.contains("d-none")){
                up.classList.remove("d-none");
                if( $('#seeding_torrents_table').is(':empty') ) {
                    $.get({
                        url: window.location.href,
                        data: "seeding_torrents=1",
                        success: function (data) {
                            data = JSON.parse(data);
                            document.getElementById("seeding_torrents_table").innerHTML = data.table;
                            document.getElementById("seeding_torrents_total").innerHTML = data.total;
                        }
                    });
                }
            }else{
                up.classList.add("d-none");
            }
            break;
        case "leeching":
            var up = document.getElementById("leeching_torrents");
            if(up.classList.contains("d-none")){
                up.classList.remove("d-none");
                if( $('#leeching_torrents_table').is(':empty') ) {
                    $.get({
                        url: window.location.href,
                        data: "leeching_torrents=1",
                        success: function (data) {
                            data = JSON.parse(data);
                            document.getElementById("leeching_torrents_table").innerHTML = data.table;
                            document.getElementById("leeching_torrents_total").innerHTML = data.total;
                        }
                    });
                }
            }else{
                up.classList.add("d-none");
            }
            break;
        case "completed":
            var up = document.getElementById("completed_torrents");
            if(up.classList.contains("d-none")){
                up.classList.remove("d-none");
                if( $('#completed_torrents_table').is(':empty') ) {
                    $.get({
                        url: window.location.href,
                        data: "completed_torrents=1",
                        success: function (data) {
                            data = JSON.parse(data);
                            document.getElementById("completed_torrents_table").innerHTML = data.table;
                            document.getElementById("completed_torrents_total").innerHTML = data.total;
                        }
                    });
                }
            }else{
                up.classList.add("d-none");
            }
            break;
        case "incompleted":
            var up = document.getElementById("incompleted_torrents");
            if(up.classList.contains("d-none")){
                up.classList.remove("d-none");
                if( $('#incompleted_torrents_table').is(':empty') ) {
                    $.get({
                        url: window.location.href,
                        data: "incompleted_torrents=1",
                        success: function (data) {
                            data = JSON.parse(data);
                            document.getElementById("incompleted_torrents_table").innerHTML = data.table;
                            document.getElementById("incompleted_torrents_total").innerHTML = data.total;
                        }
                    });
                }
            }else{
                up.classList.add("d-none");
            }
            break;
    }
}

function exchangeBonusPointsForInvite() {
    $.get({
        url: '/profile/view?invite_price=1',
        success: function (result) {
            if (isNaN(+result)) {
                alert(result);
                return;
            }
            var result = confirm(result + ' bonus points will be deducted, would you like to proceed?');
            if (!result) {
                return;
            }
            $.post({
                url: '/profile/view',
                data: {
                    redeem_invite: true
                },
                success: function (result) {
                    if (isNaN(+result)) {
                        alert(result);
                        return;
                    }
                    window.location.reload();
                }
            });
        }
    })
}

function exchangeBonusPointsForGolden() {
    var inputTorrentId = document.getElementById("golden-torrent-id");
    var torrentId = inputTorrentId.value;

    $.get({
        url: '/profile/view?gold_price=1&tid=' + torrentId,
        success: function (result) {
            if (isNaN(+result)) {
                alert(result);
                return;
            }
            var result = confirm(result + ' bonus points will be deducted, would you like to proceed?');
            if (!result) {
                return;
            }
            $.post({
                url: '/profile/view',
                data: {
                    redeem_gold: true,
                    tid: torrentId
                },
                success: function (result) {
                    if (isNaN(+result)) {
                        alert(result);
                        return;
                    }
                    window.location.reload();
                }
            });
        }
    })
}

function showTorrentFiles(event, url, size) {
    event.preventDefault();

    setModalSize(size);

    var adcFileList = document.querySelector('#adc-files-list');
    if (adcFileList.innerHTML == '') {
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

function showMediaInfo(event, size) {
    event.preventDefault();

    setModalSize(size);

    var adcFileList = document.querySelector('#adc-torrent-mediainfo');
    var innerDiv = $('<pre class="m-0 pre-wrap"></pre>').html(adcFileList.innerHTML);

    $('#simple-adc-modal-header').html('Media Info');
    $('#simple-adc-modal .modal-body').html(innerDiv[0].outerHTML);

    $("#simple-adc-modal").modal();
}

function showPeers(event, size) {
    event.preventDefault();

    setModalSize(size);

    var adcFileList = document.querySelector('#adc-peers-list');
    var innerDiv = $('<div class="m-0 p-0"></div>').html(adcFileList.innerHTML);

    $('#simple-adc-modal-header').html('Peers List');
    $('#simple-adc-modal .modal-body').html(innerDiv[0].outerHTML);

    $("#simple-adc-modal").modal();
}

function checkSelectedRules(event) {
    var allChecked = true;
    $(".rule-checkbox").each((_, value) => {
        if (!value.checked) {
            allChecked = false;
        }
    });
    if (!allChecked) {
        alert('Not all rules was accepted!');
        event.preventDefault();
    }
}

function pretickRules(event) {
    var isChecked = event.target.checked;
    $(".rule-checkbox").prop("checked", !!isChecked);
}
