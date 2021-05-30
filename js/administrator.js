$(document).ready(function() {  // create a data table

	load_data();

	function load_data(is_category){
		var table = $('#productTable').DataTable( {
			"pagingType": "full_numbers",
			"lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"action.php",
				type:"POST",
				data:{is_category:is_category, action:'listProduct'},
				dataType:"json"
			},
			"columnDefs":[
				{
					"targets":[1, 7, 8],
					"orderable":false,
				},
				{
					"targets": [ 0 ],
					"visible": false,
					"searchable": false
				}
			]
		} );
	}

	$(document).on('change', '#selectedCategory', function(){
		var category  = $(this).val();
		$('#productTable').DataTable().destroy();
		if(category != ''){
			load_data(category);
		}
		else{
			load_data();
		}
	});

    $('#add_btn').click(function(){
        $('#productModal').modal('show');
        $('#productForm')[0].reset();
        $('.modal-title').html("Add Product");
        $('#action').val('addProduct');
        $('#save').val('Add');
    });
    
    $("#productTable").on('click', '.delete', function(){
		var productId = $(this).attr("id");		
		var action = "productDelete";
		if(confirm("Are you sure you want to delete this product?")) {
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{productId:productId, action:action},
				success:function(data) {					
					$('#productTable').DataTable().ajax.reload();
				}
			})
		} else {
			return false;
		}
	});

    $("#productTable").on('click', '.update', function(){
		var productId = $(this).attr("id");
		var action = "getProduct";
		$.ajax({
			url:'action.php',
			method:"POST",
			data:{productId:productId, action:action},
			dataType:"json",
			success:function(data){
				$('#productModal').modal('show');
				$('#productId').val(data.product_id);
                document.getElementById("image").required = false;
				$('#name').val(data.product_name);
				$('#category').val(data.category_id);
				$('#amount').val(data.product_amount);
				$('#price').val(data.product_price);
                $('#description').val(data.product_description);	
				$('.modal-title').html("Edit Product");
				$('#action').val('updateProduct');
				$('#save').val('Save');				
			}
		})
	});

	$('#add_category').click(function(){
		$('#categoryModal').modal('show');
		$('#categoryForm')[0].reset();
		$('#actionCategory').val('addCategory');
	});
} );
