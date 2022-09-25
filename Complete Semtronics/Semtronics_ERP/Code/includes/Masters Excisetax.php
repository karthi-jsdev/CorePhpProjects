<section role="main" id="main">
	<div class="columns" style='width:902px;'>
	<?php
		if(isset($_POST['submit']))
		{
			if(empty($_POST['description']))
				echo 'cant allow';
			else
				Addexcise();
			$_POST['excisetax'] ="";
			$_POST['percent'] = "";
			$_POST['description'] = "";
			$message = "<br /><div class='message success'><b>Message</b> : Excisetax added successfully</div>";
		}
		if($_GET['action']=='Edit' && $_GET['id'])
		{
			$excise = mysql_fetch_Assoc(Selectexciseid());
			$_POST['excisetax'] = $excise['excisetax'];
			$_POST['percent'] = $excise['percent'];
			$_POST['description'] = $excise['description'];
		}
		if($_POST['update'])
		{
			Updateexcise();
			$message = "<br /><div class='message success'><b>Message</b> : Excisetax updated successfully</div>";
			$_POST['excisetax'] ="";
			$_POST['percent'] = "";
			$_POST['description'] = "";
		}
		if($_GET['action']=='Delete')
		{
			Deleteexcise();
			$message = "<br /><div class='message error'><b>Message</b> : Excisetax delete successfully</div>";
		}
	?>
	<?php echo $message;?>
		<form method="POST" name="form1" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel">
			<fieldset>
				<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
				<h3>Excise Tax</h3>
				<div class="clearfix">
					<label>Excise Tax<font color="red">*</font></label>
						<input type="text" autocomplete="off" id="excisetax" name="excisetax" required="required" value="<?php echo $_POST['excisetax']; ?>"/> <!-- onkeypress="return isAlphabetic(event)"-->
				</div>
				<div class="clearfix">
					<label>Percent<font color="red">*</font></label>
						<input type="text" autocomplete="off" id="percent" name="percent" required="required" value="<?php echo $_POST['percent']; ?>"/> <!-- onkeypress="return isAlphabetic(event)"-->
				</div>
				<div class="clearfix">
					<label>Description <font color="red">*</font></label>
					<textarea id="description" name="description" required="required" ><?php echo $_POST['description']; ?></textarea>
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
			<th>Excisetax</th>
			<th>Percent</th>
			<th>Description</th>
			<th align="left">Action</th>
		</tr>
	<?php
		$i=1;
		$tax = Selectexcise();
		while($excisetaxs = mysql_fetch_Assoc($tax))
		{
			echo '<tr>
					<td align="center">'.$i++.'</td>
					<td align="center">'.$excisetaxs['excisetax'].'</td>
					<td align="center">'.$excisetaxs['percent'].'</td>
					<td align="center">'.$excisetaxs['description'].'</td>
					<td><a href="?page=Masters&subpage=Stockmaster&innersubpage=Excisetax&action=Edit&id='.$excisetaxs['id'].'" class="action-button" title="user-edit"><span class="user-edit"></span></a>  &nbsp;<a href="?page=Masters&subpage=Stockmaster&innersubpage=Excisetax&action=Delete&id='.$excisetaxs['id'].'" onclick="return deleterows();" class="action-button" title="user-delete"><span class="user-delete"></span></a>&nbsp;</td>
				</tr>';
		}
	?>
	</table>
<script>
	function validation()
	{
		if(document.getElementById("excisetax").value==""||document.getElementById("excisetax").value==null)
			return alert('Enter excisetax');
		else if(document.getElementById("percent").value==""||document.getElementById("percent").value==null)
			return alert('Enter excisetax');
		else if(document.getElementById("description").value==""||document.getElementById("description").value==null)
			return alert('Enter excisetax');
	}
	function deleterows()
	{
		var x = confirm("Are you sure want to delete?");
		if(x==true){}
		else
			return false;
	}
</script>