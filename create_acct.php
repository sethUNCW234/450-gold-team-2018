<?php
	require_once 'includes/secure_conn.php';
	if (isset($_POST['send'])) {
	$missing = array();
	$errors = array();

	
	$firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING)); //returns a string
	if (empty($firstname)) 
		$missing[]='firstname';
	
	$lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING)); //returns a string
	if (empty($lastname)) 
		$missing[]='lastname';
	
	$valid_email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));	//returns a string or null if empty or false if not valid	
	if (trim($_POST['email']==''))
		$missing[] = 'email';
	elseif (!$valid_email)
		$errors[] = 'email';
	else 
		$email = $valid_email;

	/*$select = mysql_query("SELECT 'email' FROM 'JJ_reg_users' WHERE 'email' = '".$_POST['email']."'") or exit(mysql_error()); */
	
	$password1 = trim(filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING));
	$password2 = trim(filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING));
	// Check for a password:
	if (empty($password1) || empty($password2)) 
		$missing[]='password';
	elseif ($password1 !== $password2) 
			$errors[] = 'password';
	else $password = $password1;
	
	$accepted = filter_input(INPUT_POST, 'terms');
	if (empty($accepted) || $accepted !='accepted')
		$missing[] = 'accepted';
	
	if (!$missing && !$errors) {
	   try{	
		require_once ('../pdo_config.php'); // Connect to the db.
		$sql = "SELECT * FROM Pizza_Registered_Users WHERE emailAddr = :email";
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		$rows = $stmt->rowCount();
		if ($rows==0) { //email not found, add user
		  try{
			$sql2 = "INSERT into Pizza_Registered_Users (firstName, lastName, emailAddr, pw) VALUES (:firstName, :lastName, :email, :pw)";
			$pw = $stmt2= $conn->prepare($sql2);
			$stmt2->bindValue(':firstName', $firstname);
			$stmt2->bindValue(':lastName', $lastname);
			$stmt2->bindValue(':email', $email);
			$stmt2->bindValue(':pw', password_hash($password1, PASSWORD_DEFAULT));
			$success = $stmt2->execute();
			header('Location: acct_created.php');
			include 'includes/footer.php'; 
			exit;
		  }
		  catch (PDOException $e) { 
			echo $e->getMessage(); 
		  }
		}
		elseif ($rows==1) //email found
			$errors[]='duplicate';
		else { //some other error
			echo "We are unable to process your request at this  time. Please try again later.";
			include 'includes/footer.php'; 
			exit;
		}
	   } catch (PDOException $e) { 
			echo $e->getMessage(); 
			//or for deployment
			//echo "We are unable to process your request at  this  time. Please try again later.";
			include 'includes/footer.php'; 
			exit;
	   } 
	}
}
require 'includes/header.php';
?>


	<main>
        <h2>Gold's Pizza</h2>
        <p>Ut enim ad minim veniam, quis nostrud exercitation consectetur adipisicing elit. Velit esse cillum dolore ullamco laboris nisi in reprehenderit in voluptate. Mollit anim id est laborum. Sunt in culpa duis aute irure dolor excepteur sint occaecat.</p>
        <form method="post" action="create_acct.php">
			<fieldset>
				<legend>Please Register:</legend>
				<?php if ($missing || $errors) { ?>
				<p class="warning">Please fix the item(s) indicated.</p>
				<?php } ?>
            <p>
                <label for="fn">First Name: 
				<?php if ($missing && in_array('firstname', $missing)) { ?>
                        <span class="warning">Please enter your first name</span>
                    <?php } ?> </label>
                <input name="firstname" id="fn" type="text"
				 <?php if (isset($firstname)) {
                    echo 'value="' . htmlspecialchars($firstname) . '"';
                } ?>
				>
            </p>
			<p>
                <label for="ln">Last Name: 
				<?php if ($missing && in_array('lastname', $missing)) { ?>
                        <span class="warning">Please enter your last name</span>
                    <?php } ?> </label>
                <input name="lastname" id="ln" type="text"
				 <?php if (isset($lastname)) {
                    echo 'value="' . htmlspecialchars($lastname) . '"';
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
		</fieldset>
        </form>
	</main>
<?php include './includes/footer.php'; ?>
