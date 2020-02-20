
<div class="productContainer">
    <div class="headerProduct">
        <h1 id="title"><?php echo $position['title']; ?></h1>
    </div>

    <div class="product">
            <div class="photoProduct">
                <img  src="/static/img/<?php echo $position['photo'];?>">
            </div>

            <form name="detaliProduct" class="detaliProduct">
                <div>
                        <h2 id="price"> <?php echo $position['price']; ?></h2>
                </div>
                <div>
                        <input id="buy" class="buy" type="button" value="Купить">
                </div>
                <div>
                        <?php if($position['quantity']>0): ?>
                            <p id="quantity" class="green">Товар в наличии</p>
                        <?php else: ?>
                            <p id="quantity">Товар закончился</p>
                        <?php endif; ?>
                </div>
            </form>
    </div>

    <div class="fullDescription">
            <a id="description"  href="/ajax/description/<?php echo $position['idgood']; ?>">Описание</a>
            <a id="specification" href="/ajax/specification/<?php echo $position['idgood']; ?>">Характеристики</a>
<!--            <a id="shipping" href="/ajax/shipping/--><?php //echo $position['idgood']; ?><!--">Наличие и доставка</a>-->
    </div>

    <div>
        <table id="tab1" >
            <thead>
<!--            <tr>-->
<!--                <th>Параметр</th>-->
<!--                <th>Значение</th>-->
<!--            </tr>-->
            </thead>
            <tbody ></tbody>
        </table>
    </div>

    <div>
        <ul id="list"></ul>
    </div>

</div>


<script src="/static/js/OneGoods.js"></script>




