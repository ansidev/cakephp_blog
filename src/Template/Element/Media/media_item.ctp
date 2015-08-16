<a href="<?= $this->Url->build(['controller' => 'Media', 'action' => 'view', $media->id]); ?>" id="<?= h($media->slug) ?>">
    <div class="brick">
        <div class="info">
<!--            <input class="checkbox" type="checkbox" id="cb---><?php //echo h($media->slug) ?><!--">-->
        </div>

        <img class="img-responsive"
             src="<?= $this->Media->url($media->relative_path) ?>" width="100%"
             id="img-<?= h($media->slug) ?>">

        <div class="info">
            <h3><?= h($media->title) ?></h3>
            <h5><?php echo json_decode($media->description, true)['description'] ?></h5>
        </div>
    </div>
</a>
