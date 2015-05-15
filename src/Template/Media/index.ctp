<div id="media">
    <?php if (!$display): ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Quản lý các tập tin media</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    <?php endif; ?>
    <!-- /.row -->
    <div id="freewall" class="row free-wall">
        <?php foreach ($media as $media): ?>
            <a href="#<?= h($media->slug) ?>" id="<?= h($media->slug) ?>">
                <div class="brick">
                    <?php if ($this->request->params['controller'] !== 'Media'): ?>
                        <div class="info">
                            <input class="checkbox" type="checkbox" id="cb-<?= h($media->slug) ?>">
                        </div>
                    <?php endif; ?>

                    <img class="img-responsive"
                         src="<?= $this->Media->url($media->relative_path) ?>" width="100%"
                         id="img-<?= h($media->slug) ?>">

                    <div class="info">
                        <h3><?= h($media->title) ?></h3>
                        <h5><?php echo json_decode($media->description, true)['description'] ?></h5>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<style type="text/css">
    .free-wall {
        margin: 15px;
    }

    .brick {
        width: 221.2px;
    }

    .info {
        padding: 15px;
        color: #333;
    }

    .brick img {
        margin: 0px;
        padding: 0px;
        display: block;
    }

    .brick {
        background: white;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        border-radius: 3px;
        color: #333;
        border: none;
    }

    .brick .img {
        width: 100%;
        max-width: 100%;
        display: block;
    }

    .brick h3, .brick h5 {
        text-shadow: none;
    }
</style>
<?php echo $this->Html->script('/js/freewall'); ?>
<script type="text/javascript">
    <?php if ($this->request->params['controller'] === 'Media'): ?>
    $(document).ready(function () {
        initFreeWall();
    });
    <?php endif;?>

    function initFreeWall() {
        var wall = new freewall("#freewall");
        wall.reset({
            selector: '.brick',
            animate: true,
            cellW: 200,
            cellH: 'auto',
            onResize: function () {
                wall.fitWidth();
            }
        });
        wall.container.find('.brick img').load(function () {
            wall.fitWidth();
        });
        console.log('fit width');
        wall.fitWidth();
    }
</script>
