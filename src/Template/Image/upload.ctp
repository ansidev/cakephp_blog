<?= $this->Form->create($users, ['type' => 'file']); ?>
<?= $this->Form->input('avatar', ['type' => 'file']);?>
<?= $this->Form->button(__('Submit')); ?>
<?= $this->Form->end(); ?>