<?php
require_once '../db/conn.php';
session_start();
?>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

     <!-- Autojump js (when the user input in the first input field, it will automically jump to next input field) -->
    <SCRIPT TYPE="text/javascript">
        var downStrokeField;
        function autojump(fieldName,nextFieldName,fakeMaxLength)
        {
        var myForm=document.forms[document.forms.length - 1];
        var myField=myForm.elements[fieldName];
        myField.nextField=myForm.elements[nextFieldName];
        
        if (myField.maxLength == null)
          myField.maxLength=fakeMaxLength;
        
        myField.onkeydown=autojump_keyDown;
        myField.onkeyup=autojump_keyUp;
        }
        
        function autojump_keyDown()
        {
        this.beforeLength=this.value.length;
        downStrokeField=this;
        }
        
        function autojump_keyUp()
        {
          console.log(this.value.length);
        if (
          (this == downStrokeField) && 
          (this.value.length > this.beforeLength) && 
          (this.value.length >= this.maxLength)
          )
          this.nextField.focus();
          downStrokeField=null;
        }
      </SCRIPT>
   </head>

    <!--header -->
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
     <!-- container -->
     <div class="container">
       <!-- form -->
       <script>
          function swalError(){
            swal('Opps!', 'OTP code incorrect!', 'error');
          }
       </script>
      <script>
          function swalError2(){
            swal("Opps!", "OTP code expires!", "warning");
          }
      </script>
      <script>
          function linkTo(){
            window.location.href='../php/resetPassword.php';
          }
      </script>
       <?php
          if($_SERVER['REQUEST_METHOD']=="GET"){
            if(!empty($_GET['email'])){
              $email = $_GET['email'];
              $_SESSION['Otp_user_id'] = $user->getUserIdEmail($email);
              if(!empty($user-> getUserInfoEmail($email)))
              {
                $result = $user-> getUserInfoEmail($email);
                $result = $result ->fetch(PDO::FETCH_ASSOC);
                $otp = $result['Otp'];
                $_SESSION['Otp'] = $otp;
                $expire = $result['Expire'];
                $_SESSION['Expire'] = $expire;
              }
            }else{
              $phone = $_GET['phone'];
              if(!empty($user->getUserIdPhone($phone))){
                 $stmt = $user->getUserIdPhone($phone);
                 $stmt=$stmt->fetch(PDO::FETCH_ASSOC);
                 $_SESSION['Otp_user_id'] = $stmt['user_id'];
              }

              if(!empty($user-> getUserInfoPhone($phone)))
              {
                $result = $user-> getUserInfoPhone($phone);
                $result = $result ->fetch(PDO::FETCH_ASSOC);
                $otp = $result['Otp'];
                $_SESSION['Otp'] = $otp;
                $expire = $result['Expire'];
                $_SESSION['Expire'] = $expire;
              }
            }
          }
        ?>
       <?php
          if($_SERVER['REQUEST_METHOD']=="POST"){
            if(isset($_POST['btnSubmit']))
            {
              $Uotp = array($_POST['ssn_1'], $_POST['ssn_2'], $_POST['ssn_3'], $_POST['ssn_4']);
              $Uotp = join("",$Uotp); 
              date_default_timezone_set("Asia/Kuala_Lumpur");
              $time = new DateTime(date("Y-m-d h:i:sa"));
              $time = $time->format('Y-m-d H:i');
              if($time < $_SESSION['Expire'])
              {
                if($_SESSION['Otp'] ==  $Uotp)
                {
                  echo "<script>linkTo();</script>";
                }else{
                  echo "<script>swalError();</script>";
                }
              }else{
                echo "<script>swalError2();</script>";
              }
            }
        }
       ?>
       <form class="form" id="form" method = "post" action="otp.php">
            <h4><a href="../php/login.php" style="color: black;"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg></a><strong>Forgot password</strong></h4>
            
            <!-- use the d-flex class and justify-content:center to align them to center -->
            <div class = "d-flex" style="justify-content: center;">
              <img src="../assets/ForgotPassword/Account-amico.png" style="max-width: 260px; max-height: 460px;">
            </div>
            <p class="text-center">Please enter your verification code.</p>
            <p class="text-center text-muted">We have send a verification code to your registered email/phone ID.</p>
            
            <!-- use the d-flex class and justify-content:center to align them to center -->
            <div class="d-flex justify-content-center">
              <div class = "form-type" style="width: 55px; margin:10px;">
                <input type="text" tabindex="1" name ="ssn_1" NAME="ssn_1" style ="width:55px; border-radius: 20px;" id = "validate1" onload = "disInput()" onkeyup="jump(this,this.value)"/>
              </div>
              <div class = "form-type" style="width: 55px; margin:10px">
                <input type="text" tabindex="2" name ="ssn_2" NAME="ssn_2" style ="width:55px; border-radius: 20px;" id = "validate2" onload = "disInput()" onkeyup="jump(this,this.value)"/>
              </div>
              <div class = "form-type" style="width: 55px; margin:10px">
                <input type="text" tabindex="3" name ="ssn_3" NAME="ssn_3" style ="width:55px; border-radius: 20px;" id = "validate3" onload = "disInput()" onkeyup="jump(this,this.value)"/>
              </div>
              <div class = "form-type" style="width: 55px; margin:10px">
                <input type="text" tabindex="4" name ="ssn_4" NAME="ssn_4" style ="width:55px; border-radius: 20px;" id = "validate4" onload = "disInput()" onkeyup="jump(this,this.value)"/>
              </div>
            </div>

            <!-- Next button in disable condition, once user fill up all input field then button will be enable again. -->
            <div class="d-flex justify-content-center">
                <button type="submit" id = "btnSubmit" name = "btnSubmit" class="btn btn-primary" style="border-radius: 55px; width: 180px; margin-top: 10px;" disabled>Next</button>
            </div>
            <p class="text-center text-muted" style="margin-top: 20px;" id="changingText">Please wait until <strong><span id="changing" style=" color: #3fc1c9;">30</span></strong>s to resend</p>
       </form>

       <!-- pass value to autojump function -->
       <SCRIPT TYPE="text/javascript">
            autojump('ssn_1', 'ssn_2', 0);
            autojump('ssn_2', 'ssn_3', 0);
            autojump('ssn_3', 'ssn_4', 0);
        </SCRIPT>

     </div>

     <!-- footer -->
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

     <script> 
      // assign 30 to variable s
      var s = 30;
      // Function that executes every 1000 milliseconds 
      var t = setInterval(function() { 
        // Change the word in the span of words 
        $('#changing').html(s);
        s--;
        // after 30s, the <p></p> will change to new content include resend link and try other method link
        if(s == -1){
          clearInterval(t);
          document.getElementById('changingText').innerHTML = "<p>Did not receive the code?<br><a href=\"forgot2.html\">Resend</a> or <a href=\"forgot3.html\">try a different verification method</a></p>";
        } 
      }, 1000); 
     </script>

     <script>
       let btnShow = document.getElementById('btnSubmit');
       let validate1 = document.getElementById('validate1');
       let validate2 = document.getElementById('validate2');
       let validate3 = document.getElementById('validate3');
       let validate4 = document.getElementById('validate4');
       let form = document.getElementById('form');
       
       // to ensure that user press 1 number only, if more than 1 number in one input field then
       // the button will be disable again.
       form.addEventListener('keyup', (e)=>{
          e.preventDefault();
          if(validate1.value.length == 1 &&
             validate2.value.length == 1 &&
             validate3.value.length == 1 &&
             validate4.value.length == 1){
                btnShow.disabled = false;
             }
             else{
                btnShow.disabled =  true;
             }
       });
     </script>
   <script>
       // after press the button, the page will link to forgot1.html (reset password)
        function btnFunction(){
            window.location.href= 'resetPassword.html';
       }
   </script> 

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> 
  </body>
</html>
<?php
$pdo=null;
?>
