<?php
include ('..\dbh.php');
include ('..\user.php');
if(isset($_POST['edit_product']))
{
	 $id=$_POST['row_id'];
	 $productName=$_POST['productName'];
	 $productPrice=$_POST['productPrice'];
	 $productQuantity=$_POST['productQuantity'];

	 $object = $object->update_row($productName,$productPrice,$productQuantity,$id);
}

if (isset($_POST['edit_cat'])) {
	$id = $_POST['row_id'];
	$name = $_POST['name'];

	$object = $object->update_cat($name, $id);
}

if (isset($_POST['delete_cat'])) {
	$id = $_POST['row_id'];
	$object = $object->delete_cat($id);
}

if (isset($_POST['delete_product'])) {
	$id = $_POST['row_id'];
	$object = $object->delete_product($id);
}

if (isset($_POST['addCart'])) {
	$quantity = $_POST['quantity'];
	// $productID = $_POST['productID'];
	// $custName = $_POST['custName'];
	$object = $object->cart($quantity);
}

?>