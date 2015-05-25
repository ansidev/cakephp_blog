<?= $this->element('head'); ?>
<?php echo $this->Html->css('metis-menu.css') ?>
<?php echo $this->Html->script('metis-menu.js') ?>
<?php echo $this->Html->script('sb-admin-2.js') ?>
<script type="text/javascript">
</script>
<body>
<?= $this->element('top_bar') ?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Tìm kiếm...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                </div>
                <!-- /input-group -->
            </li>
            <?php if (!empty($this->request->params['prefix']) && ($this->request->params['prefix'] === 'admin')) {
                echo $this->element('admin_sidebar');
            } else {
                echo $this->element('user_sidebar');
            }
            ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
<div id="page-wrapper" style="padding-top: 20px">

    <div class="row">
        <?= $this->Flash->render() ?>
    </div>
    <div class="row">
        <?php if (isset($default_grid) && $default_grid !== false): ?>
            <div class="col-md-12">
        <?php endif; ?>
            <?= $this->fetch('content') ?>
        <?php if (isset($default_grid) && $default_grid !== false): ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->element('footer'); ?>
</body>
</html>
