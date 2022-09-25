<section role="main" id="main">
	<?php
		$Columns = array("id", "categoryid", "particularid", "classid","total", "mode", "term");
		if($_GET['action'] == 'Edit')
		{
			$Class = mysql_fetch_assoc(Fees_Assignment_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Class[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Fees_Assignment_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Fees Assignment deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			
			if(isset($_POST['Submit']))
			{
				
					Fees_Assignment_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Fees Assignment added successfully</div>";
			}
			else if(isset($_POST['Update']))
			{
				
					Fees_Assignment_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Fees Assignment details updated successfully</div>";
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
			<header><h2>Assign Fees</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Category <font color="red">*</font>
					<select name="assignment_categoryid" id="assignment_categoryid" onchange="GetParticulars(this.value,'');">
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
					<div id="partculars"></div>
						<label>Class <font color="red">*</font>
						<select name="assignment_class" id="assignment_class">
							<option value="">Select</option>
							<?php
								$SelectClass = Section_Select_All();
								while($FetchClass  = mysql_fetch_array($SelectClass))
								{
									$FetchClasses = mysql_fetch_array(Classes_Select_ById($FetchClass['classid']));
									if($FetchClass['id']==$_POST['classid'])
										echo '<option value="'.$FetchClass['id'].'" selected>'.$FetchClasses['name'].'/'.$FetchClass['name'].'</option>';
									else
										echo '<option value="'.$FetchClass['id'].'">'.$FetchClasses['name'].'/'.$FetchClass['name'].'</option>';
								}
							?>
						</select>
					</label>
				</div>
				<div class="clearfix">
					<label>Total Amount <font color="red">*</font><br/>
						<input type="text" name="total" id="total" value="<?php echo $_POST['total']; ?>" required="required" onkeypress="return isNumeric(event)">
					</label><br/>
					Mode <font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
						<?php
							$Mode = array("Percentage","Amount");
							$i=0;
							foreach($Mode as $M)
							{
								if($_POST['mode']==$i && $_GET['action'])
									echo '<span class="radio-input"><input type="radio" name="mode" value="'.$i.'"  id="mode" checked>'.$M.'</input></span>';
								else
									echo '<span class="radio-input"><input type="radio" name="mode" value="'.$i.'"  id="mode'.$i.'">'.$M.'</input></span>';
								$i++;
							}

						?>
				</div>
				<div class="clearfix">
				<?php
					$SelectTerm = Select_Term();
					$i=1;$j=0;
					$ExplodeTerm = explode(',',$_POST['term']);
					while($FetchTerm = mysql_fetch_array($SelectTerm))
					{
						echo '<label>'.$FetchTerm['name'].'<font color="red">*</font><br/>
								<input type="text" name="terms'.$i.'" id="term'.$i.'" value="'.$ExplodeTerm[$j].'" required="required" onkeypress="return isNumeric(event)">
							</label>';
							$i++;$j++;
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
			<h3>Fees Assignment List
				<?php
				$Fees_AssignmentTotalRows = mysql_fetch_assoc(Fees_Assignment_Select_Count_All());
				echo " : No. of Total Fees Assignment - ".$Fees_AssignmentTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Catagory</th>
						<th align="left">Particular</th>
						<th align="left">Class</th>
						<th align="left">Total Amount</th>
						<?php
							$Select = Select_Term();
							while($FetchTerm  = mysql_fetch_array($Select))
								echo '<th align="left">'.$FetchTerm['name'].'</th>';
						?>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$Fees_AssignmentTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($Fees_AssignmentTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>=2)
						$i = $Start+1;
					else
						$i =1;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$Fees_AssignmentRows = Fees_Assignment_Select_ByLimit($Start, $Limit);
					while($Fees_Assignment = mysql_fetch_assoc($Fees_AssignmentRows))
					{
						$FetchCategory = mysql_fetch_array(FetchCategoryById($Fees_Assignment['categoryid']));
						$FetchParticular = mysql_fetch_array(FetchParticularById($Fees_Assignment['particularid']));
						$FetchSection = mysql_fetch_array(Sections_Select_ById($Fees_Assignment['classid']));
						$FetchClasses = mysql_fetch_array(Classes_Select_ById($FetchSection['classid']));
						$ExplodeTerms = explode(',',$Fees_Assignment['term']);
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$FetchCategory['name']."</td>
							<td>".$FetchParticular['name']."</td>
							<td>".$FetchClasses['name'].'/'.$FetchSection['name']."</td>
							<td>".$Fees_Assignment['total']."</td>";
							for($j=0;$j<mysql_num_rows(Select_Term());$j++)
								echo "<td>".$ExplodeTerms[$j]."</td>";
						echo "<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Fees_Assignment['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Fees_Assignment['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
<?php
if($_POST['categoryid'])
{
?>
	GetParticulars(<?php echo $_POST['categoryid']; ?>,<?php echo $_POST['particularid']; ?>);
<?php
}
?>
	function GetParticulars(categoryid,particularid)
	{
		var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var results = xmlhttp.responseText;
				document.getElementById('partculars').innerHTML = results;
			}
		}
		xmlhttp.open("GET","includes/GetParticulars.php?categoryid="+categoryid+"&particularid="+particularid,true);
		xmlhttp.send();
	}
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8 || charCode==35 || charCode==36 || charCode==46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	function validation()
	{
		var message = "";
		var Mode = document.getElementsByName("mode");
		var flag = 0,mode_val=3;
		var totaloftermamount=0,percentage=0;
		for (var i = 0; i< Mode.length; i++)
		{
			if(Mode[i].checked)
			{
				mode_val = Number(Mode[i].value);
				flag++;
			}
		}
		if(mode_val == 1)
		{
			for(var i=1;i<=<?php echo mysql_num_rows(mysql_query("select * from term")); ?>;i++)
			{
				totaloftermamount += Number(document.getElementById("term"+i).value);
			}
			if(document.getElementById("total").value<totaloftermamount || document.getElementById("total").value>totaloftermamount)
				message = "Sum of all Terms amount should be equal to Total amount";
		}
		if(mode_val == 0)
		{
			for(var i=1;i<=<?php echo mysql_num_rows(mysql_query("select * from term")); ?>;i++)
			{
				percentage += Number(document.getElementById("term"+i).value);
			}
			if(percentage != 100)
				message = "Term percentage is not equal to 100% of total amount";
		}
		if(document.getElementById("assignment_class").value=="")
			message = "please select class";
		if(!flag)
			message = "please select mode";
		if(document.getElementById("assignment_categoryid").value)
			if(document.getElementById("assignment_particulars").value=="")
				message = "please select particular";
		if(document.getElementById("assignment_categoryid").value=="")
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