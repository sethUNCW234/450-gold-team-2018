<?php
	/*require_once 'secure_conn.php';  - I was unable to get the secure connection working*/
	if (isset($_POST['send'])) {
	$missing = array();
	$errors = array();

	
	$firstName = trim(filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING)); //returns a string
	if (empty($firstName)) 
		$missing[]='firstName';
	
	$lastName = trim(filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING)); //returns a string
	if (empty($lastName)) 
		$missing[]='lastName';
	
	$valid_email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));	//returns a string or null if empty or false if not valid	
	if (trim($_POST['email']==''))
		$missing[] = 'email';
	elseif (!$valid_email)
		$errors[] = 'email';
	else 
		$email = $valid_email;

	/*$select = mysql_query("SELECT 'email' FROM 'pizza_users' WHERE 'email' = '".$_POST['email']."'") or exit(mysql_error()); */
	
	$password1 = trim(filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING));
	$password2 = trim(filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING));
	// Check for a password:
	if (empty($password1) || empty($password2)) 
		$missing[]='password';
	elseif ($password1 !== $password2) 
			$errors[] = 'password';
	else $password = $password1;

	$address = trim(filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING)); //returns a string
	if (empty($address)) 
		$missing[]='address';

	$cardNum = trim(filter_input(INPUT_POST, 'cardNum', FILTER_SANITIZE_STRING)); //returns a string
	if (empty($cardNum)) 
		$missing[]='cardNum';

	$CVC = trim(filter_input(INPUT_POST, 'CVC', FILTER_SANITIZE_STRING)); //returns a string
	if (empty($CVC)) 
		$missing[]='CVC';

	$exprDate = trim(filter_input(INPUT_POST, 'exprDate', FILTER_SANITIZE_STRING)); //returns a string
	if (empty($exprDate)) 
		$missing[]='exprDate';

	$accepted = filter_input(INPUT_POST, 'terms');
	if (empty($accepted) || $accepted !='accepted')
		$missing[] = 'accepted';
	
	if (!$missing && !$errors) {
	   try{								 // Prepared Statement 
		require_once ('pdo_config.php'); // Connect to the db.
		$sql = "SELECT * FROM pizza_users WHERE emailAddr = :email";
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		$rows = $stmt->rowCount();
		if ($rows==0) { //email not found, add user
		  try{
			$sql2 = "INSERT into pizza_users (firstName, lastName, emailAddr, pw, address) VALUES (:firstName, :lastName, :email, :pw, :address)";
			$sql3 = "INSERT into payment values (:cardNum, :emailAddr, :CVC, :exprDate)";
			$stmt3= $conn->prepare($sql3);
			$stmt2= $conn->prepare($sql2);
			$stmt2->bindValue(':firstName', $firstName);
			$stmt2->bindValue(':lastName', $lastName);
			$stmt2->bindValue(':email', $email);
			$stmt2->bindValue(':pw', $password1);
			$stmt2->bindvalue(':address', $address);
			$stmt3->bindValue(':cardNum', $cardNum);
			$stmt3->bindValue(':emailAddr', $email);
			$stmt3->bindValue(':CVC', $CVC);
			$stmt3->bindValue(':exprDate', $exprDate);
			$success = $stmt2->execute();
			$stmt3->execute();
			header('Location: acct_created.php');
			include 'footer.php'; 
			exit;
		  }
		  catch (PDOException $e) { 
			echo $e->getMessage(); 
		  }
		}
		elseif ($rows==1) //email found
			$errors[]='duplicate';
		else { //some other error
			echo "We are unable to process your request at this time. Please try again later.";
			include 'footer.php'; 
			exit;
		}
	   } catch (PDOException $e) { 
			echo $e->getMessage(); 
			//or for deployment
			//echo "We are unable to process your request at  this  time. Please try again later.";
			include 'footer.php'; 
			exit;
	   } 
	}
}
require 'header.php';
?>


	<main>
     <style ="text/css">
.warning{
	color:red;
}
</style>  
        <form method="post" action="create_acct.php">
			<fieldset>
				<legend>Please Register:</legend>
				<?php if ($missing || $errors) { ?>
				<p class="warning">Please fix the item(s) indicated.</p>
				<?php } ?>
            <p>
			<div>
                <label for="firstName" style="float:left">First Name: 
				<?php if ($missing && in_array('firstName', $missing)) { ?>
                        <span class="warning">Please enter your first name</span>
                    <?php } ?> </label>
                <input name="firstName" id="firstName" class="form-control" style="width:150px" type="text"
				 <?php if (isset($firstName)) {
                    echo 'value="' . htmlspecialchars($firstName) . '"';
                } ?>
				>
            </p>
			<p>
                <label for="lastName">Last Name: 
				<?php if ($missing && in_array('lastname', $missing)) { ?>
                        <span class="warning">Please enter your last name</span>
                    <?php } ?> </label>
                <input name="lastName" id="lastName" type="text"
				 <?php if (isset($lastName)) {
                    echo 'value="' . htmlspecialchars($lastName) . '"';
                } ?>
				>
            </p>
            <p>
                <label for="email">Email: 
				<?php if ($missing && in_array('email', $missing)) { ?>
                        <span class="warning">Please enter your email address</span>
                    <?php } ?>
				<?php if ($errors && in_array('email', $errors)) { ?>
                        <span class="warning">The email address you provided is not valid</span>
                    <?php } ?>
                <?php if ($errors && in_array('duplicate', $errors)) { ?>
            			<span class="warning">The email address you provided already exists in the database.<br> Please enter another email address or Login using the menu to the left</span>
            		<?php } ?>
				</label>
                <input name="email" id="email" type="text"
				<?php if (isset($email) && !$errors['email']) {
                    echo 'value="' . htmlspecialchars($email) . '"';
                } ?>>
            </p>
			<p>
				<?php if ($errors && in_array('password', $errors)) { ?>
                        <span class="warning">The entered passwords do not match. Please try again.</span>
                    <?php } ?> 
                <label for="pw1">Password: 
				
				<?php if ($missing && in_array('password', $missing)) { ?>
                        <span class="warning">Please enter a password</span>
                    <?php } ?> </label>
                <input name="password1" id="pw1" type="password">
            </p>
			<p>
                <label for="pw2">Confirm Password: 
				<?php if ($missing && in_array('password', $missing)) { ?>
                        <span class="warning">Please confirm the password</span>
                    <?php } ?> </label>
                <input name="password2" id="pw2" type="password">
            </p>
            <p>
                <label for="address">Address: 
				<?php if ($missing && in_array('address', $missing)) { ?>
                        <span class="warning">Please enter your address</span>
                    <?php } ?> </label>
                <input name="address" id="address" type="text"
				 <?php if (isset($address)) {
                    echo 'value="' . htmlspecialchars($address) . '"';
                } ?>
				>
            </p>
            <p>
                <label for="cardNum">Credit Card #: 
				<?php if ($missing && in_array('cardNum', $missing)) { ?>
                        <span class="warning">Please enter your credit card number</span>
                    <?php } ?> </label>
                <input name="cardNum" id="cardNum" type="text"
				 <?php if (isset($cardNum)) {
                    echo 'value="' . htmlspecialchars($cardNum) . '"';
                } ?>
				>
            </p>
            <p>
                <label for="CVC">Security Code (CVC): 
				<?php if ($missing && in_array('CVC', $missing)) { ?>
                        <span class="warning">Please enter your security code</span>
                    <?php } ?> </label>
                <input name="CVC" id="CVC" type="text"
				 <?php if (isset($CVC)) {
                    echo 'value="' . htmlspecialchars($CVC) . '"';
                } ?>
				>
            </p>
            <p>
                <label for="exprDate">Card Expiration Date (YYYY-MM-DD): 
				<?php if ($missing && in_array('exprDate', $missing)) { ?>
                        <span class="warning">Please enter your card expiration date</span>
                    <?php } ?> </label>
                <input name="exprDate" id="exprDate" type="text"
				 <?php if (isset($exprDate)) {
                    echo 'value="' . htmlspecialchars($exprDate) . '"';
                } ?>
				>
            </p>
            <p>
			<?php if ($missing && in_array('accepted', $missing)) { ?>
                        <span class="warning">You must agree to the terms</span><br>
                    <?php } ?>
                <input type="checkbox" name="terms" value="accepted" id="terms"
				     <?php if ($accepted) {
                                echo 'checked';
                            } ?>
				>
                <label for="terms">I accept the terms of using this website</label>
            </p>
            <p>
                <input name="send" type="submit" value="Register">
            </p>
			</div>
		</fieldset>
        </form>
		
	</main>
<?php include 'footer.php'; ?>
