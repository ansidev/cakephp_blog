<div id="comments">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý chủ đề</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách chủ đề
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="category-table">
                            <thead>
                            <tr>
                                <th><?= __('ID') ?></th>
                                <th><?= __('Name') ?></th>
                                <th><?= __('Slug') ?></th>
                                <th><?= __('Parent') ?></th>
                                <th><?= __('Ngày tạo') ?></th>
                                <th><?= __('Ngày cập nhật cuối') ?></th>
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
                                    <td><?= $this->Time->format($category->created_at, 'dd/MM/y HH:mm:ss') ?></td>
                                    <td><?= $this->Time->format($category->updated_at, 'dd/MM/y HH:mm:ss') ?></td>
                                    <td class="actions">
                                        <div class="dropdown">
                                            <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"
                                                    aria-haspopup="true" aria-expanded="false">Hành động <span
                                                    class="caret"></span></button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                                aria-labelledby="dLabel">
                                                <li><?= $this->Html->link(__('Xem'), ['controller' => 'Categories', 'action' => 'view', $category->id]) ?></li>
                                                <li><?= $this->Html->link(__('Sửa'), ['controller' => 'Categories', 'action' => 'edit', $category->id]) ?></li>
                                                <li><?= $this->Form->postLink(__('Xóa'), ['controller' => 'Categories', 'action' => 'delete', $category->id], ['confirm' => __('Bạn có muốn xóa vĩnh viễn chủ đề #{0} không?', $category->id)]) ?></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<?php echo $this->Html->script('data-tables.table-tools.js') ?>
<?php echo $this->Html->css('data-tables.table-tools.css') ?>
<script>
    $(document).ready(function () {
        $('#category-table').DataTable({
            responsive: true,
            dom: 'T<"clear">lfrtip',
            tableTools: {
                "sRowSelect": "multi",
                "aButtons": ["select_all", "select_none"]
            }
        });

    });
</script>
