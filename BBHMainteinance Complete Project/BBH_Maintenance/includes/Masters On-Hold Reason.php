<section class="grid_6 first">
	<?php
		$Columns = array("id", "name");
		$_POST['name'] = $_POST['reasonname'];
		if($_GET['action'] == 'Edit')
		{
			$Reason = mysqli_fetch_assoc(Reason_Select_ById($_GET['id']));
			foreach($Columns as $Col)
				$_POST[$Col] = $Reason[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Reason_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Hold Reason deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if(mysqli_num_rows(Zone_Select_ByName($_POST['name'])))
				$message = "<br /><div class='message error'><b>Message</b> : This Hold Reason already exists</div>";
			else
			{
				if(isset($_POST['Submit']))
				{
					Reason_Insert($_POST['name']);
					$message = "<br /><div class='message success'><b>Message</b> : Added successfully</div>";
				}
				else if(isset($_POST['Update']))
				{
					Reason_Update($_POST['name'], $_POST['id']);
					$message = "<br /><div class='message success'><b>Message</b> : Hold Reason details updated successfully</div>";
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
				<header><h2>Add Reason</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>Category <font color="red">*</font></label>
						<input type="text" style="width: 250px;" name="reasonname" id="reasonname" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
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
			<h3>Reason List
			<?php
			$ReasonTotalRows = mysqli_num_rows(Reason_Select_All());
			echo " : No. of total Reasons - ".$ReasonTotalRows;
			?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">Reason</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$ReasonTotalRows)
						echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($ReasonTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$ReasonRows = Reason_Select_ByLimit($Start, $Limit);
					while($Reason = mysqli_fetch_assoc($ReasonRows))
					{
						echo "<tr>
						<td align='center'>".$i++."</td>
						<td>".$Reason['name']."</td>
						<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Reason['id']."&pageno=".$_GET['pageno']."&action=Edit' >Edit</a> | <a href='#' onclick='deleterow(".$Reason['id'].")'>Delete</a></td>
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
		if(document.getElementById('reasonname').value.length < 2 || document.getElementById('reasonname').value.length > 35)
			message = "Category should be within 2 to 35 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>