const addressForm=document.getElementById('add_address');
const title=document.querySelector('#title');
var editing=0;
var editing_address=null;

var accessed_user=JSON.parse(localStorage.getItem('user'))
var addressesArr=accessed_user['addressesArr'];

function showForm(){
    addressForm.style.display='flex';
}

function hideForm(){
    addressForm.style.display='none';
}

function newForm(){
    showForm();
    $("form")[0].reset();
    title.innerHTML="Add New Address";
}

function showEditForm(){
    showForm();
    addressesArr.forEach(element=>{
        if(element['id']==editing){
            editing_address=element;
        }
    })
    $("#name").val(editing_address['name']);
    $("#phone").val(editing_address['phone']);
    $("#postal_code").val(editing_address['postal_code']);
    $("#state").val(editing_address['state']);
    $("#area").val(editing_address['area']);
    $("#description").val(editing_address['description']);
    $("#default_checked").prop('checked',editing_address['default_checked']);
}

function editAddress(n_name,n_phone,n_postal_code,n_state,n_area,n_description,n_default_add){
    editing_address["name"]=n_name;
    editing_address["phone"]=n_phone;
    editing_address["postal_code"]=n_postal_code;
    editing_address["state"]=n_state;
    editing_address["area"]=n_area;
    editing_address["description"]=n_description;
    editing_address["default_checked"]=n_default_add;
}

function addNewAddress(n_id,n_name,n_phone,n_postal_code,n_state,n_area,n_description,n_default_add){
    let exist=false;
    let new_address={
        id:n_id,
        name:n_name,
        phone:n_phone,
        postal_code:n_postal_code,
        state:n_state,
        area:n_area,
        description:n_description,
        default_checked:n_default_add
    }
    addressesArr.forEach(element=>{
        if(n_default_add){
            if(element['default_checked']){
                element['default_checked']=false;
            }
        }
        if(element['name']===n_name&&
        element['phone']===n_phone&&
        element['postal_code']===n_postal_code&&
        element['state']===n_state&&
        element['description']===n_description
        ){
            exist=true;
        }
        else{
            exist=false;
        }
    })
    if(!exist){
        if(n_default_add){ 
            addressesArr.unshift(new_address);
        }
        else{
            addressesArr.push(new_address);
        }
    }
    else{alert("The address is exist");}
    return exist;
}

function removeAddress(target_id){
    addressesArr=addressesArr.filter(element=>element['id']!==target_id);
}

$("form").submit(function(e){
    e.preventDefault();
    let name = $("#name").val();
    let phone = $("#phone").val();
    let postal_code = $("#postal_code").val();
    let state = $("#state").val();
    let area = $("#area").val();
    let description = $("#description").val();
    let default_add=$("#default_checked").prop('checked');
    let id=addressesArr.length+1;
    if(editing==0){
        addNewAddress(id,name,phone,postal_code,state,area,description,default_add)
    }
    else{
        editAddress(name,phone,postal_code,state,area,description,default_add);
        editing=0;
    }
    localStorage.setItem('user',JSON.stringify(accessed_user))
    render()
    hideForm();
});

$('body').on('click', '.delete', function(){
    removeAddress($(this).parent().find('.id').text())
    $(this).parent().remove();
});

$('body').on('click', '.btn-close', function(){
    hideForm();
    $("form")[0].reset();
    editing=0;
});

$('body').on('click', '.edit', function(){
    editing=$(this).parent().find('.id').text();
    showEditForm();
    title.innerHTML="Edit Address";
});

$(document).ready(render())

function render(){
    var addressSection=document.querySelector('#addresses')
    var content=''
    for(var add of addressesArr){
        content += add['default_checked']==true?`<div class="address shadow p-3 mb-5 bg-white rounded">
                    <label class='id'>${add['id']}</label>
                    <button class="btn btn-danger delete"><i class="bi bi-trash"></i> Delete</button>
                    <button class="btn btn-info edit" id="edit_btn"><i class="bi bi-pencil-square"></i> Edit</button>
                    <table>
                        <tr>
                            <td colspan="2"><strong>Default Address</strong></td>
                        </tr>
                        <tr>
                            <td>Full Name</td>
                            <td class="name">${add['name']}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>+6${add['phone']}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>${add['description']},${add['postal_code']},${add['area']},${add['state']}</td>
                        </tr>
                    </table>
                </div>`:
                `<div class="address shadow p-3 mb-5 bg-white rounded">
                    <label class='id'>${add['id']}</label>
                    <button class="btn btn-danger delete"><i class="bi bi-trash"></i> Delete</button>
                    <button class="btn btn-info edit" id="edit_btn"><i class="bi bi-pencil-square"></i> Edit</button>
                    <table>
                        <tr>
                            <td>Full Name</td>
                            <td class="name">${add['name']}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>+6${add['phone']}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>${add['description']},${add['postal_code']},${add['area']},${add['state']}</td>
                        </tr>
                    </table>
                </div>`;
    }
    console.log(content)
    addressSection.innerHTML=content
}