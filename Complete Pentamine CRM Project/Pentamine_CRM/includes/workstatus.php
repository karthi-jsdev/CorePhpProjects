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
			
		</script>
		<div style="float:left;margin-top:25px;margin-left:1000px;width:500px">
			<button onclick="window.location.href='?page=workpayment&workid=<?php echo $_GET['workId'];?>&leadid=<?php echo $_GET['leadid'];?>&clientid=<?php echo $_GET['clientid']; ?>'">Work Payment</button>
		</div>
<?php
	include('config.php');

	if($_POST['update'])
	{
		mysql_query("Update workstatus SET enable=0 Where work_id='".$_GET['workId']."'");
		mysql_query("INSERT INTO workstatus values('null','".$_GET['workId']."','".$_POST['desc']."','".$_POST['status']."','".$_POST['updatestatus']."','1')");
	}
	echo '<div style="float:left;margin-top:0px;margin-left:-195px;width:200px">';
		$queryLead = mysql_query("SELECT * FROM assignee");
			echo "<table  border='1'  align='left' class='paginate sortable full1'>
					<tr>
						<th>Work Status</th>
						<th>No. of Item</th>
					</tr>";
			echo '<tr><td><a href="?page=worksummary&all=all">All</a></td><td><a>'.mysql_num_rows(mysql_query("SELECT * FROM work WHERE work_id in (SELECT work_id FROM workstatus WHERE  enable=1)")).'</a></td></tr>';
			$status = array('Open','Inprogress','Hold','Resolved','Closed');
			foreach($status as $st)
			{
				echo '<tr><td><a href="?page=worksummary&status='.$st.'">'.$st.'</a></td>
						<td><a>';
							$fetchStatus = mysql_query("SELECT * FROM work WHERE work_id in (SELECT work_id FROM workstatus WHERE status='".$st."' AND enable=1)");
							echo mysql_num_rows($fetchStatus);
						echo '</a></td>
				<tr>';
			}
		echo '</table>';			
			echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/>';
			
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
			echo '</table><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
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
	echo '<div style="float:left;margin-top:-0px;margin-left:0px;width:500px">';
		?><button onclick="window.location.href='?page=recurring&workId=<?php echo $_GET[workId];?>'" id="recurring">Enable Recurring </button>
	<?php echo '</div>';
	echo '<div style="float:left;margin-top:-0px;margin-left:0px;width:900px">';
	$SelectWorkPayment1 = mysql_fetch_array(mysql_query("Select * From workpayment where workid='".$_GET['workId']."' order by id desc"));
	$SelectWorkPayment = mysql_query("Select * From workpayment where workid='".$_GET['workId']."' order by id desc");
	$TotalAmountPaid = 0;
	while($FetchTotalAmount = mysql_fetch_array($SelectWorkPayment))
	{
		$TotalAmountPaid += $FetchTotalAmount['total'];
	}
	echo "<h1>Work Payment Summary</h1>";
	$query5 = mysql_query("SELECT * FROM comments WHERE ptclid='".$_GET['leadid']."' ORDER BY id DESC"); 
	$TotalAmountFetch = mysql_fetch_array($query5);
	$PendingAmount = $TotalAmountFetch['total']-$TotalAmountPaid;
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
	echo "<h1>Work Status</h1>";
	echo "<br/><table border='1'  align= 'center' class='paginate sortable full'>";
	$sql = mysql_query("SELECT * from work where work_id='".$_GET['workId']."'");
	$row = mysql_fetch_array($sql);
	echo 	"<tr>
				<th align='left'>Work Id:</th>
				<td>".$_GET['workId']."</td>
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
	$workStatusQuery = mysql_fetch_array(mysql_query("SELECT * FROM workstatus WHERE work_id='".$_GET['workId']."' ORDER BY id DESC"));
?>

<script language="JavaScript" type="text/javascript" src="js/wysiwyg.js"></script>
<html>
	<body>
		<form action="" method="post" class="form panel" id="form">
			<header>
				<h2>Work Status</h2>
			</header>
			<hr>
			<fieldset>
				<div class="clearfix">
					<label>Description:</label>
					<textarea name="desc" id="desc"> </textarea>
					<script language="javascript1.2">
						generate_wysiwyg('desc');
					</script>
				</div>
				<div class="clearfix">
					<label>Status:</label>
					<select name="status" id="status">
						<?php
							$status = array('Open','Inprogress','Hold','Resolved','Closed');
							foreach($status as $st)
							{
								if($workStatusQuery['status'] == $st)
									echo '<option value='.$st.' selected>'.$st.'</option>';
								else
									echo '<option value='.$st.'>'.$st.'</option>';
							}
						?>
					</select> 
				</div>	
				<div class="clearfix">
					<label>Update Status:</label>
					<select name="updatestatus">
							<option value='Select'>Select</option>
						<?php
							$updateStatus = array('Phase Completion','Invoice','Progress Update','Requirement Update');
							for($i = 0;$i< count($updateStatus);$i++)
							{
								echo '<option value="'.$updateStatus[$i].'">'.$updateStatus[$i].'</option>';
							}
						?>
					</select>	
				</div>
			</fieldset>	
			<hr>
			<button class="button button-green" type="submit" name="update" value="update">Update</button>
		</form>
		</div>
	</body>
</html>
<br />
	
	
<?php
	
		$workStatusQuery = mysql_query("SELECT * FROM workstatus WHERE work_id='".$_GET['workId']."' ORDER BY id DESC");
		if(mysql_num_rows($workStatusQuery))
		{
			echo "<div style='width:1000px;height:550px;overflow-x:scroll;overflow-y:auto;'>
					<table border='1'  align= 'left' style='width:1000px' class='paginate sortable full'>
				<tr>
					<th align='left'>Work-ID</th>
					<th align='left'>Description</th>
					<th align='left'>Status</th>
					<th align='left'>Update Status</th>
				</tr>";
		}
		while($fetchWorkStatus = mysql_fetch_array($workStatusQuery))
		{
			echo "<tr>
					<td>".$fetchWorkStatus['work_id']."</td>
					<td>".$fetchWorkStatus['description']."</td>
					<td>".$fetchWorkStatus['status']."</td>
					<td>".$fetchWorkStatus['updatestatus']."</td>
				</tr>";
		}
		echo "</table></div>";
			echo '<div style="float:left;margin-top:20px;margin-left:400px;width:2000px;height:1000px">';
				//include("includes/pagination.php");
			echo '</div>';
?>
<script>
	
	$("#status").ready(function()
	{
		if ($(this).val() == "")
		{
			$("#recurring").hide();
		}
	});
	$("#status").change(function() 
	{
		// foo is the id of the other select box 
		 if ($(this).val() == "Closed")
		{
			$("#recurring").show();
		}else
		{
			$("#recurring").hide();
		} 
	});
</script>

