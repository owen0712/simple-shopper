<?php

if(!session_id()) {
    session_start();
}

require_once ($_SERVER['DOCUMENT_ROOT'].'/simple-shopper/vendor/autoload.php');

$facebook  = new \Facebook\Facebook ([
    'app_id' => '949172155625007',
    'app_secret' => '7362fde56dc28287ae8f3e300ad287b6',
    'default_graph_version' => 'v2.7'
]);
?>