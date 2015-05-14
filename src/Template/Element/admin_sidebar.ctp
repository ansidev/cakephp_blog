<li>
    <?= $this->Html->link(__('<i class="fa fa-home fa-fw"></i> Dashboard<span class="fa arrow"></span>'), ['controller' => 'Home', 'action' => 'index'], ['escape' => false]) ?>
</li>
<li>
    <?= $this->Html->link(__('<i class="fa fa-users fa-fw"></i> Quản lý người dùng<span class="fa arrow"></span>'), ['controller' => 'Users', 'action' => 'index'], ['escape' => false]) ?>
    <ul class="nav nav-second-level">
        <li><?= $this->Html->link(__('Danh sách người dùng'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Thêm người dùng mới'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<?= $this->element('post_management'); ?>
<li>
    <?= $this->Html->link(__('<i class="fa fa-cogs fa-fw"></i> Quản lý role<span class="fa arrow"></span>'), ['controller' => 'Roles', 'action' => 'index'], ['escape' => false]) ?>
    <ul class="nav nav-second-level">
        <li><?= $this->Html->link(__('Danh sách role'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Thêm role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <?= $this->Html->link(__('<i class="fa fa-cogs fa-fw"></i> Quản lý permission<span class="fa arrow"></span>'), ['controller' => 'Permissions', 'action' => 'index'], ['escape' => false]) ?>
    <ul class="nav nav-second-level">
        <li><?= $this->Html->link(__('Danh sách permission'), ['controller' => 'Permissions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Thêm permission'), ['controller' => 'Permissions', 'action' => 'add']) ?></li>
    </ul>
    <!-- /.nav-second-level -->
</li>
