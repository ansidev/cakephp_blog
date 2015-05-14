<div id="media">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý các tập tin media</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row" id="container">
        <div id="image-list">
            <?php foreach ($media as $media): ?>
                <a href="#<?= h($media->slug) ?>" id="<?= h($media->slug) ?>"
                   class="item col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <img class="img-responsive"
                         src="<?= $this->Media->url($media->relative_path) ?>"/>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<style type="text/css">
    #image-list {
        width: 100%;
        margin: auto;
    }
    #container {
        padding: 0 15px;
    }
    .item {
        background: #32373c;
        width: 320px;
        height: 320px;
    }

    .item .img-responsive {
        min-height: 250px;
        max-height: 350px;
        width: 100%;
        padding: 15px 0;
    }
</style>
<?php echo $this->Html->script('freewall'); ?>
<script>
    $(document).ready(function () {
        var wall = new freewall("#image-list");
        wall.reset({
            selector: '.item',
            animate: true,
            cellW: 20,
            cellH: 200,
            onResize: function() {
                wall.fitWidth();
            }
        });
        wall.fitWidth();
        // for scroll bar appear;
        $(window).trigger("resize");
    });
</script>
