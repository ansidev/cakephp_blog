<h3 class="row">Kết quả tìm kiếm cho <strong><?= $keyword; ?></strong></h3>
<?php if ($results) { ?>
    <div class="posts index large-10 medium-9 columns">
        <?php foreach ($results as $post) {
            echo $this->element('Posts/post', ['post' => $post]);
        } ?>
    </div>
    <!-- Pagination -->
    <!--    <nav class="paginator">-->
    <!--        <ul class="pagination">-->
    <?php //echo $this->Paginator->prev('< ' . __('Trước')) ?>
    <?php //echo $this->Paginator->numbers() ?>
    <?php //echo $this->Paginator->next(__('Sau') . ' >') ?>
    <!--        </ul>-->
    <!--    </nav>-->
<?php } else {
    echo 'Không tìm thấy kết quả. Trở lại ' . $this->Html->link(__('trang chủ'), '/', ['escape' => false]) . '.';
} ?>
