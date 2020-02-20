
<form class="account">

<fieldset>
    <legend>Личный кабинет</legend>
    <?php $login=$_SESSION['login'] ?>
    <h1>Добро пожаловать,<?php echo $login;?></h1>
    <a href="/account/orders">Заказы</a>
</fieldset>

</form>



