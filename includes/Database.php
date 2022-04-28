 <?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "darzelis";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Prisijungimo klaida: " . mysqli_connect_error());
}

// Create database
$cdb = "CREATE DATABASE IF NOT EXISTS $databasename CHARACTER SET utf8 COLLATE utf8_lithuanian_ci;";
if (!mysqli_query($conn, $cdb)) {
    echo "Klaida kuriant duomenų bazę: " . mysqli_error($conn);
}
$db_selected = mysqli_select_db($conn, $databasename);
if (!$db_selected) {
    die ('Klaida: ' . mysql_error());
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL,
surname VARCHAR(50) NOT NULL,
institucija VARCHAR(50) NOT NULL,
tipas VARCHAR(50) NOT NULL,
pavadinimas VARCHAR(50) NOT NULL,
data DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
salis VARCHAR(50) NOT NULL
)";

if (!mysqli_query($conn, $sql)) {
    echo "Klaida kuriant lentelę: " . mysqli_error($conn);
}

function getDalyviai($id = null, $order=null, $limit=null){
	global $conn;
	$where = "";
	if ($id) $where = " where id='".mysqli_real_escape_string($conn,$id)."'";
	$order = 'order by data';
	$query = "SELECT * FROM dalyviai ".$where." ".$order." ".$limit;
	$result = mysqli_query($conn,$query);
	return $result;
}
?> 