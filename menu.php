<?php
$currentPage = basename($_SERVER['SCRIPT_FILENAME']); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.0.0/superhero/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<nav class = "navbar navbar-expand-sm bg-light navbar-light" id="nav">
<ul class="navbar-nav">
	<li class="nav-item active"><a class="nav-link" href="index.php" <?php if ($currentPage == 'index.php') {echo 'id="here"'; } ?>>Home</a></li>
	<li class="nav-item"><a class="nav-link" href="order_pizza.php" <?php if ($currentPage == 'blog.php') {echo 'id="here"'; } ?>>Order</a></li>
	<li class="nav-item"><a  class="nav-link"href ="create_acct.php" <?php if ($currentPage == 'create_acct.php') {echo 'id="here"'; } ?>>Create Account</a></li>
	<?php 
	if (isset($_SESSION['firstName'])) {
	$message = '<li class="nav-item"><a class = "nav-link" href="logout.php"';
	$message2 = '>Logout</a></li>';
	echo $message."if ($currentPage == 'logout.php') {echo 'id='here''; }".$message2;
	} else {
	$message = '<li class="nav-item"><a class="nav-link" href="login.php"';
	$message2 = '>Login</a></li>';
	echo $message."if ($currentPage == 'login.php') {echo 'id='here''; }".$message2;
	}
	?>
	</ul>
</nav>