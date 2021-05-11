<?php
    require_once '../db/conn.php';
    if(isset($_GET['id'])){
        $result=$user->deleteAddress($_GET['id']);
        if($result){
            header('Location:address.php');
        }
        else{
            echo "<div class='alert alert-danger' role='alert'>Operation encountered an error. Please retry!</div>";
        }
    }
?>