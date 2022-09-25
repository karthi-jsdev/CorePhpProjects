<section class="first">
	<?php
		$Columns = array("id", "specificationid", "specification");
		if($_GET['action'] == 'Edit')
		{
			$Specifications = mysql_fetch_assoc(Specification_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Specifications[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Specification_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Specification deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
				$SpecificationResource = Specification_Select_ByName();
				if(isset($_POST['Submit']))
				{
					if(mysql_num_rows($SpecificationResource))
						$message = "<br /><div class='message error'><b>Message</b> : This Specification already exists</div>";
					else
					{
						$MachineNo =  mysql_fetch_assoc(Machine_Get_LastId_Specification());
						$SpecificationNo = substr($MachineNo['specificationid'],3);
						$Zeros = array("", "0", "00");
						$SpecificationNos ="MSP".$Zeros[3 - strlen($SpecificationNo+1)].($SpecificationNo+1);
						Specification_Insert($SpecificationNos);
						$message = "<br /><div class='message success'><b>Message</b> : Specification added successfully</div>";
					}
				}
				else if(isset($_POST['Update']))
				{
					$Specification = mysql_fetch_assoc($SpecificationResource);
					if(mysql_num_rows(User_Select_ByNamePWDId()))
						$message = "<br /><div class='message error'><b>Message</b> : This Specification already exists</div>";
					else
					{
						Specification_Update();
						$message = "<br /><div class='message success'><b>Message</b> : Specification details updated successfully</div>";
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
				<header><h2>Specification Master</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>Specification <font color="red">*</font></label>
						<input type="text" id="specification" name="specification" placeholder="Enter Specification" required="required" value="<?php echo $_POST['specification']; ?>" onkeypress="return isAlphabetic(event)"/>
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
				$Specification_TotalRows = mysql_fetch_assoc(Specification_Select_Count_All());
				echo " : No. of total Specification - ".$Specification_TotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Specification ID</th>
						<th align="left">Specification</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$Specification_TotalRows['total'])
						echo '<tr><td colspan="4"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($Specification_TotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>1)
						$i = $Specification_TotalRows['total']- $Start;
					else
						$i = $Specification_TotalRows['total'];
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$SpecificationRows = Specification_Select_ByLimit($Start, $Limit);
					while($Specification = mysql_fetch_assoc($SpecificationRows))
					{
						echo "<tr>
							<td align='center'>".$i--."</td>
							<td>".$Specification['specificationid']."</td>
							<td>".$Specification['specification']."</td>
							<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Specification['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a> | <a href='#' onclick='deleterow(".$Specification['id'].")'>Delete</a></td>
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
		else if(charCode == 32 ||charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122 || charCode >= 48 && charCode <= 57)
			return true;
		else
			return false;
	}
		
	function validation()
	{
		var message = "";
		if(document.getElementById("specification").value.length < 3 || document.getElementById("specification").value.length > 15)
			message = "Specification should be within 3 to 15 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>