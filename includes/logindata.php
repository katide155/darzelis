<?php

include('../functions/main_use.php'); 
if (session_id() == '') session_start();

$auth = [
    'login' => 'admin@php.lt',
    'password' => 'admin'
];

$logged_in = false;


//print_r($_POST);
if (!isset($_SESSION['user'])) {
	if( is_param_equal($_POST, 'login', 1) ) {
		
	   // echo '<h2>Bandome prisijungti</h2>';

		if( isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {

		//    echo '<h2>El. pasto adresas yra</h2>';

			if( $_POST['email'] == $auth['login'] ) {

			//    echo '<h2>El. pastas yra teisingas</h2>';

				if( isset($_POST['password']) AND md5($_POST['password']) == md5($auth['password']) ) {

					$_SESSION['logged_in'] = true;
					$_SESSION['user'] = $auth['login'];

				}

			}

		}

	}

	if(isset($_SESSION['logged_in']) AND $_SESSION['logged_in']) {

			$logged_in = true;
		
		header("Location: /home");
	}	
	else {
		header("Location: /login");
	}
	
}else{
	session_destroy();
	header("Location: /login");
}



