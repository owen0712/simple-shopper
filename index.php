<?php
    include ('php/config.php');
    require_once 'db/conn.php';

    $x = ' ';
    $loginStatus = '';
    $_SESSION['status'] = '';
    //This $_GET["code"] variable value received after user has login into their Google Account rediret to PHP script then this variable value has been received
    if(isset($_GET["code"]))
    {
    if($_SESSION['action']=='google'){
    $loginStatus = "Google";
    //It will Attempt to exchange a code for an valid authentication token.
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
    if(!isset($token['error']))
    {
    //Set the access token used for requests
    $google_client->setAccessToken($token['access_token']);

    //Store "access_token" value in $_SESSION variable for future use.
    $_SESSION['access_token'] = $token['access_token'];

    //Create Object of Google Service OAuth 2 class
    $google_service = new Google_Service_Oauth2($google_client);

    //Get user profile data from google
    $data = $google_service->userinfo->get();
    
    //Below you can find Get profile data and store into $_SESSION variable
    if(!empty($data['given_name']))
    {
    $_SESSION['user_first_name'] = $data['given_name'];
    }

    if(!empty($data['family_name']))
    {
    $_SESSION['user_last_name'] = $data['family_name'];
    }

    $_SESSION['name'] = $_SESSION['user_first_name'].$x.$_SESSION['user_last_name'];

    if(!empty($data['email']))
    {
    $_SESSION['email'] = $data['email'];
    }

    if(!empty($data['gender']))
    {
    $_SESSION['gender'] = $data['gender'];
    }

    if(!empty($data['picture']))
    {
    $_SESSION['profile'] = $data['picture'];
    }
    $_SESSION['status'] = "User";
    $gpUserData['gender'] = !empty($data['gender'])?$data['gender']:''; 

    if($user->checkEmailExist($data['email']))
    {
        $id = $user->getUserIdEmail($data['email']);
        $_SESSION['user_id'] = $id;
    }else
    {
        if($user->insertDetailFacebook($_SESSION['name'],$_SESSION['email'],$gpUserData['gender'],$_SESSION['profile'], $_SESSION['status']))
        {
            $id = $user->getUserIdEmail($data['email']);
            $_SESSION['user_id'] = $id;
        }
    }
  }
 }
}
?>
<?php
include ('php/fb-init.php');
require_once 'db/conn.php';

    $facebook_helper = $facebook->getRedirectLoginHelper();
    $_SESSION['fb_url'] = '';
    if(isset($_GET['code']))
    { 
     if($_SESSION['action']=='fb'){
     if(isset($_SESSION['access_token']))
     {
      $access_token = $_SESSION['access_token'];
     }
     else
     {
      $access_token = $facebook_helper->getAccessToken();
    
      $_SESSION['access_token'] = $access_token;
    
      $facebook->setDefaultAccessToken($_SESSION['access_token']);
     }
    
     $_SESSION['user_id'] = '';
     $_SESSION['name'] = '';
     $_SESSION['email'] = '';
     $_SESSION['profile'] = '';
     $_SESSION['gender'] = '';
     $_SESSION['status'] = '';
     $loginStatus = "Google";
     $graph_response = $facebook->get("/me?fields=name,email,gender", $access_token);
    
     $facebook_user_info = $graph_response->getGraphUser();
    
     if(!empty($facebook_user_info['id']))
     {
      $_SESSION['profile'] = 'https://graph.facebook.com/'.$facebook_user_info['id'].'/picture?type=large&access_token='.$access_token;
     }
    
     if(!empty($facebook_user_info['name']))
     {
      $_SESSION['name'] = $facebook_user_info['name'];
     }
    
     if(!empty($facebook_user_info['email']))
     {
      $_SESSION['email'] = $facebook_user_info['email'];
     }
     if(!empty($facebook_user_info['gender']))
     {
         $_SESSION['gender'] = $facebook_user_info['gender'];
     }
     $_SESSION['status'] = "User";
     if($user->checkEmailExist($facebook_user_info['email']))
     {
         $id = $user->getUserIdEmail($facebook_user_info['email']);
         $_SESSION['user_id'] = $id;
     }else
     {
         if($user->insertDetailFacebook($_SESSION['name'],$_SESSION['email'],$_SESSION['gender'],$_SESSION['profile'],$_SESSION['status'] = "User"))
         {
             $id = $user->getUserIdEmail($data['email']);
             $_SESSION['user_id'] = $id;
         }
     }
    }
}
    else
    {
     // Get login url
        $facebook_permissions = ['email']; // Optional permissions
    
        $facebook_login_url = $facebook_helper->getLoginUrl('http://localhost/simple-shopper/', $facebook_permissions);
        $_SESSION['fb_url'] = $facebook_login_url;
        // Render Facebook login button
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- aos css -->
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Simple Shopper</title>

    <style>
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          user-select: none;
        }
  
        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }

    </style>

    
    <!-- Custom styles for this template -->
    <link href="style/index.css" rel="stylesheet">
    <link href="style/footer.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="shortcut icon" type="image/jpg" href="assets/Logo/favicon-32x32.png"/>
    
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/index.js" defer></script>
    <script src="js/header.js" defer></script>
    <script src="js/increment.js" defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <!-- The first nav bar that is not stuck on top. This is for less frequently used buttons like login and sign up -->
    <header class="navbar navbar-expand-lg navbar-dark py-0 " style="background-color: #4ca456;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="php/index.php" style="color: white;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="src/search.html" style="color: white;">Product</a>
                    </li>
                    <?php
                        if(!empty($_SESSION['user_id']))
                        {
                            $result = $user-> getUser($_SESSION['user_id']);
                            $_SESSION['status'] = $result['status'];
                            if($loginStatus != "Google")
                            {
                                $_SESSION['name'] = $result['name'];
                                $_SESSION['profile'] = $result['profile'];
                            }
                            if($_SESSION['status'] != "Admin"){
                                echo '<li class = nav-item"><a class="nav-link" href="php/profile.php" style="color: white;"><img src="'.$_SESSION['profile'].'" height="30mm;">'.$_SESSION['name'].'</a>';   
                                echo '<li class="nav-item"><a class="nav-link" href="php/logout.php" style="color:white;">Logout</a>'; 
                            }else{
                                echo '<li class="nav-item" id="admin"><a class="nav-link" href="php/administrator.php" style="color:white;">Administrator</a>';  
                                echo '<li class = nav-item"><a class="nav-link" href="php/profile.php" style="color: white;"><img src="'.$_SESSION['profile'].'" height="30mm;">'.$_SESSION['name'].'</a>';   
                                echo '<li class="nav-item"><a class="nav-link" href="php/logout.php" style="color:white;">Logout</a>';  
                            }
                        }
                         else{
                            echo '<li class="nav-item"><a class="nav-link" id="sign-up" href="php/signup.php" style="color:white;">Sign Up</a>';
                            echo '<li class="nav-item"><a class="nav-link" id="sign-in" href="php/login.php" style="color:white;">Log in</a>';
                         }
                    ?>
                </ul>
            </div>
        </div>   
    </header>
    <!-- Second navbar that is always on top of the page with the search and the shopping cart button -->
    <header class="navbar sticky-top navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
            <div class="col col-auto">
                <a class="navbar-brand" href="index.html"><img src="assets/Logo/SSLogo2.png" height="70mm"></a>
            </div>

            <form class="col col-6" method="GET" action="php/search.php">
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
                <button type="button" id="dLabel"  class="btn btn-default" onclick="shoppingListClick()">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="auto" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16" align="end">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Carousel  -->
      <div id="myCarousel" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">    
          <div class="carousel-item active bg-dark">
            <div class="d-flex h-100 align-items-center justify-content-center">
                <img src="assets/carousel/test.png" class="mx-auto">
            </div>
          </div>
          <div class="carousel-item bg-dark">
            <div class="d-flex h-100 align-items-center justify-content-center">
                <img src="assets/carousel/image4-01.png">
            </div>
          </div>
          <div class="carousel-item bg-dark">   
            <div class="d-flex h-100 align-items-center justify-content-center">
                <img src="assets/carousel/image3.png">
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <!-- Main container for the page -->
      <div class="container">
          <!-- Featured category -->
        <div >
          <h1>Featured Items</h1>
          <p class="lead">Have a look at what everyone is buying right now.</p>
        </div>
        <div class="row mx-auto">
          <div class="col">
              <!-- Card for each of the product, almost same for every product -->
            <div class="card">
                <!-- Image of the product -->
            <img src="assets/Image/Beverage/Beverage-5.png" class="mx-auto product-image" alt="Nescafe" height="auto" width="auto">
            <div class="card-body">
                <!-- name of the product -->
                <h5 class="card-title">Nescafe
                    <!-- Category of the product -->
                    <p class="card-category">Beverage</p>
                </h5>
                <!-- Description of the product -->
                <p class="card-text">Nescafe Original Drink 240ml <br> </p>
                <!-- Price of the product -->
                <p style="font-size: small; float: right;"> RM 2.60/each</p>
            </div>
            <div class="card-body">
                <!-- Quantity buttons  -->
                <div class="quantity buttons_added" style="float: left;">
                    <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                        value="+" class="plus">
                </div>
                <!-- Add to list button -->
                <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
            </div>
            </div>
          </div>

          <div class="col">
            <div class="card">
            <img src="assets/Image/Instant Food/Instant-3.png" class="mx-auto product-image" alt="Samyang" height="auto" width="auto">
            <div class="card-body">
                <h5 class="card-title">Samyang
                    <p class="card-category">Instant Noodle</p>
                </h5>
                <p class="card-text">Samyang Spicy Korean Ramen <br> </p>
                <p style="font-size: small; float: right;"> RM 19.00/each</p>
            </div>
            <div class="card-body">
                <div class="quantity buttons_added" style="float: left;">
                    <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                        value="+" class="plus">
                </div>
                <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
            </div>
            </div>
          </div>

          <div class="col">
            <div class="card">
            <img src="assets/Image/Instant Food/Instant-8.png" class="mx-auto product-image" alt="Mamee Chef" height="auto" width="auto">
            <div class="card-body">
                <h5 class="card-title">Mamee Chef
                    <p class="card-category">Instant Noodle</p>
                </h5>
                <p class="card-text">Mamee Chef Instant Noodle - Creamy Tom Yam Flavour (4 x 80g) <br> </p>
                <p style="font-size: small; float: right;"> RM 5.90/each</p>
            </div>
            <div class="card-body">
                <div class="quantity buttons_added" style="float: left;">
                    <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                        value="+" class="plus">
                </div>
                <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
            </div>
            </div>
          </div>

          <div class="col">
            <div class="card">
            <img src="assets/Image/cereal/Cereal-2.png" class="mx-auto product-image" alt="Honey Stars" height="auto" width="auto">
            <div class="card-body">
                <h5 class="card-title">Honey Stars
                    <p class="card-category">Cereal</p>
                </h5>
                <p class="card-text">Honey Stars (300g) <br> </p>
                <p style="font-size: small; float: right;"> RM 8.90/each</p>
            </div>
            <div class="card-body">
                <div class="quantity buttons_added" style="float: left;">
                    <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                        value="+" class="plus">
                </div>
                <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
            </div>
            </div>
          </div>

          <div class="col">
            <div class="card">
            <img src="assets/Image/cereal/Cereal-8.png" class="mx-auto product-image" alt="Honey Crunch" height="auto" width="auto">
            <div class="card-body">
                <h5 class="card-title">Honey Crunch
                    <p class="card-category">Cereal</p>
                </h5>
                <p class="card-text">Honey Crunch (360g) <br> </p>
                <p style="font-size: small; float: right;"> RM 11.33/each</p>
            </div>
            <div class="card-body">
                <div class="quantity buttons_added" style="float: left;">
                    <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                        value="+" class="plus">
                </div>
                <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
            </div>
            </div>
          </div>

          <div class="col">
            <div class="card">
            <img src="assets/Image/Canned&Packed Food/canned-3.png" class="mx-auto product-image" alt="Ayam Brand Tuna" height="auto" width="auto">
            <div class="card-body">
                <h5 class="card-title">Ayam Brand Tuna
                    <p class="card-category">Canned</p>
                </h5>
                <p class="card-text">Ayam Brand Tuna Light Chunks in Olive Oil (150g) <br> </p>
                <p style="font-size: small; float: right;"> RM 6.85/each</p>
            </div>
            <div class="card-body">
                <div class="quantity buttons_added" style="float: left;">
                    <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                        value="+" class="plus">
                </div>
                <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
            </div>
            </div>
          </div>

          <div class="col">
            <div class="card">
            <img src="assets/Image/Cooking Ingredient/CS-1.png" class="mx-auto product-image" alt="Knife Cooking oil" height="auto" width="auto">
            <div class="card-body">
                <h5 class="card-title">Knife Cooking oil
                    <p class="card-category">Cooking Supplies</p>
                </h5>
                <p class="card-text">Knife Cooking oil (5kg) <br> </p>
                <p style="font-size: small; float: right;"> RM 26.80/each</p>
            </div>
            <div class="card-body">
                <div class="quantity buttons_added" style="float: left;">
                    <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                        value="+" class="plus">
                </div>
                <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
            </div>
            </div>
          </div>

          <div class="col">
            <div class="card">
            <img src="assets/Image/Cooking Ingredient/CS-4.png" class="mx-auto product-image" alt="Soy sauce" height="auto" width="auto">
            <div class="card-body">
                <h5 class="card-title">Soy sauce
                    <p class="card-category">Cooking Supplies</p>
                </h5>
                <p class="card-text">Lee Kum Kee selected light soy sauce (500ml) <br> </p>
                <p style="font-size: small; float: right;"> RM 6.25/each</p>
            </div>
            <div class="card-body">
                <div class="quantity buttons_added" style="float: left;">
                    <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                        value="+" class="plus">
                </div>
                <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
            </div>
            </div>
          </div>

        </div>

        <!-- Spacer to have spacing between the content -->
        <div class="spacer"></div> 

        <!-- Side Scrolling category (Drink) -->
        <div class="shopctg">
          <div>
            <h1>Drinks</h1>
            <p class="lead">Thirsty? Grab a drink right now :D</p>
          </div>
          <div class="row row-flex flex-nowrap overflow-auto side-scroll" id="side-scroll">
            <div class="col">
              <div class="card">
              <img src="assets/Image/Beverage/Beverage-1.png" class="mx-auto product-image" alt="Coca-cola" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">Coca-cola
                      <p class="card-category">Beverage</p>
                  </h5>
                  <p class="card-text">Coca-Cola Carbonated Drink Original 320ml <br> </p>
                  <p style="font-size: small; float: right;"> RM 1.99/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Beverage/Beverage-2.png" class="mx-auto product-image" alt="100 plus" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">100 plus
                      <p class="card-category">Beverage</p>
                  </h5>
                  <p class="card-text">100 plus Carbonated Drink Original 320ml<br> </p>
                  <p style="font-size: small; float: right;"> RM 1.99/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Beverage/Beverage-3.png" class="mx-auto product-image" alt="7up" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">7up
                      <p class="card-category">Beverage</p>
                  </h5>
                  <p class="card-text">7up Lemon & Lime Carbonated Drink 320ml <br> </p>
                  <p style="font-size: small; float: right;"> RM 1.99/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Beverage/Beverage-4.png" class="mx-auto product-image" alt="Tropicana" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">Tropicana
                      <p class="card-category">Beverage</p>
                  </h5>
                  <p class="card-text">7up Lemon & Lime Carbonated Drink 320ml <br> </p>
                  <p style="font-size: small; float: right;"> RM 2.99/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Beverage/Beverage-5.png" class="mx-auto product-image" alt="Nescafe" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">Nescafe
                      <p class="card-category">Beverage</p>
                  </h5>
                  <p class="card-text">Nescafe Original Drink 240ml <br> </p>
                  <p style="font-size: small; float: right;"> RM 2.60/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Beverage/Beverage-6.png" class="mx-auto product-image" alt="Nestlé Milo" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">Nestlé Milo
                      <p class="card-category">Beverage</p>
                  </h5>
                  <p class="card-text">Nestlé Milo Chocolate Malt Drink 200ml <br> </p>
                  <p style="font-size: small; float: right;"> RM 2.00/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Beverage/Beverage-7.png" class="mx-auto product-image" alt="Farm Fresh" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">Farm Fresh
                      <p class="card-category">Beverage</p>
                  </h5>
                  <p class="card-text">Farm Fresh Original Yogurt Drink 700ml <br> </p>
                  <p style="font-size: small; float: right;"> RM 4.99/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Beverage/Beverage-8.png" class="mx-auto product-image" alt="GoodDay" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">GoodDay
                      <p class="card-category">Beverage</p>
                  </h5>
                  <p class="card-text">GoodDay Full Cream Fresh Milk 500ml <br> </p>
                  <p style="font-size: small; float: right;"> RM 5.20/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Beverage/Beverage-9.png" class="mx-auto product-image" alt="Homesoy" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">Homesoy
                      <p class="card-category">Beverage</p>
                  </h5>
                  <p class="card-text">Homesoy Soya Milk Original 250ml <br> </p>
                  <p style="font-size: small; float: right;"> RM 1.20/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Beverage/Beverage-10.png" class="mx-auto product-image" alt="Oishi" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">Oishi
                      <p class="card-category">Beverage</p>
                  </h5>
                  <p class="card-text">Oishi Original Green Tea Drink 380ml <br> </p>
                  <p style="font-size: small; float: right;"> RM 1.99/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>
  
          </div>
        </div>
        

        <div class="spacer"></div>
        
        <!-- Side Scrolling category (Instant Noodle) -->
        <div class="shopctg">
          <div >
            <h1>Instant noodle</h1>
            <p class="lead">Grab a bite, you are just not you when you are hungry</p>
          </div>
          <div class="row row-flex flex-nowrap overflow-auto side-scroll" id="side-scroll2">
            <div class="col">
              <div class="card">
              <img src="assets/Image/Instant Food/Instant-1.png" class="mx-auto product-image" alt="Mi Sedap" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">Mi Sedap
                      <p class="card-category">Instant Noodle</p>
                  </h5>
                  <p class="card-text">Mi Sedap Instant Noodle original flavour 5 packets x 91g <br> </p>
                  <p style="font-size: small; float: right;"> RM 3.80/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Instant Food/Instant-2.png" class="mx-auto product-image" alt="Mama Mee" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">Mama Mee
                      <p class="card-category">Instant Noodle</p>
                  </h5>
                  <p class="card-text">Mama Mee 5 packets x60G <br> </p>
                  <p style="font-size: small; float: right;"> RM 5.00/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Instant Food/Instant-3.png" class="mx-auto product-image" alt="Samyang" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">Samyang
                      <p class="card-category">Instant Noodle</p>
                  </h5>
                  <p class="card-text">Samyang Spicy Korean Ramen <br> </p>
                  <p style="font-size: small; float: right;"> RM 19.00/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Instant Food/Instant-4.png" class="mx-auto product-image" alt="Nongshim Shin Ramyun" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">Nongshim Shin Ramyun
                      <p class="card-category">Instant Noodle</p>
                  </h5>
                  <p class="card-text">Nongshim Shin Ramyun Korea Ramen 5 Pack <br> </p>
                  <p style="font-size: small; float: right;"> RM 10.50/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Instant Food/Instant-5.png" class="mx-auto product-image" alt="A1 Bak Kut Teh Mee" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">A1 Bak Kut Teh Mee
                      <p class="card-category">Instant Noodle</p>
                  </h5>
                  <p class="card-text">A1 Bak Kut Teh Mee (90g x 4packs) <br> </p>
                  <p style="font-size: small; float: right;"> RM 7.00/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Instant Food/Instant-6.png" class="mx-auto product-image" alt="Maggi curry" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">Maggi curry
                      <p class="card-category">Instant Noodle</p>
                  </h5>
                  <p class="card-text">Maggi curry flavour <br> </p>
                  <p style="font-size: small; float: right;"> RM 4.80/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Instant Food/Instant-7.png" class="mx-auto product-image" alt="Cintan" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">Cintan
                      <p class="card-category">Instant Noodle</p>
                  </h5>
                  <p class="card-text">Cintan Instant Noodles - Assorted Flavour (75g x 5's) <br> </p>
                  <p style="font-size: small; float: right;"> RM 3.20/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Instant Food/Instant-8.png" class="mx-auto product-image" alt="Mamee Chef" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">Mamee Chef
                      <p class="card-category">Instant Noodle</p>
                  </h5>
                  <p class="card-text">Mamee Chef Instant Noodle - Creamy Tom Yam Flavour (4 x 80g) <br> </p>
                  <p style="font-size: small; float: right;"> RM 5.90/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Instant Food/Instant-9.png" class="mx-auto product-image" alt="IndoMie" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">IndoMie
                      <p class="card-category">Instant Noodle</p>
                  </h5>
                  <p class="card-text">IndoMie Instant Fried Noodle 85g x5 <br> </p>
                  <p style="font-size: small; float: right;"> RM 4.85/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>

          <div class="col">
              <div class="card">
              <img src="assets/Image/Instant Food/Instant-10.png" class="mx-auto product-image" alt="San Remo" height="auto" width="auto">
              <div class="card-body">
                  <h5 class="card-title">San Remo
                      <p class="card-category">Instant Noodle</p>
                  </h5>
                  <p class="card-text">San Remo Dry Pasta - Spirals (500g) <br> </p>
                  <p style="font-size: small; float: right;"> RM 4.80/each</p>
              </div>
              <div class="card-body">
                  <div class="quantity buttons_added" style="float: left;">
                      <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                          value="+" class="plus">
                  </div>
                  <button id="addBtn" type="button" class="btn btn-success" style="float: right;" onclick="addtolist()">Add to list</button>
              </div>
              </div>
          </div>
          </div>
        </div>
      </div>

      <div class="spacer"></div>

      <!-- See more button in the bottom of the page with the chevron -->
      <div class="d-flex justify-content-center">
        <a href="src/search.html" class="seeMore">
            <h3>See all products<i class="bi bi-chevron-double-right"></i></h3>
        </a>
      </div>

      <div class="spacer"></div>

      <div class = "footer">
        <div class="container">
            <div class="row justify-content-center">
                <div class="footer-col-1">
                <h4>Download Our App</h4>
                <p>Download App for Android and iOS mobile phone.</p>
                    <div class="app-logo">
                        <img src="assets/footer/play-store.png">
                        <img src="assets/footer/app-store.png" >
                    </div>
                </div>
                <div class="footer-col-2">
                    <h4>Payment</h4>
                        <img src="assets/footer/Visa+Brand+Mark+-+Blue+-+900x291.jpg">
                        <img src="assets/footer/300px-Mastercard_2019_logo.svg.png" style="background-color: white;">
                        <img src="assets/footer/FPX-Logo-1.png"  style="background-color: white;">
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