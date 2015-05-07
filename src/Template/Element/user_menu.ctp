<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-user">
        <li>
            <?= $this->Html->link(__('<i class="fa fa-user fa-fw"></i> Profile'), ['controller' => 'Users', 'action' => 'view'], ['escape' => false]) ?>
        </li>
        <!--        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>-->
        <li class="divider"></li>
        <li>
            <?= $this->Html->link(__('<i class="fa fa-sign-out fa-fw"></i> Logout'), ['controller' => 'Users', 'action' => 'logout'], ['escape' => false]) ?>
        </li>
    </ul>
    <!-- /.dropdown-user -->
</li>
<!-- /.dropdown -->
