<h1 class="page-header">
    Thông tin người dùng
    <small><?= h($user->full_name) ?></small>
</h1>
<div id="users">
    <div class="row">
        <div class="col-md-4">
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
        <div class="col-md-4">
            <?= $this->Html->link('Cập nhật thông tin', ['controller' => 'Users', 'action' => 'update_info'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#users -->
