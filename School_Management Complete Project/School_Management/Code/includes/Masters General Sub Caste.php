<section role="main" id="main">
	<?php
		$Columns = array("id", "name","castid");
		if($_GET['action'] == 'Edit')
		{
			$Class = mysqli_fetch_assoc(SubCaste_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Class[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			SubCaste_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One SubCaste deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$ClassResource = SubCaste_Select_ByNamePWD();
			if(isset($_POST['Submit']))
			{
				if(mysqli_num_rows($ClassResource))
					$message = "<br /><div class='message error'><b>Message</b> : This SubCaste already exists</div>";
				else
				{
					SubCaste_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : SubCaste added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				$Class = mysqli_fetch_assoc($ClassResource);
				if(mysqli_num_rows(SubCaste_Select_ByNamePWDId()))
					$message = "<br /><div class='message error'><b>Message</b> : This SubCaste already exists</div>";
				else
				{
					SubCaste_Update();
					$message = "<br /><div class='message success'><b>Message</b> : SubCaste details updated successfully</div>";
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
			<header><h2>Add SubCaste </h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>SubCaste  <font color="red">*</font></label>
					<input type="text" id="classname" name="classname" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return AlphaNumCheck(event)"/>
				</div>
				<div class="clearfix">
					<label>Community  <font color="red">*</font></label>
					<select id="caste" name="caste">
						<option value="">Select</option>
						<?php
							$SelectCaste = mysqli_query($_SESSION['connection'],"select * from community");
							while($FetchCaste = mysqli_fetch_array($SelectCaste))
							{
								if($_POST['castid']==$FetchCaste['id'])
									echo '<option value="'.$FetchCaste['id'].'" selected>'.$FetchCaste['name'].'</option>';
								else
									echo '<option value="'.$FetchCaste['id'].'">'.$FetchCaste['name'].'</option>';
							}
						?>
					</select>
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
			<h3>SubCaste List
				<?php
				$SubCasteTotalRows = mysqli_fetch_assoc(SubCaste_Select_Count_All());
				echo " : No. of Total SubCaste - ".$SubCasteTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">SubCaste</th>
						<th align="left">Community</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$SubCasteTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($SubCasteTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$Start = ($_GET['pageno']-1)*$Limit;
					$i = 0;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$SubCasteRows = SubCaste_Select_ByLimit($Start, $Limit);
					while($SubCaste = mysqli_fetch_assoc($SubCasteRows))
					{
						$FetchCste = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"select * from community where id='".$SubCaste['castid']."'"));
						echo "<tr style='valign:middle;'>
							<td align='center'>".++$i."</td>
							<td>".$SubCaste['name']."</td>
							<td>".$FetchCste['name']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$SubCaste['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$SubCaste['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
		 if (charCode >= 43 && charCode <= 47) 
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
		if(document.getElementById("caste").value == "")
			message = "Please select caste";
		if(document.getElementById("classname").value.length < 2 || document.getElementById("classname").value.length > 15)
			message = "Sub caste should be within 2 to 15 characters";	
		if(document.getElementById("classname").value == " ")
			message = "Please enter sub caste";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>