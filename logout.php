

<?php
require 'header.php';
?>
<main>
<div style="align:center">
<h1>You are now being logged out</h1>
<img src="./pics-450/loading.gif" style="width:200px;height:200px;padding-left:100px; ">
</div>
<?php
 if (isset($_SESSION["firstName"])) {
			$_SESSION=array();
			session_destroy();
			setcookie('PHPSESSID','',time()-3600,'/');
		}
		

		header('refresh:5; pizza_menu.php');
		exit();
	
		?>
</main>
<?php
include ('footer.php'); 
?>

