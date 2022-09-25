<?php
	include('config.php');
	if(!$_GET['status'] && !$_GET['lead'] && !$_GET['workall'] && !$_GET['worknc'] || $_GET['all'])
		$workQuery = mysql_query("SELECT * FROM work ORDER BY id Desc");
	else if($_GET['status'] && !$_GET['payment'])	
		$workQuery = mysql_query("SELECT * FROM work WHERE work_id in (SELECT work_id FROM workstatus WHERE status='".$_GET['status']."' and enable=1) ORDER BY id Desc $Limit");
	else if($_GET['lead'])
		$workQuery = mysql_query("SELECT * FROM work WHERE projectleads='".$_GET['lead']."' ORDER BY id Desc");
	else if($_GET['status'] && $_GET['payment'])
		$workQuery = mysql_query("SELECT * FROM work WHERE work_id IN(SELECT work_id FROM workstatus WHERE status='".$_GET['status']."' and enable=1) ORDER By id desc");
	else if($_GET['workall'])
		$workQuery = mysql_query("SELECT * FROM work WHERE work_id IN(SELECT work_id FROM workstatus WHERE enable=1) ORDER By id desc");
	else if($_GET['worknc'])
		$workQuery = mysql_query("Select * From work where work_id in(Select work_id From workstatus Where status!='Closed' and enable=1)");
	if(!$_GET['payment'] && !$_GET['workall'] && !$_GET['worknc'])	
	{
		if(mysql_num_rows($workQuery))
		{
			echo "<div style='width:1000px;height:550px;overflow-x:scroll;overflow-y:auto;'>
					<div style='float:left;margin-top:25px;margin-left:50px;width:850px;height:0;'>";
					if(!$_GET['status'] && !$_GET['lead'] || $_GET['all'])
						echo "<table id='sub1'><tr><td><h1>Work Summary</h1></td></tr></table>";
					else if($_GET['status'])
						echo "<table id='sub1'><tr><td><h1>Work of ".$_GET['status']."</h1></td></tr></table>";
					else if($_GET['lead'])
						echo "<table id='sub1'><tr><td><h1>Work of ".$_GET['lead']."</h1></td></tr></table>";
					echo "<table border='1'  align= 'left' style='width:1000px' class='paginate sortable full1' id='sub'>
				<tr>
					<th align='left'>Work-ID</th>
					<th align='left'>Client Name</th>
					<th align='left'>Description</th>
					<th align='left'>Priority</th>
					<th align='left'>Project Lead</th>
					<th align='left'>Target Date</th>
					<th align='left'>Developer</th>
					<th align='left'>Tester</th>
				</tr>";
		}
		while($fetchWork = mysql_fetch_array($workQuery))
		{
			echo "<tr>
					<td><a href='?page=workstatus&workId=".$fetchWork['work_id']."&leadid=".$fetchWork['lead']."&clientid=".$fetchWork['client']."'>".$fetchWork['work_id']."</a></td>";
					$getClient = mysql_fetch_array(mysql_query("SELECT * FROM client WHERE ptcid = '".$fetchWork['client']."'"));
				echo "<td>".$getClient['cname']."</td>
					<td>".$fetchWork['description']."</td>
					<td>".$fetchWork['priority']."</td>
					<td>".$fetchWork['projectleads']."</td>
					<td>".$fetchWork['tdate']."</td>
					<td>".$fetchWork['developer']."</td>
					<td>".$fetchWork['tester']."</td>
				</tr>";
		}
		echo '</table></div></div>';
	}
	else if($_GET['workall'] || ($_GET['status'] && $_GET['payment']) || $_GET['worknc'])
	{
		if(mysql_num_rows($workQuery))
		{
			echo "<div style='width:1000px;height:550px;overflow-x:scroll;overflow-y:auto;'>
					<div style='float:left;margin-top:25px;margin-left:50px;width:850px;height:0;'>";
			if($_GET['workall'])
				echo "<table id='sub1'><tr><td><h1>Work Summary Of All Status </h1></td></tr></table>";
			else if($_GET['status'] && $_GET['payment'])
				echo "<table id='sub1'><tr><td><h1>Work Summary Of All Status </h1></td></tr></table>";
			else if(isset($_GET['worknc']))
				echo "<table id='sub1'><tr><td><h1>Work Summary Of Not Closed Status </h1></td></tr></table>";
					echo "<table border='1'  align= 'left' style='width:1000px' class='paginate sortable full' id='sub'>
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
			echo '</table></div></div>';
		}
	}
		echo '<div style="float:left;margin-top:20px;margin-left:400px;width:123px">';
		//include("includes/pagination.php");
		echo '</div>';
	echo '<div style="float:left;margin-top:-500px;margin-left:-720px;width:200px">';
			echo "<table  border='1'  align='left' class='paginate sortable full1'>
					<tr>
						<th>Work Status</th>
						<th>No. of Item</th>
					</tr>";
			echo '<tr><td><a href="#" onclick="getWork(\'includes/getWork.php?all=all\')">All</a></td><td><a>'.mysql_num_rows(mysql_query("SELECT * FROM work WHERE work_id in (SELECT work_id FROM workstatus WHERE  enable=1)")).'</a></td>';
			$status = array('Open','Inprogress','Hold','Resolved','Closed');
			foreach($status as $st)
			{
				echo '<tr><td>';?><a href="#" onclick="getWork('includes/getWork.php?status=<?php echo $st;?>')"><?php echo $st.'</a></td>
						<td><a>';
							$fetchStatus = mysql_query("SELECT * FROM work WHERE work_id in (SELECT work_id FROM workstatus WHERE status='".$st."' AND enable=1)");
							echo mysql_num_rows($fetchStatus);
						echo '</a></td>
				<tr>';
			}	
			echo '</table>';
				echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
			
		$queryLead = mysql_query("SELECT * FROM assignee");
			echo "<table  border='1'  align='left' class='paginate sortable full1'>
					<tr>
						<th>Project Leads</th>
						<th>No. Of Items</th>
					</tr>";
			while($fetchLead = mysql_fetch_array($queryLead))
			{
				echo "<tr><td>";?><a href='#' onclick="getLead('includes/getLead.php?lead=<?php echo $fetchLead['name']; ?>')"><?php echo $fetchLead['name']."</a></td>
						<td><a>";
						$countLeads = mysql_query("SELECT * FROM work WHERE projectleads='".$fetchLead['name']."'");
						echo mysql_num_rows($countLeads);
				echo "</a></td></tr>";
			}		
			echo '</table>';
			echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
			echo "<table  border='1'  align='left' class='paginate sortable full1'>
					<tr>
						<th>Work Payment</th>
						<th>No. of Item</th>
					</tr>";
			echo '<tr><td><a href="#" onclick="getWork(\'includes/getWork.php?worknc=nc\')">All-NC</a></td><td><a>'.mysql_num_rows(mysql_query("Select * From work where work_id in(Select work_id From workstatus Where status!='Closed' and enable=1 AND work_id IN(Select workid From workpayment))")).'  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.mysql_num_rows(mysql_query("Select * From work where work_id in(Select work_id From workstatus Where status!='Closed' and enable=1)")).'</a></td>
					</tr><tr><td><a href="#" onclick="getWork(\'includes/getWork.php?workall=all\')">All</a></td><td><a>'.mysql_num_rows(mysql_query("SELECT * FROM work WHERE work_id in (SELECT work_id FROM workstatus WHERE enable=1 AND work_id IN(Select workid From workpayment))")).'  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.mysql_num_rows(mysql_query("SELECT * FROM work WHERE work_id in (SELECT work_id FROM workstatus WHERE  enable=1)")).'</a></td>';
			$status = array('Open','Inprogress','Hold','Resolved','Closed');
			foreach($status as $st)
			{
				echo '<tr><td>';?><a href="#" onclick="getWork('includes/getWork.php?status=<?php echo $st;?>&payment=1')"><?php echo $st.'</a></td>
						<td><a>';
							$fetchStatus_WithWorkPayment = mysql_query("SELECT * FROM work WHERE work_id in (SELECT work_id FROM workstatus WHERE status='".$st."' AND enable=1 AND work_id IN(Select workid From workpayment))");
							$fetchStatus_WithoutWorkPayment = mysql_query("SELECT * FROM work WHERE work_id in (SELECT work_id FROM workstatus WHERE status='".$st."' AND enable=1)");
							echo mysql_num_rows($fetchStatus_WithWorkPayment)."  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".mysql_num_rows($fetchStatus_WithoutWorkPayment);
						echo '</a></td>
				<tr>';
			}	
			echo '</table>';
			
	echo '</div>';
	echo '<div style="float:left;margin-top:-0px;margin-left:-450px;width:100px;height:1250px">';
		echo 	'<h1><center>Filter</center></h1><table  border="1"  align="left" class="paginate sortable full1" width="500px";>
	
			<tr>
			<td>Client:<select id="client" onchange="getWorkId(this.value)">
			<option value="">All</option>';
			$query_client = mysql_query("Select * From client");
			while($row_client = mysql_fetch_array($query_client))
			{
				echo '<option value="'.$row_client['ptcid'].'">'.$row_client['cname']."-".$row_client['ptcid'].'</option>';
			}
			echo '</select></td>
			<td><div id="work1"></div></td>
			<td>
				<label>Status:</label>
					<select name="status" id="status">
					<option value="">All</option>';
							$status = array('Open','Inprogress','Hold','Resolved','Closed');
							foreach($status as $st)
							{
								if($workStatusQuery['status'] == $st)
									echo '<option value='.$st.' selected>'.$st.'</option>';
								else
									echo '<option value='.$st.'>'.$st.'</option>';
							}
			echo	'</select></td>';
			echo "<td><button onclick ='loadXMLDoc2()'>Search</button></td></tr></table>";		
	echo	'</div >';	
		
?>
<script>
	function getWork(url)
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
				var split_table = results.split('#');
				document.getElementById('sub1').innerHTML = split_table[0];
				document.getElementById('sub').innerHTML = split_table[1];
			}
		}
		xmlhttp.open("GET",url,true);
		xmlhttp.send();
	}
	function getWorkId(ClientId)
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
				document.getElementById('work1').innerHTML = xmlhttp.responseText;
				/*var results = xmlhttp.responseText;
				var values = results.split("#");
				var select = document.getElementById('work');
				select.options.length = 0; 	//For remove all options of dropdown list
				for(var i = 0; i < values.length; i++)
				{
					if(i%2 == 0)
						select.options[select.options.length] = new Option(values[i],values[i+1]);
				}*/
			}
		}
		xmlhttp.open("GET","includes/getWorkId.php?ClientId="+ClientId,true);
		xmlhttp.send();
	}
	function loadXMLDoc2()
	{	
		var status = document.getElementById('status').value;
		var work = document.getElementById('work').value;
		var client = document.getElementById('client').value;
		var url = "includes/getworksearch.php?client="+client+"&work="+work+"&status="+status;
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
				//alert(results);
				var split_table = results.split('#');
				document.getElementById('sub1').innerHTML = split_table[0];
				document.getElementById('sub').innerHTML = split_table[1];
			}
		}
		xmlhttp.open("GET",url,true);
		xmlhttp.send();
	}
	function getLead(url)
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
				var split_table = results.split('#');
				document.getElementById('sub1').innerHTML = split_table[0];
				document.getElementById('sub').innerHTML = split_table[1];
			}
		}
		xmlhttp.open("GET",url,true);
		xmlhttp.send();
	}
</script>