<script>
			$(document).ready(function()
			{
				$("h").hide();
				$(".btn1").hide();
				$(".btn1").click(function()
				{
					$("h").hide(500);
					$(".btn1").hide();
					$(".btn2").show();
				});
				$(".btn2").click(function()
				{
					$("h").show(500);
					$(".btn1").show();
					$(".btn2").hide();
				});	
				$(".btn3").hide();
				$("display").show();
				$("nondisplay").hide();
				$(".btn3").click(function()
				{
					$("display").show();
					$("nondisplay").hide();
					$(".btn3").hide();
					$(".btn4").show();
				});
				$(".btn4").click(function()
				{
					$("nondisplay").show();
					$("display").hide();
					$(".btn3").show();
					$(".btn4").hide();
				});
			});
			function calculate() 
			{
				var cost = Number(document.getElementById("amount").value);
				var tax = Number(document.getElementById("tax").value);				
				var total = cost + (cost * (tax / 100));
				total = parseFloat(total).toFixed(2);
				document.getElementById("total").value = total;
			}
			
		</script>

<?php 
//echo '<div style="float:left;margin-top:0px;margin-left:150px;width:800px;">';
	if($_POST['update'] && $_POST['total'] && $_POST['tax'] && $_POST['amount'])
	{
		mysql_query("INSERT into workpayment values('null','".$_POST['total']."','".$_GET['workid']."','".$_POST['tax']."','".$_POST['amount']."','".$_POST['invoice']."')");
	}
	echo '<div style="float:left;margin-top:10px;margin-left:-195px;width:200px">';
		$queryLead = mysql_query("SELECT * FROM assignee");
			echo "<table  border='1'  align='left' class='paginate sortable full1'>
					<tr>
						<th>Work Status</th>
						<th>No. of Item</th>
					</tr>";
			$status = array('Open','Inprogress','Hold','Resolved','Closed');
			foreach($status as $st)
			{
				echo '<tr><td><a href="?page=worksummary&status='.$st.'">'.$st.'</a></td>
						<td><a>';
							$fetchStatus = mysql_query("SELECT * FROM work WHERE work_id in (SELECT work_id FROM workstatus WHERE status='".$st."' and enable=1)");
							echo mysql_num_rows($fetchStatus);
						echo '</a></td>
				<tr>';
			}
		echo '</table>';			
			echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
			
		$queryLead = mysql_query("SELECT * FROM assignee");
			echo "<br /><table  border='1'  align='left' class='paginate sortable full1'>
					<tr>
						<th>Project Leads</th>
						<th>No. Of Items</th>
					</tr>";
			while($fetchLead = mysql_fetch_array($queryLead))
			{
				echo "<tr><td><a href='?page=worksummary&lead=".$fetchLead['name']."'>".$fetchLead['name']."</a></td>
						<td><a>";
						$countLeads = mysql_query("SELECT * FROM work WHERE projectleads='".$fetchLead['name']."'");
						echo mysql_num_rows($countLeads);
				echo "</a></td></tr>";
			}		
			echo '</table>';
			echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
			echo "<table  border='1'  align='left' class='paginate sortable full1'>
					<tr>
						<th>Work Payment</th>
						<th>No. of Item</th>
					</tr>";
			echo '<tr><td><a href="?page=worksummary&worknc=nc">All-NC</a></td><td><a>'.mysql_num_rows(mysql_query("Select * From work where work_id in(Select work_id From workstatus Where status!='Closed' and enable=1 AND work_id IN(Select workid From workpayment))")).'  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.mysql_num_rows(mysql_query("Select * From work where work_id in(Select work_id From workstatus Where status!='Closed' and enable=1)")).'</a></td></tr><tr><td><a href="?page=worksummary&workall=all">All</a></td><td><a>'.mysql_num_rows(mysql_query("SELECT * FROM work WHERE work_id in (SELECT work_id FROM workstatus WHERE enable=1 AND work_id IN(Select workid From workpayment))")).'  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.mysql_num_rows(mysql_query("SELECT * FROM work WHERE work_id in (SELECT work_id FROM workstatus WHERE  enable=1)")).'</a></td>';
			$status = array('Open','Inprogress','Hold','Resolved','Closed');
			foreach($status as $st)
			{
				echo '<tr><td>';?><a href="?page=worksummary&status=<?php echo $st;?>&payment=1"><?php echo $st.'</a></td>
						<td><a>';
							$fetchStatus_WithWorkPayment = mysql_query("SELECT * FROM work WHERE work_id in (SELECT work_id FROM workstatus WHERE status='".$st."' AND enable=1 AND work_id IN(Select workid From workpayment))");
							$fetchStatus_WithoutWorkPayment = mysql_query("SELECT * FROM work WHERE work_id in (SELECT work_id FROM workstatus WHERE status='".$st."' AND enable=1)");
							echo mysql_num_rows($fetchStatus_WithWorkPayment)."  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".mysql_num_rows($fetchStatus_WithoutWorkPayment);
						echo '</a></td>
				<tr>';
			}	
			echo '</table>';
	echo '</div>';
	echo '<div style="float:left;margin-top:-0px;margin-left:50px;width:900px">';
	$query5 = mysql_query("SELECT * FROM comments WHERE ptclid='".$_GET['leadid']."' ORDER BY id DESC"); 
	$TotalAmountFetch = mysql_fetch_array($query5);
	$SelectWorkPayment1 = mysql_fetch_array(mysql_query("Select * From workpayment where workid='".$_GET['workid']."' order by id desc"));
	$SelectWorkPayment = mysql_query("Select * From workpayment where workid='".$_GET['workid']."' order by id desc");
	$TotalAmountPaid = 0;
	while($FetchTotalAmount = mysql_fetch_array($SelectWorkPayment))
	{
		$TotalAmountPaid += $FetchTotalAmount['total'];
	}
	$PendingAmount = $TotalAmountFetch['total']-$TotalAmountPaid;
	echo "<h1>Work Payment Summary</h1>";
	echo "<table border='1'  align= 'center' class='paginate sortable full'>";
	echo 	"<tr>
				<th align='center'>Total Amount:</th>
				<td>".$TotalAmountFetch['total']."</td>
				<th align='center'>Total Amount Paid:</th>
				<td>".$TotalAmountPaid."</td>
				<th align='center'>Pending-Amount:</th>
				<td>".$PendingAmount."</td>";
				echo "
	</table>";
	echo "<h1>Work Detail</h1>";
	echo "<table border='1'  align= 'center' class='paginate sortable full'>";
	$sql = mysql_query("SELECT * from work where work_id='".$_GET['workid']."'");
	$row = mysql_fetch_array($sql);
	echo 	"<tr>
				<th align='left'>Work Id:</th>
				<td>".$_GET['workid']."</td>
				<th align='left'>Description:</th>
				<td>".$row['description']."</td>
				<th align='left'>Created Date:</th>
				<td>".$row['createdat']."</td><th style='none'> 
				<td style='none'>";
				echo "<button class='btn1'>Hide</button>
			<button class='btn2'>".$_GET['clientid']."
			</button>
										</td></th>
									</tr>
	</table>";
	
	$query = mysql_query("SELECT * FROM client where ptcid = '".$_GET['clientid']."'");
	
	if($row = mysql_fetch_array($query))
	{
		$row5 = mysql_fetch_array($query5);
		$status = mysql_fetch_array(mysql_query("SELECT * FROM status  WHERE slno='".$row5['status_id']."'"));		
	echo"<h><table border='1'  align='center' class='paginate sortable full'>
				<tr>
					<td colspan='2'><strong>Company Information</strong></td>
					<td style='width:10px;'> </td>
					<td colspan='2'><strong>Contact Information1</strong></td>
					<td style='width:10px;'> </td>
					<td colspan='2'><strong>Contact Information2</strong></td>
					<td style='width:10px;'> </td>";
					if(mysql_num_rows($query5))
						echo "<td colspan='2'><strong>Previous Comments</strong></td>";
			echo "</tr>
				<tr>
					<td>".$row['cname']."</td>
					<td style='width:30px;'>
					<td style='width:30px;'>
					<td>".$row['cpname1']." </td>
					<td style='width:30px;'>
					<td style='width:30px;'>
					<td>".$row['cpname2']."</td><td style='width:10px;'> </td>";
					if($row5)
					{
						$var = $row5['comment'];
						$newtext = wordwrap($var, 80, "\n",true);
						echo "<td style='width:30px;'><td>".$newtext."</td>";	
					}
		echo "</tr>";
		echo "<tr>
				<td>".$row['caddress']."</td>
				<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cppos1']."</td>
				<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cppos2']."</td>";
				if($row5)
					echo "<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row5['cdate']."</td>"; 
		echo "</tr>";
		echo "<tr>
				   <td>".$row['cemail']."</td>
				   <td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cpemail1']."</td>
				  <td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cpemail2']."</td>";
				   if($row5)
					echo "<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row5['fdate']."</td>";
		echo "</tr>";
		echo "<tr>
					<td>".$row['cnum1']."</td>
					<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cpnum1']."</td>
					<td style='width:30px;'></td><td style='width:30px;'></td><td>".$row['cpnum2']."</td>";
					if($row5)
						echo "<td style='width:30px;'></td><td style='width:30px;'></td><td>".$status['status']."</td>";
		echo "</tr>";
		echo "<tr>
					<td><strong>Reference:</strong>
					".$row['reference']."</td>";
					$fetchLead = mysql_fetch_array(mysql_query("SELECT * from lead where ptclid='".$_GET['id']."'"));
					$fetchProduct = mysql_fetch_array(mysql_query("SELECT * from producttype where slno='".$fetchLead['ptype']."'"));
					$fetchSubProduct = mysql_fetch_array(mysql_query("SELECT * from  productsubtype where id='".$fetchLead['pstype']."'"));
					echo "<td style='width:30px;'></td><td style='width:30px;'></td><td>".$fetchProduct['type']."</td>
					<td style='width:30px;'></td><td style='width:30px;'></td><td>".$fetchSubProduct['type']."</td>
				 </tr>";
	echo		"</table>";
			 echo "</h><br />";
	}
	
?>
<form action="" method="post"  id="">
	<table>
		<tr>
			<td>
				Payment-Amount:<?php
				echo  '<input type="text" name="amount" id="amount"  class="decimal" value="'.$SelectWorkPayment1['amount'].'" onkeypress="return isNumberKey(event)" autocomplete="off">';
				?>
			</td>
			<td>
				<br>
				Tax:
				<select name="tax" id="tax" onchange="calculate()" >
					<option value='select'>Select</option>
					<?php
						if($SelectWorkPayment1['tax'] == "5.5")
							echo "<option value='5.5' selected>5.5%</option>";
						else
							echo "<option value='5.5'>5.5%</option>";
						if($SelectWorkPayment1['tax'] == "12.36")
							echo "<option value='12.36' selected>12.36%</option>";
						else
							echo "<option value='12.36'>12.36%</option>";
						if($SelectWorkPayment1['tax'] == "14.5")
							echo "<option value='14.5' selected>14.5%</option>";
						else
							echo "<option value='14.5'>14.5%</option>";
					?>
				</select>
			</td>
			
			<td>
				Total:
				<?php
				echo  '<input type="text" name="total" id="total" value="'.$SelectWorkPayment1['total'].'" autocomplete="off">';
				?>
			</td>
			<td>
				Invoice:
				<?php
				echo  '<input type="text" name="invoice" id="" value="" autocomplete="off">';
				?>
			</td>
		</tr>
	</table>
	<button type="submit" name="update" value="update">Update</button>
</form>
</div>
<script>
	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57) &&toPrecision(2))
			return false;
		else
			return true;
	}
</script>
<br>
<br>
<br>
<?php
$SelectWorkPayment = mysql_query("Select * From workpayment where workid='".$_GET['workid']."' order by id desc");
/*$SelectWorkPayment1 =mysql_query("Select * From workpayment where workid='".$_GET['workid']."' order by id desc");
$TotalAmountPaid =0;
while($FetchWorkPayment1 = mysql_fetch_array($SelectWorkPayment1))
{
	$TotalAmountPaid += $FetchWorkPayment1['total'];
}*/

if(mysql_num_rows($SelectWorkPayment))
{
	echo '<table class="paginate sortable full">
			<tr>
				<th>Work-Id</th>
				<th>Invoice</th>
				<th>Paid</th>
				<th>Paid(T)</th>
				<th>Amount</th>
				<th>Tax</th>
				<th>Total Amount</th>
				<th>Total Amount Paid</th>
				<th>Pending</th>
			</tr>';
				$SelectLead = mysql_fetch_array(mysql_query("Select * From comments where ptclid='".$_GET['leadid']."' order by id desc"));
				$TotalAmount = $Pending_Amount = 0;
				$i = 0;
				while($FetchWorkPayment = mysql_fetch_array($SelectWorkPayment))
				{
					if(!$i++)
						$TotalAmount = $TotalAmountPaid;
					else
						$TotalAmount = $TotalAmount - $FetchWorkPayment['total'];
					$Pending_Amount = $SelectLead['total'] - $TotalAmount;
					echo '<tr>
							<td align="center">'.$FetchWorkPayment['workid'].'</td>
							<td align="center">'.$FetchWorkPayment['invoice'].'</td>
							<td align="center">'.$FetchWorkPayment['amount'].'</td>
							<td align="center">'.$FetchWorkPayment['total'].'</td>
							<td align="center">'.$SelectLead['amount'].'</td>
							<td align="center">'.$FetchWorkPayment['tax'].'</td>
							<td align="center">'.$SelectLead['total'].'</td>
							<td align="center">'.$TotalAmount.'</td>
							<td align="center">'.$Pending_Amount.'</td>
						</tr>';
				}
	echo '</table>';
}
?>