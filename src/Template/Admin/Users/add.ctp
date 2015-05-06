<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($user); ?>
    <fieldset>
        <legend><?= __('Thêm người dùng mới') ?></legend>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('email');
            echo $this->Form->input('full_name');
            echo $this->Form->input('password');
            echo $this->Form->input('role_id', ['options' => $roles]);
            echo $this->Form->input('created_at', ['type' => 'hidden']);
            echo $this->Form->input('updated_at', ['type' => 'hidden']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
