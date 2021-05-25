<?php

include('../php/config.php');

$google_client->revokeToken();

session_destroy(); 
header('location: ../php/login.php');
?>