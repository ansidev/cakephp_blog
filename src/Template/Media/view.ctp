<div class="media">
    <h2><?= h($media->title) ?></h2>

    <div class="row">
        <div class="col-md-12">
            <h6 class="lead"><?= __('Url') ?></h6>

            <p><?= $this->Media->url($media->relative_path) ?></p>
            <h6 class="lead"><?= __('Tên tập tin') ?></h6>

            <p><?= h($media->file_name) ?></p>
        </div>
        <div class="col-md-6">
            <h6 class="lead"><?= __('Tiêu đề') ?></h6>

            <p><?= h($media->title) ?></p>
            <h6 class="lead"><?= __('Slug') ?></h6>

            <p><?= h($media->slug) ?></p>
            <h6 class="lead"><?= __('Description') ?></h6>
            <?= json_decode($media->description, true)['description']; ?>
            <!--            <h6 class="lead">--><?php //echo __('Media Type') ?><!--</h6>-->
            <!--            <p>--><?php //echo $this->Number->format($media->media_type) ?><!--</p>-->
            <!--            <h6 class="lead">--><?php //echo __('Status') ?><!--</h6>-->
            <!--            <p>--><?php //echo $this->Number->format($media->status) ?><!--</p>-->
        </div>
        <div class="col-md-6">
            <h6 class="lead"><?= __('Upload bởi') ?></h6>

            <p><?= $media->has('user') ? $this->Html->link($this->UserInfo->getUserInfo($media->user->id, ['username'])['username'], ['controller' => 'Users', 'action' => 'view', $media->user->id]) : '' ?></p>
            <h6 class="lead"><?= __('Upload lúc') ?></h6>

            <p><?= h($media->created_at) ?></p>
            <h6 class="lead"><?= __('Chỉnh sửa lần cuối') ?></h6>

            <p><?= h($media->updated_at) ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h6 class="lead"><?= __('Image') ?> <?= $this->Html->link(__('Sửa thông tin'), ['controller' => 'Media', 'action' => 'edit', $this->Number->format($media->id)], ['class' => 'btn btn-primary']); ?></h6>
            <img class="img-responsive"
                 src="<?= $this->Media->url($media->relative_path) ?>" width="100%"
                 id="img-<?= h($media->slug) ?>">
        </div>
    </div>
</div>
