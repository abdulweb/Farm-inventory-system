<?php
session_start();
require_once('../constants/config.php');
require_once('../constants/uniques.php');
require '../mail/PHPMailerAutoload.php';

$email_address = $_POST['email'];

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
$stmt = $conn->prepare("SELECT email,role FROM tbl_admin WHERE email = :email UNION SELECT email,role FROM tbl_students WHERE email = :email");
$stmt->bindParam(':email', $email_address);
$stmt->execute();
$result = $stmt->fetchAll();
$rec = count($result);

if ($rec > 0) {

}else{

$_SESSION['reply'] = "024";
header("location:../../reset-pw");

}

foreach($result as $row)
{
	$role = $row['role'];
	$token = md5(get_rand_alphanumeric(15));
	$reset_link = ''.$instalation_dir.'new-pw?token='.$token.'';
	$message = "We got a request to reset your <b>Online Examination System</b> password, click <a href='$reset_link'>HERE</a> to reset your password, if you ignore this message your password wont be changed";
}

$stmt = $conn->prepare("DELETE from tbl_reset_tokens WHERE user = :email");
$stmt->bindParam(':email', $email_address);
$stmt->execute();

$stmt = $conn->prepare("INSERT INTO tbl_reset_tokens (token, user, role) VALUES (:token, :user, :role)");
$stmt->bindParam(':token', $token);
$stmt->bindParam(':user', $email_address);
$stmt->bindParam(':role', $role);
$stmt->execute();


$mail = new PHPMailer;


$mail->isSMTP();
$mail->Host = $smtp_host;
$mail->SMTPAuth = true;
$mail->Username = $smtp_user;
$mail->Password = $smtp_pass;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom($smtp_user, 'Online Examination System');
$mail->addAddress($email_address);

$mail->isHTML(true);

$mail->Subject = 'Reset Password';
$mail->Body    = $message;
$mail->AltBody = 'You need HTML Mail to view this email';

if(!$mail->send()) {
$_SESSION['reply'] = "026";
header("location:../../reset-pw");
} else {
$_SESSION['reply'] = "025";
header("location:../../reset-pw");
}

					  
}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}

?>
