<?php
echo $this->Html->css('blog/post');
echo $this->Html->script('blog/post_read');
?>
<div id="comment-box">
<?php if ($this->request->session()->read('Auth.User') !== null) { ?>
        <?= $this->Form->create($comment, ['url' => ['controller' => 'Comments', 'action' => 'write']]); ?>
        <?= $this->Form->input('body', ['type' => 'textarea', 'class' => 'form-control', 'rows' => 7, 'label' => 'Viết bình luận']); ?>
        <?= $this->Form->hidden('post_id', ['value' => h($post->id)]); ?>
        <?= $this->Form->button(__('Đăng bình luận'), ['class' => 'btn btn-success pull-right']) ?>
        <?= $this->Form->end() ?>
<?php } else { ?>
    <?= __('Chào bạn, vui lòng đăng nhập để đăng bình luận!') . '<br><br>'; ?>
    <?= $this->Html->link(__('<i class="fa fa-sign-out fa-fw"></i> Đăng nhập'), ['controller' => 'Users', 'action' => 'login'], ['escape' => false, 'class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('<i class="fa fa-sign-out fa-fw"></i> Đăng ký'), ['controller' => 'Users', 'action' => 'register'], ['escape' => false, 'class' => 'btn btn-danger']) ?>
<?php } ?>
</div>

<div class="comments" id="comments">
    <div class="row">
        <div class="col-md-12">
            <h2 class="">Bình luận</h2>
            <section class="comment-list">
                <?php foreach ($published_comments as $cm) {
                    echo $this->Menu->createCommentBox($cm, h($post->id));
                } ?>
            </section>
        </div>
    </div>
</div>
