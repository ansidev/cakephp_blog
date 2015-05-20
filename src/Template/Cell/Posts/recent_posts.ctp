<div class="well">
    <h4>Bài viết gần đây</h4>

    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
                <?php foreach ($recent_posts as $post): ?>
                    <li>
                        <?= $this->Html->link(__($post->title), $this->Url->build(['_name' => 'post-read', 'slug' => $post->slug, 'id' => $post->id])) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
