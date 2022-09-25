<?php
	include('config.php');
	echo '<div style="float:left;margin-top:-500px;margin-left:-750px;width:250px">';
		$queryLead = mysql_query("SELECT * FROM assignee");
			echo "<table  border='1'  align='left' class='paginate sortable full1'>
					<tr>
						<th>Work Status</th>
						<th>No. of Item</th>
					</tr>";
			$status = array('Open','Inprogress','Hold','Resolved','Closed');
			foreach($status as $st)
			{
				echo '<tr><td><a href="?page=worksummary&status='.$st.'">'.$st.'</a></td>
						<td><a>';
							$fetchStatus = mysql_query("SELECT * FROM work WHERE work_id in (SELECT work_id FROM workstatus WHERE status='".$st."')");
							echo mysql_num_rows($fetchStatus);
						echo '</a></td>
				<tr>';
			}	
			echo '<br /><br />';
			
		$queryLead = mysql_query("SELECT * FROM assignee");
			echo "<table  border='1'  align='left' class='paginate sortable full1'>
					<tr>
						<th>Project Leads</th>
						<th>No. Of Items</th>
					</tr>";
			while($fetchLead = mysql_fetch_array($queryLead))
			{
				echo "<tr><td>";?><a href='#' onclick="getLead('includes/getLead.php?lead=<?php echo $fetchLead['name']; ?>')"><?php echo $fetchLead['name']."</a></td>
						<td><a>";
						$countLeads = mysql_query("SELECT * FROM work WHERE projectleads='".$fetchLead['name']."'");
						echo mysql_num_rows($countLeads);
				echo "</a></td></tr>";
			}		
	echo '</div>';