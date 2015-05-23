<?= $this->element('head'); ?>
<body>
<?= $this->element('top_bar') ?>
<!-- Page Content -->
<div class="container" style="padding-top: 20px;">
    <div class="row">
        <?= $this->Flash->render() ?>
    </div>
    <?= $this->fetch('slider') ?>
    <?php echo $this->element('Slider/carousel') ?>
<!--    --><?php //echo $this->element('Slider/slidesjs') ?>
<!--    --><?php //echo $this->element('Slider/nivo-slider') ?>
    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                CakePHP Blog
                <small>Blog built with CakePHP</small>
            </h1>

            <?= $this->fetch('content') ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Blog Search Well -->
            <div class="well">
                <h4>Blog Search</h4>
                <?= $this->MyForm->searchForm(['controller' => 'Posts', 'action' => 'search']); ?>
            </div>

            <?= $this->cell('Posts::recent_posts'); ?>
            <?= $this->cell('Categories'); ?>
            <?= $this->cell('Tags'); ?>

        </div>

    </div>
    <!-- /.row -->

    <?= $this->element('footer'); ?>
</body>
</html>
