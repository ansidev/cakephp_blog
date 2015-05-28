<style>
    .carousel {
        margin-bottom: 60px;
    }

    /* Since positioning the image, we need to help out the caption */
    .carousel-caption {
        z-index: 1;
    }

    /* Declare heights because of positioning of img element */
    .carousel .item {
        height: 400px;
        background-color: #555;
    }

    .carousel img {
        position: absolute;
        top: 0;
        left: 0;
        min-height: 400px;
    }

    @media (min-width: 768px) {
        /* Bump up size of carousel content */
        .carousel-caption p {
            margin-bottom: 20px;
            font-size: 21px;
            line-height: 1.4;
        }
    }
</style>
<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <?php for ($i = 1; $i < count($posts); $i++): ?>
            <li data-target="#myCarousel" data-slide-to="<?= $i; ?>"></li>
        <?php endfor; ?>
    </ol>
    <div class="carousel-inner">
        <?php
        $first_post = array_shift($posts);
        $options = $this->Post->getCarouselItem($first_post, true);
        echo $this->element('Slider/carousel_item', $options);
        foreach ($posts as $post) {
            $options = $this->Post->getCarouselItem($post, false);
            echo $this->element('Slider/carousel_item', $options);
        } ?>
    </div>
    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
    </a>
</div>
<!-- /.carousel -->
