const pswrdField = document.querySelector(".form .field input[type='password']"),
    togglgeBtn = document.querySelector(".form .field i");

togglgeBtn.onclick = ()=>{
    if(pswrdField.type == "password"){
        pswrdField.type = "text";
        togglgeBtn.classList.add("active");
    }else{
        pswrdField.type = "password";
        togglgeBtn.classList.remove("active");
    }
}