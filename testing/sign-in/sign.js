const form = document.getElementById('form')
const name1 = document.getElementById('name1')
const name2 = document.getElementById('name2')
const password = document.getElementById('password1')
const password2 = document.getElementById('password2')
const email = document.getElementById('email')

form.addEventListener('submit', (e) =>{
    e.preventDefault();

    checkInputs();
})

function checkInputs(){
    // get the values from the inputs
    const name1Value = name1.value.trim()
    const name2Value = name2.value.trim()
    const passwordValue = password.value.trim()
    const password2Value = password2.value.trim()
    const emailValue = email.value.trim()

    if(name1Value === ''){
        // show error
        // add error class
        setErrorFor(name1, 'First name cannot be blank');
    }else{
        // add success class
        setSuccessFor(name1);
    }

    if(emailValue === ''){
        setErrorFor(email, 'Email cannot be blacnk');
    }else if(!isEmail(emailValue)){
        setErrorFor(email, 'Email is not valid');
    }else{
        setSuccessFor(email);
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

function setSuccessFor(input){
    const col_md_3 = input.parentElement; //col-md-3
    col_md_3.className = 'col-md-3 mb-3 success';
}

function isEmail(email){
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}
