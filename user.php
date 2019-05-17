<?php
session_start();
/**
* 
*/
class user extends dbh
{
	

	
	// function __construct(argument)
	// {
	// 	# code...
	// }


	public function login($username, $password)
	{
		if($username == 'admin@admin.com' && $password == 'pass3word')
		{
			$_SESSION['user'] = $username;
			$_SESSION['usertype'] = 'superAdmin';
			$error = 0;
			header('location:admin/index.php');
		}
		else
		{
			$sql = "SELECT * FROM user_tb where email = '$username' AND password = '$password'";
			$result = $this->connect()->query($sql);
			$numberrows = $result->num_rows;
			if ($numberrows > 0) 
			{
				$rows= $result->fetch_assoc();
				$userType = $rows['usertype'];
				if($userType == 'staff')
				{
					$_SESSION['user'] = $username;
					$_SESSION['usertype'] = $userType;
					$error = 0;
					header('location:staff/home.php');
				}
				elseif($userType == 'student')
				{
					$_SESSION['user'] = $username;
					$_SESSION['usertype'] = $userType;
					$error = 0;
					header('location:student/home.php');
				}
				else{
					$error = 1;
					$oldmail = $username;
					//return $oldmail;
					echo  $this->messages($error);	
				}
				
			}
			else{
				$error = 1;
				$oldmail = $username;
				//return $oldmail;
				echo  $this->messages($error);	
			}
			
		}
		
	}

	public function messages($message)
	{
		if ($message == 1) {
			return '<div class ="alert alert-danger"> Wrong username and password </div>';
		}
		if($message == 2)
		{
			return '<div class ="alert alert-danger"> Attension!!! Unthorize user </div>';
		}
		// else{
		// 	return 'success';
		// }
	}

	public function sessioncheck($sess)
	{
		if ($sess =='' or empty($sess) or $sess == null) 
		{
			header('location:..\index.php');
		}
		else{
			//return $sess;
		}
	}
	public function emptysession ($set){
		unset($set);
		header('location:..\index.php');
	}

	public function insertAdminStaff($email, $phone)
	{
		if (empty($this->checkAdminStaff($email))) 
		{
			$date = date('Y-m-d');
			$hash_phone = substr(md5($phone), 0,8) ;
			$Subject = 'Zamfara Schorlaship Board';
			$Mssg = 'Your Login Detail is as follows  username : ' . $email . ' Password : ' . $hash_phone;
			$mail = new PHPMailer();

            $mail->IsSMTP();
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
            $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->Port       = 465; //or 587

            $mail->Username   = "binraheem01@gmail.com";  // GMAIL username
            $mail->Password   = "babatunde";            // GMAIL password
            $mail ->SetFrom('Zamfara Schorlaship Board');

            $mail->From     = $email;
            $mail->FromName   = "no-reply";
            $mail->Subject    = $Subject;
            $mail->Body    = $Mssg; //Text Body
            $mail->WordWrap   = 50; // set word wrap
            $mail ->AddAddress($email);
            // $mail->AddAttachment('images/'.$Uname.'.pdf');
            if(!$mail->Send())
            {
               echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Message not Send. Please connect to internet </strong> </div>';
               echo "Mailer Error: " . $mail->ErrorInfo;
               exit;
            }
            else
            {

				$insert = "INSERT INTO user_tb(email, password, phone, usertype,date_create) Values('$email','$hash_phone','$phone','staff','$date')";
				$stmt = $this->connect()->query($insert);
				if (!$stmt) {
					echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again </strong> </div>';
				}
				else
				{
					echo '<div class ="alert alert-success"> 
						<strong> New Admin Staff Added 
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
						</strong> </div>';
				}

            }


		}
		else{
			echo $this->checkAdminStaff($email);
		}
		
	}

	public function checkAdminStaff($email){
		$stmt = "SELECT * FROM user_tb where email = '$email'";
		$result = $this->connect()->query($stmt); 
		if (($result->num_rows)> 0) {
			return '<div class ="alert alert-danger"> <strong> Sorry !!! Admin Staff Already Exist 
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			</strong> </div>';
			 
		}
		else{

		}
	}

	public function getAdminStaff(){
		$stmt = "SELECT * FROM user_tb where usertype ='staff' ORDER BY email ASC";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			$counter = 1;
			while ($rows= $result->fetch_assoc()) {
				echo '<tr>
                    <td>'.$counter.'</td>
                    <td>'.$rows['email'].'</td>
                    <td>'.$rows['phone'].'</td>
                    <td>'.$rows['date_create'].'</td>
                    <td>
                    <a href="" class="btn btn-info btn-sm">View</a>
                    <a href="delete.php?id='.htmlentities($rows['id']).'" class="btn btn-danger btn-sm" onclick="return confirm(\'sure to delete !\');" >Delete</a>
                    </td>
                </tr>';
                
			$counter++;}

			
		}
	}

	public function delete($id){
		$stmt = "DELETE FROM user_tb WHERE id = '$id'";
		$result = $this->connect()->query($stmt);
		if (!$result) {
			$_SESSION['message'] = '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again </strong> </div>';
			header('location:manageAdmin.php');
		}
		else{
			$_SESSION['message'] = '<div class ="alert alert-success"> 
						<strong> Staff Record Deleted
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
						</strong> </div>';
			header('location:manageAdmin.php');
		}
	}

	public function getAllclassroom(){
		$stmt = "SELECT * FROM classes";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			$counter = 1;
			while ($rows= $result->fetch_assoc()) {?>
				<option value= "<?=$rows['id'] ?>"> <?=$rows['class_name']?></option>
			<?php
		}
			
		}
	}

	public function getProduct(){
		$stmt = "SELECT * FROM product";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			while ($rows= $result->fetch_assoc()) {
				$row_date [] = $rows;
		}
		 return $row_date;
			
		}
		else{
			return '';
		}
	}

	public function insertProduct($productName,$productPrice,$productQuantity,$productCategory){
		if (empty($this->checkProduct($productName))) 
		{
			$storeProduct = strtoupper($productName);
			$date = date('Y-m-d');
			$insert = "INSERT INTO product(productName,productPrice,quantity,productCategory,date_create)Values('$storeProduct','$productPrice','$productQuantity','$productCategory','$date')";
			$stmt = $this->connect()->query($insert);
			if (!$stmt) {
				echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again </strong> </div>';
			}
			else
			{
				echo '<div class ="alert alert-success"> <strong> New Product Added Successfully  </strong> </div>';
			}

		}
		else{
			echo $this->checkProduct($productName);
		}
	}

	public function checkProduct($productName){
		$storeProduct = strtoupper($productName);
		$stmt = "SELECT * FROM product where productName = '$storeProduct' ";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows; 
		if (($numberrows)> 0) {
			return '<div class ="alert alert-danger"> <strong> Sorry !!! Product  Already Exist  </strong> </div>';
			 
		}
		else{

		}
	}

	public function update_row($productName,$productPrice,$productQuantity,$id){

	 $upper_productName = strtoupper($productName);
	 $stmt = "UPDATE product set productName = '$upper_productName', productPrice = '$productPrice', quantity ='$productQuantity' where id = '$id'";
	 $result = $this->connect()->query($stmt);
	 if($result)
	 {
	 	echo "success";
	 }
	 else{
	 	echo '<script>alert("Please Try Agin. Error Occured")</script>';
	 }
	 	
	 exit();

	}

	public function productCategory(){
		$stmt = "SELECT * FROM categories";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			while ($rows= $result->fetch_assoc()) {
				$row_date [] = $rows;
		}
		 return $row_date;
			
		}
		else{
			return '';
		}
	}

	public function storeCategory($catName){
		if (empty($this->checkCategory($catName))) 
		{
			$storecatName = strtoupper($catName);
			$date = date('Y-m-d');
			$insert = "INSERT INTO categories(name,date_add)Values('$storecatName','$date')";
			$stmt = $this->connect()->query($insert);
			if (!$stmt) {
				echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again </strong> </div>';
			}
			else
			{
				echo '<div class ="alert alert-success"> <strong> New category Added Successfully  </strong> </div>';
			}

		}
		else{
			echo $this->checkCategory($catName);
		}
	}

	public function checkCategory($catName){
		$storecatName = strtoupper($catName);
		$stmt = "SELECT * FROM categories where name = '$storecatName' ";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows; 
		if (($numberrows)> 0) {
			return '<div class ="alert alert-danger"> <strong> Sorry !!! category  Already Exist  </strong> </div>';
			 
		}
		else{

		}
	}

	public function update_cat($name,$id){
	 $upname = strtoupper($name);
	 $stmt = "UPDATE categories set name = '$upname' where id = '$id'";
	 $result = $this->connect()->query($stmt);
	 if($result)
	 {
	 	echo "success";
	 }
	 else{
	 	
	 }
	 	
	 exit();

	}

	public function delete_cat($id)
	{
		$stmt = "DELETE FROM categories where id = '$id'";
		$result = $this->connect()->query($stmt);
		if ($result) {
			echo "success";
		}
		else{
			echo '<script>alert("Please Try Agin. Error Occured")</script>';
		}
	}

	public function delete_product($id)
	{
		$stmt = "DELETE FROM product where id = '$id'";
		$result = $this->connect()->query($stmt);
		if ($result) {
			echo "success";
		}
		else{
			echo '<script>alert("Please Try Agin. Error Occured")</script>';
		}
	}
	
	public function getProductCategory($id)
	{
		$stmt = "SELECT Name FROM categories where id = '$id'";
		$result= $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows > 0) {
			$data = $result->fetch_assoc();
			$string = implode('|',$data);
			return $string;
		}
		else{

		}
	}

	public function getAllCustomers()
	{
		$stmt = "SELECT * FROM customers";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			while ($rows= $result->fetch_assoc()) {
				$row_date [] = $rows;
		}
		 return $row_date;
			
		}
		else{
			return '';
		}
	}
	
	public function storeCustomer($name,$phoneNo,$email,$address){
		if (empty($this->checkCustomer($phoneNo,$email))) 
		{
			$date = date('Y-m-d');
			$insert = "INSERT INTO customers(fullName,phoneNo,address,email,date_add)Values('$name','$phoneNo','$address','$email','$date')";
			$stmt = $this->connect()->query($insert);
			if (!$stmt) {
				echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again </strong> </div>';
			}
			else
			{
				// echo '<div class ="alert alert-success"> <strong> New customer Added Successfully  </strong> </div>';
				echo '<script>
							swal("Deleted!", "Your Record has been deleted.", "success");
	                    	setTimeout(function(){// wait for 5 secs(2)
	                       location.reload(); // then reload the page.(3)
	                  		}, 1000); 
					</script>';
			}

		}
		else{
			echo $this->checkCustomer($phoneNo,$email);
		}
	}

	public function checkCustomer($phoneNo,$email){

		$stmt = "SELECT * FROM customers where phoneNo = '$phoneNo' OR email = '$email' ";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows; 
		if (($numberrows)> 0) {
			return '<div class ="alert alert-danger"> <strong> Sorry !!! customer  Already Exist  </strong> </div>';
			 
		}
		else{

		}
	}



/* ===================================================================*/

	public function getclassName($id){
		$stmt =  "SELECT * from classes where id ='$id'";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		$rows = $result->fetch_assoc(); 
		$className = $rows['class_name'];
		//echo $numberrows;
		return $className;
	}

	public function getstudentNumber($id){
		$stmt =  "SELECT * from students where student_class ='$id'";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		return $numberrows;
	}

	
	public function getstudent(){
		$stmt = "SELECT * FROM students";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			$counter = 1;
			while ($rows= $result->fetch_assoc()) {
				echo '<tr>
                    <td>'.$counter.'</td>
                    <td>'.$rows['student_fname']. " ". $rows['student_oname'].'</td>
                    <td>'.$this->getclassName($rows['student_class']).'</td>
                    <td>'. ''.'</td>
                </tr>';
                $counter++;
			}
			
		}
	}

	public function insertSubject($name, $datet)
	{
		if (empty($this->checksubject(($name)))) 
		{
			$upname = ucwords($name);
			$insert = "INSERT INTO subjects(subject_name, date_create) Values('$upname','$datet')";
			$stmt = $this->connect()->query($insert);
			if (!$stmt) {
				echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again </strong> </div>';
			}
			else
			{
				echo '<div class ="alert alert-success"> <strong> New Subject Added Successfully </strong> </div>';
			}

		}
		else{
			echo $this->checksubject($name);
		}
		
	}

	public function checksubject($name)
	{
		$upname = ucwords($name);
		$stmt = "SELECT * FROM subjects where subject_name = '$upname'";
		$result = $this->connect()->query($stmt); 
		if (($result->num_rows)> 0) {
			return '<div class ="alert alert-danger"> <strong> Sorry !!! Subject Name Already Exist </strong> </div>';
			 
		}
		else{

		}
	}

	public function getAllSubject()
	{
		$stmt = "SELECT * FROM subjects";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			$counter = 1;
			while ($rows= $result->fetch_assoc()) {
				echo '<tr>
                    <td>'.$counter.'</td>
                    <td>'.$rows['subject_name'].'</td>
                    <td><button class="btn btn-danger">Delete</button></td>
                </tr>';
                $counter++;
			}
			
		}
	}

	public function getsubjectoption()
	{
		$stmt = "SELECT * FROM subjects";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			$counter = 1;
			while ($rows= $result->fetch_assoc()) {?>
				<option value= "<?=$rows['id'] ?>"> <?=$rows['subject_name']?></option>
			<?php
		}
			
		}
	}

	public function getstudentname($classid)
	{
		$stmt = "SELECT * FROM students where student_class = '$classid' ";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			$counter = 1;
			while ($rows= $result->fetch_assoc()) {
				
                $studentName [] = $rows;
			}
			return $studentName;
			
		}
	}

	public function getAllstudentNumber(){
		$stmt = "SELECT * FROM students ";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		return $numberrows;
	}

	public function getAllclassroomnumber(){
		$stmt = "SELECT * FROM classes ";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		return $numberrows;
	}

	public function tests($ftest,$stest,$total,$subjectid,$studentid){
		if ($this->checktest($studentid) > 0) {
			$update = "UPDATE tests set first_test ='$ftest',second_test ='$stest',total ='$total' ";
			$update_query = $this->connect()->query($update);
			if ($update) {
				echo '<div class="alert alert-success"> Test Record Update Successfully</div>';
			}
			else
			{
				echo '<div class="alert alert-danger"> Sorry Error Occured!!! Please Retry</div>';
			}
		}
		else
		{
			$stmt = "INSERT INTO tests(first_test,second_test,total,subject_id,student_id) values('$ftest','$stest','$total','$subjectid','$studentid')";
			$result = $this->connect()->query($stmt);
			if (!result) {
				echo '<div class="alert alert-danger"> Sorry Error Occured!!! Please Refill</div>';
			}
			else{
				echo '<div class="alert alert-success"> Test Record add Successfully</div>';
			}
		}
		
	}
	public function checktest($studentid){
		$update_select = "SELECT * FROM tests where student_id ='$studentid'";
		$resu = $this->connect()->query($update_select);
		$numb = $resu->num_rows;
		return $numb;
	}



}
// end of class
$object = new user();