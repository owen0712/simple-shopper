function showCurrentPassword(){
    let x = document.querySelector("#current_password")
    let y = document.querySelector("#hide1")
    let z = document.querySelector("#hide2")
    
    if(x.type === 'password'){
        x.type = "text";
        y.style.display = "block";
        z.style.display = "none";
    }
    else{
        x.type = "password";
        y.style.display = "none";
        z.style.display = "block";
    }
}

function showNewPassword(){
    let x = document.querySelector("#new_password")
    let y = document.querySelector("#hide3")
    let z = document.querySelector("#hide4")
    
    if(x.type === 'password'){
        x.type = "text";
        y.style.display = "block";
        z.style.display = "none";
    }
    else{
        x.type = "password";
        y.style.display = "none";
        z.style.display = "block";
    }
}

function showConfirmPassword(){
    let x = document.querySelector("#confirm_password")
    let y = document.querySelector("#hide5")
    let z = document.querySelector("#hide6")
    
    if(x.type === 'password'){
        x.type = "text";
        y.style.display = "block";
        z.style.display = "none";
    }
    else{
        x.type = "password";
        y.style.display = "none";
        z.style.display = "block";
    }
}

const o_password = document.querySelector('#current_password')
const n_password = document.querySelector('#new_password')
const c_password = document.querySelector('#confirm_password')

function checkCurrentPassword(){
    const currentPasswordValue = o_password.value.trim();
    if(currentPasswordValue === ''){
        setErrorFor(o_password,'Password cannot be blank',"-20px");
        return false;
    }
    else{
        setSuccessFor(o_password,"-20px");
        return true;
    }
}

function checkNewPassword(){
    const newPasswordValue = n_password.value.trim();
    var reg=/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/
    if(newPasswordValue === ''){
        setErrorFor(n_password,'Password cannot be blank',"-20px");
        return false;
    }else if(!reg.test(newPasswordValue)){
        setErrorFor(n_password,'Password must have minimum eight characters, at least one capital letter, one number and one special character',"-40px");
        return false;
    }else{
        setSuccessFor(n_password,"-20px");
        return true;
    }
}

function checkConfirmPassword(){
    const newPasswordValue = n_password.value.trim();
    const cPasswordValue = c_password.value.trim();
    if(cPasswordValue === ''){
        setErrorFor(c_password,'Password cannot be blank',"-20px");
        return false;
    }else if(newPasswordValue!== cPasswordValue){
        setErrorFor(c_password,'Different password',"-20px");
        return false;
    }else{
        setSuccessFor(c_password,"-20px");
        return true;
    }
}

function setErrorFor(input, message,size){
    const form_type = input.parentElement;
    const small = form_type.querySelector('small');
    small.innerText = message;
    small.style.bottom=size;
    form_type.className = 'valid_section error';
}

function setSuccessFor(input,size){
    const form_type = input.parentElement;
    const small = form_type.querySelector('small');
    small.innerText = '';
    small.style.bottom=size;
    form_type.className = 'valid_section success';
}