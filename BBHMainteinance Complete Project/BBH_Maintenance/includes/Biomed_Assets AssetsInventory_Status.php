
<HEAD>
  <TITLE> Timepicker Addon</TITLE>
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="">
  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="">
  <link rel="stylesheet" media="all" type="text/css" href="css/jquery-ui-1.8.16.custom.css" />
  <link rel="stylesheet"  type="text/css" href="css/datetimepicker.css" />
  
<style type="text/css">

</style>
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#date').datetimepicker({ showSecond: true,dateFormat: 'yy-mm-dd',timeFormat: 'hh:mm:ss',changeMonth: true,changeYear: true});
});
</script>
 </HEAD>
<?php
	if(isset($_POST['Submit']))
	{		
		AssetsInventory_Status_Insert();			
	}
if($_GET['id'])
	{
?>
<section class="grid_6 first">
	<form id="form" class="form panel" method="POST" onsubmit="return validation()">
		<header><h2>AssetInventory Status</h2></header>
		<hr />
		<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
		<fieldset>
			<div class="clearfix">
			<label>Date Of Inspection<font color="red">*</font></label>
			<input type="text" name="date" id="date" value=""/>
			</div>		
		</fieldset>
		<fieldset>
			<div class="clearfix">
				<label>Inspected By<font color="red">*</font></label>
				<select  id='inspectby' name='inspectby'>
					<option value=''>Select</option>
					<?php 		
					$Status_User = Complaint_Get_Inspect();
					while($Status = mysqli_fetch_array($Status_User))
					{
						echo '<option value="'.$Status['id'].'">'.$Status['firstname'].'</option>';
					} ?>
				</select>
			</div>		
		</fieldset>
		<fieldset>
			<div class="clearfix">
				<label>Fault<font color="red">*</font></label>
				<textarea  cols="40" rows="1" name="fault"  id="fault"></textarea>
			</div>		
		</fieldset>
		<fieldset>
			<div class="clearfix">
				<label>Cost Involved<font color="red">*</font></label>
				<input type="text" name="costinvolved" id="costinvolved" value="" onkeypress="return isNumeric(event)" />
			</div>		
		</fieldset>
		<fieldset>
			<div class="clearfix">
				<label>Remark<font color="red">*</font></label>
				<textarea  cols="40" rows="1" name="remark"  id="remark"></textarea>
			</div>		
		</fieldset>
		<hr />
		<button class="button button-green" type="submit" name="Submit">Submit</button>
		<a href='?page=<?php echo $_GET['page']; ?>' class="button button-orange" type="submit">Cancel</a>
	</form>	
	<?php
			/*$AssetBioComplaint = AssetBiomedical_Select_All_Complaint($_GET['id']);
				if(mysqli_num_rows($AssetBioComplaint))	
				{
			?>	
				<table class="paginate sortable full">
					<thead>
						<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">Date Of Inspection </th>
						<th align="left">Inspected By </th>
						<th align="left">Fault </th>
						<th align="left">Cost Involved </th>
						<th align="left">Remark </th>
						</tr>
					</thead>
					<?php
					$i=0;
						while ($AssetComplaintName = mysqli_fetch_array($AssetBioComplaint))
						{
							$Updatedname = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM user where id='".$AssetComplaintName['updatedby']."'"));
							$Amount = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT sum(amount) as amount FROM partdetails where complaintid='".$AssetComplaintName['id']."' group by complaintid"));
							echo "<tr><td>".++$i."</td>";
							//echo $AssetComplaintName['bio_startdate'].'<br>';
							if($AssetComplaintName['bio_startdate'] != "0000-00-00 00:00:00")
								echo "<td>".date('d-m-Y H:i:s', strtotime($AssetComplaintName['bio_startdate']))."-".date('d-m-Y H:i:s', strtotime($AssetComplaintName['bio_enddate']))."</td>";
							else
								echo "<td>-</td>";
							echo "<td>".$Updatedname['firstname']."</td>
							<td style='color:red;'><a style='text-decoration:underline;' href='?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo=".$AssetComplaintName['ticketno']."&ComplaintId=".$AssetComplaintName['id']."'>".$AssetComplaintName['ticketno']."</a>".$AssetComplaintName['bio_remark']."</td>
							<td>".$Amount['amount']."</td>
							<td>".$AssetComplaintName['description']."</td></tr>";
						}
					?>			
				</table>	
			<?php
				}*/
			?>
	<div class="columns leading">
		<div class="grid_6 first">
			<h3>AssetsInventory Status List
			<?php
			$AssetsTotalRows = mysqli_num_rows(AssetsInventory_Status_Select_ById());
			echo " : No. of total Asset Status - ".$AssetsTotalRows."<br /><br />";
			$Equipment = mysqli_fetch_array(AssetsInventoryEquipment());
			echo "Equipment Name - ".$Equipment['equipment'];
			?>
			</h3>
			<hr />
				<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">Date Of Inspection </th>
						<th align="left">Inspected By </th>
						<th align="left">EquipmentRemark/Complaint </th>
						<th align="left">Fault </th>
						<th align="left">Cost Involved </th>
						<th align="left">Remark </th>
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
					$Assets_Status_Description = AssetsInventory_Status_Select_ById($_GET['equipmentid']);
					while($Asset_Status = mysqli_fetch_assoc($Assets_Status_Description))
					{
						echo "<tr>
							<td align='center'>".$i++."</td>";
							echo "<td>".$Asset_Status['date']."</td>";
							$InspectBy = mysqli_fetch_assoc(Inspect_ById($Asset_Status['inspectby']));
							$TicketLink = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT * FROM complaint where id='".$Asset_Status['complaintid']."' AND groupid='3' "));
							echo "<td>".$InspectBy['firstname']."</td>";
							if($TicketLink['ticketno'])
								echo "<td style='color:red;'><a style='text-decoration:underline;' href='?page=Complaint_Status&subpage=Complaint_Status_Of_Ticket&TicketNo=".$TicketLink['ticketno']."&ComplaintId=".$TicketLink['id']."'> ".$TicketLink['remarks']."   /   ".$TicketLink['ticketno']."</a></td>";
							else
								echo "<td align='center'>-</td>";
							echo "<td>".$Asset_Status['fault']."</td>
							<td>".$Asset_Status['costinvolved']."</td>
							<td>".$Asset_Status['remark']."</td>
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
{ 
$_POST['equipment_id'] = $_GET['equipment_id'];
$_POST['department_id'] = $_GET['department_id'];
?>
<section class="grid_6 first">
	<div class="columns leading">
		<div class="grid_6 first">
		<br/>	
		<div class="form panel">
		<hr>
			<form action='' method='POST'>
				<fieldset>
					<div class="clearfix">
						<label>Equipment Id:
						<input type='text' name='equipment_id' id="equipment_id" value='<?php echo $_POST['equipment_id'];?>' /></label>
					
						<label>User Department<font color="red">*</font>
						<select id="department_id" name="department_id">
								<option value="">Select</option>
								<?php
								$Source_Department = Department_Select_All();
								while($Department = mysqli_fetch_assoc($Source_Department))
								{
									if($Department['id'] == $_POST['department_id'])
										echo "<option value=".$Department['id']." selected>".$Department['name']."</option>";
									else
										echo "<option value=".$Department['id'].">".$Department['name']."</option>";
								} ?>
						</select></label>
							<label><a class="button button-green" onclick="Export();" >Search</a></label>
					</div>	
				</fieldset>
					
					
			</form>
		<hr>
		</div>	
	<div class="columns leading">
		<div class="grid_6 first">
			<h3>Assets List
			<?php
			if($_POST['equipment_id'] || $_POST['department_id'])
				$AssetsTotalRows = mysqli_num_rows(AssetsInventory_Status_Select_ByName());
			else
				$AssetsTotalRows = mysqli_num_rows(Assets_Inventory_Select_All());
			echo " : No. of total AssetInventory - ".$AssetsTotalRows;
			?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">Equipment Name</th>
						<th align="left">Make Name</th>
						<th align="left">Model Name</th>
						<th align="left">Serial Number</th>
						<th align="left">Equipment Id</th>
						<th align="left">Installed Date</th>
						<th align="left">Warranty Period</th>
						<th align="left">Unit Cost</th>
						<th align="left">User Department</th>
						<th align="left">Acceptance Date</th>
						<th  align="left">Equipment Supplier</th>
						<th align="left">Contact Person With Number</th>
						<th align="left">Critical Equipment</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					if(!$AssetsTotalRows)
						echo '<tr><td colspan="13"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($AssetsTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					if($_POST['equipment_id'] || $_POST['department_id'] )
						$AssetsRows = AssetsInventory_Status_Select_ByNameBYLIMIT($Start, $Limit);
					else 
						$AssetsRows = Assets_Inventory_Select_ByLimit($Start, $Limit);
					while($Assets = mysqli_fetch_assoc($AssetsRows))
					{
						echo "<tr>
						<td align='center'>".++$i."</td>";
						$AssetInventory_Make_Name = mysqli_fetch_array(AssetInventory_Make_BYId($Assets['make_id']));
						$AssetInventory_Model_Name = mysqli_fetch_array(AssetInventory_ModelById($Assets['model_id']));
						$AssetInventory_Equipment_Name = mysqli_fetch_array(AssetInventory_EquipmentById($Assets['equipment_idname']));
						$AssetInventory_DepartmentName = mysqli_fetch_array(AssetsInventory_DepartmentrById($Assets['department_id']));
						echo"<td><a href='?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Assets['id']." &equipmentid=".$Assets['equipment_idname']."'>".$AssetInventory_Equipment_Name['equipment']."</a></td>
						<td>".$AssetInventory_Make_Name['make']."</td>
						<td>".$AssetInventory_Model_Name['model']."</td>
						<td>".$Assets['serialnumber']."</td>
						<td>".$Assets['equipmentid']."</td>
						<td>".date('d-m-Y',strtotime($Assets['installdate']))."</td>
						<td>".$Assets['warrantyperiod']."</td>
						<td>".$Assets['unitcost']."</td>
						<td>".$AssetInventory_DepartmentName['name']."</td>
						<td>".date('d-m-Y',strtotime($Assets['acceptdate']))."</td>
						<td>".$Assets['equipmentsupplier']."</td>
						<td>".$Assets['contactpersonno']."</td>";
						if($Assets['critical_equipment']=='1') 
							echo "<td>YES</td>";
						else
							echo "<td>NO</td>";
						echo "</tr>";
					} ?>
				</tbody>
			</table>
		</div>
	</div>	
	<?php
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
	<div class="clear">&nbsp;</div>
		</div>
	</div>
<?php 
} ?>	
</section>
<script>
	function Export()
	{
		var Equipment=0;
		var Department = 0;
		if(!document.getElementById('equipment_id').value)
			Equipment = "";
		else
			Equipment = document.getElementById('equipment_id').value;
		if(!document.getElementById('department_id').value)
			Department = "";
		else
			Department = document.getElementById('department_id').value;
		window.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&equipment_id="+Equipment+"&department_id="+Department);
	}
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	function validation()
	{
		var  message="";
		if(document.getElementById('remark').value=="")
			message = "Please Enter  the Remark";
		if(document.getElementById('costinvolved').value=="")
			message = "Please Enter  the Involved Cost";
		if(document.getElementById('fault').value=="")
			message = "Please Enter  the Fault";
		if(document.getElementById('inspectby').value=="")
			message = "Please Select the Inspect Person";	
		if(document.getElementById('date').value=="")
			message = "Please Select the Date Of Inspection";
	}
</script>