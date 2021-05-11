const addressForm=document.getElementById('add_address');
const title=document.querySelector('#title');

function showForm(){
    addressForm.style.display='flex';
}

function newForm(){
    showForm();
    $("form")[0].reset();
}

//set close form function
function closeForm(){
    addressForm.style.display='none';
    $("form")[0].reset();
}