const form = document.getElementById('form');
const name1 = document.getElementById('name1');
const name2 = document.getElementById('name2');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');
const email = document.getElementById('email');
const phone = document.getElementById('phone');
const birth = document.getElementById('birthdaytime');
const gender = document.querySelector('#gender')

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

    //check the password format
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

    //check the confirm password whether correct or not
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


    // check the phone number format correct or not
    if(phoneValue === ''){
        setErrorFor(phone, 'Phone number cannot be blank');
    }else if(!validatePhoneNumber(phoneValue)){
        setErrorFor(phone, 'Phone number not valid');
    }
    else{
        setSuccessFor(phone)
    }
    
    //check all condition, whether user had fill up all and in correct format or not?
    if(name1Value !=='' && name2Value !== '' && passwordValue !== '' && password2Value !== '' &&
       emailValue !== '' && phoneValue !== '' && birthValue !== '' && validatePhoneNumber(phoneValue) && isEmail(emailValue) &&
       7 < passwordValue.length < 16 &&  7 < password2Value.length && passwordValue === password2Value){
        if(signUp(name2Value+name1Value,emailValue,phoneValue,password2Value,birthValue,genderValue)){
            //if correct then will pop up sign up success message
            swal("Sign Up Success", "Please go to login page", "success");
        }
        else{
            //if the account already in the local storage then user existed message will be pop up
            swal("User existed", "Please register using other email and phone number", "error");
        }
    }
}


function signUp(name,email,phone,password,dob,gender){
    const users=JSON.parse(localStorage.getItem('users')||[]);
    var new_user={
        id:users.length+1,
        password:password,
        status:'user',
        name:name,
        email:email,
        phone:phone,
        gender:gender,
        dob:dob,
        addressesArr:[],
        profile:''
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