<?php
    require_once '../db/conn.php';

    session_start();
    
    

    if(isset($_SESSION['user_id'])){
      $uid=$_SESSION['user_id'];
      $product=$_GET['id'];

      $history->updateHistory($product,$uid);
    }
    
    

    if(isset($_GET['id'])){
      $id = $_GET['id'];
      $sql = "SELECT product_id, product_image, product_name,categories.category_name,product_price,product_amount, product_description FROM product INNER JOIN categories ON product.category_id = categories.category_id WHERE product_id=$id";  
      $result = $pdo->query($sql);
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>item</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/jpg" href="../assets/Logo/favicon-32x32.png"/>
    <link href="../style/index.css" rel="stylesheet">
    <link href="../style/footer.css" rel="stylesheet">
    <?php $res = $result->fetch();?>
    <style>
        .container
        {
            margin-top: 70px;
            padding: 15px;
        }
        #quantity{
            width: 50px;
            text-align: center;
        }
        .main-img{
            height: 450px;
        }
    </style>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/header.js" defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
    function addtolist(PID){
            console.log(PID);
            temp="P"+PID;
            console.log(temp);
            Productqty=document.getElementById("quantity").value;
            loggedIn=<?php if(isset($_SESSION['user_id'])){ echo 'true'; $temp=$_SESSION['user_id'];}else{echo 'false'; $temp=0;} ?>;

            if(loggedIn){
                swal("Do you want to add this item?",{
                    buttons:{
                        customise: {
                            text: "Add to list",
                            value: "customise",
                        },
                        cancel: "cancel",
                    },
                }).then((value) => {
                    <?php $list= $shoppingList->getShoppingList($temp)?>
                    switch(value){                    
                        case "customise":
                            swal("Choose your shopping list",{
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
                                echo '<li class = nav-item"><a class="nav-link" href="profile.php" style="color: white;"><img class="rounded-circle" src="'.$result['profile'].'" height="30mm;"> '.$result['name'].'</a>';   
                                echo '<li class="nav-item"><a class="nav-link" href="logout.php" style="color:white;">Logout</a>'; 
                            }else{
                                echo '<li class="nav-item" id="admin"><a class="nav-link" href="administrator.php" style="color:white;">Administrator</a>';  
                                echo '<li class = nav-item"><a class="nav-link" href="profile.php" style="color: white;"><img class="rounded-circle" src="'.$result['profile'].'" height="30mm;"> '.$result['name'].'</a>';     
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
    <div class="container">
    <section class="mb-5">
      <div class="row">
        <div class="col-md-6 mb-4 mb-md-0">
          <div id="mdb-lightbox-ui"></div>
          <div class="mdb-lightbox">
            <div class="row product-gallery mx-1">
              <div class="col-12 mb-0">
                <figure class="view overlay rounded z-depth-1">
                  <a href="../assets/upload_image/<?= $res['product_image']?>" data-size="710x823">
                    <img src="../assets/upload_image/<?= $res['product_image']?>" class="img-fluid z-depth-1 main-img">
                  </a>
                </figure>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <?= "<h5>".$res["product_name"]."</h5>"?>
          <p class="mb-2 text-muted small"><?= $res['category_name']?></p>
          <p><span class="mr-1"><strong>RM <?= number_format($res["product_price"], 2, '.', '');?></strong></span></p>
          <p class="pt-1"><?= $res['product_description']?></p>
          <table class="table table-sm table-borderless mb-0">
            <tbody>
              <tr>
                <th class="pl-0 w-25" scope="row"><strong>Stock</strong></th>
                <td><?= $res['product_amount']?></td>
              </tr>
            </tbody>
          </table>
          <hr>
          <div class="table-responsive mb-2">
            <table class="table table-sm table-borderless">
              <tbody>
                <tr>
                  <td class="pl-0 pb-0 w-25">Quantity</td>
                </tr>
                <tr>
                  <td class="pl-0">
                    <div class="def-number-input number-input mb-0">
                      <div class='quantity buttons_added' style='float: left;'>
                            <input type='button' value='-' onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class='minus'>
                            <input id=quantity type='number' step='1' min='1' max='' name='quantity' value='1' title='Qty' class='input-text qty text' size='4' pattern='' inputmode=''>
                            <input type='button' value='+' onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class='plus'>
                        </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <button type="submit" class="btn btn-primary btn-md mr-1 mb-2" onclick="addtolist(<?php echo $res['product_id']; ?>)" <?php if($res['product_amount']==0){echo "disabled";} ?>>Add to list</button>
        </div>
      </div>
    </section>
  </div>
  <?php $pdo = null;?>
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
