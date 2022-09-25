<?php
	include('config.php');
	ini_set( "display_errors", "0" );
	if($_GET['id'])
		$sql = mysql_query("SELECT * FROM recurring WHERE recurring_product=$_GET[id]");
	else if($_GET['month'])
	{ 
		$sql = mysql_query("Select * from recurring where  Month(recurring_date)=".$_GET['month']." And recurring_status='Enable'");
		$sql2 = mysql_query("Select * from recurring where Month(recurring_date)=".$_GET['month']." And recurring_status='Enable'");
		$fetch = mysql_fetch_array($sql2);
	}	
	$row2 = mysql_fetch_array(mysql_query("select * from producttype where slno='".$_GET['id']."' OR slno='".$fetch['recurring_product']."'"));
	if(mysql_num_rows($sql))
	{
		echo "<table><tr><td><h1>Recurring Summary  of ".$row2['type']."</h1></td></tr></table>#
		<table  border='1'  align='left' class='paginate sortable full'>
				<tr>
							<th align='left'>Company Name</th>
							<th align='left'>Product Type</th>
							<th align='left'>Frequency</th>
							<th align='left'>Recurring-Date</th>
							<th align='left'>Yearly-Amount</th>
							<th align='left'>Status</th>
						</tr>";
				while($row = mysql_fetch_array($sql))
				{
					echo "<tr>";
					$query = mysql_fetch_array(mysql_query("SELECT * FROM client where ptcid='".$row['recurring_client']."'"));
					echo	"<td>".$query['cname']."</td>";
			echo	"<td>".$row2['type']."</td>
							<td>".$row['recurring_frequency']."</td>
							<td>".$row['recurring_date']."</td>
							<td>".$row['recurring_yearlyamount']."</td>
							<td>".$row['recurring_status']."</td>";
				echo 	"</tr>";
				}	
				echo "</table>";			
			echo 	
				"<tr>
							<th style=color:red; align='left'>Total No.Of ".$row2['type']." Products</th>
							<th style=color:red; align='left'>Total Amount</th>
						</tr>";
				if($_GET['id'])
					$sql1 = mysql_query("SELECT * FROM recurring WHERE recurring_product=$_GET[id]");
				else if($_GET['month'])	
					$sql1 =  mysql_query("Select * from recurring where Month(recurring_date)=".$_GET['month']." And recurring_status='Enable'");
				$numberofproduct = mysql_num_rows($sql1);
				$yeartotal=$totalamount =0;
				while($row3 = mysql_fetch_array($sql1))
				{
					"<tr><td>".$numberofproduct."</td>";
					$totalamount = $row3['recurring_yearlyamount'];
					$yeartotal =  $totalamount+$yeartotal;					
				}
				echo "<tr><td>".$numberofproduct."</td>";
					$totalamount = $row3['recurring_yearlyamount'];
					$yeartotal =  $totalamount+$yeartotal;
					echo 	"<td>".$yeartotal."</td></tr>";
	}
		else
		{
			echo "No Leads";
		}	
			?>
		