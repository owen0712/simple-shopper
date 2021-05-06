<?php

//start the session
session_start();

require '../vendor/autoload.php';

$fb = new Facebook\Facebook ([
    'app_id' => '949172155625007',
    'app_secret' => '7362fde56dc28287ae8f3e300ad287b6',
    'default_graph_version' => 'v2.7'
]);

$helper = $fb ->getRedirectLoginHelper();
$login_url = $helper -> getLoginUrl("http://localhost/simple-shopper/php/login.php");

try {
    $accessToken = $helper->getAccessToken();
    if (isset($accessToken)) {
        $_SESSION['access_token'] = (string) $accessToken;  //conver to string
        //if session is set we can redirect to the user to any page 
        header("Location:index.php");
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

//now we will get users first name , email , last name
if (isset($_SESSION['access_token'])) {

    try {

        $fb->setDefaultAccessToken($_SESSION['access_token']);
        $res = $fb->get('/me?locale=en_US&fields=name,email');
        $user = $res->getGraphUser();
        echo 'Hello, ',$user->getField('name');
        
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
?>