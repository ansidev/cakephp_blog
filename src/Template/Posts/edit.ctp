<?= $this->Html->script('ckeditor/ckeditor') ?>
<?= $this->Html->script(['blog/post', 'blog/write']) ?>
<div class="posts form  large-10 medium-9 columns">
    <?= $this->Form->create($post); ?>
    <fieldset>
        <legend><?= __('Chỉnh sửa bài viết: ' . $post->title) ?></legend>
        <?= $this->Form->input('title', ['label' => 'Tiêu đề bài viết']); ?>
        <?= $this->Form->input('slug', ['label' => 'Slug']); ?>
        <?= $this->Form->input('body', ['label' => 'Nội dung bài viết', 'type' => 'textarea', 'class' => 'ckeditor', 'rows' => '10', 'cols' => '30']); ?>
        <?= $this->Form->button(__('Ảnh từ thư viện'), ['id' => 'img-box-btn', 'type' => 'button', 'class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#image-box', 'style' => 'margin-bottom: 10px']) ?>
        <?= $this->Form->input('categories._ids', ['label' => 'Chủ đề', 'multiple' => 'checkbox', 'options' => $categories]); ?>
        <?= $this->Form->input('tags._ids', ['label' => 'Tag', 'multiple' => 'checkbox', 'options' => $tags]); ?>
    </fieldset>
    <?= $this->Form->button(__('Chỉnh sửa bài viết'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>

</div>
<?php
$image_box = $this->requestAction('/media', ['display' => false]);
echo $this->element('modal', ['id' => 'image-box', 'modal_body' => $image_box]);
?>
<script>
    $(document).ready(function () {
        if (!$('#slug').val()) {
            autoSlug($('#title').val());
        }
    });
</script>
