<?php
require 'header.php';
?>
<main>
<?php if (isset($_SESSION["firstName"])) {
			$_SESSION=array();
			session_destroy();
			setcookie('PHPSESSID','',time()-3600,'/');
		}
		require_once 'reg_conn.php';
		header('Location: pizza_menu.php');
		?>
</main>
<?php
include ('footer.php'); 
?>