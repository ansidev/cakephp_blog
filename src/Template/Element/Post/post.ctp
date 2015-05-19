<div id="<?= 'post-' . $post->id ?>">
    <h2>
        <?= $this->Html->link(__($post->title), $this->Url->build(['_name' => 'post-read', 'slug' => $post->slug, 'id' => $post->id]), ['escape' => false, 'title' => $post->title]) ?>
    </h2>

    <p class="lead">
        Đăng
        bởi <?= $post->user->username; ?>
        <?php //echo $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]); ?>
    </p>

    <p>
        <span class="glyphicon glyphicon-time"></span> Đăng vào <?= $this->Time->format($post->created_at, 'dd MMM, y H:m:s') ?>
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
    <hr>
</div>
