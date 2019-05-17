<?php
session_start();
require_once('../constants/config.php');
$usermail = $_SESSION['reset_email'];
$userole = $_SESSION['reset_role'];
$newpw = password_hash($_POST['password'], PASSWORD_DEFAULT);

switch ($userole) {
	case 'admin':

	try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
	$stmt = $conn->prepare("UPDATE tbl_admin SET login = :login WHERE email = :email");
	$stmt->bindParam(':login', $newpw);
	$stmt->bindParam(':email', $usermail);
	$_SESSION['reply'] = "023";
	header("location:../../");
	

	$stmt->execute();
					  
	}catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

		break;
	
	case 'student':
	
	try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
	$stmt = $conn->prepare("UPDATE tbl_students SET login = :login WHERE email = :email");
	$stmt->bindParam(':login', $newpw);
	$stmt->bindParam(':email', $usermail);
	$_SESSION['reply'] = "023";
	header("location:../../");
	

	$stmt->execute();
					  
	}catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


		break;
}

?>