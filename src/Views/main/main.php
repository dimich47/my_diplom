
<div class="slider">
    <?php foreach($all_sliders as $slider):?>
        <div>
            <a href="/category/<? echo $slider['category']; ?>/<? echo $slider['goods_idgood']; ?>"> <img src="/static/img/<?php echo $slider['photo'];?>"> </a>
            <!--текст дб на картинке-->
        </div>
    <? endforeach; ?>


</div>

<main class="container about">
    <div class="flex">
        <img src="/static/img/about.jpg"> </a>
    </div>

    <div class="action flex ">
        <p>АКЦИИ</p>
    </div>

    <section class="article flex flex-1000">
        <?php foreach($all_actions as $action):?>
        <div class="#">
<!--            <h1>--><?// echo $action['title']; ?><!--</h1>-->
            <a href="/action/<? echo $action['idaction']; ?>"> <img src="/static/img/<?php echo $action['photo'];?>"> </a>
            <p> <?echo $action['title'];?> </p>
        </div>

        <? endforeach; ?>
    </section>


    <div class="action flex ">
        <p>ПРОДУКЦИЯ</p>
    </div>


        <div class="production flex ">

                <a href="/category/smartphones" title="Смартфоны"><img src="/static/img/smartphones.jpg"></a>
            <div class="flex flex-column">
                <a href="/category/smart_devices" title="Умные устройства"><img src="/static/img/smartdevices.jpg"></a>
                <a href="/category/audio" title="Аудио"><img src="/static/img/audio.jpg"></a>
            </div>

        </div>

    <div class="news flex ">
        <p>НОВОСТИ</p>
    </div>
    <div class="flex news">
        <img src="/static/img/news.jpg"> </a>
    </div>



</main>

<script src="/static/slick/slick.min.js"></script>
<script>
    $(document).ready(function(){
        $('.slider').slick({
            infinite: true,
            dots: true,
            // adaptiveHeight: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true
        });
    });
</script>