<?php
	require("Config.php");
	require("Announcements_Queries.php");
	require("Maintenance.php");
	date_default_timezone_set('Asia/Kolkata');
	ini_set("display_errors","0");
	$Columns = array("id", "title","description");
	if($_GET['action'] == 'Edit')
	{
		$Announcements = mysql_fetch_assoc(Announcements_Select_ById());
		foreach($Columns as $Col)
			$_POST[$Col] = $Announcements[$Col];
	}
	else if($_GET['action'] == 'Delete')
	{
		Announcements_Delete_ById($_GET['id']);
		$message = "<br /><div class='message success'><b>Message</b> : One Item deleted successfully</div>";
	}
	if(isset($_POST['Submit']) || isset($_POST['Update']))
	{
		$AnnouncementsResource = Announcements_Select_ByNamePWD();
		if(isset($_POST['Submit']))
		{
			if(mysql_num_rows($AnnouncementsResource))
				$message = "<br /><div><b>Message</b> : This Announcements Title already exists</div>";
			else
			{
				Announcements_Insert();
				$message = "<br /><div><b>Message</b> : Announcements name added successfully</div>";
			}
		}
		else if(isset($_POST['Update']))
		{
			$Announcements = mysql_fetch_assoc($AnnouncementsResource);
			if(mysql_num_rows(Announcements_Select_ByNamePWDId()))
				$message = "<br /><div><b>Message</b> : This Announcements Title already exists</div>";
			else
			{
				Announcements_Update();
				$message = "<br /><div><b>Message</b> : Announcements details updated successfully</div>";
				header("Location:?page=Manage Announcements");
			}
		}
		foreach($Columns as $Col)
			$_POST[$Col] = "";
	}
?>
<div class='content-bottom'>
	<div class='section group' align='center'>
		<?php echo $message; ?>
		<form id="form" method="post" action="#">
			<table>
				<tr>
					<p>
						<td><label>Title <font color="red">*</font></label></td>
						<td><input type='text' name='anouncementitle' id='title' style='width:450px;' value="<?php echo $_POST['title'];?>"/></td>
					</p>
				</tr>
				<tr>
					<p>
						<td><label>Content <font color="red">*</font></label></td>
						<td><textarea name='content' id='content' style='width:300px;'><?php echo $_POST['description'];?></textarea></td>
					</p>
				</tr>
				<tr>
					<p>
						<center>
						<?php 
						if($_GET['action'] != 'Edit')
							echo '<td><input type="submit" name="Submit" value="Submit"/></td>';
						else	
							echo '<td><input type="submit" name="Update" value="Update"/></td>';
						?>
						</center>
					</p>
				</tr>
			</table>	
		</form>
	</div>
</div>
<div class="content-bottom">
	<div class="wrap">
		<div class="section group" align="center">
			<table border='1' width='900px;'>
				<thead style="color:black;font-weight:bold;">
					<tr>
						<td>S.No.</td>
						<td>Title</td>
						<td>Content</td>
						<td>Create at</td>
						<td>Action</td>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 1;
						if(mysql_num_rows(Announcements()) == 0)
							echo "<tr><td colspan='5' align='center'>No Data Found</td></tr>";
						$Announcements = Announcements();
						while($FetchAnnouncements = mysql_fetch_array($Announcements))
						{
							echo "<tr>
								 <td>".$i++."</td>
								 <td>".$FetchAnnouncements['title']."</td>
								 <td>".$FetchAnnouncements['description']."</td>
								 <td>".$FetchAnnouncements['created_at']."</td>
								 <td><a href='index.php?page=Manage Announcements&id=".$FetchAnnouncements['id']."&action=Edit' >Edit</a> | <a href='#' onclick='deleterow(".$FetchAnnouncements['id'].")'>Delete</a></td>
							</tr>";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
function deleterow(id)
{
	var r = confirm("Are you sure, Do you really want to delete this record?");
	if(r == true)
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&id="+id+"&action=Delete");
}
</script>