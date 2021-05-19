<?php

//index.php

//Include Configuration File
include('config.php');

$login_button = '';

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if(!isset($_SESSION['access_token']))
{
 //Create a URL to obtain user authorization
 $login_button = '<a href="'.$google_client->createAuthUrl().'" class="social-icon"><i class="bi bi-google" id="Google" /></i></a>';
}

?>

<?php
require_once '../db/conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Simple Shopper</title>
    <link rel="shortcut icon" type="image/jpg" href="../assets/Logo/favicon-32x32.png"/>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="../style/signin.css" rel="stylesheet">
     
    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/header.js" defer></script>
    
  </head>

  <!-- header -->
  <header class="navbar navbar-expand-lg navbar-dark py-0 " style="background-color: #4ca456;">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../php/index.php" style="color: white;">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../src/search.html" style="color: white;">Product</a>
                </li>
                <li class="nav-item" id='admin' style="display: none;">
                    <a class="nav-link" href="../src/administrator.html" style="color: white;">Administrator</a>
                </li>
                <li class="nav-item user">
                    <a class="nav-link" id='sign-up' href="../php/signup.php" style="color: white;">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id='sign-in' href="../php/login.php" style="color: white;">Log in</a>
                </li>
            </ul>
        </div>
    </div>   
</header>
<header class="navbar sticky-top navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">
        <div class="col col-auto">
            <a class="navbar-brand" href="index.html"><img src="../assets/Logo/SSLogo2.png" height="70mm"></a>
        </div>

        <div class="col col-6">
            <div class="input-group mx-auto">
                <input type="search" id="search" class="form-control form-control-lg mx-auto" placeholder="Search"/>
                <button type="button" id="searchButton" class="btn btn-primary" onclick="searchFunc()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
                </button>
            </div>
        </div>

        <div class="col col-auto justify-content-end dropdown">
            <button type="button" id="dLabel"  class="btn btn-default" onclick="shoppingListClick()">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="auto" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16" align="end">
                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
            </svg>
            </button>
        </div>
    </div>
</header>
 <!-- body -->
  <body class="text-center">  
    <!-- form -->
    <div>
    <script>
        function swalSuccess(){
          swal({
            title: "Successfully",
            text: "Login Successfully",
            icon: "success",
            buttons: true,
            //dangerMode: true,
            })
        .then((proceedLogin) => {
                if (proceedLogin) {
                  setTimeout(function(){window.location.href='../index.php'}, 1000);
                }
          });
        }
    </script>
    <script>
        function swalError(){
          swal({
            title: "Error",
            text: "Email and password does not match",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
        .then((proceedLogin) => {
                if (proceedLogin) {
                  setTimeout(function(){window.location.href='../php/login.php'}, 1000);
                }
          });
        }
    </script>
        <script>
        function swalError2(){
          swal({
            title: "Error",
            text: "Email and password does not match",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
        .then((proceedLogin) => {
                if (proceedLogin) {
                  setTimeout(function(){window.location.href='../php/login.php'}, 1000);
                }
          });
        }
    </script>
      <?php
          if(isset($_POST['btnLogin']))
          {
              $email = $_POST['ph_email'];
              $pwd = $user->sanitizePassword($_POST['pwdL']);
              $status = $_POST['statusL'];

              //if user enter email
             if($user->checkEmail($email))
             {
               if($user->checkLoginEmail($email,$pwd,$status))
               {
                  echo "<script>swalSuccess();</script>";
               }else{
                  echo "<script>swalError();</script>";
               }
             }else if($user->checkPhone($email))
             {
               if($user->checkLoginPhone($email,$pwd,$status)){
                echo "<script>swalSuccess();</script>";
               }
             }else{
                echo "<script>swalError2();</script>";
             }
          }
       
      ?>
    </div>
    <form class="form-signin" id="form" action="login.php" name = "form-login" method = "post"> 
        <h5>Welcome to Simple Shopper!</h5>
        <p class="text-muted">Please Log in.</p>
          <div class = "input-field" style="width:350px">
          <i class="bi bi-person-circle"></i>
          <input type="text" placeholder="Phone number or email" name="ph_email" value="<?php if(isset($_COOKIE["ph_email"])) { echo $_COOKIE["ph_email"]; } ?>" id = "phone_email"/>
          <div class="i_check">
            <i class="bi bi-check-circle-fill" id="bi-check-circle-fill" ></i>
            <i class="bi bi-exclamation-circle-fill" id = "bi-exclamation-circle-fill"></i>
            <small>Error Message</small>
          </div>
        </div>
        
        <div class = "input-field" style="width:350px; margin-top: 30px; margin-bottom: 20px;">
          <i class="bi bi-lock-fill"></i>

          <input type="password" placeholder="Password" name="pwdL" id = "myInput"/>
          <!-- eye icon -->
          <span class="eye" onclick="myFunction()">
              <i id = "hide1" class="bi bi-eye-fill"></i>
              <i id = "hide2" class="bi bi-eye-slash-fill"></i>
          </span>

          <!-- Icons and message that will be shown if got error or success-->
          <div class="i_check">
            <i class="bi bi-check-circle-fill" id="bi-check-circle-fill" ></i>
            <i class="bi bi-exclamation-circle-fill" id = "bi-exclamation-circle-fill"></i>
            <small>Error Message</small>
          </div>
        </div>
        
        <!--checkbox for user to choose whether want remember the account and password or not-->
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?>> Remember me
          </label>
          <br>
          <!--login through customer or administrator -->
          <select class="custom-select custom-select-sm" id="status" name="statusL" style="width: 120px; height:40px; border-radius: 20px; background-color: #f0f0f0; font-weight: 400; border: none; outline: none;">
            <option value="User">Customer</option>
            <option value="Admin">Administrator</option>
          </select>
        </div>
         <!--If user forgor password then can press the forgor password in order to link to forgot password page -->
        <div id = "signInsection">
            <i class="bi bi-arrow-right-circle-fill"></i>
            <a href="../php/forgotPassword.php" style="color:rgb(38, 126, 209);">Forgot password?</a>
            <button type="submit" id = "submit" name="btnLogin" class="btn btn-primary" style="border-radius: 55px; margin-left: 10px; width: 100px;">Login</button>
        </div>

        <hr>
         <!--User can login with social media platform -->
        <p class="social-media">Or <strong><span id="sign_text">&nbsp;login</span></strong>&nbsp;with social social platforms</p> </span>
        <div class="social-media">
            <a href="#" class="social-icon">
              <i class="bi bi-facebook" id="Facebook" style="background-image: url(Facebook_icon.png);"></i>
            </a>

            <?php
              if($login_button == '')
              {
                echo '<a href="'.$google_client->createAuthUrl().'" class="social-icon"><i class="bi bi-google" id="Google" /></i></a>';
              }
              else
              {
                echo $login_button;
              }
             ?>

           <a href="#" class="social-icon">
            <i class="bi bi-instagram" id="instagram"></i>
          </a>
         </div>
          <!-- if user has/have not any account yet, then he/she can press the sign up here link in order to sign up page -->
          <div class="row" style="justify-content: center; margin-top:5px">
            <label class="text-muted">New to Simple Shopper?&nbsp;&nbsp;&nbsp;</label>
            <i class="bi bi-arrow-right-circle-fill"></i>
            <a href="../src/sign.html" style="color:rgb(38, 126, 209); margin-left: 4px;">Sign up here</a>
          </div>
          <br>
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
  <script>
      function myFunction(){
         var x = document.getElementById("myInput")
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
  <script>
      const form = document.getElementById('form');
      const phone_email = document.getElementById('phone_email');
      const password = document.getElementById('myInput');
      const status=document.querySelector('#status')

      form.addEventListener('change'/*'submit'*/, (e) =>{
        //e.preventDefault();
        checkInputs();
      })

      function checkInputs(){
        const phone_emailValue = phone_email.value.trim();
        const passwordValue = password.value.trim();
        var statusValue ='';

        if(status.value==='Customer'){
          statusValue='user'
        }
        else if(status.value==='Administrator'){
          statusValue='admin'
        }

        if(!validateEmail(phone_emailValue) && !validatePhone(phone_emailValue)){
          setErrorFor(phone_email, 'Mandatory');
        }else{
          setSuccessFor(phone_email);
        }

        if(passwordValue === ''){
            setErrorFor(password, 'Password cannot be blank');
          }
        else if(passwordValue.length>15){
            setErrorFor(password, 'Password length cannot exceed 15 characters')
          }
        else if(passwordValue.length < 8){
            setErrorFor(password, 'Password must at least 8 characters long');
        }else{
            setSuccessFor(password)
          }

    
        // if(phone_emailValue !== '' && passwordValue !== ''){
        //   if(signIn(phone_emailValue,type,passwordValue,statusValue)){
        //     swal("Login Success", "Welcome to simple shopper", "success");
        //     setTimeout(function(){window.location.href='index.html'}, 1000);
        //   }
        //   else{
        //     swal("Login Failed", "Please try again", "error");
        //   }
        // }

      }
      
      function validateEmail(email){
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email); 
      }

      function validatePhone(phone){
        var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
        return re.test(phone);
      }

      function setErrorFor(input, message){
        const input_field = input.parentElement;
        const small = input_field.querySelector('small');

        // add error message inside small
        small.innerText = message;

        // add error class
        input_field.className = 'input-field error';
      }
      function setSuccessFor(input){
        const input_field = input.parentElement;
        input_field.className = 'input-field success'
    }
  </script>

 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
</body>
</html>