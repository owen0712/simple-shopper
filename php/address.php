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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!--custom css-->
    <link rel="stylesheet" href="../style//footer.css">
    <link rel="stylesheet" href="../style/setting.css">
    <link rel="stylesheet" type="text/css" href="../style/address.css">
    <!--fav icon-->
    <link rel="shortcut icon" type="image/jpg" href="../assets/Logo/favicon-32x32.png"/>
    <!--custom javascript-->
    <script src="../js/address.js" defer></script>
    <script src="../js/header.js" defer></script>
    <!--sweetalert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--bootstrap js and jquery-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>Address</title>
</head>
<body class='bg-white'>
    <!--add address form-->
    <div id="add_address">
        <form id="new_address" method="POST" action="addAddress.php">
            <button type="button" class="btn-close" aria-label="Close" onclick="closeForm()"></button>
            <div class="container row">
                <h3 id="title">Add A New Address</h3>
                <input type='hidden' name='id' value='<?php echo $_SESSION['user_id']?>'/>
                <div class="form-floating mb-3 col-lg-6">
                    <input type="text" class="form-control" id="name" name='name' placeholder="Full Name" required>
                    <label class="text-label" for="name">Full Name</label>
                </div>
                <div class="form-floating col-lg-6">
                    <input type="text" class="form-control" id="phone" name='phone' placeholder="Phone Number" required>
                    <label class="text-label" for="phone">Phone Number</label>
                </div>
                <div class="form-floating col-lg-6">
                    <input type="text" class="form-control" id="postal_code" name='postal_code' placeholder="Postal Code" minlength="5" maxlength="5" required>
                    <label class="text-label" for="postal_code">Postal Code</label>
                </div>
                <div class="form-floating col-lg-6">
                    <select name="state" class="form-select" id="state" name='state' required>
                        <option value="" selected></option>
                        <option value="Perak">Perak</option>
                        <option value="Penang">Penang</option>
                        <option value="Johor">Johor</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                        <option value="Labuan">Labuan</option>
                        <option value="Melaka">Melaka</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Perlis">Perlis</option>
                        <option value="Putrajaya">Putrajaya</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Terengganu">Terengganu</option>
                    </select>
                    <label class="text-label" for="state">State</label>
                </div>
                <div class="form-floating col-lg-6">
                    <input type="text" id="area" class="form-control" name='area' placeholder="Area" required>
                    <label class="text-label" for="area">Area</label>
                </div>
                <div class="form-floating col-lg-6">
                    <input type="textarea" id="description" class="form-control" name='description' placeholder="Building, Street, and etc">
                    <label class="text-label" for="description">Building, Street, and etc</label>
                </div>
                <div class="col-lg-12">
                    <input type="checkbox" id="default_checked" name='default_status'>
                    <label for="default_checked">Set as Default Address</label>
                </div>
                <div class="col-lg-12">
                    <input type="submit" value="SUBMIT" class="btn btn-success">
                </div>
            </div>
        </form>
    </div>

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
    <header class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
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
    <?php if(!empty($_SESSION['user_id'])){?>
    <div class="container-fluid main-content">
        <!--navigation bar-->
        <nav class="navbar navbar-light bg-white">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item"><a href="profile.php" class="nav-link link-dark">Profile</a></li>
                <li class="nav-item"><a href="address.php" class="nav-link active">Addresses</a></li>
                <li class="nav-item"><a href="password.php" class="nav-link link-dark">Change Password</a></li>
            </ul>
        </nav>
        <!--address section output using javascript-->
        <main>
            <div>
                <h2>My Addresses</h2>
                <button class="btn btn-primary" id="add_btn" onclick="newForm()"><i class="bi bi-plus-square"></i> Add New Address</button>
            </div>
            <div id="addresses">
                <?php
                    $result=$user->getAddresses($_SESSION['user_id']);
                    while($r=$result->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <div class="address shadow p-3 mb-5 bg-white rounded">
                        <label class='id'><?php echo $r['address_id']; ?></label>
                        <button class="btn btn-danger delete" onclick="deleteAddress(<?php echo $r['address_id']?>)"><i class="bi bi-trash"></i> Delete</button>
                        <a href="editAddressForm.php?id=<?php echo $r['address_id'];?>"><button class="btn btn-info edit" id="edit_btn"><i class="bi bi-pencil-square"></i> Edit</button></a>
                        <table>
                            <?php if($r['default_status']) echo "<tr><td colspan='2'><strong>Default Address</strong></td></tr>" ?>
                            <tr>
                                <td>Full Name</td>
                                <td class="name"><?php echo $r['receiptient_name']; ?></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>+6<?php echo $r['phone_number']; ?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td><?php echo $r['description'].','.$r['postal_code'].','.$r['area'].','.$r['state']; ?></td>
                            </tr>
                        </table>
                    </div>
                <?php } ?>
            </div>
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
    <?php $pdo=null; ?>
</body>
</html>