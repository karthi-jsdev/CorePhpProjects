<section role="main" id="main">
	<?php
		$Columns = array("id", "name","categoryid");
		if($_GET['action'] == 'Edit')
		{
			$Class = mysql_fetch_assoc(Fees_particular_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Class[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Fees_particular_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Fees Particular deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$SubjectResource = Fees_particular_Select_ByNamePWD();
			if(isset($_POST['Submit']))
			{
				if(mysql_num_rows($SubjectResource))
					$message = "<br /><div class='message error'><b>Message</b> : This Fees Particular already exists</div>";
				else
				{
					Fees_particular_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Fees Particular added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				$Class = mysql_fetch_assoc($SubjectResource);
				if(mysql_num_rows(Fees_particular_Select_ByNamePWDId()))
					$message = "<br /><div class='message error'><b>Message</b> : This Fees Particular already exists</div>";
				else
				{
					Fees_particular_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Fees Particular details updated successfully</div>";
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
			<header><h2>Add Fees Particulars</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Category <font color="red">*</font></label>
					<select name="categoryid" id="categoryid">
						<option value="">Select</option>
						<?php
							$SelectCategory = Select_Category();
							while($FetchCategory  = mysql_fetch_array($SelectCategory))
							{
								if($FetchCategory['id']==$_POST['categoryid'])
									echo '<option value="'.$FetchCategory['id'].'" selected>'.$FetchCategory['name'].'</option>';
								else
									echo '<option value="'.$FetchCategory['id'].'">'.$FetchCategory['name'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="clearfix">
					<label>Particular Name <font color="red">*</font></label>
					<input type="text" id="name" name="name" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return AlphaNumCheck(event)"/>
				</div>
			</fieldset>
			<hr />
			<?php
			if($_GET['action'] == 'Edit')
				echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
			?><button class="button button-gray" type="reset" name="reset" onclick="Reset()">Reset</button>
		</form>
		</div>
		
		<div class="columns">
			<h3>Fees particular List
				<?php
				$Fees_particularTotalRows = mysql_fetch_assoc(Fees_particular_Select_Count_All());
				echo " : No. of Total Fees particular - ".$Fees_particularTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Category</th>
						<th align="left">Fees particular Name</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$Fees_particularTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($Fees_particularTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>=2)
						$i = $Start+1;
					else
						$i =1;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$Fees_particularRows = Fees_particular_Select_ByLimit($Start, $Limit);
					while($Fees_particular = mysql_fetch_assoc($Fees_particularRows))
					{
						$FetchCategoryById = mysql_fetch_array(FetchCategoryById($Fees_particular['categoryid']));
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$FetchCategoryById['name']."</td>
							<td>".$Fees_particular['name']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Fees_particular['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Fees_particular['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
		 if (charCode >= 44 && charCode <= 47) 
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
	function validation()
	{
		var message = "";
		if(document.getElementById("name").value.length < 2 || document.getElementById("name").value.length > 15)
			message = "Fees particular should be within 2 to 15 characters";
		if(document.getElementById("categoryid").value =="")
			message = "Please select fees category";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	function Reset()
	{
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&innersubpage=<?php echo $_GET['innersubpage']; ?>");
	}
</script>