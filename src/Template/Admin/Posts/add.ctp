<div class="posts form  large-10 medium-9 columns">
    <?= $this->Form->create($post); ?>
    <fieldset>
        <legend><?= __('Tạo bài viết mới') ?></legend>
        <?php
        echo $this->Form->input('parent_id');
        echo $this->Form->input('user_id', ['options' => $users]);
        echo $this->Form->input('title', ['label' => 'Tiêu đề bài viết']);
        echo $this->Form->input('slug', ['label' => 'Slug']);
        echo $this->Form->input('body', ['label' => 'Nội dung bài viết', 'type' => 'textarea', 'id' => 'body', 'class' => 'ckeditor', 'rows' => '10', 'cols' => '30']);
        echo $this->Form->input('created_at');
        echo $this->Form->input('updated_at');
        echo $this->Form->input('categories._ids', ['label' => 'Chủ đề', 'options' => $categories]);
        echo $this->Form->input('tags._ids', ['label' => 'Tag', 'options' => $tags]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Chỉnh sửa bài viết'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>

</div>
<?= $this->Html->script('ckeditor/ckeditor'); ?>;
