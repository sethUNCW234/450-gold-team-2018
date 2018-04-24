<?php
/*Sam Falcon*/
		define(DBCONNSTRING,'mysql:host=localhost;dbname=yourUNCWemail'); /* your email without the @: just the letters and numbers */
		define(DBUSER, '???####');
		define(DBPASS,'????'); //database password (might be different from your UNCW one)
		try {
			$conn= new PDO(DBCONNSTRING, DBUSER, DBPASS);
		} catch (PDOException $e) {
	echo $e->getMessage();
		}
?>