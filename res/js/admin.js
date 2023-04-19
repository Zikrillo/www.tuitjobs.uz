const sendButton = document.querySelector("#vacancy-header-block__button");
const login = localStorage.getItem("login");
const password = localStorage.getItem("password");


fetch("http://www.tuitjobs.uz/res/php/response.php", {
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
    fetch("http://www.tuitjobs.uz/res/php/query.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(obj)
    }).then((response) => response.text()).then((response) => alert(response))
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
            document.querySelectorAll(".response-list__vacancy-item").forEach(e=>{
                e.addEventListener("click", r=>{
                    console.log(e.id);
                    document.querySelector(".response-list__vacancy-responsed-user-list").innerHTML = "";
                    fetch("http://www.tuitjobs.uz/res/php/response.php", {
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