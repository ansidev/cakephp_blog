<!-- File: src/Template/Users/login.ctp -->

<div class="users form">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Đăng nhập') ?></legend>
        <?= $this->Flash->render() ?>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
    <?= $this->Form->button(__('Đăng nhập'), ['class' => 'btn btn-primary']); ?>
    <?= $this->Form->end() ?>
</div>
