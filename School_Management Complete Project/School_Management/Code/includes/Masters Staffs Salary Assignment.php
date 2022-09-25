<section role="main" id="main">
	<?php
		$Columns = array("id", "department_id", "grade_id", "basic_pay", "da", "hra", "cca", "ma", "lop");
		if($_GET['action'] == 'Edit')
		{
			$Class = mysql_fetch_assoc(Salary_Assignment_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Class[$Col];
		}
		if($_POST['basic_pay'])
		{
			$_POST['1'] = $_POST['basic_pay'];
			$_POST['2'] = $_POST['da'];
			$_POST['3'] = $_POST['hra'];
			$_POST['4'] = $_POST['cca'];
			$_POST['5'] = $_POST['ma'];
			$_POST['6'] = $_POST['lop'];
		}
		else if($_GET['action'] == 'Delete')
		{
			Salary_Assignment_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : Salary Assignment deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$Salary_Assignment = Salary_Assignment_Select_ByNamePWD();
			if(isset($_POST['Submit']))
			{
				if(mysql_num_rows($Salary_Assignment))
					$message = "<br /><div class='message error'><b>Message</b> : This Department and Grade already exist</div>";
				else
				{
					Salary_Assignment_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Salary Assignment added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				if(mysql_num_rows(Salary_Assignment_Select_ByNamePWDId()))
					$message = "<br /><div class='message error'><b>Message</b> : This Department and Grade already exist</div>";
				else
				{
					Salary_Assignment_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Salary Assignment details updated successfully</div>";
				}
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
			<header><h2>Salary Assignment</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Department <font color="red">*</font>
					<select name="department" id="department" required="required">
						<option value="">Select</option>
						<?php
							$SelectDepartment = Select_Department();
							while($FetchDepartment  = mysql_fetch_array($SelectDepartment))
							{
								if($FetchDepartment['id']==$_POST['department_id'])
									echo '<option value="'.$FetchDepartment['id'].'" selected>'.$FetchDepartment['name'].'</option>';
								else
									echo '<option value="'.$FetchDepartment['id'].'">'.$FetchDepartment['name'].'</option>';
							}
						?>
					</select>
					</label>
					<label>Grade <font color="red">*</font>
					<select name="grade" id="grade" required="required">
						<option value="">Select</option>
						<?php
							$SelectGrade = Select_Grade();
							while($FetchGrade  = mysql_fetch_array($SelectGrade))
							{
								if($FetchGrade['id']==$_POST['grade_id'])
									echo '<option value="'.$FetchGrade['id'].'" selected>'.$FetchGrade['name'].'</option>';
								else
									echo '<option value="'.$FetchGrade['id'].'">'.$FetchGrade['name'].'</option>';
							}
						?>
					</select>
					</label>
				</div>
				<div class="clearfix">
					<?php
						$SelectParticulars = SelectParticulars();
						$i = 1;
						while($FetchParticulars = mysql_fetch_array($SelectParticulars))
						{
							echo '<label>'.$FetchParticulars['particular'].' <font color="red">*</font><br/>
									<input type="text" name="partculars[]" id="'.$i.'"  value="'.$_POST[$i].'" required="required" onkeypress="return isNumeric(event)">
								</label>';
							$i++;
						}
					?>
					<!--label>Basic Pay <font color="red">*</font><br/>
						<input type="text" name="basic" id="basic" value="<?php echo $_POST['basic_pay']; ?>" required="required" onkeypress="return isNumeric(event)">
					</label>
					<label>DA <font color="red">*</font><br/>
						<input type="text" name="da" id="da" value="<?php echo $_POST['da']; ?>" onkeypress="return isNumeric(event)" required="required">
					</label>
					<label>HRA <font color="red">*</font><br/>
						<input type="text" name="hra" id="hra" value="<?php echo $_POST['hra']; ?>" onkeypress="return isNumeric(event)" required="required">
					</label>
					<label>CCA <font color="red">*</font><br/>
						<input type="text" name="cca" id="cca" value="<?php echo $_POST['cca']; ?>" onkeypress="return isNumeric(event)" required="required">
					</label>
					<label>MA <font color="red">*</font><br/>
						<input type="text" name="ma" id="ma" value="<?php echo $_POST['ma']; ?>" onkeypress="return isNumeric(event)" required="required">
					</label>
					<label>LOP <font color="red">*</font><br/>
						<input type="text" name="lop" id="lop" value="<?php echo $_POST['lop']; ?>" onkeypress="return isNumeric(event)" required="required">
					</label-->
				</div>
			</fieldset>
			<hr />
			<?php
			if($_GET['action'] == 'Edit')
				echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit" value="Submit">Submit</button>&nbsp;&nbsp;';
			?><button class="button button-gray" type="reset" name="reset" onclick="Reset()">Reset</button>
		</form>
		</div>
		
		<div class="columns">
			<h3>Salary Assignment List
				<?php
				$Salary_AssignmentTotalRows = mysql_fetch_assoc(Salary_Assignment_Select_Count_All());
				echo " : No. of Total Salary Assignment - ".$Salary_AssignmentTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Department</th>
						<th align="left">Grade</th>
						<th align="left">Basic-Pay</th>
						<th align="left">DA</th>
						<th align="left">HRA</th>
						<th align="left">CCA</th>
						<th align="left">MA</th>
						<th align="left">LOP</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$Salary_AssignmentTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($Salary_AssignmentTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$Start = ($_GET['pageno']-1)*$Limit;
					if($_GET['pageno']>=2)
						$i = $Start+1;
					else
						$i =1;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$Salary_AssignmentRows = Salary_Assignment_Select_ByLimit($Start, $Limit);
					while($Salary_Assignment = mysql_fetch_assoc($Salary_AssignmentRows))
					{
						$FetchDepartment = mysql_fetch_array(FetchDepartmentById($Salary_Assignment['department_id']));
						$FetchGrade = mysql_fetch_array(FetchGradeById($Salary_Assignment['grade_id']));
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td>".$FetchDepartment['name']."</td>
							<td>".$FetchGrade['name']."</td>
							<td>".$Salary_Assignment['basic_pay']."</td>
							<td>".$Salary_Assignment['da']."</td>
							<td>".$Salary_Assignment['hra']."</td>
							<td>".$Salary_Assignment['cca']."</td>
							<td>".$Salary_Assignment['ma']."</td>
							<td>".$Salary_Assignment['lop']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&id=".$Salary_Assignment['id']."&pageno=".$_GET['pageno']."&action=Edit' class='action-button' title='user-edit'><span class='user-edit'></span></a>  &nbsp; <a href='#' onclick='deleterow(".$Salary_Assignment['id'].")' class='action-button' title='user-delete'><span class='user-delete'></span></a></td>
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
/*<?php
if($_POST['categoryid'])
{
?>
	GetParticulars(<?php echo $_POST['categoryid']; ?>,<?php echo $_POST['particularid']; ?>);
<?php
}
?>*/
function Reset()
	{
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&innersubpage=<?php echo $_GET['innersubpage']; ?>");
	}
	/*function GetParticulars(categoryid,particularid)
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
	}*/
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
</script>