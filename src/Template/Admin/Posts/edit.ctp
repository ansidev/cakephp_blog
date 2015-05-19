<?= $this->Html->script('ckeditor/ckeditor') ?>
<?= $this->Html->script('blog/post') ?>
<div class="posts">
    <?= $this->Form->create($post); ?>
    <fieldset>
        <legend><?= __('Chỉnh sửa bài viết: ' . $post->title) ?></legend>
        <?= $this->Form->input('title', ['label' => 'Tiêu đề bài viết']); ?>
        <?= $this->Form->input('slug', ['label' => 'Slug']); ?>
        <?= $this->Form->input('body', ['label' => 'Nội dung bài viết', 'type' => 'textarea', 'class' => 'ckeditor', 'rows' => '10', 'cols' => '30']); ?>
        <?= $this->Form->input('categories._ids', ['label' => 'Chủ đề', 'multiple' => 'checkbox', 'options' => $categories]); ?>
        <?= $this->Form->input('tags._ids', ['label' => 'Tag', 'multiple' => 'checkbox', 'options' => $tags]); ?>
        <?= $this->Form->input('status', ['label' => 'Trạng thái', 'class' => 'col-md-3', 'options' => $this->Post->getStatuses(), 'value' => $post->status]); ?>
    </fieldset>
    <?= $this->Form->button(__('Chỉnh sửa bài viết'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>

</div>
<script>
    $(document).ready(function () {
        console.log('Loaded');
        if (!$('#slug').val()) {
            autoSlug($('#title').val());
        }
        ;
    });
</script>
