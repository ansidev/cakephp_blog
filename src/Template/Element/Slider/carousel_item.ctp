<?php if (!empty($active) && $active == true) {
    $active = 'active';
} else {
    $active = '';
} ?>
<!-- Carousel Item -->
<div class="item <?= $active; ?>">
    <img src="<?php echo $thumbnail_url; ?>" style="width:100%" class="img-responsive">

    <div class="container">
        <div class="carousel-caption">
            <h1><?php echo $title; ?></h1>

            <p><?php echo $body; ?></p>

            <p><a class="btn btn-lg btn-primary" href="<?php echo $post_url; ?>">Xem thêm</a>
            </p>
        </div>
    </div>
</div>
<!-- End Carousel Item -->
