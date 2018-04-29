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



<form method = "post" action = "newLogin.php">

<h2>Create your account! Great Pizza Awaits!</h2>
<div class="form-group">
    <label for="firstName">First Name</label>
    <input type="text" class="form-control" name = "firstName" id="firstName" placeholder="First Name">
    <span class="error text-danger" id="fnError" style="display:none">Please enter your first name, letters only please!</span>
  </div>

<div class="form-group">
    <label for="lastName">Last Name</label>
    <input type="text" class="form-control" name = "lastName" id="lastName" placeholder="Last Name">
    <span class="error text-danger" id="lnError" style="display:none">Please enter your last name, letters only please!</span>
  </div>
  
  
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="text" class="form-control" name = "email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
    <span class="error text-danger" id="emailError" style="display:none">please enter a valid email.</span>
  </div>
  
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" name = "address" id="address" placeholder="Address">
      <span class="error text-danger" id="adrError" style="display:none">Please enter an address.</span>
  </div>
  
  <div class="form-group">
    <label for="password1">Password</label>
    <input type="password" class="form-control" name = "password1" id="password1" placeholder="Password">
     <span class="error text-danger" id="passError1" style="display:none">Your password must be between 8 and 16 characters</span>
  </div>
   
  
   <div class="form-group">
    <label for="password2">Re-Enter Password</label>
    <input type="password" class="form-control" name = "password2" id="password2" onblur="passwordCheck(this)" placeholder="Password">
     <span class="error text-danger" id="passError" style="display:none">The passwords did not match</span>
  </div>
  
   <div class="form-group">
    <label for="cardNum">Credit Card Number</label>
    <input type="password" class="form-control" name = "cardNum" id="cardNum" placeholder="numbers only please">
     <span class="error text-danger" id="pass2Error" style="display:none">Please enter only the numbers no dashes</span>
  </div>
  
   <div class="form-group">
    <label for="CVC">Security Code</label>
    <input type="password" class="form-control" name = "CVC" id="CVC" placeholder="CVC">
     <span class="error text-danger" id="csvError" style="display:none">The cvc code is on the back of your card, it should only be 3 digits</span>
  </div>
  
    <div class="form-group">
    <label for="exprDate">Input date</label>
    <input type="date" class="form-control" name = "exprDate" id="exprDate" placeholder="EXP">
    <span class="error text-danger" id="expError" style="display:none">Please enter a date.</span>
  </div>
  
  <div>
  	<label for="terms">I accept the terms of using this website</label>
  	<input type="checkbox" name="terms" value="accepted" id="terms">
  </div>

  <div>
  	<input name="send" type="submit" value="Register">
  </div>
  
  </form>
  
  <script type="text/javascript">
  function myTextFunc(ele){
		if (!$(ele).val()){
		$(ele).next("span").css("display","block");
  	$(ele).removeClass("form-control");
  	$(ele).addClass("form-control is-invalid");
		}
	else{
  $(ele).removeClass("form-control is-invalid");
  $(ele).addClass("form-control");
	$(ele).next("span").css("display","none");
		}
	}
  
  function myEmailFunc(ele,pat){
  
  
 if(!$(ele).val() || !pat.test($(ele).val())){
 		$(ele).next("span").css("display","block");
  	$(ele).removeClass("form-control");
  	$(ele).addClass("form-control is-invalid");
		}
    else{
    $(ele).removeClass("form-control is-invalid");
  	$(ele).addClass("form-control");
		$(ele).next("span").css("display","none");
    }
 }
 
 function passwordCheck(ele){
 if($(ele).val() != $("#password1").val()){
 		$(ele).next("span").css("display","block");
  	$(ele).removeClass("form-control");
  	$(ele).addClass("form-control is-invalid");
 }
 else{
 		$(ele).removeClass("form-control is-invalid");
  	$(ele).addClass("form-control");
		$(ele).next("span").css("display","none");
 }
}
 
 $("#email").blur(function(){
 myEmailFunc(this,/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/);
 });
$("#address").blur(function(){
myEmailFunc(this,/^[a-zA-Z0-9 _.-]*$/);
});
$("#firstName").blur(function(){
myEmailFunc(this,/^[a-zA-Z\s]*$/);
});
$("#lastName").blur(function(){
myEmailFunc(this,/^[a-zA-Z\s]*$/);
});

$("#password1").blur(function(){
myEmailFunc(this,/.{8,16}/);
});
$("#cardNum").blur(function(){
myEmailFunc(this,/^[0-9]*$/);
});
$("#inputCSV").blur(function(){
myEmailFunc(this,/^\d{3}/);
});
$("#exprDate").blur(function(){
myTextFunc(this);
});

  
  </script>
  
  
  <style type="text/css">
input[type="text"] {
    width: 300px;
}
input[type="date"] {
    width: 300px;
}
input[type="password"]{
	width:300px;
}

</style>
<?php 
include 'footer.php';
?>