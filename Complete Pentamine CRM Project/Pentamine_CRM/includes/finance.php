<html>
	<head> 
		<style> 
			.tablewidthamt 
			{ 	 
				width:10em; 
				word-wrap:break-word;
				word-break: break-all; 	 	
			}
			.tablewidth 
			{ 	 
				width:50em; 
				word-wrap:break-word;
				word-break: break-all; 	 	
			} 
		</style>	
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="stylesheet" href="/resources/demos/style.css" /> 
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
		<script language="JavaScript" type="text/javascript" src="js/wysiwyg.js"></script>
		<script>
			$(document).ready(function()
			{
				$('#datepicker').datepicker().datepicker('setDate', 'today');
			});
			var found=0;
			function isNumberKey(evt)
			{
				var charCode = (evt.which) ? evt.which : event.keyCode;  
				if (charCode > 31 && (charCode < 46 || charCode > 57 || charCode==47))
					return false;
				if(charCode==46)
				{
					if(found++==0)
						return true;
					else
						return false;
				}
				else
					return true; 
			} 
			function validat(form)
			{
				if(document.getElementById('description').selectedIndex == 0 ) 
				{
					alert ( "Please select Description");
					return false;
				}  		
				var x=document.getElementById('amount').value;
				if(x==null || x=='')
				{
					alert('Enter Amount');
					return false;
				}
				if(document.getElementById('mode').selectedIndex == 0 ) 
				{
					alert ( "Please select Mode");
					return false;
				} 	
				var z=document.getElementById('detailsofpayment').value;
				if(z==null || z=='')
				{ 
					alert('Enter details of the payment');
					return false;
				}  
				if(form.details.value == "") 
				{
					alert("Please Enter Details!");
					form.details.focus();
					return false;
				} 
			} 
		</script>
	</head> 
	<body> 
		<div style="float:left;margin-top:25px;margin-left:1000px;width:500px">
			<button onclick="window.location.href='?page=fullfinancialdetails'">Full Details</button>
			<button onclick="window.location.href='?page=reports'">Reports</button>
		</div>
			<form action="" method="POST" onsubmit="return validat(this);">
			<?php 
				include "config.php";
				ini_set( "display_errors", "0" );
				if($_POST['submit'])
				{ 	
					$sql_select = mysql_query("SELECT PTFID FROM financemodule ORDER BY id DESC");
					if(mysql_num_rows($sql_select))
					{
						$data = mysql_fetch_array($sql_select);
						$ptfid = substr($data['PTFID'],6,4)+1;
						if(strlen($ptfid) == 1)
							$ptfid ="PTFID-000".$ptfid;
						if(strlen($ptfid) == 2)
							$ptfid ="PTFID-00".$ptfid;
						if(strlen($ptfid) == 3)
							$ptfid ="PTFID-0".$ptfid;
					}
					else 
					{
						$ptfid = "PTFID-0001";
					} 
						$date = new DateTime();
						date_default_timezone_set('Asia/Calcutta'); 
						$date1 = date("Y-m-d h:i:sA", $date->format('U'));
						mysql_query("INSERT INTO financemodule (PTFID,Date,Description,Amount,Details,Mode,Detailsofpayment,Paymentdetails,DateTime) VALUES ('".$ptfid."','".$_POST['date']."','".$_POST['description']."','".$_POST['amount']."','".$_POST['details']."','".$_POST['mode']."','".$_POST['detailsofpayment']."','".$_POST['paymentdetails']."','".$date1."')");
						header("Location: ?page=finance") ; 
				}
				echo '<strong>FINANCIAL DETAILS</strong>
					<table class="paginate sortable full1">
					<tr>
						<td><strong>PaymentDetails</strong></td>';
				if($row['Paymentdetails'] == "inflow")
					echo "<td><input type='radio' name='paymentdetails' value='inflow' id='paymentdetails' checked>INFLOW<input type='radio' name='paymentdetails' value='outflow' id='paymentdetails'>OUTFLOW</td>";
				else
					echo "<td><input type='radio' name='paymentdetails' value='inflow' id='paymentdetails'>INFLOW<input type='radio' name='paymentdetails' value='outflow' id='paymentdetails' checked>OUTFLOW</td>";
				echo '</tr><tr>
							<td><strong>Date</strong></td>
							<td><input type="text" id="datepicker" name="date" value='.$row['Date'].'></td>';
				$sql_des = mysql_query("SELECT * FROM finance_description"); 
				echo '<td><strong>Description</strong></td>
						<td><select id="description" name="description"><option value="select">select</option>';
				
				while($row_des = mysql_fetch_array($sql_des))
					echo '<option value="'.$row_des['description_name'].'">'.$row_des['description_name'].'</option>';
				
				echo '</select></td>
					<td><strong>Amount</strong></td> 		
					<td><input type="text" name="amount" id="amount" value="'.$row['Amount'].'" onkeypress="return isNumberKey(event)"></td>';	
					
				$sql_mode = mysql_query("SELECT * FROM finance_modeofpayment");
				echo '<td><strong>Mode of Payment</strong></td>
					  <td><select id="mode" name="mode">
					  <option value="select">select</option>';
					 
				while($row_mode = mysql_fetch_array($sql_mode)) 
					echo '<option value="'.$row_mode['modeofpayment'].'">'.$row_mode['modeofpayment'].'</option>'; 
				echo '</select></td><td><strong>Details of Payment</strong></td><td><input type="text" id="detailsofpayment" value="'.$row['Detailsofpayment'].'" name="detailsofpayment"></td></tr>';
				echo '<tr><td><strong>Details</strong></td> 
							<td colspan="10"><textarea rows="5" cols="200" name="details" id="details" bgcolor="white">'.$row['Details'].'</textarea></td>
						</tr>
						<tr>
							<td><input type="submit" value="Submit" name="submit" ></td>
						</tr>
				</table>'; 
				function flow($sql_date)
				{
					if(mysql_num_rows($sql_date) == 0)
						echo '<strong>NO VALUES FOR INFLOW</strong>';
					else
					{
						echo "<table class='paginate sortable full1' width='1150px'>
							<tr>
								<th>Date</th>
								<th>PTFID</th>
								<th>Description</th>
								<th>Amount</th>
								<th>Details</th>
								<th>Mode</th>
								<th>Detailsofpayment</th>
								<th>Paymentdetails</th>
							</tr>";
						while($row_date = mysql_fetch_array($sql_date))
						{
							echo '<tr>
									<td>'.$row_date['Date'].'</td>
									<td>'.$row_date['PTFID'].'</td>
									<td>'.$row_date['Description'].'</td>
									<td>'.$row_date['Amount'].'</td>
									<td class="tablewidth">'.$row_date['Details'].'</td>
									<td>'.$row_date['Mode'].'</td>
									<td>'.$row_date['Detailsofpayment'].'</td>
									<td>'.$row_date['Paymentdetails'].'</td>
								</tr>';
						}
					echo "</table><br/>";
				}
				}
				$sql_date = mysql_query("SELECT * FROM financemodule WHERE Paymentdetails='inflow' ORDER BY id DESC LIMIT 0,10");
				echo'<center><strong>Inflow</strong></center>';
				flow($sql_date); 
				$sql_date = mysql_query("SELECT * FROM financemodule WHERE Paymentdetails='outflow' ORDER BY id DESC LIMIT 0,10");
				echo'<center><strong>Outflow</strong></center>';
				flow($sql_date); 
			?>
		</form>
	</body>
</html>	
<script language="javascript1.2">
	generate_wysiwyg('details');
</script>