<section role="main" id="main">
	<?php
	$Columns = array("id", "news","enable");
	if($_GET['index'])
	{
		$Fetch = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"select * from news where id='".$_GET['id']."'"));
		$_POST['news'] = explode('`',$Fetch['news']);
		$Abc = array();
		for($i=0;$i<count($_POST['news']);$i++)
			if($i!=$_GET['index'])
				$Abc[$i] = $_POST['news'][$i];
		mysqli_query($_SESSION['connection'],"update news set news='".implode($Abc,'`')."'  where id='".$_GET['id']."'");
	}
	if($_GET['action'] == 'Edit')
	{
		$Credit = mysqli_fetch_assoc(News_Select_ById());
		foreach($Columns as $Col)
			$_POST[$Col] = $Credit[$Col];
		if($_POST['news'])
			$_POST['news'] = explode('`',$_POST['news']);
	}
	else if($_GET['action'] == 'Delete')
	{
		News_Delete_ById($_GET['id']);
		$message = "<br /><div class='message success'><b>Message</b> : News deleted successfully</div>";
	}
	
	if(isset($_POST['Submit']) || isset($_POST['Update']))
	{
			if($_POST['enable'])
				mysqli_query($_SESSION['connection'],"update news set enable='0'");
			//$NewsResource = News_Select_ByNamePWD();
			if(isset($_POST['Submit']))
			{
				News_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : News added successfully</div>";
			}
			else if(isset($_POST['Update']))
			{
				/*$News = mysqli_fetch_assoc($NewsResource);
				if(mysqli_num_rows(News_Select_ByNamePWDId()))
					$message = "<br /><div class='message error'><b>Message</b> : This Opportunity Status already exists</div>";
				else if(mysqli_num_rows(News_Select_Bysortorder()))
					$message = "<br /><div class='message error'><b>Message</b> : This Opportunity Status Sort Order already exists</div>";
				else
				{*/
					News_Update();
					$message = "<br /><div class='message success'><b>Message</b> : News details updated successfully</div>";
				//}
			}
		foreach($Columns as $Col)
			$_POST[$Col] = "";
	} ?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
			<header><h2>Add News</h2></header>
			<hr />				
			<fieldset>
				
					<div class="clearfix">
						<label>News <font color="red">*</font></label>
						<textarea id="news" name="news[]" required="required"><?php echo $_POST['news'][0]; ?></textarea>
						<a style="padding-left:20px" href="#" id="AddMoreFileBox" class="addmore"><img src="images/Add.PNG" title="Add Files"></a>
					</div>
				
				<?php
					if($_GET['id'])
					{
						for($i=1;$i<count($_POST['news']);$i++)
							echo '<div class="clearfix"><label>News '.($i+1).'<font color="red">*</font></label><textarea id="news" name="news[]" required="required">'.$_POST['news'][$i].'</textarea><a href="index.php?page=Masters&subpage=News&id='.$_GET['id'].'&index='.$i.'&action=Edit" id=""><img src="images/overlay/close.png" border="0" height="25" width="25"/></a></div>';
					}
				?>
				<div id="AddFileInputBox"></div>
				<div class="clearfix">
					<label>Enable/Disable </label>
					<?php 
						if($_POST['enable'])
							echo '<input type="checkbox" name="enable" value="1" checked></input><br>';
						else
							echo '<input type="checkbox" name="enable" value="1"></input><br>';
					?>		
				</div>
			</fieldset>
			<hr />
			<?php
			if($_GET['action'] == 'Edit')
				echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
			?>
			<button class="button button-gray"  onclick="autoclear()" type="reset">Reset</button>
		</form>
		</div>
		
		<div class="columns">
			<h3>
				<?php
				$NewsTotalRows = mysqli_fetch_assoc(News_Select_Count_All());
				echo "Total No. of News - ".$NewsTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">News</th>
						<th align="left">Enable/Disable</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$NewsTotalRows['total'])
						echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($NewsTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$News_StatusRows = News_Select_ByLimit($Start, $Limit);
					while($News = mysqli_fetch_assoc($News_StatusRows))
					{
						$News['news'] = explode('`',$News['news']);
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i."</td><td>";
						$k=0;
						foreach($News['news'] as $Newses)
							echo "<b>News ".(++$k).":</b>".$Newses."<br/>";
						echo '</td>';
							if($News['enable']=='1')
								echo "<td>Enabled</td>";
							else	
								echo "<td>Disabled</td>";
						echo "
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$News['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$News['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
						</tr>";
						$i++;
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
	function autoclear()
	{
		if(document.getElementById("enable").checked == true)
		{
			$("span").removeAttr('class');
			document.getElementById("enable").checked = false;
		}
	}
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 ||charCode == 9 ||charCode == 35 ||charCode == 36 ||charCode == 46 )
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122 || charCode == 32)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8 || 	charCode == 35 ||charCode == 36 ||charCode == 46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	
	function validation()
	{
		var message = "";
		if(document.getElementById("status")==0)
			message = "Please Enter the Oppurtunity Status";
		if(document.getElementById("sortorder")==0)
			message = "Please Enter the Oppurtunity Sortorder";	
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
		
			var Items = 0;
			Items = <?php echo count($_POST['news']); ?>;
	$(document).ready(function()
	{
		var FileInputsHolder = $('#AddFileInputBox');
		var MaxFileInputs = 10;
		var i = 0;
		if(Items==0)
			i = $('#AddFileInputBox div').size() + 1;
		else	
			i = Items;
		$('#AddMoreFileBox').live('click', function() 
		{
			
			if(i < MaxFileInputs)
			{
				i++;
				if(Items)
					$('<span style="padding-left:50px;"><br/>News <br/><textarea name="news[]" id="news"></textarea><a href="#" id="removeFileBox"><img src="images/overlay/close.png" border="0" height="25" width="25"/></a><br/><br/><br/></span>').appendTo(FileInputsHolder);
				else
					$('<span style="padding-left:50px;"><br/>News <br/><textarea name="news[]" id="news"></textarea><a href="#" id="removeFileBox"><img src="images/overlay/close.png" border="0" height="25" width="25"/></a><br/><br/><br/></span>').appendTo(FileInputsHolder);
			}
			return false;
		});
		$('#removeFileBox').live('click', function()
		{
			if(i > 1)
			{
				$(this).parents('span').remove();
				i--;
			}
			return false;
		});
	});
</script>