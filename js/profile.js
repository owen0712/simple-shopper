$('#username').val(user['username']);
$('#name').val(user['name']);
$('#email').val(user['email']);
$('#phone').val(user['phone']);
const img_preview=document.querySelector('#img_preview');
const img_upload=document.querySelector('#img_upload');
if(user['gender']==='male'){
    $('#male').prop('checked',true);
}
else{
    $('#female').prop('checked',true);
}
$('#dob').val(user['dob']); 
img_preview.src=user['profile']

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
    var src=''
    user['dob']=$('#dob').val();
    if(img_upload.value){
        function readImageSrc(img) {//use promise to access src value
            return new Promise(function(resolve, reject) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    src=e.target.result
                    resolve(src);
                };
                reader.readAsDataURL(img.files[0]);
            });
        };
        readImageSrc(img_upload).then(function(src){
            img_preview.src=src;
            img_icon.src=src;
            user['profile']=src;
            localStorage.setItem('user',JSON.stringify(user));
        });
    }
    else{
        localStorage.setItem('user',JSON.stringify(user));
    }
    updateStorage(user)
})

function preview(){
    function readImageSrc(img) {//use promise to access src value
        return new Promise(function(resolve, reject) {
            var reader = new FileReader();
            reader.onload = function(e) {
                src=e.target.result
                resolve(src);
            };
            reader.readAsDataURL(img.files[0]);
        });
    };
    readImageSrc(img_upload).then(function(src){
        img_preview.src=src;
    });
}

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