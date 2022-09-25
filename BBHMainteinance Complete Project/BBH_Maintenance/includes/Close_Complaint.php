<?php
	include("includes/Complaint_Status_Queries.php");
	include("includes/Close_Complaint_Queries.php");
	$Fetch_User = mysqli_fetch_array(Complaint_Fetch_User($_SESSION['id']));
	$Complaint_Fetch_User = mysqli_fetch_array(Complaint_Users_Fetch($Fetch_User['userroleid']));
	date_default_timezone_set("Asia/Kolkata"); 
	$Complaint = mysqli_fetch_array(Complaint_A_Ticket($_GET['TicketNo'])); 
	if($_POST['Update'])
	{
		$Remarks = ComplaintSelectRemarks($Complaint['id']);
		if($Remark = mysqli_fetch_array($Remarks))
			UpdateRemarks($_POST['complaintid'],$_POST['skill'],$_POST['standard'],$_POST['courtesy'],$_POST['timeliness'],$_SESSION['id']);
		else
			InsertRemarks($_POST['complaintid'],$_POST['skill'],$_POST['standard'],$_POST['courtesy'],$_POST['timeliness'],$_SESSION['id']);
		$RemarkTypes = ComplaintSelectRemarkTypes($_POST['complaintid']);
		$Remarks = array();
		while($RemarkType = mysqli_fetch_assoc($RemarkTypes))
			$Remarks[] = $RemarkType['name'];
		if($_POST['status']==7)	
			$_POST['comments'] .= " <b>Remarks :</b> Skill Of Staff:".$Remarks[$_POST['skill']-1].", Standard of Repair:".$Remarks[$_POST['standard']-1].", Courtesy:".$Remarks[$_POST['courtesy']-1].", Timeliness:".$Remarks[$_POST['timeliness']-1];
		InsertAudit($_POST['complaintid'],$_POST['comments'],$_POST['status'],$_POST['Complaint_Priorities'],$_POST['zone'],$_SESSION['id']);
		InsertPartDetails($_POST['complaintid'],$_POST['partname'],$_POST['Complaint_Parts'],$_POST['amount'],$_POST['bycash'],$_SESSION['id']);
		Complaint_Update_ById($_POST['complaintid'],$_POST['Complaint_Priorities'],$_POST['status'], $_SESSION['id']);
	}
	$SelectAudit = mysqli_fetch_array(Complaint_Comments($Complaint['id']));
	$SelectPartDetails = mysqli_fetch_array(Complaint_PartDetails($Complaint['id']));
	$ComplaintSelectGroup = mysqli_fetch_array(ComplaintGroup($Complaint['groupid']));
	$ComplaintRemarks = mysqli_fetch_array(ComplaintSelectRemarks($Complaint['id']));
	if($_GET['TicketNo'])
	{ ?>
	<form class="form panel">
	<header><h2>Ticket No: <font color='red'><?php echo $_GET['TicketNo']; ?></font></h2></header>
	<hr/>
	<fieldset>
		<div class="clearfix">
			<table>
				<tr>
					<td style="width:400px">
						<b>Complaint Source:</b>
						<?php 
						if($Source = mysqli_fetch_array(Complaint_Get_Source($Complaint['sourceid'])))
							echo "<font size='2'>".$Source['name']."</font>";
						?>
						<br />
						<br />
						<b>Defects:</b>
						<?php echo "<font size='2'>".$Complaint['description']."</font>"; ?>
					</td>
					<td style="width:400px;border-style:solid" >
						<b>Department:</b>
						<?php 
						if($Department = mysqli_fetch_array(Complaint_Get_Department($Complaint['departmentid'])))
							echo "<font size='2'>".$Department['name']."</font>";
						?>
						<br />
						<br />
						<b>Remarks:</b>
						<?php echo "<font size='2'>".$Complaint['remarks']."</font>"; ?>
					</td>
					<td>
						<table>
							<?php
							$Complaint_Priority = mysqli_fetch_array(Complaint_Get_Priority($Complaint['priorityid']));
							echo "<b>Priority :</b> ".$Complaint_Priority['name'];
							?>
						</table>
					</td>
				</tr>
			</table>
		</div>
		<br />
	<div class="clearfix">
		<table>
			<tr>
				<td style="width:150px">
					<b>Sub-Department:</b>
					<?php 
					$Subgroup = mysqli_fetch_array(Complaint_Select_Subgroup_ById($Complaint['departmentid']));
					echo $Subgroup['name']; ?>
				</td>
				<td style="width:150px">
					<b>Technician:</b>
					<?php 
					$User = mysqli_fetch_array(Complaint_Fetch_User($Complaint['assignedto']));
					echo $User['firstname'];
					?>
				</td>
				<td style="width:150px">
					<b>Zone: </b>
					<?php
					$Zone = mysqli_fetch_array(Complaint_Select_Zone_ById($Complaint[zoneid]));
					echo $Zone['name'];
					?>
				</td>
			</tr>
		</table>
		<br>
		<table>
			<tr>
				<td>
					<b>Parts Procured:</b>
					<?php
					if(!$SelectPartDetails['procuredfrom'])
						echo " No";
					else
						echo " Yes";
					?>
				</td>
				<td style="padding-left:15px;width:170px">
					<b>Parts Name: </b><?php echo $SelectPartDetails['partname'];?>
				</td>
				<td style="width:210px">
					<b>Procured From: </b>
					<?php
					$ProcuredFrom = mysqli_fetch_array(Complaint_Select_Store_ById($Complaint['id']));
					echo $ProcuredFrom['name'];
					?>
				</td>
				<td style="width:170px">
					<b>Amount: </b><?php echo $SelectPartDetails['amount'];?>
				</td>
				<td>
					<b>By Cash: </b>
					<?php
					if(!$SelectPartDetails['bycash'])
						echo 'No';
					else
						echo 'Yes';
					?>
				</td>
			</tr>
		</table>
	</form>
		
		<form method="post" action="" id="form1" class="form panel" name='form1'>
			<input type="hidden" name="complaintid" value="<?php echo $Complaint['id']; ?>" required="required"/>
			<input type="hidden" name="zone" value="<?php echo $Complaint['zoneid']; ?>" required="required"/>
			<input type="hidden" name="Complaint_Priorities" value="<?php echo $Complaint['priorityid']; ?>" required="required"/>
			<fieldset>
				<div class="clearfix">
					<label><b>Status:</b><font color="red">*</font></label>
					<select name="status" id="status" onchange="rating(this.value)">
						<?php
						$Status = Complaint_Select_RCStatus();
						while($Complaint_Statuses = mysqli_fetch_array($Status))
						{
							if(($Complaint['statusid'] == $Complaint_Statuses['id']) && $_POST['status'] == $Complaint['statusid'])
								echo '<option value="'.$Complaint_Statuses['id'].'" >'.$Complaint_Statuses['name'].'</option>';
							else
								echo '<option value="'.$Complaint_Statuses['id'].'" selected>'.$Complaint_Statuses['name'].'</option>';
						} ?>
					</select>
				</div>
				<div class="clearfix">
					<label><b>Comments:</b><font color="red">*</font></label>
					<textarea name="comments" cols="75" rows="4" id="comments"></textarea>
				</div>
				<div id='reopen'>
					<div class="clearfix">
						<label><b>Skill Of Staff:</b><font color="red">*</font></label>
						<?php
						$ComplaintRemarkTypes = ComplaintSelectRemarkTypes();
						$i = 1;
						while($RemarkType = mysqli_fetch_assoc($ComplaintRemarkTypes))
						{
							if($RemarkType[id] == $ComplaintRemarks['skill'])
								echo '<span class="radio-input" style="padding-left:15px;"><input type="radio" id="skill" name="skill" value="'.$RemarkType['id'].'" checked>'.$RemarkType['name'].'</input></span>';
							else
								echo '<span class="radio-input" style="padding-left:15px;"><input type="radio" id="skill" name="skill" value="'.$RemarkType['id'].'">'.$RemarkType['name'].'</input></span>';
						} ?>
					</div>
					<div class="clearfix">	
						<label><b>Standard of Repair:</b><font color="red">*</font></label>
						<?php
						$ComplaintRemarkTypes = ComplaintSelectRemarkTypes();
						while($RemarkType = mysqli_fetch_assoc($ComplaintRemarkTypes))
						{
							if($RemarkType[id] == $ComplaintRemarks['standard'])
								echo '<span class="radio-input" style="padding-left:15px;"><input type="radio" name="standard" id="standard" value="'.$RemarkType['id'].'" checked>'.$RemarkType['name'].'</input></span>';
							else
								echo '<span class="radio-input" style="padding-left:15px;"><input type="radio" name="standard"  id="standard" value="'.$RemarkType['id'].'">'.$RemarkType['name'].'</input></span>';
						} ?>
					</div>
					<div class="clearfix">	
						<label><b>Courtesy:</b><font color="red">*</font></label>
						<?php
						$ComplaintRemarkTypes = ComplaintSelectRemarkTypes();
						while($RemarkType = mysqli_fetch_assoc($ComplaintRemarkTypes))
						{
							if($RemarkType[id] == $ComplaintRemarks['courtesy'])
								echo '<span class="radio-input" style="padding-left:15px;"><input type="radio" name="courtesy" id="courtesy" value="'.$RemarkType['id'].'" checked>'.$RemarkType['name'].'</input></span>';
							else
								echo '<span class="radio-input" style="padding-left:15px;"><input type="radio" name="courtesy" id="courtesy" value="'.$RemarkType['id'].'">'.$RemarkType['name'].'</input></span>';
						} ?>
					</div>
					<div class="clearfix">	
						<label><b>Timeliness:</b><font color="red">*</font></label>
						<?php
						$ComplaintRemarkTypes = ComplaintSelectRemarkTypes();
						while($RemarkType = mysqli_fetch_assoc($ComplaintRemarkTypes))
						{
							if($RemarkType[id] == $ComplaintRemarks['timeliness'])
								echo '<span class="radio-input" style="padding-left:15px;"><input type="radio" name="timeliness" id="timeliness" value="'.$RemarkType['id'].'" checked>'.$RemarkType['name'].'</input></span>';
							else
								echo '<span class="radio-input" style="padding-left:15px;"><input type="radio" name="timeliness" id="timeliness" value="'.$RemarkType['id'].'">'.$RemarkType['name'].'</input></span>';
						} ?>
					</div>
				</div>		
						<hr />
						<button class="button button-green" type="submit" name="Update" value="Update" onclick="return validation()">Update</button>&nbsp;&nbsp;
						<button class="button button-gray" type="reset">Reset</button>
			</fieldset>
		</form>
	</div>

<table class="paginate sortable full">
	<thead>
		<tr>
			<th width="500px">Comments</th>
			<th>Status</th>
			<th>Date</th>
			<th>Updated-By</th>
		</tr>
	</thead>
	<?php
	$CommentsSelect = Complaint_Comments($Complaint['id']);
	while($FetchComments = mysqli_fetch_array($CommentsSelect))
	{
		$Status = mysqli_fetch_array(Complaint_Get_Status($FetchComments['statusid']));
		$Complaint_Fetch_User_Name = mysqli_fetch_array(Complaint_Fetch_User($FetchComments['addedby']));
		echo "<tr>
				<td>".$FetchComments['comments']."</td>
				<td align='center'>".$Status['name']."</td>
				<td align='center'>".$FetchComments['addedat']."</td>
				<td align='center'>".$Complaint_Fetch_User_Name['firstname']."</td>
			</tr>";
		$AllRemarks = "";
	} ?>
</table>
<br />
<script>
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode == 46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return NumberCount();
	}
	function rating(status)
	{
		if(status == 7)
			document.getElementById("reopen").style.display = "block";
		else
			document.getElementById("reopen").style.display = "none";
	}
	function validation()
	{
		var message = "";
		if(document.getElementById('status').value == 7)
		{
			if(document.getElementById('comments').value == "")
			message = "Please enter comments";
			if(document.getElementById('comments').value.length < 10 || document.getElementById('comments').value.length > 500)
			message = "Comments shoud be within 10 to 500 characters";
			
			 /*var elements = document.getElementsByName("skill");
			for(var i=0, len=elements.length; i<len; ++i)
				if(elements[i].checked)
					alert(elements[i].value);
			*/
			var timeliness = document.getElementsByName("timeliness");
			var courtesy = document.getElementsByName("courtesy");
			var standard = document.getElementsByName("standard");
			var skill = document.getElementsByName("skill");
			var i = 0, checked1="", checked2="", checked3="", checked4="";
			while(i < 6)
			{
				if(timeliness[i].checked)
					checked1 = timeliness[i].value;
				
				if(courtesy[i].checked)
					checked2 = courtesy[i].value;
				if(standard[i].checked)
					checked3 = standard[i].value;
				if(skill[i].checked)
					checked4 = skill[i].value;
				i++;        
			}
			if(!checked1)
				message = "Please select Timeliness";
			if(!checked2)
				message = "Please select Courtesy";
			if(!checked3)
				message = "Please select Standard Of Repair";
			if(!checked4)
				message = "Please select Skill Of Staff";	  
		}
		if(document.getElementById('comments').value == "")
			message = "Please enter comments";
		if(document.getElementById('comments').value.length < 10 || document.getElementById('comments').value.length > 500)
			message = "Comments shoud be within 10 to 500 characters";
		
		/*if(Parts_Procured_Mandatory)	
		{
			if(document.getElementById('amount').value == "")
				message = "Please enter amount";
		}*/
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>
<?php
}
else 
{ ?>
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
		$TicketnumberRows = Ticketnumber_Close_Byticket();
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
	{?> 
	<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel">
		<center><strong>My Ticket</strong></center>
		<table class="paginate sortable full">
			<thead>
				<tr>
					<th>Priority</th>
					<th>Ticket No</th>
					<th>Description</th>
					<th>Department</th>
					<th>Complaint-Date</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<?php
			$Limit = 10;
			if(!$_GET['pageno'])
				$_GET['pageno'] = 1;
			$i = $Start = ($_GET['pageno']-1)*$Limit;
			if($_SESSION['roleid'] == 1 || $_SESSION['roleid'] == 5)
			{
				$TotalStatus_Tickets = mysqli_num_rows(Close_Complaint_Select_AllResolvedTickets());
				$Status_Tickets = Close_Complaint_Select_AllResolvedTickets_ByLimit($Start, $Limit);
			}
			else
			{
				$TotalStatus_Tickets = mysqli_num_rows(Close_Complaint_Select_ResolvedTickets_BySessionId());
				$Status_Tickets = Close_Complaint_Select_ResolvedTickets_BySessionId_ByLimit($Start, $Limit);
			}
			$total_pages = ceil($TotalStatus_Tickets / $Limit);
			if(!$TotalStatus_Tickets)
				echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
			$i++;
			while($Status_Ticket = mysqli_fetch_array($Status_Tickets))
			{
				$Priority = mysqli_fetch_array(Complaint_Get_Priority($Status_Ticket['priorityid']));
				$Department = mysqli_fetch_array(Complaint_Get_Department($Status_Ticket['departmentid']));
				$Status = mysqli_fetch_array(Complaint_Get_Status($Status_Ticket['statusid']));
				echo '<tr><td style="width:10px" align="center">'.$Priority['name'].'</td>
				<td style="width:150px" align="center"><a href="?page='.$_GET['page'].'&TicketNo='.$Status_Ticket['ticketno'].'&ComplaintId='.$Status_Ticket['id'].'">'.$Status_Ticket['ticketno'].'</a></td>
				<td style="width:250px" >'.$Status_Ticket['description'].'</td>
				<td align="center">'.$Department['name'].'</td>
				<td align="center" style="width:150px">'.$Status_Ticket['createdat'].'</td>
				<td align="center">'.$Status['name'].'</td><td align="center">';
				if($Status_Ticket['createdby'] == $_SESSION['id'] || $_SESSION['roleid'] == 1 || $_SESSION['roleid'] == 5)
					echo '<a href="?page='.$_GET['page'].'&TicketNo='.$Status_Ticket['ticketno'].'&ComplaintId='.$Status_Ticket['id'].'">Close</a>';
				echo '</td></tr>';
			} ?>
		</table>
	</form>
	<?php
	}
	}
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>