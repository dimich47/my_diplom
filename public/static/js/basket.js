const SUCCESS = "Заказ сформирован";
const ERROR = "Ошибка, заказ не сформирован";
const CANCEL = "Заказ отменен";
let form=document.forms.basket;


let table=document.getElementById("table");
let title=document.getElementById("title");
let price=document.getElementById("price");
let status=document.getElementById("status");
let buttonOrder=document.getElementById('order');
let buttonOrderCancel=document.getElementById('orderCancel');


form.addEventListener('submit',buy);
buttonOrderCancel.addEventListener('click',orderCancel);

console.log(table.rows.length);
if(!table.rows.length)
{
    console.log("таблица пуста");
    status.innerText="Корзина пуста";
    buttonOrder.classList.add("disabled");
}
else{
    status.innerText="";
}
function order(request){
    if(request === SUCCESS)
    {
        //window.location.replace("/account/basket");
        console.log(SUCCESS);
        status.innerText=request;
        buttonOrder.setAttribute("disabled",true);
    }
    else if(request === ERROR)
    {
        console.log(ERROR);
    }
    else
    {
        console.log("Нетзвестная ошибка. сервер не сформировал заказ");
    }
}
function buy(event){
    event.preventDefault();
    let data = new FormData(form);
    //data.append('idgoods', idGoods.innerText);
    //data.append('price', price.innerText);
    //data.append('title', title.innerText);
    let request = new XMLHttpRequest();
    request.open("POST", "/order",true);
    request.send(data);
    request.onload= function () {

        if(request.status===200){
           console.log(request.responseText);
            order(request.responseText);
        }
    }
}

function Cancel(request){
    if(request === CANCEL)
    {
        //window.location.replace("/account/basket");
      //  console.log(CANCEL);
        status.innerText=request;
        buttonOrder.setAttribute("disabled",true);
    }

    else
    {
        console.log("Нетзвестная ошибка. сервер не сформировал заказ");
    }
}
function orderCancel(event){
    let request = new XMLHttpRequest();
    request.open("GET", "/order/cancel",true);
    request.send(null);
    request.onload= function () {

        if(request.status===200){
         //   console.log(request.responseText);
            Cancel(request.responseText);
        }
    }
}



// let description=document.getElementById("description");
// let specification=document.getElementById("specification");
// let shipping=document.getElementById("shipping");
// let tbody = document.getElementById('tab1').getElementsByTagName('TBODY')[0];
// let list = document.getElementById('list');
// let quantity=document.getElementById('quantity');
// let buyButton=document.getElementById('buy');
//
//
//
//
// description.addEventListener('click',descriptionFun);
// specification.addEventListener('click',specificationFun);
// buyButton.addEventListener('click',buyProduct);
//
// if(quantity.innerHTML==="Товар закончился")
// {
//     buyButton.classList.add('notActive');
//     buyButton.setAttribute("disabled",true);
// }
//
//
// window.onload= descriptionLoad();
//
// function descriptionLoad() {
//
//     description.classList.add('selected');
//     specification.classList.remove('selected');
//     shipping.classList.remove('selected');
//
//     let adr = description.getAttribute('href');
//     let request = new XMLHttpRequest();
//     request.open("GET", adr,true);
//     request.send(null);
//
//     request.onload= function ()
//     {
//         if (request.status === 200)
//         {
//             let arr= JSON.parse(request.responseText);
//             // console.log(arr);
//             let arr2= JSON.parse(arr["text"]);
//             // console.log(arr2);
//
//             list.innerHTML="";
//             tbody.innerHTML="";
//             for(let i=0;i<arr2['1'].length;i++)
//             {
//                 let li = document.createElement("LI");
//                 li.innerHTML = arr2['1'][i];
//                 list.appendChild(li);
//             }
//         }
//     }
// }
// function descriptionFun(event)
// {
//     event.preventDefault();
//     descriptionLoad();
// }
// function specificationFun(event)
// {
//     event.preventDefault();
//     specification.classList.add('selected');
//     description.classList.remove('selected');
//     shipping.classList.remove('selected');
//
//     let adr = specification.getAttribute('href');
//     let request = new XMLHttpRequest();
//     request.open("GET", adr,true);
//     request.send(null);
//
//     request.onload= function () {
//         if(request.status===200){
//             console.log(request.responseText);
//
//             let arr= JSON.parse(request.responseText);
//             console.log(arr);
//             let arr2= JSON.parse(arr["text"]);
//             console.log(arr2);
//
//             tbody.innerHTML="";
//             list.innerHTML="";
//
//
//             for(let i=0;i<arr2['1'].length-1;i++)
//             {
//                 // Создаем строку таблицы и добавляем ее
//                 let row = document.createElement("TR");
//                 tbody.appendChild(row);
//
//                 // Создаем ячейки в вышесозданной строке
//                 // и добавляем тх
//                 let td1 = document.createElement("TD");
//                 let td2 = document.createElement("TD");
//
//                 row.appendChild(td1);
//                 row.appendChild(td2);
//
//                 // Наполняем ячейки
//
//                 td1.innerHTML = arr2['1'][i];
//                 td2.innerHTML = arr2['1'][i+1];
//                 i++;
//             }
//         }
//     }
// }
// function basketOk(request){
//     if(request == SUCCESS)
//     {
//         window.location.replace("/account/basket");
//     }
//     else
//     {
//         console.log("сервер не сформировал корзину");
//     }
// }
// function  buyProduct(event){
//
//     let data = new FormData(detaliProductForm);
//     let url = "/buy"+document.location.pathname;
//     // console.log(url);
//     data.append('price',document.getElementById('price').innerHTML);
//     data.append('title',document.getElementById('title').innerHTML);
//     let request = new XMLHttpRequest();
//     request.open("POST", url,true);
//     request.send(data);
//     request.onload= function () {
//
//         if(request.status===200){
//             console.log(request);
//             basketOk(request.responseText);
//         }
//     }
// }
//



