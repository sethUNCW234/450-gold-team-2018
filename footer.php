	<style type="text/css">
	/*footer{
		position:fixed;
 		bottom:0;
 		left:0;
	}
</style>

	<footer>
		<p>&copy;
		<?php
			date_default_timezone_set("America/New_York");
			$startYear = 2006;
			$thisYear = date('Y');
			if ($startYear == $thisYear) {
				echo $startYear;
			} else {
				echo "$startYear".'&ndash;'."$thisYear";
			}
		?>
		</p>
	</footer>
</div>
</body>
</html>

