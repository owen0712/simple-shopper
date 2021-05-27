<?php

include('../php/config.php');
include('../php/fb-init.php');
$google_client->revokeToken();

session_destroy(); 
header('location: ../php/login.php');
?>