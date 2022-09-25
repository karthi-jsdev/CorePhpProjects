<section role="main" id="main">
	<?php
	$Columns = array("id", "status","enabled","sortorder");
	if($_GET['action'] == 'Edit')
	{
		$Credit = mysql_fetch_assoc(Oppurtunity_Status_Select_ById());
		foreach($Columns as $Col)
			$_POST[$Col] = $Credit[$Col];
	}
	else if($_GET['action'] == 'Delete')
	{
		Oppurtunity_Status_Delete_ById($_GET['id']);
		$message = "<br /><div class='message success'><b>Message</b> : Opportunity Status deleted successfully</div>";
	}
	
	if(isset($_POST['Submit']) || isset($_POST['Update']))
	{
			$Oppurtunity_StatusResource = Oppurtunity_Status_Select_ByNamePWD();
			if(isset($_POST['Submit']))
			{
				if(mysql_num_rows($Oppurtunity_StatusResource))
					$message = "<br /><div class='message error'><b>Message</b> : Opportunity Status or sortorder already exists</div>";
				else
				{
					Oppurtunity_Status_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Opportunity Status added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				$Oppurtunity_Status = mysql_fetch_assoc($Oppurtunity_StatusResource);
				if(mysql_num_rows(Oppurtunity_Status_Select_ByNamePWDId()))
					$message = "<br /><div class='message error'><b>Message</b> : This Opportunity Status already exists</div>";
				else if(mysql_num_rows(Oppurtunity_Status_Select_Bysortorder()))
					$message = "<br /><div class='message error'><b>Message</b> : This Opportunity Status Sort Order already exists</div>";
				else
				{
					Oppurtunity_Status_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Opportunity Status details updated successfully</div>";
				}
			}
		foreach($Columns as $Col)
			$_POST[$Col] = "";
	} ?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
			<header><h2>Add Opportunity Status</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Status <font color="red">*</font></label>
					<input type="text" id="status" autocomplete="off" name="status" required="required" value="<?php echo $_POST['status']; ?>" onkeypress="return isAlphabetic(event)"/>
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
					<input type="text" maxlength="2" id="sortorder" autocomplete="off" name="sortorder" required="required" value="<?php echo $_POST['sortorder']; ?>" onkeypress="return isNumeric(event)"/>
				</div>	
			</fieldset>
			<hr />
			<?php
			if($_GET['action'] == 'Edit')
				echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
			?>
			<button class="button button-gray"  onclick="autoclear()" type="reset">Reset</button>
		</form>
		</div>
		
		<div class="columns">
			<h3>
				<?php
				$Opportunity_StatusTotalRows = mysql_fetch_assoc(Oppurtunity_Status_Select_Count_All());
				echo "Total No. of Opportunity Status - ".$Opportunity_StatusTotalRows['total'];
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
					if(!$Opportunity_StatusTotalRows['total'])
						echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($Opportunity_StatusTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$Opportunity_StatusRows = Oppurtunity_Status_Select_ByLimit($Start, $Limit);
					while($Oppurtunity_Status = mysql_fetch_assoc($Opportunity_StatusRows))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$Oppurtunity_Status['status']."</td>";
							if($Oppurtunity_Status['enabled']=='1')
								echo "<td>Enabled</td>";
							else	
								echo "<td>Disabled</td>";
						echo "<td>".$Oppurtunity_Status['sortorder']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Oppurtunity_Status['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Oppurtunity_Status['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
	function autoclear()
	{
		if(document.getElementById("enable").checked == true)
		{
			$("span").removeAttr('class');
			document.getElementById("enable").checked = false;
		}
	}
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 ||charCode == 9 ||charCode == 35 ||charCode == 36 ||charCode == 46 )
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122 || charCode == 32)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8 || 	charCode == 35 ||charCode == 36 ||charCode == 46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	
	function validation()
	{
		var message = "";
		if(document.getElementById("status")==0)
			message = "Please Enter the Oppurtunity Status";
		if(document.getElementById("sortorder")==0)
			message = "Please Enter the Oppurtunity Sortorder";	
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>