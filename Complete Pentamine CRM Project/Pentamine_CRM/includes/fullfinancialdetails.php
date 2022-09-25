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
					width:35em; 
					word-wrap:break-word;
					word-break: break-all; 	 	
				} 
			div.pagination 
				{
					padding: 3px;
					margin: 3px;
				}
			div.pagination a
				{
					padding: 2px 5px 2px 5px;
					margin: 2px;
					border: 1px solid #AAAADD; 
					text-decoration: none; /* no underline */
					color: #000099;
				}
			div.pagination a:hover, div.pagination a:active 
				{
					border: 1px solid #000099;
					color: #000;
				}
			div.pagination span.current 
				{
					padding: 2px 5px 2px 5px;
					margin: 2px;
					border: 1px solid #000099; 
					font-weight: bold;
					background-color: #000099;
					color: #FFF;
				}
			div.pagination span.disabled 
				{
					padding: 2px 5px 2px 5px;
					margin: 2px;
					border: 1px solid #EEE; 
					color: #DDD;
				}
				.btn
				{
					font:14px Times New Roman ;
					text-decoration: none;
					background-color: #EEEEEE;
					color: black;
					padding: 2px 6px 2px 6px;
					border-top: 1px solid #CCCCCC;
					border-right: 1px solid #333333;
					border-bottom: 1px solid #333333;
					border-left: 1px solid #CCCCCC; 
					-webkit-border-radius: 5px;
					border-radius:6px;
				}
		</style>
			<!--link rel="stylesheet" type="text/css" href="style.css" /-->
			<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
			<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
			<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
			<link rel="stylesheet" href="/resources/demos/style.css" />
			<script language="JavaScript" type="text/javascript" src="js/wysiwyg.js">
		</script>
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
					if(document.getElementById('description').selectedIndex == 0)
					{
						alert("Please Select Description");
						return false;
					}
					var x=document.getElementById('amount').value;
					if(x==null || x=='')
					{
						alert('Enter Amount');
						return false;
					}
					if(document.getElementById('mode').selectedIndex == 0)
					{
						alert("Please Select Mode");
						return false;
					}
					var z=document.getElementById('detailsofpayment').value;
					if(z==null || z=='')
					{
						alert('Enter details of the payment');
						return false;
					}
					if(form.comment.value == "") 
					{
						alert("Please Enter comment!");
						form.comment.focus();
						return false;
					} 
				}					
			</script>
	</head>
		<body>
				<div style="float:left;margin-top:25px;margin-left:1000px;width:500px">
					<button onclick="window.location.href='?page=finance'">Finance Details</button>
					<button onclick="window.location.href='?page=reports'">Reports</button>
				</div>
			<form action="?page=fullfinancialdetails" method="POST" onsubmit="return validat(this);" name="form">
				<?php 
				include "config.php"; 
				ini_set( "display_errors", "0" );
				if($_GET['id'])
				{ 
					echo '<input type="hidden" value="'.$_GET['id'].'" name="id">';
					$sql = mysql_query("SELECT * FROM financemodule WHERE id='".$_GET['id']."'");
					$row = mysql_fetch_array($sql); 
				}
				if($_POST['update'])
				{
					$sql_update = mysql_query("UPDATE financemodule SET Date='".$_POST['date']."',Description='".$_POST['description']."',Amount='".$_POST['amount']."',Details='".$_POST['comment']."',Mode='".$_POST['mode']."',Detailsofpayment='".$_POST['detailsofpayment']."',Paymentdetails='".$_POST['paymentdetails']."' WHERE id='".$_POST['id']."'");
					header( 'Location: ?page=fullfinancialdetails');
				}
				
				echo "<strong><center>INFLOW & OUTFLOW</center></strong>
					<br/>
					<table class='paginate sortable full'>
							<tr>
								<td><strong>PaymentDetails</strong></td>";
				if($row['Paymentdetails'] == "inflow")
				{
					echo "<td><input type='radio' name='paymentdetails' value='inflow' id='paymentdetails' checked>INFLOW<input type='radio' name='paymentdetails' value='outflow' id='paymentdetails'>OUTFLOW</td>";
				}
				else
				{
					echo "<td><input type='radio' name='paymentdetails' value='inflow' id='paymentdetails'>INFLOW<input type='radio' name='paymentdetails' value='outflow' id='paymentdetails' checked>OUTFLOW</td>";
				} 
				if($_GET['id'])
					echo '<td><input type="text" value="'.$row['PTFID'].'"></td>';	 
				echo '</tr><tr><td><strong>Date</strong></td>';
				if($_GET['id'])				
					echo'<td><input type="text" name="date" value='.$row['Date'].' readonly></td>';
				else 
					echo '<td><input type="text" id="datepicker" name="date" value='.$row['Date'].'></td>';
				$sql_des = mysql_query("SELECT * FROM finance_description"); 
				echo '<td><strong>Description</strong></td>
							<td><select id="description" name="description"><option value="select">select</option>';
				$description = mysql_fetch_array(mysql_query("SELECT * FROM financemodule WHERE id='".$_GET['id']."'")); 
				while($row_des = mysql_fetch_array($sql_des))
				{	
					$found=0;
					foreach($description as $value)	
					if($value == $row_des['description_name'])
							$found=1;
					if($found)
						echo '<option value="'.$row_des['description_name'].'" selected="selected">'.$row_des['description_name'].'</option>'; 
					else
						echo '<option value="'.$row_des['description_name'].'">'.$row_des['description_name'].'</option>'; 
				}  	
				echo '</select>
					</td>
						<td><strong>Amount</strong></td>						
					    <td><input type="text" id="amount" name="amount" value="'.$row['Amount'].'" onkeypress="return isNumberKey(event)"></td>'; 
				$sql_mode = mysql_query("SELECT * FROM finance_modeofpayment");
				echo "<td><strong>Mode of Payment</strong></td>
						<td><select id='mode' name='mode'><option value='select'>select</option>";
				$mode = mysql_fetch_array(mysql_query("SELECT * FROM financemodule WHERE id='".$_GET['id']."'")); 
				while($row_mode = mysql_fetch_array($sql_mode))
				{	
					$found=0;
					foreach($mode as $mode_value)
					if($mode_value == $row_mode['modeofpayment'])
						$found=1;
					if($found)
						echo '<option value="'.$row_mode['modeofpayment'].'" selected="selected">'.$row_mode['modeofpayment'].'</option>';
					else
						echo '<option value="'.$row_mode['modeofpayment'].'">'.$row_mode['modeofpayment'].'</option>';
				} 	 		
				echo '</select></td>
					<td>
					<strong>Details of Payment</strong>
					</td>
					<td><input type="text" value="'.$row['Detailsofpayment'].'" name="detailsofpayment" id="detailsofpayment"></td>';	 
				
				echo '</tr>
						<tr>
							<td>
								<strong>Details</strong>
							</td>
						</tr>
						<tr>	
							<td colspan="20">
								<textarea rows="5" cols="200" name="comment" id="comment" bgcolor="white"> '.$row['Details'].'</textarea>
							</td>
						</tr>';
				?>
				<script language="javascript1.2">
							generate_wysiwyg('comment');
						</script>
				<?php
				//if($_GET['id'])
				echo '<tr><td><input type="submit" value="Update" name="update"></td></tr>
				</table><br />
				</form>';
				?>
				<table>
					<tr>
						<td><a class="btn" href="?page=fullfinancialdetails&type=">All</a></td><td>&nbsp;</td>
						<td><a class="btn" href="?page=fullfinancialdetails&type=inflow">Inflow</a></td><td>&nbsp;</td>
						<td><a class="btn" href="?page=fullfinancialdetails&type=outflow">Outflow</a></td>
					</tr>
				</table><br/>
				<?php 
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1;
				if($_GET['type']) 
					$Condition = "WHERE Paymentdetails='".$_GET['type']."'";
				$rowsperpage = 20;
				$start = ($_GET['pageno']-1)*$rowsperpage;
				$sql_edit = mysql_query("SELECT * FROM financemodule $Condition ORDER BY id DESC LIMIT $start,$rowsperpage");
				$total_pages = ceil(mysql_num_rows(mysql_query("SELECT * FROM financemodule $Condition")) / $rowsperpage);
				if(mysql_num_rows($sql_edit) == 0)
					echo "<strong>NO VALUES FOR INFLOW & OUTFLOW</strong>";
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
							<th>Edit</th>
						</tr>";
					while($row_edit = mysql_fetch_array($sql_edit))
					{
						echo '<tr>
							<td>'.$row_edit['Date'].'</td>
							<td>'.$row_edit['PTFID'].'</td>
							<td>'.$row_edit['Description'].'</td>
							<td class="tablewidthamt">'.$row_edit['Amount'].'</td>
							<td class="tablewidth">'.$row_edit['Details'].'</td>
							<td>'.$row_edit['Mode'].'</td>
							<td>'.$row_edit['Detailsofpayment'].'</td>
							<td>'.$row_edit['Paymentdetails'].'</td>
							<td><a href="?page=fullfinancialdetails&id='.$row_edit['id'].'"><img src="images/edit.png" title="edit" /></a></td>
						</tr>'; 
					}
					echo '</table>';
				}
				$GetValues = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
				if($total_pages > 1)
					include('includes/pagination_1.php');
			?>
		
	</body>
</html>