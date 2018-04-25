<?php
<<<<<<< HEAD
/*Sam Falcon*/
<<<<<<< Updated upstream
		define(DBCONNSTRING,'mysql:host=localhost;dbname=yourUNCWemail'); /* your email without the @: just the letters and numbers */
		define(DBUSER, '???####');
		define(DBPASS,'????'); //database password (might be different from your UNCW one)
=======
		 //database password (might be different from your UNCW one)
		define(DBCONNSTRING,'mysql:host=127.0.0.1;dbname=pizza'); /* your email without the @: just the letters and numbers */
		define(DBUSER, 'root');
		define(DBPASS,'root'); //database password (might be different from your UNCW one)
>>>>>>> Stashed changes
=======
/*Sam Falcon*/ //database password (might be different from your UNCW one)

+ 		define(DBCONNSTRING,'mysql:host=127.0.0.1;dbname=pizza'); /* your email without the @: just the letters and numbers */

+ 		define(DBUSER, 'root');

+ 		define(DBPASS,'root'); //database password (might be different from your UNCW one)

>>>>>>> 750d661805dd7a56d05d6d8c62a22b967596c1a3
		try {
			$conn= new PDO(DBCONNSTRING, DBUSER, DBPASS);
		} catch (PDOException $e) {
	echo $e->getMessage();
		}
<<<<<<< HEAD
		
?>
=======
?>
>>>>>>> 750d661805dd7a56d05d6d8c62a22b967596c1a3
