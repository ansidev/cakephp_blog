<div class="row">
    <div class="col-md-12">
        <div id="<?= 'post-' . $post->id ?>" class="post">
            <h2>
                <?= $this->Html->link(__($post->title), $this->Url->build(['_name' => 'post-read', 'slug' => $post->slug, 'id' => $post->id]), ['escape' => false, 'title' => $post->title]) ?>
            </h2>

            <p>
                <span class="glyphicon glyphicon-user"></span> Đăng
                bởi <?php echo $this->UserInfo->getUserInfo($post->user_id, ['username'])->username; ?>
                <?php //echo $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]); ?>
                | <span
                    class="glyphicon glyphicon-time"></span> <?= $this->Time->format($post->created_at, 'dd/MM/y HH:mm') ?>
                | <span class="fa fa-comment"></span>
                <?= $this->Html->link(
                    $this->Post->getCommentsCount($post->id) . ' bình luận',
                    $this->Url->build(['_name' => 'post-read', 'slug' => $post->slug, 'id' => $post->id, '#' => 'comment-box']),
                    ['title' => $post->title]
                ); ?>

            </p>
            <hr>
            <?php echo $this->Post->getThumbnailImage($post->id, $post->thumbnail_url); ?>
            <hr>
            <?php
            if (!empty($truncate) && $truncate) {
                echo $this->Content->echoShortText($post->body);
            } else {
                echo($post->body);
            }
            ?>
            <?php
            if (empty($no_display)) {
                $no_display = false;
            }
            if (!$no_display) {
                echo $this->Html->link(__('Xem thêm <span class="glyphicon glyphicon-chevron-right"></span>'), $this->Url->build(['_name' => 'post-read', 'slug' => $post->slug, 'id' => $post->id]), ['class' => 'btn btn-primary', 'escape' => false]);
            } ?>
            <hr>
            <div style="border-left: 5px solid #286090; padding: 2px 5px">
                Chủ đề: <?= $this->Post->getCategories($post->id); ?>
            </div>
            <div style="border-left: 5px solid #d9534f; padding: 2px 5px">
                Tag: <?= $this->Post->getTags($post->id); ?>
            </div>
            <hr>
        </div>
    </div>
</div>
