<?php
    require_once '../db/conn.php';
    if($_SERVER['REQUEST_METHOD']=='POST'){                
        $qty=($_POST['quantity']);
        $PID=($_POST['ProID']);
        $LID=($_POST['ListID']);        
        if ($qty!=''){
            $result=$shoppingList->addItemToList($LID,$PID,$qty);            
        }
        else {
            echo "<script>alert('You must write something');</script>";
        }
    }
?>