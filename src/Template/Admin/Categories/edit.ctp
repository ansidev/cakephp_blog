<div id="categories">
    <?= $this->Form->create($category); ?>
    <fieldset>
        <legend><?= __('Sửa thông tin chủ đề') ?></legend>
        <?php
        echo $this->Form->input('name');
        echo $this->Form->input('slug');
        echo $this->Form->input('parent_id', ['options' => $categories, 'empty' => '(none)']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Sửa chủ đề'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
