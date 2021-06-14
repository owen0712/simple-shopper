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

function deleteAddress(id){
    swal({
        title: "Are you sure?",
        text: "Once deleted, your address will been removed",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        window.location.href='deleteAddress.php?id='+id
    });
}