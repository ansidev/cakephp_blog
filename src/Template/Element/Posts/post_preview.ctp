<div id="<?= 'post-' . $post->id ?>" class="post col-md-4">
    <h2>
        <?= $this->Html->link(__($post->title), $this->Url->build(['_name' => 'post-read', 'slug' => $post->slug, 'id' => $post->id]), ['escape' => false, 'title' => $post->title]) ?>
    </h2>
    <span
        class="glyphicon glyphicon-user"></span> <?php echo $this->UserInfo->getUserInfo($post->user_id, ['username'])->username; ?>
    <?php //echo $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]); ?>
    | <span
        class="glyphicon glyphicon-time"></span> <?= $this->Time->format($post->created_at, 'dd/MM/y') ?>
    | <span class="fa fa-comment"></span>
    <?= $this->Html->link(
        $this->Post->getCommentsCount($post->id) . ' bình luận',
        $this->Url->build(['_name' => 'post-read', 'slug' => $post->slug, 'id' => $post->id, '#' => 'comment-box']),
        ['title' => $post->title]
    ); ?>
    | <span class="fa fa-eye"></span>
    <?= $this->Number->format($post->clicked); ?>
    <hr>
    <div class="col-md-12">
        <?php echo $this->Post->getThumbnailImage($post->id, $post->thumbnail_url); ?>
    </div>
    <div class="col-md-12">
        <?php echo $this->Content->echoShortText($post->body, 200); ?>
        <hr>
        <div style="border-left: 5px solid #286090; padding: 2px 5px">
            Chủ đề: <?= $this->Post->getCategories($post->id); ?>
        </div>
        <div style="border-left: 5px solid #d9534f; padding: 2px 5px">
            Tag: <?= $this->Post->getTags($post->id); ?>
        </div>
        <hr>
        <?php echo $this->Html->link(__('Xem thêm <span class="glyphicon glyphicon-chevron-right"></span>'), $this->Url->build(['_name' => 'post-read', 'slug' => $post->slug, 'id' => $post->id]), ['class' => 'btn btn-primary', 'escape' => false]); ?>
    </div>
</div>
