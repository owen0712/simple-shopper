const addressForm=document.getElementById('add_address');
const title=document.querySelector('#title');
var editing=0;
var editing_address=null;

var addressesArr=JSON.parse(localStorage.getItem('user'))['addressesArr'];

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
        n_default_add
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
    if(!exist){addressesArr.push(new_address);}
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
    let markup = `<div class="address shadow p-3 mb-5 bg-white rounded">
                    <label class='id'>${id}</label>
                    <button class="btn btn-danger delete" >Delete</button>
                    <button class="btn btn-info edit" onclick="editForm()" id="edit_btn">Edit</button>
                    <table>
                        <tr>
                            <td>Full Name</td>
                            <td class="name">${name}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>+6${phone}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>${description},${postal_code},${area},${state}</td>
                        </tr>
                    </table>
                </div>`;
    if(editing==0){
        if(!addNewAddress(id,name,phone,postal_code,state,area,description,default_add)){
            if (default_add) {
                $("#addresses").prepend(markup);
            }
            else{
                $("#addresses").append(markup);
            }
        }
    }
    else{
        editAddress(name,phone,postal_code,state,area,description,default_add);
        editing=0;
    }
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
