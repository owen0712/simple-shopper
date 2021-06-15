<?php

//index.php

//Include Configuration File
include('../php/config.php');

$login_button = '';

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if(!isset($_SESSION['access_token']))
{
 //Create a URL to obtain user authorization
 $login_button = '<a href="loginAction.php?action=google" class="social-icon"><i class="bi bi-google" id="Google" /></i></a>';
}

?>
<?php
include ('../php/fb-init.php');
require_once '../db/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../style/signUp.css" rel="stylesheet">
    <script src="../js/header.js" defer></script>
    
    <link rel="shortcut icon" type="image/jpg" href="../assets/Logo/favicon-32x32.png"/>
    
    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        select {
          font-family: 'FontAwesome', 'sans-serif';
        }
    </style>

    <script src="../js/sign.js" defer></script>
    <title>Simple Shopper Sign Up</title>

    <!-- header -->
    <header class="navbar navbar-expand-lg navbar-dark py-0 " style="background-color: #4ca456;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
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
    <h5 class="h5 mb-3 text-center">Welcome to Simple Shopper!</h5>
    <p class = "text-center">Please sign up!</p>
    <!-- container -->
    <div class="container">
    <script>
      function swalSuccess(){
          swal({
            title: "Successfully",
            text: "Sign up Successfully",
            icon: "success",
            buttons: true,
            //dangerMode: true,
            })
        .then((proceedLogin) => {
                if (proceedLogin) {
                  setTimeout(function(){window.location.href='../php/login.php'}, 1000);
                }
          });
        }
    </script>
    <script>
        function swalError(){
          swal({
            title: "Error",
            text: "Email already been registered",
            icon: "error",
            buttons: true,
            dangerMode: true,
            })
            .then((proceedLogin) => {
                if (proceedLogin) {
                  setTimeout(function(){window.location.href='../php/signup.php'}, 1000);
                }
          });
        }
    </script>
    <script>
        function swalError2(){
          swal({
            title: "Error",
            text: "Please fill in all details correctly",
            icon: "error",
            buttons: true,
            dangerMode: true,
            })
            .then((proceedLogin) => {
                if (proceedLogin) {
                  setTimeout(function(){window.location.href='../php/signup.php'}, 1000);
                }
          });
        }
    </script>
    <script>
        function swalError3(){
          swal({
            title: "Error",
            text: "Phone number already been registered",
            icon: "error",
            buttons: true,
            dangerMode: true,
            })
            .then((proceedLogin) => {
                if (proceedLogin) {
                  setTimeout(function(){window.location.href='../php/signup.php'}, 1000);
                }
          });
        }
    </script>
<?php
         if(isset($_POST['btnSign']))
         {
             $Fname = $_POST['fName'];
             $Lname = $_POST['lName'];
             $email = $_POST['Uemail'];
             $phone = $_POST['Uphone'];
             if(!isset($_POST['Upass']) or empty($_POST['Upass']))
             {
                echo "<script>swalError2();</script>";
             }elseif(!preg_match('#^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$#',$_POST['Upass'])){
                echo "<script>swalError2();</script>";
             }else{
                $pwd = $user->sanitizePassword($_POST['Upass']);
                $gender = $_POST['gender'];
                $birth = $_POST['birthdaytime'];
                $status = 'User';
                $profile = '../assets/uploads/profile.png';
                if($Fname=="" || $Lname =="" || $email == "" || $phone == "" || $pwd =="" ||
                $gender =="" || $birth == ""){
                  echo "<script>swalError2();</script>";
                }
        
                if($user->checkEmailExist($email))
                {
                   echo "<script>swalError();</script>";
                }
                
                if($user->checkPhoneExist($phone))
                {
                  echo "<script>swalError3();</script>";
                }
                if($Lname !="" && $email != "" && $phone != "" && $pwd !="" &&
                $gender !="" && $birth != ""){
                  if(!$user->checkEmailExist($email))
                  {
                    $name = $Fname." ".$Lname;
                    if ($user->insertDetails($name, $email, $phone, $pwd, $gender, $birth,$profile, $status));
                    {
                        $_SESSION['Uemail'] = $email;
                        echo "<script>swalSuccess();</script>";
                    }
                  }
                }
             }
         }
    ?>
          <!-- form -->
          <form  id="form" class="form" method="post" action="signup.php">
            <!-- first form-row that consist of 2 input fields which are First name and Last Name -->
            <div class="form-row" style="justify-content: center;">
    
              <div class="col-md-3 mb-3">
                <label style="margin-top: 10px;">First name*</label>
                <input type="text" class="form-type" name="fName" placeholder="First name" id = "name1" >
                
                <!-- Icons and message that will be shown if got error or success-->
                <div class = "i_check">
                  <i class="bi bi-check-circle-fill" id="bi-check-circle-fill"></i>
                  <i class="bi bi-exclamation-circle-fill" id = "bi-exclamation-circle-fill"></i>
                  <small>Error Message</small>
                </div>
              
              </div>
    
              <div class="col-md-3 mb-3">
                <label style="margin-top: 10px;">Last name*</label>
                  <input type="text" class="form-type" name="lName" placeholder = "Last Name" id ="name2" >
                  
                  <!-- Icons and message that will be shown if got error or success-->
                  <div  class = "i_check">
                    <i class="bi bi-check-circle-fill" id="bi-check-circle-fill"></i>
                    <i class="bi bi-exclamation-circle-fill" id = "bi-exclamation-circle-fill"></i>
                    <small>Error Message</small>
                  </div>
            
              </div>
    
             </div>

          <!-- Second form-row that consist of 2 input fields which are Email and Phone number-->
          <div class="form-row"  style="justify-content: center;">

              <div class="col-md-3 mb-3"> 
               <label style="margin-top: 10px;">Email*</label>
                <input type="text" class="form-type" name="Uemail" placeholder= "Please enter email" id = "email" >
                <div class = "i_check">
                  <i class="bi bi-check-circle-fill" id="bi-check-circle-fill"></i>
                  <i class="bi bi-exclamation-circle-fill" id = "bi-exclamation-circle-fill"></i>
                  <small>Error Message</small>
                </div>
              </div>

              <div class="col-md-3 mb-3"> 
               <label style="margin-top: 10px;">Phone number*</label>
                <input type="tel" class="form-type" name ="Uphone" placeholder= "Please enter phone number" id = "phone" >
                <div class = "i_check">
                  <i class="bi bi-check-circle-fill" id="bi-check-circle-fill"></i>
                  <i class="bi bi-exclamation-circle-fill" id = "bi-exclamation-circle-fill"></i>
                  <small>Error Message</small>
                </div>
              </div>

          </div>
          
        <!-- Third form-row that consist of 2 input fields which are password and confirm password -->
         <div class="form-row"  style="justify-content: center;">
    
           <div class="col-md-3 mb-3" >
            <label style="margin-top: 10px;">Password*</label>
             <input type="password" class="form-type" id='password' name="Upass" placeholder= "Minumum 8 characters" id="password" >
             <span class="eye" onclick="myFunction()">
              <i id = "hide1" class="bi bi-eye-fill"></i>
              <i id = "hide2" class="bi bi-eye-slash-fill"></i>
             </span>
             <div class = "i_check">
              <i class="bi bi-check-circle-fill" id="bi-check-circle-fill"></i>
              <i class="bi bi-exclamation-circle-fill" id = "bi-exclamation-circle-fill"></i>
              <small>Error Message</small>
            </div>
         
          </div>

          <div class="col-md-3 mb-3">
            <label style="margin-top: 10px;">Confirm Password*</label>
            <input type="password" class="form-type" placeholder= "Confirm your password" id = "password2" >
            <span class="eye" onclick="myFunction2()">
              <i id = "hide3" class="bi bi-eye-fill"></i>
              <i id = "hide4" class="bi bi-eye-slash-fill"></i>
            </span>
            <div class = "i_check">
              <i class="bi bi-check-circle-fill" id="bi-check-circle-fill"></i>
              <i class="bi bi-exclamation-circle-fill" id = "bi-exclamation-circle-fill"></i>
              <small>Error Message</small>
            </div>
         </div>

        </div>

        <!-- Last form-row that consist of 2 input fields which are Birthday and Gender -->
        <div>
          <div class="form-row"  style="justify-content:center">
           <label class="form-label" style="margin-right: 160px; margin-top:16px;">Birthday</label>
           <label class="form-label" style="margin-top: 16px;">Gender</label>
          </div>
        </div>

        <div class="form-row" style="margin-left: auto; margin-bottom: 30px; justify-content: center;" >
            <input type="date" id="birthdaytime" name="birthdaytime" 
            style="padding-right: auto; border-radius: 20px; background-color: #f0f0f0; font-weight: 400; color:#aaa; border: none; outline: none; height:45px;">
            <select class="custom-select custom-select-sm" id='gender' name = "gender"style="width: 150px; margin-left:60px; height:45px; border-radius: 20px; background-color: #f0f0f0; font-weight: 400; border: none; outline: none;">
                <option value="Male" id ="male">&#xf183;&nbsp;&nbsp;Male</option> <!-- &#xf183 is the icon code -->
                <option value="Female" id ="female">&#xf182;&nbsp;&nbsp;Female</option> <!-- &#xf182 is the icon code -->
            </select>
        </div>

            <!--User can sign up with social media platform -->
            <hr style="color: rgb(2, 41, 59); height: 4px;">
            <p class="social-media">Or<strong><span id="sign_text">&nbsp;sign up</span></strong>&nbsp;with social media platforms</p> </span>
            <div class="social-media">
            <?php
              if(isset($_SESSION['fb_url']))
              {
                $facebook_helper = $facebook->getRedirectLoginHelper();
                $facebook_permissions = ['email'];
                echo '<a href="loginAction.php?action=fb" class="social-icon"><i class="bi bi-facebook" id="Facebook" style="background-image: url(Facebook_icon.png);"></i></a>';
              }else{
                $facebook_helper = $facebook->getRedirectLoginHelper();
                $facebook_permissions = ['email'];
                echo '<a href="loginAction.php?action=fb" class="social-icon"><i class="bi bi-facebook" id="Facebook" style="background-image: url(Facebook_icon.png);"></i></a>';
              }
            ?>
            <!--<a href="#" class="social-icon">
              <i class="bi bi-facebook" id="Facebook" style="background-image: url(Facebook_icon.png);"></i>
            </a>!-->
            <?php
              if($login_button == '')
              {
                echo '<a href="loginAction.php?action=google" class="social-icon"><i class="bi bi-google" id="Google"></i></a>';
              }
              else
              {
                echo $login_button;
              }
             ?>
             </div>
          
          <!--Membership agreement -->
          <hr style="height: 4px;">
          <a></a>
          <div class="d-flex justify-content-center">
              <strong><p>MEMBERSHIP AGREEMENT&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 18" style="color: red;">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"></path></svg></p></strong>
          </div>

         <strong> <small class="d-flex justify-content-center"><p class="text-muted">By clicking "Sign up", you agree to Simple Shopper's privacy policy and terms of use.</p></small></strong>

          <div class="row d-flex justify-content-center">
            <strong><a href="#">Terms Of Use</a></strong>
              <strong><a href="#" style="margin-left: 20px;">Privacy Policy</a></strong>
          </div>

          <!--sign up button -->
          <div class="d-flex justify-content-center">
            <button type="submit" id = "submit" class="btn btn-primary" name="btnSign" style="border-radius: 55px; width: 180px; margin-top: 10px;">Sign up</button>
          </div>

          <!--If user had already had account, then can press log in here link to login page -->
          <div class="d-flex justify-content-center">
            <div class="row">
              <p class="text-muted" style="margin-top: 10px;">Have an account?</p>
              <i class="bi bi-arrow-right-circle-fill" style="margin-left: 20px; padding-top: 11px;"></i>
              <a href="../php/login.php" style="color:rgb(38, 126, 209); margin-left: 4px; padding-top: 11px;">Log in here</a>
            </div>
          </div>
        </form>
    </div>

    <!-- footer -->
    <div class = "footer">
      <div class="container">
        <div class="row">
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
            <div class="footer-col-2">
              <h4 style="margin-top: 20px;">Contact Us</h4>
              <ul>
                <li><a href="#" style="color:#ffffff;">Help Center</a></li>
                <li><a href="#" style="color:#ffffff;">Shipping & Delivery</a></li>
                <li><a href="#" style="color:#ffffff;">Contact Us</a></li>
              </ul>
            </div>
          </div>

          <div class="footer-col-4">
            <h4>Simple Shopper</h4>
            <ul>
              <li><a href="#" style="color:#ffffff;">About Simple Shopper</a></li>
              <li><a href="#" style="color:#ffffff;">Terms & Conditions</a></li>
              <li><a href="#" style="color:#ffffff;">Privacy Policy</a></li>
              <li><a href="#" style="color:#ffffff;">Corporate&nbsp;Voucher&nbsp;Purchase</a></li>
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

    <!-- js part -->
    <!-- js that used to get the current date -->
    <script>
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0'); 
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd; //need to fulfill this format yyyy-mm-dd just can set attribute
        var temp = document.querySelector("#birthdaytime");
        temp.setAttribute("value", today);
    </script>

    <!-- js that enable the eye icon to be pressed to see the password, this part for password -->
    <script>
        function myFunction(){
           var x = document.getElementById("password")
           var y = document.getElementById("hide1")
           var z = document.getElementById("hide2")
          
           if(x.type === 'password'){
                 x.type = "text";
                 y.style.display = "block";
                 z.style.display = "none";
             }
             else{
               x.type = "password";
               y.style.display = "none";
               z.style.display = "block";
             }
        }
      </script>

      <!-- js that enable the eye icon to be pressed to see the password, this part for confirm password -->
      <script>
          function myFunction2(){
            var x = document.getElementById("password2")
            var y = document.getElementById("hide3")
            var z = document.getElementById("hide4")
              
            if(x.type === 'password'){
                  x.type = "text";
                  y.style.display = "block";
                  z.style.display = "none";
              }
              else{
                x.type = "password";
                y.style.display = "none";
                z.style.display = "block";
              }
            }
      </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>
<?php
  $pdo=null;
?>
