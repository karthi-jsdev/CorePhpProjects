<section role="main" id="main">
	<?php
		$Columns = array("id", "sales_status","enabled","sort_order");
		if($_GET['action'] == 'Edit')
		{
			$Credit = mysqli_fetch_assoc(Salesorder_Status_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Credit[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Salesorder_Status_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : Salesorder Status deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
				$Salesorder_StatusResource = Salesorder_Status_Select_ByNamePWD();
				if(isset($_POST['Submit']))
				{
					if(mysqli_num_rows($Salesorder_StatusResource))
						$message = "<br /><div class='message error'><b>Message</b> : Salesorder Status or sort Order already exists</div>";
					else
					{
						Salesorder_Status_Insert();
						$message = "<br /><div class='message success'><b>Message</b> : Salesorder Status added successfully</div>";
					}
				}
				else if(isset($_POST['Update']))
				{
					$Salesorder_Status = mysqli_fetch_assoc($Salesorder_StatusResource);
					if(mysqli_num_rows(Salesorder_Status_Select_ByNamePWDId()))
						$message = "<br /><div class='message error'><b>Message</b> : This Salesorder Status already exists</div>";
					else if(mysqli_num_rows(Salesorder_Status_Select_BySortorder()))
						$message = "<br /><div class='message error'><b>Message</b> : This sort order already exists</div>";
					else
					{
						Salesorder_Status_Update();
						$message = "<br /><div class='message success'><b>Message</b> : Salesorder Status details updated successfully</div>";
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
			<header><h2>Add Sales Order Status</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Sales Status <font color="red">*</font></label>
					<input type="text" autocomplete="off" id="sales_status" name="sales_status" required="required" value="<?php echo $_POST['sales_status']; ?>" onkeypress="return isAlphabetic(event)"/>
				</div>
				<div class="clearfix">
					<label>Enable/Disable </label>
					<?php 
						if($_POST['enabled'])
							echo '<input type="checkbox" name="enabled" value="1" checked></input><br>';
						else
							echo '<input type="checkbox" name="enabled" value="1"></input><br>';
					?>		
				</div>
				<div class="clearfix">
					<label>Sort Order  <font color="red">*</font></label>
					<input type="text" maxlength="2" id="sort_order" autocomplete="off" name="sort_order" required="required" value="<?php echo $_POST['sort_order']; ?>" onkeypress="return isNumeric(event)"/>
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
				$Salesorder_StatusTotalRows = mysqli_fetch_assoc(Salesorder_Status_Count_All());
				echo "Total No. of Sales Order Status - ".$Salesorder_StatusTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Status</th>
						<th align="left">Enable/Disable</th>
						<th align="left">Sort Order</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$Salesorder_StatusTotalRows['total'])
						echo '<tr><td colspan="3"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($Salesorder_StatusTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$Salesorder_StatusRows = Salesorder_Status_Select_ByLimit($Start, $Limit);
					while($Salesorder_Status = mysqli_fetch_assoc($Salesorder_StatusRows))
					{echo $Salesorder_Status['enable'];
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$Salesorder_Status['sales_status']."</td>";
							if($Salesorder_Status['enabled'])
								echo "<td>Enabled</td>";
							else	
								echo "<td>Disabled</td>";
							echo "<td>".$Salesorder_Status['sort_order']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Salesorder_Status['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Salesorder_Status['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
						</tr>";
					} ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="clear">&nbsp;</div>
	<?php
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
</section>
<script>
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 9 ||charCode == 35 ||charCode == 36 ||charCode == 46)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122 || charCode == 32)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8 ||charCode == 35 ||charCode == 36 ||charCode == 46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	
	function validation()
	{
		var message = "";
		if(document.getElementById("sort_order")==0)
			message = "Please Enter the sort order";
		if(document.getElementById("sales_status")==0)
			message = "Please Enter the sales status";	
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>