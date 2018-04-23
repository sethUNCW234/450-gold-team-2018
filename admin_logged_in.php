<?php
require 'header.php';
?>

	<main>
	<?php if (isset($_SESSION["firstName"], $_SESSION["adminEmail"])) { 
			$message = "Welcome back ". $_SESSION["firstName"];
			$message2 = "You are now logged in as an administrator";
			
		} else { 
			$message = 'You have reached this page in error';
			$message2 = 'Please use the menu at the right';	
		}
		// Print the message:
		echo '<h2>'.$message.'</h2>';
		echo '<h3>'.$message2.'</h3>';
		?>
		<h3>Today's Sales:</h3>
		<?php 
		try{
			require_once ('pdo_config.php'); 

			$sql = "select dailySales()"; // call the stored procedure
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			echo "$".print_r($result);
		} 
		catch (PDOException $e) { 
			echo $e->getMessage(); 
		}
		?>
	</main>
	<?php // Include the footer and quit the script:
	include ('footer.php'); 
	?>
	