<?php
	session_start();
	
?>
<!DOCTYPE HTML> 
<html lang="en">
<head>
<style type="text/css">
html,
body {
    height: 100%;
    margin: 0;
    padding: 0;
}

#wrapper {
    box-sizing: border-box;
    min-height: 100%;
    padding: 0 0 100px;
    position: relative;
}

footer {
    bottom: 0;
    height: 100px;
    left: 0;
    position: absolute;
    width: 100%;
}

</style>
	<meta charset="utf-8">
	<title>Gold's Pizza<?php if (isset($title)) {echo "&mdash;$title";} ?></title>
	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	
</head>
<body>
<header>
	<h1>Gold's Pizza</h1>
</header>
<div id="wrapper">
	<?php require 'menu.php'; ?>