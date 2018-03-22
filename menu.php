<?php
$currentPage = basename($_SERVER['SCRIPT_FILENAME']); ?>
<ul id="nav">
	<li><a href="index.php" <?php if ($currentPage == 'index.php') {echo 'id="here"'; } ?>>Home</a></li>
	<li><a href="blog.php" <?php if ($currentPage == 'blog.php') {echo 'id="here"'; } ?>>Blog</a></li>
	<li><a href="gallery.php" <?php if ($currentPage == 'gallery.php') {echo 'id="here"'; } ?>>Gallery</a></li>
	<li><a href="product_list.php" <?php if ($currentPage == 'product_list.php') {echo 'id="here"'; } ?>>Purchase Prints</a></li>
	<li><a href="contact_us.php" <?php if ($currentPage == 'contact_us.php') {echo 'id="here"'; } ?>>Contact</a></li>
	<li><a href ="create_acct.php" <?php if ($currentPage == 'create_acct.php') {echo 'id="here"'; } ?>>Register</a></li>
	<?php 
	if (isset($_SESSION['firstName'])) {
	$message = '<li><a href="logout.php"';
	$message2 = '>Logout</a></li>';
	echo $message."if ($currentPage == 'logout.php') {echo 'id='here''; }".$message2;
	} else {
	$message = '<li><a href="login.php"';
	$message2 = '>Login</a></li>';
	echo $message."if ($currentPage == 'login.php') {echo 'id='here''; }".$message2;
	}
	?>
</ul>