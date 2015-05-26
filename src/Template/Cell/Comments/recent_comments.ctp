<div class="well" style="border-radius: 0">
<!--    <h4>Bài viết gần đây</h4>-->

    <div class="row">
        <div class="col-lg-12">
            <ul style="padding-top: 5px; padding-left: 20px">
                <?php foreach ($recent_comments as $comment): ?>
                    <li>
                        <?= $this->Html->tag('span', $comment->body) . ' ' . $this->Html->tag('i', '', ['class' => 'glyphicon glyphicon-arrow-right']) . $this->Html->link(__('.'), $this->Url->build(['_name' => 'post-read', 'slug' => $comment->slug, 'id' => $comment->id])) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
