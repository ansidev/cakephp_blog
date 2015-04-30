<?= $this->assign('page_title', 'Thông tin người dùng') ?>
<?= $this->assign('page_description', h($user->full_name)) ?>
<div id="users">
    <div class="row">
        <div class="col-md-3">
            <?php
            $userInfo = [
                ['Username', h($user->username)],
                ['Email', h($user->email)],
                ['Họ và tên', h($user->full_name)]
            ];
            if ($user->has('role')) {
                $userInfo[] = ['Role', h($user->role->name)];
            }
            $userInfo = array_merge($userInfo, [
                ['Ngày tạo', h($user->created_at)],
                ['Cập nhật lần cuối', h($user->updated_at)]
            ]);
            echo $this->MyHtml->createUserInfo($userInfo);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Bài đã viết
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <?php if (!empty($user->posts)): ?>
                        <table class="table table-striped table-bordered table-hover" id="post-table">
                            <thead>
                            <tr>
                                <th><?= __('ID') ?></th>
                                <th><?= __('Tiêu đề') ?></th>
                                <th><?= __('Chủ đề') ?></th>
                                <th><?= __('Tag') ?></th>
                                <th><?= __('Bình luận') ?></th>
                                <th><?= __('Trạng thái') ?></th>
                                <th><?= __('Ngày viết') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $post_ids = []; ?>
                            <?php foreach ($user->posts as $post): ?>
                                <?php $post_ids[] = $post->id; ?>
                                <tr>
                                    <td><?= $this->Number->format($post->id) ?></td>
                                    <td><?= h($post->title) ?></td>
                                    <td><?= $this->Post->getCategories($post->id); ?></td>
                                    <td><?= $this->Post->getTags($post->id); ?></td>
                                    <td><?= $this->Post->getCommentsCount($post->id); ?></td>
                                    <td><?= $this->Post->statusToString($post->status); ?></td>
                                    <td><?= h($post->created_at) ?></td>
                                </tr>

                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Bình luận của bạn
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <?php if (!empty($user->comments)): ?>
                        <table class="table table-striped table-bordered table-hover" id="your-comment-table">
                            <thead>
                            <tr>
                                <th><?= __('ID') ?></th>
                                <th><?= __('Nội dung') ?></th>
                                <th><?= __('Bài viết') ?></th>
                                <th><?= __('Trạng thái') ?></th>
                                <th><?= __('Ngày viết') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($user->comments as $comment): ?>
                                <tr>
                                    <td><?= h($comment->id) ?></td>
                                    <td><?= h($comment->body) ?></td>
                                    <td><?= $this->Post->getTitle($comment->post_id) ?></td>
                                    <td><?= $this->Comment->statusToString($comment->status) ?></td>
                                    <td><?= h($comment->created_at) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Bình luận cho các bài viết của bạn
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <?php if (!empty($post_ids)) {
                        $all_comments = $this->Post->getComments($post_ids);
                        if (!empty($all_comments)) {
                            ?>
                            <table class="table table-striped table-bordered table-hover" id="comment-table">
                                <thead>
                                <tr>
                                    <th><?= __('ID') ?></th>
                                    <th><?= __('Nội dung') ?></th>
                                    <th><?= __('Bài viết') ?></th>
                                    <th><?= __('Trạng thái') ?></th>
                                    <th><?= __('Ngày viết') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($all_comments as $cm): ?>
                                    <tr>
                                        <td><?= h($cm->id) ?></td>
                                        <td><?= h($cm->body) ?></td>
                                        <td><?= $this->Post->getTitle($cm->post_id) ?></td>
                                        <td><?= $this->Comment->statusToString($cm->status) ?></td>
                                        <td><?= h($cm->created_at) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php }
                    } ?>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.row -->
</div>
<!-- /.row -->
</div>
<!-- /#users -->
<?= $this->Js->dataTable('#post-table', ['responsive' => true]) ?>
<?= $this->Js->dataTable('#your-comment-table', ['responsive' => true]) ?>
<?= $this->Js->dataTable('#comment-table', ['responsive' => true]) ?>
