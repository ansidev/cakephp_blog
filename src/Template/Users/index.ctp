<div class="col-md-6">
    <div class="row col">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Hoạt động gần đây</strong>
            </div>
            <div class="panel-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices
                    accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
    <div class="row col">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Hoạt động gần đây</strong>
            </div>
            <div class="panel-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices
                    accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
    <div class="row col">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Hoạt động gần đây</strong>
            </div>
            <div class="panel-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices
                    accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
    <div class="row col">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Hoạt động gần đây</strong>
            </div>
            <div class="panel-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices
                    accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
</div>
<div class="col-md-6">
    <div class="row col">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <strong>Quick post</strong>
            </div>
            <div class="panel-body">
                <?php
                echo $this->Form->create($post, [
                    'url' => ['controller' => 'Posts', 'action' => 'quick_post']
                ]);
                echo $this->Form->input('title');
                echo $this->Form->input('body');
                echo $this->Form->button(__('Quick post'), ['class' => 'pull-right btn btn-primary']);
                echo $this->Form->end();
                ?>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
</div>
<div class="col-lg-6">
    <div class="panel panel-yellow">
        <div class="panel-heading">
            Yellow Panel
        </div>
        <div class="panel-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices
                accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
        </div>
        <div class="panel-footer">
            Panel Footer
        </div>
    </div>
    <!-- /.col-lg-6 -->
</div>
</div>
<div class="users index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('username') ?></th>
            <th><?= $this->Paginator->sort('email') ?></th>
            <th><?= $this->Paginator->sort('full_name') ?></th>
            <th><?= $this->Paginator->sort('roles_id') ?></th>
            <th><?= $this->Paginator->sort('created_at') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->full_name) ?></td>
                <td>
                    <?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?>
                </td>
                <td><?= h($user->created_at) ?></td>
                <td class="actions">
                    <div class="dropdown">
                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="false">Hành động <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><?= $this->Html->link(__('Xem'), ['action' => 'view', $post->id]) ?></li>
                            <li><?= $this->Html->link(__('Sửa'), ['action' => 'edit', $post->id]) ?></li>
                            <li><?= $this->Form->postLink(__('Xóa'), ['action' => 'delete', $post->id], ['confirm' => __('Bạn có muốn xóa bài viết {0}?', $post->title)]) ?></li>
                        </ul>
                    </div>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
