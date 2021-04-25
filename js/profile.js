$('#username').val(user['username']);
$('#name').val(user['name']);
$('#email').val(user['email']);
$('#phone').val(user['phone']);
if(user['gender']==='male'){
    $('#male').prop('checked',true);
}
else{
    $('#female').prop('checked',true);
}
$('#dob').val(user['dob']); 

$('form').on('submit',function(e){
    e.preventDefault();
    swal("Good job!", "Profile Updated", "success");
    user['username']=$('#username').val();
    user['name']=$('#name').val();
    user['email']=$('#email').val();
    user['phone']=$('#phone').val();
    if($('#male').val()){
        user['gender']='male';
    }
    else if($('#female').val()){
        user['gender']='female';
    }
    user['dob']=$('#dob').val();
})

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
            setTimeout(function(){window.location.href='index.html'}, 1000);
        } else {
            swal("Your account still exist!");
        }
    });
})