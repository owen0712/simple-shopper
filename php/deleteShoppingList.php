<?php
    require_once '../db/conn.php';
    if(isset($_GET['id'])){                
        $result1=$shoppingList->deleteAllShoppingListItem($_GET['id']);
        $result=$shoppingList->deleteShoppingList($_GET['id']);
        if($result){            
            header('Location:shoplist.php');
        }
        else{
            echo "<div class='alert alert-danger' role='alert'>Operation encountered an error. Please retry!</div>";
        }
    }
    else if(isset($_GET['Product_id']) and isset($_GET['List_id'])){
        $result=$shoppingList->deleteShoppingListItem($_GET['List_id'],$_GET['Product_id']);                
        if($result){            
            header('Location:shoplist.php');
        }
        else{
            echo "<div class='alert alert-danger' role='alert'>Operation encountered an error. Please retry!</div>";
        }
    }
?>