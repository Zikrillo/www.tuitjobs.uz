const username = localStorage.getItem("username"),
profilename = document.querySelector(".header__nav-header"),
logo = document.querySelector(".header__nav-username-logo");

document.addEventListener("DOMContentLoaded", ()=>{
    profilename.innerText = username;
    logo.innerText = username.split(" ")[0][0].toUpperCase() + username.split(" ")[1][0].toUpperCase();
})