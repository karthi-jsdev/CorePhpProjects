<?php
	include('config.php');
	ini_set( "display_errors", "0" );
	$product = explode(',',$_GET['product']);
	$condition = "";
	foreach($product as $prod)
	{
		if(!$condition)
			$condition = "ptype='".$prod."'";
		else
			$condition .= " or ptype='".$prod."'";
	}
	if($_GET['all'] && $_GET['product'])
		$sql = mysql_query("SELECT * FROM lead WHERE $condition order by ldate DESC");
	else if($_GET['nostatus'])
		$sql = mysql_query("SELECT * FROM lead WHERE ptclid NOT IN (SELECT ptclid FROM comments) order by ldate DESC");	
	else if($_GET['product_id'])
		$sql = mysql_query("select * from lead where ptype='".$_GET['product_id']."' AND (ptclid IN(Select ptclid From comments WHERE (status_id != '8'  and enable=1)  AND (status_id != '7'  and enable=1))  OR ptclid NOT IN (SELECT ptclid FROM comments))");
	else if($_GET['product_id1'])
		$sql = mysql_query("SELECT * FROM lead WHERE ptype='".$_GET['product_id1']."' AND ptclid IN(Select ptclid From comments WHERE status_id = '".$_GET['status_no1']."' AND enable=1) ORDER BY ldate DESC");
	else if($_GET['nowork'])
	{
		$sql1_st = mysql_fetch_array(mysql_query("SELECT * FROM status WHERE status='Closed/Won'"));
		$sql = mysql_query("SELECT * FROM lead WHERE ptclid NOT IN(SELECT lead FROM work) AND ptclid IN(Select ptclid From comments Where status_id='".$sql1_st['slno']."' AND enable='1')");
	}
	else
		$sql = mysql_query("SELECT * FROM lead WHERE ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['id']."' and enable='1') order by ldate DESC");
		
	$row2=mysql_fetch_array(mysql_query("select * from status where slno='".$_GET['id']."'"));
	if($_GET['product_id'])
		$product1 = $_GET['product_id'];
	else if($_GET['product_id1'])
		$product1 = $_GET['product_id1'];
	$getProduct = mysql_fetch_array(mysql_query("select * from producttype where slno='".$product1."'"));
	
	$getAssignee = mysql_fetch_array(mysql_query("SELECT * FROM assignee WHERE id='".$_GET['assignee']."'"));
	if($_GET['all'])
		echo "<table><tr><td><h1>Lead Summary  of All Status</h1></td></tr></table>#";
	else if($_GET['nostatus'])
		echo "<table><tr><td><h1>Lead Summary  of No Status</h1></td></tr></table>#";
	else if($_GET['product_id'] || $_GET['product_id1'])
		echo "<table><tr><td><h1>Lead Summary  of ".$getProduct['type']."</h1></td></tr></table>#";
	else if($_GET['assignee'])
		echo "<table><tr><td><h1>Lead Summary  of ".$getAssignee['name']." And Closed Leads</h1></td></tr></table>#";
	else if($_GET['nowork'])
		echo "<table><tr><td><h1>Lead Summary  of No Work And Closed Leads</h1></td></tr></table>#";
	else
		echo "<table><tr><td><h1>Lead Summary  of ".$row2['status']."</h1></td></tr></table>#";
	if(mysql_num_rows($sql))
	{
		echo "<table  border='1'  align='left' class='paginate sortable full'>
				
				<tr>
						<th align=''>Lead-ID</th>
						<!--th align='left'>Client-ID</th-->
						<th align=''>Company Name</th>
						<th align=''>Lead Description</th>
						<th align=''>Lead Date</th>
						<th align=''>Product Type</th>
						<!--th align='left'>Product Sub Type</th-->
						<th align=''>Assign</th>
						<th align=''>Status</th>
					</tr>";
			if($_GET['all'] || $_GET['product_id'] || $_GET['product_id1'])
			{
				while($row = mysql_fetch_array($sql))
				{
					echo "<tr>
						<td align='center'><a href='?page=leadstatus&id=".$row['ptclid']."&ptcid=".$row['cname']."&product=".$_GET['product']."' style='text-decoration:none;'>".$row['ptclid']."</td>";
						$query = mysql_fetch_array(mysql_query("SELECT * FROM client where ptcid='".$row['cname']."'"));
						//echo	"<td>".$query['ptcid']."</td>
						echo	"<td align='center' style='width:150px'>".$query['cname']."</td>";
						$lead = mysql_fetch_array(mysql_query("SELECT * FROM lead where ptclid='".$row['ptclid']."'"));
						$var = $lead['ldesc'];
						$newtext = wordwrap($var,50, "\n",true);
						echo	"<td style='width:150px'>".$newtext."</td>";
						echo	"<td  align='center'>".$lead['ldate']."</td>";
						$query1 = mysql_query("SELECT * FROM  producttype where slno='".$lead['ptype']."'");
						$row1 = mysql_fetch_array($query1);
						echo	"<td  align='center'>".$row1['type']."</td>";
						$query3 = mysql_query("SELECT * FROM assignee  where slno='".$lead['assign']."'");
						$row3=mysql_fetch_array($query3);
						echo	"<td  align='center'>".$row3['name']."</td>";
						$status = mysql_fetch_array(mysql_query("Select * From comments Where ptclid = '".$row['ptclid']."' And enable=1"));
						$status_id = mysql_fetch_array(mysql_query("Select * From status Where slno = '".$status['status_id']."'"));
						if($status_id)
							echo "<td  align='center'>".$status_id['status']."</td>";
						else
							echo "<td  align='center'>Open</td>";
							
						echo 	"</tr>";	
				}	
				echo "</table>";
			}
			else
			{
				foreach($product as $prod)
				{
					if($_GET['nostatus'])
						$sql1 = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid NOT IN (SELECT ptclid FROM comments) ORDER BY ldate DESC");
					else if($_GET['nowork'])
					{
						$sql1_st1 = mysql_fetch_array(mysql_query("SELECT * FROM status WHERE status='Closed/Won'"));
						$sql1 = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid NOT IN(SELECT lead FROM work) AND ptclid IN(Select ptclid From comments Where status_id='".$sql1_st1['slno']."' AND enable='1')");
					}
					else	
						$sql1 = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$_GET['id']."' and enable='1') ORDER BY ldate DESC");
						
					while($row = mysql_fetch_array($sql1))
					{
						echo "<tr>
						<td align='center'><a href='?page=leadstatus&id=".$row['ptclid']."&ptcid=".$row['cname']."&product=".$_GET['product']."' style='text-decoration:none;'>".$row['ptclid']."</td>";
						$query = mysql_fetch_array(mysql_query("SELECT * FROM client where ptcid='".$row['cname']."'"));
						//echo	"<td>".$query['ptcid']."</td>
						echo	"<td align='center' style='width:150px'>".$query['cname']."</td>";
						$lead = mysql_fetch_array(mysql_query("SELECT * FROM lead where ptclid='".$row['ptclid']."'"));
						$var = $lead['ldesc'];
						$newtext = wordwrap($var,50, "\n",true);
						echo	"<td style='width:150px'>".$newtext."</td>";
						echo	"<td  align='center'>".$lead['ldate']."</td>";
						$query1 = mysql_query("SELECT * FROM  producttype where slno='".$lead['ptype']."'");
						$row1 = mysql_fetch_array($query1);
						echo	"<td  align='center'>".$row1['type']."</td>";
						$query3 = mysql_query("SELECT * FROM assignee  where slno='".$lead['assign']."'");
						$row3=mysql_fetch_array($query3);
						echo	"<td  align='center'>".$row3['name']."</td>";
						$status = mysql_fetch_array(mysql_query("Select * From comments Where ptclid = '".$row['ptclid']."' And enable=1"));
						$status_id = mysql_fetch_array(mysql_query("Select * From status Where slno = '".$status['status_id']."'"));
						if($status_id)
							echo "<td  align='center'>".$status_id['status']."</td>";
						else
							echo "<td  align='center'>Open</td>";
							
						echo 	"</tr>";	
					}
				
				}
				echo "</table>";				
			}
		}		
		else
		{
			echo "<table  border='1'  align='left' class='paginate sortable full'>
				<tr><td></td><td>";
				echo "No Leads</td></tr>
				</table>";
		}
?>