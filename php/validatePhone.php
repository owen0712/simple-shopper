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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />
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
                    <a class="nav-link" href="../src/index.html" style="color: white;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../src/search.html" style="color: white;">Product</a>
                </li>
                <li class="nav-item" id='admin' style="display: none;">
                    <a class="nav-link" href="../src/administrator.html" style="color: white;">Administrator</a>
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
   <body>
     <div class="container">

      <!-- form -->
       <form id="form" class="form" method="post" action="sms.php">
          <h4 style="margin-top: 20px;"><a href="../php/login.php" style="color: black;"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
          </svg></a><strong>Forgot password</strong></h4>
    
          <div class = "d-flex" style="justify-content: center;">
            <!-- image -->
            <img src="../assets/ForgotPassword/New message-bro.png" style="max-width: 260px; max-height: 460px;">
          </div>
          <p class="text-center">Please enter your registered email ID/Phone.</p>
          <p class="text-center text-muted">We will send a verification code to your registerd Phone number.</p>
          
          <!-- form-type -->
          <div class = "form-type" style="width:350px">
            <i class="bi bi-phone-vibrate-fill"></i>
            <input type="text" placeholder="Phone Number" name="Number" id = "phoneSMS"/>
            <div  class = "i_check">
              <i class="bi bi-check-circle-fill" id="bi-check-circle-fill"></i>
              <i class="bi bi-exclamation-circle-fill" id = "bi-exclamation-circle-fill"></i>
              <small>Error Message</small>
            </div>
          </div>
          
          <!-- Next button -->
          <div class="d-flex justify-content-center">
            <button type="submit" id = "submit" name="btnPhone" class="btn btn-primary" style="border-radius: 55px; width: 180px; margin-top: 20px;">Next</button>
          </div>
      
        </form>
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

  <!-- js part -->
    <script>
      const form = document.getElementById('form');
      const phone = document.getElementById('phoneSMS'); 

      form.addEventListener('change', (e) => {
        //e.preventDefault();

        checkInputs();  
      })

      function checkInputs(){
        const phoneValue = phone.value.trim()
        
        // check phone number format
        if(phoneValue === ''){
            setErrorFor(phone, 'Phone number cannot be blank');
        }else if(!validatePhoneNumber(phoneValue)){
            setErrorFor(phone, 'Please enter correct phone number format')
        }else if(phoneValue.length <10){
            setErrorFor(phone, 'Please enter correct phone number format')
        }else{
          setSuccessFor(phone);
        }
      }

      // function that validate the phone number format is correct or not
      function validatePhoneNumber(input_str) {
          var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;

          return re.test(input_str);
      }

      function setSuccessFor(input){
          const form_type = input.parentElement;
          form_type.className = 'form-type success';
      }

      // set new class for error. If got error, then add class named error into the class name
      function setErrorFor(input, message){
          const form_type = input.parentElement;
          const small = form_type.querySelector('small');
          
          small.innerText = message;

          form_type.className = 'form-type error';
      }
    </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
  </body>
</html>
