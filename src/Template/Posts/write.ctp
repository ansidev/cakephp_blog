<?= $this->Html->script('ckeditor/ckeditor'); ?>
<?= $this->Html->script(['blog/post', 'blog/write']) ?>
<div class="posts form  large-10 medium-9 columns">
    <?= $this->Form->create($post); ?>
    <fieldset>
        <legend><?= __('Viết bài mới') ?></legend>
        <?= $this->Form->input('title', ['label' => 'Tiêu đề bài viết', 'id' => 'post-title']); ?>
        <?= $this->Form->input('slug', ['label' => 'Slug', 'id' => 'post-slug']); ?>
        <?= $this->Form->input('body', ['label' => 'Nội dung bài viết', 'type' => 'textarea', 'class' => 'ckeditor', 'rows' => '10', 'cols' => '30']); ?>
        <?= $this->Form->button(__('Ảnh từ thư viện'), ['id' => 'img-box-btn', 'type' => 'button', 'class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#image-box', 'style' => 'margin-bottom: 10px']) ?>
        <?= $this->Form->input('categories._ids', ['label' => 'Chủ đề', 'multiple' => 'checkbox', 'options' => $categories]); ?>
        <?= $this->Form->input('tags._ids', ['label' => 'Tag', 'multiple' => 'checkbox', 'options' => $tags]); ?>
    </fieldset>
    <?= $this->Form->button(__('Đăng bài'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
<?php
$image_box = $this->requestAction('/media', ['display' => false]);
echo $this->element('modal', ['id' => 'image-box', 'modal_body' => $image_box]);
?>
