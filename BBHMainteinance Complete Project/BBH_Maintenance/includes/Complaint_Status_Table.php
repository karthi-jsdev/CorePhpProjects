<?php
	function PaginationFor($PaginationFor, $PageNo, $TotalPages)
	{
		$_GET['pageno'] = $PageNo;
		$_GET["PaginationFor"] = $PaginationFor;
		$_GET['total_pages'] = $TotalPages;
		if($_GET['total_pages'] > 1)
			include("includes/Ajax_Pagination.php");
	}
	
	if($_GET['Initial'])
		include("includes/Complaint_Status_Queries.php");
	else
	{
		session_start();
		include("Config.php");
		include("Complaint_Status_Queries.php");
		$PaginationFor = $_GET['PaginationFor'];
	}
	$Limit = 2;
	if($_GET['pageno'])
		$Start = ($_GET['pageno']-1)*$Limit;
	else
	$Start = 0;
	$Fetch_User = mysqli_fetch_array(Complaint_Fetch_User($_SESSION['id']));
	$Complaint_Fetch_User = mysqli_fetch_array(Complaint_Users_Fetch($Fetch_User['userroleid']));
	
				
	if(isset($_GET['subpage']))
		include("includes/Complaint_Status_Of_Ticket.php");
	else
	{
		if(!$PaginationFor || $PaginationFor == "CreatedTickets")
		{ ?>
			<div id='CreatedTickets'>
			<center><strong>My Tickets</strong></center>
			<br />
			<table>
				<tr>
					<td style="width:750px"></td>
					<?php
					$All_Status = Complaint_Status();
					$Complaint_Created = SelectAll_Created_Tickets();
					echo '<td style="width:200px"><a href="?page=Complaint_Status">ALL('.mysqli_num_rows($Complaint_Created).')</a></td>';
					while($Statuses = mysqli_fetch_array($All_Status))
						echo '<td style="width:200px"><a href="?page=Complaint_Status&StatusId='.$Statuses['id'].'">'.$Statuses['name'].'('.mysqli_num_rows(Complaint_Count_Status($Statuses['id'])).')</a></td>';
					?>
				</tr>
			</table>
			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th align='left'>Priority</th>
						<th align='left'>Ticket No</th>
						<th align='left'>Description</th>
						<th align='left'>Department</th>
						<th align='left'>Complaint-Date</th>
						<th align='left'>Status</th>
						<th align='left'>Action</th>
					</tr>
				</thead>
				<?php
				$Complaint_Complaints_My_Ticket = Select_Created_Tickets_ByStatusId_ByLimit($Start, $Limit);
				$_GET['total_pages'] = ceil(mysqli_num_rows(SelectAll_Created_Tickets_ByStatusId())/$Limit);
				while($Complaint_My_Ticket = mysqli_fetch_array($Complaint_Complaints_My_Ticket))
				{
					$Priority = mysqli_fetch_array(Complaint_Get_Priority($Complaint_My_Ticket['priorityid']));
					$Department = mysqli_fetch_array(Complaint_Get_Department($Complaint_My_Ticket['departmentid']));
					$Status = mysqli_fetch_array(Complaint_Get_Status($Complaint_My_Ticket['statusid']));
					echo '<tr>
					<td style="width:10px" align="left">'.$Priority['name'].'</td>
					<td style="width:150px" align="left"><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$Complaint_My_Ticket['ticketno'].'&ComplaintId='.$Complaint_My_Ticket['id'].'">'.$Complaint_My_Ticket['ticketno'].'</a></td>
					<td style="width:250px" >'.$Complaint_My_Ticket['description'].'</td>
					<td align="left">'.$Department['name'].'</td>
					<td align="left" style="width:150px">'.$Complaint_My_Ticket['createdat'].'</td>
					<td align="left">'.$Status['name'].'</td><td align="left">';
					if(($Complaint_My_Ticket['statusid'] == 5))
						echo '<a href="?page=Close_Complaint&TicketNo='.$Complaint_My_Ticket['ticketno'].'&ComplaintId='.$Complaint_My_Ticket['id'].'">Close</a>';
					echo '</td>
					</tr>';
				} ?>
			</table>
			<?php
			if($_GET["Initial"])
				PaginationFor("CreatedTickets", 1, $_GET['total_pages']);
			echo "</div>";
		}
		
		if(!$PaginationFor || $PaginationFor == "AssignedTickets")
		{ ?>
			<div id='AssignedTickets'>
				<br /><br />
				<center><strong>Assigned Tickets</strong></center>
				<table>
					<tr>
						<td style="width:750px"></td>
						<?php
						$All_Status = Complaint_Status();
						$Complaint_Assigned = SelectAll_Assigned_Tickets();
						echo '<td style="width:200px"><a href="?page=Complaint_Status">ALL('.mysqli_num_rows($Complaint_Assigned).')</a></td>';
						while($Statuses = mysqli_fetch_array($All_Status))
							echo '<td style="width:200px"><a href="?page=Complaint_Status&AssignedStatusId='.$Statuses['id'].'">'.$Statuses['name'].'('.mysqli_num_rows(Complaint_Count_Status_of_Assigned($Statuses['id'])).')</a></td>';
						?>
					</tr>
				</table>
			
				<table class="paginate sortable full">
					<thead>
						<tr>
							<th align='left'>Priority</th>
							<th align='left'>Ticket No</th>
							<th align='left'>Description</th>
							<th align='left'>Department</th>
							<th align='left'>Complaint-Date</th>
							<th align='left'>Status</th>
							<th align='left'>Action</th>
						</tr>
					</thead>
					<?php
					$_GET['total_pages'] = ceil(mysqli_num_rows(SelectAll_Assigned_Tickets_ByStatusId())/$Limit);
					$Complaint_Assigned = Select_Assigned_Tickets_ByStatusId_ByLimit($Start, $Limit);
					while($Complaint_Assigned_Ticket = mysqli_fetch_array($Complaint_Assigned))
					{
						$Priority = mysqli_fetch_array(Complaint_Get_Priority($Complaint_Assigned_Ticket['priorityid']));
						$Department = mysqli_fetch_array(Complaint_Get_Department($Complaint_Assigned_Ticket['departmentid']));
						$Status = mysqli_fetch_array(Complaint_Get_Status($Complaint_Assigned_Ticket['statusid']));
						echo '<tr>
						<td style="width:10px" align="left">'.$Priority['name'].'</td>
						<td style="width:150px" align="left"><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$Complaint_Assigned_Ticket['ticketno'].'&ComplaintId='.$Complaint_Assigned_Ticket['id'].'">'.$Complaint_Assigned_Ticket['ticketno'].'</a></td>
						<td style="width:250px" >'.$Complaint_Assigned_Ticket['description'].'</td>
						<td align="left">'.$Department['name'].'</td>
						<td align="left" style="width:150px">'.$Complaint_Assigned_Ticket['createdat'].'</td>
						<td align="left">'.$Status['name'].'</td><td align="left">';
						if(($Complaint_Assigned_Ticket['statusid'] == 5))	
							echo '<a href="?page=Close_Complaint&TicketNo='.$Complaint_Assigned_Ticket['ticketno'].'&ComplaintId='.$Complaint_Assigned_Ticket['id'].'">Close</a>';
						echo '</td>
						</tr>';
					} ?>
				</table>
			<?php
			if($_GET["Initial"])
				PaginationFor("AssignedTickets", 1, $_GET['total_pages']);
			echo "</div>";
		}
		
		if($_SESSION['roleid'] == 1 || $_SESSION['roleid'] == 5)
		{
			if(!$PaginationFor || $PaginationFor == "AllTickets")
			{ ?>
				<div id='AllTickets'>
					<br />
					<center><strong>All Tickets</strong></center>
					<br />
					<table>
						<tr>
							<td style="width:750px"></td>
							<?php
							$All_Status = Complaint_Status();
							$ComplaintsAll = SelectAll_All_Tickets();
							echo '<td style="width:200px"><a href="?page=Complaint_Status">ALL('.mysqli_num_rows($ComplaintsAll).')</a></td>';
							while($Statuses = mysqli_fetch_array($All_Status))
								echo '<td style="width:200px"><a href="?page=Complaint_Status&StatusAll='.$Statuses['id'].'">'.$Statuses['name'].'('.mysqli_num_rows(Complaint_Count_Status_All($Statuses['id'])).')</a></td>';
							?>
						</tr>
					</table>
					
					<table class="paginate sortable full">
						<thead>
							<tr>
								<th align='left'>Priority</th>
								<th align='left'>Ticket No</th>
								<th align='left'>Description</th>
								<th align='left'>Department</th>
								<th align='left'>Complaint-Date</th>
								<th align='left'>Status</th>
								<th align='left'>Action</th>
								<th align='left'>Assigned To</th>
							</tr>
						</thead>
						<?php
						$_GET['total_pages'] = ceil(mysqli_num_rows($ComplaintsAll)/$Limit);
						$Complaint_All = Select_All_Tickets_ByStatusId_ByLimit($Start, $Limit);
						while($Complaint_All_Ticket = mysqli_fetch_array($Complaint_All))
						{
							$Priority = mysqli_fetch_array(Complaint_Get_Priority($Complaint_All_Ticket['priorityid']));
							$Department = mysqli_fetch_array(Complaint_Get_Department($Complaint_All_Ticket['departmentid']));
							$Status = mysqli_fetch_array(Complaint_Get_Status($Complaint_All_Ticket['statusid']));
							$AssignedTo = mysqli_fetch_array(Complaint_Get_Assigned($Complaint_All_Ticket['assignedto']));
							echo '<tr><td style="width:10px" align="left">'.$Priority['name'].'</td>
							<td style="width:150px" align="left"><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$Complaint_All_Ticket['ticketno'].'&ComplaintId='.$Complaint_All_Ticket['id'].'">'.$Complaint_All_Ticket['ticketno'].'</a></td>
							<td style="width:250px" >'.$Complaint_All_Ticket['description'].'</td>
							<td align="left">'.$Department['name'].'</td>
							<td align="left" style="width:150px">'.$Complaint_All_Ticket['createdat'].'</td>
							<td align="left">'.$Status['name'].'</td><td align="left">';
							if($Complaint_All_Ticket['statusid'] == 5)
								echo '<a href="?page=Close_Complaint&TicketNo='.$Complaint_All_Ticket['ticketno'].'&ComplaintId='.$Complaint_All_Ticket['id'].'">Close</a>';
							echo '<td align="left">'.$AssignedTo['firstname'].'</td><td align="left">
							</td></tr>';
						} ?>
					</table>
					<?php
					if($_GET["Initial"])
						PaginationFor("AllTickets",1, $_GET['total_pages']);
				echo "</div>";
			}
		}
	} ?>
	<script>
		total_pages = <?php echo $_GET['total_pages']; ?>;
	</script>