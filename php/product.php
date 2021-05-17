<?php
class Product{
    private $productTable = 'product';
	private $dbConnect;

    public function __construct($conn){
        $this->dbConnect = $conn;
    }

    public function productList(){	
		try{
			$sqlQuery = "SELECT * FROM ".$this->productTable." ";
        	if(!empty($_POST["search"]["value"])){
				$sqlQuery .= 'where(product_description LIKE "%'.$_POST["search"]["value"].'%" ';			
				$sqlQuery .= ' OR product_name LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR product_category LIKE "%'.$_POST["search"]["value"].'%" ';
            	$sqlQuery .= ' OR product_amount LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR product_price LIKE "%'.$_POST["search"]["value"].'%") ';			
			}
        	if(!empty($_POST["order"])){
				$temp = $_POST['order']['0']['column'] + 1;
				$sqlQuery .= 'ORDER BY '.$temp.' '.$_POST['order']['0']['dir'].' ';
			} else {
				$sqlQuery .= 'ORDER BY product_id DESC ';
			}
			if($_POST["length"] != -1){
				$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
			}

			$sqlQuery1 = "SELECT * FROM ".$this->productTable." ";
			$stmt1 = $this->dbConnect->prepare($sqlQuery1);
			$stmt1->execute();
			$numRows = $stmt1->rowCount();

			$stmt = $this->dbConnect->prepare($sqlQuery);
			$stmt->execute();
			$productData = array();	
			while($product = $stmt->fetch(PDO::FETCH_ASSOC)) {		
				$productRows = array();			
				$productRows[] = $product['product_id'];
            	$productRows[] = '<img src="../assets/upload_image/'.$product['product_image'].'" alt="image" style="width: 100px; height: 100px;">';
				$productRows[] = $product['product_name'];
				$productRows[] = $product['product_category'];		
				$productRows[] = $product['product_amount'];	
				$productRows[] = $product['product_price'];
				$productRows[] = $product['product_description'];			
				$productRows[] = '<button type="button" name="update" id="'.$product["product_id"].'" class="btn btn-warning btn-xs update">Update</button>';
				$productRows[] = '<button type="button" name="delete" id="'.$product["product_id"].'" class="btn btn-danger btn-xs delete" >Delete</button>';
				$productData[] = $productRows;
			}
			$output = array(
				"draw"				=>	intval($_POST["draw"]),
				"recordsTotal"  	=>  $numRows,
				"recordsFiltered" 	=> 	$numRows,
				"data"    			=> 	$productData
			);
			echo json_encode($output);
			return true;
		} 
		catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getProduct(){
		if($_POST["productId"]) {
			try{
				$sqlQuery = "SELECT * FROM ".$this->productTable." WHERE product_id = '".$_POST["productId"]."'";
				$stmt = $this->dbConnect->prepare($sqlQuery);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				echo json_encode($row);
			}
			catch (PDOException $e) {
				echo $e->getMessage();
				return false;
			}
		}
    }

    public function updateProduct(){
		if($_POST['productId']) {
			try{
				$image = $_FILES["image"]["name"];
				$name = $_POST["name"];
				$category = $_POST["category"];
				$amount = $_POST["amount"];
				$price = $_POST["price"];	
				$description = $_POST["description"];
				if($image == ""){
					$updateQuery="UPDATE ".$this->productTable." SET product_name=:name,product_category=:category,product_amount=:amount,product_price=:price,product_description=:description WHERE product_id ='".$_POST["productId"]."'";
					$stmt = $this->dbConnect->prepare($updateQuery);
					$stmt->bindparam(':name',$name);
					$stmt->bindparam(':category',$category);
					$stmt->bindparam(':amount',$amount);
					$stmt->bindparam(':price',$price);
					$stmt->bindparam(':description',$description);
					$stmt->execute();
				}
				else{
					$updateQuery="UPDATE ".$this->productTable." SET product_image=:image,product_name=:name,product_category=:category,product_amount=:amount,product_price=:price,product_description=:description WHERE product_id ='".$_POST["productId"]."'";
					$stmt = $this->dbConnect->prepare($updateQuery);
					$stmt->bindparam(':image',$image);
					$stmt->bindparam(':name',$name);
					$stmt->bindparam(':category',$category);
					$stmt->bindparam(':amount',$amount);
					$stmt->bindparam(':price',$price);
					$stmt->bindparam(':description',$description);
					$stmt->execute();
					move_uploaded_file($_FILES["image"]["tmp_name"], "../assets/upload_image/$image");
				}
				header("Location: ../src/administrator.php");
            	return true;	
			}
			catch (PDOException $e) {
				echo $e->getMessage();
				return false;
			}
		}	
    }

    public function addProduct(){
		if(isset($_POST['save'])){
			try{
				$image = $_FILES["image"]["name"];
				$name = $_POST["name"];
				$category = $_POST["category"];
				$amount = $_POST["amount"];
				$price = $_POST["price"];
				$description = $_POST["description"];
				$insertQuery = "INSERT INTO ".$this->productTable." (product_image, product_name, product_category, product_amount, product_price, product_description) VALUES (:image, :name, :category, :amount, :price, :description)";
				$stmt = $this->dbConnect->prepare($insertQuery);
				$stmt->bindparam(':image',$image);
            	$stmt->bindparam(':name',$name);
            	$stmt->bindparam(':category',$category);
            	$stmt->bindparam(':amount',$amount);
            	$stmt->bindparam(':price',$price);
            	$stmt->bindparam(':description',$description);
            	$stmt->execute();
				move_uploaded_file($_FILES["image"]["tmp_name"], "../assets/upload_image/$image");

				header("Location: ../src/administrator.php");
				return true;
			}
			catch (PDOException $e) {
				echo $e->getMessage();
				return false;
			}
		}
    }

    public function deleteProduct(){
		if($_POST["productId"]) {
			try{
				$sqlDelete = "DELETE FROM ".$this->productTable." WHERE product_id = '".$_POST["productId"]."'";		
				$stmt = $this->dbConnect->prepare($sqlDelete);
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
?>