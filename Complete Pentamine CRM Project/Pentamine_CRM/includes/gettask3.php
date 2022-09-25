<?php 
include("config.php");
$sql = mysql_query("SELECT * FROM task WHERE assignee='".$_GET['assignee']."' AND taskid IN(SELECT tskid FROM taskcomments WHERE tstatus ='Closed' AND enable=1) ORDER BY tdate desc");
$query = mysql_fetch_array(mysql_query("SELECT * FROM assignee WHERE id='".$_GET['assignee']."'"));
	if(mysql_num_rows($sql))
	{
		//echo '<div style="float:left;margin-top:100px;margin-left:75px;width:800px;height:0;">';
		echo "<table><tr><td><h1>Task Summary of ".$query['name']." And Closed Tasks </h1><td></tr></table>#<table  border='1'  align='left' class='paginate sortable full'>
			<tr>
							<th>Task-ID</th>
							<th>Client</th>
							<th>Task Date</th>
							<th>Task Description</th>
							<th>Target Date</th>
							<th>Assigneee</th>
							<th>Status</th>
						</tr>";
				while($row = mysql_fetch_array($sql))
						{
							echo "<tr>
							<td><a href='?page=taskstatus&id=".$row['taskid']."&ptclid=".$row['ptclid']."'>".$row['taskid']."</a></td>";
							if($row['ptclid'] != "Others")
							{
								$client_id = mysql_fetch_array(mysql_query("SELECT * FROM lead WHERE ptclid='".$row['ptclid']."' "));
								$client_name = mysql_fetch_array(mysql_query("SELECT * FROM client WHERE ptcid='".$client_id['cname']."' "));
								echo "<td>".$client_name['cname']."</td>";
							}
							else
								echo "<td>".$row['ptclid']."</td>";
								
							echo "<td>".$row['taskdate']."</td>
							<td>".$row['tdesc']."</td>
							<td>".$row['tdate']."</td>";
							$query1 = mysql_query("SELECT * FROM assignee  where id='".$row['assignee']."'");
							$row1=mysql_fetch_array($query1);
							echo "<td>".$row1['name']."</td>";
								echo "<td>".$row['status']."</td>";
								
							echo "</tr>";	
						}	
						echo "</table>";
		}
		else
		{
			echo "#<table  border='1'  align='left' class='paginate sortable full'>
		<tr><td></td><td>";
		echo "No Tasks Found</td></tr>
		</table>";
		}
		?>