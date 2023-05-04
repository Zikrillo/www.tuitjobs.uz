const arrayOfDropdowns = document.querySelectorAll(".dropdown");
const dropdown = document.querySelector(".dropdown");


// dropdown.children[1].children[0].forEach(e=>{
//     e.addEventListener("click", ()=>{
//         dropdown.children[0].innerText = e.innerText;
//     })
// })
// for (e of dropdown.children[1].children) {
//     e.addEventListener("click", () => {
//         dropdown.children[0].innerText = e.innerText;
//     })
// }
arrayOfDropdowns.forEach(e=>{
    
    e.childNodes[3]?.childNodes?.forEach((r)=>{
        if(r.localName === "p"){
            r.addEventListener("click", ()=>{
                e.childNodes[1].innerText = r.innerText;            
            });
        }
    })
})
