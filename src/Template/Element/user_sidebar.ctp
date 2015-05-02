<li>
    <?= $this->Html->link(__('<i class="fa fa-book fa-fw"></i> Dashboard <span class="fa arrow"></span>'), ['controller' => 'Posts', 'action' => 'index'], ['escape' => false]) ?>
    <ul class="nav nav-second-level">
        <li><?= $this->Html->link(__('Tổng quan'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Thông tin tài khoản'), ['controller' => 'Users', 'action' => 'view']) ?> </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <?= $this->Html->link(__('<i class="fa fa-book fa-fw"></i> Quản lý bài viết<span class="fa arrow"></span>'), ['controller' => 'Posts', 'action' => 'index'], ['escape' => false]) ?>
    <ul class="nav nav-second-level">
        <li><?= $this->Html->link(__('Danh sách bài viết'), ['controller' => 'Posts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Tạo bài viết mới'), ['controller' => 'Posts', 'action' => 'write']) ?> </li>
    </ul>
    <!-- /.nav-second-level -->
</li>

<li>
    <?= $this->Html->link(__('<i class="fa fa-coffee fa-fw"></i> Quản lý chủ đề<span class="fa arrow"></span>'), ['controller' => 'Categories', 'action' => 'index'], ['escape' => false]) ?>
    <ul class="nav nav-second-level">
        <li><?= $this->Html->link(__('Danh sách chủ đề'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Tạo chủ đề mới'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <?= $this->Html->link(__('<i class="fa fa-tags fa-fw"></i> Quản lý tag<span class="fa arrow"></span>'), ['controller' => 'Tags', 'action' => 'index'], ['escape' => false]) ?>
    <ul class="nav nav-second-level">
        <li><?= $this->Html->link(__('Danh sách tag'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Tạo tag mới'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <?= $this->Html->link(__('<i class="fa fa-comments fa-fw"></i> Quản lý bình luận<span class="fa arrow"></span>'), ['controller' => 'Comments', 'action' => 'index'], ['escape' => false]) ?>
    <ul class="nav nav-second-level">
        <li><?= $this->Html->link(__('Danh sách bình luận'), ['controller' => 'Comments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Tạo bình luận mới'), ['controller' => 'Comments', 'action' => 'add']) ?> </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
