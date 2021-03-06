<?php
    require_once '../db/conn.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!--custom css-->
    <link rel="stylesheet" href="../style//footer.css">
    <link rel="stylesheet" href="../style/setting.css">
    <link rel="stylesheet" href="../style/password.css">
    <!--fav icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="shortcut icon" type="image/jpg" href="../assets/Logo/favicon-32x32.png"/>
    <!--bootstrap js and jquery-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!--sweetalert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--custom javascript-->
    <script src="../js/password.js" defer></script>
    <script src="../js/user.js" defer></script>
    <script src="../js/header.js" defer></script>
    <title>Password</title>
</head>
<body class='bg-white'>
    <!--header-->
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
    <?php if(isset($_SESSION['user_id'])){?>
    <div class="container-fluid main-content">
        <!--navigation bar-->
        <nav class="navbar navbar-light bg-white">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item"><a href="profile.php" class="nav-link link-dark">Profile</a></li>
                <li class="nav-item"><a href="address.php" class="nav-link link-dark">Addresses</a></li>
                <li class="nav-item"><a href="password.php" class="nav-link active">Change Password</a></li>
            </ul>
        </nav>

        <main>
        <?php
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if(isset($_POST['confirm'])){
                    $result=$user->getUser($_SESSION['user_id']);
                    if($result['password']==md5($_POST['current_password'])){
                        if(preg_match('#^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$#',$_POST['new_password'])){
                            if($_POST['new_password']==$_POST['confirm_password']){
                                if($user->updatePassword($result['user_id'],md5($_POST['new_password']))){
                                    echo "<script>swal('Successfully!', 'Password Modified', 'success');</script>";
                                }
                                else{
                                    echo "<div class='alert alert-danger' role='alert'>Operation encountered an error. Please retry!</div>";
                                }
                            }
                            else{
                                echo "<div class='alert alert-danger' role='alert'>The new password do not match. Please retry!</div>";
                            }
                        }
                        else{
                            echo "<div class='alert alert-danger' role='alert'>Password must have minimum eight characters, at least one letter, one number and one special character</div>";
                        }
                    }
                    else{
                        echo "<div class='alert alert-danger' role='alert'>The original password is wrong. Please retry!</div>";
                    }
                }
                else if(isset($_POST['create'])){
                    $result=$user->getUser($_SESSION['user_id']);
                    if($_POST['new_password']==$_POST['confirm_password']){
                        if($user->updatePassword($result['user_id'],md5($_POST['new_password']))){
                            echo "<script>swal('Successfully!', 'Password Modified', 'success');</script>";
                        }
                        else{
                            echo "<div class='alert alert-danger' role='alert'>Operation encountered an error. Please retry!</div>";
                        }
                    }
                    else{
                        echo "<div class='alert alert-danger' role='alert'>The new password do not match. Please retry!</div>";
                    }
                }
            }
        ?>
            <div>
            <?php $result=$user->getUser($_SESSION['user_id']);
            if($result['password']){
                echo "<h2>Change Password</h2>";
            }
            else{
                echo "<h2>Create Password</h2>";
                $pdo=null;
            }
            ?>
            <p>For your account's security, do not share your password with anyone else</p>
            </div>
            <!--change password section-->
            <?php
            
            if($result['password']){
            echo "<form action='password.php' method='post' class='form'>
                    <table>
                        <tr>
                            <td><label for='current_password'>Current Password</label></td>
                            <td>
                                <div class='valid_section'>
                                    <input type='password' id='current_password' name='current_password' class='form-control' onchange='checkCurrentPassword()'>
                                    <span class='eye' onclick='showCurrentPassword()'>
                                        <i id = 'hide1' class='bi bi-eye-fill'></i>
                                        <i id = 'hide2' class='bi bi-eye-slash-fill'></i>
                                    </span>
                                    <div class = 'i_check'>
                                        <i class='bi bi-check-circle-fill' id='bi-check-circle-fill'></i>
                                        <i class='bi bi-exclamation-circle-fill' id = 'bi-exclamation-circle-fill'></i>
                                        <small>Error Message</small>
                                    </div>
                                </div>
                            </td>
                            <td ><a href='../php/forgotPassword.php' id='forgot'>Forget password?</a></td>
                        </tr>
                        <tr>
                            <td><label for='new_password'>New Password</label></td>
                            <td>
                                <div class='valid_section'>
                                    <input type='password' class='form-control' id='new_password' name='new_password' onchange='checkNewPassword()'>
                                    <span class='eye' onclick='showNewPassword()'>
                                        <i id = 'hide3' class='bi bi-eye-fill'></i>
                                        <i id = 'hide4' class='bi bi-eye-slash-fill'></i>
                                    </span>
                                    <div class = 'i_check'>
                                        <i class='bi bi-check-circle-fill' id='bi-check-circle-fill'></i>
                                        <i class='bi bi-exclamation-circle-fill' id = 'bi-exclamation-circle-fill'></i>
                                        <small>Error Message</small>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for='confirm_password'>Confirm Password</label></td>
                            <td>
                                <div class='valid_section'>
                                    <input type='password' class='form-control' id='confirm_password' name='confirm_password' onchange='checkConfirmPassword()'>
                                    <span class='eye' onclick='showConfirmPassword()'>
                                        <i id = 'hide5' class='bi bi-eye-fill'></i>
                                        <i id = 'hide6' class='bi bi-eye-slash-fill'></i>
                                    </span>
                                    <div class = 'i_check'>
                                        <i class='bi bi-check-circle-fill' id='bi-check-circle-fill'></i>
                                        <i class='bi bi-exclamation-circle-fill' id = 'bi-exclamation-circle-fill'></i>
                                        <small>Error Message</small>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='3' align='center'><input type='submit' value='Confirm' name='confirm' class='btn btn-primary' id='confirm'></td>
                        </tr>
                    </table>
                </form>";
            }
            else{
                echo "<form action='password.php' method='post' class='form'>
                        <table>
                            <tr>
                                <td><label for='new_password'>New Password</label></td>
                                <td>
                                    <div class='valid_section'>
                                        <input type='password' class='form-control' id='new_password' name='new_password' onchange='checkNewPassword()'>
                                        <span class='eye' onclick='showNewPassword()'>
                                            <i id = 'hide3' class='bi bi-eye-fill'></i>
                                            <i id = 'hide4' class='bi bi-eye-slash-fill'></i>
                                        </span>
                                        <div class = 'i_check'>
                                            <i class='bi bi-check-circle-fill' id='bi-check-circle-fill'></i>
                                            <i class='bi bi-exclamation-circle-fill' id = 'bi-exclamation-circle-fill'></i>
                                            <small>Error Message</small>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label for='confirm_password'>Confirm Password</label></td>
                                <td>
                                    <div class='valid_section'>
                                        <input type='password' class='form-control' id='confirm_password' name='confirm_password' onchange='checkConfirmPassword()'>
                                        <span class='eye' onclick='showConfirmPassword()'>
                                            <i id = 'hide5' class='bi bi-eye-fill'></i>
                                            <i id = 'hide6' class='bi bi-eye-slash-fill'></i>
                                        </span>
                                        <div class = 'i_check'>
                                            <i class='bi bi-check-circle-fill' id='bi-check-circle-fill'></i>
                                            <i class='bi bi-exclamation-circle-fill' id = 'bi-exclamation-circle-fill'></i>
                                            <small>Error Message</small>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='3' align='center'><input type='submit' value='Create Password' name='create' class='btn btn-primary' id='confirm'></td>
                            </tr>
                        </table>
                    </form>";
            }
            ?>
        </main>
    </div>
    <?php } else {?>
        <div class='d-flex justify-content-center'>
            <img src='../assets/upload_image/notfound.png' style=' height: 400px; width:600px;'>
        </div>
    <?php } ?>
    <!--footer-->
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
    <script src="../js/password.js" defer></script>
</body>
</html>