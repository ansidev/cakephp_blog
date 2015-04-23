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
                                <th><?= $this->Paginator->sort('id') ?></th>
                                <th><?= $this->Paginator->sort('title') ?></th>
                                <th><?= $this->Paginator->sort('category', 'Chủ đề') ?></th>
                                <th><?= $this->Paginator->sort('tag') ?></th>
                                <th><?= $this->Paginator->sort('comment') ?></th>
                                <th><?= $this->Paginator->sort('created_at') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($user->posts as $post): ?>
                                <tr>
                                    <td><?= $this->Number->format($post->id) ?></td>
                                    <td><?= h($post->title) ?></td>
                                    <td>
                                        <?php echo $this->Post->getCategories($post->id);
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $this->Post->getTags($post->id);
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $this->Post->getCommentsCount($post->id);
                                        ?>
                                    </td>
                                    <td><?= h($post->created_at) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['controller'=> 'Posts', 'action' => 'view', $post->id], ['class' => 'btn btn-primary']) ?>
                                        <?= $this->Html->link(__('Edit'), ['controller'=> 'Posts', 'action' => 'edit', $post->id], ['class' => 'btn btn-success']) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['controller'=> 'Posts', 'action' => 'delete', $post->id], ['class' => 'btn btn-danger', 'confirm' => __('Bạn có muốn xóa bài viết {0}?', $post->title)]) ?>
                                    </td>
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
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
<!-- /#users -->
<?= $this->Js->dataTable('#user-table', ['responsive' => true]) ?>
<div class="related row">
    <div class="column large-12">
        <h4 class="subheader"><?= __('Related Comments') ?></h4>
        <?php if (!empty($user->comments)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th><?= __('Id') ?></th>
                    <th><?= __('Body') ?></th>
                    <th><?= __('User Id') ?></th>
                    <th><?= __('Post Id') ?></th>
                    <th><?= __('Status') ?></th>
                    <th><?= __('Created At') ?></th>
                    <th><?= __('Updated At') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($user->comments as $comments): ?>
                    <tr>
                        <td><?= h($comments->id) ?></td>
                        <td><?= h($comments->body) ?></td>
                        <td><?= h($comments->user_id) ?></td>
                        <td><?= h($comments->post_id) ?></td>
                        <td><?= h($comments->status) ?></td>
                        <td><?= h($comments->created_at) ?></td>
                        <td><?= h($comments->updated_at) ?></td>

                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Comments', 'action' => 'view', $comments->id]) ?>

                            <?= $this->Html->link(__('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comments->id]) ?>

                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Comments', 'action' => 'delete', $comments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comments->id)]) ?>

                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
        <h4 class="subheader"><?= __('Related Posts') ?></h4>
        <?php if (!empty($user->posts)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th><?= __('Id') ?></th>
                    <th><?= __('Parent Id') ?></th>
                    <th><?= __('User Id') ?></th>
                    <th><?= __('Title') ?></th>
                    <th><?= __('Slug') ?></th>
                    <th><?= __('Body') ?></th>
                    <th><?= __('Status') ?></th>
                    <th><?= __('Created At') ?></th>
                    <th><?= __('Updated At') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($user->posts as $posts): ?>
                    <tr>
                        <td><?= h($posts->id) ?></td>
                        <td><?= h($posts->parent_id) ?></td>
                        <td><?= h($posts->user_id) ?></td>
                        <td><?= h($posts->title) ?></td>
                        <td><?= h($posts->slug) ?></td>
                        <td><?= h($posts->body) ?></td>
                        <td><?= h($posts->status) ?></td>
                        <td><?= h($posts->created_at) ?></td>
                        <td><?= h($posts->updated_at) ?></td>

                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Posts', 'action' => 'view', $posts->id]) ?>

                            <?= $this->Html->link(__('Edit'), ['controller' => 'Posts', 'action' => 'edit', $posts->id]) ?>

                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Posts', 'action' => 'delete', $posts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $posts->id)]) ?>

                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
