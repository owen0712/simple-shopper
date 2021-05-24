<?php
    require_once '../db/conn.php';
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id = $_POST['listid'];        
        $listname=$_POST['listname'];        
        $current= $shoppingList->getCurrentShoppingList($id)->fetch(PDO::FETCH_ASSOC);
        $temp = $shoppingList->getShoppingList();        
        
        if ($listname==$current['list_name']){                        
            header('Location:shoplist.php');
            return;
        }
        if ($listname==""){
            echo "<script>alert(\"Please enter something\");</script>";
            echo "<a href=\"shoplist.php\">Back</a>";
            return;
        }
        while ($t=$temp->fetch(PDO::FETCH_ASSOC)){
        if ($listname==$t['list_name']){
            echo "<script>alert(\"The list name is duplicated please reenter\");</script>";
            echo "<a href=\"shoplist.php\">Back</a>";
            return;}            
        }
        $result=$shoppingList->updateShoppingList($id,$listname);
        if($result){
            header('Location:shoplist.php');
        }else{
            echo "<div class='alert alert-danger' role='alert'>Operation encountered an error. Please retry!</div>";
        }
    }
    else{
        echo "<div class='alert alert-danger' role='alert'>Operation encountered an error. Please retry!</div>";
    }
    
?>