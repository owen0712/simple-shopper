<?php 
    require_once '../db/conn.php';
    session_start();
    $min = 0;
    $updatePriceLimit = $product1->updateProductMaximum();
    $updateMax = $updatePriceLimit->fetch();
    $max = $updateMax['product_price'];
    if(isset($_POST['min_price'])){
        $min = $_POST['min_price'];
    }

    if(isset($_POST['max_price'])){
        $max = $_POST['max_price'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>

    <!-- CSS files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/jpg" href="../assets/Logo/favicon-32x32.png"/>
    <link href="../style/index.css" rel="stylesheet">
    <link href="../style/footer.css" rel="stylesheet">
    <style>
        #min{
	        width: 50px;
            padding: 5px 10px;
            text-align: center;
            border: none;
            background: rgba(211,211,211,0.5);
            outline: none;
        }
        #min:focus {
            border-bottom: 2px solid #555;
        }
        #slider-range {
	        width: 100%;
        }
        #max {
	        float: right;   
	        width: 50px;
            padding: 5px 10px;
            text-align: center;
            border: none;
            background: rgba(211,211,211,0.5);
            outline: none;
        }
        #max:focus {
            border-bottom: 2px solid #555;
        }
    </style>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/increment.js" defer></script>
    <script src="../js/header.js" defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link rel="stylesheet"href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
        $(function(){$("#slider-range").slider({
            range: true,
            min: 0,
            max: <?= $updateMax['product_price']; ?>,
            values: [<?= $min; ?>, <?= $max; ?>],
            slide: function(event, ui) {
                $("#amount").html("$" + ui.values[0] + " - $" + ui.values[1]);
		        $("#min").val(ui.values[0]);
		        $("#max").val(ui.values[1]);
            }});
            $("#amount").html("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));
        });
    </script>

<script>
    function addtolist(PID){
            console.log(PID);
            temp="P"+PID;
            console.log(temp);
            Productqty=document.getElementById(temp).value;
            loggedIn=<?php if(isset($_SESSION['user_id'])){ echo 'true'; $temp=$_SESSION['user_id'];}else{echo 'false'; $temp=0;} ?>;

            if(loggedIn){
                swal("Do you want to add this item?",{
                    buttons:{
                        customise: {
                            text: "Add to cart",
                            value: "customise",
                        },
                        cancel: "cancel",
                    },
                }).then((value) => {
                    <?php $list= $shoppingList->getShoppingList($temp)?>
                    switch(value){                    
                        case "customise":
                            swal("Choose your cart",{
                                buttons:{                                    
                                        <?php while ($r=$list->fetch(PDO::FETCH_ASSOC)){?>
                                        <?php echo $r['list_id']?> :{
                                            text: "<?php echo $r['list_name']?>",
                                            value: "<?php echo $r['list_id']?>",
                                        },                                                                        
                                        <?php } echo "cancel:\"cancel\""?>                                    
                                    }                                                                        
                        }).then((value) =>{
                            switch(value){
                                <?php $list= $shoppingList->getShoppingList($temp)?>
                                <?php while ($r=$list->fetch(PDO::FETCH_ASSOC)){?>
                                case "<?php echo $r['list_id']?>":
                                    $.ajax({
                                            url: 'addtolist.php',
                                            data: {ListID: <?php echo $r['list_id']?>, ProID: PID, quantity: Productqty},
                                            method: "POST"
                                        })
                                    swal('Your item has been added to <?php echo $r['list_name']?>',"Take me home!", "success");
                                    break;                           
                                <?php } echo"default:swal(\"See you next time :)\");"?>
                            }
                        });
                        break;
                    
                        default: 
                            swal("See you next time :)");
                    }
                });
            }else{
                swal("You have to sign in first", "You will be directed to the sign in page in 3 seconds");
                setTimeout(function(){window.location.href='login.php'}, 3000);
            }
    }
        </script>

    <header class="navbar navbar-expand-lg navbar-dark py-0 " style="background-color: #4ca456;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php" style="color: white;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="search.php?keywords=" style="color: white;">Product</a>
                    </li>
                    <?php
                        if(!empty($_SESSION['user_id']))
                        {
                            $result = $user-> getUser($_SESSION['user_id']);
                            $_SESSION['status'] = $result['status'];
                            if($_SESSION['status'] != "Admin"){
                                echo '<li class = nav-item"><a class="nav-link" href="profile.php" style="color: white;"><img class="rounded-circle" src="'.$result['profile'].'" height="30mm;">'.$result['name'].'</a>';   
                                echo '<li class="nav-item"><a class="nav-link" href="logout.php" style="color:white;">Logout</a>'; 
                            }else{
                                echo '<li class="nav-item" id="admin"><a class="nav-link" href="php/administrator.php" style="color:white;">Administrator</a>';  
                                echo '<li class = nav-item"><a class="nav-link" href="profile.php" style="color: white;"><img class="rounded-circle" src="'.$result['profile'].'" height="30mm;">'.$result['name'].'</a>';     
                                echo '<li class="nav-item"><a class="nav-link" href="logout.php" style="color:white;">Logout</a>';  
                            }
                        }
                         else{
                            echo '<li class="nav-item"><a class="nav-link" id="sign-up" href="signup.php" style="color:white;">Sign Up</a>';
                            echo '<li class="nav-item"><a class="nav-link" id="sign-in" href="login.php" style="color:white;">Log in</a>';
                         }
                    ?>
                </ul>
            </div>
        </div>   
    </header>
    <header class="navbar sticky-top navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
            <div class="col col-auto">
                <a class="navbar-brand" href="../index.php"><img src="../assets/Logo/SSLogo2.png" height="70mm"></a>
            </div>

            <form class="col col-6" method="GET" action="search.php">
                <div class="input-group mx-auto">
                    <input type="search" id="search" name="keywords" class="form-control form-control-lg mx-auto" placeholder="Search"/>
                    <button type="submit" id="searchButton" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                    </button>
                </div>
            </form>

            <div class="col col-auto justify-content-end dropdown">
                <button type="button" id="dLabel"  class="btn btn-default" onclick="shoppingListClick(<?php if(isset($_SESSION['user_id'])){echo 1;}else{echo 0;} ?>, false)">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="auto" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16" align="end">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                </svg>
                </button>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- Side bar with all the filters and all its side menu -->
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-default">
            <form method="POST" action="search.php">
                <div class="px-3 pt-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="fs-5 d-none d-sm-inline" style="color: black; justify-content: center;">Price range</span>
                </div>
                    <div>
                    <span class="fs-5 d-none d-sm-inline" style="color: black;">RM </span>
                    <input type="text" id="min" name="min_price" value="<?= $min; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;to&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="fs-5 d-none d-sm-inline" style="color: black;">RM </span>
                    <input type="text" id="max" name="max_price" value="<?= $max; ?>"><br><br>
                    <div id="slider-range"></div><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success btn-sm" style="width: 192px;">Search</button>
                </div>
            </form>
            <hr>
                <form action="" method="GET">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <span class="fs-5 d-none d-sm-inline" style="color: black;">Filter by &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu" style="color: black;">
                            <li>
                                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                    <i class="bi bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Categories</span> </a>
                                <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                    <?php
                                        if($ctg = $product1->showCategory()){
                                            while($ctgrow = $ctg->fetch(PDO::FETCH_ASSOC)){
                                                $checked = [];
                                                if(isset($_GET['category'])){
                                                    $checked = $_GET['category'];
                                                }
                                                ?>
                                                <li>
                                                    <input type="checkbox" name="category[]" value="<?=$ctgrow['category_id'];?>"
                                                        <?php if(in_array($ctgrow['category_id'], $checked)){echo "checked";}?>/>
                                                    <span class="d-none d-sm-inline"><?= $ctgrow['category_name'];?></span>
                                                </li>
                                                <?php
                                            }
                                        }else{
                                            echo "No category found";
                                        }
                                    ?><br>
                                    <button type="submit" class="btn btn-success btn-sm">Search</button>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
            
            <div class="col-auto col-md-9 col-xl-10 px-sm-2 px-0 bg-light">
                <div class="row mx-auto" >
                    <?php
                        if(isset($_GET['keywords']))
                        {
                            $keywords = $_GET['keywords'];
                            if(empty($keywords))
                            {
                                $result = $product1->searchWhole();
                            }else{
                                $result = $product1->searchKeyword($keywords);
                            }
                        }else if(isset($_GET['category'])){
                            $ctgid = [];
                            $ctgid = $_GET['category'];
                            $result = $product1->searchCategory($ctgid);
                        }
                        else if(isset($_POST['min_price']) || isset($_POST['max_price'])){
                            $result = $product1->searchPrice($min,$max);
                        }
                        else{
                            $result = false;
                        }
                        if($result != false)
                        {
                            if ($result->rowCount() !== 0) {
                                /* fetch associative array */
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    echo "
                                    <div class='col'>
                                        <div class='card'>
                                        <img src='../assets/Image/".$row['category_name']."/".$row['product_image']."' class='mx-auto product-image' alt='".$row['product_name']."' height='auto' width='auto' onclick='imageClick(".$row['product_id'].",1)'>
                                        <div class='card-body' style='padding-bottom:0px;' >
                                            <h5 class='card-title'>".$row["product_name"]."
                                                <p class='card-category'>".$row["category_name"]."</p>
                                            </h5>
                                            <p class='card-text'>".$row['product_description']."</p>
                                            <p class='card-text' style='font-size: small; text-align:right;'> RM ".$row["product_price"]."/each<br>".$row["product_amount"]." left</p>
                                        </div>
                                        <div class='card-body' style='padding-top:0px; padding-bottom:0px'>
                                            <div class='quantity buttons_added' style='float: left;'>
                                                <input type='button' value='-' class='minus'><input type='number' step='1' min='1' max='' name='quantity' value='1' title='Qty' class='input-text qty text' size='4' pattern='' inputmode='' id='P".$row["product_id"]."'><input type='button'
                                                    value='+' class='plus'>
                                            </div>
                                            <button id='addBtn' type='button' class='btn btn-success' style='float: right;' onclick='addtolist(".$row['product_id'].")'";

                                    if ($row["product_amount"]=="0"){
                                        echo"disabled>Add to list</button>
                                            </div>
                                            </div>
                                        </div>";
                                    }else{
                                        echo">Add to list</button>
                                            </div>
                                            </div>
                                        </div>";
                                    }
                                }
                            }else{
                                echo "<img src='../assets/Image/nothing.png' style='margin-left: 470px; margin-top: 120px; height: 200px; width:300px;'>";
                            }
                        }else{
                            echo "<img src='../assets/Image/nothing.png' style='margin-left: 470px; margin-top: 120px; height: 200px; width:300px;'>";
                        }
                        /* free result set */
                        $result = null;
			$pdo = null;
                    ?>
                    <div class="col" style="visibility: hidden;"></div>
                    <div class="col" style="visibility: hidden;"></div>
                </div>
            </div>
        </div>
    </div>
<!-- echo "<h4 class='mt-4 fw-light text-center'>Seems like nothing here...</h4>"; -->
    <div class="spacer"></div>

    <div class = "footer">
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
</body>
</html>
