<section class="grid_6 first">
	<?php
		$Columns = array("id", "breakdowncategory");
		if($_GET['action'] == 'Edit')
		{
			$breakdowncategory = mysqli_fetch_assoc(breakdowncategory_Select_ById($_GET['id']));
			foreach($Columns as $Col)
				$_POST[$Col] = $breakdowncategory[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			breakdowncategory_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One breakdowncategory deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if(mysqli_num_rows(breakdowncategory_Select_ByName()))
				$message = "<br /><div class='message error'><b>Message</b> : This breakdowncategory already exists</div>";
			else
			{
				if(isset($_POST['Submit']))
				{
					breakdowncategory_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Added successfully</div>";
				}
				else if(isset($_POST['Update']))
				{
					breakdowncategory_Update();
					$message = "<br /><div class='message success'><b>Message</b> : breakdowncategory details updated successfully</div>";
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
				<header><h2>Add Breakdowncategory</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>Breakdowncategory <font color="red">*</font></label>
						<input type="text" name="breakdowncategory" id="breakdowncategory" required="required" value="<?php echo $_POST['breakdowncategory']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
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
			<h3>breakdowncategory List
			<?php
			$breakdowncategoryTotalRows = mysqli_num_rows(breakdowncategory_Select_All());
			echo " : No. of total breakdowncategories - ".$breakdowncategoryTotalRows;
			?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">breakdowncategory Name</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$breakdowncategoryTotalRows)
						echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($breakdowncategoryTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$breakdowncategoryRows = breakdowncategory_Select_ByLimit($Start, $Limit);
					while($breakdowncategory = mysqli_fetch_assoc($breakdowncategoryRows))
					{
						echo "<tr>
						<td align='center'>".$i++."</td>
						<td>".$breakdowncategory['breakdowncategory']."</td>
						<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$breakdowncategory['id']."&pageno=".$_GET['pageno']."&action=Edit' >Edit</a> | <a href='#' onclick='deleterow(".$breakdowncategory['id'].")'>Delete</a></td>
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
		if(document.getElementById('breakdowncategory').value.length < 2 || document.getElementById('breakdowncategory').value.length > 15)
			message = "breakdowncategory Name should be within 2 to 15 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>