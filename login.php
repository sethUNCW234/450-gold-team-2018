<?php //This is the login page for registered users

if (isset($_POST['send'])) {
	$missing = array();
	$errors = array();
	
	$valid_email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));	//returns a string or null if empty or false if not valid	
	if (trim($_POST['email']=='')|| (!$valid_email))  //Either empty or invalid email will be considered missing
		$missing[] = 'email';
	else
		$email = $valid_email;
	
	$password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
	
	// Check for a password:
	if (empty($password))
		$missing[]='password';
	while (!$missing && !$errors){ 
	   try {
		require_once ('pdo_config.php'); // Connect to the db.
		// Make the query:
		$sql = "SELECT firstName, emailAddr, pw FROM pizza_users WHERE emailAddr = :email";
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		$rows = $stmt->rowCount();
		if ($rows==0)  //email not found
			$errors[] = 'email';
		else { // found the email, now validate password
			$result = $stmt->fetch();
			if ($password == $result['pw']) { //passwords match
				$firstName = $result['firstName'];
				session_start();
				$_SESSION["firstName"] = $firstName;
				$_SESSION["email"] = $email;
				$_SESSION["cart"]=array();
				header('Location: pizza_menu.php'); // redirect to logged_in page
				exit;
			}
			else {
				$errors[]='password';
			}
		} 
	   }  
	   catch (Exception $e) { 
				echo $e->getMessage(); 
			}
	}
}
require 'header.php';
?>
	<main>
        <h2>Gold's Pizza</h2>
        <form method="post" action="login.php">
			<fieldset>
				<legend>Customer Login</legend>
				<?php if ($missing || $errors) { ?>
				<p style="color:RED">Please fix the item(s) indicated.</p>
				<?php } ?>
            <p>
            	<div class="form-group">
                <label for="email">Please enter your email address:</label>
				
				
				
                <input name="email" <?php if ($missing && in_array('email',$missing)) 
                echo 'class="form-control is-invalid"' ?> class="form-control" style="width:450px" id="adminEmail" type="text"
				<?php if (isset($email) && !$errors['email']) {
                    echo 'value="' . htmlspecialchars($email) . '"';
                } ?>>
                <?php if ($missing && in_array('email', $missing)) { ?>
                        <span class="error text-danger">This email is not assoicated with any account, please try again</span>
                    <?php } ?>
					<?php if ($errors && in_array('email', $errors)) { ?>
                        <span class="error text-danger"><br>The email address you provided is not associated with an admin account<br>
						Please try another email address</span>
                    <?php } ?>
                   
            </div>
            </p>
			<p>
				
                <label for="pw">Password:</label>
				 
                <input name="password" style="width:450px" <?php if ( ($missing && in_array('email',$missing)) || ($errors && in_array('password', $errors))) echo 'class="form-control is-invalid"' ?> class="form-control" id="pw" type="password">

                <?php if ($missing && in_array('password', $missing)) { ?>
                        <span class="error text-danger">Please enter a password</span>
                    <?php } ?>
					<?php if ($errors && in_array('password', $errors)) { ?>
                        <span class="error text-danger">Incorrect Password</span>
                    <?php } ?>



            </p>
			
            <p>
                <input name="send" type="submit" value="Login">
            </p>
		</fieldset>
        </form>
	</main>
<?php include 'footer.php'; ?>
