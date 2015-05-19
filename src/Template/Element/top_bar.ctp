<nav class="navbar navbar-default navbar-fixed-top navbar-static-top" role="navigation">
    <div class="navbar-header">
        <?php if ($this->request->session()->read('Auth.User') !== null): ?>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="glyphicon glyphicon-list"></span>
            </button>
        <?php endif; ?>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-top-links">
            <span class="sr-only">Toggle navigation</span>
            <span class="glyphicon glyphicon-user"></span>
        </button>
        <?= $this->Html->link(__('Blog'), '/', ['class' => 'navbar-brand']) ?>
    </div>
    <!-- /.navbar-header -->
    <div id="navbar" class="navbar-collapse collapse">
        <?php if ($this->request->session()->read('Auth.User') !== null): ?>
        <ul class="nav navbar-nav">
            <li>
                <?php if ($this->request->session()->read('Auth.User.role_id') === 1): ?>
                    <?= $this->Html->link(__('Dashboard'), ['prefix' => 'admin', 'controller' => 'Home', 'action' => 'index'], ['escape' => false]) ?>
                <?php endif; ?>
                <?php if ($this->request->session()->read('Auth.User.role_id') === 3): ?>
                    <?= $this->Html->link(__('Dashboard'), ['prefix' => false, 'controller' => 'Users', 'action' => 'index'], ['escape' => false]) ?>
                <?php endif; ?>

            </li>
<!--            <li><a href="#about">About</a></li>-->
<!--            <li><a href="#contact">Contact</a></li>-->
<!--            <li class="dropdown">-->
<!--                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown-->
<!--                    <span class="caret"></span></a>-->
<!--                <ul class="dropdown-menu" role="menu">-->
<!--                    <li><a href="#">Action</a></li>-->
<!--                    <li><a href="#">Another action</a></li>-->
<!--                    <li><a href="#">Something else here</a></li>-->
<!--                    <li class="divider"></li>-->
<!--                    <li class="dropdown-header">Nav header</li>-->
<!--                    <li><a href="#">Separated link</a></li>-->
<!--                    <li><a href="#">One more separated link</a></li>-->
<!--                </ul>-->
<!--            </li>-->
        </ul>
        <?php endif; ?>
    <!--/.nav-collapse -->
    <?= $this->element('top_right_menu') ?>
    </div>
</nav>
