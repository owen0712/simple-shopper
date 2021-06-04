<?php
require_once '../db/conn.php'; 

if($_SERVER['REQUEST_METHOD']=='POST'){        
        $qty=($_POST['quantity']);
        $PID=($_POST['ProID']);
        $LID=($_POST['ListID']);     
        echo $qty;           
        echo $PID;
        echo $LID;
        if ($qty!=''){
            $result=$shoppingList->updateItemQuantity($qty,$LID,$PID);            
        }
        else {
            echo "<script>alert('You must write something');</script>";
        }
    
}
?>