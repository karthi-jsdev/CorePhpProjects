<?php
	if(isset($_GET['StatusId']))
		$_SESSION['StatusId'] = $_GET['StatusId'];
	else if($_SESSION['StatusId'])
		$_GET['StatusId'] = $_SESSION['StatusId'];
	else
		$_SESSION['StatusId'] = 8;
	if(isset($_GET['AssignedStatusId']))
		$_SESSION['AssignedStatusId'] = $_GET['AssignedStatusId'];
	else if($_SESSION['AssignedStatusId'])
		$_GET['AssignedStatusId'] = $_SESSION['AssignedStatusId'];
	else
		$_SESSION['AssignedStatusId'] = 8;
	if(isset($_GET['StatusAll']))
		$_SESSION['StatusAll'] = $_GET['StatusAll'];
	else if($_SESSION['StatusAll'])
		$_GET['StatusAll'] = $_SESSION['StatusAll'];
	else	
		$_SESSION['StatusAll'] = 8;
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
	$Limit = 10;
	if($_GET['pageno'])
		$Start = ($_GET['pageno']-1)*$Limit;
	else
		$Start = 0;
	$Fetch_User = mysqli_fetch_array(Complaint_Fetch_User($_SESSION['id']));
	$Complaint_Fetch_User = mysqli_fetch_array(Complaint_Users_Fetch($Fetch_User['userroleid']));
	$Bold = array("", array("<b>","</b>"));
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
					$Complaint_Created = mysqli_fetch_array(Count_Created_Tickets());
					$Complaint_Created_Unresolved =mysqli_fetch_array(Count_Created_Unresolved_Tickets());
					if($_SESSION['StatusId']== 8)
						$Selected = "<b>Unresolved</b>";
					else
						$Selected = "Unresolved";
					echo '<td style="width:200px"><a href="?page='.$_GET['page'].'&StatusId=8">'.$Selected.'('.$Complaint_Created_Unresolved['total'].')</a></td>';
					
					if(!$_SESSION['StatusId'])
						echo '<td style="width:200px"><a href="?page='.$_GET['page'].'&StatusId=0"><b>All</b>('.$Complaint_Created['total'].')</a></td>';
					else
						echo '<td style="width:200px"><a href="?page='.$_GET['page'].'&StatusId=0">All('.$Complaint_Created['total'].')</a></td>';
					while($Statuses = mysqli_fetch_array($All_Status))
					{
						if($_GET['StatusId'] == $Statuses['id'])
							echo '<td style="width:200px"><a href="?page='.$_GET['page'].'&StatusId='.$Statuses['id'].'"><b>'.$Statuses['name'].'</b>('.mysqli_num_rows(Complaint_Count_Status($Statuses['id'])).')</a></td>';
						else
							echo '<td style="width:200px"><a href="?page='.$_GET['page'].'&StatusId='.$Statuses['id'].'">'.$Statuses['name'].'('.mysqli_num_rows(Complaint_Count_Status($Statuses['id'])).')</a></td>';
					} ?>
				</tr>
			</table>
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th align='left'>Priority</th>
						<th align='left'>Ticket No</th>
						<th align='left'>Description</th>
						<th align='left'>Department</th>
						<th align='left'>Sub-Department</th>
						<th align='left'>Complaint-Date</th>
						<th align='left'>Status</th>
						<th align='left'>Action</th>
					</tr>
				</thead>
				<?php
				$Complaint_Complaints_My_Ticket = Select_Created_Tickets_ByStatusId_ByLimit($Start, $Limit);
				$TotalRows = mysqli_fetch_array(CountAll_Created_Tickets_ByStatusId());
				$_GET['total_pages'] = ceil($TotalRows['total']/$Limit);
				while($Complaint_My_Ticket = mysqli_fetch_array($Complaint_Complaints_My_Ticket))
				{
					$Priority = mysqli_fetch_array(Complaint_Get_Priority($Complaint_My_Ticket['priorityid']));
					$Department = mysqli_fetch_array(Complaint_Get_Department($Complaint_My_Ticket['departmentid']));
					$Status = mysqli_fetch_array(Complaint_Get_Status($Complaint_My_Ticket['statusid']));
					$SubGroup = mysqli_fetch_array(Complaint_Select_SubgroupForComplainttype($Complaint_My_Ticket['subgroupid']));
					echo '<tr>
					<td style="width:10px" align="left">'.$Bold[$Complaint_My_Ticket['statusid']][0].$Priority['name'].$Bold[$Complaint_My_Ticket['statusid']][1].'</td>
					<td style="width:150px" align="left"><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$Complaint_My_Ticket['ticketno'].'&ComplaintId='.$Complaint_My_Ticket['id'].'">'.$Bold[$Complaint_My_Ticket['statusid']][0].$Complaint_My_Ticket['ticketno'].$Bold[$Complaint_My_Ticket['statusid']][1].'</a></td>
					<td style="width:250px" >'.$Bold[$Complaint_My_Ticket['statusid']][0].$Complaint_My_Ticket['description'].$Bold[$Complaint_My_Ticket['statusid']][1].'</td>
					<td align="left">'.$Bold[$Complaint_My_Ticket['statusid']][0].$Department['name'].$Bold[$Complaint_My_Ticket['statusid']][1].'</td>
					<td align="left">'.$Bold[$Complaint_My_Ticket['statusid']][0].$SubGroup['name'].$Bold[$Complaint_My_Ticket['statusid']][1].'</td>
					<td align="left" style="width:150px">'.$Bold[$Complaint_My_Ticket['statusid']][0].$Complaint_My_Ticket['createdat'].$Bold[$Complaint_My_Ticket['statusid']][1].'</td>
					<td align="left">'.$Bold[$Complaint_My_Ticket['statusid']][0].$Status['name'].$Bold[$Complaint_My_Ticket['statusid']][1].'</td><td align="left">';
					if(($Complaint_My_Ticket['statusid'] == 5))
						echo '<a href="?page=Close_Complaint&TicketNo='.$Complaint_My_Ticket['ticketno'].'&ComplaintId='.$Complaint_My_Ticket['id'].'">Close</a>';
					else
						echo "&nbsp;&nbsp;-";
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
				<br />
				<center><strong>Assigned Tickets</strong></center>
				<br />
				<table>
					<tr>
						<td style="width:750px"></td>
						<?php
						$All_Status = Complaint_Status();
						$Complaint_Assigned = mysqli_fetch_array(Count_Assigned_Tickets());
						$Complaint_Assigned_Unresolved =mysqli_fetch_array(Count_Assigned_Unresolved_Tickets());
						if($_SESSION['AssignedStatusId']==8)
							$Selected = "<b>Unresolved</b>";
						else
							$Selected = "Unresolved";
						echo '<td style="width:200px"><a href="?page='.$_GET['page'].'&AssignedStatusId=8">'.$Selected.'('.$Complaint_Assigned_Unresolved['total'].')</a></td>';
						if(!$_SESSION['AssignedStatusId'])
							echo '<td style="width:200px"><a href="?page='.$_GET['page'].'&AssignedStatusId=0"><b>All</b>('.$Complaint_Assigned['total'].')</a></td>';
						else
							echo '<td style="width:200px"><a href="?page='.$_GET['page'].'&AssignedStatusId=0">All('.$Complaint_Assigned['total'].')</a></td>';
							
						while($Statuses = mysqli_fetch_array($All_Status))
						{
							if($_GET['AssignedStatusId'] == $Statuses['id'])
								echo '<td style="width:200px"><a href="?page='.$_GET['page'].'&AssignedStatusId='.$Statuses['id'].'"><b>'.$Statuses['name'].'</b>('.mysqli_num_rows(Complaint_Count_Status_of_Assigned($Statuses['id'])).')</a></td>';
							else	
								echo '<td style="width:200px"><a href="?page='.$_GET['page'].'&AssignedStatusId='.$Statuses['id'].'">'.$Statuses['name'].'('.mysqli_num_rows(Complaint_Count_Status_of_Assigned($Statuses['id'])).')</a></td>';
						} ?>
					</tr>
				</table>
			
				<table class="paginate sortable full">
					<thead>
						<tr>
							<th align='left'>Priority</th>
							<th align='left'>Ticket No</th>
							<th align='left'>Description</th>
							<th align='left'>Department</th>
							<th align='left'>Sub-Department</th>
							<th align='left'>Complaint-Date</th>
							<th align='left'>Status</th>
							<th align='left'>Action</th>
						</tr>
					</thead>
					<?php
					$AssignedTotalrows =  mysqli_fetch_array(CountAll_Assigned_Tickets_ByStatusId());
					$_GET['total_pages'] = ceil(($AssignedTotalrows['total'])/$Limit);
					$Complaint_Assigned = Select_Assigned_Tickets_ByStatusId_ByLimit($Start, $Limit);
					while($Complaint_Assigned_Ticket = mysqli_fetch_array($Complaint_Assigned))
					{
						$Priority = mysqli_fetch_array(Complaint_Get_Priority($Complaint_Assigned_Ticket['priorityid']));
						$Department = mysqli_fetch_array(Complaint_Get_Department($Complaint_Assigned_Ticket['departmentid']));
						$Status = mysqli_fetch_array(Complaint_Get_Status($Complaint_Assigned_Ticket['statusid']));
						$SubGroup = mysqli_fetch_array(Complaint_Select_SubgroupForComplainttype($Complaint_Assigned_Ticket['subgroupid']));
						echo '<tr>
						<td style="width:10px" align="left">'.$Bold[$Complaint_Assigned_Ticket['statusid']][0].$Priority['name'].$Bold[$Complaint_Assigned_Ticket['statusid']][1].'</td>
						<td style="width:150px" align="left"><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$Complaint_Assigned_Ticket['ticketno'].'&ComplaintId='.$Complaint_Assigned_Ticket['id'].'">'.$Bold[$Complaint_Assigned_Ticket['statusid']][0].$Complaint_Assigned_Ticket['ticketno'].$Bold[$Complaint_Assigned_Ticket['statusid']][1].'</a></td>
						<td style="width:250px" >'.$Bold[$Complaint_Assigned_Ticket['statusid']][0].$Complaint_Assigned_Ticket['description'].$Bold[$Complaint_Assigned_Ticket['statusid']][1].'</td>
						<td align="left">'.$Bold[$Complaint_Assigned_Ticket['statusid']][0].$Department['name'].$Bold[$Complaint_Assigned_Ticket['statusid']][1].'</td>
						<td align="left">'.$Bold[$Complaint_Assigned_Ticket['statusid']][0].$SubGroup['name'].$Bold[$Complaint_Assigned_Ticket['statusid']][1].'</td>
						<td align="left" style="width:150px">'.$Bold[$Complaint_Assigned_Ticket['statusid']][0].$Complaint_Assigned_Ticket['createdat'].$Bold[$Complaint_Assigned_Ticket['statusid']][1].'</td>
						<td align="left">'.$Bold[$Complaint_Assigned_Ticket['statusid']][0].$Status['name'].$Bold[$Complaint_Assigned_Ticket['statusid']][1].'</td><td align="left">';
						if(($Complaint_Assigned_Ticket['statusid'] == 5))	
							echo '<a href="?page=Close_Complaint&TicketNo='.$Complaint_Assigned_Ticket['ticketno'].'&ComplaintId='.$Complaint_Assigned_Ticket['id'].'">Close</a>';
						else
							echo "&nbsp;&nbsp;-";
						echo '</td>
						</tr>';
					} ?>
				</table>
			<?php
			if($_GET["Initial"])
				PaginationFor("AssignedTickets", 1, $_GET['total_pages']);
			echo "</div>";
		}
		
		if($_SESSION['roleid'] == 1 || $_SESSION['roleid'] == 5 || $_SESSION['admin'])
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
							$Complaint_All_Tickets = mysqli_fetch_array(CountAll_All_Tickets());
							$Complaint_All_Unresolved =mysqli_fetch_array(UnresolvedAll_All_Tickets());
							if($_SESSION['StatusAll']==8)
								$selected = "<b>UnResolved</b>";
							else
								$selected = "UnResolved";
							echo '<td style="width:200px"><a href="?page='.$_GET['page'].'&StatusAll=8">'.$selected.'('.$Complaint_All_Unresolved['total'].')</a></td>';
							if(!$_SESSION['StatusAll'])
								echo '<td style="width:200px"><a href="?page='.$_GET['page'].'&StatusAll=0"><b>All</b>('.($Complaint_All_Tickets['total']).')</a></td>';
							else
								echo '<td style="width:200px"><a href="?page='.$_GET['page'].'&StatusAll=0">All('.$Complaint_All_Tickets['total'].')</a></td>';
							while($Statuses = mysqli_fetch_array($All_Status))
							{
								if($_GET['StatusAll'] == $Statuses['id'])
									echo '<td style="width:200px"><a href="?page='.$_GET['page'].'&StatusAll='.$Statuses['id'].'"><b>'.$Statuses['name'].'</b>('.mysqli_num_rows(Complaint_Count_Status_All($Statuses['id'])).')</a></td>';
								else	
									echo '<td style="width:200px"><a href="?page='.$_GET['page'].'&StatusAll='.$Statuses['id'].'">'.$Statuses['name'].'('.mysqli_num_rows(Complaint_Count_Status_All($Statuses['id'])).')</a></td>';
							} ?>
						</tr>
					</table>
					
					<table class="paginate sortable full">
						<thead>
							<tr>
								<th align='left'>Priority</th>
								<th align='left'>Ticket No</th>
								<th align='left'>Description</th>
								<th align='left'>Department</th>
								<th align='left'>Sub-Department</th>
								<th align='left'>Complaint-Date</th>
								<th align='left'>Status</th>
								<th align='left'>Action</th>
								<th align='left'>Assigned To</th>
							</tr>
						</thead>
						<?php
						$AllTicketTotalrows = mysqli_fetch_array(SelectAll_All_Tickets_ByStatusId());
						$_GET['total_pages'] = ceil(($AllTicketTotalrows['total'])/$Limit);
						$Complaint_All = Select_All_Tickets_ByStatusId_ByLimit($Start, $Limit);
						while($Complaint_All_Ticket = mysqli_fetch_array($Complaint_All))
						{
							$Priority = mysqli_fetch_array(Complaint_Get_Priority($Complaint_All_Ticket['priorityid']));
							$Department = mysqli_fetch_array(Complaint_Get_Department($Complaint_All_Ticket['departmentid']));
							$Status = mysqli_fetch_array(Complaint_Get_Status($Complaint_All_Ticket['statusid']));
							$AssignedTo = mysqli_fetch_array(Complaint_Get_Assigned($Complaint_All_Ticket['assignedto']));
							$SubGroup = mysqli_fetch_array(Complaint_Select_SubgroupForComplainttype($Complaint_All_Ticket['subgroupid']));
							echo '<tr><td style="width:10px" align="left">'.$Bold[$Complaint_All_Ticket['statusid']][0].$Priority['name'].$Bold[$Complaint_All_Ticket['statusid']][1].'</td>
							<td style="width:150px" align="left"><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$Complaint_All_Ticket['ticketno'].'&ComplaintId='.$Complaint_All_Ticket['id'].'">'.$Bold[$Complaint_All_Ticket['statusid']][0].$Complaint_All_Ticket['ticketno'].$Bold[$Complaint_All_Ticket['statusid']][1].'</a></td>
							<td style="width:250px" >'.$Bold[$Complaint_All_Ticket['statusid']][0].$Complaint_All_Ticket['description'].$Bold[$Complaint_All_Ticket['statusid']][1].'</td>
							<td align="left">'.$Bold[$Complaint_All_Ticket['statusid']][0].$Department['name'].$Bold[$Complaint_All_Ticket['statusid']][1].'</td>
							<td align="left">'.$Bold[$Complaint_All_Ticket['statusid']][0].$SubGroup['name'].$Bold[$Complaint_All_Ticket['statusid']][1].'</td>
							<td align="left" style="width:150px">'.$Bold[$Complaint_All_Ticket['statusid']][0].$Complaint_All_Ticket['createdat'].$Bold[$Complaint_All_Ticket['statusid']][1].'</td>
							<td align="left">'.$Bold[$Complaint_All_Ticket['statusid']][0].$Status['name'].$Bold[$Complaint_All_Ticket['statusid']][1].'</td><td align="left">';
							if($Complaint_All_Ticket['statusid'] == 5 && ($_SESSION['roleid']==1 || $_SESSION['roleid']==5))
								echo '<a href="?page=Close_Complaint&TicketNo='.$Complaint_All_Ticket['ticketno'].'&ComplaintId='.$Complaint_All_Ticket['id'].'">Close</a>';
							else
								echo "&nbsp;&nbsp;-";
							echo '<td align="left">'.$Bold[$Complaint_All_Ticket['statusid']][0].$AssignedTo['firstname'].$Bold[$Complaint_All_Ticket['statusid']][1].'</td><td align="left">
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
		total_pages = <?php if($_GET['total_pages']) echo $_GET['total_pages']; else echo 1; ?>;
	</script>