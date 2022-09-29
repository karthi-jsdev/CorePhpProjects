<section role="main" id="main">
	<div class="columns" style='width:902px;'>
	<?php
		if(isset($_POST['submit']))
		{
			Addissuanceuser();
			$_POST['issuanceuser'] ="";
			$message = "<br /><div class='message success'><b>Message</b> : Issuance User added successfully</div>";
		}
		if($_GET['action']=='Edit' && $_GET['id'])
		{
			$issuanceuser = mysqli_fetch_assoc(Selectissuanceuserid());
			$_POST['issuanceuser'] = $issuanceuser['issuanceuser'];
		}
		if($_POST['update'])
		{
			Updateissuanceuser();
			$message = "<br /><div class='message success'><b>Message</b> : Issuance User updated successfully</div>";
			$_POST['issuanceuser'] ="";
		}
		if($_GET['action']=='Delete')
		{
			Deleteissuanceuser();
			$message = "<br /><div class='message success'><b>Message</b> : Issuance User delete successfully</div>";
		}
	?>
	<?php echo $message;?>
		<form method="POST" name="form1" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel">
			<fieldset>
				<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
				<h3>Issuance User</h3>
				<div class="clearfix">
					<label><strong>Issuance User</strong><font color="red">*</font>
						<input type="text" autocomplete="off" id="issuanceuser" name="issuanceuser" required="required" value="<?php echo $_POST['issuanceuser']; ?>"/> <!-- onkeypress="return isAlphabetic(event)"-->
					</label>
				</div>
		<?php
		if($_GET['action']=='Edit')
			echo'<input type="submit" class="button button-green" name="update" id="update" value="Update" onclick="validation();">';
		else
			echo'<input type="submit" class="button button-green" name="submit" id="submit" value="Submit" onclick="validation();">';
		?>
			</fieldset>
		</form>
	</div>
</section>
	<table class="paginate sortable full">
		<tr>
			<th>SlNo.</th>
			<th>User</th>
			<th align="left">Action</th>
		</tr>
	<?php
		$i=1;
		$users = Selectissuanceuser();
		while($issuanceusers = mysqli_fetch_assoc($users))
		{
			echo '<tr>
					<td align="center">'.$i++.'</td>
					<td align="center">'.$issuanceusers['issuanceuser'].'</td>
					<td><a href="?page=Masters&subpage=Stockmaster&innersubpage=Issuanceuser&action=Edit&id='.$issuanceusers['id'].'" class="action-button" title="user-edit"><span class="user-edit"></span></a>  &nbsp;<a href="?page=Masters&subpage=Stockmaster&innersubpage=Issuanceuser&action=Delete&id='.$issuanceusers['id'].'" onclick="return deleterows();" class="action-button" title="user-delete"><span class="user-delete"></span></a>&nbsp;</td>
				</tr>';
		}
	?>
	</table>
	<div class="clear">&nbsp;</div>
	<?php
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
<script>
	function validation()
	{
		if(document.getElementById("issuanceuser").value==""||document.getElementById("issuanceuser").value==null)
			return alert('Enter Issuance User');
	}
	function deleterows()
	{
		var x = confirm("Are you sure want to delete?");
		if(x==true){}
		else
			return false;
	}
</script>