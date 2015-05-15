$(document).ready(function () {
    $('#freewall a').click(function () {
        var id = $(this).attr('id');
        $('#cb-' + id).prop('checked', true);
    });
    $('#modal-ok').click(function () {
        var imgs = $('.checkbox');
        var imgs_arr = [];
        imgs.each(function () {
            if ($(this).prop('checked')) {
                var id = $(this).attr('id').replace(/cb-/g, '');
                var url = $('#img-' + id).attr('src');
                var html = '';
                html += '<a href="' + url + '">';
                html += '<img class="img-responsive" src="' + url + '" ';
                html += 'id="img-' + id + '">';
                html += $('#img-' + id).val();
                html += '</a>';
                console.log(html);
                CKEDITOR.instances.body.insertHtml(html);
            }
        });
        $('#image-box').modal('hide');
    });
    var i = 0;
    $('#image-box').on('show.bs.modal', function () {
        //console.log('started');
        initFreeWall();
        if (i === 0) {
            fullScreen();
            normalScreen();
        }
    });
});

function fullScreen() {
    var docElement, request;

    docElement = document.documentElement;
    request = docElement.requestFullScreen || docElement.webkitRequestFullScreen || docElement.mozRequestFullScreen || docElement.msRequestFullScreen;

    if (typeof request != "undefined" && request) {
        request.call(docElement);
    }
}

function normalScreen() {
    var docElement, request;

    docElement = document;
    request = docElement.cancelFullScreen || docElement.webkitCancelFullScreen || docElement.mozCancelFullScreen || docElement.msCancelFullScreen || docElement.exitFullscreen;
    if (typeof request != "undefined" && request) {
        request.call(docElement);
    }
}
