<?php
class history{
    private $historyTable = 'history';
	private $dbConnect;

    public function __construct($conn){
        $this->dbConnect = $conn;
    }

    public function newView($product_id,$uid){
        try{
            $t=date("Y-m-d H:i:s");
            $sql="INSERT INTO history(product_id,user_id,time) VALUES (:product,:uid,:t)";
            $stmt=$this->dbConnect->prepare($sql);
            $stmt->bindparam(':t',$t);
            $stmt->bindparam(':product',$product_id);
            $stmt->bindparam(':uid',$uid);
            $stmt->execute();
            $result=$stmt;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function updateTime($product_id,$uid){
        try{
            $t=date("Y-m-d H:i:s");
            $sql="UPDATE history SET time=:t WHERE product_id=:product AND user_id=:uid";
            $stmt=$this->dbConnect->prepare($sql);
            $stmt->bindparam(':t',$t);
            $stmt->bindparam(':product',$product_id);
            $stmt->bindparam(':uid',$uid);
            $stmt->execute();
            $result=$stmt;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function updateHistory($product_id, $uid){
        try{
            $sql="SELECT product_id,user_id FROM history WHERE product_id=:product AND user_id=:uid";
            $stmt=$this->dbConnect->prepare($sql);
            $stmt->bindparam(':product',$product_id);
            $stmt->bindparam(':uid',$uid);
            $stmt->execute();
            $result=$stmt;
            if($result->rowCount()>0){
                $this->updateTime($product_id,$uid);
            }else{
                $this->newview($product_id,$uid);
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}
?>