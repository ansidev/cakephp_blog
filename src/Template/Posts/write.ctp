<?= $this->Html->script('ckeditor/ckeditor'); ?>
<?= $this->Html->script('blog/post') ?>
<div class="posts form  large-10 medium-9 columns">
    <?= $this->Form->create($post); ?>
    <fieldset>
        <legend><?= __('Viết bài mới') ?></legend>
        <?= $this->Form->input('title', ['label' => 'Tiêu đề bài viết']); ?>
        <?= $this->Form->input('slug', ['label' => 'Slug']); ?>
        <?= $this->Form->input('body', ['label' => 'Nội dung bài viết', 'type' => 'textarea', 'class' => 'ckeditor', 'rows' => '10', 'cols' => '30']); ?>
        <?= $this->Form->input('categories._ids', ['label' => 'Chủ đề', 'multiple' => 'checkbox', 'options' => $categories]); ?>
        <?= $this->Form->input('tags._ids', ['label' => 'Tag', 'multiple' => 'checkbox', 'options' => $tags]); ?>
    </fieldset>
    <?= $this->Form->button(__('Đăng bài'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>

</div>
