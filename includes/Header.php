<?php
$username = '';
$textToUser = null;
$link_to_log = 'login';
$buttonTitle = "Prisijungti";
if( isset($_SESSION['user']) ){
	$username = $_SESSION['user'];
	$textToUser = "<h3>Prisijungęs vartotojas - $username";
	$link_to_log = 'logout';
	$buttonTitle = "Atsijungti";
}
?>

<header class="">


   
	<nav class="navbar">
	  <div class="container-fluid">
		 <?php echo $textToUser; ?></h3>


          <a class="pageLink" href="<?php echo $link_to_log; ?>"><?php echo $buttonTitle; ?></a>


	  </div>
	</nav>

</header>
