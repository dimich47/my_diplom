<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> <?php echo $page_title; ?></title>
    <link rel="stylesheet" href="/static/css/style.css">
    <link rel="stylesheet" href="/static/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/static/slick/slick-theme.css"/>
    <script type="text/javascript" src="/static/js/jquery-3.4.1.min.js"></script>
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
</head>
<body>
<header>
    <div class="contacts ">
        <div class="container flex flex-center">

            <div class="logo flex-1">
                <a href="/"> <img src="/static/img/logo.jpg"> </a>
            </div>

            <div class="flex-8 flex">
                <p class="region">Санкт-Петербург</p>
                <p class="phones">8 812 700 777 000</p>

                <div class="sign flex">

                        <?php if(!isset($_SESSION['login']) && !isset($_SESSION['admin'])): ?>
                        <a  href="/authorisation" id="open-button" class="open-button">Войти</a>
                        <a  href="/registration">Регистрация</a>

                        <?php else: ?>
                        <a  href="/account">Личный кабинет</a>
                        <a  href="/outAccount">Выйти</a>
                        <?php endif ?>
                </div>
            </div>

            <div class="basketLogo flex-1">
                <?php if(!$_SESSION['idgoods']):?>
                    <a href="/account/basket"> <img src="/static/img/basket.jpg"> </a>
                <?php else: ?>
                    <a href="/account/basket"> <img src="/static/img/basketFull.jpg"> </a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</header>





<nav class="flex container">
    <a href="/category/smartphones">Смартфоны</a>
    <a href="/category/smart_devices">Умные устройства</a>
    <a href="audio">Аудио</a>
<!--    <a href="accessories">Аксессуары</a>-->
<!--    <a href="other">Другое</a>-->
</nav>


<section class="container">
    <? include_once $content; ?>
</section>



<!--<script type="text/javascript">-->
<!--    if (window.jQuery) alert("jQuery подключен");-->
<!--    else alert("jQuery не подключен");-->
<!--</script>-->
<footer>Footer</footer>

</body>
</html>