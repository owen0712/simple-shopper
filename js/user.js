//used when no local storage
/*const users=[{
    id:1,
    password:'simplekid123',
    status:'user',
    name:"Sim Ple Kid",
    email:"simplekid@gmail.com",
    phone:"0123456789",
    gender:'male',
    dob:"2021-04-14",
    addressesArr:[{
        id:1,
        name:'Sim Ple Kid',
        phone:'0123456789',
        postal_code:'50603',
        state:'Kuala Lumpur',
        area:'Wilayah Persekutuan',
        description:'Universiti Malaya,Jalan University',
        default_checked:true
    }],
    profile:'../assets/profile.png'
},
{
    id:2,
    password:'admin123',
    status:'admin',
    name:"AdminUser",
    email:"admin@gmail.com",
    phone:"0123456789",
    gender:'male',
    dob:"2021-04-21",
    addressesArr:[{
        id:1,
        name:'Admin',
        phone:'0123456789',
        postal_code:'50603',
        state:'Kuala Lumpur',
        area:'Wilayah Persekutuan',
        description:'Universiti Malaya,Jalan University',
        default_checked:true
    }],
    profile:'../assets/profile.png'
}]

localStorage.setItem('users',JSON.stringify(users))*/

function updateStorage(current_user){
    var user_list=JSON.parse(localStorage.getItem('users'))
    for(var i=0;i<user_list.length;i++){
        if(user_list[i]['id']==current_user['id']){
            user_list[i]=current_user;
        }
    }
    console.log(user_list)
    localStorage.setItem('users',JSON.stringify(user_list))
}



var user=JSON.parse(localStorage.getItem('user')||{})
//admin section
const admin_anchor=document.querySelector('#admin')

const signin_anchor=document.querySelector('#sign-in')
const user_section=document.querySelector('.user')
if(user){
    if(user['status']==='admin'){
        admin_anchor.style.display='block';
    }
    user_section.innerHTML=`
    <img class="rounded-circle justify-content-center" id='img_icon' alt="profile_img" src="${user['profile']}" width="25" height="25" data-holder-rendered="true">
    <a class="nav-link d-inline" id='sign-up' href="../src/profile.html" style="color: white;">${user['name']}</a>
    `
    user_section.style.marginTop='8px'
    signin_anchor.innerHTML='Log out';
    signin_anchor.href='index.html'
    signin_anchor.addEventListener('click',signOut)
}

function signOut(){
    localStorage.removeItem('user');
    admin_anchor.style.display='none';
    user_section.innerHTML="<a class='nav-link' id='sign-up' href='../src/sign.html' style='color: white;'>Sign Up</a>"
    user_section.style.marginTop='0'
    signin_anchor.innerHTML='Log In';
    signin_anchor.href='index.html'
    signin_anchor.removeEventListener('click')
}

