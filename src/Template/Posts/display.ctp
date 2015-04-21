<div class="posts index large-10 medium-9 columns">
    <?php foreach ($posts as $post): ?>
        <h2>
            <?= $this->Html->link(__($post->title), ['action' => 'view', $post->id]) ?>
        </h2>

        <p class="lead">
            Đăng
            bởi <?= $post->has('user') ? $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?>
        </p>

        <p><span class="glyphicon glyphicon-time"></span> Đăng vào <?= $this->Time->format($post->created_at) ?></p>
        <hr>
        <?= $this->Html->image('default.gif', ['class' => 'img-responsive', 'alt' => 'thumbnail-img-' . $post->id]); ?>
        <hr>
        <p><?= h($post->body) ?></p>
        <?= $this->Html->link(__('Xem thêm <span class="glyphicon glyphicon-chevron-right"></span>'), ['action' => 'view', $post->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>

        <hr>
    <?php endforeach; ?>
    <!-- Pagination -->
    <nav class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('Trước')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Sau') . ' >') ?>
        </ul>
    </nav>
</div>
