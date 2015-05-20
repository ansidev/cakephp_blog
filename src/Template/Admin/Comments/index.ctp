<div id="comments">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý bình luận</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách bình luận
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="comment-table">
                            <thead>
                            <tr>
                                <th><?= __('ID') ?></th>
                                <th><?= __('Bình luận') ?></th>
                                <th><?= __('Người đăng') ?></th>
                                <th><?= __('Bài viết') ?></th>
                                <th><?= __('Trạng thái') ?></th>
                                <th><?= __('Ngày đăng') ?></th>
                                <th><?= __('Ngày cập nhật cuối') ?></th>
                                <th class="actions"><?= __('Hành động') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($comments as $comment): ?>
                                <tr>
                                    <td><?= $this->Number->format($comment->id) ?></td>
                                    <td><?= h($comment->body) ?></td>
                                    <td>
                                        <?= $comment->has('user') ? $this->Html->link($comment->user->id, ['controller' => 'Users', 'action' => 'view', $comment->user->id]) : '' ?>
                                    </td>
                                    <td>
                                        <?= $comment->has('post') ? $this->Html->link($comment->post->title, $this->Url->build(['_name' => 'post-read', 'slug' => $comment->post->slug, 'id' => $comment->post->id])) : '' ?>
                                    </td>
                                    <td><?= $this->Comment->statusToString($comment->status) ?></td>
                                    <td><?= h($comment->created_at) ?></td>
                                    <td><?= h($comment->updated_at) ?></td>
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
                                                <?php if ($comment->status !== 3) { ?>
                                                    <li><?= $this->Form->postLink(__('Duyệt đăng'), ['controller' => 'Comments', 'action' => 'publish', $comment->id]) ?></li>
                                                <?php } ?>
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
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<?= $this->Js->dataTable('#comment-table', ['responsive' => true]) ?>
