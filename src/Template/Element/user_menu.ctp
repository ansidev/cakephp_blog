<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-user fa-fw"></i> <?php echo $this->request->session()->read('Auth.User.username'); ?> <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-user">
        <li>
            <?php if ($this->request->session()->read('Auth.User.role_id') === 1): ?>
                <?= $this->Html->link(__('<i class="fa fa-user fa-fw"></i> Hồ sơ'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'view'], ['escape' => false]) ?>
            <?php endif; ?>
            <?php if ($this->request->session()->read('Auth.User.role_id') === 3): ?>
                <?= $this->Html->link(__('<i class="fa fa-user fa-fw"></i> Hồ sơ'), ['prefix' => false, 'controller' => 'Users', 'action' => 'view'], ['escape' => false]) ?>
            <?php endif; ?>
        </li>
        <!--        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>-->
        <li class="divider"></li>
        <li>
            <?= $this->Html->link(__('<i class="fa fa-sign-out fa-fw"></i> Đăng xuất'), ['controller' => 'Users', 'action' => 'logout'], ['escape' => false]) ?>
        </li>
    </ul>
    <!-- /.dropdown-user -->
</li>
<!-- /.dropdown -->
