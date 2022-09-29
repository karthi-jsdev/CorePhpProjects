<section role="main" id="main">
	<?php
		$Columns = array("id", "name");
		if($_GET['action'] == 'Edit')
		{
			$Class = mysqli_fetch_assoc(Nationality_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Class[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Nationality_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Nationality deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$ClassResource = Nationality_Select_ByNamePWD();
			if(isset($_POST['Submit']))
			{
				if(mysqli_num_rows($ClassResource))
					$message = "<br /><div class='message error'><b>Message</b> : This Nationality already exists</div>";
				else
				{
					Nationality_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Nationality added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				$Class = mysqli_fetch_assoc($ClassResource);
				if(mysqli_num_rows(Nationality_Select_ByNamePWDId()))
					$message = "<br /><div class='message error'><b>Message</b> : This Nationality already exists</div>";
				else
				{
					Nationality_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Nationality details updated successfully</div>";
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
			<header><h2>Add Nationality </h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Nationality  <font color="red">*</font></label>
					<input type="text" id="classname" name="classname" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return isAlphabetic(event)"/>
				</div>
			</fieldset>
			<hr />
			<?php
			if($_GET['action'] == 'Edit')
				echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
			?><button class="button button-gray" type="reset">Reset</button>
		</form>
		</div>
		
		<div class="columns">
			<h3>Nationality List
				<?php
				$NationalityTotalRows = mysqli_fetch_assoc(Nationality_Select_Count_All());
				echo " : No. of Total Nationalities - ".$NationalityTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Nationality</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$NationalityTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($NationalityTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>=2)
						$i = $Start+1;
					else
						$i =1;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$NationalityRows = Nationality_Select_ByLimit($Start, $Limit);
					while($Nationality = mysqli_fetch_assoc($NationalityRows))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$Nationality['name']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Nationality['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Nationality['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
	
	function validation()
	{
		var message = "";
		if(document.getElementById("classname").value.length < 2 || document.getElementById("classname").value.length > 15)
			message = "Nationality should be within 2 to 15 characters";	
		if(document.getElementById("classname").value == " ")
			message = "Please enter Nationality";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>