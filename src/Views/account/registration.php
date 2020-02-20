


<form method="post" action="/registration" name="reg" class="reg">
    <div>
        <h3>Заполните форму регистрации:</h3>
    </div>
            <div>
                <label for="name">Введите Ваше имя</label>
                <input name="name" type="text" class="#" id="name" placeholder="Имя" autofocus>
            </div>
            <div>
                <label for="phone">Введите Ваш номер телефона</label>
                <input name="phone" type="text" class="#" id="phone" placeholder="8ХХХ-ХХХ-ХХ-ХХ">
            </div>
    <div class="form-group">

        <label for="login">Введите логин</label>
        <input name= "login" type="text" class="form-control" id="login"  placeholder="логин">
    </div>
    <div class="form-group">
        <label for="password">Введите пароль</label>
        <input name= "password" type="text" class="form-control" id="password"  placeholder="пароль">
    </div>
    <div>
        <button type="submit" class="btn btn-primary">Регистрация</button>
        <p id="error"></p>
    </div>

</form>
<script src="/static/js/reg.js"></script>