<?php
	include('config.php');
	ini_set( "display_errors", "0" );
	$sql1 = mysql_query("SELECT * FROM lead WHERE assign='".$_GET['assignee']."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id='".$_GET['status']."')");
	$query1 = mysql_fetch_array(mysql_query("SELECT * FROM assignee WHERE id='".$_GET['assignee']."'"));
	if(mysql_num_rows($sql1))
	{
		echo "<table><tr><td><h1>Lead Summary  of ".$query1['name']." And Closed Leads</h1></td></tr></table>#
		<table  border='1'  align='left' class='paginate sortable full'>
				
				<tr>
							<th align='left'>Lead-ID</th>
							<!--th align='left'>Client-ID</th-->
							<th align='left'>Company Name</th>
							<th align='left'>Lead Description</th>
							<th align='left'>Lead Date</th>
							<th align='left'>Product Type</th>
							<!--th align='left'>Product Sub Type</th-->
							<th align='left'>Assign</th>
						</tr>";
			$product = explode(',',$_GET['product']);
			$condition = "";
			foreach($product as $prod)
			{
				/*if(!$condition)
					$condition = "ptype='".$prod."'";
				else
					$condition .= " or ptype='".$prod."'";*/
				$sql = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND assign='".$_GET['assignee']."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id='".$_GET['status']."')");
				while($row = mysql_fetch_array($sql))
				{
					echo "<tr>
					<td><a href='?page=leadstatus&status_id=".$_GET['id']."&id=".$row['ptclid']."&ptcid=".$row['cname']."&product=".$_GET['product']."' style='text-decoration:none;'>".$row['ptclid']."</td>";
					$query = mysql_fetch_array(mysql_query("SELECT * FROM client where ptcid='".$row['cname']."'"));
					//echo	"<td>".$query['ptcid']."</td>
					echo	"<td>".$query['cname']."</td>";
					$lead = mysql_fetch_array(mysql_query("SELECT * FROM lead where ptclid='".$row['ptclid']."'"));
					$var = $lead['ldesc'];
					$newtext = wordwrap($var,50, "\n",true);
					echo	"<td>".$newtext."</td>";
					echo	"<td>".$lead['ldate']."</td>";
					$query1 = mysql_query("SELECT * FROM  producttype where slno='".$lead['ptype']."'");
					$row1 = mysql_fetch_array($query1);
					echo	"<td>".$row1['type']."</td>";
							$query2 = mysql_query("SELECT * FROM  productsubtype where id='".$lead['pstype']."'");
							$row2 = mysql_fetch_array($query2);
				//	echo	"<td>".$row2['type']."</td>";
							$query3 = mysql_query("SELECT * FROM assignee  where id='".$lead['assign']."'");
							$row3=mysql_fetch_array($query3);
					echo	"<td>".$row3['name']."</td>";
						echo 	"</tr>";
				}
			}
				echo "</table>";
		}
		else
		{
			echo "#<table  border='1'  align='left' class='paginate sortable full'>
				<tr><td></td><td>";
				echo "No Leads</td></tr>
				</table>";
		}
		
?>