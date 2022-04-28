 <?php

class DataBase{

	public $dbhostname/* = "localhost"*/;
	public $dbusername/* = "root"*/;
	public $dbpassword/* = ""*/;
	public $databasename/* = "darzelis"*/;


	public function __construct($dbhostname, $dbusername, $dbpassword, $databasename) {
		$this->dbhostname = $dbhostname;
		$this->dbusername = $dbusername;
		$this->dbpassword = $dbpassword;
		$this->databasename = $databasename;
		$this->connection = $this->createDBconection();
	}


	public function createDBconection(){
		$erorMsg = "Prisijungimo klaida: ";
		// Create connection

		$connection = mysqli_connect($this->dbhostname, $this->dbusername, $this->dbpassword, $this->databasename);
		// Check connection
		if (!$connection) {
			die( $erorMsg. mysqli_connect_error());
		}
		return $connection;
	}


	public function createDataBase(){
		// Create database
		$sql = "CREATE DATABASE IF NOT EXISTS ".$this->databasename." CHARACTER SET utf8 COLLATE utf8_general_ci;";
		
		if (!mysqli_query($this->connection, $sql)) {
			echo "Klaida kuriant duomenų bazę: " . mysqli_error($this->connection);
		}
	
	}
	
	public function selectDataBase(){

		$selecteddatabase = mysqli_select_db($this->connection, $this->databasename);
		if (!$selecteddatabase) {
			die ('Klaida: ' . mysqli_error($this->connection));
		}
		return $selecteddatabase;
	}
}

?> 