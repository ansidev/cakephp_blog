<div class="posts">
    <div id="<?= 'post-' . $post->id ?>">
        <h2>
            <?= $this->Html->link(__($post->title), ['action' => 'view', $post->id]) ?>
        </h2>

        <p class="lead">
            Đăng
            bởi <?= $post->has('user') ? $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?>
        </p>

        <p>
            <span class="glyphicon glyphicon-time"></span> Đăng vào <?= $this->Time->format($post->created_at) ?>
            | <span class="fa fa-comment"></span> <?= $this->Post->getCommentsCount($post->id) ?>
        </p>
        <hr>
        <?= $this->Html->image('default.gif', ['class' => 'img-responsive', 'alt' => 'thumbnail-img-' . $post->id]); ?>
        <hr>
        <p><?php echo htmlspecialchars_decode($post->body) ?></p>
        <hr>
    </div>
</div>
<div class="comments">
    <?= $this->element('comment_box'); ?>
</div>
<!-- Pagination -->
<nav class="paginator">
    <ul class="pagination">
        <?php // $this->Paginator->prev('< ' . __('Trước')) ?>
        <?php // $this->Paginator->numbers() ?>
        <?php // $this->Paginator->next(__('Sau') . ' >') ?>
    </ul>
</nav>
<?php
//    echo "<pre>";
//    print_r($associated_post);
//    echo "</pre>";
?>
