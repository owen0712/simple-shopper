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


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initialscale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style/design.css">
    <link href="../style/footer.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/jpg" href="../assets/Logo/favicon-32x32.png" />    
    <title>Shopping List </title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                        <a class="nav-link" href="search.php" style="color: white;">Product</a>
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
<br>

<!-- Body -->
<?php 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        //add new shopping list
        if(isset($_POST['addList'])){
            $listname=$_POST['listname'];
            $userId=$_POST['userid'];
            if ($listname!=''){
                $temp=$shoppingList->getShoppingList($userId);
                $duplicate=FALSE;
                while($r=$temp->fetch(PDO::FETCH_ASSOC)){
                    if ($r['list_name']==$listname){
                        $duplicate=TRUE;
                        break;   
                    }                     
                }
                if (!$duplicate){
                    $result=$shoppingList->addShoppingList($listname,$userId);
                    echo "<script>swal('".$listname." list is added successfully',{icon: \"success\"});</script>";
                }
                else{
                    echo "<script>swal('".$listname." is duplicated. Please reenter.',{icon: \"warning\"});</script>";
                }
            }
            else {
                echo "<script>swal('You must write something',{icon: \"warning\"});</script>";
            }            
        }
        else if(isset($_POST['editListName'])){
            $id = $_POST['listid'];        
            $listname=$_POST['listname'];        
            $current= $shoppingList->getCurrentShoppingList($id)->fetch(PDO::FETCH_ASSOC);
            $temp = $shoppingList->getShoppingList($_SESSION['user_id']);
            if ($listname!=$current['list_name']){
                if ($listname!=''){                    
                    $duplicate=FALSE;
                    while($r=$temp->fetch(PDO::FETCH_ASSOC)){
                        if ($r['list_name']==$listname){
                            $duplicate=TRUE;
                            break;   
                        }                     
                    }
                    if (!$duplicate){
                        $result=$shoppingList->updateShoppingList($id,$listname);
                        echo "<script>swal('".$listname." list is edited successfully',{icon: \"success\"});</script>";
                    }
                    else{
                        echo "<script>swal('".$listname." is duplicated. Please reenter.',{icon: \"warning\"});</script>";
                    }
                }
                else {
                    echo "<script>swal('You must write something',{icon: \"warning\"});</script>";
                }
            }
            else{
                echo "<script>swal('".$listname." list is edited successfully',{icon: \"success\"});</script>";
            }
        }      
    }
    // else{
    //     echo "<script>alert('Error occur');</script>";
    //     echo "<div class='alert alert-danger' role='alert'>Operation encountered an error. Please retry!</div>";
    // }
?>

<body>
    <!-- Add new shopping list division -->
    <form id="myDIV" class="header container" method="POST">    
        <h2>My Shopping List</h2>
        <!-- <input onsubmit="newElement()" type="text" id="myInput" placeholder="New Shopping List...">
        <span onclick="newElement()" class="addBtn btn">Add</span> -->
        <input type='hidden' name='userid' value='<?php echo $_SESSION['user_id']?>'/>
        <input name="listname" type="text" id="myInput" placeholder="New Shopping List...">
        <input name="addList" value="Add" type="submit" class="addBtn btn">
        <!-- <input id="addBtn" type="submit" value="Add" > -->
    </form>
    

    <!-- Example of shopping list area-->
    <main class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <!-- Shopping List using bootstrap accordion element-->
        <div class="accordion" id="accordionExample">
            <!-- Shopping List 1-->             
            <?php
                    $result=$shoppingList->getShoppingList($_SESSION['user_id']);
                    $listcount = $result->rowCount();                    
                    if ($listcount == 0 ){
                        echo '<h1 class="text-center">It is currently empty.</h1>';
                        echo '<h1 class="text-center">Create a new list and manage it.</h1>';
                    }
                    else
                    while($r=$result->fetch(PDO::FETCH_ASSOC)){                        
                ?>                
            <div class="accordion-item">
                <!-- Shopping List header button-->
                <h2 class="accordion-header" id="heading<?php echo $r['list_id']; ?>">
                    <button class="accordion-button collapsed accordion-item-list" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $r['list_id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $r['list_id']; ?>">
                        <!-- <p type="button" class="btn btn-outline-danger deleteList" style="border:none; padding: 0 5px 5px 5px; margin-bottom: 8px;"> -->
                        <a onClick='javascript: confirmDeleteList(<?php echo $r['list_id']?>,"<?php echo $r['list_name']?>");'  type="button" class="btn btn-outline-danger" style="border:none; padding: 0 5px 5px 5px; margin-bottom: 8px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="black" class="bi bi-trash-fill" viewBox="0 0 16 16">                                
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg>                            
                        </a>
                        &nbsp;
                    <h6 class="thetext" ><?php echo $r['list_name']; ?></h6>
                        <form style="display: none;" method="POST">                            
                            <input name="listname" value="<?php echo $r['list_name']; ?>" style="margin-bottom: 5px; border-radius: 3px; width:150px;"/>
                            <input type="hidden" name="listid" value="<?php echo $r['list_id']; ?>"/>
                            <input name="editListName" style="padding: none;" type="submit" value="Edit"/>                            
                        </form>
                        </button>
                </h2>                
                <!-- Shopping List body cart info using table to display-->
                <div id="collapse<?php echo $r['list_id']; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $r['list_id']; ?>" data-bs-parent="#accordionExample">                
                    <div class="accordion-body scroll-section">
                        <?php 
                        $total=0;                                
                        $item=$shoppingList->getShoppingListItem((int)$r['list_id']);
                        $count = $item->rowCount();
                        if ($count >0 ){
                        ?>
                        <div class="small-container">
                            <table>                                
                                <tr>
                                    <th>Product</th>
                                    <th style="padding-left: 29px;">Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                                <?php                                
                                while($i=$item->fetch(PDO::FETCH_ASSOC)){ 
                                ?>                    
                                <tr>
                                    <td>
                                        <div class="cart-info">                                        
                                            <?php echo '<img src="../assets/upload_image/'.$i['product_image'].'" width="80" height="80"/>'?>
                                            <div>
                                                <p><?php echo $i['product_description'];?></p>
                                                <small>Price: <?php echo number_format((float)$i['product_price'], 2);?></small>
                                                <?php 
                                                    if ($i['product_amount']==0){
                                                        echo "<p class=\"status outStock\">Out of Stock</p>";
                                                    }
                                                    else{
                                                        if($i['product_amount']>=$i['item_quantity'])
                                                            echo "<p class=\"status available\">Available</p>";
                                                        else
                                                            echo "<p class=\"status outStock\">Quantity Exceed</p>";
                                                    }
                                                ?>                                                
                                                <a onclick='javascript: confirmDeleteItem(<?php echo $i["product_id"]?>,<?php echo $r["list_id"]?>,"<?php echo $i["product_description"]?>");'  type="button" class="remove">Remove</a>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- Quantity box-->
                                    <td>
                                        <div class="quantity buttons_added" style="float: left;">
                                            <input type="hidden" class="ListID" value="<?php echo $r['list_id']; ?>"/>
                                            <input type="hidden" class="ProID" value="<?php echo $i['product_id']; ?>"/>
                                            <input type="hidden" class="ProDescription" value="<?php echo $i['product_description']; ?>"/>
                                            <input type="hidden" class="AvailableQty" value="<?php echo $i['product_amount']; ?>"/>
                                            <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="<?php echo $i['item_quantity'];?>" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button"
                                                value="+" class="plus">
                                        </div>
                                    </td>
                                    <td>RM <?php $subtotal=$i['item_quantity']*$i['product_price'];echo number_format((float)$subtotal, 2);$total+=$subtotal;?></td>
                                </tr>
                                <?php }?>
                            </table>
                            
                            <div class="total-price">
                                <table>
                                    <td>Total</td>
                                    <td class="totalItemPrice">RM <?php echo number_format($total,2);?></td>
                                </table>
                            </div>
                        </div>
                        <?php }else{?>
                            <div class="small-container">
                                <h3 class="text-center"> It is an Empty Shopping List </h3>
                                <p class="text-muted text-center">Add item from <a class="backIndex" style="text-decoration:none;" href="../index.php"> HOME</a> page.</p>
                            </div>
                        <?php } ?>     
                    </div>
                </div>
            </div>
            <br>
                <?php } ?>
            </div>            
        </div>
    </main>

    <!-- Footer-->
    <div class="footer">
        <div class="container">
            <div class="row justify-content-center">
                <div class="footer-col-1">
                    <h4>Download Our App</h4>
                    <p>Download App for Android and iOS mobile phone.</p>
                    <div class="app-logo">
                        <img src="../assets/footer/play-store.png">
                        <img src="../assets/footer/app-store.png">
                    </div>
                </div>
                <div class="footer-col-2">
                    <h4>Payment</h4>
                    <img src="../assets/footer/Visa+Brand+Mark+-+Blue+-+900x291.jpg">
                    <img src="../assets/footer/300px-Mastercard_2019_logo.svg.png" style="background-color: white;">
                    <img src="../assets/footer/FPX-Logo-1.png" style="background-color: white;">
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
    


    <!-- Imported script-->        
    <script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>    
    <script src="../js/header.js" ></script>    
    <script src="../js/script.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>
<?php $pdo=null; ?>
</html>