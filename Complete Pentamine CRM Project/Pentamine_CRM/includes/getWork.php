<?php
	include('config.php');
	if((isset($_GET['status']) && !isset($_GET['payment'])) || isset($_GET['all']))
	{
		if(isset($_GET['status']) && !isset($_GET['payment']))
			$workQuery = mysql_query("SELECT * FROM work WHERE work_id IN(SELECT work_id FROM workstatus WHERE status='".$_GET['status']."' and enable=1) ORDER BY id desc");	
		else 
			$workQuery = mysql_query("SELECT * FROM work WHERE work_id IN(SELECT work_id FROM workstatus WHERE  enable=1) ORDER BY id desc");	
		if(mysql_num_rows($workQuery))
		{
			echo "<table>";
					if(isset($_GET['status']))
						echo "<tr><td><h1>Work Summary Of ".$_GET['status']." </h1></td></tr>";
					else
						echo "<tr><td><h1>Work Summary Of All Status </h1></td></tr>";
				echo	"</table>#
					<table border='1'  align= 'left' style='width:1000px' class='paginate sortable full' >
				<tr>
					<th align='left'>Work-ID</th>
					<th align='left'>Client Name</th>
					<th align='left'>Lead-ID</th>
					<th align='left'>Description</th>
					<th align='left'>Priority</th>
					<th align='left'>Project Lead</th>
					<th align='left'>Target Date</th>
					<th align='left'>Developer</th>
					<th align='left'>Tester</th>
				</tr>";
				while($fetchWork = mysql_fetch_array($workQuery))
				{
					echo "<tr>
							<td><a href='?page=workstatus&workId=".$fetchWork['work_id']."&leadid=".$fetchWork['lead']."&clientid=".$fetchWork['client']."'>".$fetchWork['work_id']."</a></td>";
							$getClient = mysql_fetch_array(mysql_query("SELECT * FROM client WHERE ptcid = '".$fetchWork['client']."'"));
							echo "<td>".$getClient['cname']."</td>
							<td>".$fetchWork['lead']."</td>
							<td>".$fetchWork['description']."</td>
							<td>".$fetchWork['priority']."</td>
							<td>".$fetchWork['projectleads']."</td>
							<td>".$fetchWork['tdate']."</td>
							<td>".$fetchWork['developer']."</td>
							<td>".$fetchWork['tester']."</td>
						</tr>";
				}
			echo "</table>";
		}
		else
			echo "No Data Found #";
	}
	else if((isset($_GET['status']) && isset($_GET['payment'])) || (isset($_GET['workall'])) || (isset($_GET['worknc'])))
	{
		if(isset($_GET['status']) && isset($_GET['payment']))
			$workQuery = mysql_query("SELECT * FROM work WHERE work_id IN(SELECT work_id FROM workstatus WHERE status='".$_GET['status']."' and enable=1) ORDER BY id desc");
		else if(isset($_GET['workall']))
			$workQuery = mysql_query("SELECT * FROM work WHERE work_id IN(SELECT work_id FROM workstatus WHERE enable=1) ORDER BY id desc");
		else if(isset($_GET['worknc']))
			$workQuery = mysql_query("Select * From work where work_id in(Select work_id From workstatus Where status!='Closed' and enable=1)");
		if(mysql_num_rows($workQuery))
		{
			if(isset($_GET['status']) && isset($_GET['payment']))
				echo "<table><tr><td><h1>Work Summary Of ".$_GET['status']." </h1></td></tr></table>#";
			else if(isset($_GET['workall']))
				echo "<table><tr><td><h1>Work Summary Of All Status </h1></td></tr></table>#";
			else if(isset($_GET['worknc']))
				echo "<table><tr><td><h1>Work Summary Of Not Closed Status </h1></td></tr></table>#";
			echo 	"<table border='1'  align= 'left' style='width:1000px' class='paginate sortable full' >
				<tr>
					<th align='left'>Work-ID</th>
					<th align='left'>Client Name</th>
					<th align='left'>Total Amount</th>
					<th align='left'>Total Amount Paid</th>
					<th align='left'>Pending-Amount</th>
				</tr>";
				$TotalAmount=$TotalAmountPaid=$TotalAmountPending=0;
				while($fetchWork = mysql_fetch_array($workQuery))
				{
					echo "<tr>
							<td><a href='?page=workstatus&workId=".$fetchWork['work_id']."&leadid=".$fetchWork['lead']."&clientid=".$fetchWork['client']."'>".$fetchWork['work_id']."</a></td>";
							$getClient = mysql_fetch_array(mysql_query("SELECT * FROM client WHERE ptcid = '".$fetchWork['client']."'"));
							echo "<td>".$getClient['cname']."</td>";
							$SelectWorkPayment = mysql_query("Select * From workpayment Where workid='".$fetchWork['work_id']."' Order by id desc");
							$TotalAmountPay = 0;
							while($FetchWorkPayment = mysql_fetch_array($SelectWorkPayment))
							{
								$TotalAmountPay += $FetchWorkPayment['total'];
							}
							$SelectTotalAmount = mysql_fetch_array(mysql_query("Select * From comments Where ptclid='".$fetchWork['lead']."' Order By id Desc"));
							$PendingAmount = $SelectTotalAmount['total']-$TotalAmountPay;
							echo "<td>".$SelectTotalAmount['total']."</td>
							<td>".$TotalAmountPay."</td>
							<td>".$PendingAmount."</td>
						</tr>";
					$TotalAmountPaid += $TotalAmountPay;
					$TotalAmountPending += $PendingAmount;
					$TotalAmount += $SelectTotalAmount['total'];
				}
				echo "<tr>
						<td></td>
						<td><b>Total:</b></td>
						<td>".$TotalAmount."</td>
						<td >".$TotalAmountPaid."</td><td>".$TotalAmountPending."</td>
				</tr>";
			echo "</table>";
		}
		else
			echo "No Data Found #";
	}
?>