<?php

class shoppingList{
    private $db;

    function __construct($conn){
        $this->db=$conn;
    }

    public function getShoppingList($userID){
        try{
            $sql="SELECT * FROM `shopping_list` where user_id=:userId";
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':userId',$userID);            
            $stmt->execute();
            $result=$stmt;
            return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getCurrentShoppingList($id){
        try{
            $sql="SELECT * FROM `shopping_list`where list_id=:id" ;
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

    public function deleteShoppingList($id){
        try{
            $sql = "DELETE FROM `shopping_list` where list_id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateShoppingList($id,$listname){
        try{
            $sql="UPDATE `shopping_list` SET list_name=:listname WHERE list_id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->bindparam(':listname',$listname);            
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    public function addShoppingList($listname,$userId){
        try {
            $sql = "INSERT INTO `shopping_list` (list_name,user_id) VALUES (:listname,:userId)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':listname',$listname);                        
            $stmt->bindparam(':userId',$userId);       
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getShoppingListItem($id){
        try{
            $sql="SELECT shopping_list_item.list_id, shopping_list_item.product_id, shopping_list_item.item_quantity, product.product_image, product.product_description, product.product_amount, product.product_price FROM shopping_list_item INNER JOIN product WHERE product.product_id=shopping_list_item.product_id AND shopping_list_item.list_id=:id";
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

    public function deleteShoppingListItem($List_id,$Product_id){
        try{
            $sql = "DELETE FROM `shopping_list_item` where list_id=:Lid and product_id=:Pid";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':Lid',$List_id);
            $stmt->bindparam(':Pid',$Product_id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function updateItemQuantity($qty,$List_id,$Product_id){
        try{
            $sql = "UPDATE `shopping_list_item` SET `item_quantity` = :qty  where list_id=:Lid and product_id=:Pid";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':qty',$qty);
            $stmt->bindparam(':Lid',$List_id);
            $stmt->bindparam(':Pid',$Product_id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function addNewItem($listid,$productid,$qty){
        try{
            $sql = "INSERT INTO `shopping_list_item` (list_id,product_id,item_quantity) VALUES (:listId,:productId,:qty)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':listId',$listid);                        
            $stmt->bindparam(':productId',$productid);
            $stmt->bindparam(':qty',$qty);       
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function addItemToList($listid,$productid,$qty){
        try {
            $sql="SELECT list_id,product_id FROM `shopping_list_item` WHERE list_id=:listId AND product_id=:productId";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':listId',$listid);                        
            $stmt->bindparam(':productId',$productid);
            $stmt->execute();
            $result=$stmt;
            if($result->rowCount()>0){
                $this->updateItemQuantity($qty,$listid,$productid);
            }else{
                $this->addNewItem($listid,$productid,$qty);
            }            
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

}

?>