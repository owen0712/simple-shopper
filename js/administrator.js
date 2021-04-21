document.getElementById("add_btn").addEventListener("click", function(){
    document.querySelector(".popup").style.display = "flex";
})

document.getElementById("close").addEventListener("click", function(){
    document.querySelector(".popup").style.display = "none";
})

$(document).ready(function(){
    $("form").submit(function(e){
        e.preventDefault();
        var name = $("#name").val();
        var category = $("#category").val();
        var amount = $("#amount").val();
        var price = $("#price").val();
        var markup = "<tr><td><input type='checkbox' name='record'></td><td><img id='new_img' height='100' width='100'/></td><td>" + name + "</td><td>" + category + "</td><td>" + amount + "</td><td>" + "RM" + price + "</td><td><button class='btn btn-lg btn-info edit-row'>Edit</button></td></tr>";
        if (name != ''&& category != '' && amount != '' && price != '') {
            $("#productTable tbody").append(markup);
        }
        var new_img = document.querySelector('#new_img');
        var image = document.querySelector('#image');
        var reader = new FileReader();
            reader.onload = function (e) {
            new_img.src = e.target.result;
        }
        reader.readAsDataURL(image.files[0]);
        new_img.id=''; 
    });
    
    $(".delete-row").click(function(){
        $("#productTable tbody").find('input[name="record"]').each(function(){
            if($(this).is(":checked")){
                $(this).parents("tr").remove();
            }
        });
    });

    $('body').on('click', '.edit-row', function(){
        var image = $(this).parents('tr').attr('image');
        var name = $(this).parents('tr').attr('name');
        var amount = $(this).parents('tr').attr('amount');
        var price = $(this).parents('tr').attr('price');
        $(this).parents('tr').find('td:eq(1)').html("<input name='edit_image' id='edit_img' type='file' accept='image/*' style='width: 200px;' value='" + image + "'>");
        $(this).parents('tr').find('td:eq(2)').html("<input name='edit_name' type='text' style='width: 100px;' value='" + name + "'>");
        $(this).parents('tr').find('td:eq(4)').html("<input name='edit_amount' type='number' style='width: 80px;' step='1' value='" + amount + "'>");
        $(this).parents('tr').find('td:eq(5)').html("<input name='edit_price' type='number' style='width: 80px;' step='0.01' value='" + price + "'>");
        $(this).parents('tr').find('td:eq(6)').prepend("<button type='button' class='btn btn-lg btn-info update-row'>Update</button>");
        $(this).hide()
    });

    $('body').on('click', '.update-row', function(){
        var image = $(this).parents('tr').find("input[name='edit_image']").val();
        var name = $(this).parents('tr').find("input[name='edit_name']").val();
        var amount = $(this).parents('tr').find("input[name='edit_amount']").val();
        var price = $(this).parents('tr').find("input[name='edit_price']").val();
        if (image != ''&& name != ''&& category != '' && amount != '' && price != '') {
            $(this).parents('tr').find('td:eq(1)').prepend("<img id='new_img' height='100' width='100'/>");
            $(this).parents('tr').find('td:eq(2)').text(name);
            $(this).parents('tr').find('td:eq(4)').text(amount);
            $(this).parents('tr').find('td:eq(5)').text("RM" + price);

            $(this).parents('tr').attr('name', name);
            $(this).parents('tr').attr('amount', amount);
            $(this).parents('tr').attr('price', price);

            $(this).parents('tr').find('.edit-row').show();
            $(this).parents('tr').find('.update-row').remove();

            var new_img = document.querySelector('#new_img');
            image = document.querySelector('#edit_img');
            var reader = new FileReader();
                reader.onload = function (e) {
                new_img.src = e.target.result;
            }
            reader.readAsDataURL(image.files[0]);
            new_img.id='';
            image.remove();
        }
    });
});    
