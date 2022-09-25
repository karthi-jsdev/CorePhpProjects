<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
		<script src="js/datepicker/jquery.ui.core.js"></script>
		<script src="js/datepicker/jquery.ui.widget.js"></script>
		<script src="js/datepicker/jquery.ui.datepicker.js"></script>
		<script>
			$(document).ready(function() {
			$('#tentative_enddate').datepicker({ dateFormat: 'yy/mm/dd',minDate:0 });
			//$('#tentative_enddate').datepicker('setDate', new Date());
			});
		</script> 
	</head>
	<section class="first">
		<div class="columns leading">
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel">
			<?php
			include('Config.php');
			?>
			<div class="clearfix">
				<label><strong>Enter Date to Check Near Future Machine Availability<strong></label>
				<input type="text" id="tentative_enddate" name="tentative_enddate" onkeypress="return false" required="required" value="<?php echo $_POST['tentative_enddate']; ?>"/>
			</div>
			<button class="button button-blue" type="submit" name="Submit" value="Submit">Submit</button>
		</form>
		</div>
	</section><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	<div>
		<div style="float:left">
			<?php
			if($_GET['date'])
				$_POST['tentative_enddate'] = $_GET['date'];
			echo"<h3 align='center'><i style='background-color:gray'>Machine's Near Future</i></h3>";
			$j=1;
			$machine_nearfuture = Machine_Near_Future();
			if(mysql_num_rows($machine_nearfuture)==0)
			{
				echo '<table class="paginate soratble full">
						<thead>
							<tr>
								<th align="left" width="50px">SlNo</th>
								<th align="left" width="120px">Machine Number Near Future </th>
								<th align="left" width="120px">Machine Specification</th>
								<th align="left" width="120px">Machine Turningtool</th>
								<th align="left" width="120px">Machine Makeid</th>
								<th align="left" width="120px">Machine Locationid</th>
								<th align="left" width="120px">Tentative Enddate</th>
							</tr>
						</thead>
					<tr><td style="color:red;" colspan="7"><center><strong>Sorry!!!!Every machine has been unassigned</strong></center></td></tr>';
			}
			if(mysql_num_rows($machine_nearfuture)!=0)
			{
				echo '<table class="paginate soratble full">
						<thead>
							<tr>
								<th align="left" width="50px">SlNo</th>
								<th align="left" width="120px">Machine Number Near Future </th>
								<th align="left" width="120px">Machine Specification</th>
								<th align="left" width="120px">Machine Turningtool</th>
								<th align="left" width="120px">Machine Makeid</th>
								<th align="left" width="120px">Machine Locationid</th>
								<th align="left" width="120px">Tentative Enddate</th>
							</tr>
						</thead>';
				while($machine_unassigned = mysql_fetch_assoc($machine_nearfuture))
				{
					echo'<tbody>
							<tr>
								<td align="left" width="50px">'.$j++.'</td>
								<td align="left" width="120px">'.$machine_unassigned['machine_number'].'</td>
								<td align="left" width="120px">'.$machine_unassigned['specification'].'</td>
								<td align="left" width="120px">'.$machine_unassigned['turningtool'].'</td>
								<td align="left" width="120px">'.$machine_unassigned['makeid'].'</td>
								<td align="left" width="120px">'.$machine_unassigned['location_id'].'</td>
								<td align="left" width="120px">'.$machine_unassigned['tentative_enddate'].'</td>
							</tr>
						</tbody>';
				}
			} ?>
			</table>
		</div>
		<div style="float:left">
			<h3 align='center'><i style="background-color:gray">Machine's Unassigned</i></h3>
				<table class="paginate soratble full" >
					<thead>
						<tr>
							<th align="left" width="50px">SlNo</th>
							<th align="left" width="120px">Machine Unassigned Number</th>
							<th align="left" width="120px">Machine Specification</th>
							<th align="left" width="120px">Machine Turningtool</th>
							<th align="left" width="120px">Machine Makeid</th>
							<th align="left" width="120px">Machine Locationid</th>
						</tr>
					</thead>
					<?php
					$i=1;
					$machine_available = mysql_fetch_assoc(Machine_Availability_By_Count());
					$Limit = 20;
					$total_pages = ceil($machine_available['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$machine = Machine_Availability($Start,$Limit);
					if(mysql_num_rows($machine)==0)
						echo'<tr><td style="color:red;" colspan="4"><center><strong>Sorry!!!!Every machine has been assigned</strong></center></td></tr>';
					else
					{
						while($machineunassigned = mysql_fetch_assoc($machine))
						{
							echo'<tbody>
									<tr>
										<td align="left" width="50px">'.$i++.'</td>
										<td align="left" width="120px">'.$machineunassigned['machine_number'].'</td>
										<td align="left" width="120px">'.$machineunassigned['specification'].'</td>
										<td align="left" width="120px">'.$machineunassigned['turningtool'].'</td>
										<td align="left" width="120px">'.$machineunassigned['makeid'].'</td>
										<td align="left" width="120px">'.$machineunassigned['location_id'].'</td>
									</tr>
								</tbody>';
						}
					} ?>
				</table>
			<?php
			$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&date=".$_POST['tentative_enddate']."&";
			if($total_pages > 1)
			include("includes/Pagination.php");
			?>
		</div>
	</div>
</html>