<?php //This is the login page for registered users

if (isset($_POST['send'])) {
	$missing = array();
	$errors = array();
	
	$valid_adminEmail = trim(filter_input(INPUT_POST, 'adminEmail', FILTER_VALIDATE_EMAIL));	//returns a string or null if empty or false if not valid	
	if (trim($_POST['adminEmail']=='')|| (!$valid_adminEmail))  //Either empty or invalid adminEmail will be considered missing
		$missing[] = 'adminEmail';
	else
		$adminEmail = $valid_adminEmail;
	
	$password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
	
	// Check for a password:
	if (empty($password))
		$missing[]='password';
	while (!$missing && !$errors){ 
	   try {
		require_once ('pdo_config.php'); // Connect to the db.
		// Make the query:
		$sql = "SELECT firstName, adminEmail, pw FROM admin_users WHERE adminEmail = :adminEmail";
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(':adminEmail', $adminEmail);
		$stmt->execute();
		$rows = $stmt->rowCount();
		if ($rows==0)  //adminEmail not found
			$errors[] = 'adminEmail';
		else { // found the adminEmail, now validate password
			$result = $stmt->fetch();
			if ($password == $result['pw']) { //passwords match
				$firstName = $result['firstName'];
				session_start();
				$_SESSION["firstName"] = $firstName;
				$_SESSION["adminEmail"] = $adminEmail;
				header('Location: admin_logged_in.php'); // redirect to logged_in page
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
        <form method="post" action="admin_login.php">
			<fieldset>
				<legend>Admin Login</legend>
				<?php if ($missing || $errors) { ?>
				<p style="color:RED">Please fix the item(s) indicated.</p>
				<?php } ?>
            <p>
            	<div class="form-group">
                <label for="adminEmail">Please enter your email address:</label>
				
				
				
                <input name="adminEmail" <?php if ($missing && in_array('adminEmail',$missing)) 
                echo 'class="form-control is-invalid"' ?> class="form-control" style="width:450px" id="adminEmail" type="text"
				<?php if (isset($adminEmail) && !$errors['adminEmail']) {
                    echo 'value="' . htmlspecialchars($adminEmail) . '"';
                } ?>>
                <?php if ($missing && in_array('adminEmail', $missing)) { ?>
                        <span class="error text-danger">This email is not assoicated with any account, please try again</span>
                    <?php } ?>
					<?php if ($errors && in_array('adminEmail', $errors)) { ?>
                        <span class="error text-danger"><br>The email address you provided is not associated with an admin account<br>
						Please try another email address</span>
                    <?php } ?>
                   
            </div>
            </p>
			<p>
				
                <label for="pw">Password:</label>
				 
                <input name="password" style="width:450px" <?php if ( ($missing && in_array('adminEmail',$missing)) || ($errors && in_array('password', $errors))) echo 'class="form-control is-invalid"' ?> class="form-control" id="pw" type="password">

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
