<section role="main" id="main">
	<?php
		$Columns = array("id", "name", "days", "amount");
		if($_GET['action'] == 'Edit')
		{
			$Class = mysql_fetch_assoc(Fine_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Class[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Fine_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : Fine deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			
			if(isset($_POST['Submit']))
			{
				if(mysql_num_rows(Fine_Select_ByNamePWD()))
					$message = "<br /><div class='message error'><b>Message</b> : This Fine name already exists</div>";
				else
				{
					Fine_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Fine  added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				if(mysql_num_rows(Fine_Select_ByNamePWDId()))
					$message = "<br /><div class='message error'><b>Message</b> : This Fine name already exists</div>";
				else
				{
					Fine_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Fine details updated successfully</div>";
				}
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
			<header><h2>Generate Fine </h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Fine Name <font color="red">*</font>
						<input type="text" name="name" id="name" required="required" value="<?php echo $_POST['name']; ?>"  onkeypress="return AlphaNumCheck(event)">
					</label>
					<label>Days After Due Date <font color="red">*</font>
						<input type="text" name="days" id="days" required="required" value="<?php echo $_POST['days']; ?>"  onkeypress="return isNumerics(event)">
					</label>
				</div>	
				<div class="clearfix">
					<label>Fine Amount <font color="red">*</font>
						<input type="text" name="amount" id="amount" required="required" value="<?php echo $_POST['amount']; ?>"  onkeypress="return isNumerics(event)">
					</label>
				</div>
			</fieldset>
			<hr />
			<?php
			if($_GET['action'] == 'Edit')
				echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
			?><button class="button button-gray" type="reset" name="reset" >Reset</button>
		</form>
		</div>
		
		<div class="columns">
			<h3>Fine List
				<?php
				$FineTotalRows = mysql_fetch_assoc(Fine_Select_Count_All());
				echo " : No. of Total Fine - ".$FineTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Name</th>
						<th align="left">Days</th>
						<th align="left">Fine Amount</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$FineTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($FineTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>=2)
						$i = $Start+1;
					else
						$i =1;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$FineRows = Fine_Select_ByLimit($Start, $Limit);
					while($Fine = mysql_fetch_assoc($FineRows))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$Fine['name']."</td>
							<td>".$Fine['days']."</td>
							<td>".$Fine['amount']."</td>";
							echo "<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Fine['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Fine['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
	
	function validation()
	{
		var message = "";
		if(document.getElementById("amount").value == 0)
			message = "Please enter valid fineamount";
		if(document.getElementById("days").value == 0)
			message = "Please enter valid duedate";
		if(document.getElementById("name").value.length < 2 || document.getElementById("name").value.length > 15)
			message = "Fine name should be within 2 to 15 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
		
	function isNumerics(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(document.getElementById("amount").value.indexOf('.') >= 0 && charCode == 46)
			return false;
		if(charCode==8 || charCode == 9 || charCode == 45 || charCode == 46 || (charCode >= 37 && charCode <= 40))
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
</script>