<?php
    $host='127.0.0.1';
    $db='simple_shopper';
    $user='root';
    $password='';
    $charset='utf8mb4';

    $dsn= "mysql:host=$host;dbname=$db;charset=$charset";

    try{
        $pdo=new PDO($dsn,$user,$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        throw new PDOException($e->getMessage());
    }

    require_once 'user.php';
    $user=new User($pdo);

    require_once '../php/product.php';
    $product1 = new Product($pdo);
?>
