const user={
    username:"simplekid",
    password:"simplekid123"
}

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
const form = document.querySelector('form')
form.addEventListener('submit', (e) =>{
    e.preventDefault();
    if(checkCurrentPassword()&&checkNewPassword()&&checkConfirmPassword()){
        user['password']=c_password.value.trim();
    }
})

function checkCurrentPassword(){
    const currentPasswordValue = o_password.value.trim();

    if(currentPasswordValue === ''){
        setErrorFor(o_password,'Password cannot be blank');
        return false;
    }else if(currentPasswordValue!== user['password']){
        setErrorFor(o_password,'Different password');
        return false;
    }else{
        setSuccessFor(o_password);
        return true;
    }
}

function checkNewPassword(){
    const newPasswordValue = n_password.value.trim();

    if(newPasswordValue === ''){
        setErrorFor(n_password,'Password cannot be blank');
        return false;
    }else if(newPasswordValue.length < 8){
        setErrorFor(n_password,'Password must more than 8 characters');
        return false;
    }else{
        setSuccessFor(n_password);
        return true;
    }
}

function checkConfirmPassword(){
    const newPasswordValue = n_password.value.trim();
    const cPasswordValue = c_password.value.trim();

    if(cPasswordValue === ''){
        setErrorFor(c_password,'Password cannot be blank');
        return false;
    }else if(newPasswordValue!== cPasswordValue){
        setErrorFor(c_password,'Different password');
        return false;
    }else{
        setSuccessFor(c_password);
        return true;
    }
}

function setErrorFor(input, message){
    const form_type = input.parentElement;
    const small = form_type.querySelector('small');
    small.innerText = message;
    form_type.className = 'valid_section error';
}

function setSuccessFor(input){
    const form_type = input.parentElement;
    const small = form_type.querySelector('small');
    small.innerText = '';
    form_type.className = 'valid_section success';
}

function clear(){
    const form_type = input.parentElement;
    const small = form_type.querySelector('small');
    small.innerText = '';
    form_type.className = '';
}