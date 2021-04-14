const user={
    username:"simplekid",
    password:"simplekid123"
}

var new_password="";

$('#current_password').on('change',function(){//got bug
    if($('current_password').val()!==user['password']){
        alert('Wrong current password')
    }
})
$('#new_password').on('change',function(){
    new_password=$('#new_password').val();
});
$('#confirm_password').on('change',function(){
    if($(this).val()!==new_password){
        alert("Wrong password");
    }
})

$('.confirm').on('click',function(){
    user['password']=$('current_password').val();
})