<section class="grid_6 first">
	<?php
		$Columns = array("id", "make_id", "model_id","equipment");
		if($_GET['action'] == 'Edit')
		{
			$Equipment = mysqli_fetch_assoc(Equipment_Select_ById($_GET['id']));
			foreach($Columns as $Col)
				$_POST[$Col] = $Equipment[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Equipment_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Equipment deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if(isset($_POST['Submit']))
			{
				if(mysqli_num_rows(Equipment_Select_ByName($_POST['equipment'])))
					$message = "<br /><div class='message error'><b>Message</b> : This Equipment already exists</div>";
				else
				{
					Equipment_Insert($_POST['make_id'], $_POST['model_id'],$_POST['equipment']);
					$message = "<br /><div class='message success'><b>Message</b> : Added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				if(mysqli_num_rows(Department_Select_ByNameId($_POST['equipment'], $_POST['id'])))
				$message = "<br /><div class='message error'><b>Message</b> : This Equipment already exists</div>";
				else
				{
					Equipment_Update($_POST['make_id'], $_POST['model_id'], $_POST['equipment'],$_POST['id']);
					$message = "<br /><div class='message success'><b>Message</b> : Equipment details updated successfully</div>";
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
				<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
				<header><h2>Add Equipment</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
						<label>Make Name <font color="red">*</font></label>
						<select id="make_id" name="make_id" onchange="GetModel();">
							<option value="">Select</option>
							<?php
							$Classes = Make_Select_All_Make();
							while($Class = mysqli_fetch_assoc($Classes))
							{
								if($Class['id'] == $_POST['make_id'])
									echo "<option value=".$Class['id']." selected>".$Class['make']."</option>";
								else
									echo "<option value=".$Class['id'].">".$Class['make']."</option>";
							} ?>
						</select>
					</div>
					<div class="clearfix">
						<label>Model Name <font color="red">*</font></label>
						<select id="model_id" name="model_id">
							<option value="">Select</option>
							<?php
							$Classes = Model_Select_All();
							while($Model = mysqli_fetch_assoc($Classes))
							{
								if($Model['id'] == $_POST['model_id'])
									echo "<option value=".$Model['id']." selected>".$Model['model']."</option>";
								else
									echo "<option value=".$Model['id'].">".$Model['model']."</option>";
							} ?>
						</select>
					</div>
					<div class="clearfix">
                        <label>Equipment Name <font color="red">*</font></label>
						<input type="text" id="name" name="equipment" required="required" value="<?php echo $_POST['equipment']; ?>" onkeypress="return isAlphaOrNumeric(event)" />
                    </div>
				</fieldset>
				<hr />
				<?php
				if($_GET['action'] == 'Edit')
					echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
				else
					echo '<button class="button button-green" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
				?>
				<button class="button button-gray" type="reset">Reset</button>
			</form>
		</div>
	</div>

	<div class="columns leading">
		<div class="grid_6 first">
			<h3>Equipment List
			<?php
			$EquipmentTotalRows = mysqli_num_rows(Equipment_Select_All());
			echo " : No. of total Equipments - ".$EquipmentTotalRows;
			?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">Make</th>
						<th align="left">Model</th>
						<th align="left">Equipment</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$EquipmentTotalRows)
						echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($EquipmentTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$EquipmentRows = Equipment_Select_ByLimit($Start, $Limit);
					while($Equipment = mysqli_fetch_assoc($EquipmentRows))
					{
						$Make = mysqli_fetch_assoc(Make_Select_ById_equipment($Equipment['make_id']));
						$Model = mysqli_fetch_assoc (Model_Select_ById_equipment($Equipment['model_id']));
						echo "<tr>
						<td align='center'>".$i++."</td>
						<td>".$Make['make']."</td>
						<td>".$Model['model']."</td>
						<td>".$Equipment['equipment']."</td>
						<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Equipment['id']."&pageno=".$_GET['pageno']."&action=Edit' >Edit</a> | <a href='#' onclick='deleterow(".$Equipment['id'].")'>Delete</a></td>
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
	/*var total_pages = <?php echo "4";?>;
	function test(CurrentPageNo)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				document.getElementById("result").innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/Ajax_Pagination.php?pageno="+CurrentPageNo+"&total_pages="+total_pages, true);
		xmlhttp.send();
	}
	*/
	function validation()
	{
		var message = "";
		
		if(document.getElementById('model_id').value == "")
			message = "Please select a Model";
		if(document.getElementById('make_id').value == "")
			message = "Please select a Make";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	function isAlphaOrNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode >= 32)
			return true;
		if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function GetModel()
	{
		$.post("includes/Gedmodelmaster.php?Make="+document.getElementById('make_id').value,function(Response)
		{
			document.getElementById('model_id').innerHTML = Response;
		});
	}
</script>