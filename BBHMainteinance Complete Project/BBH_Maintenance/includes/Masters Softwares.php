<section class="grid_6 first">
	<?php
		$Columns = array("id", "name");
		$_POST['name'] = $_POST['softwarename'];
		if($_GET['action'] == 'Edit')
		{
			$Software = mysqli_fetch_assoc(Software_Select_ById($_GET['id']));
			foreach($Columns as $Col)
				$_POST[$Col] = $Software[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Software_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Software deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if(mysqli_num_rows(Software_Select_ByName($_POST['name'])))
				$message = "<br /><div class='message error'><b>Message</b> : This Software already exists</div>";
			else
			{
				if(isset($_POST['Submit']))
				{
					Software_Insert($_POST['name']);
					$message = "<br /><div class='message success'><b>Message</b> : Added successfully</div>";
				}
				else if(isset($_POST['Update']))
				{
					Software_Update($_POST['name'], $_POST['id']);
					$message = "<br /><div class='message success'><b>Message</b> : Software details updated successfully</div>";
				}
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns">
		<?php echo $message; ?>
		<div class="grid_6 first">
			<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel">
				<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
				<header><h2>Add Software</h2></header>
				<hr />				
				<fieldset>
					<div class="clearfix">
                        <label>Software Name <font color="red">*</font></label>
						<input type="text" name="softwarename" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
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
			<h3>Software List
			<?php
			$SoftwareTotalRows = mysqli_num_rows(Software_Select_All());
			echo " : No. of total Softwares - ".$SoftwareTotalRows;
			?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="70px" align="center">S.NO.</th>
						<th align="left">Software Name</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$SoftwareTotalRows)
						echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($SoftwareTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$SoftwareRows = Software_Select_ByLimit($Start, $Limit);
					while($Software = mysqli_fetch_assoc($SoftwareRows))
					{
						echo "<tr>
						<td align='center'>".$i++."</td>
						<td>".$Software['name']."</td>
						<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Software['id']."&pageno=".$_GET['pageno']."&action=Edit' >Edit</a> | <a href='#' onclick='deleterow(".$Software['id'].")'>Delete</a></td>
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