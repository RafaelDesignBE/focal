var emailCheck =  /^(?:[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/;
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