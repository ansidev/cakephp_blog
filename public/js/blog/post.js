$(document).ready(function () {
    $('#post-title').change(function () {
        console.log('start');
        autoSlug($('#post-title').val());
    });
});

function autoSlug(title) {
    var url = '/posts/autoSlug/' + title;
    //var url = '/posts/autoSlug/' + title + '.json';
    $.ajax({
        type: "post",  // Request method: post, get
        url: url, // URL to request
        success: function (response) {
            var json = JSON.parse(response);
            var i = 0;
            console.log(json);
            $('#post-slug').val(json.slug);
        },
        error: function (error) {
            console.log(error);
        }
    });

    //var post = $.post(url);
    //post.done(function (response) {
    //    console.log(response);
    //    $('#post-slug').val(response.slug);
    //});
}
