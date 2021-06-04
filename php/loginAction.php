<?php
    include ('../php/fb-init.php');
    include ('config.php');
    session_start();
    if($_GET['action']=='fb'){
        $facebook_helper = $facebook->getRedirectLoginHelper();
        $facebook_permissions = ['email'];
        $_SESSION['action']='fb';
        header('Location:'.$facebook_helper->getLoginUrl('http://localhost/simple-shopper/', $facebook_permissions));
    }
    else{
        $_SESSION['action']='google';
        header('Location:'.$google_client->createAuthUrl());
    }
?>
<?php
  $pdo=null;
?>