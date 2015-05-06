<div class="posts form  large-10 medium-9 columns">
    <?= $this->Form->create($post); ?>
    <fieldset>
        <legend><?= __('Chỉnh sửa bài viết: ' . $post->title) ?></legend>
        <?= $this->Form->input('title', ['label' => 'Tiêu đề bài viết']); ?>
        <?= $this->Form->input('slug', ['label' => 'Slug']); ?>
        <?= $this->Form->input('textarea', ['label' => 'Nội dung bài viết', 'type' => 'textarea', 'id' => 'body', 'class' => 'ckeditor', 'rows' => '10', 'cols' => '30']); ?>
        <?= $this->Form->input('categories._ids', ['label' => 'Chủ đề', 'options' => $categories]); ?>
        <?= $this->Form->input('tags._ids', ['label' => 'Tag', 'options' => $tags]); ?>
    </fieldset>
    <?= $this->Form->button(__('Chỉnh sửa bài viết'), ['class' => 'btn btn-primary'] ) ?>
    <?= $this->Form->end() ?>

</div>
<?= $this->Html->script('ckeditor/ckeditor'); ?>
