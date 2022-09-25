<?php
	include("config.php");
	$product = explode(',',$_GET['product']);
	if($_GET['param'] == "status")
	{
		echo "Lead Status Report".",";
		$statusQuery = mysql_query('Select * From status where status!="Closed/Won" AND status!="Closed/Lost"');
		while($statusFetch = mysql_fetch_array($statusQuery))
		{ 
			$amount = $total = $var_value1 = 0;
			foreach($product as $prod)
			{
				$query = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$statusFetch['slno']."' and enable='1')");
				while($fetchquery=mysql_fetch_array($query))
				{
					$readquery = mysql_fetch_array(mysql_query("Select * From comments WHERE ptclid='".$fetchquery['ptclid']."' And status_id ='".$statusFetch['slno']."' and enable='1'"));
					$total +=  $readquery['amount'];
				}
			}
			echo $statusFetch['status'].'('.$total.'),'.$total.",";
		}
	}
	else if($_GET['param'] == "product")
	{
		echo "Product Status Reports".",";
		$sql2 = mysql_fetch_array(mysql_query("SELECT * FROM status where status='Closed/Won'"));
		foreach($product as $prod)
		{
			$Amount = $Total = 0;
			$queryLead = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id!='".$sql2['slno']."' AND enable='1') ");
			while($queryProduct = mysql_fetch_array($queryLead))
			{
				$Product_query = mysql_query("Select * From producttype WHERE slno = '".$queryProduct['ptype']."'");
				$fetchProduct = mysql_fetch_array($Product_query);
				$readquery = mysql_fetch_array(mysql_query("Select * From comments WHERE ptclid='".$queryProduct['ptclid']."'  and status_id!='".$sql2['slno']."' AND enable='1'"));	
				$Amount += $readquery['amount'];
			}
			if(mysql_num_rows($queryLead))
			{
				echo $fetchProduct['type'].'('.$Amount.'),'.$Amount.',';
			}
		}
	}
	else if($_GET['param'] == "month")
	{
		echo "Month Status Reports".",";
		$sql2 = mysql_query("SELECT * FROM status where status='Closed/Won'");
		$monthName = array("April","May","June","July","August","September","October","November","December","January","Febuary","March");		
		while($row1_status = mysql_fetch_array($sql2))
		{
			$i = 0;
			for($i = 0;$i<count($monthName);$i++)
			{
				$i1= $i+4;
				if($i1 == 13)
					$i1 = 14-$i1;
				if($i1 == 14)
					$i1 = 16-$i1;
				if($i1 == 15)
					$i1 = 18-$i1;
				$amount = 0;
				$total = 0;
				$cdate = "";
				foreach($product as $prod)
				{
					$query = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$row1_status['slno']."' and enable='1')");
					while($fetchquery=mysql_fetch_array($query))
					{
						$read = mysql_query("Select * From comments WHERE ptclid='".$fetchquery['ptclid']."' And status_id ='".$row1_status['slno']."' and enable='1' ");
						$readquery = mysql_fetch_array($read);
						if(date("m", strtotime($readquery['cdate'])) == $i1)
						{
							$amount += $readquery['amount'];
						}
					}
				}
				echo $monthName[$i]."(".$amount.")".",".$amount.",";
			}
		}
	}
	else if($_GET['param'])
	{	
		echo "Month Status Reports".",";
		$sql2 = mysql_fetch_array(mysql_query("SELECT * FROM status where status='Closed/Won'"));
		$amount = 0;
		$Product_query;
		foreach($product as $prod)
		{
			$query = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$sql2['slno']."' and enable='1')");
			while($fetchquery=mysql_fetch_array($query))
			{
				$Product_query = mysql_query("Select * From producttype WHERE slno = '".$fetchquery['ptype']."'");
				$fetchProduct = mysql_fetch_array($Product_query);
				$read = mysql_query("Select * From comments WHERE ptclid='".$fetchquery['ptclid']."' And status_id ='".$sql2['slno']."' and enable='1' ");
				$readquery = mysql_fetch_array($read);
				if(date("m", strtotime($readquery['cdate'])) == $_GET['param'])
				{
					$amount += $readquery['amount'];
				}
			}
			if(mysql_num_rows($query))
			{	
				if($amount != 0)
					echo $fetchProduct['type']."(".$amount.")".",".$amount.",";
				$amount = 0;
			}
		}
	}
?>