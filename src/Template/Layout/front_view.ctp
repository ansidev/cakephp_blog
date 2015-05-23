<?= $this->element('head'); ?>
<body>
<?= $this->element('top_bar'); ?>
<!-- Page Content -->
<div class="container" style="padding-top: 20px;">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-12">

            <h1 class="page-header">
                <?= $this->fetch('page_title') ?>
                <small><?= $this->fetch('page_description') ?></small>
            </h1>

            <?= $this->fetch('content') ?>

        </div>
    </div>
    <!-- /.row -->

    <hr>
    <!-- Footer -->
    <?= $this->element('footer'); ?>
</body>
</html>
