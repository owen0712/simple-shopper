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
        $id=$column[0];
        $path=$column[1];
        $name=$column[2];
        $category=$column[3];
        $quantity=(int)$column[4];
        $price=(float)$column[5];
        $description=$column[6];
        $sql="INSERT INTO `product` (product_id,product_image,product_name,category_id,product_amount,product_price,product_description) VALUES (:id,:path,:name,:category,:amount,:price,:description)";
        $stmt=$pdo->prepare($sql);
        $stmt->bindparam(':id',$id);
        $stmt->bindparam(':path',$path);
        $stmt->bindparam(':name',$name);
        $stmt->bindparam(':category',$category);
        $stmt->bindparam(':amount',$quantity);
        $stmt->bindparam(':price',$price);
        $stmt->bindparam(':description',$description);
        $stmt->execute();
    }
?>