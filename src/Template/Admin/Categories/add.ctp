<?php echo $this->Html->script(['blog/add']) ?>
<div id="categories">
    <?= $this->Form->create($category); ?>
    <fieldset>
        <legend><?= __('Thêm chủ đề mới') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('slug');
            echo $this->Form->input('parent_id', ['options' => $categories, 'empty' => '(none)']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Thêm chủ đề'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
