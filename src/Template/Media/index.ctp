<div id="media">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý bài viết</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách bài viết
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table cellpadding="0" cellspacing="0"
                               class="table table-striped table-bordered table-hover" id="media-table">
                            <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('id') ?></th>
                                <th><?= $this->Paginator->sort('user_id') ?></th>
                                <th><?= $this->Paginator->sort('title') ?></th>
                                <th><?= $this->Paginator->sort('slug') ?></th>
                                <th><?= $this->Paginator->sort('file_name') ?></th>
                                <th><?= $this->Paginator->sort('media_type') ?></th>
                                <th><?= $this->Paginator->sort('status') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($media as $media): ?>
                                <tr>
                                    <td><?= $this->Number->format($media->id) ?></td>
                                    <td>
                                        <?= $media->has('user') ? $this->Html->link($media->user->id, ['controller' => 'Users', 'action' => 'view', $media->user->id]) : '' ?>
                                    </td>
                                    <td><?= h($media->title) ?></td>
                                    <td><?= h($media->slug) ?></td>
                                    <td><?= h($media->file_name) ?></td>
                                    <td><?= $this->Number->format($media->media_type) ?></td>
                                    <td><?= $this->Number->format($media->status) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['action' => 'view', $media->id]) ?>
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $media->id]) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $media->id], ['confirm' => __('Are you sure you want to delete # {0}?', $media->id)]) ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Js->dataTable('#media-table', ['responsive' => true]) ?>
