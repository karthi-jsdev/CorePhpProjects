<section role="main" id="main">
	<?php
		$Columns = array("id", "name");
		if($_GET['action'] == 'Edit')
		{
			$Credit = mysqli_fetch_assoc(ProductCategories_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Credit[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			ProductCategories_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : Product Category deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
				$ProductCategoriesResource = ProductCategories_Select_ByNamePWD();
				if(isset($_POST['Submit']))
				{
					if(mysqli_num_rows($ProductCategoriesResource))
						$message = "<br /><div class='message error'><b>Message</b> : Product Category already exists</div>";
					else
					{
						ProductCategories_Insert();
						$message = "<br /><div class='message success'><b>Message</b> : Product Category added successfully</div>";
					}
				}
				else if(isset($_POST['Update']))
				{
					$ProductCategories = mysqli_fetch_assoc($ProductCategoriesResource);
					if(mysqli_num_rows(ProductCategories_Select_ByNamePWDId()))
						$message = "<br /><div class='message error'><b>Message</b> : This Product Category already exists</div>";
					else
					{
						ProductCategories_Update();
						$message = "<br /><div class='message success'><b>Message</b> : Product Category details updated successfully</div>";
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
			<header><h2>Add Product Category</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Product Category <font color="red">*</font></label>
					<input type="text" id="name" autocomplete="off" name="name" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return isAlphabetic(event)"/>
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
				$ProductCategoriesTotalRows = mysqli_fetch_assoc(ProductCategories_Select_Count_All());
				echo "Total No. of Product Category - ".$ProductCategoriesTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Status</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$ProductCategoriesTotalRows['total'])
						echo '<tr><td colspan="3"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($ProductCategoriesTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$ProductCategoriesRows = ProductCategories_Select_ByLimit($Start, $Limit);
					while($ProductCategories = mysqli_fetch_assoc($ProductCategoriesRows))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$ProductCategories['name']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$ProductCategories['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$ProductCategories['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
		if(charCode == 8 || charCode == 9 || charCode == 35 || charCode == 36 || charCode == 46 )
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122 || charCode ==32 )
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8 || charCode == 9 || charCode == 35 || charCode == 36 || charCode == 46 )
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	
	function validation()
	{
		var message = "";
		if(document.getElementById("name")==0)
			message = "Please Enter the ProductCategory";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>