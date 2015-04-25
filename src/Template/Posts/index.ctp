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
                                <th><?= __('ID') ?></th>
                                <th><?= __('Tiêu đề') ?></th>
                                <th><?= __('Chủ đề') ?></th>
                                <th><?= __('Tag') ?></th>
                                <th><?= __('Bình luận') ?></th>
                                <th><?= __('Trạng thái') ?></th>
                                <th><?= __('Ngày tạo') ?></th>
                                <th class="actions"><?= __('Hành động') ?></th>
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
                                        <div class="dropdown">
                                            <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="false">Hành động <span class="caret"></span></button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dLabel">
                                                <li><?= $this->Html->link(__('Xem'), ['action' => 'view', $post->id]) ?></li>
                                                <li><?= $this->Html->link(__('Sửa'), ['action' => 'edit', $post->id]) ?></li>
                                                <li><?= $this->Form->postLink(__('Xóa'), ['action' => 'delete', $post->id], ['confirm' => __('Bạn có muốn xóa bài viết {0}?', $post->title)]) ?></li>
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
<!-- /#users -->
<?= $this->Js->dataTable('#post-table', ['responsive' => true]) ?>
