const form = document.querySelector(".singup form"),
    continueBtn = form.querySelector(".button input"),
    errorText = form.querySelector(".error-txt");

form.onsubmit = (e)=>{
    e.preventDefault(); //запрет на отправку формы
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "Ok"){
                    location.href = "users.php";
                }else{
                    errorText.style.display = "block";
                    errorText.textContent = data;
                }
            }
        }
    }
    let formData = new FormData(form); //создание formData объекта
    xhr.send(formData); //отправка данных формы в php
}