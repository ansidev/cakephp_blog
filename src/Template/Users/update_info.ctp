<div class="users col-md-4 col-md-offset-4">
    <?= $this->Form->create($user); ?>
    <fieldset>
        <legend><?= __('Cập nhật thông tin tài khoản') ?></legend>
        <?php
            echo $this->Flash->render();
            echo $this->Form->input('email');
            echo $this->Form->input('full_name');
            echo $this->Form->input('current_password', ['type' => 'password', 'label' => 'Password']);
            echo $this->Form->input('new_password', ['type' => 'password', 'label' => 'Password mới']);
            echo $this->Form->input('confirm_password', ['type' => 'password', 'label' => 'Xác nhận password mới']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Cập nhật thông tin'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('Hủy bỏ'), $this->request->referer(), ['class' => 'btn btn-danger']) ?>
    <?= $this->Form->end() ?>
</div>
