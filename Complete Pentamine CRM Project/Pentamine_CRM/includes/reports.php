<html>
	<head> 	
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css" />
		<script>
			$(document).ready(function() {
			$('#datepicker_from').datepicker();
			$('#datepicker_to').datepicker();
			//$( "#datepicker_to").datepicker().datepicker('setDate', 'today');
			});
			function fromto_dat()
			{			
				var x=document.getElementById('datepicker_from').value;
				if (x==null || x=="")
				{
					alert("Select From Date");
					return false;
				}
				var y=document.getElementById('datepicker_to').value;
				if (y==null || y=="")
				{
					alert("Select To Date");
					return false;
				}
			}
		</script>
		<style>
			.tablewidth 
			{ 	 
				width:35em; 
				word-wrap:break-word;
				word-break: break-all; 	 	
			} 
		</style>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div style="float:left;margin-top:25px;margin-left:1000px;width:500px">
			<button onclick="window.location.href='?page=finance'">Finance Details</button>
			<button onclick="window.location.href='?page=fullfinancialdetails'">Full Details</button>
		</div>
		<form action="" method="POST">
			<?php
				include "config.php";
				ini_set( "display_errors", "0" );
				echo "<h2 align='center'>REPORTS</h2>";
				
				echo "<table align='left' class='paginate sortable full'>
							<tr> 	
								<td><strong>Paymentdetails</strong></td>
								<td><strong>Description</strong></td>
								<td><strong>ModeofPayment</strong></td>
								<td><strong>From</strong></td>
								<td><strong>To</strong></td>
							</tr>";
				echo '<tr>
						<td>
							<select name="paymentdetails">';
							if($_POST['paymentdetails'] == "All")
								echo '<option value="All" selected>All</option>';
							else
								echo '<option value="All">All</option>';
							if($_POST['paymentdetails'] == "inflow")
								echo '<option value="inflow" selected>Inflow</option>';
							else
								echo '<option value="inflow">Inflow</option>';
							if($_POST['paymentdetails'] == "outflow")
								echo '<option value="outflow" selected>Outflow</option>';
							else
								echo '<option value="outflow">Outflow</option> 
							</select>
						</td>';
				$sql_des = mysql_query("SELECT * FROM finance_description");
				echo '<td><select name="description_name">';
				if($_POST['description_name'] == "All")
					echo '<option value="All" selected>All</option>';
				else
					echo '<option value="All">All</option>';
				while($row_des = mysql_fetch_array($sql_des))
				{	
					if($row_des['description_name'] == $_POST['description_name'])
						echo '<option value="'.$row_des['description_name'].'" selected>'.$row_des['description_name'].'</option>';
					else
						echo '<option value="'.$row_des['description_name'].'">'.$row_des['description_name'].'</option>';
				}
				echo'</select></td>';
				$sql_mode = mysql_query("SELECT * FROM finance_modeofpayment");
				echo '<td><select name="modeofpayment">';
				if($_POST['modeofpayment'] == "All")
					echo '<option value="All" selected>All</option>';
				else
					echo '<option value="All">All</option>';
				while($row_mode = mysql_fetch_array($sql_mode))
				{
					if($row_mode['modeofpayment'] == $_POST['modeofpayment'])
						echo '<option value="'.$row_mode['modeofpayment'].'" selected>'.$row_mode['modeofpayment'].'</option>';
					else
						echo '<option value="'.$row_mode['modeofpayment'].'">'.$row_mode['modeofpayment'].'</option>';
				}
				echo '</select>
				</td><td><input type="text" id="datepicker_from" name="from_date" >'.$row_mode["Date"].'</td>
				<td><input type="text" id="datepicker_to" name="to_date">'.$row_mode["Date"].'</td>
				<td><input type="submit" value="submit" onclick="return fromto_dat()"></td></tr></table>';
				
				if($_POST['paymentdetails'] && $_POST['description_name'] && $_POST['modeofpayment'] && $_POST['from_date'] && $_POST['to_date'])
				{
					if($_POST['paymentdetails'] != "All")
						$Con = "Paymentdetails='".$_POST['paymentdetails']."'";
					if($_POST['description_name'] != "All")
					{
						if(!$Con)
							$Con = "Description='".$_POST['description_name']."'";
						else
							$Con .= "&& Description='".$_POST['description_name']."'";
					}
					if($_POST['modeofpayment'] != "All")
					{
						if(!$Con)
							$Con = "Mode='".$_POST['modeofpayment']."'";
						else
							$Con .= "&& Mode='".$_POST['modeofpayment']."'";
					}
					if(!$Con)
						$Con = "date >='".$_POST['from_date']."' && date <= '".$_POST['to_date']."'";
					else
						$Con .= "&& date >='".$_POST['from_date']."' && date <= '".$_POST['to_date']."'";
					$sql_main = mysql_query("SELECT * FROM financemodule WHERE ".$Con ."ORDER BY id DESC");
					if(mysql_num_rows($sql_main) == 0)
					{
						echo '<strong>NO VALUES</strong>';
					}
					else
					{
						echo '<table width="100%" border="1" align="left" class="paginate sortable full">
							<tr>
								<td><strong>Date</strong></td>
								<td><strong>PTFID</strong></td>
								<td><strong>Description</strong></td>
								<td><strong>Amount</strong></td>
								<td><strong>Details</strong></td>
								<td><strong>Mode</strong></td>
								<td><strong>DetailsofPayment</strong></td>
								<td><strong>PaymentDetails</strong></td>
							</tr>';
					while($row_main = mysql_fetch_array($sql_main))
					{
						echo '<tr>
								<td>'.$row_main['Date'].'</td>
								<td>'.$row_main['PTFID'].'</td>
								<td>'.$row_main['Description'].'</td>
								<td>'.$row_main['Amount'].'</td>
								<td class="tablewidth">'.$row_main['Details'].'</td>
								<td>'.$row_main['Mode'].'</td>
								<td>'.$row_main['Detailsofpayment'].'</td>
								<td>'.$row_main['Paymentdetails'].'</td>
							</tr>';
					}
						echo'</table>';
						$sql_amt = mysql_query("SELECT SUM(Amount) FROM financemodule WHERE ".$Con);
						$row_amt = mysql_fetch_array($sql_amt); 
						echo '<br/><strong><center>TOTAL AMOUNT IS:'.$row_amt['SUM(Amount)'].'</center></strong>';
					}
				}
			?>
		</form>
		<!--script>
			var date = new Date();
			var d  = date.getDate();
			var day = (d < 10) ? '0' + d : d;
			var day = day - 7;
			var m = date.getMonth() + 1;
			var month = (m < 10) ? '0' + m : m;
			var yy = date.getYear();
			var year = (yy < 1000) ? yy + 1900 : yy;
			var x = (month + "/" + day + "/" + year);
			document.getElementById('datepicker_from').value= x;
		</script-->
	</body>
</html>


