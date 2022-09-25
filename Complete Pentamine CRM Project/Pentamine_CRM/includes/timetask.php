<?php
	
	include("config.php");
	$assignee = mysql_fetch_array(mysql_query("select * from user where username = '".$_GET['assignee']."'"));
	if($_GET['tim'] == "day")
		$task = mysql_query("select * from task where assignee = '".$_GET['assignee']."' AND tdate='".date('Y-m-d')."' and tstatus!='Closed'");
	else if($_GET['tim'] == "week")
		$task = mysql_query("select * from task where assignee = '".$_GET['assignee']."' AND tdate>'".date('Y-m-d')."' and tdate<'".date('Y-m-d', strtotime('+'.(6-date('w')+1).' day', strtotime(date('Y-m-d'))))."' and tstatus!='Closed'");
	else if($_GET['tim'] == "nextweek")
		$task = mysql_query("select * from task where assignee = '".$_GET['assignee']."' AND tdate>'".date('Y-m-d', strtotime('+'.(6-date('w')+1).' day', strtotime(date('Y-m-d'))))."' and tdate<'".date('Y-m-d', strtotime('+'.(12-date('w')+2).' day', strtotime(date('Y-m-d'))))."' and tstatus!='Closed'");	
	else if($_GET['tim'] == "future")
		$task = mysql_query("select * from task where assignee = '".$_GET['assignee']."' AND tdate>'".date('Y-m-d', strtotime('+'.(12-date('w')+2).' day', strtotime(date('Y-m-d'))))."' and tstatus!='Closed'");
	else if($_GET['tim'] == "overdue")
		$task = mysql_query("select * from task where assignee = '".$_GET['assignee']."' AND tdate<'".date('Y-m-d')."' and tstatus!='Closed'  and tstatus<=4 ORDER BY tdate ASC");
	else
		$task = mysql_query("select * from task where assignee = '".$_GET['tim']."' and tstatus!='Closed'");
	echo "<table  border='1'  align='left' class='paginate sortable full'>
		<tr>
			<th>Task-ID</th>
			<th>Lead-ID</th>
			<th>Task Date</th>
			<th>Task Description</th>
			<th>Target Date</th>
			<th>Assignee</th>
			<th>Status</th>
		</tr>";
			while($row = mysql_fetch_array($task))
						{
							echo "<tr>
							<td><a href='?page=taskstatus&id=".$row['taskid']."&ptclid=".$row['ptclid']."'>".$row['taskid']."</a></td>
							<td>".$row['ptclid']."</td>
							<td>".$row['taskdate']."</td>
							<td>".$row['tdesc']."</td>
							<td>".$row['tdate']."</td>";
							$query1 = mysql_query("SELECT * FROM assignee  where id='".$row['assignee']."'");
							$row1=mysql_fetch_array($query1);
							echo "<td align='center'>".$row1['name']."</td>";
							$query2 = mysql_query("SELECT * FROM taskcomments  where tskid='".$row['taskid']."' AND enable=1");
							$row2=mysql_fetch_array($query2);
												if($row2['tstatus'])
													{
														echo "<td align='center'>".$row2['tstatus']."</td>";
													}
												else
													{
														echo "<td align='center'>Open</td>";	
													}
												echo "</tr>";	
						}	
						echo "</table>";
?>	
