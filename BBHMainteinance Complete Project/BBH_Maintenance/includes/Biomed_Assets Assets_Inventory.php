<head>
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
		<script src="js/datepicker/jquery.ui.core.js"></script>
		<script src="js/datepicker/jquery.ui.widget.js"></script>
		<script src="js/datepicker/jquery.ui.datepicker.js"></script>
		<script> 
			$(function() {
				$("#installdate").datepicker({dateFormat: 'dd-mm-yy',maxDate: 0});
				$("#acceptdate").datepicker({dateFormat: 'dd-mm-yy',minDate: 0});
				$("#warrantyperiod").datepicker({dateFormat: 'dd-mm-yy'});
			});
		</script> 
</head>
<section class="grid_6 first">
	<br />
	<?php
		$Columns = array("id","make_id","model_id","equipment_idname","serialnumber","equipmentid","installdate","warrantyperiod","warranty_comments","unitcost","department_id","acceptdate","equipmentsupplier","contactpersonno","critical_equipment");
		if($_GET['action'] == 'Edit')
		{
			$Assets = mysqli_fetch_assoc(Assets_Inventory_Select_ById($_GET['id']));
			foreach($Columns as $Col)
				$_POST[$Col] = $Assets[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Assets_Inventory_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Assets Invventory deleted successfully</div>";
		}
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if(isset($_POST['Submit']))
			{
				//if($_POST['locationid'] == "undefined")
					//$_POST['locationid']="";
				Assets_Inventory_Insert($_POST['make_id'],$_POST['model_id'],$_POST['equipment_idname'],$_POST['serialnumber'],$_POST['equipmentid'],$_POST['installdate'],$_POST['warrantyperiod'],$_POST['warrantycomments'],$_POST['unitcost'],$_POST['department_id'],$_POST['acceptdate'],$_POST['equipmentsupplier'],$_POST['contactpersonno'],$_POST['critical']);
				$message = "<br /><div class='message success'><b>Message</b> : Assets Invventory Added successfully</div>";
			}
			else if(isset($_POST['Update']))
			{
				//if($_POST['locationid'] == "undefined")
					//$_POST['locationid']="";
				Assets_Inventory_Update($_POST['id'],$_POST['make_id'],$_POST['model_id'],$_POST['equipment_idname'],$_POST['serialnumber'],$_POST['equipmentid'],$_POST['installdate'],$_POST['warrantyperiod'],$_POST['warrantycomments'],$_POST['unitcost'],$_POST['department_id'],$_POST['acceptdate'],$_POST['equipmentsupplier'],$_POST['contactpersonno'],$_POST['critical']);
				$message = "<br /><div class='message success'><b>Message</b> : Assets Invventory  details updated successfully</div>";
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<form method="POST" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
		<input type="hidden" value="<?php echo $_GET['id'];?>" name="id">
		<header><h2>Asset Inventory: </h2></header>
		<hr />
		<fieldset>
			<div class="clearfix">
				<label>Source Of Make<font color="red">*</font></label>
				<select id="make_id" name="make_id" onchange="GetModel(this.value,'')">
					<option value="">Select</option>
					<?php
					$Source_Make = Source_Make_All();
					while($Make = mysqli_fetch_assoc($Source_Make))
					{
						if($Make['id'] == $_POST['make_id'])
							echo "<option value=".$Make['id']." selected>".$Make['make']."</option>";
						else
							echo "<option value=".$Make['id'].">".$Make['make']."</option>";
					} ?>
				</select>
			</div>		
			<div class="clearfix">
				<label>Source Of Model<font color="red">*</font></label>
				<div id="modelname">
					<select id="model_id" name="model_id" onchange="GetModel(document.getElementById('make_id').value,this.value)">
						<option value="">Select</option>
						<?php
							$SelectModel = mysqli_query($_SESSION['connection'],"select * from biomedical_model where make_id='".$_POST['make_id']."'");
							while($FetchModel = mysqli_fetch_array($SelectModel))
							{
								if($_POST['model_id']==$FetchModel['id'])
									echo '<option value="'.$FetchModel['id'].'" selected>'.$FetchModel['model'].'</option>';
								else
									echo '<option value="'.$FetchModel['id'].'">'.$FetchModel['model'].'</option>';
							}
						?>
					</select>
				</div>
			</div>	
			<div class="clearfix">
				<label>Equipment<font color="red">*</font></label>
				<div id="equipmentname">
					<select id="equipment_idname" name="equipment_idname">
						<option value="">Select</option>
						<?php
						$Source_Equipment = mysqli_query($_SESSION['connection'],"select * from biomedical_equipment where model_id='".$_POST['model_id']."'");
						while($Equipment = mysqli_fetch_assoc($Source_Equipment))
						{
							if($Equipment['id'] == $_POST['equipment_idname'])
								echo "<option value=".$Equipment['id']." selected>".$Equipment['equipment']."</option>";
							else
								echo "<option value=".$Equipment['id'].">".$Equipment['equipment']."</option>";
						} ?>
					</select>
				</div>
			</div>
			<div class="clearfix">
				<label>Serial Number<font color="red">*</font></label>
				<input type="text" name="serialnumber" id="serialnumber" value="<?php echo $_POST['serialnumber']; ?>" onkeypress="return isNumeric(event)" />
			</div>
			<div class="clearfix">
				<label>Equipment Id<font color="red">*</font></label>
				<input type="text" name="equipmentid" id="equipmentid" value="<?php echo $_POST['equipmentid']; ?>" onkeypress="return isNumeric(event)"/>
			</div>
			<div class="clearfix">
				<label>Installed Date<font color="red">*</font></label>
				<input type="text" name="installdate" id="installdate" value="<?php echo $_POST['installdate']; ?>" />
			</div>
			<div class="clearfix">
				<label>Warranty Period<font color="red">*</font></label>
				<input type="text" name="warrantyperiod" id="warrantyperiod" value="<?php echo $_POST['warrantyperiod']; ?>" />
			</div>
			<div class="clearfix">
				<label>Warranty Comments<font color="red">*</font></label>
				<textarea rows="2" cols="40" name="warrantycomments" id="warrantycomments" value=""><?php echo $_POST['warranty_comments']; ?></textarea>
			</div>
			<div class="clearfix">
				<label>Unit Cost<font color="red">*</font></label>
				<input type="text" name="unitcost" id="unitcost" value="<?php echo $_POST['unitcost']; ?>" onkeypress="return isNumeric(event)"/>
			</div>
			<div class="clearfix">
				<label>User Department<font color="red">*</font></label>
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
				</select>
			</div>	
			<div class="clearfix">
				<label>Acceptance Date<font color="red">*</font></label>
				<input type="text" name="acceptdate" id="acceptdate" value="<?php echo $_POST['acceptdate']; ?>" />
			</div>
			<div class="clearfix">
				<label>Equipment Supplier<font color="red">*</font></label>
				<input type="text" name="equipmentsupplier" id="equipmentsupplier" value="<?php echo $_POST['equipmentsupplier']; ?>" />
			</div>
			<div class="clearfix">
				<label>Contact Person No<font color="red">*</font></label>
				<input type="text" name="contactpersonno" id="contactpersonno" value="<?php echo $_POST['contactpersonno']; ?>" onkeypress="return isNumeric(event);"/>
			</div>
			<div class="clearfix">
				<label>Critical Equipment<font color="red">*</font></label>
					<?php 
					if($_POST['critical_equipment'])
						echo '<input type="checkbox" name="critical" id="critical" value="1" checked>';
					else 
						echo '<input type="checkbox" name="critical" id="critical" value="1" >';
					?>	
			</div>
		</fieldset>
		<hr />
		<?php
			if($_GET['action'] == 'Edit')
				echo '<button class="button button-green" type="submit" name="Update"  value="Update">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit" >Submit</button>&nbsp;&nbsp;';
		?>
		<a href='?page=<?php echo $_GET['page']; ?>'class="button button-orange" type="submit">Cancel</a>
		<button class="button button-gray" name ="reset" type="reset" >Reset</button>
	</form>
	<div class="columns leading">
		<div class="grid_6 first">
			<h3>Assets List
			<?php
			$AssetsTotalRows = mysqli_num_rows(Assets_Inventory_Select_All());
			echo " : No. of total Asset Inventory - ".$AssetsTotalRows;
			?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">Make Name</th>
						<th align="left">Model Name</th>
						<th align="left">Equipment Name</th>
						<th align="left">Serial Number</th>
						<th align="left">Equipment Id</th>
						<th align="left">Installed Date</th>
						<th align="left">Warranty Period</th>
						<th align="left">Warranty Comments</th>
						<th align="left">Unit Cost</th>
						<th align="left">User Department</th>
						<th align="left">Acceptance Date</th>
						<th  align="left">Equipment Supplier</th>
						<th align="left">Contact Person No.</th>
						<th align="left">Critical Equipment</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$AssetsTotalRows)
						echo '<tr><td colspan="14"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($AssetsTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$AssetsRows = Assets_Inventory_Select_ByLimit($Start, $Limit);
					while($Assets = mysqli_fetch_assoc($AssetsRows))
					{
						echo "<tr>
						<td align='center'>".++$i."</td>";
						$AssetInventory_Make_Name = mysqli_fetch_array(AssetInventory_Make_BYId($Assets['make_id']));
						$AssetInventory_Model_Name = mysqli_fetch_array(AssetInventory_ModelById($Assets['model_id']));
						$AssetInventory_Equipment_Name = mysqli_fetch_array(AssetInventory_EquipmentById($Assets['equipment_idname']));
						$AssetInventory_DepartmentName = mysqli_fetch_array(AssetsInventory_DepartmentrById($Assets['department_id']));
						echo 
						"<td>".$AssetInventory_Make_Name['make']."</td>
						<td>".$AssetInventory_Model_Name['model']."</td>
						<td>".$AssetInventory_Equipment_Name['equipment']."</td>
						<td>".$Assets['serialnumber']."</td>
						<td>".$Assets['equipmentid']."</td>
						<td>".date('d-m-Y',strtotime($Assets['installdate']))."</td>
						<td>".date('d-m-Y',strtotime($Assets['warrantyperiod']))."</td>
						<td>".$Assets['warranty_comments']."</td>
						<td>".$Assets['unitcost']."</td>
						<td>".$AssetInventory_DepartmentName['name']."</td>
						<td>".date('d-m-Y',strtotime($Assets['acceptdate']))."</td>
						<td>".$Assets['equipmentsupplier']."</td>
						<td>".$Assets['contactpersonno']."</td>";
						if($Assets['critical_equipment']=='1') 
							echo "<td>YES</td>";
						else
							echo "<td>NO</td>";
						echo "<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Assets['id']."&pageno=".$_GET['pageno']."&action=Edit' >Edit</a> | <a href='#' onclick='deleterow(".$Assets['id'].")'>Delete</a></td>
						</tr>";
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
</section>
<script>
	function GetModel(Make,Model)
	{
		$.post("includes/Getmodel.php?Make="+Make+"&Model="+Model, function(Response)
		{
			var Extension= Response.split("#");
			if(Extension[0])
				document.getElementById('modelname').innerHTML = Extension[0];
			if(Extension[1])
				document.getElementById('equipmentname').innerHTML = Extension[1];
		});		
	}
	function validation()
	{
		var message = "";
		if(document.getElementById('contactpersonno').value == "")
			message = "Please enter contactpersonno";
		if(document.getElementById('equipmentsupplier').value == "")
			message = "Please enter equipmentsupplier name";
		if(document.getElementById('acceptdate').value == "")
			message = "Please select acceptdate";
		if(document.getElementById('department_id').value == "")
			message = "Please enter department name";
		if(document.getElementById('unitcost').value == "")
			message = "Please enter unitcost";
		if(document.getElementById('warrantyperiod').value == "")
			message = "Please select  warrantyperiod";
		if(document.getElementById('installdate').value == "")
			message = "Please select  installdate";
		if(document.getElementById('equipmentid').value == "")
			message = "Please enter equipmentid";
		if(document.getElementById('serialnumber').value == "")
			message = "Please enter serialnumber";
		if(document.getElementById('equipment_idname').value == "")
			message = "Please select a equipment name";
		if(document.getElementById('model_id').value == "")
			message = "Please select a model";
		if(document.getElementById('make_id').value == "")
			message = "Please select a make";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	function deleterow(id)
	{
		var r = confirm("Are you sure, Do you really want to delete this record?");
		if(r == true)
			document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&id="+id+"&action=Delete");
	}
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return NumberCount();
	}
	
	function NumberCount()
	{
		if(document.getElementById("contactpersonno").value.length < 10)
			return true;
		else
			return false;
	}
	
	$( document ).ready(function()
	{
		$('#uniform-department_id').removeAttr('class');
		$('#uniform-department_id').removeAttr('style');
		$('#department_id').removeAttr('style');
		$("#uniform-department_id span").remove();
		$('#uniform-make_id').removeAttr('class');
		$('#uniform-make_id').removeAttr('style');
		$('#make_id').removeAttr('style');
		$("#uniform-make_id span").remove();
	});
</script>