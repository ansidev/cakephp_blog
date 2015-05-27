<?= $this->element('head'); ?>
<body>
<?= $this->element('top_bar') ?>
<!-- Page Content -->
<div class="container" style="padding-top: 20px;">
    <!-- Flash Message -->
    <div class="row">
        <div class="col-md-12">
            <?= $this->Flash->render() ?>
        </div>
    </div>
    <!-- Slider -->
    <div class="row">
        <div class="col-md-12">
            <?= $this->fetch('slider') ?>
            <?php echo $this->element('Slider/carousel') ?>
            <!--    --><?php //echo $this->element('Slider/slidesjs') ?>
            <!--    --><?php //echo $this->element('Slider/nivo-slider') ?>
        </div>
    </div>
    <!-- Site Header -->
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                CakePHP Blog
                <small>Blog built with CakePHP</small>
            </h1>
        </div>
    </div>
    <!-- Breadcrumb Bar -->
    <div class="row">
        <div class="col-md-12">
            <?php
            echo $this->fetch('breadcrumb');
            echo $this->Html->getCrumbList(
                [
                    'firstClass' => false,
                    'lastClass' => 'active',
                    'class' => 'breadcrumb'
                ],
                'Home'
            );
            ?>
        </div>
    </div>
    <!-- Main content -->
    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="row">
                <div class="col-md-12">
                    <!-- Post(s) -->
                    <?= $this->fetch('posts') ?>
                    <!-- Comments -->
                    <?= $this->fetch('comments') ?>
                    <?= $this->fetch('content') ?>
                </div>
            </div>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- Blog Search Well -->
                    <div class="well">
                        <h4>Blog Search</h4>
                        <?= $this->MyForm->searchForm(['controller' => 'Posts', 'action' => 'search']); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="myTab nav nav-pills nav-justified">
                            <li role="presentation" class="active"><a href="#recent_posts"
                                                                      aria-controls="recent_posts"
                                                                      role="tab" data-toggle="tab"
                                                                      style="font-size: 13px; border-radius: 0">Gần
                                    đây</a></li>
                            <li role="presentation"><a href="#popular_posts" aria-controls="popular_posts"
                                                       role="tab"
                                                       data-toggle="tab" style="font-size: 13px; border-radius: 0">Xem
                                    nhiều</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="recent_posts">
                                <?= $this->cell('Posts::recent_posts'); ?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="popular_posts">
                                <?php //echo $this->cell('Comments::recent_comments'); ?>
                                <?= $this->cell('Posts::popular_posts'); ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="myTab nav nav-pills nav-justified">
                            <li role="presentation" class="active"><a href="#categories"
                                                                      aria-controls="categories"
                                                                      role="tab" data-toggle="tab"
                                                                      style="font-size: 13px; border-radius: 0">Chủ
                                    đề</a></li>
                            <li role="presentation"><a href="#tags" aria-controls="tags" role="tab"
                                                       data-toggle="tab"
                                                       style="font-size: 13px; border-radius: 0">Tag</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="categories">
                                <?= $this->cell('Categories'); ?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tags">
                                <?= $this->cell('Tags'); ?>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <!-- /.row -->
        </div>
    </div>
    <?= $this->element('footer'); ?>
</body>
</html>
