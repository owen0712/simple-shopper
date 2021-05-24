<?php

include('config.php');

$google_client->revokeToken();

session_destroy();
if(isset($_COOKIE['email']) and isset($_COOKIE['pass'])){
    $em = $_COOKIE['email'];
    $pass = $_COOKIE['pass'];
    setcookie('email',$email,time()-1);
    setcookie('pass',$password, time()-1);
}   
header('location:login.php');
?>