<?php
	ini_set("display_errors", "0");
	include("Config.php");
	include("Quotation_Queries.php");
	if($_GET['code'])
	{
		$Code_Value = mysql_fetch_assoc(Code_Description());
		echo $Code_Value['description'];
	}
	if($_GET['subcode'])
	{
		$SubCode_Value = mysql_fetch_assoc(subCode_Description());
		echo $SubCode_Value['description'];
	}

?>