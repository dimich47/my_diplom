let description=document.getElementById("description");
let specification=document.getElementById("specification");
let shipping=document.getElementById("shipping");
let tbody = document.getElementById('tab1').getElementsByTagName('TBODY')[0];
let list = document.getElementById('list');
let quantity=document.getElementById('quantity');
let buyButton=document.getElementById('buy');
let detaliProductForm=document.forms.detaliProduct;

const SUCCESS = "Товары добавлены в корзину";

description.addEventListener('click',descriptionFun);
specification.addEventListener('click',specificationFun);
buyButton.addEventListener('click',buyProduct);

if(quantity.innerHTML==="Товар закончился")
{
    buyButton.classList.add('notActive');
    buyButton.setAttribute("disabled",true);
}


window.onload= descriptionLoad();

function descriptionLoad() {

    description.classList.add('selected');
    specification.classList.remove('selected');
    shipping.classList.remove('selected');

    let adr = description.getAttribute('href');
    let request = new XMLHttpRequest();
    request.open("GET", adr,true);
    request.send(null);

    request.onload= function ()
    {
        if (request.status === 200)
        {
            let arr= JSON.parse(request.responseText);
            // console.log(arr);
            let arr2= JSON.parse(arr["text"]);
            // console.log(arr2);

            list.innerHTML="";
            tbody.innerHTML="";
            for(let i=0;i<arr2['1'].length;i++)
            {
                let li = document.createElement("LI");
                li.innerHTML = arr2['1'][i];
                list.appendChild(li);
            }
        }
    }
}
function descriptionFun(event)
{
    event.preventDefault();
    descriptionLoad();
}
function specificationFun(event)
{
    event.preventDefault();
    specification.classList.add('selected');
    description.classList.remove('selected');
    shipping.classList.remove('selected');

    let adr = specification.getAttribute('href');
    let request = new XMLHttpRequest();
    request.open("GET", adr,true);
    request.send(null);

    request.onload= function () {
        if(request.status===200){
            console.log(request.responseText);

            let arr= JSON.parse(request.responseText);
            console.log(arr);
            let arr2= JSON.parse(arr["text"]);
            console.log(arr2);

            tbody.innerHTML="";
            list.innerHTML="";


            for(let i=0;i<arr2['1'].length-1;i++)
            {
                // Создаем строку таблицы и добавляем ее
                let row = document.createElement("TR");
                tbody.appendChild(row);

                // Создаем ячейки в вышесозданной строке
                // и добавляем тх
                let td1 = document.createElement("TD");
                let td2 = document.createElement("TD");

                row.appendChild(td1);
                row.appendChild(td2);

                // Наполняем ячейки

                td1.innerHTML = arr2['1'][i];
                td2.innerHTML = arr2['1'][i+1];
                i++;
            }
        }
    }
}
function basketOk(request){
    if(request === SUCCESS)
    {
        window.location.replace("/account/basket");
    }
    else
    {
        console.log("сервер не сформировал корзину");
    }
}
function  buyProduct(event){

    let data = new FormData(detaliProductForm);
    let url = "/buy"+document.location.pathname;

    // data.append('price',document.getElementById('price').innerHTML);
    // data.append('title',document.getElementById('title').innerHTML);
    let request = new XMLHttpRequest();
    request.open("POST", url,true);
    request.send(null);
    request.onload= function () {

        if(request.status===200){
            console.log(request);
            basketOk(request.responseText);
        }
    }
}




