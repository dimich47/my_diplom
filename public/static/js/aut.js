console.log("Вход выполнен в js");
let form = document.forms.authorisation;

const SUCCESS = "Авторизация администратора прошла успешно";
const SUCCESS1 = "Авторизация пользователя прошла успешно";
const BASKET = "В корзине есть товары";
const  ERROR = "Ошибка авторизации";

form.addEventListener('submit',sendRequest);

function responseHandler(response) {

    if(response == SUCCESS)
    {
        window.location.replace("admin/account");
    }
    else if(response == SUCCESS1)
    {
        window.location.replace("/account");

    }
    else if(response == BASKET)
    {
        window.location.replace("/account/basket");

    }
    else if(response== ERROR){

       let elem = document.getElementById("error");
       elem.innerText = ERROR;
    }
    else {
        console.log("Неизвестный код");
    }
}

function sendRequest(event)
{
    event.preventDefault();

    // валидация данных
    // делай сам
    let data = new FormData(this);
    let request = new XMLHttpRequest();
    request.open("POST", "/authorisation",true);
    request.send(data);
    request.onload= function () {

        if(request.status===200){

            responseHandler(request.responseText);

        }
    }
}