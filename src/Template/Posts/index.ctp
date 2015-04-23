<div id="posts">
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
                        <table class="table table-striped table-bordered table-hover" id="post-table">
                            <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('id') ?></th>
                                <th><?= $this->Paginator->sort('title') ?></th>
                                <th><?= $this->Paginator->sort('category', 'Chủ đề') ?></th>
                                <th><?= $this->Paginator->sort('tag') ?></th>
                                <th><?= $this->Paginator->sort('comment') ?></th>
                                <th><?= $this->Paginator->sort('status') ?></th>
                                <th><?= $this->Paginator->sort('created_at') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($posts as $post): ?>
                                <tr>
                                    <td><?= $this->Number->format($post->id) ?></td>
                                    <td><?= h($post->title) ?></td>
                                    <td>
                                        <?php if ($post->has('categories')) {
                                            $categories = array();
                                            foreach ($post->categories as $category) {
                                                $categories[] = $this->Html->link($category->name, ['controller' => 'Categories', 'action' => 'view', $category->id]);
                                            }
                                            echo implode(', ', $categories);
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($post->has('tags')) {
                                            $tags = array();
                                            foreach ($post->tags as $tag) {
                                                $tags[] = strtolower($this->Html->link($tag->name, ['controller' => 'Tags', 'action' => 'view', $tag->id]));
                                            }
                                            echo implode(', ', $tags);
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($post->has('comments')) {
                                            echo count($post->comments);
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                    <td><?= $this->Post->statusToString($post->status) ?></td>
                                    <td><?= h($post->created_at) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['action' => 'view', $post->id], ['class' => 'btn btn-primary']) ?>
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $post->id], ['class' => 'btn btn-success']) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $post->id], ['class' => 'btn btn-danger', 'confirm' => __('Bạn có muốn xóa bài viết {0}?', $post->title)]) ?>
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
<!-- /#users -->
<?= $this->Js->dataTable('#post-table', ['responsive' => true]) ?>
