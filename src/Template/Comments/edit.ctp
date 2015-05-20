<div id="comments">
    <?= $this->Form->create($comment); ?>
    <fieldset>
        <legend><?= __('Sửa bình luận') ?></legend>
        <?php
            echo $this->Form->input('body', ['type' => 'textarea', 'class' => 'form-control', 'rows' => '10', 'cols' => '30']);
            echo $this->Form->input('status', ['label' => 'Trạng thái', 'options' => $this->Comment->getStatuses(), 'value' => $comment->status]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Cập nhật'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('Hủy bỏ'), $this->request->referer(), ['class' => 'btn btn-danger']) ?>
    <?= $this->Form->end() ?>
</div>
