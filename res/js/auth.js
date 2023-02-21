const regform = document.querySelector(".regform");
const authform = document.querySelector(".authform");
const link = document.querySelectorAll(".link");
link.forEach((e)=>{
    e.onclick = ()=>{
        regform.classList.toggle("d-none");
        authform.classList.toggle("d-none");
    }
});