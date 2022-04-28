<?php
session_start();
include "config.php";
define('BASE_DIR', __DIR__);
include 'classes/Router.php';
include 'functions/main_use.php';

$request = $_SERVER['REQUEST_URI'];

$router = new Router($request);
$url = explode('/', $_GET['url']);
if (count($url) > 1) $name = $url[1]; else $name = '';
if (count($url) > 2) $urlParam2 = $url[2];
?>

<pre>
   <?php //print_r($urlParam2); ?>
</pre>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<title>Darželis</title>
	</head>
	<body>
		<div class="container">
		
		<?php
			
			if (isset($_SESSION['user'])) {
				include(BASE_DIR . '/includes/Header.php'); 
				$router->get('/', 'pages/HomePage');
				$router->get('home', 'pages/HomePage');
				$router->get('count', 'pages/CountTaxes');
				$router->get('logout', 'includes/logout');
				$router->get('showresults', 'pages/ShowResults');
				$router->get('childlist', 'pages/ChildsList');
				$router->get('groups', 'pages/Groups');
			}else{
				$router->get('/login', 'pages/LoginPage');
			}
		?>
		
		</div>
		
		<script src="js/bootstrap.js" type="text/javascript"></script>
		<script src="js/main.js" type="text/javascript"></script>
	</body>
</html>
