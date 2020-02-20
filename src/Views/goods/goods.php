<!--<h2>--><?// echo $all_goods[0]['category']?><!--</h2>-->
<form name="goods" class="goods">
<div class="catalog">

   <?php foreach($all_goods as $position):?>
    <div>
        <div class="photoAndTitle">
            <a href="/category/<? echo $position['category'];?>/<? echo $position['idgood']; ?>">
            <img src="/static/img/<?php echo $position['photo'];?>">
            </a>
            <h3><? echo $position['title']; ?></h3>
        </div>
<!--            <h3>--><?// echo $article['text']; ?><!--</h3>-->
        <div class="priceAndBuy">
            <p><? echo $position['price']; ?></p>
            <input type="image" src="/static/img/buyButton.jpg" class="buyButton" name="<?php echo $position['idgood']?>">
        </div>
    </div>
   <? endforeach; ?>
</div>
</form>
<script src="/static/js/goods.js"></script>
