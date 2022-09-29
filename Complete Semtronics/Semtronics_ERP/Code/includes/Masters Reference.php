<section role="main" id="main">
	<?php
		$Columns = array("id", "reference","mobile","address");
		if($_GET['action'] == 'Edit')
		{
			$Credit = mysqli_fetch_assoc(Reference_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Credit[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Reference_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : Reference deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
				$ReferenceResource = Reference_Select_ByNamePWD();
				/*if(strlen($_POST['mobile']) != 10)
					$message = "<br /><div class='message error'><b>Message</b> : Invalid phone number</div>";
				else 
				*/
				if(isset($_POST['Submit']))
				{
					if(mysqli_num_rows($ReferenceResource))
						$message = "<br /><div class='message error'><b>Message</b> : Reference already exists</div>";
					else
					{
						Reference_Insert();
						$message = "<br /><div class='message success'><b>Message</b> : Reference added successfully</div>";
					}
				}
				else if(isset($_POST['Update']))
				{
					$Reference = mysqli_fetch_assoc($ReferenceResource);
					if(mysqli_num_rows(Reference_Select_ByNamePWDId()))
						$message = "<br /><div class='message error'><b>Message</b> : This Reference already exists</div>";
					else
					{
						Reference_Update();
						$message = "<br /><div class='message success'><b>Message</b> : Reference details updated successfully</div>";
					}
				}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
			<header><h2>Add Reference</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Reference <font color="red">*</font></label>
					<input type="text" autocomplete="off" id="reference" name="reference" required="required" value="<?php echo $_POST['reference']; ?>"/>
				</div>
				<div class="clearfix">
					<label>Mobile Number <font color="red">*</font></label>
					<input type="text" autocomplete="off" id="mobile" name="mobile" required="required" value="<?php echo $_POST['mobile'];?>" onkeypress="return isNumeric(event)"/>
				</div>
				<div class="clearfix">
					<label>Address <font color="red">*</font></label>
					<textarea id="address" maxlength="100" autocomplete="off" name="address" required="required"><?php echo $_POST['address']; ?></textarea>
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
		
		<div class="columns">
			<h3>
				<?php
				$ReferenceTotalRows = mysqli_fetch_assoc(Reference_Count_All());
				echo "Total No. of Reference - ".$ReferenceTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Status</th>
						<th align="left">Mobile</th>
						<th align="left">Address</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$ReferenceTotalRows['total'])
						echo '<tr><td colspan="3"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($ReferenceTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$ReferenceRows = Reference_Select_ByLimit($Start, $Limit);
					while($Reference = mysqli_fetch_assoc($ReferenceRows))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$Reference['reference']."</td>
							<td>".$Reference['mobile']."</td>
							<td>".$Reference['address']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Reference['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Reference['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
						</tr>";
					} ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="clear">&nbsp;</div>
	<?php
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
</section>
<script>
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 9)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8 || charCode == 9 || charCode ==45 || charCode==47)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	
	function validation()
	{
		var message = "";
		if(document.getElementById("reference")==0)
			message = "Please Enter the Reference";
		if(document.getElementById("mobile")==0)
			message = "Please Enter the Mobile";
		if(document.getElementById("address")==0)
			message = "Please Enter the Address";	
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>