let modal = document.querySelector("#modal"),
    closeButton = document.querySelector("#close-button"),
    openButton = document.querySelector("#open-button");

closeButton.addEventListener("click", function() {
    modal.classList.toggle("closed");

});

openButton.addEventListener("click", function() {
    modal.classList.toggle("closed");

});