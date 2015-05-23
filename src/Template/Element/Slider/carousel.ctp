<?php $carousel = [1,2,3];?>
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
        <?php for ($i = 1; $i <= count($carousel); $i++): ?>
            <li data-target="#myCarousel" data-slide-to="<?= $i; ?>"></li>
        <?php endfor; ?>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <img src="http://demo.dev7studios.com/nivo-slider/files/2013/02/5896103449_fa2c7a168d_b.jpg"
                 style="width:100%" class="img-responsive">

            <div class="container">
                <div class="carousel-caption">
                    <h1>Bootstrap 3 Carousel Layout</h1>

                    <p>Hello, world</p>

                    <p><a class="btn btn-lg btn-primary" href="http://getbootstrap.com">Learn More</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="http://demo.dev7studios.com/nivo-slider/files/2013/02/03037_liverpool_1920x1080.jpg"
                 class="img-responsive">

            <div class="container">
                <div class="carousel-caption">
                    <h1>Changes to the Grid</h1>

                    <p>Bootstrap 3 still features a 12-column grid, but many of the CSS class names have completely
                        changed.</p>

                    <p><a class="btn btn-large btn-primary" href="#">Learn more</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="http://placehold.it/1500X500" class="img-responsive">

            <div class="container">
                <div class="carousel-caption">
                    <h1>Percentage-based sizing</h1>

                    <p>With "mobile-first" there is now only one percentage-based grid.</p>

                    <p><a class="btn btn-large btn-primary" href="#">Browse gallery</a></p>
                </div>
            </div>
        </div>
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
