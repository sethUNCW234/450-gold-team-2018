<?php
	session_start();
	include 'title.php';
?>
<!DOCTYPE HTML> 
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gold's Pizza<?php if (isset($title)) {echo "&mdash;$title";} ?></title>
	<link href="pizza.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
	<h1>Gold's Pizza</h1>
</header>
<div id="wrapper">
	<?php require 'menu.php'; ?>