<?php echo $this->Html->script(['ckeditor/ckeditor', 'ckeditor/config']); ?>
<?= $this->Html->script(['blog/post', 'blog/write']) ?>
<div class="posts form  large-10 medium-9 columns">
    <?= $this->Form->create($post); ?>
    <fieldset>
        <legend><?= __('Chỉnh sửa bài viết: ' . $post->title) ?></legend>
        <?= $this->Form->input('title', ['label' => 'Tiêu đề bài viết', 'id' => 'post-title']); ?>
        <?= $this->Form->input('slug', ['label' => 'Slug', 'id' => 'post-slug']); ?>
        <?= $this->Form->input('body', ['label' => 'Nội dung bài viết', 'type' => 'textarea', 'class' => 'ckeditor', 'rows' => '10', 'cols' => '30']); ?>
        <?php //echo $this->Form->button(__('Ảnh từ thư viện'), ['id' => 'img-box-btn', 'type' => 'button', 'class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#image-box', 'style' => 'margin-bottom: 10px']) ?>
        <?= $this->Form->input('thumbnail_url', ['type' => 'text', 'id' => 'thumbnail-url']); ?>
        <?= $this->Form->input('file', ['label' => 'Ảnh minh họa', 'type' => 'file', 'id' => 'file']); ?>
        <?= $this->Form->input('categories._ids', ['label' => 'Chủ đề', 'multiple' => 'checkbox', 'options' => $categories]); ?>
        <?= $this->Form->input('tags._ids', ['label' => 'Tag', 'multiple' => 'checkbox', 'options' => $tags]); ?>
        <?= $this->Form->input('pinned', ['label' => 'Hiển thị trong slider']); ?>
    </fieldset>
    <?= $this->Form->button(__('Chỉnh sửa bài viết'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>

</div>
<?= $this->Html->script('fileinput/fileinput'); ?>
<?= $this->Html->css('fileinput'); ?>
<script>
    $('#file').fileinput({
        "uploadUrl": "/media/upload/",
        "uploadAsync": true,
        "showUpload": true,
        "showPreview": true,
        "showRemove": false,
        "maxFileCount": 1,
        "uploadExtraData": function () {
            return {
                description: $('#title').val()
            }
        }
    });
    $('#file').on('fileuploaded', function (event, data, previewId, index) {
//        var form = data.form, files = data.files, extra = data.extra,
//            response = data.response, reader = data.reader;
        $('#thumbnail-url').val(data.response.url);
    });
</script>
<?php
$image_box = $this->requestAction('/media', ['display' => false]);
echo $this->element('modal', ['id' => 'image-box', 'modal_body' => $image_box]);
?>
<script>
    $(document).ready(function () {
        if (!$('#post-slug').val()) {
            autoSlug($('#title').val());
        }
    });
</script>
