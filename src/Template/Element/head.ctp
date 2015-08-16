<?php
$cakeDescription = 'CakeCMS';
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $this->fetch('title') ?>
    </title>
    <?php echo $this->Html->meta('icon') ?>
    <!-- Load CSS-->
    <?php echo $this->Html->css('bootstrap.css') ?>
    <?php //echo $this->Html->css('paper.css') ?>
    <?php //echo $this->Html->script('material.css') ?>
    <?php echo $this->Html->css('font-awesome.css') ?>
    <?php echo $this->Html->css('jquery.data-tables.css') ?>
    <?php echo $this->Html->css('data-tables.bootstrap.css') ?>
    <?php echo $this->Html->css('sb-admin-2.css') ?>
    <?php echo $this->Html->css('bootstrap-flat.css') ?>
    <?php //echo $this->Html->css('blog/style.css') ?>

    <!-- Load Javascript-->
    <?php echo $this->Html->script('jquery.js') ?>
    <?php echo $this->Html->script('bootstrap.js') ?>
    <?php //echo $this->Html->script('material.js') ?>
    <?php echo $this->Html->script('jquery.data-tables.js') ?>
    <?php echo $this->Html->script('data-tables.bootstrap.js') ?>
    <?php //echo $this->Html->css('animate') ?>

    <?php echo $this->fetch('meta') ?>
    <?php echo $this->fetch('css') ?>
</head>
