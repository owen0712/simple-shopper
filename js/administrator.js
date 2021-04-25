document.getElementById("add_btn").addEventListener("click", function(){
    document.querySelector(".popup").style.display = "flex";
})

document.getElementById("close").addEventListener("click", function(){
    document.querySelector(".popup").style.display = "none";
})
/*
function filter(input){
    $('table > tbody  > tr').each(function(index, tr) {
        var target = $(this).find('td:eq(3)').text();
        if(input == "All"){
            $(this).show();
        }
        else{
            if(target == input){
                $(this).show();
            }
            else{
                $(this).hide();
            }
        }
     });
}
*/
var table = "";

$(document).ready(function() {
    table = $('#productTable').DataTable( {
        "pagingType": "full_numbers",
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ]
    } );
} );

/*
$(document).ready(function() {
    table = $('#productTable').DataTable();
 
    var alphabet = $('<div class="alphabet"/>').append( 'Category: ' );

    var temp = ["Bath and Body", "Instant Food", "Canned&Packed Food", "Baby Product", "Household Supply", "Pet", "Cooking Ingredient", "Cereal", "Baking Supplies", "Snack", "Beverage", "Paper Product"];
 
    $('<span class="clear active"/>')
        .data( 'letter', '' )
        .html( 'All categories' )
        .appendTo( alphabet );
 
    for ( var i=0 ; i<temp.length ; i++ ) {
        $('<span/>')
        .data( 'letter', temp[i] )
        .html( temp[i] )
        .appendTo( alphabet );
    }
 
    alphabet.insertBefore( table.table().container() );
 
    alphabet.on( 'click', 'span', function () {
        alphabet.find( '.active' ).removeClass( 'active' );
        $(this).addClass( 'active' );
 
        _alphabetSearch = $(this).data('letter');
        table.draw();
    } );
} );
*/

$(document).ready(function(){
    $("form").submit(function(e){
        e.preventDefault();
        var name = $("#name").val();
        var category = $("#category").val();
        var amount = $("#amount").val();
        var price = $("#price").val();
        var markup = "<tr><td><input type='checkbox' name='record'></td><td><img id='new_img' height='100' width='100'/></td><td>" + name + "</td><td>" + category + "</td><td>" + amount + "</td><td>" + "RM" + price + "</td><td><button class='btn btn-lg btn-info edit-row'>Edit</button></td></tr>";
        if (name != ''&& category != '' && amount != '' && price != '') {
            $("#productTable tbody").prepend(markup);
        }

        var new_img = document.querySelector('#new_img');
        var image = document.querySelector('#image');
        var reader = new FileReader();
            reader.onload = function (e) {
            new_img.src = e.target.result;
        }
        reader.readAsDataURL(image.files[0]);
        new_img.id='';
        
        table.row.add( [
            "<input type='checkbox' name='record'>",
            new_img,
            name,
            category,
            amount,
            "RM" + price,
            "<button class='btn btn-lg btn-info edit-row'>Edit</button>"
        ] ).draw();
    });
    
    $(".delete-row").click(function(){
        $("#productTable tbody").find('input[name="record"]').each(function(){
            if($(this).is(":checked")){
                $(this).parents("tr").remove();
            }
        });
    });

    var old_img = "";
    
    $('body').on('click', '.edit-row', function(){
        old_img = this.parentElement.parentElement.querySelector("img");
        console.log(old_img);
        var image = $(this).parents('tr').find('td:eq(1)').text();
        var name = $(this).parents('tr').find('td:eq(2)').text();
        var category = $(this).parents('tr').find('td:eq(3)').text();
        var amount = $(this).parents('tr').find('td:eq(4)').text();
        var price = $(this).parents('tr').find('td:eq(5)').text().substring(2);
        $(this).parents('tr').find('td:eq(1)').html("<input name='edit_image' id='edit_img' type='file' accept='image/*' style='width: 200px;' value='" + image + "'>");
        $(this).parents('tr').find('td:eq(2)').html("<input name='edit_name' type='text' style='width: 100px;' value='" + name + "'>");
        $(this).parents('tr').find('td:eq(3)').html("<select name='edit_category' value='" + category + "'><option value='Bath and Body'>Bath and Body</option><option value='Instant Food'>Instant Food</option><option value='Canned&Packed Food'>Canned&Packed Food</option><option value='Baby Product'>Baby Product</option><option value='Household Supply'>Household Supply</option><option value='Pet'>Pet</option><option value='Cooking Ingredient'>Cooking Ingredient</option><option value='Cereal'>Cereal</option><option value='Baking Supplies'>Baking Supplies</option><option value='Snack'>Snack</option><option value='Beverage'>Beverage</option><option value='Paper Product'>Paper Product</option></select>");
        $(this).parents('tr').find('td:eq(4)').html("<input name='edit_amount' type='number' style='width: 80px;' step='1' value='" + amount + "'>");
        $(this).parents('tr').find('td:eq(5)').html("<input name='edit_price' type='number' style='width: 80px;' step='0.01' value='" + price + "'>");
        $(this).parents('tr').find('td:eq(6)').prepend("<button type='button' class='btn btn-lg btn-info update-row'>Update</button>");
        $(this).hide()
    });

    $('body').on('click', '.update-row', function(){
        var image = $(this).parents('tr').find("input[name='edit_image']").val();
        var name = $(this).parents('tr').find("input[name='edit_name']").val();
        var category = $(this).parents('tr').find("select[name='edit_category']").val();
        var amount = $(this).parents('tr').find("input[name='edit_amount']").val();
        var price = $(this).parents('tr').find("input[name='edit_price']").val();
        if (name != ''&& category != '' && amount != '' && price != '') {
            if(image == ''){
                $(this).parents('tr').find('td:eq(1)').prepend(old_img);
                $(this).parents('tr').find('td:eq(2)').text(name);
                $(this).parents('tr').find('td:eq(3)').text(category);
                $(this).parents('tr').find('td:eq(4)').text(amount);
                $(this).parents('tr').find('td:eq(5)').text("RM" + price);

                $(this).parents('tr').attr('name', name);
                $(this).parents('tr').attr('category', category);
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
                $(this).parents('tr').find('td:eq(3)').text(category);
                $(this).parents('tr').find('td:eq(4)').text(amount);
                $(this).parents('tr').find('td:eq(5)').text("RM" + price);

                $(this).parents('tr').attr('name', name);
                $(this).parents('tr').attr('category', category);
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
