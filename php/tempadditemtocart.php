<?php
    session_start();
    if(isset($_POST['quantity']))
    {
        $quantity = $_POST['quantity'];
        $id = $_SESSION["id"];
        echo $quantity."<br>";
        echo $id;
        // header('Location:index.php');
    }
?>
