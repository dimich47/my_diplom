<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <title><?php echo $data['title'];?></title>
</head>
<body>

</body>
</html>
<form name="basket" class="basket">

    <h2>Подтвердите Ваш заказ:</h2>

    <table  id="tableBasket">
        <tbody>
            <tr>
                <th>Артикул</th>
                <th>Наименование</th>
                <th>Количество</th>
                <th>Цена</th>
            </tr>
            <?php for($i=0;$i<count($_SESSION['idgoods'],COUNT_RECURSIVE);$i++):?>
            <tr>
<!--                <td id="idGoods">--><?php //echo $_SESSION['idgoods'];?><!--</td>-->
<!--                <td id="title">--><?php //echo $_SESSION['title'];?><!--</td>-->
<!--                <td id="price">--><?php //echo $_SESSION['price'];?><!--</td>-->

                    <td ><?php echo $_SESSION['idgoods'][$i]?></td>
                    <td ><?php echo $_SESSION['title'][$i]?></td>
                    <td>

                        <input type="text" value="1" name="quantity[]">

                    </td>
                    <td ><?php echo $_SESSION['price'][$i]?></td>
            </tr>
            <? endfor; ?>
        </tbody>
    </table>
    <br>
    <h2 id="status"></h2>
    <input type="submit" value="Подтвердить заказ" id="order">
    <input type="button" value="Отменить заказ" id="orderCancel">
    <a href="/"><input type="button" value="Вернуться к покупкам"></a>

</form>
<script src="/static/js/basket.js"></script>


