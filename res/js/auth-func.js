const username = document.querySelector("#name"),
surname = document.querySelector("#surname"),
phone = document.querySelector("#phone");


// Registration perferences
const regLogin = document.querySelector("#reg-login"),
regPassword = document.querySelector("#reg-password");

// Authorizaton perferences
const authLogin = document.querySelector("#auth-login"),
authPassword = document.querySelector("#auth-password");

// Buttons
const regButton = document.querySelector("#reg-button"),
authButton = document.querySelector("#auth-button");

class ProjectServices{
    registration(login, password, name, surname,phone){
        fetch("http://www.tuitjobs.uz/res/php/reg.php",{
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
              },
            body: JSON.stringify({
                login: login, 
                password: password, 
                username: name,
                surname: surname,
                phone: phone,
            })
        }).then((response)=>response.text()).then(data=>{
            console.log(data);
            if(data === "1"){
                localStorage.setItem("login",login);
                localStorage.setItem("password", password);
                window.location.href = "http://www.tuitjobs.uz/user.html";
            }else{
                alert("Sizning malumotlaringzda hatolik bor!");
            }
        })
    }

    authorization(login, password){
        fetch("http://www.tuitjobs.uz/res/php/auth.php",{
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
              },
            body: JSON.stringify({
                login: login, 
                password: password, 
            })
        }).then((response)=>response.text()).then(data=>{
            console.log(data);
            if(data === "1"){
                localStorage.setItem("login",login);
                localStorage.setItem("password", password);
                window.location.href = "http://www.tuitjobs.uz/user.html";
            }else{
                alert("Sizning malumotlaringzda hatolik bor!");
            }
        })
    }
}

const services = new ProjectServices();
authButton.addEventListener("click", ()=>services.authorization(authLogin.value, authPassword.value));