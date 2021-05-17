<?php

    class config{
        public static function connect()
        {
            $host='localhost';
            $db='simple_shopper';
            $user='root';
            $password='';
            $charset='utf8mb4';
            $dsn= "mysql:host=$host;dbname=$db;charset=$charset";
            try{
                $pdo=new PDO($dsn,$user,$password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
            return $pdo;
        }
    }

?>