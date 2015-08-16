<div class="media">
    <?= $this->Form->create($media); ?>
    <fieldset>
        <legend><?= __('Sửa thông tin') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('slug');
            echo $this->Form->input('description', ['class' => 'form-control', 'value' => $this->Media->getDescription($media['id'])]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Cập nhật thông tin'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
