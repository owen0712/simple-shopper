document.getElementById("add_btn").addEventListener("click", function(){
    document.querySelector(".popup").style.display = "flex";
})

document.getElementById("close").addEventListener("click", function(){
    document.querySelector(".popup").style.display = "none";
})

let img = document.createElement("img");
img.id = "upload";

$(document).ready(function(){
    $("form").submit(function(e){
        e.preventDefault();
        //var image = document.getElementById("image").files[0].name;
        $(function(){
            $("#image").change(function(event){
                var x = URL.createObjectURL(event.target.files[0]);
                $("#upload").attr("src",x);
            });
        });
        var name = $("#name").val();
        var category = $("#category").val();
        var amount = $("#amount").val();
        var price = $("#price").val();
        var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + img + "</td><td>" + name + "</td><td>" + category + "</td><td>" + amount + "</td><td>" + "RM" + price + "</td><td><button class='btn btn-lg btn-info edit-row'>Edit</button></td></tr>";
        if (image != ''&& name != ''&& category != '' && amount != '' && price != '') {
            $("#productTable tbody").append(markup);
        }
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
        //var category = $(this).parents('tr').attr('category');
        var amount = $(this).parents('tr').attr('amount');
        var price = $(this).parents('tr').attr('price');
        $(this).parents('tr').find('td:eq(1)').html("<input name='edit_image' type='file' accept='image/*' style='width: 200px;' value='" + image + "'>");
        $(this).parents('tr').find('td:eq(2)').html("<input name='edit_name' type='text' style='width: 100px;' value='" + name + "'>");
        //$(this).parents('tr').find('td:eq(3)').html("<select name='edit_category' value='" + category + "'><option value='Bath and Body'>Bath and Body</option><option value='Instant Food'>Instant Food</option><option value='Canned&Packed Food'>Canned&Packed Food</option><option value='Baby Product'>Baby Product</option><option value='Household Supply'>Household Supply</option><option value='Pet'>Pet</option><option value='Cooking Ingredient'>Cooking Ingredient</option><option value='Cereal'>Cereal</option><option value='Baking Supplies'>Baking Supplies</option><option value='Snack'>Snack</option><option value='Beverage'>Beverage</option><option value='Paper Product'>Paper Product</option></select>");
        $(this).parents('tr').find('td:eq(4)').html("<input name='edit_amount' type='number' style='width: 80px;' step='1' value='" + amount + "'>");
        $(this).parents('tr').find('td:eq(5)').html("<input name='edit_price' type='number' style='width: 80px;' step='0.01' value='" + price + "'>");
        $(this).parents('tr').find('td:eq(6)').prepend("<button type='button' class='btn btn-lg btn-info update-row'>Update</button>");
        $(this).hide()
    });

    $('body').on('click', '.update-row', function(){
        var image = $(this).parents('tr').find("input[name='edit_image']").val();
        var name = $(this).parents('tr').find("input[name='edit_name']").val();
        //var category = $(this).parents('tr').find("select[name='edit_category']").val();
        var amount = $(this).parents('tr').find("input[name='edit_amount']").val();
        var price = $(this).parents('tr').find("input[name='edit_price']").val();
        if (image != ''&& name != ''&& category != '' && amount != '' && price != '') {
            $(this).parents('tr').find('td:eq(1)').text(image);
            $(this).parents('tr').find('td:eq(2)').text(name);
            //$(this).parents('tr').find('td:eq(3)').text(category);
            $(this).parents('tr').find('td:eq(4)').text(amount);
            $(this).parents('tr').find('td:eq(5)').text("RM" + price);

            $(this).parents('tr').attr('image', image);
            $(this).parents('tr').attr('name', name);
            //$(this).parents('tr').attr('category', category);
            $(this).parents('tr').attr('amount', amount);
            $(this).parents('tr').attr('price', price);

            $(this).parents('tr').find('.edit-row').show();
            $(this).parents('tr').find('.update-row').remove();
        }
    });
});    
