const cardForm=document.getElementById('add_card');
const title=document.querySelector('#title');
const accessed_user=JSON.parse(localStorage.getItem('user'))
var editing=0;
var editing_card=null;

var cardsArr=[{
    id:1,
    name:'Sim Ple Kid',
    card:'1234567890123456',
    expiry_date:'12/23',
    cvv:'997',
    billing_add:'n',
    postal_code:'n',
}];

function showForm(){
    cardForm.style.display='flex';
}

function hideForm(){
    cardForm.style.display='none';
}

function newForm(){
    showForm();
    $("form")[0].reset();
    title.innerHTML="Add New Card";
}

function showEditForm(){
    showForm();
    cardsArr.forEach(element=>{
        if(element['id']==editing){
            editing_card=element;
        }
    })
    //edit
    $("#name").val(editing_card['name']);
    $("#card").val(editing_card['card']);
    $("#expiry_date").val(editing_card['expiry_date']);
    $("#cvv").val(editing_card['cvv']);
    $("#billing_add").val(editing_card['billing_add']);
    $("#postal_code").val(editing_card['postal_code']);
    
    $("#default_checked").prop('checked',editing_card['default_checked']);
}

function editCard(name,card,expiry_date,cvv,billing_add,postal_code){
    editing_card["name"]=name;
    editing_card["card"]=card;
    editing_card["expiry_date"]=expiry_date;
    editing_card["cvv"]=cvv;
    editing_card["billing_add"]=billing_add;
    editing_card["postal_code"]=postal_code;
}

function addNewCard(n_id,n_name,n_card,n_expiry_date,n_cvv,n_billing_add,n_postal_code){
    let exist=false;
    let new_card={
        id:n_id,
        name:n_name,
        card:n_card,
        expiry_date:n_expiry_date,
        cvv:n_cvv,
        billing_add:n_billing_add,
        postal_code:n_postal_code,
    }
    cardsArr.forEach(element=>{
        if(element['name']===n_name&&
        element['card']===n_card&&
        element['expiry_date']===n_expiry_date&&
        element['cvv']===n_cvv&&
        element['billing_add']===n_billing_add&&
        element['postal_code']===n_postal_code
        ){
            exist=true;
        }
        else{
            exist=false;
        }
    })
    //check exist and default to decide the position of address
    if(!exist){
        cardsArr.push(new_card);
    }
    else{alert("The address is exist");}
    return exist;
}

function removeCard(target_id){
    addressesArr=addressesArr.filter(function(element){ 
        return element['id']!=target_id;
    });
    //accessed_user['addressesArr']=addressesArr
    //localStorage.setItem('user',JSON.stringify(accessed_user))
    //updateStorage(accessed_user)
}

$("form").submit(function(e){
    e.preventDefault();
    let name = $("#name").val();
    let card = $("#card_no").val();
    let expiry_date = $("#expiry_date").val();
    let cvv = $("#cvv").val();
    let billing_add = $("#billing_add").val();
    let postal_code = $("#postal_code").val();
    let id=cardsArr.length+1;
    if(editing==0){
        addNewCard(id,name,card,expiry_date,cvv,billing_add,postal_code)
    }
    else{
        editCard(name,card,expiry_date,cvv,billing_add,postal_code);
        editing=0;
    }
    //localStorage.setItem('user',JSON.stringify(accessed_user))
    //updateStorage(accessed_user)
    render()
    hideForm();
});

//set delete function
$('body').on('click', '.delete', function(){
    //have to change
    removeCard($(this).parent().find('.id').text())
    render()
});

//set close form function
function closeForm(){
    hideForm();
    $("form")[0].reset();
    editing=0;
}

//set edit function
$('body').on('click', '.edit', function(){
    editing=$(this).parent().find('.id').text();
    showEditForm();
    title.innerHTML="Edit Card";
});

$(document).ready(render())

//output all card stored
function render(){
    var cardSection=document.querySelector('#cards')
    var content=''
    for(var card of cardsArr){
        //edit content-billing address
        content += `<div class="card shadow p-3 mb-5 bg-white rounded">
                    <table>
                        <td style='display:none;'><label class='id'>${card['id']}</label></td>
                        <td><img src='../assets/bank/visa.jpg' width='75' height='25'/></td>
                        <td>Visa</td>
                        <td>**** **** **** ${card['card'].slice(12,15)}</td>
                        <td><button class="btn btn-danger delete"><i class="bi bi-trash"></i> Delete</button></td>
                        <td><button class="btn btn-info edit" id="edit_btn"><i class="bi bi-pencil-square"></i> Edit</button></td>
                    </table>
                </div>`;
    }
    cardSection.innerHTML=content
}