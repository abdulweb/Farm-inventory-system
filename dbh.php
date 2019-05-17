<?php
/**
* 
*/
class dbh
{
	private $servername;
	private $username;
	private $password;
	private $dbname;
	public function connect(){
		$this->servername ='localhost';
		$this->username ='root';
		$this->password ='root';
		$this->dbname ='farm_store';

		$conn = new mysqli($this->servername,$this->username, $this->password,$this->dbname );
		return $conn;
	}

	// function __construct(argument)
	// {
	// 	# code...
	// }

}
$object = new dbh();
