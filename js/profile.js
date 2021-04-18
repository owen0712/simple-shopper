const user={
    username:"simplekid",
    name:"Sim Ple Kid",
    email:"simplekid@gmail.com",
    phone:"0123456789",
    gender:'male',
    dob:"2021-04-14"
}

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
    alert("Profile updated");
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

$('.btn-danger').on('click',function(){
    var decision = confirm("Are you sure you want to delete the account?");
    if(decision){
        alert("Account deleted");
        window.location.href='index.html';
    }
})