<div class="comments form large-10 medium-9 columns">
    <?= $this->Form->create($comment); ?>
    <fieldset>
        <legend><?= __('Add Comment') ?></legend>
        <?php
            echo $this->Form->input('body');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('post_id', ['options' => $posts]);
            echo $this->Form->input('status');
            echo $this->Form->input('created_at');
            echo $this->Form->input('updated_at');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
