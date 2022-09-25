<section role="main" id="main">
	<?php
		$Columns = array("id", "name", "discount", "categoryid", "studentcategoryid","mode");
		if($_GET['action'] == 'Edit')
		{
			$Class = mysql_fetch_assoc(Discount_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Class[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Discount_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : Discount deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			
			if(isset($_POST['Submit']))
			{
				if(mysql_num_rows(Discount_Select_ByNamePWD()))
					$message = "<br /><div class='message error'><b>Message</b> : This Discount name already exists</div>";
				else
				{
					Discount_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Discount  added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				if(mysql_num_rows(Discount_Select_ByNamePWDId()))
					$message = "<br /><div class='message error'><b>Message</b> : This Discount name already exists</div>";
				else
				{
					Discount_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Discount details updated successfully</div>";
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
			<header><h2>Create Discount </h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Discount Name <font color="red">*</font>
						<input type="text" name="name" id="name" value="<?php echo $_POST['name']; ?>" required="required" onkeypress="return AlphaNumCheck(event)">
					</label>
					<label>
						Category <font color="red">*</font>
						<select name="fees_categoryid" id="fees_categoryid">
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
					</label>
					<label>
						Student Category <font color="red">*</font>
						<select name="student_categoryid" id="student_categoryid" >
							<option value="">Select</option>
							<?php
								$SelectStudentCategory = Select_StudentCategory();
								while($FetchStudentCategory  = mysql_fetch_array($SelectStudentCategory))
								{
									if($FetchStudentCategory['id']==$_POST['studentcategoryid'])
										echo '<option value="'.$FetchStudentCategory['id'].'" selected>'.$FetchStudentCategory['name'].'</option>';
									else
										echo '<option value="'.$FetchStudentCategory['id'].'">'.$FetchStudentCategory['name'].'</option>';
								}
							?>
						</select>
					</label>
				</div>
				<div class="clearfix">
					<label>Discount <font color="red">*</font>
						<input type="text" name="discount" id="discount" required="required" value="<?php echo $_POST['discount']; ?>" onkeypress="return isNumeric(event)">
					</label>
					Mode <font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
						<?php
							$Mode = array("Percentage","Amount");
							$i=0;
							foreach($Mode as $M)
							{
								if($_POST['mode']==$i && $_GET['action'])
									echo '<span class="radio-input"><input type="radio" name="mode" value="'.$i.'"  id="mode" checked>'.$M.'</input></span>';
								else
									echo '<span class="radio-input"><input type="radio" name="mode" value="'.$i.'"  id="mode">'.$M.'</input></span>';
								$i++;
							}
						?>
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
			<h3>Discount List
				<?php
				$DiscountTotalRows = mysql_fetch_assoc(Discount_Select_Count_All());
				echo " : No. of Total Discount - ".$DiscountTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Catagory</th>
						<th align="left">Name</th>
						<th align="left">Discount</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$DiscountTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($DiscountTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>=2)
						$i = $Start+1;
					else
						$i =1;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$DiscountRows = Discount_Select_ByLimit($Start, $Limit);
					while($Discount = mysql_fetch_assoc($DiscountRows))
					{
						$FetchCategory = mysql_fetch_array(FetchCategoryById($Discount['categoryid']));
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$FetchCategory['name']."</td>
							<td>".$Discount['name']."</td>
							<td>".$Discount['discount']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Discount['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Discount['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
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
		var Mode = document.getElementsByName("mode");
		var flag = 0,mode_val=3;
		for (var i = 0; i< Mode.length; i++)
		{
			if(Mode[i].checked)
			{
				mode_val = Number(Mode[i].value);
				flag++;
			}
		}
		if(mode_val == 0)
		{
			if(document.getElementById("discount").value > 100)
				message = "Discount is not more than 100%";
		}
		if(!flag)
			message = "please select mode";
		if(document.getElementById("student_categoryid").value=="")
			message = "Please select student category";
		if(document.getElementById("fees_categoryid").value=="")
			message = "Please select fees category";
		if(document.getElementById("name").value.length < 2 || document.getElementById("name").value.length > 15)
			message = "Discount name should be within 2 to 15 characters";
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