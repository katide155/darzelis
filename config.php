<?php

spl_autoload_register(function($class){
	require_once('classes/'.$class.'.php');
});

$dbhostname = "localhost";
$dbusername = "root";
$dbpassword = "";
$databasename = "darzelis";


$database = new DataBase($dbhostname, $dbusername, $dbpassword,$databasename);

global $connection;
$connection = $database->createDBconection();
 
 
$database->createDataBase($databasename);


$database->selectDataBase($databasename);


//db users laukai

$db_table_users_fields =[
		['fieldname' => 'user_id',			 'fieldtype' => 'INT', 	    'fieldlenght' => '6',   'fieldspec' => 'UNSIGNED AUTO_INCREMENT PRIMARY KEY',	'notnull' => false],
		['fieldname' => 'user_name',		 'fieldtype' => 'VARCHAR',  'fieldlenght' => '50',  'fieldspec' => '',										'notnull' => true],
		['fieldname' => 'user_surname',		 'fieldtype' => 'VARCHAR',  'fieldlenght' => '100', 'fieldspec' => '',										'notnull' => true],
		['fieldname' => 'user_type',	   	 'fieldtype' => 'VARCHAR',  'fieldlenght' => '100', 'fieldspec' => '',										'notnull' => true],
		['fieldname' => 'user_email',		 'fieldtype' => 'VARCHAR',  'fieldlenght' => '100', 'fieldspec' => '',										'notnull' => true],
		['fieldname' => 'user_password',     'fieldtype' => 'VARCHAR',  'fieldlenght' => '256', 'fieldspec' => '',										'notnull' => true],
		['fieldname' => 'user_creation_date','fieldtype' => 'DATETIME', 'fieldlenght' => '',    'fieldspec' => 'DEFAULT CURRENT_TIMESTAMP',				'notnull' => true],
		['fieldname' => 'user_deletion_date','fieldtype' => 'DATETIME', 'fieldlenght' => '',    'fieldspec' => 'DEFAULT CURRENT_TIMESTAMP',				'notnull' => true]
];	

$db_table_users = new DataBaseTable('users', $connection);


$db_table_users->createDataBaseTable($db_table_users_fields);


//db children laukai

$db_table_children_fields =[
		['fieldname' => 'child_id',			  'fieldtype' => 'INT', 	 'fieldlenght' => '6',   'fieldspec' => 'UNSIGNED AUTO_INCREMENT PRIMARY KEY',	'notnull' => false],
		['fieldname' => 'child_name',		  'fieldtype' => 'VARCHAR',  'fieldlenght' => '50',  'fieldspec' => '',										'notnull' => true],
		['fieldname' => 'child_surname',	  'fieldtype' => 'VARCHAR',  'fieldlenght' => '100', 'fieldspec' => '',										'notnull' => false],
		['fieldname' => 'child_group_id',	  'fieldtype' => 'VARCHAR',  'fieldlenght' => '100', 'fieldspec' => '',										'notnull' => false],
		['fieldname' => 'child_parents_email','fieldtype' => 'VARCHAR',  'fieldlenght' => '100', 'fieldspec' => '',										'notnull' => false],
		['fieldname' => 'child_parents_telno','fieldtype' => 'VARCHAR',  'fieldlenght' => '50',  'fieldspec' => '',										'notnull' => false],
		['fieldname' => 'child_birthdate',    'fieldtype' => 'DATE',     'fieldlenght' => '',    'fieldspec' => '',										'notnull' => false],
		['fieldname' => 'child_creation_date','fieldtype' => 'DATETIME', 'fieldlenght' => '',    'fieldspec' => 'DEFAULT CURRENT_TIMESTAMP',			'notnull' => false],
		['fieldname' => 'child_deletion_date','fieldtype' => 'DATETIME', 'fieldlenght' => '',    'fieldspec' => 'DEFAULT CURRENT_TIMESTAMP',			'notnull' => false]
];

$db_table_children = new DataBaseTable('children', $connection);


$db_table_children->createDataBaseTable($db_table_children_fields);	

//db groups laukai

$db_table_groups_fields =[
		['fieldname' => 'group_id',		      'fieldtype' => 'INT', 	 'fieldlenght' => '6',   'fieldspec' => 'UNSIGNED AUTO_INCREMENT PRIMARY KEY',	'notnull' => false],
		['fieldname' => 'group_title',		  'fieldtype' => 'VARCHAR',  'fieldlenght' => '50',  'fieldspec' => '',										'notnull' => true],
		['fieldname' => 'group_number',		  'fieldtype' => 'VARCHAR',  'fieldlenght' => '50',  'fieldspec' => '',										'notnull' => false],
		['fieldname' => 'group_creation_date','fieldtype' => 'DATETIME', 'fieldlenght' => '',    'fieldspec' => 'DEFAULT CURRENT_TIMESTAMP',			'notnull' => false],
		['fieldname' => 'group_deletion_date','fieldtype' => 'DATETIME', 'fieldlenght' => '',    'fieldspec' => 'DEFAULT CURRENT_TIMESTAMP',			'notnull' => false]
];

$db_table_groups = new DataBaseTable('groups', $connection);


$db_table_groups->createDataBaseTable($db_table_groups_fields);	

