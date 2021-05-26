<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Shopper Administrator</title>
    <!--link to css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/administrator.css">
    <link rel="stylesheet" href="../style/footer.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="shortcut icon" type="image/jpg" href="../assets/Logo/favicon-32x32.png"/>
</head>
<body>
    <div>
        <!--header-->
        <header class="navbar navbar-expand-lg navbar-dark py-0 " style="background-color: #4ca456;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="col col-6 collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="nav-item dropdown">
                        <a class="btn-lg" href="#" id="navbarDropdown" role="Button" data-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" style="color: white;" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../php/administrator.php"><i class="bi bi-handbag"></i> Product page</a>    
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../php/order.php"><i class="bi bi-file-text"></i> Order page</a>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php" style="color: white;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../src/search.html" style="color: white;">Product</a>
                        </li>
                        <li class="nav-item" id='admin' style="display: none;">
                            <a class="nav-link" href="../php/administrator.php" style="color: white;">Administrator</a>
                        </li>
                        <li class="nav-item user">
                            <a class="nav-link" id='sign-up' href="../src/sign.html" style="color: white;">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id='sign-in' href="../src/signin.html" style="color: white;">Log in</a>
                        </li>
                    </ul>
                </div>
            </div>   
        </header>
        <!--nav bar-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom mb-5">
            <div class="container-fluid">
              <div class="col col-auto">
                <a class="navbar-brand" href="../src/index.html"><img src="../assets/Logo/SSLogo2.png" height="70mm"></a>
              </div>
              <select name="selectedCategory" id="selectedCategory" class="form-control">
                <option value="">Category Search</option>
                <option value="Bath and Body">Bath and Body</option>
                <option value="Instant Food">Instant Food</option>
                <option value="Canned and Packed Food">Canned and Packed Food</option>
                <option value="Baby Product">Baby Product</option>
                <option value="Household Supply">Household Supply</option>
                <option value="Pet">Pet</option>
                <option value="Cooking Ingredient">Cooking Ingredient</option>
                <option value="Cereal">Cereal</option>
                <option value="Baking Supplies">Baking Supplies</option>
                <option value="Snack">Snack</option>
                <option value="Beverage">Beverage</option>
                <option value="Paper Product">Paper Product</option>
              </select>
            </div>
        </nav>
        <main class="container">
            <table id="productTable" class="mb-4">    <!--add the products inside a table-->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Total Amount</th>
                        <th>Price (RM)</th>
                        <th>Description</th>
                        <th>Update</th>
			            <th>Delete</th>
                    </tr>
                </thead>
            </table>
            <button id="add_btn" class="btn btn-success btn-lg"><i class="bi bi-plus-square"></i> Add product</button> &nbsp;    <!--add product button-->
        </main>
        <!--footer-->
        <footer>
            <div class = "footer mt-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="footer-col-1">
                        <h4>Download Our App</h4>
                        <p>Download App for Android and iOS mobile phone.</p>
                            <div class="app-logo">
                                <img src="../assets/footer/play-store.png">
                                <img src="../assets/footer/app-store.png" >
                            </div>
                        </div>
                        <div class="footer-col-2">
                            <h4>Payment</h4>
                                <img src="../assets/footer/Visa+Brand+Mark+-+Blue+-+900x291.jpg">
                                <img src="../assets/footer/300px-Mastercard_2019_logo.svg.png" style="background-color: white;">
                                <img src="../assets/footer/FPX-Logo-1.png"  style="background-color: white;">
                                <br>
                                <h4 style="margin-top: 20px;">Contact Us</h4>
                                <ul>
                                    <li><a href="#">Help Center</a></li>
                                    <li><a href="#">Shipping & Delivery</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                        </div>
                        <div class="footer-col-4">
                            <h4>Simple Shopper</h4>
                            <ul>
                                <li><a href="#">About Simple Shopper</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Corporate&nbsp;Voucher&nbsp;Purchase</a></li>
                            </ul>
                        </div>
                        <div class="footer-col-3">
                            <h4>Follow us</h4>
                            <ul>
                                <li><a href="#"><i class="bi bi-facebook" style="margin-right: 6px; color: #A2D5F2; padding-left: 40px;"></i>Facebook</a></li>
                                <li><a href="#"><i class="bi bi-linkedin" style="margin-right: 6px; color: #A2D5F2; padding-left: 40px;"></i>Linkedin</a></li>
                                <li><a href="#"><i class="bi bi-twitter" style="margin-right: 6px; color: #A2D5F2; padding-left: 40px;"></i>Twitter</a></li>
                                <li><a href="#"><i class="bi bi-instagram" style="margin-right: 6px; color: #A2D5F2; padding-left: 40px;"></i>Instagram</a></li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <p class="copyright">Copyright&copy; 2021 Simple Shopper</p>
                </div>
            </div>
        </footer>
    </div>
    <div id="productModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="productForm" action="action.php" enctype="multipart/form-data">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add product</h4>
    				</div>
    				<div class="modal-body">
                        <div class="mb-3">
                            <label for="image" class="form-label"><span class="red">*</span>Upload image of product:</label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
                        </div>
						<div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" required>
                            <label for="name"><span class="red">*</span>Name:</label>
                        </div>  	
						<div class="form-floating mb-3">
                            <select class="form-select" id="category" name="category" style="height: 60px;" aria-label="Floating label select example" required> 
                                <option value="Bath and Body">Bath and Body</option>
                                <option value="Instant Food">Instant Food</option>
                                <option value="Canned and Packed Food">Canned and Packed Food</option>
                                <option value="Baby Product">Baby Product</option>
                                <option value="Household Supply">Household Supply</option>
                                <option value="Pet">Pet</option>
                                <option value="Cooking Ingredient">Cooking Ingredient</option>
                                <option value="Cereal">Cereal</option>
                                <option value="Baking Supplies">Baking Supplies</option>
                                <option value="Snack">Snack</option>
                                <option value="Beverage">Beverage</option>
                                <option value="Paper Product">Paper Product</option>
                            </select>
                            <label for="category"><span class="red">*</span>Category:</label>
                        </div>	 
						<div class="form-floating mb-3">
                            <input type="number" min="0" step="1" class="form-control" id="amount" name="amount" required>
                            <label for="amount"><span class="red">*</span>Total Amount:</label>
                        </div>
						<div class="form-floating mb-3">
                            <input type="number" min="0" step="0.01" class="form-control" id="price" name="price" required>
                            <label for="price"><span class="red">*</span>Price:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="description" name="description" style="height: 100px;" required>Write something about the product...</textarea>
                            <label for="description"><span class="red">*</span>Description:</label>
                        </div>
                        <p><span class="red">*</span>Required</p>					
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="productId" id="productId" />
    					<input type="hidden" name="action" id="action" value="" />
    					<input type="submit" name="save" id="save" class="btn formButton" value="Save" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
    <!--link to js-->
    <script src="../js/administrator.js" defer></script>
    <script src="../js/header.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
</body>
</html>
