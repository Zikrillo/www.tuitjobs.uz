const sendButton = document.querySelector("#vacancy-header-block__button");
const login = localStorage.getItem("login");
const password = localStorage.getItem("password");




sendButton.addEventListener("click", () => {
    const obj = {
        login: login,
        password: password,
        header: "header",
        comment: "comment",
        salary: "salary"
    }
    fetch("http://www.tuitjobs.uz/res/php/query.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(obj)
    }).then((response) => response.text()).then((response) => alert(response))
    console.log(obj);
})

document.addEventListener("DOMContentLoaded", ()=>{

        const obj = {
            login: login,
            password: password,
            header: "header",
            comment: "comment",
            salary: "salary"
        }
        fetch("http://www.tuitjobs.uz/res/php/getlist.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obj)
        }).then((response) => response.text()).then((response) => 
        {
            document.querySelector(".resonse-list__vacancy").innerHTML = response;
            
        })
        

})