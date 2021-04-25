const form = document.getElementById('form');
const name1 = document.getElementById('name1');
const name2 = document.getElementById('name2');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');
const email = document.getElementById('email');
const phone = document.getElementById('phone');
const birth = document.getElementById('birthdaytime');
const gender = document.querySelector('#gender')//added by jl

form.addEventListener('submit', (e) =>{
    e.preventDefault();

    checkInputs();
})

function checkInputs(){
    // get the values from the inputs
    const name1Value = name1.value.trim();
    const name2Value = name2.value.trim();
    const passwordValue = password.value.trim();
    const password2Value = password2.value.trim();
    const emailValue = email.value.trim();
    const phoneValue = phone.value.trim();
    const birthValue = birth.value.trim();
    const genderValue = gender.value //added by jl
    
    if(name1Value === ''){
        // show error
        // add error class
        setErrorFor(name1, 'First name cannot be blank');
    }else{
        // add success class
        setSuccessFor(name1);
    }

    if(name2Value === ''){
        // show error
        // add error class
        setErrorFor(name2, 'Last name cannot be blank');
    }else{
        // add success class
        setSuccessFor(name2);
    }


    if(emailValue === ''){
        setErrorFor(email, 'Email cannot be blank');
    }else if(!isEmail(emailValue)){
        setErrorFor(email, 'Email is not valid');
    }else{
        setSuccessFor(email);
    }

    if(passwordValue === ''){
        setErrorFor(password, 'Password cannot be blank');
    }
    else if(passwordValue.length>15){
        setErrorFor(password, 'Password length cannot exceed 15 characters')
    }
    else if(passwordValue.length < 8){
        setErrorFor(password, 'Password must at least 8 characters long');
    }else{
        setSuccessFor(password)
    }

    if(password2Value === ''){
        setErrorFor(password2, 'Password cannot be blank');
    }else if(password2Value.length >15){
        setErrorFor(password2, 'Password length cannot exceed 15 characters')
    }
    else if(password2Value.length < 8){
        setErrorFor(password2, 'Password must at least 8 characters long');
    }else if(passwordValue !== password2Value){
        setErrorFor(password2, 'Passwords does not match');
    }
    else{
        setSuccessFor(password2)
    }

    if(phoneValue === ''){
        setErrorFor(phone, 'Phone number cannot be blank');
    }else{
        setSuccessFor(phone)
    }

    if(!Date.parse(birthValue)){
        setErrorForDate(birth, 'Birthday cannot be blank');
    }
    //modified by jl
    if(name1Value !=='' && name2Value !== '' && passwordValue !== '' && password2Value !== '' &&
        emailValue !== '' && phoneValue !== '' && birthValue !== ''){
	    if(signUp(name2Value+name1Value,emailValue,phoneValue,password2Value,birthValue,genderValue)){
            swal("Sign Up Success", "Please go to login page", "success");
            setTimeout(function(){window.location.href='signin.html'}, 1000);
        }
        else{
            swal("User existed", "Please register using other email and phone number", "error");
        }
    }
}

//two function added by jl
function signUp(name,email,phone,password,dob,gender){
    const users=JSON.parse(localStorage.getItem('users')||[]);
    var new_user={
        password:password,
        status:'user',
        name:name,
        email:email,
        phone:phone,
        gender:gender,
        dob:dob,
        addressesArr:[]
    }
    var exist=false;
    if(!checkExistUser(email,phone,users)){
        users.push(new_user)
        localStorage.setItem('users',JSON.stringify(users));
        return true
    }
    else{
        return false;
    }
    
}

function checkExistUser(email,phone,users){
    for(var user of users){
        if(user['email']===email||user['phone']===phone){
            return true;
        }
        return false;
    }
}


function setErrorFor(input, message){
    const col_md_3 = input.parentElement; //col-md-3
    const small = col_md_3.querySelector('small');

    // add error message inside small
    small.innerText = message;

    // add error class
    col_md_3.className = 'col-md-3 mb-3 error';
}

function setErrorForDate(input, message){
    const col_md_2 = input.parentElement; 
    const small = col_md_2.querySelector('small');

    // add error message inside small
    small.innerText = message;

    // add error class
    col_md_2.className = 'col-md-2 error';
}

function setSuccessFor(input){
    const col_md_3 = input.parentElement; //col-md-3
    col_md_3.className = 'col-md-3 mb-3 success';
}

function linkToLoginPage(){
    window.location.href = "signin.html"
}

function isEmail(email){
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}