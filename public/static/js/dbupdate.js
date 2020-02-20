console.log("Вход выполнен в js");

let form = document.forms.goods;
let form2 = document.forms.actions;
let form3 = document.forms.showDataGoods;
let form4 = document.forms.showDataAction;
let formSlider = document.forms.slider;
let form6 = document.forms.showDataSlider;

let check = document.getElementById("check");
let elem = document.getElementById("error");
// let errorSlider = document.getElementById("errorSlider");
let del = document.getElementById("deleteButton");
let change = document.getElementById("changeButton");
let cancel = document.getElementById("cancelButton");

let delAction = document.getElementById("deleteAction");
let delSlider = document.getElementById("deleteSlider");

// let actions = document.getElementsByClassName("actions");

let flag=0;
let name_title = "1";
let value_title = "2";
let id_title = "3";
let myEvent;

const ERROR = 'Ошибка внесения данных в базу данных';
const SUCCESS = 'Данные успешно внесены в базу данных';
const GOODS = 'Товары';
const ACTIONS = 'Акции';
const SLIDER= 'Слайдер';

form.addEventListener('submit',updateDB.bind(form,GOODS));
form2.addEventListener('submit',updateDB.bind(form2,ACTIONS));
formSlider.addEventListener('submit',updateDB.bind(formSlider,SLIDER));
form3.addEventListener('submit',changeRequest);

del.addEventListener('click',delSelectPosition.bind(form3,GOODS));
check.addEventListener('dblclick',checkRequest);
cancel.addEventListener('click',cancelRequest);

delAction.addEventListener('click',delSelectPosition.bind(form4,ACTIONS));
delSlider.addEventListener('click',delSelectPosition.bind(form6,SLIDER));


// <?php echo $_SESSION['Page']; ?>.addList("active");

// actions.classList.add("active");




function responseHandler(response, category) {

    if(response === SUCCESS)
    {
        location.reload();
    }
    else if(response === ERROR){
       elem.innerText = ERROR;
    }
    else {
        console.log("Неизвестный код: ",response.responseText);
    }
}

function updateDB(category,event)
{
    event.preventDefault();
    elem.innerText = "";

    // валидация данных
    // делай сам
    let data = new FormData(this);
    data.append('data',category);

    if(category===GOODS) {
        let text = '{"1":[' + data.get('text') + ']}';
        let text2= '{"1":['+data.get('text2')+']}';
        data.append('textJSON', text.replace(/\r?\n/g, " "));
        data.append('textJSON2',text2.replace(/\r?\n/g, " "));
    }
    let request = new XMLHttpRequest();
    request.open("POST", "/admin/account",true);
    request.send(data);
    request.onload= function () {

        if(request.status===200){
            console.log(request.responseText);
            responseHandler(request.responseText);
        }
    }
}
function delSelectPosition(category,event)
{

    elem.innerText = "";
    // валидация данных
    // делай сам

    let data = new FormData(this);
    data.append('category',category);
    let request = new XMLHttpRequest();
    request.open("POST", "/account/dbDelData",true);


    request.send(data);
    request.onload= function () {

        if(request.status===200){
            console.log(request);
            responseHandler(request.responseText);
        }
    }
}

function checkRequest(event) {



  //  console.log("Поле: ",event.target.name);
   // console.log("Данные: ",event.target.value);
   // console.log("ID: ",event.target.parentNode.firstElementChild.value);
    if(event.target.parentNode.firstElementChild.checked) {
        console.log("flag",flag);

        if (!flag) {
            event.target.removeAttribute("disabled");
            change.removeAttribute("disabled");
            flag = 1;
            myEvent=event;
        }
    }
}

function changeRequest(event)
{
    event.preventDefault();
    // валидация данных
    // делай сам
    flag = 0;
    name_title = myEvent.target.name;
    value_title = myEvent.target.value;
    id_title = myEvent.target.parentNode.firstElementChild.value;



    let data2 = new FormData(form3);
    data2.append('id',id_title);
    data2.append('name',name_title);
    data2.append('value',value_title);

    console.log(data2.get('name'));


    let request2 = new XMLHttpRequest();
    request2.open("POST", "/account/dbUpdate",true);
    request2.send(data2);
    request2.onload= function () {

        if(request2.status===200){
            responseHandler(request2.responseText);
        }
   }
}

function cancelRequest() {
    location.reload();

}

