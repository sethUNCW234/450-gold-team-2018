<?php
require 'header.php';
if (isset($_POST['send'])) {

	$discounts = (float) $_POST['discounts']; // convert default input string to float
	try{
		require_once ('pdo_config.php'); 

		$sql = "call discount(?)"; // call the stored procedure
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(1, $discounts);
		$stmt->execute();
		echo "<main><h3>Your discount has been applied!</h3></main>";
	} catch (PDOException $e) { 
	echo $e->getMessage(); 
	}	
}
if (isset($_POST['restore'])) {
	try{
		require_once ('pdo_config.php');
		$sql2 = "call fullPrice()";
		$stmt2 = $conn->prepare($sql2);
		$stmt2->execute();
		echo "<main><h3>Prices restored to originals.</h3></main>";
	} catch (PDOException $e) { 
	echo $e->getMessage(); 
	}
}
?>
	<main>
        <h2>Gold's Pizza - Admin</h2>
        <p>Here admins can input a discount to apply to all items.</p>
        <form method="post" action="admin_discounts.php">
        	<fieldset id="discounts">
                <h2>Enter a discount:</h2>
                <p>
					<input name="discounts" id = "discounts" type="number" min="0" max="1" step="any">
				</p>
                <p>
                	<input name="send" type="submit" value="Apply Discount">
            	</p>
            	<p>
            		<input name="restore" type="submit" value="Restore Original Prices">
            	</p>
            </fieldset>
        </form>
	</main>
<?php include 'footer.php'; ?>