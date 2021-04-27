document.getElementById("add_btn").addEventListener("click", function(){
    document.querySelector(".popup").style.display = "flex";
})

document.getElementById("close").addEventListener("click", function(){
    document.querySelector(".popup").style.display = "none";
})

var table = "";

$(document).ready(function() {
    table = $('#productTable').DataTable( {
        "pagingType": "full_numbers",
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ]
    } );
} );

$(document).ready(function(){
    $("form").submit(function(e){
        e.preventDefault();
        var name = $("#name").val();
        var category = $("#category").val();
        var amount = $("#amount").val();
        var price = $("#price").val();
        //new code
        var src='';
        var new_img = document.querySelector('#new_img');
        var image = document.querySelector('#image');
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
        readImageSrc(image).then(function(src){
            //draw table inside here
            table.row.add( [
                "<input type='checkbox' name='record'>",
                "<img id='new_img' height='100' width='100' src='"+src+"'/>",
                name,
                category,
                amount,
                "RM" + price,
                "<button class='btn btn-lg btn-info edit-row' style='width: 100px;'><i class='bi bi-pencil-square'></i> Edit</button>"
            ] ).draw();
        });
        $("#image").val("");
        $("#name").val("");
        $("#amount").val("");
        $("#price").val("");
    });
    
    $(".delete-row").click(function(){
        $("#productTable tbody").find('input[name="record"]').each(function(){
            if($(this).is(":checked")){
                $(this).parents("tr").addClass("selected");
                var rows = table
                    .rows( '.selected' )
                    .remove()
                    .draw();
            }
        });
    });

    var old_img = "";
    
    $('body').on('click', '.edit-row', function(){
        old_img = this.parentElement.parentElement.querySelector("img");
        var image = $(this).parents('tr').find('td:eq(1)').text();
        var name = $(this).parents('tr').find('td:eq(2)').text();
        //var category = $(this).parents('tr').find('td:eq(3)').text();
        var amount = $(this).parents('tr').find('td:eq(4)').text();
        var price = $(this).parents('tr').find('td:eq(5)').text().substring(2);
        $(this).parents('tr').find('td:eq(1)').html("<input name='edit_image' id='edit_img' type='file' accept='image/*' style='width: 200px;' value='" + image + "'>");
        $(this).parents('tr').find('td:eq(2)').html("<input name='edit_name' type='text' style='width: 300px;' value='" + name + "'>");
        //$(this).parents('tr').find('td:eq(3)').html("<select name='edit_category' value='" + category + "'><option value='Bath and Body'>Bath and Body</option><option value='Instant Food'>Instant Food</option><option value='Canned&Packed Food'>Canned&Packed Food</option><option value='Baby Product'>Baby Product</option><option value='Household Supply'>Household Supply</option><option value='Pet'>Pet</option><option value='Cooking Ingredient'>Cooking Ingredient</option><option value='Cereal'>Cereal</option><option value='Baking Supplies'>Baking Supplies</option><option value='Snack'>Snack</option><option value='Beverage'>Beverage</option><option value='Paper Product'>Paper Product</option></select>");
        $(this).parents('tr').find('td:eq(4)').html("<input name='edit_amount' type='number' style='width: 80px;' step='1' value='" + amount + "'>");
        $(this).parents('tr').find('td:eq(5)').html("<input name='edit_price' type='number' style='width: 80px;' step='0.01' value='" + price + "'>");
        $(this).parents('tr').find('td:eq(6)').prepend("<button type='button' class='btn btn-lg btn-info update-row' style='width: 130px;'><i class='bi bi-check2-square'></i> Update</button>");
        $(this).hide()
    });

    $('body').on('click', '.update-row', function(){
        var image = $(this).parents('tr').find("input[name='edit_image']").val();
        var name = $(this).parents('tr').find("input[name='edit_name']").val();
        //var category = $(this).parents('tr').find("select[name='edit_category']").val();
        var amount = $(this).parents('tr').find("input[name='edit_amount']").val();
        var price = $(this).parents('tr').find("input[name='edit_price']").val();
        if (name != ''&& category != '' && amount != '' && price != '') {
            if(image == ''){
                $(this).parents('tr').find('td:eq(1)').prepend(old_img);
                $(this).parents('tr').find('td:eq(2)').text(name);
                //$(this).parents('tr').find('td:eq(3)').text(category);
                $(this).parents('tr').find('td:eq(4)').text(amount);
                $(this).parents('tr').find('td:eq(5)').text("RM" + price);

                $(this).parents('tr').attr('name', name);
                //$(this).parents('tr').attr('category', category);
                $(this).parents('tr').attr('amount', amount);
                $(this).parents('tr').attr('price', price);

                $(this).parents('tr').find('.edit-row').show();
                $(this).parents('tr').find('.update-row').remove();
                image = document.querySelector('#edit_img');
                image.remove();
            }
            else{
                $(this).parents('tr').find('td:eq(1)').prepend("<img id='new_img' height='100' width='100'/>");
                $(this).parents('tr').find('td:eq(2)').text(name);
                //$(this).parents('tr').find('td:eq(3)').text(category);
                $(this).parents('tr').find('td:eq(4)').text(amount);
                $(this).parents('tr').find('td:eq(5)').text("RM" + price);

                $(this).parents('tr').attr('name', name);
                //$(this).parents('tr').attr('category', category);
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
        }
    });
});

var _alphabetSearch = '';
 
$.fn.dataTable.ext.search.push( function ( settings, searchData ) {
    if ( ! _alphabetSearch ) {
        return true;
    }
 
    if ( searchData[3] === _alphabetSearch ) {
        return true;
    }
 
    return false;
} );

function filterCategory (selectedCategory){
    if(selectedCategory != "All"){
        _alphabetSearch = selectedCategory;
        table.draw();
    }
    else{
        _alphabetSearch = '';
        table.draw();
    }
}
