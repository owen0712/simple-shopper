<?php

class shoppingList{
    private $db;

    function __construct($conn){
        $this->db=$conn;
    }

    public function getShoppingList(){
        try{
            $sql="SELECT * FROM `shopping_list`";
            $stmt=$this->db->prepare($sql);            
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
    
    public function addShoppingList($listname){
        try {
            $sql = "INSERT INTO `shopping_list` (list_name) VALUES (:listname)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':listname',$listname);                        
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
    
    public function deleteAllShoppingListItem($id){
        try{
            $sql = "DELETE FROM `shopping_list_item` where list_id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
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
}

?>