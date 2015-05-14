<?= $this->Html->script('blog/media') ?>
<div class="media form large-10 medium-9 columns">
    <?= $this->Form->create($media, ['type' => 'file']); ?>
    <fieldset>
        <legend><?= __('Upload Media') ?></legend>
        <?php
        echo $this->Form->input('file', ['type' => 'file', 'required' => true]);
//        echo $this->Form->input('file_name');
        echo $this->Form->input('title', ['required' => true]);
        echo $this->Form->input('slug', ['required' => true]);
        echo $this->Form->input('description', ['type' => 'textarea', 'class' => 'form-control']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Upload'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
