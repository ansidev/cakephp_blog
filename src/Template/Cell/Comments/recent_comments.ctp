<div class="well">
<!--    <h4>Bài viết gần đây</h4>-->

    <div class="row">
        <div class="col-lg-12">
            <ul style="padding-top: 5px; padding-left: 20px">
                <?php foreach ($recent_comments as $comment): ?>
                    <?php $post = $this->Post->get($comment->post_id); ?>
                    <li>
                        <?= $this->Html->tag('span', $comment->body) . ' ' . $this->Html->link(html_entity_decode('&#8594;'), $this->Url->build(['_name' => 'post-read', 'slug' => $post->slug, 'id' => $post->id])) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
