<div class="well">
    <h4>Chủ đề</h4>

    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
                <?php foreach ($categories as $category): ?>
                    <li>
                        <?= $this->Html->link(__($category->name), ['controller' => 'Categories', 'action' => 'view', $category->id]) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
