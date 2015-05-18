$(document).ready(function () {
    $('.btn-reply').click(function () {
        $(this).parent().hide();
        $(this).parent().parent().children('.reply-box').show();
    });
    $('.btn-cancel').click(function () {
        $(this).parent().parent().hide();
        $(this).parent().parent().parent().children('p.text-right').show();
    });
});
