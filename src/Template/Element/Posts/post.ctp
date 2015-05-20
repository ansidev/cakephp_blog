<div id="<?= 'post-' . $post->id ?>">
    <h2>
        <?= $this->Html->link(__($post->title), $this->Url->build(['_name' => 'post-read', 'slug' => $post->slug, 'id' => $post->id]), ['escape' => false, 'title' => $post->title]) ?>
    </h2>

    <p class="lead">
        Đăng
        bởi <?php echo $this->UserInfo->getUserInfo($post->user_id, ['username'])->username; ?>
        <?php //echo $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]); ?>
    </p>

    <p>
        <span class="glyphicon glyphicon-time"></span> Đăng
        vào <?= $this->Time->format($post->created_at, 'dd MMM, y H:m:s') ?>
        | <span class="fa fa-comment"></span> Bình luận:
        <?= $this->Html->link(
            $this->Post->getCommentsCount($post->id),
            $this->Url->build(['_name' => 'post-read', 'slug' => $post->slug, 'id' => $post->id, '#' => 'comment-box']),
            ['title' => $post->title]
        ); ?>

    </p>
    <hr>
    <?= $this->Html->image('default.gif', ['class' => 'img-responsive', 'alt' => 'thumbnail-img-' . $post->id]); ?>
    <hr>
    <p><?= htmlspecialchars_decode($post->body) ?></p>
    <?php
    if (empty($no_display)) {
        $no_display = false;
    }
    if (!$no_display) {
        echo $this->Html->link(__('Xem thêm <span class="glyphicon glyphicon-chevron-right"></span>'), $this->Url->build(['_name' => 'post-read', 'slug' => $post->slug, 'id' => $post->id]), ['class' => 'btn btn-primary', 'escape' => false]);
    } ?>
    <hr>
</div>
