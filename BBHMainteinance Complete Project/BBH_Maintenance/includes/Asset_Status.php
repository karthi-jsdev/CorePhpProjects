<head>
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
		<script src="js/datepicker/jquery.ui.core.js"></script>
		<script src="js/datepicker/jquery.ui.widget.js"></script>
		<script src="js/datepicker/jquery.ui.datepicker.js"></script>
		<script> 
			$(function() {
				$("#date").datepicker({dateFormat: 'dd-mm-yy' });
			});
		</script> 
</head>
<?php
	include("includes/Assets_Queries.php");
	if(isset($_POST['Submit']))
	{		
		Assets_Status_Insert($_POST['id'],$_POST['description'],$_POST['statusid']);			
	}
	if($_GET['id'])
	{
?>
<section class="grid_6 first">
	<form id="form" class="form panel" method="POST" onsubmit="return validation()">
		<header><h2>Asset Status</h2></header>
		<hr />
		<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
		<fieldset>
			<div class="clearfix">
				<label>Asset Updates<font color="red">*</font></label>
			<textarea rows="4" cols="50" id='description' name='description'></textarea>
			</div>		
		</fieldset>
		<fieldset>
			<div class="clearfix">
				<label>Status<font color="red">*</font></label>
				<select  id='statusid' name='statusid'>
					<option value=''>Select</option>
					<?php 		
					$Status_Select = Complaint_Get_Status();
					while($Status = mysqli_fetch_array($Status_Select))
					{
						echo '<option value="'.$Status['id'].'">'.$Status['name'].'</option>';
					} ?>
				</select>
			</div>		
		</fieldset>
		<hr />
		<button class="button button-green" type="submit" name="Submit">Submit</button>
		<a href='?page=<?php echo $_GET['page']; ?>' class="button button-orange" type="submit">Cancel</a>
		<button class="button button-gray" name ="reset" type="reset" >Reset</button>	
	</form>
	<?php
			$AssetComplaint = Asset_Select_All_Complaint($_GET['id']);
				if(mysqli_num_rows($AssetComplaint))	
				{
			?>	
				<table class="paginate sortable full">
					<thead>
						<tr>
							<th align="left">Ticket No</th>
							<th align="left">Defects</th>
							<th align="left">Date</th>
						</tr>
					</thead>
					<?php
						while ($AssetComplaintName = mysqli_fetch_array($AssetComplaint))
						{
							echo "<tr><td style='color:red;'><a style='text-decoration:underline;' href='?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo=".$AssetComplaintName['ticketno']."&ComplaintId=".$AssetComplaintName['id']."'>".$AssetComplaintName['ticketno']."</a></td>
							<td>".$AssetComplaintName['description']."</td>
							<td>".$AssetComplaintName['createdat']."</td></tr>";
						}
					?>			
				</table>	
			<?php
				}
			?>
	<div class="columns leading">
		<div class="grid_6 first">
			<h3>Assets List
			<?php
			$AssetsTotalRows = mysqli_num_rows(Assets_Status_Select_ById($_GET['id']));
			echo " : No. of total Asset Status - ".$AssetsTotalRows;
			?>
			</h3>
			<hr />
				<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">Description </th>
						<th align="left">Status </th>
						<th align="left">Date </th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$AssetsTotalRows)
						echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($AssetsTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$Assets_Status_Description = Assets_Status_Select_ById($_GET['id']);
					while($Asset_Status = mysqli_fetch_assoc($Assets_Status_Description))
					{
						echo "<tr>
							<td align='center'>".$i++."</td>";
							echo "<td>".$Asset_Status['assetdescription']."</td>";
							$Status = mysqli_fetch_assoc(Complaint_Get_Status_Select_ById($Asset_Status['statusid']));
							echo "<td>".$Status['name']."</td>
							<td>".$Asset_Status['datetime']."</td>
						</tr>";
					} ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="clear">&nbsp;</div>
</section>
<?php
}
else
{ ?>
<section class="grid_6 first">
	<div class="columns leading">
		<div class="grid_6 first">
		<br/>	
		<div class="form panel">
		<hr>
			<form action='' method='POST'>
				<table>
					<tr>
					<td style="padding-right:10px">Item Name:</td>
						<td style="padding-right:10px"> 
							<input type='text' name='ItemName' value='<?php echo $_POST['ItemName'];?>' />
						</td>
						<td><button class="button button-green" type="submit">Search</button></td>
					</tr>
				</table>
			</form>
		<hr>
		</div>	
		<table class="paginate sortable full">				
			<thead>
				<tr>
					<th width="70px" align="center">S.NO.</th>
					<th align="left">Asset Item</th>
					<th align="left">Division Name</th>
					<th align="left">Department Name</th>
					<th align="left">Location Name</th>
					<th align="left">Item Name</th>
					<th align="left">Item Description</th>
					<th align="left">Connection Type</th>
					<th align="left">Purchased Date</th>
					<th align="left">Warranty Date</th>
					<th align="left">Amc Period</th>
					<th align="left">Condemned</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$AssetsTotalRows = mysqli_num_rows(Assets_Status_Select_ByName($_POST['ItemName']));
				if(!$AssetsTotalRows)
					echo '<tr><td colspan="13"><font color="red"><center>No data found</center></font></td></tr>';
				$Limit = 10;
				$total_pages = ceil($AssetsTotalRows / $Limit);
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1;
				
				$i = $Start = ($_GET['pageno']-1)*$Limit;
				$i++;
				$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
				if($_POST['ItemName'])
					$AssetsRows = Assets_Status_Select_ByItemName($_POST['ItemName'],$Start, $Limit);
				else
					$AssetsRows = Assets_Select_ByLimit($Start, $Limit);
				while($Assets = mysqli_fetch_assoc($AssetsRows))
				{
					echo "<tr>
					<td align='center'>".$i++."</td>";
					$Asset_Name = mysqli_fetch_array(Asset_Division_BYId($Assets['divisionid']));
					$Assets_Department = mysqli_fetch_array(Assets_DepartmentById($Assets['departmentid']));
					$Assets_Location = mysqli_fetch_array(Assets_LocationById($Assets['locationid']));
					$Assets_item = mysqli_fetch_array(Assets_itemById($Assets['itemid']));
					echo"<td><a href='?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Assets['id']."'>".$Assets['itemname']."</a></td>
					<td>".$Asset_Name['name']."</td>
					<td>".$Assets_Department['name']."</td>
					<td>".$Assets_Location['name']."</td>
					<td>".$Assets_item['name']."</td>
					<td>".$Assets['itemdescription']."</td>";
					if($Assets['connectiontype']=='1')
						echo "<td>Yes</td>";
					else
						echo "<td>No</td>";	
					echo "<td>".$Assets['purchasedat']."</td>
					<td>".$Assets['warrantydate']."</td>
					<td>".$Assets['amcperiod']."</td>";
					 if($Assets['condemned']=='1')
						echo "<td>Yes</td>";
					else
						echo "<td>No</td>";
					echo "</tr>";
				} ?>
			</tbody>
		</table>
		<?php
			$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
			if($total_pages > 1)
			include("includes/Pagination.php");
		?>
		</div>
	</div>	
</section>
<?php
} ?>
<script>
	function validation()
	{
		var message = "";
		if(document.getElementById("statusid").value=='')
			message = "Select the status";
		if(document.getElementById("description").value.length == 0)
			message = "Please Enter Description";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>