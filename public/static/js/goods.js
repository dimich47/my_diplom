const SUCCESS = "Товары добавлены в корзину";
let form=document.forms.goods;
//let buyButton=document.getElementsByClassName('buyButton');
//buyButton.addEventListener('click',buy);

// $('.buyButton').bind('click', function(){
//     console.log(this.name);
// });


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
$('.buyButton').bind('click', function(){

    let data = new FormData(form);
    let url = "/buy"+document.location.pathname+"/"+this.name;
    console.log(url);

    let request = new XMLHttpRequest();
    request.open("POST", url,true);
    request.send(data);
    request.onload= function () {

        if(request.status===200){
            console.log(request);
            basketOk(request.responseText);
        }
    }
});




