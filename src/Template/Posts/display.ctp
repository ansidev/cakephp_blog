<div class="posts index large-10 medium-9 columns">
    <?php foreach ($posts as $post): ?>
        <div id="<?= 'post-' . $post->id ?>">
            <h2>
                <?= $this->Html->link(__($post->title), $this->Url->build(['_name' => 'post-read', 'slug' => $post->slug, 'id' => $post->id])) ?>
            </h2>

            <p class="lead">
                Đăng
                bởi <?php echo $post->user->username; ?>
                <?php //echo $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]); ?>
            </p>

            <p>
                <span class="glyphicon glyphicon-time"></span> Đăng vào <?= $this->Time->format($post->created_at, 'dd MMM, y HH:m:s A') ?>
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
            <?= $this->Html->link(__('Xem thêm <span class="glyphicon glyphicon-chevron-right"></span>'), ['controller' => 'Posts', 'action' => 'read', $post->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>

            <hr>
        </div>
    <?php endforeach; ?>
</div>
<!-- Pagination -->
<nav class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('Trước')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('Sau') . ' >') ?>
    </ul>
</nav>
