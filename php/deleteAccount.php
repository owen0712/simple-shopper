<?php
    require_once '../db/conn.php';
    session_start();
    $result=$user->deleteUser($_SESSION['user_id']);
    if($result){
        session_destroy(); 
        header('Location:login.php');
    }
    else{
        echo "<div class='alert alert-danger' role='alert'>Operation encountered an error. Please retry!</div>";
    }
    $pdo=null;
?>