<?php
require 'includes/header.php';
?>
<main>
<?php if (isset($_SESSION["firstName"])) {
			$_SESSION=array();
			session_destroy();
			setcookie('PHPSESSID','',time()-3600,'/');
			$message = "You have successfully logged out";
			$message2 = "Have a good day!";
		} else {
			$message = 'You have reached this page in error';
			$message2 = 'Please use the menu to the left';	
		} 
		require_once 'includes/reg_conn.php';
		echo '<h2>'.$message.$_SESSION['firstName'].'</h2>';
		echo '<h3>'.$message2.'</h3>';
		?>
</main>
<?php
include ('includes/footer.php'); 
?>