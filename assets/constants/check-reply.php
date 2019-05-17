<?php

if (isset($_SESSION['reply'])) {
	$error_code = $_SESSION['reply'];

    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
    $stmt = $conn->prepare("SELECT * FROM tbl_alerts WHERE code = :errorcode");
	$stmt->bindParam(':errorcode', $error_code);
    $stmt->execute();
    $reply = $stmt->fetchAll();

    foreach($reply as $row)
    {
        //echo "<script>alert('".$row['description']."');</script>";
        print '<div class="alert alert-'.$row['type'].' mb-2" role="alert">'.$row['description'].'</div>';
	}

					  
	}catch(PDOException $e)
    {

    }

    unset($_SESSION['reply']);


}

?>