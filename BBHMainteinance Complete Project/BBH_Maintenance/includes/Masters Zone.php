<section class="grid_6 first">
	<?php
		$Columns = array("id", "name");
		$_POST['name'] = $_POST['zonename'];
		if($_GET['action'] == 'Edit')
		{
			$Zone = mysqli_fetch_assoc(Zone_Select_ById($_GET['id']));
			foreach($Columns as $Col)
				$_POST[$Col] = $Zone[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Zone_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One zone deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if(mysqli_num_rows(Zone_Select_ByName($_POST['name'])))
				$message = "<br /><div class='message error'><b>Message</b> : This zone already exists</div>";
			else
			{
				if(isset($_POST['Submit']))
				{
					Zone_Insert($_POST['name']);
					$message = "<br /><div class='message success'><b>Message</b> : Added successfully</div>";
				}
				else if(isset($_POST['Update']))
				{
					Zone_Update($_POST['name'], $_POST['id']);
					$message = "<br /><div class='message success'><b>Message</b> : Zone details updated successfully</div>";
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
				<header><h2>Add Zone</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>Zone Name <font color="red">*</font></label>
						<input type="text" name="zonename" id="zonename" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
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
			<h3>Zone List
			<?php
			$ZoneTotalRows = mysqli_num_rows(Zone_Select_All());
			echo " : No. of total Zones - ".$ZoneTotalRows;
			?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">Zone Name</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$ZoneTotalRows)
						echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($ZoneTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$ZoneRows = Zone_Select_ByLimit($Start, $Limit);
					while($Zone = mysqli_fetch_assoc($ZoneRows))
					{
						echo "<tr>
						<td align='center'>".$i++."</td>
						<td>".$Zone['name']."</td>
						<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Zone['id']."&pageno=".$_GET['pageno']."&action=Edit' >Edit</a> | <a href='#' onclick='deleterow(".$Zone['id'].")'>Delete</a></td>
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
		if(document.getElementById("zonename").value.length < 2 || document.getElementById("zonename").value.length > 15)
			message = "Zone Name should be within 2 to 15 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>