<?php
	if(isset($_GET['export']))
	{
		session_start();
		include("Config.php");
		include("Dashboard_Queries.php");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace("-", "_",date("d-m-Y H-i")).".xls");
	}
?>
<table >
	<tr>
		<td>
			<div>
				<h3>Present Day Leave Summary</h3>
				<table class="paginate sortable full" border='1'>
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Department</th>
							<th align="left">No.Of.Persons</th>
						</tr>
					</thead>
					<tbody >	
					<?php
					$i = 1;
					$ResourceUpdate = Present_Select();	
					while($Department_Number = mysql_fetch_array($ResourceUpdate))
					{
						echo '<tr>
						<td>'.$i++.'</td>
						<td>'.$Department_Number['departmentname'].'</td>
						<td>'.$Department_Number['departmentnum'].'</td>
						</tr>';
					}
					?>
					</tbody>	
				</table>
			</div>	
		</td>
		<td >
			<div style="padding-left:100px;">	
				<h3>Future Day Leave Summary</h3>
				<table class="paginate sortable full" border='1'>
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Department</th>
							<th align="left">No.Of.Persons</th>
						</tr>
					</thead>
					<tbody id="">	
					<?php
					$j = 1;
					$ResourceUpdate = Future_Select();	
					while($Department_Number = mysql_fetch_array($ResourceUpdate))
					{
						echo '<tr>
						<td>'.$j++.'</td>
						<td>'.$Department_Number['departmentname'].'</td>
						<td>'.$Department_Number['departmentnum'].'</td>
						</tr>';
					}
					?>					
					</tbody>	
				</table>
			</div>
		</td>
		<td>
			<div style="padding-left:100px;">
				<h3>Past Day Leave Summary</h3>
				<table class="paginate sortable full" border='1'>
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Department</th>
							<th align="left">No.Of.Persons</th>
						</tr>
					</thead>
					<tbody >	
						<?php
						$k=1;
						$ResourceUpdate = Past_Select();	
						while($Department_Number = mysql_fetch_array($ResourceUpdate))
						{
							echo '<tr>
							<td>'.$k++.'</td>
							<td>'.$Department_Number['departmentname'].'</td>
							<td>'.$Department_Number['departmentnum'].'</td>
							</tr>';
						}
						
						?>
					</tbody>	
				</table>
			</div>	
		</td>
	</tr>
</table>