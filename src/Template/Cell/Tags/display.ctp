<div class="well">
    <h4>Tag</h4>

    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
                <?php foreach ($tags as $tag): ?>
                    <li>
                        <?= $this->Html->link(__($tag->name), ['controller' => 'Tags', 'action' => 'view', $tag->id]) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
