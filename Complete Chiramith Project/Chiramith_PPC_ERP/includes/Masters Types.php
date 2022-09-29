<section class="first">
	<?php
		$Columns = array("id", "typeid", "type");
		if($_GET['action'] == 'Edit')
		{
			$Types = mysqli_fetch_assoc(MachineType_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Types[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			MachineType_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Machine type deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$MachineTypeResource = MachineType_Select_ByName();
			if(isset($_POST['Submit']))
			{
				if(mysqli_num_rows($MachineTypeResource))
					$message = "<br /><div class='message error'><b>Message</b> : This Machine type already exists</div>";
				else
				{
					$MachineNo = mysqli_fetch_assoc(Machine_Get_LastId_Type());
					$TypeNo = substr($MachineNo['typeid'],1);
					$Zeros = array("", "0", "00");
					$MachineNos ="T".$Zeros[3 - strlen($TypeNo+1)].($TypeNo+1);
					MachineType_Insert($MachineNos);
					$message = "<br /><div class='message success'><b>Message</b> : Machine type added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				$MachineType = mysqli_fetch_assoc($MachineTypeResource);
				if(mysqli_num_rows(User_Select_ByNamePWDId()))
					$message = "<br /><div class='message error'><b>Message</b> : This Machine type already exists</div>";
				else
				{
					MachineType_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Machine type details updated successfully</div>";
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
				<header><h2>Machine Type Master</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>Machine Type <font color="red">*</font></label>
						<input type="text" id="machinetype" name="machinetype" placeholder="Enter Type" required="required" value="<?php echo $_POST['type']; ?>" onkeypress="return isAlphabetic(event)"/>
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
			<h3>Type List
				<?php
				$MachineType_TotalRows = mysqli_fetch_assoc(MachineType_Select_Count_All());
				echo " : No. of total Types - ".$MachineType_TotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Type ID</th>
						<th align="left">Machine Type</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$MachineType_TotalRows['total'])
						echo '<tr><td colspan="4"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($MachineType_TotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>1)
						$i = $MachineType_TotalRows['total']- $Start;
					else
						$i = $MachineType_TotalRows['total'];
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$MachineTypeRows = MachineType_Select_ByLimit($Start, $Limit);
					while($MachineType = mysqli_fetch_assoc($MachineTypeRows))
					{
						echo "<tr>
							<td align='center'>".$i--."</td>";
							echo "<td>".$MachineType['typeid']."</td>
							<td>".$MachineType['type']."</td>
							<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$MachineType['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a> | <a href='#' onclick='deleterow(".$MachineType['id'].")'>Delete</a></td>
						</tr>";
					}?>
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
		else if(charCode == 32 ||charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122 )
			return true;
		else
			return false;
	}
	
	function validation()
	{
		var message = "";
		if(document.getElementById("machinetype").value.length < 3 || document.getElementById("machinetype").value.length > 15)
			message = "Machine type should be within 3 to 15 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>