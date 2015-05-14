<li>
    <?= $this->Html->link(__('<i class="fa fa-home fa-fw"></i> Dashboard <span class="fa arrow"></span>'), ['controller' => 'Posts', 'action' => 'index'], ['escape' => false]) ?>
    <ul class="nav nav-second-level">
        <li><?= $this->Html->link(__('Tổng quan'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<?= $this->element('post_management'); ?>
