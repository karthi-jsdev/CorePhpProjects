<?php
	include("config.php");
		$result = mysql_query("SELECT * FROM employee");
		if(!mysql_num_rows($result))
			echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
		$rowsperpage = 10;
		$total_pages = ceil(mysql_num_rows($result) / $rowsperpage);
			
		if($_GET['pageno']>1)
			$Limit = "LIMIT ".(($_GET['pageno']-1)*$rowsperpage).",".$rowsperpage;
		else
			$Limit = "LIMIT 0,".$rowsperpage;
					
		$query = mysql_query("SELECT * FROM employee ORDER BY id Desc $Limit");
		if(mysql_num_rows($query))
		{
			echo "<div style='width:1000px;height:550px;overflow-x:scroll;overflow-y:auto;'>
					<div style='float:left;margin-top:25px;margin-left:0px;width:800px;height:0;'>
					<table id='sub1'>
						<tr><td><h1>Employee Summary</h1></td></tr>
					</table>
				  <table border='1'  align= 'left' class='paginate sortable full' width='20' id='sub'>
					<tr>
						<th>Employee-ID</th>
						<th>Name</th>
						<th>Company Address</th>
						<th>Contact  Phone Number</th>
						<th>Pesonal E-Mail-ID</th>
						<th>Professional Email-ID</th>
						<th>Starting Date</th>
						<th>Qualification</th>
					</tr>";
		}
		while($row = mysql_fetch_array($query))
		{
		echo    "<tr>
					<td><a href='?page=employeestatus&empid=".$row['empid']."'>".$row['empid']."</a></td>
					<td>".$row['name']."
					</td>
					<td>".$row['address']."
					</td>
					<td>".$row['pnum']."
					</td>
					<td>".$row['pemail']."
					</td>
					<td>".$row['cemail']."
					</td>
					<td>".$row['date']."
					</td>
					<td>".$row['qualification']."
					</td>
				</tr>";
		}
		echo "</table></div>";
		echo '</div><div style="float:left;margin-top:650px;margin-left:450px;width:2000px">';
		include("includes/pagination.php");
		echo '</div>';