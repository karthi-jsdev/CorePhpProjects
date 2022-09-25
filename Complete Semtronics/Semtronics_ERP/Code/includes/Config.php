<?php
	$dbh = mysql_connect ("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error());
	mysql_select_db ("semtronics_recent", $dbh) or die ('I cannot select the database because: ' . mysql_error());
?>