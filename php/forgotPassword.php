<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="../style/forgot.css" rel="stylesheet">
    <script src="../js/header.js" defer></script>
    <link rel="shortcut icon" type="image/jpg" href="../assets/Logo/favicon-32x32.png"/>
    
    <!-- css that edit the button hover -->
    <style>
      select {
        font-family: 'FontAwesome', 'sans-serif';
      }
      
      .btn:hover{
        color: rgb(0, 0, 0);
        background-color: #ffffff;
        border-radius: 6px;
        border-color: rgb(38, 126, 209);
        transition-duration: 0.4s;
      }
      
    </style>
    
    <title>Simple Shopper</title>

   </head>

   <!-- Header -->
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

<!-- body -->
   <body>
       <!-- Container -->
     <div class="container">
      <h4 style="margin-top: 20px;"><a href="../php/login.php" style="color: black;"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
      </svg></a><strong>Forgot password</strong></h4>

      <!-- use the d-flex class and justify-content:center to align them to center -->
      <div class = "d-flex" style="justify-content: center;">
        <img src="../assets/ForgotPassword/Authentication-rafiki.png" style="max-width: 260px; max-height: 460px;">
      </div>
      <p class="text-center">To protect your account security, we need to verify your identity.</p>
      <p class="text-center text-muted">Please choose a way to verify.</p>
      <div class="d-flex justify-content-center">
      <!-- User can press this button in order to verify through Email -->
        <a href="../php/validateEmail.php"><button type="button" id = "submit" style="border-radius: 55px; width: 220px; margin-top: 10px; color:coral; background-color: rgb(228, 222, 222);"><i class="bi bi-envelope-fill"></i>&nbsp;Verify through Email</button></a>
      </div>

      <!-- User can press this button in order to verify through SMS code -->
      <div class="d-flex justify-content-center">
        <a href="../php/validatePhone.php"><button type="submit" id = "submit" style="border-radius: 55px; width: 220px; margin-top: 10px; color:white; background-color: coral; justify-content:center;"><i class="bi bi-phone-vibrate-fill"></i><small>&nbsp;Verify through SMS Code</small></button></a>
      </div>
     </div>
     <!-- Footer -->
     <div class = "footer" style="margin-top: 50px;">
      <div class="container">
          <div class="row justify-content-center">
              <div class="footer-col-1">
              <h4>Download Our App</h4>
              <p>Download App for Android and ios mobile phone.</p>
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
                          <li>Help Center</li>
                          <li>Shipping & Delivery</li>
                          <li>Contact Us</li>
                      </ul>
              </div>
              <div class="footer-col-4">
                  <h4>Simple Shopper</h4>
                  <ul>
                      <li>About Simple Shopper</li>
                      <li>Terms & Conditions</li>
                      <li>Privacy Policy</li>
                      <li>Corporate&nbsp;Voucher&nbsp;Purchase</li>
                  </ul>
              </div>
              <div class="footer-col-3">
                  <h4>Follow us</h4>
                  <ul>
                      <li><i class="bi bi-facebook" style="margin-right: 6px; color: #A2D5F2; padding-left: 40px;"></i>Facebook</li>
                      <li><i class="bi bi-linkedin" style="margin-right: 6px; color: #A2D5F2; padding-left: 40px;"></i>Linkedin</li>
                      <li><i class="bi bi-twitter" style="margin-right: 6px; color: #A2D5F2; padding-left: 40px;"></i>Twitter</li>
                      <li><i class="bi bi-instagram" style="margin-right: 6px; color: #A2D5F2; padding-left: 40px;"></i>Instagram</li>
                  </ul>
              </div>
          </div>
          <hr>
          <p class="copyright">Copyright&copy; 2021 Simple Shopper</p>
      </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
  </body>
</html>
