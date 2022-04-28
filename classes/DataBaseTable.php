 <?php
 

class DataBaseTable extends DataBase{


	public $dbtablename;
	public $connection;

	public function __construct($dbtablename, $connection) {
		$this->dbtablename = $dbtablename;
		//parent::__construct($this->dbhostname, $this->dbusername, $this->dbpassword, $this->databasename);
		$this->connection = $connection;
		
		//print_r($this->connection);
	}


	//$fieldstodatabase - masyvas 
	// masyvo šablonas:
	/* 
		$fieldstodatabase = 
		[
			[
				'fieldname' => 'id',
				'fieldtype' => 'VARCHAR',   //('INT', 'VARCHAR', 'DATE', 'DATETIME')
				'fieldlenght' => '50',
				'fieldspec' => 'UNSIGNED AUTO_INCREMENT PRIMARY KEY', //(arba tuščias)
				'notnull' => true // arba false
			]
		];
	*/ 

	public function createDataBaseTable($fieldstodatabase){
		
		$fieldsquantity = count($fieldstodatabase);
		
		$sql = 'CREATE TABLE IF NOT EXISTS '.$this->dbtablename.' ( ';
		
		foreach ($fieldstodatabase as $key => $field){
			
			$notnull = '';
			if($field['notnull'] == true)
				$notnull = 'NOT NULL';
			
			$comma = ',';
			if($key == $fieldsquantity-1)
				$comma = '';
			
			$fieldlenght = '('.$field['fieldlenght'].')';
			if(!$field['fieldlenght'])
				$fieldlenght = ' ';			
			
			$sql .= ' '.$field['fieldname'].' '.$field['fieldtype'].$fieldlenght.' '.$field['fieldspec'].' '.$notnull.$comma.' ';
			
		}
		$sql .= '); ';
	

		if (!mysqli_query($this->connection, $sql)) {
			echo "Klaida kuriant lentelę: " . mysqli_error($this->connection);
		}
	}
	


	// $where_requests - paduodamas užklausų masyvas, su kiekviena užklausa atskirai, be where ir and
	/* pvz.: 
		$wherereq = [];
		$whereisitem = ' item_id = 2356 ';
		$wherereq[] = $whereisitem;
		$wherenodeleted = ' item_deleted IS NULL ';
		$wherereq[] = $wherenodeleted;		
	*/
	public function selectDataFromDataBaseTable($table_fields='*', $where_requests=null, $group_by=null, $order_by=null, $sort_order=null){
		
		$where_clouses = '';
		if($where_requests){
			foreach($where_requests as $index => $request){
				if($index == 0){
					$where_clouses = ' WHERE '. $request;
				}
				if($index > 0){
					$where_clouses .= ' AND '. $request;
				}
			}
		
		}
		
			$sql = "SELECT ".$table_fields." "
			." FROM ".$this->dbtablename." "
			." ".$where_clouses." "
			." ".$group_by." "
			." ".$order_by." ".$sort_order." ";

		$result = mysqli_query($this->connection, $sql); 
		return $result;
	}
	
	public function insertDataToTable($dbFields, $values){
		$valtodb = '';
		$fieldtodb = '';

		$fieldsquantity = count($dbFields);

		$comma = ',';
		
		
		foreach($dbFields as $key => $field){
			if($key == $fieldsquantity-1)
			$comma = '';
			$fieldtodb .= ''.$field.$comma.'';

		}
		
		$comma = ',';
		
		foreach($values as $key => $value){
			if($key == $fieldsquantity-1)
			$comma = '';
			if( $value && $value != trim('CURRENT_TIMESTAMP') ){
				$valtodb .= '\''.mysqli_real_escape_string($this->connection, $value).'\''.$comma.'';
			}
			elseif($value == trim('CURRENT_TIMESTAMP')){
				$valtodb .= ' CURRENT_TIMESTAMP'.$comma.'';
			}
			else{
				$valtodb .= ' NULL'.$comma.'';
			}
		}
		
		$sql = 'INSERT INTO '.$this->dbtablename.' ('.$fieldtodb.') '
		.' VALUES ('.$valtodb.') ';
		
		
		if (!mysqli_query($this->connection, $sql)) {
			echo "Klaida įrašant duomenis: " . mysqli_error($this->connection);
		}
		
	}
	
	public function showTableColumnsFields(){
		$fields = [];
		$sql = 'SHOW COLUMNS FROM '.$this->dbtablename.' ';
		$result = mysqli_query($this->connection, $sql);
		if (!$result) {
			echo "Klaida: " . mysqli_error($this->connection);
		}else{
			
			foreach ($result as $key => $field){
				$fields[] = $field['Field'];
			}
			

			return $fields;
			
		}
		
		
	}
}

?> 