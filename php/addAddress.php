<?php
    require_once '../db/conn.php';
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $postal_code=$_POST['postal_code'];
        $state=$_POST['state'];
        $area=$_POST['area'];
        $description=$_POST['description'];
        if(empty($_POST['default_status'])){
            $default_status=0;
        }
        else{
            $default_status=1;
        }
        $id=$_POST['id'];
        $user->updateDefault($id,$default_status);
        $result=$user->addAddress($name,$phone,$postal_code,$state,$area,$description,$default_status,$id);
        if($result){
            header('Location:address.php');
        }
        else{
            echo "<div class='alert alert-danger' role='alert'>Operation encountered an error. Please retry!</div>";
        }
    }
    else{
        echo "<div class='alert alert-danger' role='alert'>Operation encountered an error. Please retry!</div>";
    }
?>