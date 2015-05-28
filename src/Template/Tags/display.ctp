<?php
echo $this->start('breadcrumb');
$this->Html->addCrumb($tag->name, $this->Url->build(['_name' => 'tag-display', 'slug' => $tag->slug, 'id' => $tag->id]), ['escape' => false, 'title' => $tag->name]);
echo $this->end();
?>
<div class="row">
    <div class="col-md-12">
        <h1>Tag: <?= $tag->name; ?></h1>
    </div>
</div>
<?php if (!empty($tag->posts)): ?>
    <div class="posts row">
        <div class="col-md-12" id="post-container">
            <?php foreach ($tag->posts as $post) {
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
<?php endif; ?>
