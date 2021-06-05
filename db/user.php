<?php

class User{
    private $db;

    function __construct($conn){
        $this->db=$conn;
    }

    public function getUser($id){
        try{
            $sql="SELECT *FROM `user` where user_id=:id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->execute();
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteUser($id){
        try{
            $sql = "DELETE FROM `user` where user_id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateProfileWithPic($id,$name,$email,$phone,$gender,$dob,$profile){
        try{
            $sql="UPDATE `user` SET `name`=:name,`email`=:email,`phone`=:phone,`gender`=:gender,`dob`=:dob,`profile`=:profile WHERE user_id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->bindparam(':name',$name);
            $stmt->bindparam(':email',$email);
            $stmt->bindparam(':phone',$phone);
            $stmt->bindparam(':gender',$gender);
            $stmt->bindparam(':dob',$dob);
            $stmt->bindparam(':profile',$profile);

            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateProfile($id,$name,$email,$phone,$gender,$dob){
        try{
            $sql="UPDATE `user` SET `name`=:name,`email`=:email,`phone`=:phone,`gender`=:gender,`dob`=:dob WHERE user_id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->bindparam(':name',$name);
            $stmt->bindparam(':email',$email);
            $stmt->bindparam(':phone',$phone);
            $stmt->bindparam(':gender',$gender);
            $stmt->bindparam(':dob',$dob);
            
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updatePassword($id,$password){
        try{
            $sql="UPDATE `user` SET `password`=:password WHERE user_id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->bindparam(':password',$password);
            
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getAddresses($id){
        try{
            $sql="SELECT *FROM `address` where user_id=:id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->execute();
            $result=$stmt;
            return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getAddress($id){
        try{
            $sql="SELECT *FROM `address` where address_id=:id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->execute();
            $result=$stmt->fetch();
            return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function addAddress($name,$phone,$postal_code,$state,$area,$description,$default_status,$id){
        try {
            $sql = "INSERT INTO `address` (receiptient_name,phone_number,postal_code,state,area,description,default_status,user_id) VALUES (:name,:phone,:postal_code,:state,:area,:description,:default_status,:id)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':name',$name);
            $stmt->bindparam(':phone',$phone);
            $stmt->bindparam(':postal_code',$postal_code);
            $stmt->bindparam(':state',$state);
            $stmt->bindparam(':area',$area);
            $stmt->bindparam(':description',$description);
            $stmt->bindparam(':default_status',$default_status);
            $stmt->bindparam(':id',$id);
            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function editAddress($address_id,$name,$phone,$postal_code,$state,$area,$description,$default_status){
        try{
            $sql="UPDATE `address` SET `receiptient_name`=:name,`phone_number`=:phone,`postal_code`=:postal_code,`state`=:state,`area`=:area,`description`=:description,`default_status`=:default_status WHERE address_id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id',$address_id);
            $stmt->bindparam(':name',$name);
            $stmt->bindparam(':phone',$phone);
            $stmt->bindparam(':postal_code',$postal_code);
            $stmt->bindparam(':state',$state);
            $stmt->bindparam(':area',$area);
            $stmt->bindparam(':description',$description);
            $stmt->bindparam(':default_status',$default_status);
            
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteAddress($id){
        try{
            $sql = "DELETE FROM `address` where address_id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateDefault($id,$default_status){
        if($default_status){
            $result=$this->getAddresses($id);
            while($r=$result->fetch(PDO::FETCH_ASSOC)){
                echo implode($r);
                if($r['default_status']){
                    try{
                        $sql="UPDATE `address` SET `default_status`=0 WHERE address_id=:address_id";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindparam(':address_id',$r['address_id']);
                        
                        $stmt->execute();
                        return true;
                    }
                    catch (PDOException $e) {
                        echo $e->getMessage();
                        return false;
                    }
                }
            }
        }
    }

    public function insertDetails($name, $email, $phone, $pwd, $gender, $birth, $profile,$status)
    {
        try{
            $phone = str_replace("-", "", $phone);
            $sql=" INSERT INTO user (password,name,email,phone,gender,dob,profile,status)
            VALUES(:psw,:name,:email,:phone,:gender,:dob,:profile,:status)";
            $stmt = $this->db->prepare($sql);
    
            $stmt-> bindParam(":psw",$pwd);
            $stmt-> bindParam(":name",$name);
            $stmt-> bindParam(":email",$email);
            $stmt-> bindParam(":phone",$phone);
            $stmt-> bindParam(":gender",$gender);
            $stmt-> bindParam(":dob",$birth);
            $stmt-> bindParam(":profile",$profile);
            $stmt-> bindParam(":status",$status);
 
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    public function insertDetailFacebook($name,$email,$gender,$dob,$profile,$status)
    {
        try{
            $sql = "INSERT INTO user (name,email,gender,dob,profile,status) VALUES(:name,:email,:gender,:dob,:profile,:status)";
            $stmt = $this->db->prepare($sql);
            $stmt-> bindParam(":name",$name);
            $stmt-> bindParam(":email",$email);
            $stmt-> bindParam(":gender",$gender);
            $stmt-> bindParam(":dob",$dob);
            $stmt-> bindParam(":profile",$profile);
            $stmt-> bindParam(":status",$status);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    public function insertDetailGoogle($name,$email,$profile,$status)
    {
        try{
            $sql = "INSERT INTO user (name,email,profile,status) VALUES(:name,:email,:profile,:status)";
            $stmt = $this->db->prepare($sql);
            $stmt-> bindParam(":name",$name);
            $stmt-> bindParam(":email",$email);
            $stmt-> bindParam(":profile",$profile);
            $stmt-> bindParam(":status",$status);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function checkLoginEmail($email,$pwd,$status)
    {
        try{
            $sql = "SELECT * FROM user WHERE email=:email AND password=:psw AND status=:status";
            $stmt = $this->db->prepare($sql);
            $stmt-> bindParam(":email",$email);
            $stmt-> bindParam(":psw",$pwd);
            $stmt-> bindParam(":status",$status);
            $stmt->execute();
        
            //check how many rows
            if($stmt->rowCount() == 1)
            {
                $result=$stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['user_id'] = $result['user_id'];
                $_SESSION['status'] = $result['status'];
                return true;
            }else{
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
 
    public function checkLoginPhone($phone,$pwd,$status)
    {   
        try{
            $phone = str_replace("-", "", $phone);
            $phone = str_replace("+60", "", $phone);
            $sql = "SELECT * FROM user WHERE phone=:phone AND password=:psw AND status=:status";
            $stmt = $this->db->prepare($sql);
            $stmt-> bindParam(":phone",$phone);
            $stmt-> bindParam(":psw",$pwd);
            $stmt-> bindParam(":status",$status);
            $stmt->execute();
            //check how many rows
        
            if($stmt->rowCount() == 1)
            {
                $result=$stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['user_id'] = $result['user_id'];
                $_SESSION['status'] = $result['status'];
                return true;
            }else{
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
 
    public function sanitizePassword($pwd)
    {
        $pwd = md5($pwd);
 
        return $pwd;
    }
 
    public function checkEmailExist($email)
    {
        try{
            $sql = "SELECT * FROM user WHERE email=:email";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(":email",$email);
        
            $stmt->execute();
            
            if($stmt-> rowCount() == 1)
            {
                return true;
            }else{
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function checkPhoneExist($phone)
    {
        try{
            $phone = str_replace("-", "", $phone);
            $phone = str_replace("+6", "", $phone);
            $sql = "SELECT * FROM user WHERE phone=:phone";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(":phone",$phone);
        
            $stmt->execute();
            
            if($stmt-> rowCount() == 1)
            {
                return true;
            }else{
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function checkPhone($mobile)
        {
        return preg_match('/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im', $mobile);
        }
    
    //check email format
    public function checkEmail($email)
        {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
        } else {
                return false;
        }
    }

    public function getUserInfoEmail($email)
    {
        $sql = "SELECT * FROM otp WHERE email=:email";
        $stmt = $this->db->prepare($sql);
        $stmt-> bindParam(":email",$email);
        $stmt->execute();

        if($stmt->rowCount() == 1)
        {
            return $stmt;
        }else{
            return "";
        }
    }

    public function getUserInfoPhone($phone)
    {
        try{
            $sql = "SELECT * FROM `otp` WHERE phone=:phone";
            $stmt = $this->db->prepare($sql);
            $stmt -> bindParam(":phone",$phone);
            $stmt->execute();

            if($stmt->rowCount() == 1)
            {
                return $stmt;
            }else{
                return "";
            }
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function insertOtp($email,$otp, $expires)
    {
        try{
            $sql = "INSERT INTO otp (email,Otp,Expire) VALUES(:email,:otp,:expire)";
            $stmt =  $this->db->prepare($sql);
            $stmt -> bindParam(":email",$email);
            $stmt -> bindParam(":otp",$otp);
            $stmt -> bindParam(":expire",$expires);

            $stmt -> execute();
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }  
    }

    public function insertOtpPhone($phone, $otp, $expires)
    {
        try{
            $sql = "INSERT INTO otp (phone,Otp,Expire) VALUES(:phone,:otp,:expire)";
            $stmt =  $this->db->prepare($sql);
            $stmt -> bindParam(":phone",$phone);
            $stmt -> bindParam(":otp",$otp);
            $stmt -> bindParam(":expire",$expires);

            $stmt -> execute();
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }  
    }

    public function deletePreviousEmail($email)
    {
        try{
            $sql = "DELETE FROM `otp` where email=:email";
            $stmt =  $this->db->prepare($sql);
            $stmt -> bindParam(":email",$email);
            $stmt -> execute(); 
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getUserIdEmail($email)
    {
        try{
            $sql = "SELECT DISTINCT user_id FROM user WHERE email=:email";
            $stmt = $this->db->prepare($sql);
            $stmt-> bindParam(":email",$email);
            $stmt->execute();
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result['user_id'];
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getUserIdPhone($phone)
    {
        try{
        $sql = "SELECT * FROM `user` WHERE phone=$phone";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() == 1)
        {
            return $stmt;
        }else{
            return "";
        }
      }
      catch(PDOException $e){
          echo $e->getMessage();
          return false;
      }
    }

    public function deletePreviousPhone($phone)
    {
        try{
            $sql = "DELETE FROM `otp` where phone=:phone";
            $stmt =  $this->db->prepare($sql);
            $stmt -> bindParam(":phone",$phone);
            $stmt -> execute();
        }catch(PDOException $e){
            echo $e-> getMessage();
            return false;
        }  
    }
}
?>