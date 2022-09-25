<?php
if($_SESSION['clientId'])
	$product = explode(',',$row1['product']);
$product1 = $row1['product'];
?>	
	<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Highcharts Example</title>

			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
			<script type="text/javascript" src="https://www.google.com/jsapi"></script>
			<script type="text/javascript">
			google.setOnLoadCallback(drawChart);
			var chart;
			var test;
			var product='<?php echo $row1['product'];?>';
			function drawChart() 
			{
				if(!test)
				{
					$('#container').highcharts({
						chart: {
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false
						},
						title: {
							text: 'Lead Status Reports'
						},
						tooltip: {
							pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
						},
						plotOptions: {
							pie: {
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
									enabled: false
								},
								showInLegend: true
							}
						},
						series: [{
							type: 'pie',
							name: 'Browser share',
							data: [
								<?php
								$statusQuery = mysql_query('Select * From status where status!="Closed/Won" AND status!="Closed/Lost"');
								$i = 0;
								while($statusFetch = mysql_fetch_array($statusQuery))
								{ 
									$amount = $total = $var_value1 = 0;
									foreach($product as $prod)
									{
										$query = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$statusFetch['slno']."' and enable='1')");
										while($fetchquery=mysql_fetch_array($query))
										{
											$readquery = mysql_fetch_array(mysql_query("Select * From comments WHERE ptclid='".$fetchquery['ptclid']."' And status_id ='".$statusFetch['slno']."' and enable='1'"));
											$total +=  $readquery['amount'];
										}
									}
									?>
									['<?php echo $statusFetch['status'].'('.$total.')';?>',<?php echo $total; ?>]
								<?php
								if($i++ < 8)
									echo ",";
							} ?>
							]
						}]
					});
				}
				if(test)
				{
					var xmlhttp, url = "includes/getreportchart.php?param="+test+"&product="+product;
					if(window.XMLHttpRequest)
					{// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}
					else
					{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange=function()
					{
						if(xmlhttp.readyState==4 && xmlhttp.status==200)
						{
							var result = xmlhttp.responseText.split(",");
							var items = [];
							for(var t=1; t < result.length-1;t=t+2)
								items.push([result[t],parseInt(result[t+1])]);
							$('#container').highcharts({
								chart: {
									plotBackgroundColor: null,
									plotBorderWidth: null,
									plotShadow: false
								},
								tooltip: {
									pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
								},
								plotOptions: {
									pie: {
										allowPointSelect: true,
										cursor: 'pointer',
										dataLabels: {
											enabled: false
										},
										showInLegend: true
									}
								},
								series:
								[{
									type: 'pie',
									name: 'Browser share',
									data: items
								}],
								title: {
									text: result[0]
								}
							});
						}
					}
					xmlhttp.open("GET",url,true);
					xmlhttp.send();
				}
			}
			function drawChartDynamic(str)
			{
				test = str;		
				if(test == 'month')
					document.getElementById("months").style.display="inline";
				drawChart();
			}
			function drawChartMonth(str)
			{
				test = str;
				drawChart();
			}
	</script>
</head>
	<body>
<script src="js/Highcharts-3.0.4/highcharts.js"></script>
<script src="js/Highcharts-3.0.4/modules/exporting.js"></script>
</body>
</html>
<div style="float:left;margin-top:25px;margin-left:600px;width:400px;">
		Filter By:
				<select onchange="drawChartDynamic(this.value)">
					<option value="status">Status</option>
					<option value="product">Product</option>
					<option value="month">Month</option>
				</select>
		<?php 
		$months = array("April","May","June","July","August","September","October","November","December","January","Febuary","March");		
		echo "<div id='months' hidden>Months:<select onchange='drawChartMonth(this.value)'>
		<option value='select'>Select</option>";
		for($i = 0;$i<count($months);$i++)
		{
			$i1= $i+4;
			if($i1 == 13)
				$i1 = 14-$i1;
			if($i1 == 14)
				$i1 = 16-$i1;
			if($i1 == 15)
				$i1 = 18-$i1;
			echo '<option value="'.$i1.'">'.$months[$i].'</option>';
		}
		echo "</select></div>";
		?>			
				</div>
		<div id="container" style=' float:left;margin-top:0px;margin-left:600px;width:600px;height:350px;'></div>
<?php
include('config.php');
session_start();
function formatInIndianStyle($num){
     $pos = strpos((string)$num, ".");
     if ($pos === false) {
        $decimalpart="00";
     }
     if (!($pos === false)) {
        $decimalpart= substr($num, $pos+1, 2); $num = substr($num,0,$pos);
     }

     if(strlen($num)>3 & strlen($num) <= 12){
         $last3digits = substr($num, -3 );
         $numexceptlastdigits = substr($num, 0, -3 );
         $formatted = makeComma($numexceptlastdigits);
         $stringtoreturn = $formatted.",".$last3digits.".".$decimalpart ;
     }elseif(strlen($num)<=3){
        $stringtoreturn = $num.".".$decimalpart ;
     }elseif(strlen($num)>12){
        $stringtoreturn = number_format($num, 2);
     }

     if(substr($stringtoreturn,0,2)=="-,"){
        $stringtoreturn = "-".substr($stringtoreturn,2 );
     }
     return $stringtoreturn;
 }
  function makeComma($input)
  { 
     if(strlen($input)<=2)
     { return $input; }
     $length=substr($input,0,strlen($input)-2);
     $formatted_input = makeComma($length).",".substr($input,-2);
     return $formatted_input;
	}
 


echo '<link rel="stylesheet" type="text/css" href="style.css" />
		<div style="float:left;margin-top:-350px;margin-left:-150px;width:550px">';
			$sql1 = mysql_query("SELECT * FROM status where status!='Closed/Won' AND status!='Closed/Lost'");
			if(mysql_num_rows($sql1))
			{
				echo "<h1>Lead Status Reports</h1>";
				echo "<table  border='1'  align='left' class='paginate sortable full1' style='width:650px'>
					<tr>
						<th align='left'>Status</th>
						<th align='left'>No. of Items</th>
						<th align='left'>Amount</th>
						<th align='left'>Total Amount</th>
					</tr>";
					//echo "<tr><td>";
					$grandAmount = $grandTotal = $totalStatus = 0;
					while($row1_status = mysql_fetch_array($sql1))
					{
						echo "<tr><td>";?><a href='?page=leadsummary&id=<?php echo $row1_status['slno'];?>' style='text-decoration:underline;'><?php echo $row1_status['status']."</a></td>";
						$var_value1 = $amount = $total = 0;
						/*$abc = mysql_query('Select slno From status Where status="Closed/Won" OR status="Closed/Lost" OR status="Other"');
						while($statusSlno = mysql_fetch_array($abc))
						{*/
						
						foreach($product as $prod)
						{
							$query = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$row1_status['slno']."' and enable='1')");
							while($fetchquery=mysql_fetch_array($query))
							{
								$readquery = mysql_fetch_array(mysql_query("Select * From comments WHERE ptclid='".$fetchquery['ptclid']."' And status_id ='".$row1_status['slno']."' and enable='1'"));
								$amount1 = $readquery['amount'];
								$amount = $amount + $amount1;
								$total1 = $readquery['total'];
								$total = $total + $total1;
							}
							$var = mysql_num_rows($query);
							$var_value1 = $var + $var_value1;
						}
						echo "<td><a >".$var_value1."</a></td>
							<td><a >".formatInIndianStyle(round($amount,2))."</a></td>";
						
						$HideShowRows = "";
						$count = 0;
						foreach($product as $prod)
						{
							$Amount = $Total = 0;
							$queryLead = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$row1_status['slno']."' and enable='1')");
							while($queryProduct = mysql_fetch_array($queryLead))
							{
								$Product_query = mysql_query("Select * From producttype WHERE slno = '".$queryProduct['ptype']."'");
								$fetchProduct = mysql_fetch_array($Product_query);
								$readquery = mysql_fetch_array(mysql_query("Select * From comments WHERE ptclid='".$queryProduct['ptclid']."' And status_id ='".$row1_status['slno']."' and enable='1'"));	
								$Amount += $readquery['amount'];
								$Total += $readquery['total'];
							}
							
							if(mysql_num_rows($queryLead))
							{
								$HideShowRows .='<tr style="none;" id="t'.$row1_status['slno'].$count.'" hidden><td><b>'.$fetchProduct['type'].'</b></td>
								<td><b>'.mysql_num_rows($queryLead).'</b></td>
								<td><b>'.formatInIndianStyle(round($Amount,2)).'</b></td>
								<td><b>'.formatInIndianStyle(round($Total,2)).'</b></td></tr>';
								//echo '<td>'.$Total.'</td></tr></t'.$row1_status['slno'].'>';
								//echo '<td>'.$Total.'</td></tr></t1>';
								$count++;
							}
						}
						echo "<td><a >".formatInIndianStyle(round($total,2))."</a></td><td><button  class='btn".$row1_status['slno']."' onclick='statusButton(".$row1_status['slno'].",".$count.",\"show\")'>Show</button>
							<button class='btn".$row1_status['slno'].$row1_status['slno']."' onclick='statusButton(".$row1_status['slno'].",".$count.",\"hide\")' hidden>Hide</button>
							</td>
						</tr>".$HideShowRows;
						
						$totalStatus1 = $var_value1;
						$totalStatus = $totalStatus + $totalStatus1;
						$grandAmount1 = $amount;
						$grandAmount = $grandAmount + $grandAmount1;
						$grandTotal1 = $total;
						$grandTotal = $grandTotal + $grandTotal1;
					}	
					echo "<tr><td>"; ?><a href='?page=leadsummary&nostatus=nos' style='text-decoration:underline;'>No Status</a><?php echo "</td>";
					$var_value2 = 0;
					echo "";
					foreach($product as $prod)
					{					
						$query1 = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid NOT IN(SELECT ptclid FROM comments)");
						$var = mysql_num_rows($query1);
						$var_value2 = $var + $var_value2;
					}
					echo "<td><a>".$var_value2."</a></td>";
					echo "<td><a>0.00</a></td>";
					echo "<td><a>0.00</a>";
					/*echo "</td><td><button class='btn1'>Hide</button>
						<button class='btn2'>Show</button>
						</td>
						*/
					echo "</tr><tr>
					<td>
						<b>Total</b>
					</td>";
					$totalStatus2 = $totalStatus + $var_value2;
					echo '<td><b>'.$totalStatus2.'</b></td>';
					echo '<td><b>'.formatInIndianStyle(round($grandAmount,2)).'</b></td>';
					echo '<td><b>'.formatInIndianStyle(round($grandTotal,2)).'</b></td>';
					echo "</tr>";
				echo "</table>";
			}
			echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
			echo "<h1>Lead Status Reports of Closed/Won</h1>Year: <select id='year' name='year' onchange='window.location.href=this.value'>
						<option value='index.php?page=".$_GET['page']."'>Select</option>";
							$j=0;
							for($i=2013;$i<date('Y',strtotime("+1 year"));$i++)
							{
								if($_GET['years'] == ($i.'/'.date('Y',strtotime($j." Year"))))
									echo "<option value='index.php?page=".$_GET['page']."&years=".$i.'/'.date('Y',strtotime($j." Year"))."' selected>".$i.'/'.substr(date('Y',strtotime($j." Year")),2)."</option>";
								else
									echo "<option value='index.php?page=".$_GET['page']."&years=".$i.'/'.date('Y',strtotime($j." Year"))."' >".$i.'/'.substr(date('Y',strtotime($j." Year")),2)."</option>";
								$j++;
							}
					echo "</select>";
			echo "<br/><br/><div id='YearAndMonth'>";
			if($_GET['years']=='2013/2014' || !$_GET['years'])
			{
				$sql2 = mysql_query("SELECT * FROM status where status='Closed/Won'");
				echo "<table  border='1'  align='left' class='paginate sortable full1' style='width:1200px'>
						<tr>
							<th align='left'>Status</th>
							<th align='left'>No. of Items</th>
							<th align='left'>Work Inprogress</th>
							<th align='left'>Work Completed</th>
							<th align='left'>Amount</th>
							<th align='left'>Total Amount</th>
							<th align='left'>Total Amount Paid</th>
							<th align='left'>Total Amount Pending</th>
						</tr>";
					echo "<tr><td>";
						$items = 0;
						$grandAmountClosed = 0;
						$grandTotalClosed = 0;
						$GrandTotalWorkPayment = 0;
						$GrandTotalWorkPaymentPending = 0;
						$GrandWorkNotClosed = 0;
						$GrandWorkClosed = 0;
						$monthName = array("April","May","June","July","August","September","October","November","December","January","Febuary","March");		
						while($row1_status = mysql_fetch_array($sql2))
						{
							$i = 0;
							for($i = 0;$i<count($monthName);$i++)
							{
								$i1= $i+4;
								if($i1 == 13)
									$i1 = 14-$i1;
								if($i1 == 14)
									$i1 = 16-$i1;
								if($i1 == 15)
									$i1 = 18-$i1;
								if($i1 < 4)
									$Year =  date('Y');
								else
									$Year = date('Y',strtotime("-1 year"));
								
								echo "<tr><td>"; ?><a href='?page=leadsummary&date=<?php echo $i1;?>&id1=<?php echo $row1_status['slno'];?>' style='text-decoration:underline;'><?php echo $row1_status['status']."-".$monthName[$i]."</a></td>";
								$var_value1 = $WorkNotClosed = $WorkClosed = 0;
								$amount = 0;
								$total = 0;
								$cdate = "";
								$TotalWorkPayment = 0;
								foreach($product as $prod)
								{
									$query = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$row1_status['slno']."' and enable='1')");
									while($fetchquery=mysql_fetch_array($query))
									{
										$read = mysql_query("Select * From comments WHERE ptclid='".$fetchquery['ptclid']."' And  Month(cdate)='".$i1."' And  Year(cdate)='".$Year."' and status_id ='".$row1_status['slno']."' and enable='1' ");
										$readquery = mysql_fetch_array($read);
										$workPayment = mysql_fetch_array(mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where enable=1)"));
										$WorkPay = mysql_query("Select * From workpayment Where workid='".$workPayment['work_id']."'");
										$workStatus = mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where (status!='Closed' and enable=1))");
										$workStatus1 = mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where (status='Closed' and enable=1))");
										while($FetchWorkPay = mysql_fetch_array($WorkPay))
										{
											$TotalWorkPayment += $FetchWorkPay['total'];
										}
										//if(date("m", strtotime($readquery['cdate'])) == $i1)
										if($readquery)
										{
											$amount += $readquery['amount'];
											$total += $readquery['total'];
											$cdate = $cdate1 = $readquery['cdate'];
											$var_value1 += mysql_num_rows($read);
											$WorkNotClosed += mysql_num_rows($workStatus);
											$WorkClosed += mysql_num_rows($workStatus1);
										}
									}
								}
								$HideShowRows1= "";
								$count=0;
								foreach($product as $prod)
								{
									$Totalproductamount = $Amount = $Total = $numRows =  $WorkNotClosed1 = $WorkClosed1 = 0;
									$queryLead = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$row1_status['slno']."' and enable='1')");
									while($queryProduct = mysql_fetch_array($queryLead))
									{
										$readquery = mysql_fetch_array(mysql_query("Select * From comments WHERE ptclid='".$queryProduct['ptclid']."' And Month(cdate)='".$i1."' And  Year(cdate)='".$Year."' and  status_id ='".$row1_status['slno']."' and enable='1'"));	
										$workPayment = mysql_fetch_array(mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where enable=1)"));
										$WorkPay = mysql_query("Select * From workpayment Where workid='".$workPayment['work_id']."'");
										$workStatus2 = mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where (status!='Closed' and enable=1))");
										$workStatus3 = mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where (status='Closed' and enable=1))");
										while($FetchWorkPay = mysql_fetch_array($WorkPay))
										{
											$Totalproductamount += $FetchWorkPay['total'];
										}
										if($readquery)
										{
											$Product_query = mysql_query("Select * From producttype WHERE slno = '".$queryProduct['ptype']."'");
											$fetchProduct = mysql_fetch_array($Product_query);
											$Amount += $readquery['amount'];
											$Total += $readquery['total'];
											$Totalamountpaid += $readquery['total'];
											$numRows += mysql_num_rows($Product_query);
											$WorkNotClosed1 += mysql_num_rows($workStatus2);
											$WorkClosed1 += mysql_num_rows($workStatus3);
										}
									}
									if(mysql_num_rows($queryLead))
									{
										if($fetchProduct['type'] && $Amount && $Total)
										{
											$HideShowRows1 .='<tr style="none;" id="tt'.$i1.$count.'" hidden>
											<td><b>'.$fetchProduct['type'].'</b></td>
											<td><b>'.$numRows.'</b></td>
											<td align="center"><a>'.$WorkNotClosed1.'</a></td>
											<td align="center"><a>'.$WorkClosed1.'</a></td>
											<td align="left"><b>'.formatInIndianStyle(round($Amount,2)).'</b></td>
											<td align="left"><b>'.formatInIndianStyle(round($Total,2)).'</b></td>
											<td align="left"><b>'.formatInIndianStyle(round($Totalproductamount,2)).'</b></td>
											<td align="left"><b>'.formatInIndianStyle(round($Total-$Totalproductamount,2)).'</b></td>
											</tr>';
											$count++;
										}
									}
								}	
								$HideShowRows12 = "";
								$count1 = 0;
								$SelectClient = mysql_query("Select * From client");
								while($FetchClient = mysql_fetch_array($SelectClient))
								{
									foreach($product as $prod)
									{
										$Totalproductamount = $Amount = $Total = $numRows1 =  $WorkNotClosed2 = $WorkClosed2 = 0;
										$queryLead = mysql_query("SELECT * FROM lead WHERE cname='".$FetchClient['ptcid']."' and ptype='".$prod."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$row1_status['slno']."' and enable='1')");
										while($queryProduct = mysql_fetch_array($queryLead))
										{
											$readquery = mysql_fetch_array(mysql_query("Select * From comments WHERE ptclid='".$queryProduct['ptclid']."' And Month(cdate)='".$i1."' And  Year(cdate)='".$Year."' and status_id ='".$row1_status['slno']."' and enable='1'"));	
											$workPayment = mysql_fetch_array(mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where enable=1)"));
											$WorkPay = mysql_query("Select * From workpayment Where workid='".$workPayment['work_id']."'");
											$workStatus4 = mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where (status!='Closed' and enable=1))");
											$workStatus5 = mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where (status='Closed' and enable=1))");
											while($FetchWorkPay = mysql_fetch_array($WorkPay))
											{
												$Totalproductamount += $FetchWorkPay['total'];
											}
											if($readquery)
											{
												$Product_query = mysql_fetch_array(mysql_query("Select * From producttype WHERE slno = '".$queryProduct['ptype']."'"));
												$Amount += $readquery['amount'];
												$Total += $readquery['total'];
												$Totalamountpaid += $readquery['total'];
												$numRows1 += mysql_num_rows(mysql_query("Select * From producttype WHERE slno = '".$queryProduct['ptype']."'"));
												$WorkNotClosed2 += mysql_num_rows($workStatus4);
												$WorkClosed2 += mysql_num_rows($workStatus5);
											}
										}
										if(mysql_num_rows($queryLead))
										{
											if($Amount && $Total)
											{
												$HideShowRows12 .='<tr style="none;" id="ttt'.$i1.$count1.'" hidden>
												<td><b>'.$FetchClient['cname'].'('.$Product_query['type'].')'.'</b></td>
												<td><b>'.$numRows1.'</b></td>
												<td align="center"><a>'.$WorkNotClosed2.'</a></td>
												<td align="center"><a>'.$WorkClosed2.'</a></td>
												<td align="left"><b>'.formatInIndianStyle(round($Amount,2)).'</b></td>
												<td align="left"><b>'.formatInIndianStyle(round($Total,2)).'</b></td>
												<td align="left"><b>'.formatInIndianStyle(round($Totalproductamount,2)).'</b></td>
												<td align="left"><b>'.formatInIndianStyle(round($Total-$Totalproductamount,2)).'</b></td>
												</tr>';
												$count1++;
											}
										}
									}
								}
								/*echo "<!--td><button  class='btnn".$i1."' onclick='statusButton1(".$i1.",".$count.",\"show\")'>Product</button>
								<button class='btonn".$i1.$i1."' onclick='statusButton1(".$i1.",".$count.",\"hide\")' hidden>Hide</button>
								</td-->*/
								echo "<td><a >".$var_value1."</a></td>
									<td align='center'><a>".$WorkNotClosed."</a></td>
									<td align='center'><a>".$WorkClosed."</a></td>";
								echo "<td align='left'><a >".formatInIndianStyle(round($amount,2))."</a></td>";
								echo "<td align='left'><a >".formatInIndianStyle(round($total,2))."</a></td>";
								echo "<td align='left'><a >".formatInIndianStyle(round($TotalWorkPayment,2))."</a></td>";
								echo "<td align='left'><a >".formatInIndianStyle(round($total-$TotalWorkPayment,2))."</a></td>";
								echo "<td><button  class='btnn".$i1."' onclick='statusButton1(".$i1.",".$count.",\"show\")'>Product</button>
								<button class='btonn".$i1.$i1."' onclick='statusButton1(".$i1.",".$count.",\"hide\")' hidden>Hide</button>
								</td><td><button  class='btnnn".$i1."' onclick='statusButton2(".$i1.",".$count1.",\"show\")'>Client</button>
								<button class='btonnn".$i1.$i1."' onclick='statusButton2(".$i1.",".$count1.",\"hide\")' hidden>Hide</button>
								</td></tr>".$HideShowRows1.$HideShowRows12;
								$grandAmountClosed += $amount;
								$grandTotalClosed += $total;
								$items +=$var_value1;
								$GrandTotalWorkPayment += $TotalWorkPayment;
								$GrandTotalWorkPaymentPending += $total-$TotalWorkPayment;
								$GrandWorkNotClosed += $WorkNotClosed;
								$GrandWorkClosed += $WorkClosed;
							}
						}
						echo "<tr>
						<td><b>Total</b></td>";
						echo '<td><b>'.$items.'</b></td>';
						echo '<td align="center"><b>'.$GrandWorkNotClosed.'</b></td>';
						echo '<td align="center"><b>'.$GrandWorkClosed.'</b></td>';
						echo '<td align="left"><b>'.formatInIndianStyle(round($grandAmountClosed,2)).'</b></td>';
						echo '<td align="left"><b>'.formatInIndianStyle(round($grandTotalClosed,2)).'</b></td>';
						echo '<td align="left"><b>'.formatInIndianStyle(round($GrandTotalWorkPayment,2)).'</b></td>';
						echo '<td align="left"><b>'.formatInIndianStyle(round($GrandTotalWorkPaymentPending,2)).'</b></td>';
						echo "</tr>";
					echo '</table>';
			}
			else
			{
				$sql2 = mysql_query("SELECT * FROM status where status='Closed/Won'");
				echo "<table  border='1'  align='left' class='paginate sortable full1' style='width:1200px'>
						<tr>
							<th align='left'>Status</th>
							<th align='left'>No. of Items</th>
							<th align='left'>Work Inprogress</th>
							<th align='left'>Work Completed</th>
							<th align='left'>Amount</th>
							<th align='left'>Total Amount</th>
							<th align='left'>Total Amount Paid</th>
							<th align='left'>Total Amount Pending</th>
						</tr>";
					echo "<tr><td>";
						$items = 0;
						$grandAmountClosed = 0;
						$grandTotalClosed = 0;
						$GrandTotalWorkPayment = 0;
						$GrandTotalWorkPaymentPending = 0;
						$GrandWorkNotClosed = 0;
						$GrandWorkClosed = 0;
						$monthName = array("April","May","June","July","August","September","October","November","December","January","Febuary","March");		
						while($row1_status = mysql_fetch_array($sql2))
						{
							$i = 0;
							for($i = 0;$i<count($monthName);$i++)
							{
								$i1= $i+4;
								if($i1 == 13)
									$i1 = 14-$i1;
								if($i1 == 14)
									$i1 = 16-$i1;
								if($i1 == 15)
									$i1 = 18-$i1;
								$Years = explode('/',$_GET['years']);
								if($i1 < 4)
									$Year =  $Years[1];
								else
									$Year = $Years[0];
								
								echo "<tr><td>"; ?><a href='?page=leadsummary&date=<?php echo $i1;?>&id1=<?php echo $row1_status['slno'];?>' style='text-decoration:underline;'><?php echo $row1_status['status']."-".$monthName[$i]."</a></td>";
								$var_value1 = $WorkNotClosed = $WorkClosed = 0;
								$amount = 0;
								$total = 0;
								$cdate = "";
								$TotalWorkPayment = 0;
								foreach($product as $prod)
								{
									$query = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$row1_status['slno']."' and enable='1')");
									while($fetchquery=mysql_fetch_array($query))
									{
										$read = mysql_query("Select * From comments WHERE ptclid='".$fetchquery['ptclid']."' And  Month(cdate)='".$i1."' And  Year(cdate)='".$Year."' and status_id ='".$row1_status['slno']."' and enable='1' ");
										$readquery = mysql_fetch_array($read);
										$workPayment = mysql_fetch_array(mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where enable=1)"));
										$WorkPay = mysql_query("Select * From workpayment Where workid='".$workPayment['work_id']."'");
										$workStatus = mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where (status!='Closed' and enable=1))");
										$workStatus1 = mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where (status='Closed' and enable=1))");
										while($FetchWorkPay = mysql_fetch_array($WorkPay))
										{
											$TotalWorkPayment += $FetchWorkPay['total'];
										}
										//if(date("m", strtotime($readquery['cdate'])) == $i1)
										if($readquery)
										{
											$amount += $readquery['amount'];
											$total += $readquery['total'];
											$cdate = $cdate1 = $readquery['cdate'];
											$var_value1 += mysql_num_rows($read);
											$WorkNotClosed += mysql_num_rows($workStatus);
											$WorkClosed += mysql_num_rows($workStatus1);
										}
									}
								}
								$HideShowRows1= "";
								$count=0;
								foreach($product as $prod)
								{
									$Totalproductamount = $Amount = $Total = $numRows =  $WorkNotClosed1 = $WorkClosed1 = 0;
									$queryLead = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$row1_status['slno']."' and enable='1')");
									while($queryProduct = mysql_fetch_array($queryLead))
									{
										$readquery = mysql_fetch_array(mysql_query("Select * From comments WHERE ptclid='".$queryProduct['ptclid']."' And Month(cdate)='".$i1."' And  Year(cdate)='".$Year."' and  status_id ='".$row1_status['slno']."' and enable='1'"));	
										$workPayment = mysql_fetch_array(mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where enable=1)"));
										$WorkPay = mysql_query("Select * From workpayment Where workid='".$workPayment['work_id']."'");
										$workStatus2 = mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where (status!='Closed' and enable=1))");
										$workStatus3 = mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where (status='Closed' and enable=1))");
										while($FetchWorkPay = mysql_fetch_array($WorkPay))
										{
											$Totalproductamount += $FetchWorkPay['total'];
										}
										if($readquery)
										{
											$Product_query = mysql_query("Select * From producttype WHERE slno = '".$queryProduct['ptype']."'");
											$fetchProduct = mysql_fetch_array($Product_query);
											$Amount += $readquery['amount'];
											$Total += $readquery['total'];
											$Totalamountpaid += $readquery['total'];
											$numRows += mysql_num_rows($Product_query);
											$WorkNotClosed1 += mysql_num_rows($workStatus2);
											$WorkClosed1 += mysql_num_rows($workStatus3);
										}
									}
									if(mysql_num_rows($queryLead))
									{
										if($fetchProduct['type'] && $Amount && $Total)
										{
											$HideShowRows1 .='<tr style="none;" id="tt'.$i1.$count.'" hidden>
											<td><b>'.$fetchProduct['type'].'</b></td>
											<td><b>'.$numRows.'</b></td>
											<td align="center"><a>'.$WorkNotClosed1.'</a></td>
											<td align="center"><a>'.$WorkClosed1.'</a></td>
											<td align="left"><b>'.formatInIndianStyle(round($Amount,2)).'</b></td>
											<td align="left"><b>'.formatInIndianStyle(round($Total,2)).'</b></td>
											<td align="left"><b>'.formatInIndianStyle(round($Totalproductamount,2)).'</b></td>
											<td align="left"><b>'.formatInIndianStyle(round($Total-$Totalproductamount,2)).'</b></td>
											</tr>';
											$count++;
										}
									}
								}	
								$HideShowRows12 = "";
								$count1 = 0;
								$SelectClient = mysql_query("Select * From client");
								while($FetchClient = mysql_fetch_array($SelectClient))
								{
									foreach($product as $prod)
									{
										$Totalproductamount = $Amount = $Total = $numRows1 =  $WorkNotClosed2 = $WorkClosed2 = 0;
										$queryLead = mysql_query("SELECT * FROM lead WHERE cname='".$FetchClient['ptcid']."' and ptype='".$prod."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$row1_status['slno']."' and enable='1')");
										while($queryProduct = mysql_fetch_array($queryLead))
										{
											$readquery = mysql_fetch_array(mysql_query("Select * From comments WHERE ptclid='".$queryProduct['ptclid']."' And Month(cdate)='".$i1."' And  Year(cdate)='".$Year."' and status_id ='".$row1_status['slno']."' and enable='1'"));	
											$workPayment = mysql_fetch_array(mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where enable=1)"));
											$WorkPay = mysql_query("Select * From workpayment Where workid='".$workPayment['work_id']."'");
											$workStatus4 = mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where (status!='Closed' and enable=1))");
											$workStatus5 = mysql_query("Select * From work Where lead='".$readquery['ptclid']."' and work_id in (select work_id from workstatus where (status='Closed' and enable=1))");
											while($FetchWorkPay = mysql_fetch_array($WorkPay))
											{
												$Totalproductamount += $FetchWorkPay['total'];
											}
											if($readquery)
											{
												$Product_query = mysql_fetch_array(mysql_query("Select * From producttype WHERE slno = '".$queryProduct['ptype']."'"));
												$Amount += $readquery['amount'];
												$Total += $readquery['total'];
												$Totalamountpaid += $readquery['total'];
												$numRows1 += mysql_num_rows(mysql_query("Select * From producttype WHERE slno = '".$queryProduct['ptype']."'"));
												$WorkNotClosed2 += mysql_num_rows($workStatus4);
												$WorkClosed2 += mysql_num_rows($workStatus5);
											}
										}
										if(mysql_num_rows($queryLead))
										{
											if($Amount && $Total)
											{
												$HideShowRows12 .='<tr style="none;" id="ttt'.$i1.$count1.'" hidden>
												<td><b>'.$FetchClient['cname'].'('.$Product_query['type'].')'.'</b></td>
												<td><b>'.$numRows1.'</b></td>
												<td align="center"><a>'.$WorkNotClosed2.'</a></td>
												<td align="center"><a>'.$WorkClosed2.'</a></td>
												<td align="left"><b>'.formatInIndianStyle(round($Amount,2)).'</b></td>
												<td align="left"><b>'.formatInIndianStyle(round($Total,2)).'</b></td>
												<td align="left"><b>'.formatInIndianStyle(round($Totalproductamount,2)).'</b></td>
												<td align="left"><b>'.formatInIndianStyle(round($Total-$Totalproductamount,2)).'</b></td>
												</tr>';
												$count1++;
											}
										}
									}
								}
								/*echo "<!--td><button  class='btnn".$i1."' onclick='statusButton1(".$i1.",".$count.",\"show\")'>Product</button>
								<button class='btonn".$i1.$i1."' onclick='statusButton1(".$i1.",".$count.",\"hide\")' hidden>Hide</button>
								</td-->*/
								echo "<td><a >".$var_value1."</a></td>
									<td align='center'><a>".$WorkNotClosed."</a></td>
									<td align='center'><a>".$WorkClosed."</a></td>";
								echo "<td align='left'><a >".formatInIndianStyle(round($amount,2))."</a></td>";
								echo "<td align='left'><a >".formatInIndianStyle(round($total,2))."</a></td>";
								echo "<td align='left'><a >".formatInIndianStyle(round($TotalWorkPayment,2))."</a></td>";
								echo "<td align='left'><a >".formatInIndianStyle(round($total-$TotalWorkPayment,2))."</a></td>";
								echo "<td><button  class='btnn".$i1."' onclick='statusButton1(".$i1.",".$count.",\"show\")'>Product</button>
								<button class='btonn".$i1.$i1."' onclick='statusButton1(".$i1.",".$count.",\"hide\")' hidden>Hide</button>
								</td><td><button  class='btnnn".$i1."' onclick='statusButton2(".$i1.",".$count1.",\"show\")'>Client</button>
								<button class='btonnn".$i1.$i1."' onclick='statusButton2(".$i1.",".$count1.",\"hide\")' hidden>Hide</button>
								</td></tr>".$HideShowRows1.$HideShowRows12;
								$grandAmountClosed += $amount;
								$grandTotalClosed += $total;
								$items +=$var_value1;
								$GrandTotalWorkPayment += $TotalWorkPayment;
								$GrandTotalWorkPaymentPending += $total-$TotalWorkPayment;
								$GrandWorkNotClosed += $WorkNotClosed;
								$GrandWorkClosed += $WorkClosed;
							}
						}
				echo "<tr>
				<td><b>Total</b></td>";
				echo '<td><b>'.$items.'</b></td>';
				echo '<td align="center"><b>'.$GrandWorkNotClosed.'</b></td>';
				echo '<td align="center"><b>'.$GrandWorkClosed.'</b></td>';
				echo '<td align="left"><b>'.formatInIndianStyle(round($grandAmountClosed,2)).'</b></td>';
				echo '<td align="left"><b>'.formatInIndianStyle(round($grandTotalClosed,2)).'</b></td>';
				echo '<td align="left"><b>'.formatInIndianStyle(round($GrandTotalWorkPayment,2)).'</b></td>';
				echo '<td align="left"><b>'.formatInIndianStyle(round($GrandTotalWorkPaymentPending,2)).'</b></td>';
				echo "</tr>";
				echo '</table>';
			}
			
	echo '</div>';
	echo '</div>';
	
?>
<script>
	function statusButton(value,product,button)
	{
		if(!product)
			alert("No Products");
		$("t"+value).hide();
		if((button == "show") && product)
		{
			if(product)
			{
				for(var i = 0; i < product; i++)
					document.getElementById("t"+value+""+i).style.display="table-row";
			}
			$(".btn"+value).hide();
			$(".btn"+value+""+value).show();
		}
		else if(button == "hide")
		{
			if(product)
			{
				for(var i = 0; i < product; i++)
					document.getElementById("t"+value+""+i).style.display="none";
			}
			$(".btn"+value).show();
			$(".btn"+value+""+value).hide();
		}
	}
	function statusButton1(value,product,button)
	{
		if(!product)
			alert("No Products");
		$("tt"+value).hide();
		if((button == "show") && product)
		{
			if(product)
			{
				for(var i = 0; i < product; i++)
					document.getElementById("tt"+value+""+i).style.display="table-row";
			}
			$(".btnn"+value).hide();
			$(".btonn"+value+""+value).show();
		}
		else if(button == "hide")
		{
			if(product)
			{
				for(var i = 0; i < product; i++)
					document.getElementById("tt"+value+""+i).style.display="none";
			}
			$(".btnn"+value).show();
			$(".btonn"+value+""+value).hide();
		}
	}
	function statusButton2(value,product,button)
	{
		if(!product)
			alert("No Clients");
		$("ttt"+value).hide();
		if((button == "show") && product)
		{
			if(product)
			{
				for(var i = 0; i < product; i++)
					document.getElementById("ttt"+value+""+i).style.display="table-row";
			}
			$(".btnnn"+value).hide();
			$(".btonnn"+value+""+value).show();
		}
		else if(button == "hide")
		{
			if(product)
			{
				for(var i = 0; i < product; i++)
					document.getElementById("ttt"+value+""+i).style.display="none";
			}
			$(".btnnn"+value).show();
			$(".btonnn"+value+""+value).hide();
		}
	}
	function year_change(str)
	{
		var product='<?php echo $row1['product'];?>';
		var url = "includes/getReports.php?q="+str+"&product="+product;
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
				alert(xmlhttp.responseText);
				document.getElementById('YearAndMonth').innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET",url,true);
		xmlhttp.send();
	}
</script>