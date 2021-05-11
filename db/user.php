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
            $result=$stmt->fetch();
            return $result;
        }
        catch(PDOException $e){
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
}

?>