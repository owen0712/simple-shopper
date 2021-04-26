//used when no local storage
const users=[{
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

//localStorage.setItem('users',JSON.stringify(users))

function updateStorage(current_user){
    var user_list=JSON.parse(localStorage.getItem('users'))
    for(var user of user_list){
        if(user['id']==current_user['id']){
            user=current_user;
            break;
        }
    }
    localStorage.setItem('users',JSON.stringify(users))
}

function updatePassword(password){
    var user=JSON.parse(localStorage.getItem('user')||{});
    user['password']=password;
    localStorage.setItem('user',JSON.stringify(user))
    updateStorage(user);
}


//the code below is to change the header
var user=JSON.parse(localStorage.getItem('user')||{})
//admin section
//set default invisible (haven't done   )
const admin_anchor=document.querySelector('#admin')
if(user['status']==='admin'){
    admin_anchor.innerHTML='Administrator';
}

const signin_anchor=document.querySelector('#sign-in')
const user_section=document.querySelector('.user')
if(user){
    //signup_anchor.innerHTML=user['name'];
    //signup_anchor.href='profile.html'
    user_section.innerHTML=`
    <img class="rounded-circle justify-content-center" id='img_icon' alt="profle_img" src="${user['profile']}" width="25" height="25" data-holder-rendered="true">
    <a class="nav-link d-inline" id='sign-up' href="../src/profile.html">${user['name']}</a>
    `
    signin_anchor.innerHTML='Log out';
    signin_anchor.href='index.html'
    signin_anchor.addEventListener('click',signOut)
}

function signOut(){
    localStorage.removeItem('user');
    admin_anchor.innerHTML='Administrator';
    user_section.innerHTML="<a class='nav-link d-inline' id='sign-up' href='../src/sign.html'>Sign Up</a>"
    signin_anchor.innerHTML='Sign In';
    signin_anchor.href='index.html'
    signin_anchor.removeEventListener('click')
}

