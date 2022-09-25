<?php
error_reporting(E_ALL);
//$dbh=mysql_connect ("localhost", "root", "ch1st") or die ('I cannot connect to the database because: ' . mysql_error());
$dbh=mysql_connect ("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("zeboba_tv",$dbh);
include('app_top.php');
?>
