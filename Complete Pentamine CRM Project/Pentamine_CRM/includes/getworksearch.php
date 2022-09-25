<?php
	include('config.php');
	$Query = "";
	if($_GET['work'] || $_GET['client'])
		$Query .= "where work_id = '".$_GET['work']."'  and client = '".$_GET['client']."' ";
	if($_GET['status'] && ($_GET['work'] || $_GET['client']))
		$Query .= "and work_id in (Select work_id from workstatus where status='".$_GET['status']."' and enable=1)";
	else if($_GET['status'])
		$Query .= "where work_id in (Select work_id from workstatus where status='".$_GET['status']."' and enable=1)";
	$Work = mysql_query("Select * From work ".str_replace("= ''", "!= ''", $Query));
	//echo "Select * From work ".str_replace("= ''", "!= ''", $Query);
	if(mysql_num_rows($Work))
	{
		echo "<table><tr><td><h1>Work Summary</h1></td></tr></table>#";
		echo "<table border='1'  align= 'left' style='width:1000px' class='paginate sortable full1'>
		<tr>
			<th align='left'>Work-ID</th>
			<th align='left'>Client Name</th>
			<th align='left'>Description</th>
			<th align='left'>Priority</th>
			<th align='left'>Project Lead</th>
			<th align='left'>Target Date</th>
			<th align='left'>Developer</th>
			<th align='left'>Tester</th>
		</tr>";
	
	while($fetchWork = mysql_fetch_array($Work))
	{
		echo "<tr>
				<td><a href='?page=workstatus&workId=".$fetchWork['work_id']."&leadid=".$fetchWork['lead']."&clientid=".$fetchWork['client']."'>".$fetchWork['work_id']."</a></td>";
				$getClient = mysql_fetch_array(mysql_query("SELECT * FROM client WHERE ptcid = '".$fetchWork['client']."'"));
			echo "<td>".$getClient['cname']."</td>
				<td>".$fetchWork['description']."</td>
				<td>".$fetchWork['priority']."</td>
				<td>".$fetchWork['projectleads']."</td>
				<td>".$fetchWork['tdate']."</td>
				<td>".$fetchWork['developer']."</td>
				<td>".$fetchWork['tester']."</td>
			</tr>";
	}
	echo '</table>';
	}
	else
		echo "No Data Found #";
?>