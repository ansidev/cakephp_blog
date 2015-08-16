<div id="categories">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý chủ đề</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Danh sách chủ đề
                </div>
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <?php if (!empty($categories)) { ?>
                            <table class="table table-striped table-bordered table-hover" id="category-table">
                                <thead>
                                <tr>
                                    <th><?= __('ID') ?></th>
                                    <th><?= __('Chủ đề') ?></th>
                                    <th><?= __('Slug') ?></th>
                                    <th><?= __('Parent') ?></th>
                                    <th><?= __('Ngày tạo') ?></th>
                                    <th><?= __('Cập nhật lần cuối') ?></th>
                                    <th class="actions"><?= __('Hành động') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($categories as $category): ?>
                                    <tr>
                                        <td><?= $this->Number->format($category->id) ?></td>
                                        <td><?= h($category->name) ?></td>
                                        <td><?= h($category->slug) ?></td>
                                        <td><?= h($category->parent_category['name']) ?></td>
                                        <td><?= h($category->created_at) ?></td>
                                        <td><?= h($category->updated_at) ?></td>
                                        <td class="actions">
                                            <?= $this->Html->link(__('Xem'), ['action' => 'view', $category->id]) ?>
                                            <?= $this->Html->link(__('Sửa'), ['action' => 'edit', $category->id]) ?>
                                            <?= $this->Form->postLink(__('Xóa'), ['action' => 'delete', $category->id], ['confirm' => __('Bạn co muốn xóa chủ đề # {0}?', $category->id)]) ?>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Js->dataTable('#category-table') ?>
