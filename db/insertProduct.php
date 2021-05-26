<?php
    $host="localhost";
    $db="simple_shopper";
    $user="root";
    $pass="";
    $dsn= "mysql:host=$host;dbname=$db";

    try{
        $pdo=new PDO($dsn,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        throw new PDOException($e->getMessage());
    }
    $file=fopen('item.csv','r');
    while(($column=fgetcsv($file,10000,','))!==FALSE){
        $path=$column[0];
        $name=$column[1];
        $category=$column[2];
        $quantity=(int)$column[3];
        $price=(float)$column[4];
        $description=$column[5];
        $sql="INSERT INTO `product` (product_image,product_name,product_category,product_amount,product_price,product_description) VALUES (:path,:name,:category,:amount,:price,:description)";
        $stmt=$pdo->prepare($sql);
        $stmt->bindparam(':path',$path);
        $stmt->bindparam(':name',$name);
        $stmt->bindparam(':category',$category);
        $stmt->bindparam(':amount',$quantity);
        $stmt->bindparam(':price',$price);
        $stmt->bindparam(':description',$description);
        $stmt->execute();
    }
?>