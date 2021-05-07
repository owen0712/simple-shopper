<?php
//config.php

require_once '../vendor/autoload.php';

$google_client = new Google_Client();

$google_client-> setClientId('458382258443-vs5h4p1lfsdgsf8iaeuor6ekq06s33js.apps.googleusercontent.com');

$google_client->setClientSecret('A7_q3KeFYchFiakdfMP6zeDI');

$google_client->setRedirectUri('http://localhost/simple-shopper/php/');

$google_client ->addScope('email');

$google_client->addScope('profile');

session_start();
?>