const email1 = document.getElementById('email');
const form = document.getElementById('form');

form.addEventListener('submit', (e) => {
    e.preventDefault();

    checkInputs();
})

function checkInputs(){
  const emailValue = email1.value.trim()

  if(emailValue === ''){
   setErrorFor(email, 'Email cannot be blank');
  }else if(!isEmail(emailValue)){
      setErrorFor(email, 'Email is not valid');
  }else{
      setSuccessFor(email);
  }
}

function setErrorFor(input, message){
    const form_type = input.parentElement;
    const small = form_type.querySelector('small');
    
    small.innerText = message;

    form_type.className = 'form-type error';
}

function setSuccessFor(input){
  linkTo();
}

function isEmail(email){
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

function linkTo(){
    window.location.href = '../src/forgot2.html';
}