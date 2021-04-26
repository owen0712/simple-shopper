//used when no local storage
const users=[{
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
    }]
},
{
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
    }]
}]

//localStorage.setItem('users',JSON.stringify(users))

//try
var current_user={
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
    }]
}

function updateStorage(user){
    var user_list=JSON.parse(localStorage.getItem('users'))
    //for(var )
}

//localStorage.setItem('user',JSON.stringify(current_user))
//until here please remove it after you run your program
function updatePassword(password){
    var user=JSON.parse(localStorage.getItem('user')||{});
    user['password']=password;
    localStorage.setItem('user',user)
    users.forEach((temp_user)=>{
        if(temp_user===current_user){
            temp_user=user;
        }
        return true;
    })
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
const signup_anchor=document.querySelector('#sign-up')
if(user){
    signup_anchor.innerHTML=user['name'];
    signup_anchor.href='profile.html'
    signin_anchor.innerHTML='Log out';
    signin_anchor.href='index.html'
    signin_anchor.addEventListener('click',signOut)
}

function signOut(){
    localStorage.removeItem('user');
    admin_anchor.innerHTML='Administrator';
    signup_anchor.innerHTML='Sign Up';
    signup_anchor.href='sign.html'
    signin_anchor.innerHTML='Sign In';
    signin_anchor.href='index.html'
    signin_anchor.removeEventListener('click')
}

