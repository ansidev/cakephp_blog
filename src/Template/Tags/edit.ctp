<div class="tags">
    <?= $this->Form->create($tag); ?>
    <fieldset>
        <legend><?= __('Sửa thông tin Tag') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('slug');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Sửa'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
