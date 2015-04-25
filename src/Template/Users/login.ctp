<!-- File: src/Template/Users/login.ctp -->

<div class="users form">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Login') ?></legend>
        <?= $this->Flash->render('auth') ?>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
    <?= $this->Form->button(__('Login'), ['class' => 'btn btn-primary']); ?>
    <?= $this->Form->end() ?>
</div>
