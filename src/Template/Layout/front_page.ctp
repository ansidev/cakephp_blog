<?= $this->element('head'); ?>
<body>
<?= $this->element('top_bar') ?>
<!-- Page Content -->
<div class="container" style="padding-top: 20px;">
    <div class="row">
        <?= $this->Flash->render() ?>
    </div>
    <?= $this->fetch('slider') ?>
    <!--    --><?php //echo $this->element('Slider/carousel') ?>
    <?php echo $this->element('Slider/slidesjs') ?>
    <!--    --><?php //echo $this->element('Slider/nivo-slider') ?>

    <div class="row">
        <h1 class="page-header">
            CakePHP Blog
            <small>Blog built with CakePHP</small>
        </h1>
    </div>
    <div class="row">
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
    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-9">
            <?= $this->fetch('content') ?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-3" style="padding-right: 0">
            <!-- Blog Search Well -->
            <div class="well">
                <h4>Blog Search</h4>
                <?= $this->MyForm->searchForm(['controller' => 'Posts', 'action' => 'search']); ?>
            </div>

            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="myTab nav nav-pills nav-justified">
                    <li role="presentation" class="active"><a href="#recent_posts" aria-controls="recent_posts"
                                                              role="tab" data-toggle="tab" style="font-size: 13px; border-radius: 0">Bài
                            viết gần đây</a></li>
                    <li role="presentation"><a href="#recent_comments" aria-controls="recent_comments" role="tab"
                                               data-toggle="tab" style="font-size: 13px; border-radius: 0">Bình luận gần đây</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="recent_posts">
                        <?= $this->cell('Posts::recent_posts'); ?>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="recent_comments">
                        <?= $this->cell('Comments::recent_comments'); ?>
                    </div>
                </div>

            </div>
            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="myTab nav nav-pills nav-justified">
                    <li role="presentation" class="active"><a href="#categories" aria-controls="categories"
                                                              role="tab" data-toggle="tab" style="font-size: 13px; border-radius: 0">Chủ đề</a></li>
                    <li role="presentation"><a href="#tags" aria-controls="tags" role="tab"
                                               data-toggle="tab" style="font-size: 13px; border-radius: 0">Tag</a></li>
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

    <?= $this->element('footer'); ?>
</body>
</html>
