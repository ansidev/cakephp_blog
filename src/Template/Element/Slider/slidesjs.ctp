<?= $this->Html->script("jquery.slides"); ?>
<?= $this->Html->css("slidesjs.theme"); ?>

<script>
    $(function () {
        $("#slidesjs").slidesjs({
            navigation: false,
            width: 940,
            height: 250
        });
    });
</script>
<div class="row">
    <div id="slidesjs" style="display: none; padding-bottom: 15px">
        <img src="http://placehold.it/940x250">
        <img src="http://placehold.it/940x250">
        <img src="http://placehold.it/940x250">
        <img src="http://placehold.it/940x250">
        <img src="http://placehold.it/940x250">
        <a href="#" class="slidesjs-previous slidesjs-navigation"><i class="glyphicon glyphicon-arrow-left"></i> Previous</a>
        <a href="#" class="slidesjs-next slidesjs-navigation">Next <i class="glyphicon glyphicon-arrow-right"></i></a>
    </div>
</div>
