<?php

/*Sam Falcon*/ //database password (might be different from your UNCW one)

		define(DBCONNSTRING,'mysql:host=127.0.0.1;dbname=pizza'); /* your email without the @: just the letters and numbers */

		define(DBUSER, 'root');

		define(DBPASS,'root'); //database password (might be different from your UNCW one)


		try {
			$conn= new PDO(DBCONNSTRING, DBUSER, DBPASS);
		} catch (PDOException $e) {
	echo $e->getMessage();
		}

		
?>

