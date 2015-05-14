<div id="users">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý người dùng</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách người dùng
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="user-table">
                            <thead>
                            <tr>
                                <th><?= __('ID') ?></th>
                                <th><?= __('Người dùng') ?></th>
                                <th><?= __('Email') ?></th>
                                <th><?= __('Họ và tên') ?></th>
                                <th><?= __('Quyền hạn') ?></th>
                                <th><?= __('Ngày tạo') ?></th>
                                <th class="actions"><?= __('Hành động') ?></th>
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
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dLabel">
                                                <li><?= $this->Html->link(__('Xem'), ['action' => 'view', $user->id]) ?></li>
                                                <li><?= $this->Html->link(__('Cập nhật thông tin'), ['action' => 'update_info', $user->id]) ?></li>
                                                <li><?= $this->Form->postLink(__('Xóa'), ['action' => 'delete', $user->id], ['confirm' => __('Bạn có muốn xóa người dùng {0}?', $user->username)]) ?></li>
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
<!-- /#users -->
<?= $this->Js->dataTable('#user-table', ['responsive' => true])?>
