<section role="main" id="main">
	<?php
		$Columns = array("id", "code", "description");
		if($_GET['action'] == 'Edit')
		{
			$Work = mysql_fetch_assoc(Work_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Work[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Work_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : Work deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
				$WorkResource = Work_Select_ByNamePWD();
				if(isset($_POST['Submit']))
				{
					if(mysql_num_rows($WorkResource))
						$message = "<br /><div class='message error'><b>Message</b> : This Work already exists</div>";
					else
					{
						Work_Insert();
						$message = "<br /><div class='message success'><b>Message</b> : Work added successfully</div>";
					}
				}
				else if(isset($_POST['Update']))
				{
					$Work = mysql_fetch_assoc($WorkResource);
					if(mysql_num_rows(Work_Select_ByNamePWDId()))
						$message = "<br /><div class='message error'><b>Message</b> : This Work already exists</div>";
					else
					{
						Work_Update();
						$message = "<br /><div class='message success'><b>Message</b> : Work details updated successfully</div>";
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
			<header><h2>Add Work</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Code <font color="red">*</font></label>
					<input type="text" id="code" name="code" required="required" value="<?php echo $_POST['code']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
				</div>
				<div class="clearfix">
					<label>Work Description <font color="red">*</font></label>
					<textarea cols="100" id="description"  name="description" required="required"><?php echo $_POST['description']; ?></textarea>
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
			<h3>Work List
				<?php
				$WorkTotalRows = mysql_fetch_assoc(Work_Select_Count_All());
				echo " : No. of total Works - ".$WorkTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Code</th>
						<th align="left">Work Description</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$WorkTotalRows['total'])
						echo '<tr><td colspan="4"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($WorkTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$WorkRows = Work_Select_ByLimit($Start, $Limit);
					while($Work = mysql_fetch_assoc($WorkRows))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$Work['code']."</td>
							<td>".$Work['description']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Work['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Work['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
		if (charCode == 8 || charCode == 9  || charCode == 46  || charCode == 32 ||charCode == 38 ||charCode == 37 ||charCode == 39 || charCode == 45 || charCode == 41 || charCode == 40 || charCode == 63 || charCode == 95) 
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8 || charCode == 9)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	
	function validation()
	{
		var message = "";
		if(document.getElementById("description")==0)
			message = "Please Enter the description";
		if(document.getElementById("code")==0)
			message = "Please Enter The code";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8 || charCode == 9  || charCode == 46  || charCode == 32 ||charCode == 38 ||charCode == 37 ||charCode == 39 || charCode == 45 || charCode == 41 || charCode == 40 || charCode == 63 || charCode == 95) 
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
	function percentage(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(document.getElementById("percent").value.indexOf('.') >= 0 && charCode == 46)
			return false
		if(Number(document.getElementById("percent").value+''+String.fromCharCode(charCode)) > 100)
			return false
		if(charCode == 46)
			return true;
		
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
</script>