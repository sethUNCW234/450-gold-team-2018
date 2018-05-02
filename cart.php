<?php 
require 'header.php'; 

?>

<h1>Your Cart:</h1>

<?php
	echo($_SESSION['cart']);
	if ($_SESSION['cart'].count >0){
		echo('<p>your cart is not empty</p>');
	}
	else{
		echo('<p>your cart is empty</p>');
	}

 ?>


<?php include 'footer.php'; ?>