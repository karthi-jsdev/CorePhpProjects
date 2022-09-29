<section role="main" id="main">
	<?php
		$Columns = array("id", "name", "prefix");
		if($_GET['action'] == 'Edit')
		{
			$Category = mysqli_fetch_assoc(Category_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Category[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			RMCate_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Product Category deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if(isset($_POST['Submit']))
			{
				if(mysqli_num_rows(Category_Select_ByName()))
					$message = "<br /><div class='message error'><b>Message</b> : This product category name already exists</div>";
				else if(mysqli_num_rows(Category_Select_ByPrefix()))
					$message = "<br /><div class='message error'><b>Message</b> : This product category prefix already exists</div>";
				else
				{
					Category_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Product Category added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				if(mysqli_num_rows(Category_Select_ByNameUpdate()))
					$message = "<br /><div class='message error'><b>Message</b> : This product category name already exists</div>";
				else if(mysqli_num_rows(Category_Select_ByPrefixUpdate()))
					$message = "<br /><div class='message error'><b>Message</b> : This product category prefix already exists</div>";
				else
				{
					Category_Update();
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
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
			<header><h2>Add Category</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Category <font color="red">*</font></label>
					<input type="text" id="name" maxlength="20" autocomplete="off" name="name" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return AlphaNumCheck(event)"/> <!-- onkeypress="return isAlphabetic(event)"-->
				</div>
				<div class="clearfix">
					<label>Code Prefix <font color="red">*</font></label>
					<input type="text" id="prefix"  maxlength="10" autocomplete="off" name="prefix" required="required" value="<?php echo $_POST['prefix']; ?>" onkeypress="return AlphaNumCheck(event)" /> <!--onkeypress="return isAlphabetic(event)"-->
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
				$CategoryTotalRows = mysqli_fetch_assoc(Category_Select_Count_All());
				echo "Total No. of RM-Category - ".$CategoryTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Category</th>
						<th align="left">Prefix</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$CategoryTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($CategoryTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$CategoryRows = Category_Select_ByLimit($Start, $Limit);
					while($Category = mysqli_fetch_assoc($CategoryRows))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$Category['name']."</td>
							<td>".$Category['prefix']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Category['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Category['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8 || charCode == 32) 
			return true;
        var keynum;
        var keychar;
        var charcheck = /[a-zA-Z0-9]/;
        if(window.event)
        {
            keynum = e.keyCode;
        }
        else
		{
            if(e.which)
            {
                keynum = e.which;
            }
            else 
				return true;
        }

        keychar = String.fromCharCode(keynum);
        return charcheck.test(keychar);
    }
</script>