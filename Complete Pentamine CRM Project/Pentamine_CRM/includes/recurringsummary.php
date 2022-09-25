<?php
session_start();
if($_SESSION['clientId'])
	$product = explode(',',$row1['product']);
$product1 = $row1['product'];
?>		
		<link rel="stylesheet" type="text/css" href="style.css">
	
<?php
	include("config.php");
	session_start();
	ini_set( "display_errors", "0" );
			$result = mysql_query("SELECT * FROM recurring");
				if(!mysql_num_rows($result))
					echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
				$rowsperpage = 25;
				$total_pages = ceil(mysql_num_rows($result) / $rowsperpage);
					
				if($_GET['pageno']>1)
					$Limit = "LIMIT ".(($_GET['pageno']-1)*$rowsperpage).",".$rowsperpage;
				else
					$Limit = "LIMIT 0,".$rowsperpage;
					
			echo '<div style="float:left;margin-top:25px;margin-left:0px;width:800px;height:0;">';
	
			$sql = mysql_query("SELECT * FROM recurring ORDER BY id Desc $Limit");
			if(mysql_num_rows($sql))
			{
					echo "<div style='width:1000px;height:550px;overflow-x:hidden;overflow-y:auto;'>
					<table id='sub1'><tr><td><h1>Recurring Summary  of All Status</h1></td></tr></table>";
				
			echo 	"<table  border='1'  align='left' class='paginate sortable full' id='sub'>
						
						<tr>
							<th align='left'>Company Name</th>
							<th align='left'>Product Type</th>
							<th align='left'>Frequency</th>
							<th align='left'>Recurring-Date</th>
							<th align='left'>Yearly-Amount</th>
							<th align='left'>Status</th>
						</tr>";
								
								$sql1 = mysql_query("SELECT * FROM recurring order by id DESC $Limit");
								while($row = mysql_fetch_array($sql1))
								{
									echo "<tr>";
									$query = mysql_fetch_array(mysql_query("SELECT * FROM client where ptcid='".$row['recurring_client']."'"));
											echo	"<td>".$query['cname']."</td>";
									$query1 = mysql_fetch_array(mysql_query("SELECT * FROM producttype where slno='".$row['recurring_product']."'"))		;
											echo  "<td>".$query1['type']."</td>";
											echo  "<td>".$row['recurring_frequency']."</td>";
											echo  "<td>".$row['recurring_date']."</td>";
											echo  "<td>".$row['recurring_yearlyamount']."</td>";
											echo  "<td>".$row['recurring_status']."</td>";											
								echo 	"</tr>";	
								}	
								echo "<tr>
							<th style=color:red; align='left'>Total No.Of ".$row2['type']." Products</th>
							<th style=color:red; align='left'>Total Amount</th>
						</tr>";
						$sql1 = mysql_query("SELECT * FROM recurring");
						$numberofproduct = mysql_num_rows($sql1);
						while($row3 = mysql_fetch_array($sql1))
						{
							"<tr><td>".$numberofproduct."</td>";
							$totalamount = $row3['recurring_yearlyamount'];
							$yeartotal =  $totalamount+$yeartotal;					
						}
						echo "<tr><td>".$numberofproduct."</td>";
							$totalamount = $row3['recurring_yearlyamount'];
							$yeartotal =  $totalamount+$yeartotal;
							echo 	"<td>".$yeartotal."</td></tr>";
								}
								echo "</table>
								<table id='sub3'>
								</table>
								
						</div>";
				echo '<div style="float:left;margin-top:-0px;margin-left:0px;width:1300px">';?>
		<?php	echo 	'<h1><center>Recurring Filter</center></h1><table  border="1"  align="left" class="paginate sortable full1">
				<tr><td>Company-Name:<select id="company">
				<option value="all">All</option>';
				$query_client = mysql_query("SELECT * FROM recurring ");
				while($row_client=mysql_fetch_array($query_client))
				{
					$query =mysql_query("SELECT * FROM client where ptcid='".$row_client['recurring_client']."'");
					while($row = mysql_fetch_array($query))
					{
						echo '<option value="'.$row['ptcid'].'">'.$row['cname'].'</option>';
					}
				}
		echo	'</select></td>';
		echo 	'<td>Product:<select id="product">
				<option value="all">All</option>';
				foreach($product as $prod )
				{
					$query_product = mysql_query("SELECT * FROM producttype WHERE slno='".$prod."'");
					while($row_product = mysql_fetch_array($query_product))
					{
						echo '<option value="'.$row_product['slno'].'">'.$row_product['type'].'</option>';
					}
				}
		echo	'</select></td>';
		echo 	'<td >Frequency:<select id="frequency">
				<option value="all">All</option>';
				for($i=1; $i<=12; $i++)
				{
					echo '<option value="'.$i.'-Month'.'">'.$i.'-Month'.'</option>';
				}
		echo	'</select></td>';
		echo 	'<td >Alert-Date:<select id="alert-date">
				<option value="all">All</option>';
				for($i=1; $i<31; $i++)
				{
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
		echo	'</select></td>';
		echo 	'<td >Status:<select id="status">';
		echo	'<option value="all">All</option>';
		echo	'<option value="enable">Enable</option>';
		echo	'<option value="disable">Disable</option>';
		echo	'</select></td>';
		echo "<tr><td><br /><button onclick ='loadXMLDoc2()'>Search</button></td></tr></table>";		
		echo	'</div>';			
	
echo'<div style="float:left;margin-top:-550px;margin-left:-1550px;width:250px">';
	
				$product_query = mysql_query("SELECT * FROM recurring");
			if(mysql_num_rows($product_query))
			{
					echo "<br /><br /><br />
					<table  border='1'  align='left' class='paginate sortable full1'>
						<tr>
							<th>Product</th>
							<th>No. of Items</th>
						</tr>";
						foreach($product as $prod)
						{
							$product_query1 = mysql_query("SELECT * FROM producttype WHERE slno='".$prod."'");
							while($product_row=mysql_fetch_array($product_query1))
							{
								echo "<tr><td>";?><a href='#' style='text-decoration:underline;' onclick ='getProduct("includes/getrecurringproduct.php?id=<?php echo $product_row['slno'];?>&product=<?php echo $product1;?>")'><?php echo $product_row['type']."</a></td>";
								$product_number = mysql_query("select * from recurring where recurring_product='".$product_row['slno']."'");
								echo "<td><a>".mysql_num_rows($product_number)."</a></td></tr>";
							}
						}
					echo	"</table>";
				
	}					
	echo '</div>';
	echo'<div style="float:left;margin-top:-350px;margin-left:-1550px;width:250px">';	
			$product_query = mysql_query("SELECT * FROM recurring");
			if(mysql_num_rows($product_query))
			{
					echo "<br /><br /><br />
					<table  border='1'  align='left' class='paginate sortable full1'>
						<tr>
							<th>Month</th>
							<th>No. of Items</th>
						</tr>";							
						$months = array("January","Febuary","March","April","May","June","July","August","September","October","November","December");	
						$i = 1;
						foreach($months as $mo)
						{
						echo "<tr><td>";?><a href='#' style='text-decoration:underline;' onclick ='getProduct("includes/getrecurringproduct.php?month=<?php echo $i;?>&product=<?php echo $product1;?>")'><?php echo $mo."</a></td>
								<td><a>".mysql_num_rows(mysql_query("select recurring_id from recurring where Month(recurring_date)=".$i." and recurring_status='Enable'"))."</a></td>
							</tr>";
							$i++;
						}						
						echo "</table>";				
	}					
	echo '</div>';
?>
<script>
	function loadXMLDoc2()
		{	
			var comapanyname = document.getElementById('company').value;
			var product = document.getElementById('product').value;
			var frequency = document.getElementById('frequency').value;
			var alertdate = document.getElementById('alert-date').value;
			var status = document.getElementById('status').value;
			var url = "includes/getrecurring.php?company="+comapanyname+"&product="+product+"&frequency="+frequency+"&alert-date="+alertdate+"&status="+status;
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
		function getProduct(url)
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
				document.getElementById('sub3').innerHTML = split_table[2];
			}
		}
		xmlhttp.open("GET",url,true);
		xmlhttp.send();
	}
</script>	