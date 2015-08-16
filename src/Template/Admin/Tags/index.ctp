<div id="tags">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý tags</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Danh sách tag
                </div>
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <?php if (!empty($tags)) { ?>
                            <table class="table table-striped table-bordered table-hover" id="tag-table">
                                <thead>
                                <tr>
                                    <th><?= __('ID') ?></th>
                                    <th><?= __('Tag') ?></th>
                                    <th><?= __('Slug') ?></th>
                                    <th><?= __('Ngày tạo') ?></th>
                                    <th><?= __('Cập nhật lần cuối') ?></th>
                                    <th class="actions"><?= __('Hành động') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($tags as $tag): ?>
                                    <tr>
                                        <td><?= $this->Number->format($tag->id) ?></td>
                                        <td><?= h($tag->name) ?></td>
                                        <td><?= h($tag->slug) ?></td>
                                        <td><?= h($tag->created_at) ?></td>
                                        <td><?= h($tag->updated_at) ?></td>
                                        <td class="actions">
                                            <?= $this->Html->link(__('View'), ['action' => 'view', $tag->id]) ?>
                                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tag->id]) ?>
                                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tag->id)]) ?>
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
<?= $this->Js->dataTable('#tag-table') ?>
