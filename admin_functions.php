<?php
require 'header.php';
?>

	<main>
	<?php if (isset($_SESSION["firstName"], $_SESSION["adminEmail"])) { 
			$message = "Welcome back ". $_SESSION["firstName"];
			$message2 = "You are now logged in";
			
		} else { 
			$message = 'You have reached this page in error';
			$message2 = 'Please use the menu at the right';	
		}
		// Print the message:
		echo '<h2>'.$message.'</h2>';
		echo '<h3>'.$message2.'</h3>';
		?>
	</main>
	<?php // Include the footer and quit the script:
	include ('footer.php'); 
	?>
	