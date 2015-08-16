<div class="categories form">
    <?= $this->Form->create($category); ?>
    <fieldset>
        <legend><?= __('Thêm chủ đề mới') ?></legend>
        <?php
        echo $this->Form->input('name', ['label' => 'Chủ đề']);
        echo $this->Form->input('slug');
        echo $this->Form->input('parent_id', ['options' => $categories, 'empty' => '(none)']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
<?= $this->Html->script('blog/category'); ?>
