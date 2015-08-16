<?php if ($this->request->session()->read('Auth.User.role_id') === 1) {
    $prefix = 'admin';
} else {
    $prefix = false;
}?>
<li>
    <?= $this->Html->link(__('<i class="fa fa-edit fa-fw"></i> Quản lý bài viết<span class="fa arrow"></span>'), ['prefix' => $prefix, 'controller' => 'Posts', 'action' => 'index'], ['escape' => false]) ?>
    <ul class="nav nav-second-level">
        <li><?= $this->Html->link(__('Danh sách bài viết'), ['prefix' => $prefix, 'controller' => 'Posts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Tạo bài viết mới'), ['prefix' => $prefix, 'controller' => 'Posts', 'action' => 'write']) ?> </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <?= $this->Html->link(__('<i class="fa fa-comments fa-fw"></i> Quản lý bình luận<span class="fa arrow"></span>'), ['prefix' => $prefix, 'controller' => 'Comments', 'action' => 'index'], ['escape' => false]) ?>
    <ul class="nav nav-second-level">
        <li><?= $this->Html->link(__('Danh sách bình luận'), ['prefix' => $prefix, 'controller' => 'Comments', 'action' => 'index']) ?> </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <?= $this->Html->link(__('<i class="fa fa-coffee fa-fw"></i> Quản lý chủ đề<span class="fa arrow"></span>'), ['prefix' => $prefix, 'controller' => 'Categories', 'action' => 'index'], ['escape' => false]) ?>
    <ul class="nav nav-second-level">
        <li><?= $this->Html->link(__('Danh sách chủ đề'), ['prefix' => $prefix, 'controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Tạo chủ đề mới'), ['prefix' => $prefix, 'controller' => 'Categories', 'action' => 'add']) ?> </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <?= $this->Html->link(__('<i class="fa fa-tags fa-fw"></i> Quản lý tag<span class="fa arrow"></span>'), ['prefix' => $prefix, 'controller' => 'Tags', 'action' => 'index'], ['escape' => false]) ?>
    <ul class="nav nav-second-level">
        <li><?= $this->Html->link(__('Danh sách tag'), ['prefix' => $prefix, 'controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Tạo tag mới'), ['prefix' => $prefix, 'controller' => 'Tags', 'action' => 'add']) ?> </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <?= $this->Html->link(__('<i class="fa fa-film fa-fw"></i> Quản lý media<span class="fa arrow"></span>'), ['prefix' => $prefix, 'controller' => 'Media', 'action' => 'index'], ['escape' => false]) ?>
    <ul class="nav nav-second-level">
        <li><?= $this->Html->link(__('Danh sách media'), ['prefix' => false, 'controller' => 'Media', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Upload media'), ['prefix' => false, 'controller' => 'Media', 'action' => 'upload']) ?> </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
