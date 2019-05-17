<?php
session_start();
//configuration file
require_once('../constants/config.php');

$email_address = $_POST['email'];
$login = $_POST['password'];

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
//$stmt = $conn->prepare("SELECT email,login,role,avator FROM tbl_admin WHERE email = :email UNION SELECT email,login,role,avator FROM tbl_students WHERE email = :email");
$stmt = $conn->prepare("SELECT email,login,role,avator FROM tbl_admin WHERE email = :email ");
$stmt->bindParam(':email', $email_address);
$stmt->execute();
$result = $stmt->fetchAll();

//getting number of records found
$rec = count($result);

if ($rec > 0) {

foreach($result as $row) {

$role = $row['role'];
$avator = $row['avator'];		

}

switch ($role) {
	case 'admin':
		# verifying password
	if (password_verify($login, $row['login'])) {
		$currency = $conn->prepare("SELECT currency FROM settings WHERE id='1'");
        $currency->execute();
        $result1 = $currency->fetch(PDO::FETCH_ASSOC);
        $_SESSION['currency'] = $result1['currency'];
	admin_login();


	}else{

	$_SESSION['reply'] = "001";
    header("location:../../");

	}
		break;
	
	case 'users':

	if (password_verify($login, $row['login'])) {

	student_login();

	}else{

	$_SESSION['reply'] = "001";
    header("location:../../");

	}
		break;
}

}else{

$_SESSION['reply'] = "001";
header("location:../../");

}

					  
}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}

function admin_login() {

$_SESSION['logged'] = "1";
$_SESSION['role'] = "admin";
$_SESSION['email'] = $GLOBALS['email_address'];
$_SESSION['avator'] = $GLOBALS['avator'];
header("location:../../admin");

}

function student_login() {
$_SESSION['logged'] = "1";
$_SESSION['role'] = "users";
$_SESSION['email'] = $GLOBALS['email_address'];
$_SESSION['avator'] = $GLOBALS['avator'];

try {
	require_once('../constants/config.php');
	
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
	$stmt = $conn->prepare("SELECT * FROM tbl_admin WHERE email = :email");
	$stmt->bindParam(':email', $GLOBALS['email_address']);
	$stmt->execute();
	$result = $stmt->fetchAll();

    foreach($result as $row)
    {
    	$_SESSION['id'] = $row['id'];
		
	}

	header("location:../../admin");
					  
	}catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


}
?>