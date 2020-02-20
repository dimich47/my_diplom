console.log("Вход выполнен в js");
let form = document.forms.reg;

const SUCCESS = "РЕГИСТРАЦИЯ ПРОШЛА УСПЕШНО";
const  ERROR = "Регистрация прошла с ошибками";
const USER_EXISTS = 'Пользователь с таким логином существует!';

let elem = document.getElementById("error");

form.addEventListener('submit',sendRequest);

function responseHandler(response) {

    if(response == SUCCESS)
    {
      window.location.replace("/account");
    }

    else if(response== ERROR){
       elem.innerText = ERROR;
    }
    else if(response== USER_EXISTS){
        elem.innerText = USER_EXISTS;
    }
}

function sendRequest(event)
{
    event.preventDefault();

    // валидация данных
    // делай сам

    let data = new FormData(this);
    let request = new XMLHttpRequest();
    request.open("POST", "/registration",true);
    request.send(data);
    request.onload= function () {

        if(request.status===200){
console.log(request.responseText);
           responseHandler(request.responseText);

        }
    }
}