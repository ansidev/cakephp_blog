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
    <?= $this->Html->css('sb-admin-2.css') ?>
    <?= $this->Html->css('data-tables.bootstrap.css') ?>
    <?= $this->Html->css('blog/style'); ?>

    <?= $this->Html->script('jquery.js') ?>
    <?= $this->Html->script('bootstrap.js') ?>
    <?= $this->Html->script('jquery.data-tables.js') ?>
    <?= $this->Html->script('data-tables.bootstrap.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body style="margin-top: 50px">
<?= $this->element('top_bar') ?>
<!-- Page Content -->
<div class="container" style="padding-top: 20px;">
    <div class="row">
        <?= $this->Flash->render() ?>
    </div>

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
