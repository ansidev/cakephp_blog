<nav class="navbar navbar-default navbar-fixed-top navbar-static-top" role="navigation">
    <div class="navbar-header">
        <?php if ($this->request->session()->read('Auth.User') !== null): ?>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="glyphicon glyphicon-list"></span>
        </button>
        <?php endif; ?>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-top-links">
            <span class="sr-only">Toggle navigation</span>
            <span class="glyphicon glyphicon-user"></span>
        </button>
        <?= $this->Html->link(__('Blog'), '/', ['class' => 'navbar-brand']) ?>
    </div>
    <!-- /.navbar-header -->

    <?= $this->element('top_right_menu') ?>
</nav>
