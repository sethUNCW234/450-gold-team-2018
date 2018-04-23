<?php
/*Sam Falcon*/
		define(DBCONNSTRING,'mysql:host=localhost;dbname=sgf8396'); /* mysql:host= is the number I have been trying to change */
		define(DBUSER, 'sgf8396');
		define(DBPASS,'Parrot18Parrot18');
		try {
			$conn= new PDO(DBCONNSTRING, DBUSER, DBPASS);
		} catch (PDOException $e) {
	echo $e->getMessage();
		}
?>