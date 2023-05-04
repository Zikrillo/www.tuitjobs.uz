const
    username = localStorage.getItem("username"),
    profilename = document.querySelector(".header__nav-header"),
    logo = document.querySelector(".header__nav-username-logo"),
    login = localStorage.getItem("login"),
    password = localStorage.getItem("password");

document.addEventListener("DOMContentLoaded", () => {
    logo.innerText = username?.split(" ")[0][0].toUpperCase() + username?.split(" ")[1][0].toUpperCase();
    profilename.innerText = username;
    fetch("./res/php/getlistforuser.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
    }).then((response) => response.text()).then((response) => {
        document.querySelector(".main__vacancy-list").innerHTML = response;
        document.querySelectorAll(".main__vacancy-apply").forEach(e => {
            e.addEventListener("click", r => {
                fetch("./res/php/apply.php", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        login: login,
                        password: password,
                        id: e.id
                    })
                }).then(response => response.text()).then(response => {
                    alert(response);
                })
            })
        })
    })
})
