<?php
class Product{
    private $productTable = 'product';
	private $dbConnect;

    public function __construct($conn){
        $this->dbConnect = $conn;
    }

    public function productList(){	
		try{
			$sqlQuery = "SELECT product_id, product_image, product_name, categories.category_name, product_amount, product_price, product_description FROM ".$this->productTable." INNER JOIN categories ON product.category_id = categories.category_id ";
			if(!empty($_POST["search"]["value"]) || isset($_POST["is_category"])){
				$sqlQuery .= "WHERE ";
			}
			if(isset($_POST["is_category"])){
				if(!empty($_POST["search"]["value"])){
					$sqlQuery .= "categories.category_id = '".$_POST["is_category"]."' AND ";
				}
				else{
					$sqlQuery .= "categories.category_id = '".$_POST["is_category"]."' ";
				}
			}
        	if(!empty($_POST["search"]["value"])){
				$sqlQuery .= '(product_description LIKE "%'.$_POST["search"]["value"].'%" ';			
				$sqlQuery .= ' OR product_name LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR categories.category_name LIKE "%'.$_POST["search"]["value"].'%" ';
            	$sqlQuery .= ' OR product_amount LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR product_price LIKE "%'.$_POST["search"]["value"].'%") ';			
			}
        	if(!empty($_POST["order"])){
				$temp = $_POST['order']['0']['column'] + 1;
				$sqlQuery .= 'ORDER BY '.$temp.' '.$_POST['order']['0']['dir'].' ';
			} else {
				$sqlQuery .= 'ORDER BY product_id DESC ';
			}

			$tempQuery = $sqlQuery;
			$temp_stmt = $this->dbConnect->prepare($tempQuery);
			$temp_stmt->execute();
			$filter_row = $temp_stmt->rowCount();

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
				$productRows[] = $product['category_name'];		
				$productRows[] = $product['product_amount'];	
				$productRows[] = $product['product_price'];
				$productRows[] = $product['product_description'];			
				$productRows[] = '<button type="button" name="update" id="'.$product["product_id"].'" class="btn btn-info btn-xs update" style="width: 100px;"><i class="bi bi-pencil-square"></i> Update</button>';
				$productRows[] = '<button type="button" name="delete" id="'.$product["product_id"].'" class="btn btn-danger btn-xs delete" style="width: 100px;"><i class="bi bi-trash"></i> Delete</button>';
				$productData[] = $productRows;
			}
			$output = array(
				"draw"				=>	intval($_POST["draw"]),
				"recordsTotal"  	=>  $numRows,
				"recordsFiltered" 	=> 	$filter_row,
				"data"    			=> 	$productData
			);
			echo json_encode($output);
			$this->dbConnect = null;  //close PDO connection
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
				$this->dbConnect = null;  //close PDO connection
				return true;
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
					$updateQuery="UPDATE ".$this->productTable." SET product_name=:name,category_id=:category,product_amount=:amount,product_price=:price,product_description=:description WHERE product_id ='".$_POST["productId"]."'";
					$stmt = $this->dbConnect->prepare($updateQuery);
					$stmt->bindparam(':name',$name);
					$stmt->bindparam(':category',$category);
					$stmt->bindparam(':amount',$amount);
					$stmt->bindparam(':price',$price);
					$stmt->bindparam(':description',$description);
					$stmt->execute();
				}
				else{
					$updateQuery="UPDATE ".$this->productTable." SET product_image=:image,product_name=:name,category_id=:category,product_amount=:amount,product_price=:price,product_description=:description WHERE product_id ='".$_POST["productId"]."'";
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
				header("Location: ../php/administrator.php");
				$this->dbConnect = null;  //close PDO connection
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
				$insertQuery = "INSERT INTO ".$this->productTable." (product_image, product_name, category_id, product_amount, product_price, product_description) VALUES (:image, :name, :category, :amount, :price, :description)";
				$stmt = $this->dbConnect->prepare($insertQuery);
				$stmt->bindparam(':image',$image);
            	$stmt->bindparam(':name',$name);
            	$stmt->bindparam(':category',$category);
            	$stmt->bindparam(':amount',$amount);
            	$stmt->bindparam(':price',$price);
            	$stmt->bindparam(':description',$description);
            	$stmt->execute();
				move_uploaded_file($_FILES["image"]["tmp_name"], "../assets/upload_image/$image");

				header("Location: ../php/administrator.php");
				$this->dbConnect = null;  //close PDO connection
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
				$this->dbConnect = null;  //close PDO connection
				return true;
			}
			catch (PDOException $e) {
				echo $e->getMessage();
				return false;
			}
		}
    }

	public function addCategory(){
		if(isset($_POST['saveCategory'])){
			try{
				$newCategory = $_POST["newCategory"];
				$insertQuery = "INSERT INTO categories (category_name) VALUES (:newCategory)";
				$stmt = $this->dbConnect->prepare($insertQuery);
            	$stmt->bindparam(':newCategory',$newCategory);
            	$stmt->execute();

				header("Location: ../php/administrator.php");
				$this->dbConnect = null;  //close PDO connection
				return true;
			}
			catch (PDOException $e) {
				echo $e->getMessage();
				return false;
			}
		}
	}
	public function updateProductMaximum(){
        try{
            $sql="SELECT product_price FROM product WHERE product_price = (SELECT MAX(product_price) FROM product)";
            $stmt=$this->dbConnect->prepare($sql);          
            $stmt->execute();
            $result=$stmt;
            return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

	public function showCategory(){
        try{
            $sql="SELECT * FROM categories";
            $stmt=$this->dbConnect->prepare($sql);         
            $stmt->execute();
            $result=$stmt;
            return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

	public function searchWhole(){
        try{
            $sql="SELECT product_id, product_image, product_name,categories.category_name,product_price,product_amount, product_description 
			FROM product INNER JOIN categories ON product.category_id = categories.category_id";
            $stmt=$this->dbConnect->prepare($sql);
            $stmt->execute();
            $result=$stmt;
            return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

	public function searchKeyword($keywords){
        try{
			$key = "%".$keywords."%";
            $sql="SELECT product_id, product_image, product_name,categories.category_name,product_price,product_amount, product_description 
			FROM product INNER JOIN categories ON product.category_id = categories.category_id WHERE product_description LIKE :key";
            $stmt=$this->dbConnect->prepare($sql);
			$stmt->bindparam(':key',$key);
            $stmt->execute();
            $result=$stmt;
            return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

	public function searchCategory($ctgid){
        try{
			$ctg = implode(',',$ctgid);
            $sql="SELECT product_id, product_image, product_name,categories.category_name,product_price,product_amount, product_description 
			FROM product INNER JOIN categories ON product.category_id = categories.category_id WHERE categories.category_id IN (:ctg)";
            $stmt=$this->dbConnect->prepare($sql); 
			$stmt->bindparam(':ctg',$ctg);
            $stmt->execute();
            $result=$stmt;
            return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

	public function searchPrice($min,$max){
        try{
            $sql="SELECT product_id, product_image, product_name,categories.category_name,product_price,product_amount, product_description 
			FROM product INNER JOIN categories ON product.category_id = categories.category_id WHERE product_price BETWEEN :min AND :max ORDER BY product_price ASC";
            $stmt=$this->dbConnect->prepare($sql);
			$stmt->bindparam(':min',$min);
			$stmt->bindparam(':max',$max);
            $stmt->execute();
            $result=$stmt;
            return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}
?>
