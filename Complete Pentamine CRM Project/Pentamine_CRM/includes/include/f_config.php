<?php
$host 		= 'ftp.eu.bitgravity.com';
$workDir 	= './videos';
$destDir 	= '';
$ftpstream 	= @ftp_connect($host);

$sql = "SELECT * FROM config";
$result = mysql_query($sql);
while($tmp = mysql_fetch_assoc($result)){
	$field = $tmp['option'];
	$config[$field] = $tmp['value'];
}
//echo '<pre>'; print_r($config); echo '</pre>';
