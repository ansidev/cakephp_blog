<div class="tags">
    <?= $this->Form->create($tag); ?>
    <fieldset>
        <legend><?= __('Thêm tag mới') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('slug');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Thêm tag'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
<?= $this->MyHtml->script('blog/tag'); ?>
