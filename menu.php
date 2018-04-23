<?php
$currentPage = basename($_SERVER['SCRIPT_FILENAME']); ?>
<ul id="nav">
	<!--<li><a href="index.php" <?php if ($currentPage == 'index.php') {echo 'id="here"'; } ?>>Home</a></li>-->
	<li><a href="pizza_menu.php" <?php if ($currentPage == 'pizza_menu.php') {echo 'id="here"'; } ?>>Menu</a></li>
	</a></li>
	<?php 
	if (isset($_SESSION['adminEmail'])) { // if an admin is logged in add pages
		$message5 = '<li><a href="admin_discounts.php"';
		$message6 = '>Discounts</a></li>';
		echo $message5."if ($currentPage == 'admin_discounts.php') {echo 'id='here''; }".$message6;
	}
	if (isset($_SESSION['email'])) { // if a regular user is logged in show account info page
		$message3 = '<li><a href="account_info.php"';
		$message4 = '>Account Info</a></li>';
		$message7 = '<li><a href="order.php"';
		$message8 = '>Place an Order</a></li>';
		echo $message7."if ($currentPage == 'order.php') {echo 'id='here''; }".$message8;
		echo $message3."if ($currentPage == 'account_info.php') {echo 'id='here''; }".$message4;
	}	
	if (isset($_SESSION['firstName'])) { // if any user is logged in
		$message13 = '<li><a href="active_orders.php"';
		$message14 = '>Active Orders</a></li>';
		$message = '<li><a href="logout.php"';
		$message2 = '>Logout</a></li>';
		echo $message13."if ($currentPage == 'active_orders.php') {echo 'id='here''; }".$message14;
		echo $message."if ($currentPage == 'logout.php') {echo 'id='here''; }".$message2;
	} else {
		$message = '<li><a href="login.php"';
		$message2 = '>Customer Login</a></li>';
		$message9 = '<li><a href="create_acct.php"';
		$message10 = '>Create Account</a></li>';
		$message11 = '<li><a href="admin_login.php"';
		$message12 = '>Admin Login</a></li>';
		echo $message9."if ($currentPage == 'create_acct.php') {echo 'id='here''; }".$message10;
		echo $message."if ($currentPage == 'login.php') {echo 'id='here''; }".$message2;
		echo $message11."if ($currentPage == 'admin_login.php') {echo 'id='here''; }".$message12;
	}
	?>
</ul>
