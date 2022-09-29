<?php
	include('Config.php');
	include('Stock_Management_Queries.php');
	ini_set("display_errors","0");
	if($_GET['materialcode'] && $_GET['batchnumber'] && $_GET['number'])
	{
		$rawmaterial = mysqli_fetch_assoc(Rawmaterialbatch());
		//if($_GET['materialcode'] == $rawmaterial['rawmaterialid'] && $_GET['batchnumber']==$rawmaterial['number'] && $_GET['number']==$rawmaterial['numbers'])
		if(($rawmaterial['rawmaterialid']>0) && ($rawmaterial['number']>0)&& ($rawmaterial['numbers']>0))
			echo 'The Rawmaterial is already available for this Batch.Please Verify';
		else
		{}
	}         
	?>