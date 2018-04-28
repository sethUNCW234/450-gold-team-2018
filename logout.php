

<?php
require 'header.php';
?>
<main>
	<p>Logged out</p>
<?php
 if (isset($_SESSION["firstName"])) {
			$_SESSION=array();
			session_destroy();
			setcookie('PHPSESSID','',time()-3600,'/');
		}
		
		header('Location: pizza_menu.php');
		exit();
	
		?>
</main>
<?php
include ('footer.php'); 
?>

