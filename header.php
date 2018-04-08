<?php
	session_start();
	include 'title.php';
?>
<!DOCTYPE HTML> 
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gold's Pizza<?php if (isset($title)) {echo "&mdash;$title";} ?></title>
	</head>

<body>
<header>

</header>
<div id="wrapper">
	<?php require 'menu.php'; ?>