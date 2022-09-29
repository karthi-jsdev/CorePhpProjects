<section class="first">
	<?php
		$Columns = array("id", "makeid", "name");
		if($_GET['action'] == 'Edit')
		{
			$Makes = mysqli_fetch_assoc(MachineMake_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Makes[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			MachineMake_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Machine make deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
				$MachineMakeResource = MachineMake_Select_ByName();
				if(isset($_POST['Submit']))
				{
					if(mysqli_num_rows($MachineMakeResource))
						$message = "<br /><div class='message error'><b>Message</b> : This Machine make already exists</div>";
					else
					{
						$MachineNo = mysqli_fetch_assoc(Machine_Get_LastId_Make());
						$MakeNo = substr($MachineNo['makeid'],2);
						$Zeros = array("", "0", "00");
						$MakeNos ="MK".$Zeros[3 - strlen($MakeNo+1)].($MakeNo+1);
						MachineMake_Insert($MakeNos);
						$message = "<br /><div class='message success'><b>Message</b> : Machine make added successfully</div>";
					}
				}
				else if(isset($_POST['Update']))
				{
					$MachineMake = mysqli_fetch_assoc($MachineMakeResource);
					if(mysqli_num_rows(User_Select_ByNamePWDId()))
						$message = "<br /><div class='message error'><b>Message</b> : This Machine make already exists</div>";
					else
					{
						MachineMake_Update();
						$message = "<br /><div class='message success'><b>Message</b> : Machine make details updated successfully</div>";
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
				<header><h2>Machine Make Master</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>Machine Make <font color="red">*</font></label>
						<input type="text" id="machinemake" name="machinemake" placeholder="Enter Make" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return isAlphabetic(event)"/>
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
			<h3>Make List
				<?php
				$MachineMake_TotalRows = mysqli_fetch_assoc(MachineMake_Select_Count_All());
				echo " : No. of total Make - ".$MachineMake_TotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Type ID</th>
						<th align="left">Machine Make</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$MachineMake_TotalRows['total'])
						echo '<tr><td colspan="4"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($MachineMake_TotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>1)
						$i = $MachineMake_TotalRows['total']- $Start;
					else
						$i = $MachineMake_TotalRows['total'];
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$MachineMakeRows = MachineMake_Select_ByLimit($Start, $Limit);
					while($MachineMake = mysqli_fetch_assoc($MachineMakeRows))
					{
						echo "<tr>
							<td align='center'>".$i--."</td>
							<td>".$MachineMake['makeid']."</td>
							<td>".$MachineMake['name']."</td>
							<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$MachineMake['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a> | <a href='#' onclick='deleterow(".$MachineMake['id'].")'>Delete</a></td>
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
		if(document.getElementById("machinemake").value.length < 3 || document.getElementById("machinemake").value.length > 15)
			message = "Machine make should be within 3 to 15 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>