<section class="first">
	<?php
		$Columns = array("id", "machine_number", "machine_type_id", "machine_make_id", "machine_specification_id", "machine_turningtools_id");
		if($_GET['action'] == 'Edit')
		{
			$Machine = mysql_fetch_assoc(Machine_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Machine[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Machine_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Machine deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$FetchMachineNo = Select_MachineNo();
			if(isset($_POST['Submit']))
			{
				if(mysql_num_rows($FetchMachineNo))
					$message = "<br /><div class='message error'><b>Message</b> : This Machine already exists</div>";
				else
				{
					Machine_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Machine added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				$Machine = mysql_fetch_assoc($FetchMachineNo);
				if(mysql_num_rows(Select_MachineNoById()))
					$message = "<br /><div class='message error'><b>Message</b> : This Machine already exists</div>";
				else
				{
					Machine_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Machine details updated successfully</div>";
				}
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns">
		<?php echo $message; ?>
		<div class="grid_6 first">
			<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
				<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
				<header><h2>Machine Master</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>Machine No. <font color="red">*</font></label>
						<input type="text" id="machine_number" name="machine_number" required="required" value="<?php echo $_POST['machine_number']; ?>" onkeypress="return AlphaNumCheck(event)"/>
                    </div>
					<div class="clearfix">
                        <label>Machine Type <font color="red">*</font></label>
						<select  id="machine_type_id"  name="machine_type_id" >
							<option value=''>Select</option>
							<?php
							$SelectMachineType = Master_Machine_Type();
							while($FetchMachineType = mysql_fetch_array($SelectMachineType))
							{
								if($FetchMachineType['id'] == $_POST['machine_type_id'])
									echo '<option value="'.$FetchMachineType['id'].'" selected>'.$FetchMachineType['type'].'</option>';
								else
									echo '<option value="'.$FetchMachineType['id'].'">'.$FetchMachineType['type'].'</option>';
							} ?>
						</select>
                    </div>
					<div class="clearfix">
                        <label>Machine Make <font color="red">*</font></label>
						<select  id="machine_make_id"  name="machine_make_id" >
							<option value=''>Select</option>
							<?php
							$SelectMachineMake = Master_Machine_Make();
							while($FetchMachineMake = mysql_fetch_array($SelectMachineMake))
							{
								if($FetchMachineMake['id'] == $_POST['machine_make_id'])
									echo '<option value="'.$FetchMachineMake['id'].'" selected>'.$FetchMachineMake['name'].'</option>';
								else
									echo '<option value="'.$FetchMachineMake['id'].'">'.$FetchMachineMake['name'].'</option>';
							} ?>
						</select>
                    </div>
					<div class="clearfix">
                        <label>Machine Specification Size <font color="red">*</font></label>
						<select  id="machine_specification_id"  name="machine_specification_id" >
							<option value=''>Select</option>
							<?php
							$SelectMachineSpecifiactionSize = Master_Machine_Specification_Size();
							while($FetchMachineSpecifiactionSize = mysql_fetch_array($SelectMachineSpecifiactionSize))
							{
								if($FetchMachineSpecifiactionSize['id'] == $_POST['machine_specification_id'])
									echo '<option value="'.$FetchMachineSpecifiactionSize['id'].'" selected>'.$FetchMachineSpecifiactionSize['specification'].'</option>';
								else
									echo '<option value="'.$FetchMachineSpecifiactionSize['id'].'">'.$FetchMachineSpecifiactionSize['specification'].'</option>';
							} ?>
						</select>
                    </div>
						<div class="clearfix">
                        <label>Number of Tools <font color="red">*</font></label>
						<select  id="machine_turningtools_id"  name="machine_turningtools_id" >
							<option value=''>Select</option>
							<?php
							$SelectMachineTurningTools = Master_Machine_Turning_Tools();
							while($FetchMachineTurningTools = mysql_fetch_array($SelectMachineTurningTools))
							{
								if($FetchMachineTurningTools['id'] == $_POST['machine_turningtools_id'])
									echo '<option value="'.$FetchMachineTurningTools['id'].'" selected>'.$FetchMachineTurningTools['turningtool'].'</option>';
								else
									echo '<option value="'.$FetchMachineTurningTools['id'].'">'.$FetchMachineTurningTools['turningtool'].'</option>';
							} ?>
						</select>
                    </div>
				</fieldset>
				<hr />
				<?php
				if($_GET['action'] == 'Edit')
					echo '<button class="button button-blue" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
				else
					echo '<button class="button button-blue" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
				?>
				<button class="button button-gray" type="reset">Reset</button>
			</form>
		</div>
	</div>

	<div class="columns leading">
		<div class="grid_6 first">
			<h3>Machine List
				<?php
				$MachineTotalRows = mysql_fetch_assoc(Machine_Select_Count_All());
				echo " : No. of total Machine - ".$MachineTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Machine No.</th>
						<th align="left">Type</th>
						<th align="left">Make</th>
						<th align="left">Specification Size</th>
						<th align="left">Number of Tools</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$MachineTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($MachineTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>1)
						$i = $MachineTotalRows['total']- $Start;
					else
						$i = $MachineTotalRows['total'];
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$MachineRows = Machine_Select_ByLimit($Start, $Limit);
					while($Machine = mysql_fetch_assoc($MachineRows))
					{
						$MachineType = mysql_fetch_assoc(Select_MachineType($Machine['machine_type_id']));
						$MachineMake = mysql_fetch_assoc(Select_MachineMake($Machine['machine_make_id']));
						$Specification_Size = mysql_fetch_assoc(Select_Specification_Size($Machine['machine_specification_id']));
						$Turning_Tools = mysql_fetch_assoc(Select_Turning_Tools($Machine['machine_turningtools_id']));
						echo "<tr>
							<td align='center'>".$i--."</td>
							<td>".$Machine['machine_number']."</td>
							<td>".$MachineType['type']."</td>
							<td>".$MachineMake['name']."</td>
							<td>".$Specification_Size['specification']."</td>
							<td>".$Turning_Tools['turningtool']."</td>
							<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Machine['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a> | <a href='#' onclick='deleterow(".$Machine['id'].")'>Delete</a></td>
						</tr>";
					} ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="clear">&nbsp;</div>
</section>

<?php
$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
if($total_pages > 1)
	include("includes/Pagination.php");
?>
<script>
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode == 8 || charCode == 9  || charCode == 46) 
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode == 8 || charCode == 9  || charCode == 46) 
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return NumberCount();
	}
	
	function NumberCount()
	{
		if(document.getElementById("phone").value.length < 10)
			return true;
		else
			return false;
	}
	
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8 || charCode == 9  || charCode == 46) 
			return true;
        var keynum;
        var keychar;
        var charcheck = /[a-zA-Z0-9]/;
        if(window.event)
        {
            keynum = e.keyCode;
        }
        else {
            if(e.which)
            {
                keynum = e.which;
            }
            else return true;
        }

        keychar = String.fromCharCode(keynum);
        return charcheck.test(keychar);
    }
	
	function validation()
	{
		var message = "";
		if(document.getElementById('machine_turningtools_id').value == "")
			message = "Please select a Tool";
		if(document.getElementById('machine_specification_id').value == "")
			message = "Please select a Machine Specification";
		if(document.getElementById('machine_make_id').value == "")
			message = "Please select a Machine Make";
		if(document.getElementById('machine_type_id').value == "")
			message = "Please select a Machine type";
		if(document.getElementById("machine_number").value.length < 2)
			message = "Machine number should be minimum 2 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>