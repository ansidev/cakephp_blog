<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakeBlog';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('font-awesome.css') ?>
    <?= $this->Html->css('metis-menu.css') ?>
    <?= $this->Html->css('sb-admin-2.css') ?>
    <?= $this->Html->css('data-tables.bootstrap.css') ?>
    <?= $this->Html->script('jquery.js') ?>
    <?= $this->Html->script('bootstrap.js') ?>
    <?= $this->Html->script('metis-menu.js') ?>
    <?= $this->Html->script('sb-admin-2.js') ?>
    <?= $this->Html->script('jquery.data-tables.js') ?>
    <?= $this->Html->script('data-tables.bootstrap.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="container-fluid" style="padding-left: 0; padding-right: 0">
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
