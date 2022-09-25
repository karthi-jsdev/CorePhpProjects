<?php
	$Columns = array("id","employee_id","department_id","grade_id","basic_pay","da","hra","cca","ma","lop","month","year");
	if($_GET['action'])
	{
		$FetchSalary = mysql_fetch_assoc(Salary_Select_ById());
		foreach($Columns as $Col)
			$_POST[$Col] = $FetchSalary[$Col];
	}
	if($_POST['save'])
	{
		$SelectAssignSal = mysql_query("select * from employee_salary_assignment where employee_id='".$_POST['name']."' && month='".$_POST['month']."' && year='".$_POST['year']."'");
		if(mysql_num_rows($SelectAssignSal))
			echo '<br/><div class="message error"><b>Message</b> : For this month and year salary assigned</div>';
		else
		{
			$Query = "";$Count = 0;$i=1;
			if($_POST['partculars'])
			{
				$Count = count($_POST['partculars']);
				foreach($_POST['partculars'] as $pa)
				{
					$Count--;
					$Query .= $pa;
					if($Count)
						$Query .= ",";
				}
			}
			mysql_query("insert into employee_salary_assignment(id,employee_id,basic_pay,da,hra,cca,ma,lop,datetime,month,year,status) values('','".$_POST['name']."',$Query,'".date('Y-m-d h:i:s')."','".$_POST['month']."','".$_POST['year']."','1')");
		}	
		/*if($_POST['partculars'])
		{
			$Count = count($_POST['partculars']);
			foreach($_POST['partculars'] as $pa)
			{
				if($i==1)
					$Query .= "basic_pay=";
				else if($i==2)
					$Query .= "da=";
				else if($i==3)
					$Query .= "hra=";
				else if($i==4)
					$Query .= "cca=";
				else if($i==5)
					$Query .= "ma=";
				else if($i==6)
					$Query .= "lop=";
				$Count--;
				if($pa)
					$Query .= $pa;
				else
					$Query .= "0";
				if($Count)
					$Query .= ",";
				$i++;
			}
		}*/
		//mysql_query("Update salary_assignment set monthyear='".($_POST['month'].'/'.$_POST['year'])."',$Query,datetime='".date('Y-m-d h:i:s')."',status='1' where id='".$_POST['id']."'");
	}
?>
<form method="POST" name="form1" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel"  enctype="multipart/form-data">
	<fieldset>
		<h3>Assign Salary </h3>
		<hr/>
		<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
		<div class="clearfix">
			<label><strong>Month</strong><font color="red">*</font>
				<?php
					echo '<select name="month" id="month">';
					$months = array("Select","January","Febuary","March","April","May","June","July","August","September","October","November","December");			
					for($i=0;$i<count($months);$i++)
					{
						if($_POST['month'] == $i)
							echo '<option value="'.$i.'" selected>'.$months[$i].'</option>';
						else
							echo '<option value="'.$i.'">'.$months[$i].'</option>';
					}
					echo '</select>';
				?>
			</label>
			<label><strong>Year</strong><font color="red">*</font>
				<?php
					echo '<select name="year" id="year">
						<option value="Select">Select</option>';
						for($i=2013;$i<=date('Y');$i++)
						{	
							if($_POST['year'] == $i)
								echo '<option value="'.$i.'" selected>'.$i.'</option>';
							else
								echo '<option value="'.$i.'">'.$i.'</option>';
						}
						echo '</select>';
				?>
			</label>
		</div>
		<div class="clearfix">
			<label><strong>Staff Name</strong><font color="red">*</font>
				<?php
					echo '<select name="name" id="name" onchange="GetSalDetails(this.value)">
						<option value="Select">Select</option>';
					$SelectEmployeeName = Select_Employee();
					while($FetchEmployeeName = mysql_fetch_array($SelectEmployeeName))
					{
						if($_POST['employee_id']==$FetchEmployeeName['id'])
							echo '<option value="'.$FetchEmployeeName['id'].'" selected>'.$FetchEmployeeName['first_name'].'</option>';
						else
							echo '<option value="'.$FetchEmployeeName['id'].'">'.$FetchEmployeeName['first_name'].'</option>';
					}
					echo '</select>';
				?>
			</label>
		<div class="clearfix">
			<label>
				<strong>Department </strong>
				<input type="text" name="department" id="1" disabled>
				<input type="hidden" name="department_id" id="10" >
				<?php
					/*echo '<select name="department" id="department">
						<option value="Select">Select</option>';
					$Selectdepartment = Select_department();
					while($Fetchdepartment = mysql_fetch_array($Selectdepartment))
					{
						echo '<option value="'.$Fetchdepartment['id'].'">'.$Fetchdepartment['name'].'</option>';
					}
					echo '</select>';*/
				?>
			</label>
			<label>
				<strong>Grade </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="grade" id="9" disabled>
				<input type="hidden" name="grade_id" id="11">
				<?php
					/*echo '<select name="department" id="department">
						<option value="Select">Select</option>';
					$Selectdepartment = Select_department();
					while($Fetchdepartment = mysql_fetch_array($Selectdepartment))
					{
						echo '<option value="'.$Fetchdepartment['id'].'">'.$Fetchdepartment['name'].'</option>';
					}
					echo '</select>';*/
				?>
			</label>
			<label><strong>Designation</strong>
				<input type="text" name="designation" id="2" disabled>
					<?php
				/*	echo '<select name="designation" id="designation">
						<option value="Select">Select</option>';
					$Selectdesignation = Select_designation();
					while($Fetchdesignation = mysql_fetch_array($Selectdesignation))
					{
						echo '<option value="'.$Fetchdesignation['id'].'">'.$Fetchdesignation['name'].'</option>';
					}
					echo '</select>';*/
				?>
			</label>
		</div>
		<div class="clearfix">
			<?php
				$SelectParticulars = SelectParticulars();
				$i = 1;
				$j = 3;
				while($FetchParticulars = mysql_fetch_array($SelectParticulars))
				{
					echo '<label><strong>'.$FetchParticulars['particular'].' </strong><font color="red">*</font><br/>
							<input type="text" name="partculars[]" id="'.$j.'"  value="'.$_POST[$i].'" required="required" onkeypress="return isNumeric(event)">
						</label>';
					$i++;
					$j++;
				}
			?>
		</div>
		<hr/>
		<input type="submit" class="button button-green" id="save" name="save" value="Assign">
	</fieldset>
</form>
<?php
if($_POST['save'])
{
	$SelectSal = mysql_query("select * From employee_salary_assignment order by id desc");
	$Total = 0;
	echo '<table class="paginate sortable full">
				<thead>
					<tr>
						<th align="left">Photo</th>
						<th align="left">Date</th>
						<th align="left">Month/Year</th>
						<th align="left">Name</th>
						<th align="left">Basic-pay</th>
						<th align="left">DA</th>
						<th align="left">HRA</th>
						<th align="left">CCA</th>
						<th align="left">MA</th>
						<th align="left">LOP</th>
						<th align="left">Total Salary</th>
						<th align="left">Net Salary</th>
						<th align="left">Status</th>
						<th align="left">Action</th>
					</tr>
				</thead>';
	$Status = "";			
	$FetchSal = mysql_fetch_array($SelectSal);	
	$months = array("Select","January","Febuary","March","April","May","June","July","August","September","October","November","December");			
	$Months = "";	
		for($i=0;$i<count($months);$i++)
		{
			if($i==$FetchSal['month'])
				$Months .= $months[$i];
		}
		if($FetchSal['status'])
			$Status = "Salary assigned";
		else
			$Status = "Salary not assigned";
		$Total = $FetchSal['basic_pay']+$FetchSal['da']+$FetchSal['hra']+$FetchSal['cca']+$FetchSal['ma']+$FetchSal['lop'];
		$SelectEmployee = mysql_fetch_array(mysql_query("Select * From staff_admission Where id='".$FetchSal['employee_id']."'"));
		echo '<tr>
				<td><img src="data:image/jpeg;base64,'.base64_encode($SelectEmployee['user_img']).'"  width="90px" height="90px" alt="photo"/></td>
				<td style="vertical-align:middle">'.date('Y-m-d').'</td>
				<td style="vertical-align:middle">'.$Months.'/'.$FetchSal['year'].'</td>
				<td style="vertical-align:middle">'.$SelectEmployee['first_name'].' '.$SelectEmployee['last_name'].'</td>
				<td style="vertical-align:middle">'.$FetchSal['basic_pay'].'</td>
				<td style="vertical-align:middle">'.$FetchSal['da'].'</td>
				<td style="vertical-align:middle">'.$FetchSal['hra'].'</td>
				<td style="vertical-align:middle">'.$FetchSal['cca'].'</td>
				<td style="vertical-align:middle">'.$FetchSal['ma'].'</td>
				<td style="vertical-align:middle">'.$FetchSal['lop'].'</td>
				<td style="vertical-align:middle">'.$Total.'</td>
				<td style="vertical-align:middle">'.($Total-$FetchSal['lop']).'</td>
				<td style="vertical-align:middle">'.$Status.'</td>
				<td style="vertical-align:middle"><a href="index.php?page='.$_GET['page'].'&subpage='.$_GET['subpage'].'&id='.$FetchSal['id'].'&pageno='.$_GET['pageno'].'&action=Edit">Edit</a></td>
			</tr>';
			$Total = 0;
echo	'</table>'; 
}
?>
<script>
<?php
	if($_POST['employee_id'])
	{ ?>
	GetSalDetails(<?php echo $_POST['employee_id']; ?>)
<?php
	} ?>

	function GetSalDetails(EmpId)
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
				var splitresult = results.split("#");
				for(var i=1;i<splitresult.length;i++)
					document.getElementById(i).value = splitresult[i];
			}
		}
		xmlhttp.open("GET","includes/GetSalDetails.php?EmpId="+EmpId,true);
		xmlhttp.send();
	}
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
</script>