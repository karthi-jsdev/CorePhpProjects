<!--form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel">
	<?php
	$_GET['Initial'] = 1;
	include("includes/Dashboard_Table.php");
	date_default_timezone_set('Asia/Calcutta');
	?>
</form-->
<table>
	<?php 
		echo "<tr><td align='center'> <span id='blink'><font color='#006021'>Todays Date - ". (Date("l F d, Y"))."</font></span></td></tr>";
	?>
	<tr><th align="left"><h3><label>Students Chart</label></h3></th>
	<th align="left"><h3><label>Teachers Chart</label></h3></th></tr>
	<tr>
		<td><?php include("StudentChart.php"); ?></td>
		<td><?php include("TeachersChart.php"); ?></td>
	</tr>
	<tr><th align="left"><h3><label>BusRoute Chart</label></h3></th></tr>
	<tr>
		<td><?php include("BusRouteChart.php"); ?></td>
	</tr>
</table>
	<div class="widget"  style="width:400px;">
		<font size=2px>
			<h2>Birthday Celebrities</h2>
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th align='left'>Si.No.</th>
						<th align='left'>Name</th>
						<th align='left'>Class</th>
						<th align='left'>Section</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i=1;
						$Birthday_Celebrities = mysqli_query($_SESSION['connection'],"SELECT class.name as classname,section.name as sectionname,`student_admission`.first_name as firstname,`student_admission`.last_name as lastname FROM `student_admission` join section ON section.id = `student_admission`.section_id join class on section.classid = class.id where MONTH(dob) = MONTH(CURDATE()) and  DAY(dob) = DAY(CURDATE()) order by section.classid");
						while($Birthday = mysqli_fetch_array($Birthday_Celebrities))
						{
							echo "<tr>
								<td>".$i++."</td>";
								echo "<td>".$Birthday['firstname']."".$Birthday['lastname']."</td>
								<td>".$Birthday['classname']."</td>
								<td>".$Birthday['sectionname']."</td>
							</tr>";
						}
					?>
				</tbody>
			</table>
		</font>
	</div>
<?php
	echo '<h2>Terms Summary</h2>
			<table class="paginate sortable full"><thead>
			<tr>
				<th>Terms</th>
				<th>Total Amount</th>
				<!--th>Payed</th-->
				<th>Pending</th>
			</tr></thead><tbody>';
			$SelectTerms = mysqli_query($_SESSION['connection'],"select * from term");
			$ArryValue = array();
			$TotalAmount = 0;
			$TotalPending = 0;
			while($FetchTerms = mysqli_fetch_array($SelectTerms))
			{	
				echo '<tr>
						<td align="center">'.$FetchTerms['name'].'</td>';
				$SelectStudentTotalFees = mysqli_query($_SESSION['connection'],"select * from student_fees");
				while($FetchStudentTotalFees = mysqli_fetch_array($SelectStudentTotalFees))
				{
					$ExplodeTerms = explode('.',$FetchStudentTotalFees['terms']);
					foreach($ExplodeTerms as $ExplodeTerm)
					{
						if(($ExplodeTerm==$FetchTerms['id']))// && !in_array($FetchTerms['id'],$ArryValue))
						{
							$TotalAmount += $FetchStudentTotalFees['total_amount'];
							$TotalPending += $FetchStudentTotalFees['amount_pending'];
							//$ArryValue[] = $FetchTerms['id'];
						}
					}
				}
				echo '<td align="center">'.$TotalAmount.'</td>
				<td align="center">'.$TotalPending.'</td>';
				echo '</tr>';
			}
				
	echo '</tbody></table>';
?>

<br/>
<script>
	function Ajax_Pagination(PaginationFor, CurrentPageNo)
	{
		var xmlhttp;
		//alert("includes/Ajax_Pagination.php?page=<?php echo $_GET['page'];?>&pageno="+CurrentPageNo+"&total_pages="+total_pages+"&PaginationFor="+PaginationFor);
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				//alert(xmlhttp.responseText);
				document.getElementById(PaginationFor).innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/Ajax_Pagination.php?page=<?php echo $_GET['page'];?>&pageno="+CurrentPageNo+"&total_pages="+total_pages+"&PaginationFor="+PaginationFor+"&StatusId=<?php echo $_GET['StatusId'];?>&AssignedStatusId=<?php echo $_GET['AssignedStatusId'];?>&StatusAll=<?php echo $_GET['StatusAll'];?>", true);
		xmlhttp.send();
	}
	Blink();
	function Blink()
	{
		obj=document.getElementById("blink");
		if (obj.style.visibility=="hidden")
			obj.style.visibility="visible";
		else obj.style.visibility="hidden";
		window.setTimeout("Blink();",1000);
	}
</script>