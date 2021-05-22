<?php
    if(isset($_POST['quantity']))
    {
        $quantity = $_POST['quantity'];
        $id = $_GET['id'];
        echo $quantity."<br>";
        echo $id;
        // header('Location:index.php');
    }
?>