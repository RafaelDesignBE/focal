var emailCheck =  /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
document.getElementById('email').addEventListener('keyup', function(event) {
    if(emailCheck.test(this.value)){
        this.classList.remove("error");
        this.classList.add("good");
    } else {
        this.classList.remove("good");
        this.classList.add("error");
    }
    
});

document.getElementById('password').addEventListener('keyup', function(event) {
    if(this.value.length > 7){
        this.classList.remove("error");
        this.classList.add("good");
    } else {
        this.classList.remove("good");
        this.classList.add("error");

        document.getElementById('password_repeat').classList.remove("good");
        document.getElementById('password_repeat').classList.add("error");
    }
    
});

document.getElementById('password_repeat').addEventListener('keyup', function(event) {
    if(document.getElementById('password').value.length > 7 && this.value == document.getElementById('password').value){
        this.classList.remove("error");
        this.classList.add("good");
    } else {
        this.classList.remove("good");
        this.classList.add("error");
    }
    
});