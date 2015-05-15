$(document).ready(function () {
    $('#post-title').change(function () {
        autoSlug($('#post-title').val());
    });
});

function autoSlug(title) {
    var url = '/posts/autoSlug/' + title;
    $.ajax({
        type: "post",  // Request method: post, get
        url: url, // URL to request
        success: function (response) {
            var json = JSON.parse(response);
            var i = 0;
            $('#post-slug').val(json[0]);
        },
        error: function (error) {
            console.log(error);
        }
    });
    return false;
}
