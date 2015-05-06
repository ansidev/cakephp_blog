<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($user); ?>
    <fieldset>
        <legend><?= __('Đăng ký tài khoản') ?></legend>
        <?php
            echo $this->Flash->render();
            echo $this->Form->input('username');
            echo $this->Form->input('email');
            echo $this->Form->input('full_name');
            echo $this->Form->input('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Đăng ký'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
