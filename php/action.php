<?php
require_once('../db/conn.php');
if(!empty($_POST['action']) && $_POST['action'] == 'listProduct') {
	$product1->productList();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addProduct') {
	$product1->addProduct();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getProduct') {
	$product1->getProduct();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateProduct') {
	$product1->updateProduct();
}
if(!empty($_POST['action']) && $_POST['action'] == 'productDelete') {
	$product1->deleteProduct();
}
if(!empty($_POST['actionCategory']) && $_POST['actionCategory'] == 'addCategory') {
	$product1->addCategory();
}
?>