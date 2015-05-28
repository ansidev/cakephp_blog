<?= $this->start('posts'); ?>
<div class="posts row">
    <div class="col-md-12" id="post-container">
        <?php foreach ($posts as $post) {
            echo $this->element('Posts/post_preview', ['post' => $post]);
        } ?>
    </div>
</div>
<?php echo $this->Html->script('freewall'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        initFreeWall();
    });
    function initFreeWall() {
        var wall = new freewall("#post-container");
        wall.reset({
            selector: '.post',
            animate: true,
            cellW: 300,
            cellH: 'auto',
            onResize: function () {
                wall.fitWidth();
            }
        });
        wall.container.find('.post img').load(function () {
            wall.fitWidth();
        });
        wall.fitWidth();
    }
</script>
<?= $this->end(); ?>
<!-- Pagination -->
<nav class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('Trước')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('Sau') . ' >') ?>
    </ul>
</nav>
