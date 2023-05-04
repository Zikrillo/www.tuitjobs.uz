const sendButton = document.querySelector("#vacancy-header-block__button");
const login = localStorage.getItem("login");
const password = localStorage.getItem("password");
const 
    username = localStorage.getItem("username"),
    profilename = document.querySelector(".header__nav-header"),
    logo = document.querySelector(".header__nav-username-logo");

fetch("./res/php/response.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
    }).then((response) => response.text()).then((response) => console.log(response))

sendButton.addEventListener("click", () => {
    const header = document.querySelector("#header").value;
    const comment = document.querySelector("#subheader").value;
    const salary = document.querySelector("#salary").value;

    const obj = {
        login: login,
        password: password,
        header: header,
        comment: comment,
        salary: salary
    }
    fetch("./res/php/query.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(obj)
    }).then((response) => response.text()).then((response) => alert(response))
})

document.addEventListener("DOMContentLoaded", ()=>{
        logo.innerText = username?.split(" ")[0][0].toUpperCase() + username?.split(" ")[1][0].toUpperCase();
        profilename.innerText = username;
        const obj = {
            login: login,
            password: password,
            header: "header",
            comment: "comment",
            salary: "salary"
        }
        fetch("./res/php/getlist.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        }).then((response) => response.text()).then((response) => 
        {
            document.querySelector(".resonse-list__vacancy").innerHTML = response;
            document.querySelectorAll(".response-list__vacancy-item").forEach(e=>{
                e.addEventListener("click", r=>{
                    console.log(e.id);
                    document.querySelector(".response-list__vacancy-responsed-user-list").innerHTML = "";
                    fetch("./res/php/response.php", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({id: e.id})
                    }).then(response1=>response1.text()).then(response2=>{
                        document.querySelector(".response-list__vacancy-responsed-user-list").innerHTML = response2;
                    })
                })
            })
        })
        

})