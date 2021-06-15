const form = document.getElementById('form');
const name1 = document.getElementById('name1');
const name2 = document.getElementById('name2');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');
const email = document.getElementById('email');
const phone = document.getElementById('phone');
const birth = document.getElementById('birthdaytime');
const gender = document.querySelector('#gender')

form.addEventListener('change'/*'submit'*/, (e) =>{
    //e.preventDefault();

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
    const genderValue = gender.value

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

    //check the email format
    if(emailValue === ''){
        setErrorFor(email, 'Email cannot be blank');
    }else if(!isEmail(emailValue)){
        setErrorFor(email, 'Email is not valid');
    }else{
        setSuccessFor(email);
    }

    var reg=/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/
    //check the password format
    if(passwordValue === ''){
        setErrorFor(password, 'Password cannot be blank');
    }
    else if(!reg.test(passwordValue)){
        setErrorForPassword(password, 'Must have minimum eight characters, at least one capital letter, one number and one special character',"-53px");
    }else{
        setSuccessFor(password)
    }

    //check the confirm password whether correct or not
    if(password2Value === ''){
        setErrorFor(password2, 'Password cannot be blank');
    }
    else if(!reg.test(password2Value)){
        setErrorForPassword(password2, 'Must have minimum eight characters, at least one capital letter, one number and one special character',"-53px");
    }else if(passwordValue !== password2Value){
        setErrorForPassword(password2, 'Passwords does not match',"-20px");
    }
    else{
        setSuccessFor(password2)
    }


    // check the phone number format correct or not
    if(phoneValue === ''){
        setErrorFor(phone, 'Phone number cannot be blank');
    }else if(!validatePhoneNumber(phoneValue)){
        setErrorFor(phone, 'Phone number not valid');
    }
    else{
        setSuccessFor(phone)
    }
}

// set new class for error. If got error, then add class named error into the class name
function setErrorFor(input, message){
    const col_md_3 = input.parentElement; //col-md-3
    const small = col_md_3.querySelector('small'); // access the small tag

    // add error message inside small
    small.innerText = message;

    // add error class    (new class name)
    col_md_3.className = 'col-md-3 mb-3 error';
}

// set new class for success. If got success, then add class named success into the class name
function setSuccessFor(input){
    const col_md_3 = input.parentElement; //col-md-3
    // set the success class  (new class name)
    col_md_3.className = 'col-md-3 mb-3 success';
}

//check the email format input by user is correct or not
function isEmail(email){
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

//check the phone number format input by user is correct or not
function validatePhoneNumber(input_str) {
    var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;

    return re.test(input_str);
}

function setErrorForPassword(input, message,size){
    const form_type = input.parentElement;
    const small = form_type.querySelector('small');
    small.innerText = message;
    small.style.bottom=size;
    form_type.className = 'col-md-3 mb-3 error';
}