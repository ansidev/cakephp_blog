<?= $this->element('head'); ?>
<body>
<?= $this->element('top_bar'); ?>
<div class="container" style="padding-top: 20px">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <?= $this->fetch('content') ?>
        </div>
    </div>
</div>
<hr>
<!-- Footer -->
<?= $this->element('footer'); ?>
</body>
</html>
