<div class="form panel">
	<form action='' method='POST'>
		<table>
			<tr>
			<td style="padding-right:10px">Ticket Number:</td>
				<td style="padding-right:10px"> 
					<input type='text' name='ticketnos' value='<?php echo $_POST['ticketnos'];?>' />
				</td>
				<td><button class="button button-green" type="submit">Search</button></td>
			</tr>
		</table>
	</form>
</div>
	<?php
	if($_POST['ticketnos'])
	{
		include("Complaint_Status_Queries.php");
		?>
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
		$TicketnumberRows = Ticketnumber_Select_Byticket();
		if(mysqli_num_rows($TicketnumberRows))
		{
			while($Ticketnumber_My_Ticket = mysqli_fetch_array($TicketnumberRows))
			{
				$Priority = mysqli_fetch_array(Complaint_Get_Priority($Ticketnumber_My_Ticket['priorityid']));
				$Department = mysqli_fetch_array(Complaint_Get_Department($Ticketnumber_My_Ticket['departmentid']));
				$Status = mysqli_fetch_array(Complaint_Get_Status($Ticketnumber_My_Ticket['statusid']));
				echo '<tr>
				<td style="width:10px" align="left">'.$Priority['name'].'</td>
				<td style="width:150px" align="left"><a href="?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo='.$Ticketnumber_My_Ticket['ticketno'].'&ComplaintId='.$Ticketnumber_My_Ticket['id'].'">'.$Ticketnumber_My_Ticket['ticketno'].'</a></td>
				<td style="width:250px" >'.$Ticketnumber_My_Ticket['description'].'</td>
				<td align="left">'.$Department['name'].'</td>
				<td align="left" style="width:150px">'.$Ticketnumber_My_Ticket['createdat'].'</td>
				<td align="left">'.$Status['name'].'</td><td align="left">';
				if(($Ticketnumber_My_Ticket['statusid'] == 5))
					echo '<a href="?page=Close_Complaint&TicketNo='.$Ticketnumber_My_Ticket['ticketno'].'&ComplaintId='.$Ticketnumber_My_Ticket['id'].'">Close</a>';
				else
					echo "&nbsp;&nbsp;-";
				echo '</td>
				</tr>';
			}
		}
		else
		{
		echo "<tr><td colspan='7'><center><font color='red'>No data found</font></center></td></tr>";
		}
		?>
		</table>		
		<?php
	} 
	else
	{ ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel">
			<?php
			$_GET['Initial'] = 1;
			include("includes/Dashboard_Table.php");
			?>
		</form>

		<script>
			var CreatedTickets=0, AssignedTickets=0, AllTickets=0; 
			function Ajax_Pagination(PaginationFor, CurrentPageNo)
			{
				if(PaginationFor == "CreatedTickets")
					CreatedTickets = 10;
				else if(PaginationFor == "AssignedTickets")
					AssignedTickets = 10;
				else if(PaginationFor == "AllTickets")
					AllTickets = 10;
				GetData(PaginationFor, CurrentPageNo);
			}
			
			function GetData(PaginationFor, CurrentPageNo)
			{
				var xmlhttp;
				if(window.XMLHttpRequest)
					xmlhttp = new XMLHttpRequest();
				else
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				xmlhttp.onreadystatechange=function()
				{
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
						document.getElementById(PaginationFor).innerHTML = xmlhttp.responseText;
				}
				xmlhttp.open("GET","includes/Ajax_Pagination.php?page=<?php echo $_GET['page'];?>&pageno="+CurrentPageNo+"&total_pages="+total_pages+"&PaginationFor="+PaginationFor+"&StatusId=<?php echo $_GET['StatusId'];?>&AssignedStatusId=<?php echo $_GET['AssignedStatusId'];?>&StatusAll=<?php echo $_GET['StatusAll'];?>", true);
				xmlhttp.send();
			}
			
			setTimeout(function(){Refreshfunction();}, 5000);
			function Refreshfunction()
			{
				AssignedTickets--;CreatedTickets--;AllTickets--;
				if(CreatedTickets <= 0)
					GetData("CreatedTickets", 1);
				if(AssignedTickets <= 0)
					GetData("AssignedTickets", 1);
				if(AllTickets <= 0)
					GetData("AllTickets", 1);
				setTimeout(function(){Refreshfunction();}, 10000);
			}
		</script>
	<?php
	} ?>