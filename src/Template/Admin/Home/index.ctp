<div class="col-lg-12">
    <h1 class="page-header">Dashboard</h1>
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<?= $this->element(
    'card',
    [
        'icon' => 'fa-users',
        'total' => $users,
        'title' => 'người dùng',
        'url' => $this->Router->url(
            [
                'controller' => 'Users',
                'action' => 'index'
            ]
        )
    ]
); ?>
<?= $this->element(
    'card',
    [
        'color' => 'green',
        'icon' => 'fa-edit',
        'total' => $posts,
        'title' => 'bài viết',
        'url' => $this->Router->url(
            [
                'controller' => 'Posts',
                'action' => 'index'
            ]
        )
    ]
); ?>
<?= $this->element(
    'card',
    [
        'color' => 'red',
        'icon' => 'fa-comment',
        'total' => $comments,
        'title' => 'bình luận',
        'url' => $this->Router->url(
            [
                'controller' => 'Comments',
                'action' => 'index'
            ]
        )
    ]
); ?>
<?= $this->element(
    'card',
    [
        'color' => 'yellow',
        'icon' => 'fa-comments',
        'total' => $categories,
        'title' => 'chủ đề',
        'url' => $this->Router->url(
            [
                'controller' => 'Categories',
                'action' => 'index'
            ]
        )
    ]
); ?>
