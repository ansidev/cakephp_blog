<div class="col-md-6">
    <div class="row col">
        <div class="panel panel-red">
            <div class="panel-heading">
                <strong>Thông tin tài khoản</strong>
            </div>
            <div class="panel-body">
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
        <!-- /.col-md-6 -->
    </div>
<!--    <div class="row col">-->
<!--        <div class="panel panel-default">-->
<!--            <div class="panel-heading">-->
<!--                <strong>Hoạt động gần đây</strong>-->
<!--            </div>-->
<!--            <div class="panel-body">-->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices-->
<!--                    accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <!-- /.col-md-6 -->
<!--    </div>-->
<!--    <div class="row col">-->
<!--        <div class="panel panel-default">-->
<!--            <div class="panel-heading">-->
<!--                <strong>Hoạt động gần đây</strong>-->
<!--            </div>-->
<!--            <div class="panel-body">-->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices-->
<!--                    accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <!-- /.col-md-6 -->
<!--    </div>-->
<!--    <div class="row col">-->
<!--        <div class="panel panel-default">-->
<!--            <div class="panel-heading">-->
<!--                <strong>Hoạt động gần đây</strong>-->
<!--            </div>-->
<!--            <div class="panel-body">-->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices-->
<!--                    accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <!-- /.col-md-6 -->
<!--    </div>-->
</div>
<div class="col-md-6">
    <div class="row col">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Quick draft
                    - <?= $this->Html->link('Đến trang đầy đủ', ['controller' => 'Posts', 'action' => 'write']) ?></strong>
            </div>
            <div class="panel-body">
                <?php
                echo $this->Form->create($post, [
                    'url' => ['controller' => 'Posts', 'action' => 'quick_draft']
                ]);
                echo $this->Form->input('title', ['label' => 'Tiêu đề']);
                echo $this->Form->input('body', ['label' => 'Nội dung', 'class' => 'form-control']);
                echo $this->Form->button(__('Lưu bản nháp'), ['class' => 'pull-right btn btn-primary']);
                echo $this->Form->end();
                ?>
            </div>
            <div class="list-group">
                <?php
//                $draft_posts = $this->Post->getDraftPosts($user->id);
                if ($draft_posts !== 0) { ?>
                    <?php foreach ($draft_posts as $draft_post): ?>
                        <a href="<?= '/posts/edit/' . $draft_post->id ?>" class="list-group-item">
                            <h4 class="list-group-item-heading"><?= h($draft_post->title) ?> | <i class="fa fa-comment-o"></i> <?= $this->Post->getCommentsCount($draft_post->id); ?> | <?= h($draft_post->created_at) ?></h4>
                            <p class="list-group-item-text"><?= $this->Content->echoShortText($draft_post->body) ?></p>
                        </a>
                    <?php endforeach; ?>
                <?php } ?>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-yellow">
        <div class="panel-heading">
            Bài đã viết
        </div>
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <?php if ($user->posts !== 0): ?>
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
                        <?php foreach ($user->posts as $post): ?>
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
    </div>
    <!-- /.col-md-12 -->
</div>
<div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            Các bình luận của bạn
        </div>
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <?php if (!empty($user->comments)) { ?>
                    <table class="table table-striped table-bordered table-hover" id="your-comment-table">
                        <thead>
                        <tr>
                            <th><?= __('ID') ?></th>
                            <th><?= __('Nội dung') ?></th>
                            <th><?= __('Bài viết') ?></th>
                            <th><?= __('Trạng thái') ?></th>
                            <th><?= __('Ngày đăng') ?></th>
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
                if ($published_posts->count() !== 0) { ?>
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
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($published_posts as $post): ?>
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
                <?php } else {
                    echo 'Không có dữ liệu trong hệ thống.';
                } ?>
            </div>
            <!-- /.table-responsive -->
        </div>
    </div>
    <!-- /.col-md-12 -->
</div>
<?= $this->Js->dataTable('#post-table', ['table_tools' => false]) ?>
<?= $this->Js->dataTable('#your-comment-table', ['table_tools' => false]) ?>
<?= $this->Js->dataTable('#comment-table', ['table_tools' => false]) ?>
