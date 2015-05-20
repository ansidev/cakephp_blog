<div class="posts index large-10 medium-9 columns">
    <?php foreach ($posts as $post) {
        echo $this->element('Posts/post', ['post' => $post]);
    } ?>
</div>
<!-- Pagination -->
<nav class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('Trước')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('Sau') . ' >') ?>
    </ul>
</nav>
