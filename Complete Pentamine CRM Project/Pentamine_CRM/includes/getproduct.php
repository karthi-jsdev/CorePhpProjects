<?php
	include('config.php');
	ini_set( "display_errors", "0" );
	$sql = mysql_query("SELECT * FROM lead WHERE  ptype ='".$_GET['id']."' ORDER BY id DESC");
	$row2 = mysql_fetch_array(mysql_query("select * from producttype where slno='".$_GET['id']."'"));
	if(mysql_num_rows($sql))
	{
		echo "<table><tr><td><h1>Lead Summary  of ".$row2['type']."</h1></td></tr></table>#
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
				while($row = mysql_fetch_array($sql))
				{
					echo "<tr>
					<td><a href='?page=leadstatus&id=".$row['ptclid']."&ptcid=".$row['cname']."&product=".$_GET['product']."' style='text-decoration:none;'>".$row['ptclid']."</td>";
					$query = mysql_fetch_array(mysql_query("SELECT * FROM client where ptcid='".$row['cname']."'"));
					//echo	"<td>".$query['ptcid']."</td>
					echo	"<td>".$query['cname']."</td>";
					$lead = mysql_fetch_array(mysql_query("SELECT * FROM lead where ptclid='".$row['ptclid']."'"));
					echo	"<td>".$lead['ldate']."</td>";
					$var = $lead['ldesc'];
					$newtext = wordwrap($var,50, "\n",true);
					echo	"<td>".$newtext."</td>";
			echo	"<td>".$row2['type']."</td>";
					$query2 = mysql_query("SELECT * FROM  productsubtype where id='".$lead['pstype']."'");
					$row4 = mysql_fetch_array($query2);
			//echo	"<td>".$row4['type']."</td>";
					$query3 = mysql_query("SELECT * FROM assignee  where id='".$lead['assign']."'");
					$row3=mysql_fetch_array($query3);
			echo	"<td>".$row3['name']."</td>";
				echo 	"</tr>";	
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