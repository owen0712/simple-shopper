//set delete account function
$('.btn-danger').on('click',function(e){
    e.preventDefault()
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this account!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            swal("Your account has been deleted!", {
            icon: "success",
            });
            signOut()
            setTimeout(function(){window.location.href='index.html'}, 1000);
        } else {
            swal("Your account still exist!");
        }
    });
})