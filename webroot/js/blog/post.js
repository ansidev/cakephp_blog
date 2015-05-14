$(document).ready(function () {
    $('#file').change(function () {
        var file = $('#file').val().replace(/C:\\fakepath\\/i, '');
        var filename = file.substring(0, file.lastIndexOf('.'));
        autoTitle(filename);
    });
    $('#title').change(function () {
        autoSlug($('#title').val());
    });
});

function autoTitle(filename) {
    var url = '/media/autoSlug/' + filename;
    $.ajax({
        type: "post",  // Request method: post, get
        url: url, // URL to request
        success: function (response) {
            var json = JSON.parse(response);
            var i = 0;
            var file = $('#file').val().replace(/C:\\fakepath\\/i, '');
            var ext = file.substring(file.lastIndexOf('.'), file.length);
            $('#slug').val(json[0]);
            $('#title').val(json[0].replace(/-/g, ' '));
            $('#description').val($('#title').val());
        },
        error: function (error) {
            console.log(error);
        }
    });
    return false;
}
function autoSlug(title) {
    var url = '/media/autoSlug/' + title;
    $.ajax({
        type: "post",  // Request method: post, get
        url: url, // URL to request
        success: function (response) {
            var json = JSON.parse(response);
            var i = 0;
            var file = $('#file').val().replace(/C:\\fakepath\\/i, '');
            var ext = file.substring(file.lastIndexOf('.'), file.length);
            $('#slug').val(json[0]);
            //$(selector).val(json[0].replace(/-/g, ' '));
            //$('#file-name').val($('#slug').val() + ext);
        },
        error: function (error) {
            console.log(error);
        }
    });
    return false;
}
