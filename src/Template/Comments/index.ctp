<div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            Các bình luận của bạn
        </div>
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <?php if (!empty($comments)) { ?>
                    <table class="table table-striped table-bordered table-hover" id="your-comment-table">
                        <thead>
                        <tr>
                            <th><?= __('ID') ?></th>
                            <th><?= __('Nội dung') ?></th>
                            <th><?= __('Bài viết') ?></th>
                            <th><?= __('Trạng thái') ?></th>
                            <th><?= __('Ngày đăng') ?></th>
                            <th class="actions"><?= __('Hành động') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($comments as $comment): ?>
                            <tr>
                                <td><?= h($comment->id) ?></td>
                                <td><?= h($comment->body) ?></td>
                                <td><?= $this->Post->getTitle($comment->post_id) ?></td>
                                <td><?= $this->Comment->statusToString($comment->status) ?></td>
                                <td><?= h($comment->created_at) ?></td>
                                <td class="actions">
                                    <div class="dropdown">
                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"
                                                aria-haspopup="true" aria-expanded="false">Hành động <span
                                                class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                            aria-labelledby="dLabel">
                                            <?php if ($comment->status === 3) { ?>
                                                <li><?= $this->Html->link(__('Xem trong bài viết'), $this->Url->build(['_name' => 'post-read', 'slug' => $comment->post->slug, 'id' => $comment->post->id, '#' => 'comment-id-' . $comment->id])) ?></li>
                                            <?php } ?>
                                            <li><?= $this->Html->link(__('Sửa'), ['controller' => 'Comments', 'action' => 'edit', $comment->id]) ?></li>
                                            <?php if ($comment->status !== 4) { ?>
                                                <li><?= $this->Form->postLink(__('Đánh dấu là spam'), ['controller' => 'Comments', 'action' => 'mark_as_spam', $comment->id], ['confirm' => __('Bạn có muốn đánh dấu bình luận #{0} là spam?', $comment->id)]) ?></li>
                                            <?php } ?>
                                            <?php if ($comment->status !== 5) { ?>
                                                <li><?= $this->Form->postLink(__('Chuyển vào thùng rác'), ['controller' => 'Comments', 'action' => 'move_to_trash', $comment->id], ['confirm' => __('Bạn có muốn chuyển bình luận #{0} vào thùng rác?', $comment->id)]) ?></li>
                                            <?php } else { ?>
                                                <li><?= $this->Form->postLink(__('Phục hồi'), ['controller' => 'Comments', 'action' => 'restore', $comment->id], ['confirm' => __('Bạn có muốn phục hồi bình luận #{0} không?', $comment->id)]) ?></li>
                                                <li><?= $this->Form->postLink(__('Xóa vĩnh viễn'), ['controller' => 'Comments', 'action' => 'permanent_delete', $comment->id], ['confirm' => __('Bạn có muốn xóa vĩnh viễn bình luận #{0} không?', $comment->id)]) ?></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php } else {
                    echo 'Không có dữ liệu trong hệ thống.';
                } ?>
            </div>
            <!-- /.table-responsive -->
        </div>
    </div>
    <!-- /.col-md-12 -->
</div>
<div class="col-md-12">
    <div class="panel panel-green">
        <div class="panel-heading">
            Bình luận cho các bài viết của bạn
        </div>
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <?php
                if (!$comments_for_your_posts) { ?>
                    <table class="table table-striped table-bordered table-hover" id="comment-table">
                        <thead>
                        <tr>
                            <th><?= __('ID') ?></th>
                            <th><?= __('Tiêu đề') ?></th>
                            <th><?= __('Chủ đề') ?></th>
                            <th><?= __('Tag') ?></th>
                            <th><?= __('Bình luận') ?></th>
                            <th><?= __('Trạng thái') ?></th>
                            <th><?= __('Ngày đăng') ?></th>
                            <th class="actions"><?= __('Hành động') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($comments_for_your_posts as $comment_for_your_post): ?>
                            <tr>
                                <td><?= $this->Number->format($comment_for_your_post->id) ?></td>
                                <td><?= h($comment_for_your_post->title) ?></td>
                                <td><?= $this->Post->getCategories($comment_for_your_post->id); ?></td>
                                <td><?= $this->Post->getTags($comment_for_your_post->id); ?></td>
                                <td><?= $this->Post->getCommentsCount($comment_for_your_post->id); ?></td>
                                <td><?= $this->Post->statusToString($comment_for_your_post->status); ?></td>
                                <td><?= h($comment_for_your_post->created_at) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php } else {
                    echo 'Không có dữ liệu trong hệ thống.';
                } ?>
            </div>
            <!-- /.table-responsive -->
        </div>
    </div>
    <!-- /.col-md-12 -->
</div>
<?= $this->Js->dataTable('#your-comment-table', ['responsive' => true]) ?>
<?= $this->Js->dataTable('#comment-table', ['responsive' => true]) ?>
