<?php
   session_start();
   include_once("conn.php");

   //For sign up
   if(isset($_POST['btnSign']))
   {
       $con = config::connect();
       $Lname = $_POST['lName'];
       $email = $_POST['Uemail'];
       $phone = $_POST['Uphone'];
       $pwd = sanitizePassword($_POST['Upass']);
       $gender = $_POST['gender'];
       $birth = $_POST['birthdaytime'];
       $status = 'User';

       if($Lname =="" || $email == "" || $phone == "" || $pwd =="" ||
       $gender =="" || $birth == ""){
           return;
       }

       if(checkEmailExist($con, $email))
       {
        echo "Email already been registered";
        return;
       }

       if (insertDetails($con,$Lname, $email, $phone, $pwd, $gender, $birth, $status));
       {
           $_SESSION['Uemail'] = $email;
           header("Location: login.php");
       }
   }


   //For login
   if(isset($_POST['btnLogin']))
   {
       $con = config::connect();
       $email = $_POST['ph_email'];
       $pwd = sanitizePassword($_POST['pwdL']);
       $status = $_POST['statusL'];

       if($email == "" || $pwd ==""){
           echo "email and password cannot be blank";
           return;
       }

       //if user enter email
      if(checkEmail($email))
      {
        if(checkLoginEmail($con,$email,$pwd,$status))
        {
            header("Location: index.php");
        }else{
            echo "The username and password are incorrect";
        }
      }else if(checkPhone($email))
      {
        if(checkLoginPhone($con,$email,$pwd,$status)){
            header("Location: index.php");
        }
      }else{
          echo "The username and password are incorrect";
      }
   }

   //check phone format
   function checkPhone($mobile)
   {
    return preg_match('/^[0-9]{10}+$/', $mobile);
   }

   //check email format
   function checkEmail($email)
   {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
      } else {
            return false;
      }
   }

   function insertDetails($con,$Lname, $email, $phone, $pwd, $gender, $birth, $status)
   {
       $query = $con->prepare("
       INSERT INTO user (password,name,email,phone,gender,dob,status)
       VALUES(:psw,:Lname,:email,:phone,:gender,:dob,:status)
       ");

       $query-> bindParam(":psw",$pwd);
       $query-> bindParam(":Lname",$Lname);
       $query-> bindParam(":email",$email);
       $query-> bindParam(":phone",$phone);
       $query-> bindParam(":gender",$gender);
       $query-> bindParam(":dob",$birth);
       $query-> bindParam(":status",$status);

       return $query->execute();
   }

   function checkLoginEmail($con,$email,$pwd,$status)
   {
     $query = $con->prepare("
     SELECT * FROM user WHERE email=:email AND password=:psw AND status=:status
     ");
     $query-> bindParam(":email",$email);
     $query-> bindParam(":psw",$pwd);
     $query-> bindParam(":status",$status);
     $query->execute();

     //check how many rows

     if($query->rowCount() == 1)
     {
         return true;
     }else{
         return false;
     }
   }

   function checkLoginPhone($con,$email,$pwd,$status)
   {
     $query = $con->prepare("
     SELECT * FROM user WHERE phone=:phone,password=:psw AND status=:status
     ");
     $query-> bindParam(":phone",$email);
     $query-> bindParam(":psw",$pwd);
     $query-> bindParam(":status",$status);
     echo "What happen".$status;
     $query->execute();

     //check how many rows

     if($query->rowCount() == 1)
     {
         return true;
     }else{
         return false;
     }
   }

   function sanitizePassword($pwd)
   {
       $pwd = md5($pwd);

       return $pwd;
   }

   function checkEmailExist($con, $email)
   {
    $query = $con->prepare("
    SELECT * FROM user WHERE email=:email
    ");

    $query->bindParam(":email",$email);

    $query->execute();

    if($query-> rowCount() == 1)
    {
        return true;
    }else{
        return false;
    }
   }
?>
