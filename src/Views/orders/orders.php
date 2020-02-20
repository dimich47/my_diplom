<form class="myOrders">
<h2>Мои заказы</h2>
<div class="#">

    <?php if(count($idBaskets)!=0): ?>
    <?php for($j=0;$j<count($idBaskets);$j++):?>
    <table id="tableBasket">
        <tbody>
        <div class="orders">
            <h3>Заказ №<? echo $idBaskets[$j]['idbasket']; ?></h3>
        </div>
        <tr>
            <th>Артикул</th>
            <th>Наименование</th>
            <th>Количество</th>
            <th>Цена</th>
        </tr>
            <?php for($i=0;$i<count($all_goods[$j]);$i++):?>
            <tr>

                <td><? echo $all_goods[$j][$i]['goods_idgood']; ?></td>
                <td><? echo $all_goods[$j][$i]['title']; ?></td>
                <td><? echo $all_goods[$j][$i]['quantitygoods']; ?></td>
                <td><? echo $all_goods[$j][$i]['pricegoods']; ?></td>

            </tr>
            <?php endfor; ?>
   <? endfor; ?>
<? endif; ?>
        </tbody>
    </table>
</div>
</form>