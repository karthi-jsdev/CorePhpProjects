<?php
	include('config.php');
	$workQuery = mysql_query("SELECT * FROM work WHERE projectleads='".$_GET['lead']."'");
	if(mysql_num_rows($workQuery))
	{
		echo "<table>
					<tr><td><h1>Work Summary Of ".$_GET['lead']." </h1></td></tr>
				</table>#
				<table border='1'  align= 'left' style='width:1000px' class='paginate sortable full' >
			<tr>
				<th align='left'>Work-ID</th>
				<th align='left'>Client Name</th>
				<th align='left'>Lead-ID</th>
				<th align='left'>Description</th>
				<th align='left'>Project Lead</th>
				<th align='left'>Target Date</th>
				<th align='left'>Developer</th>
				<th align='left'>Tester</th>
			</tr>";
			while($fetchWork = mysql_fetch_array($workQuery))
			{
				echo "<tr>
						<td><a href='?page=workstatus&workId=".$fetchWork['work_id']."&leadid=".$fetchWork['lead']."&clientid=".$fetchWork['client']."'>".$fetchWork['work_id']."</a></td>
						<td>".$fetchWork['client']."</td>
						<td>".$fetchWork['lead']."</td>
						<td>".$fetchWork['description']."</td>
						<td>".$fetchWork['projectleads']."</td>
						<td>".$fetchWork['tdate']."</td>
						<td>".$fetchWork['developer']."</td>
						<td>".$fetchWork['tester']."</td>
					</tr>";
			}
		echo "</table>";
	}
	else
		echo "No Data Found #";
?>