<section class="grid_6 first">
	<?php
		$Columns = array("id", "make");
		if($_GET['action'] == 'Edit')
		{
			$Item = mysqli_fetch_assoc(Make_Select_ById($_GET['id']));
			foreach($Columns as $Col)
				$_POST[$Col] = $Item[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Make_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Biomedical Make deleted successfully</div>";
		}
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if(mysqli_num_rows(Make_Select_ByName($_POST['make'])))
				$message = "<br /><div class='message error'><b>Message</b> : This Biomedical Make already exists</div>";
			else
			{
				if(isset($_POST['Submit']))
				{
					Make_Insert($_POST['make']);
					$message = "<br /><div class='message success'><b>Message</b> : Biomedical Make Added successfully</div>";
				}
				else if(isset($_POST['Update']))
				{
					Make_Update($_POST['make'], $_POST['id']);
					$message = "<br /><div class='message success'><b>Message</b> : Biomedical Make details updated successfully</div>";
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
				<header><h2>Add Biomedical Make</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>Biomedical Item Name <font color="red">*</font></label>
						<input type="text" name="make" id="make" required="required" value="<?php echo $_POST['make']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
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
			<h3>Biomedical Item List
			<?php
			$ItemTotalRows = mysqli_num_rows(Make_Select_All());
			echo " : No. of total Biomedical Make - ".$ItemTotalRows;
			?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">Make</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$ItemTotalRows)
						echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($ItemTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$SystemRows = Make_Select_ByLimit($Start, $Limit);
					while($System = mysqli_fetch_assoc($SystemRows))
					{
						echo "<tr>
						<td align='center'>".$i++."</td>
						<td>".$System['make']."</td>
						<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$System['id']."&pageno=".$_GET['pageno']."&action=Edit' >Edit</a> | <a href='#' onclick='deleterow(".$System['id'].")'>Delete</a></td>
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
	function validation()
	{
		var message = "";
		if(document.getElementById('make').value.length < 2 || document.getElementById('make').value.length > 15)
			message = "Biomedical make Name should be within 2 to 15 characters";
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
</script>