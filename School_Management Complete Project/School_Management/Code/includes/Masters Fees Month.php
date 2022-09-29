<section role="main" id="main">
	<?php
		$Columns = array("id", "name");
		if($_GET['action'] == 'Edit')
		{
			$Class = mysqli_fetch_assoc(Month_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Class[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Month_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Month name deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$MonthResource = Month_Select_ByNamePWD();
			if(isset($_POST['Submit']))
			{
				if(mysqli_num_rows($MonthResource))
					$message = "<br /><div class='message error'><b>Message</b> : This Month name already exists</div>";
				else
				{
					Month_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Month name added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				$Class = mysqli_fetch_assoc($MonthResource);
				if(mysqli_num_rows(Month_Select_ByNamePWDId()))
					$message = "<br /><div class='message error'><b>Message</b> : This Month name already exists</div>";
				else
				{
					Month_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Month details updated successfully</div>";
				}
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
<head>
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#from").datepicker({dateFormat: 'dd-mm-yy',changeYear: true}); //, minDate: 0
			$("#to").datepicker({dateFormat: 'dd-mm-yy',changeYear: true});
		});
	</script>
</head>
<div class="columns" style='width:902px;'>
	<?php echo $message; ?>
	<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
		<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
		<header><h2>Add Month</h2></header>
		<hr />			
		<fieldset>
			<div class="clearfix">
				<label>Month Name <font color="red">*</font></label>
					<input type="text" id="name" name="name" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return AlphaNumCheck(event)"/>
			</div>
		</fieldset>
		
		<hr />
		<?php
		if($_GET['action'] == 'Edit')
			echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
		else
			echo '<button class="button button-green" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
		?><button class="button button-gray" type="reset">Reset</button>
	</form>
</div>
		
<div class="columns">
	<h3>Month List
		<?php
		$MonthTotalRows = mysqli_fetch_assoc(Month_Select_Count_All());
		echo " : No. of Total Fees Catagory - ".$MonthTotalRows['total'];
		?>
	</h3>
	<hr />			
	<table class="paginate sortable full">
		<thead>
			<tr>
				<th width="43px" align="center">S.NO.</th>
				<th align="left">Month Name</th>
				<th align="left">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!$MonthTotalRows['total'])
				echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
			$Limit = 10;
			$total_pages = ceil($MonthTotalRows['total'] / $Limit);
			if(!$_GET['pageno'])
				$_GET['pageno'] = 1;
			
			$Start = ($_GET['pageno']-1)*$Limit;
			if($_GET['pageno']>=2)
				$i = $Start+1;
			else
				$i =1;
			$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
			$MonthRows = Month_Select_ByLimit($Start, $Limit);
			while($Month = mysqli_fetch_assoc($MonthRows))
			{
				echo "<tr style='valign:middle;'>
					<td align='center'>".$i++."</td>";
					echo "<td>".$Month['name']."</td>
					<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Month['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Month['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
				</tr>";
			} ?>
		</tbody>
	</table>
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
		if(document.getElementById("name").value.length < 2 || document.getElementById("name").value.length > 15)
			message = "Fees category name should be within 2 to 15 characters";
		if(document.getElementById("name").value == " ")
			message = "Please enter category name";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>