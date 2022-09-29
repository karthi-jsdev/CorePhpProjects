<?php
	if($_GET['export'])
	{
		include("Config.php");
		ini_set("display_errors","0");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msword");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", date("d-m-Y H-i")).".doc");
		$SelectEmployee = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From employee_salary_assignment Where id='".$_GET['Id']."'"));
		$SelectEmployeeDetails = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From staff_admission Where id='".$SelectEmployee['employee_id']."'"));
		$months = array("Select","January","Febuary","March","April","May","June","July","August","September","October","November","December");			
		for($i=0;$i<count($months);$i++)
		{
			if($i==$SelectEmployee['month'])
				$Months .= $months[$i];
		}
		for($i=2013;$i<=date('Y');$i++)
		{	
			if($SelectEmployee['year'] == $i)
				$Year .= $i;
		}
		$Total = $SelectEmployee['basic_pay']+$SelectEmployee['da']+$SelectEmployee['hra']+$SelectEmployee['cca']+$SelectEmployee['ma']+$SelectEmployee['lop'];
		echo '<table class="paginate sortable full" border="1">
				<thead>
					<tr>
						<th align="left">Name</th>
						<th align="left">Month/Year</th>
						<th align="left">Basic-pay</th>
						<th align="left">DA</th>
						<th align="left">HRA</th>
						<th align="left">CCA</th>
						<th align="left">MA</th>
						<th align="left">LOP</th>
						<th align="left">Total Salary</th>
						<th align="left">Net Salary</th>
					</tr>
				</thead>
			<tr>
				<td style="vertical-align:middle">'.$SelectEmployeeDetails['first_name'].' '.$SelectEmployeeDetails['last_name'].'</td>
				<td style="vertical-align:middle">'.$Months.'/'.$Year.'</td>
				<td style="vertical-align:middle">'.$SelectEmployee['basic_pay'].'</td>
				<td style="vertical-align:middle">'.$SelectEmployee['da'].'</td>
				<td style="vertical-align:middle">'.$SelectEmployee['hra'].'</td>
				<td style="vertical-align:middle">'.$SelectEmployee['cca'].'</td>
				<td style="vertical-align:middle">'.$SelectEmployee['ma'].'</td>
				<td style="vertical-align:middle">'.$SelectEmployee['lop'].'</td>
				<td style="vertical-align:middle">'.$Total.'</td>
				<td style="vertical-align:middle">'.($Total-$SelectEmployee['lop']).'</td></tr>	
		</table>';
	}
?>