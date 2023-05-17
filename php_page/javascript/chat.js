const form = document.querySelector(".typing-area"),
    inputField = form.querySelector(".input-field"),
    sendBtn = form.querySelector(".button1"),
    chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault(); //запрет на отправку формы
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                console.log("good msg");
                inputField.value = ""; // как только сообщение будет вставлено в базу данных, очищает поле ввода
                scrollToBottom();
            }
        }
    }
    let formData = new FormData(form); //создание formData объекта
    xhr.send(formData); //отправка данных формы в php
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){ //если класс active не содержится в chatBox, прокрутит вниз
                    scrollToBottom();
                }
            }
        }
    }
    let formData = new FormData(form); //создание formData объекта
    xhr.send(formData); //отправка данных формы в php
}, 500); // функция будет запускаться каждые 500млс

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}