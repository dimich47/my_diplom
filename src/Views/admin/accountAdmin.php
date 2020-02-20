<div class="tabs">

    <ul class="tabs__caption">
        <li class="active">Товары</li>
        <li>Акции</li>
        <li>Слайдер</li>
    </ul>

    <div class="tabs__content active">

        <form name="goods">
            <fieldset> <!-- группировка полей формы -->
                <legend>Добавление товара</legend>

                <fieldset>
                    <legend>Параметры товара</legend>
                    <label for="category">Выберите категорию товара</label>
                    <select id="category" name="category" autofocus>
                        <option value="smartphones">Смартфоны</option>
                        <option value="smart_devices">Умные устройства</option>
                        <option value="audio">Аудио</option>
<!--                        <option value="accessories">Аксессуары</option>-->
<!--                        <option value="other">Другое</option>-->
                    </select>
                    <br>
                    <label for="title">Введите наименование товара</label>
                    <input id="title" name="title" type="text" placeholder="Наименование товара" maxlength="30">
                    <br>
                    <label for="price">Введите цену товара</label>
                    <input id="price" name="price" type="number" min="10" max="500000"  value="0">
                    <br>
                    <label for="quantity">Введите количество товара</label>
                    <input id="quantity" name="quantity" type="number"  min="1" max="10000" value="1">
                    <br>
                </fieldset>

                <fieldset>
                    <legend>Описание товара</legend>
                    <textarea  name="text" cols="100"  rows="10"></textarea>
                    <br>
                    <label for="photo">Загрузите изображение для товара</label>
                    <br>
                    <input type="file" id="photo" name="photo" accept="image/*">
                </fieldset>

                <fieldset>
                    <legend>Характеристики товара</legend>
                    <textarea  name="text2" cols="100"  rows="10"></textarea>
                    <br>
                </fieldset>

                <!--multiple - для загрузки нескольких файлов-->
                <!--accept - указание типа загружаемого файла-->
                <!--readonly - текстовое поле не может быть изменено пользователем-->
                <!--disabled - поле заблокировано-->
                <!--autofocus - фокус на элементе формы-->
                <!--required - поле обязательно для заполнения-->
                <!--minlength/maxlength - минимальное/максимальное количество символов -->
            </fieldset>
            <br>
            <input type="submit" value="Сохранить товар" class="buttonAdmin">
        </form>
        <br>
        <fieldset>

            <form name="showDataGoods">
                <p id="error"></p>
                <div id="check" >
                    <table id="#" width="900px">
                        <thead>
                            <th> </th>
                            <th>idgood</th>
                            <th>title</th>
                            <th>category</th>
                            <th>price</th>
                            <th>quantity</th>
                        </thead>
                        <tbody ></tbody>
                    </table>
                    <?php foreach($all_goods as $goods):?>
                        <div>
                            <input  type="checkbox" name="check[]" value="<? echo $goods['idgood']; ?>" >
                            <input disabled type="text"  name="idgood" value="<? echo $goods['idgood']; ?>" >
                            <input disabled type="text"  name="title" value="<? echo $goods['title']; ?>" >
                            <input disabled type="text"  name="category" value="<?php echo $goods['category']; ?>">
                            <input disabled type="text"  name="price" value="<?php echo $goods['price']; ?>">
                            <input disabled type="text"  name="quantity" value="<?php echo $goods['quantity']; ?>">
                        </div>
                    <? endforeach; ?>
                </div>
                <br>
                <input type="button" id="deleteButton" value="Удалить" >
                <input type="submit"  id="changeButton" value="Изменить" disabled>
                <input type="button"  id="cancelButton" value="Отменить">
                <br>
                <br>
            </form>
        </fieldset>
    </div>

    <div class="tabs__content">
        <form name="actions">
            <fieldset> <!-- группировка полей формы -->
                <legend>Добавление акций</legend>
                <fieldset>
                    <label for="categoryForAction">Выберите категорию товара</label>
                    <select id="categoryForAction" name="categoryForAction" autofocus>
                        <option value="smartphones">Смартфоны</option>
                        <option value="smart_devices">Умные устройства</option>
                        <option value="audio">Аудио</option>
                    </select>
                    <label for="idGoodsForAction">Введите id товара #1</label>
                    <input id="idGoodsForAction" name="idGoodsForAction" type="text" placeholder="id" maxlength="6">
                    <br>
                <label for="actiontitle">Введите наименование акции</label>
                <input id="actiontitle" name="actionTitle" type="text" placeholder="Наименование акции" maxlength="50">
                <br>
                </fieldset>
                <fieldset>
                    <legend>Описание акции</legend>
                    <textarea  name="actionText" cols="100"  rows="10"></textarea>
                    <br>
                    <label for="actionPhoto">Загрузите изображение акции</label>
                    <br>
                    <input type="file" id="actionphoto" name="actionphoto" accept="image/*">
                </fieldset>
            </fieldset>
            <br>
            <input type="submit" value="Сохранить акцию" class="buttonAdmin">
            <br>
            <br>
        </form>
        <fieldset>
        <form name="showDataAction">
            <p id="error2"></p>
            <div id="check2">
                <table id="#" >
                    <thead>
                    <th > </th>
                    <th width="150px">idaction</th>
                    <th width="150px">title</th>
                    <th width="150px">text</th>
                    </thead>
                    <tbody ></tbody>
                </table>
                <?php foreach($all_actions as $action):?>
                    <div>
                        <input  type="checkbox" name="checkAction[]" value="<? echo $action['idaction']; ?>" >
                        <input disabled type="text"  name="idaction" value="<? echo $action['idaction']; ?>" >
                        <input disabled type="text"  name="title" value="<? echo $action['title']; ?>" >
                        <input disabled type="text"  name="text" value="<? echo $action['text']; ?>" >
                    </div>
                <? endforeach; ?>
            </div>
            <br>
            <input type="button" id="deleteAction" value="Удалить" >

            <br>
            <br>
        </form>
        </fieldset>
    </div>


    <div class="tabs__content">
        <form name="slider">
            <fieldset> <!-- группировка полей формы -->
                <legend>Слайдер #1</legend>

                <label for="categoryForSlider">Выберите категорию товара</label>
                <select id="categoryForSlider" name="categoryForSlider" autofocus>
                    <option value="smartphones">Смартфоны</option>
                    <option value="smart_devices">Умные устройства</option>
                    <option value="audio">Аудио</option>
                </select>
                    <label for="idGoodsForSlider">Введите id товара #1</label>
                    <input id="idGoodsForSlider" name="idGoodsForSlider" type="text" placeholder="id" maxlength="6">
                    <br>
                    <label for="photoSlider">Загрузите изображение товара</label>
                    <br>
                    <input type="file" id="photoSlider" name="photoSlider" accept="image/*">
                    <br>
            </fieldset>
            <br>
            <input type="submit" value="Сохранить слайдер" class="buttonAdmin">
            <br>
            <br>
        </form>
        <fieldset>
            <form name="showDataSlider">
                <p id="error3"></p>
                <table id="#" >
                    <thead>
                    <th > </th>
                    <th width="180px">idslider</th>
                    <th width="180px">goods_idgood</th>
                    <th width="180px">category</th>
                    </thead>
                    <tbody ></tbody>
                </table>
                <div id="check3" >
                    <?php foreach($all_sliders as $slider):?>
                        <div>
                            <input  type="checkbox" name="checkSlider[]" value="<? echo $slider['idslider']; ?>" >
                            <input disabled type="text"  name="idslider" value="<? echo $slider['idslider']; ?>" >
                            <input disabled type="text"  name="good_idgood" value="<? echo $slider['goods_idgood']; ?>" >
                            <input disabled type="text"  name="categorySlider" value="<? echo $slider['category']; ?>" >
                        </div>
                    <? endforeach; ?>
                </div>
                <br>
                <input type="button" id="deleteSlider" value="Удалить" >

                <br>
                <br>
            </form>
        </div>

        <br>
   </fieldset>




<script src="/static/js/dbupdate.js"></script>

<script>
    (function($) {
        $(function() {

            $('ul.tabs__caption').on('click', 'li:not(.active)', function() {
                $(this)
                    .addClass('active').siblings().removeClass('active')
                    .closest('div.tabs').find('div.tabs__content').removeClass('active').eq($(this).index()).addClass('active');
            });

        });
    })(jQuery);
</script>