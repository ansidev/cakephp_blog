<script>
    jQuery(window).load(function () {
        jQuery("#nivoslider").nivoSlider({
            effect: "random",
            slices: 15,
            boxCols: 8,
            boxRows: 4,
            animSpeed: 500,
            pauseTime: 3000,
            startSlide: 0,
            directionNav: true,
            controlNav: true,
            controlNavThumbs: false,
            pauseOnHover: true,
            manualAdvance: false
        });
    });
</script>
<div class="row theme-default">
    <?= $this->Html->script('jquery.nivo.slider'); ?>
    <?= $this->Html->script('blog/home-page'); ?>
    <?= $this->Html->css('nivo-slider'); ?>
    <?= $this->Html->css('nivo-slider-default'); ?>
    <div id="nivoslider" class="nivoSlider">
        <img src="http://demo.dev7studios.com/nivo-slider/files/2013/02/5896103449_fa2c7a168d_b.jpg" alt=""/>
        <img src="http://demo.dev7studios.com/nivo-slider/files/2013/02/03037_liverpool_1920x1080.jpg" alt=""/>
        <img src="http://demo.dev7studios.com/nivo-slider/files/2013/02/3928848343_42443ae67d_o.jpg" alt=""/>
        <img src="http://demo.dev7studios.com/nivo-slider/files/2013/02/4207529693_d4f03f6dd7_o.jpg" alt=""/>
    </div>
    <!--#slider-->
    <div id='caption_1' class='nivo-html-caption'><a href='#'>
            <div class='slide-title'>Skating through the Roads</div>
        </a>

        <div class='slide-description'>This theme uses the Nivo Slider and supports heading and taglines.</div>
    </div>
    <div id='caption_2' class='nivo-html-caption'><a href=''>
            <div class='slide-title'>I am using Dark Slider Images</div>
        </a>

        <div class='slide-description'>Images are grayscaled. But you can use colored ones too.</div>
    </div>
</div>
</div>
