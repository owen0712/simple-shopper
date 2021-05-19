<?php

include('config.php');

$google_client->revokeToken();

session_destroy();

$days = 30;
setcookie ("rememberme","", time() - ($days * 24 * 60 * 60 * 1000) );

header('location:login.php');
?>