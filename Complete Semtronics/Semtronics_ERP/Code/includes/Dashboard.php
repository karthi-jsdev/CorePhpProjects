<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
<script src="js/datepicker/jquery.ui.core.js"></script>
<script src="js/datepicker/jquery.ui.widget.js"></script>
<script src="js/datepicker/jquery.ui.datepicker.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
	$(function()
	{
		$("#startdate").datepicker({dateFormat: 'dd-mm-yy'});
		$("#enddate").datepicker({dateFormat: 'dd-mm-yy'});
		$("#startdate1").datepicker({dateFormat: 'dd-mm-yy'});
		$("#enddate1").datepicker({dateFormat: 'dd-mm-yy'});
		$("#sortable").sortable();
		$("#sortable").disableSelection();
	});
</script>
	<head>
		<style>
			.table1,.td1,.tr1
			{
			border:1px solid black;
			}
			#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
			#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
			#sortable li span { position: absolute; margin-left: -1.3em; }
		</style>
	</head>
	<br/>
	<font face="Georgia">
	<div style="float:left;width:610px;">
		<div style="width:610px;" id="sortable">
			<?php
			include("includes/Dashboard_Queries.php");
			$condition = mysqli_fetch_assoc(UserSelection());
			$status = explode('.',$condition['status']);
			foreach($status as $s)
			{	
				$sss = Dashboardids($s);
				$das = mysqli_fetch_assoc($sss);
				if((in_array($das['id'],$status)) && $das['modulename']=="NewsBlink")
				{
					if(mysqli_num_rows(Latest_News()))
					{ ?>
					<div class='message success'>
						<font size=2px>
						<span id="blink"><b>Latest News:
						<?php
							$LatestNews = mysqli_fetch_array(Latest_News());
							echo ''.$LatestNews['news'].'</span>';
						?>
						</b>
					</font>
					</div>
					<?php
					}
				}
				if((in_array($das['id'],$status)) && $das['modulename']=="News")
				{
					$FetchNews = mysqli_fetch_array(News());
					if(mysqli_num_rows(News()))
					{ ?>
					<div class="widget" >
						<font size=2px>
						<header>
							<h2>News</h2>
						</header>
						<section>
							 <?php
								$FetchNews['news'] = explode('`',$FetchNews['news']);
								echo '<div style="height:40px;"><marquee onmouseover="this.scrollAmount = 0" onmouseout="this.scrollAmount = 1" SCROLLAMOUNT="1" width="605" height="40" direction="UP">';
								for($k=0;$k<count($FetchNews['news']);$k++)
									echo '<u><b>*<font color="black">'.$FetchNews['news'][$k].'</b></font></u><br/><br/>';
								echo '</marquee><br/><br/></div>';
							  ?>
						</section>
					</font>
				</div>
			</div>
			<?php 
			}
		}
		if((in_array($das['id'],$status)) && $das['modulename']=="Stockdetails")
		{
		?>
		<table>
			<tr>
				<td class="widget">
					<div class="widget" id="3" style="width:303px;">
						<header>
							<h2>Stock Details</h2>
						</header>
						<section>
							 <?php
								$Stock_status = mysqli_query($_SESSION['connection'],"SELECT rawmaterial.id,sum(stock.amount) AS amount FROM category
															INNER JOIN rawmaterial ON categoryid = category.id
															INNER JOIN batch ON rawmaterial.id = batch.rawmaterialid
															INNER JOIN stock ON stock.batchid = batch.id
															WHERE rawmaterial.id IS NOT NULL || rawmaterial.id IS NULL 
															GROUP BY batch.rawmaterialid");
								$StackVirtualValues = $StockValue = 0;
								while($Fetch_Status = mysqli_fetch_array($Stock_status))
								{
									$inspection = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select sum(quantity) as quantity,sum(amount) as amount from rawmaterial inner join batch on rawmaterial.id=rawmaterialid inner join stockinventory on batchid=batch.id where rawmaterial.id='".$Fetch_Status['id']."' && (stockinventory.inspection='2' || stockinventory.inspection='3') group by rawmaterialid"));	
									$inspection1 = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select sum(quantity) as quantity,sum(amount) as amount from rawmaterial inner join batch on rawmaterial.id=rawmaterialid inner join stockinventory on batchid=batch.id where rawmaterial.id='".$Fetch_Status['id']."' && (stockinventory.inspection='0') group by rawmaterialid"));	
									$StackVirtualValues += ($Fetch_Status['amount']);
									$StockValue += ($Fetch_Status['amount']-$inspection1['amount']);
								}
								echo "<br/><br/><font size=2px>Total Stock value&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;".number_format($StockValue,2)."<br/>";
								echo "Total Virtual Stock value: ".number_format($StackVirtualValues,2).'</font><br/><br/><br/><br/><br/>';
							  ?>
						</section>
					</div>
				</td>
	<?php
		}	
		if((in_array($das['id'],$status)) && $das['modulename']=="TotalExpenses")
		{
			?>
				<td>&nbsp;</td>
				<td>
					<div class="widget" id="3" style="width:306px;">
						<font size=2px>
						<header>
							<h2>Total Expenses (Stock In)</h2>
						</header>
						<section>
							Start Date:<input type="text" value="<?php echo date('d-m-Y', strtotime("-30 days")); ?>" id="startdate" size="9"><br/>
							&nbsp;&nbsp;End Date:<input type="text" value="<?php echo date("d-m-Y"); ?>" id="enddate" size="9">
							<button onclick="GetResults('Invoice')">Submit</button>
							<div id="invoiceresults">
							</div>
						</section>
						</font>
					</div>
				</td>
			</tr>
		</table>
		<table>
			<tr>
			<?php 
			}
			if((in_array($das['id'],$status)) && $das['modulename']=="TotalExpense")
			{
			?>
				<td>
					<div class="widget"	id="4" style="width:303px;">
						<font size=2px>
						<header>
							<h2>Total Expenses (Issued)</h2>
						</header>
						<section>
							Start Date:<input type="text" value="<?php echo date('d-m-Y', strtotime("-30 days")); ?>" id="startdate1" size="9"><br/>
							&nbsp;&nbsp;End Date:<input type="text" value="<?php echo date("d-m-Y"); ?>" id="enddate1" size="9">
							<button onclick="GetResults('Issuance')">Submit</button>
							<div id="issuanceresults">
							</div>
						</section>
						</font>
					</div>
				</td>
			</tr>
		<?php 
		}}
		//if((in_array($das['id'],$status)) && $das['modulename']=="StockChart")
		//{?>
		</table>
			<div class="widget" id="2" style="width:610px;">
				<font size=2px>
				<header>
					<h2>Stock Quantity</h2>
				</header>
				<section width="100%">
					 <?php
						echo 
						'<select id="category" onchange="GetRawmeterialChart(this.value)">';
						$SelectCategory=mysqli_query($_SESSION['connection'],"select * from category"); 
						while($FetchCategory = mysqli_fetch_array($SelectCategory))
							echo '<option value="'.$FetchCategory['id'].'">'.$FetchCategory['name'].'</option>';
						echo "</select></dt><dt>
						<div id='chart'>
						</div>
						";
					  ?>
				</section>
				</font>
			</div>
		</div>
	<?php //}
	?>
		<div style="float:right;width:372px;">
			<table>
				<tr>
					<td class="widget">
					<font size=2px>
						<header>
							<h2>Inspection Needed</h2>
						</header>
						<section>
							 <?php
								$Inspections = mysqli_query($_SESSION['connection'],"SELECT rawmaterial.materialcode, batch.id, stockinventory.inspection, stockinventory.status, stockinventory.inspectionquantity, stockinventory.inspectedby, stockinventory.datetime, stockinventory.id AS id, invoice.vendorid, vendor.name, invoice.number, sum(unitprice) , sum(amount) , sum(quantity) , invoice.invoicedate
															FROM stockinventory
															JOIN invoice ON invoice.id = stockinventory.invoiceid
															JOIN vendor ON vendor.id = invoice.vendorid
															JOIN batch ON batch.id = stockinventory.batchid
															JOIN rawmaterial ON rawmaterial.id = rawmaterialid  where (inspection='' and status='') || (inspection!='1' && inspection!='2' && inspection!='3') 
															GROUP BY invoiceid, batchid ORDER BY stockinventory.inspection asc");
								//echo "<br/><b>List of Items Needs To Be Inspected:";
								if(mysqli_num_rows($Inspections))
									echo '<a href="index.php?page=Stores&subpage=spage->Stock_Management,ssubpage->Inspection">List of Items Needs To Be Inspected:&nbsp;&nbsp;&nbsp;'.mysqli_num_rows($Inspections).'</a></b><br/>';
								else	
									echo '<br/><font color="red">No Inspection Items</b></font><br/>';
								
								
							  ?>
						</section>
						</font>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="widget">
					<font size=2px>
						<header>
							<h2>List of Approvals has to be Approved</h2>
						</header>
						<section>
							 <?php
								//echo '<b>List of Pending Approvals</b><br/>';
								if(mysqli_num_rows(mysqli_query($_SESSION['connection'],"select * from approver where module='Sales' and user='".$_SESSION['id']."'")))
								{
									$SelectSaleOrders = mysqli_query($_SESSION['connection'],"SELECT * FROM `sales_order` WHERE id not in(select sales_order_id from sales_order_approval where approved_by='".$_SESSION['id']."')");
									if(mysqli_num_rows($SelectSaleOrders))
									{
										while($FetchSaleOrders = mysqli_fetch_array($SelectSaleOrders))
										{
											$Digits = array("", "0", "00", "000", "0000", "00000", "000000", "0000000");
											$SONo = "SO".$Digits[7 - strlen($FetchSaleOrders['id'])].($FetchSaleOrders['id']);
											echo '<a href="index.php?page=Sales&subpage=spage->Sale_Order,ssubpage->Sale_Order_Approval&SaleOrderId='.$FetchSaleOrders["id"].'&ApproverId='.$_SESSION['id'].'">List of Pending Approvals'.$SONo.'</a><br/>';
										}
									}
									else
									{
										echo '<b><font color="red">No Pending Approvals</b></font><br/>';
									}
								}
								else
								{
									echo '<b><font color="red">No Pending Approvals</b></font><br/>';
								}
							  ?>
						</section>
						</font>
					</td>
				</tr>
				
			</table>
		</div>
		</font>
		<!--table style="width:1200px;border-spacing:5px;">
		<tr class="tr1">
		  <td  id="1" class="td1" style="width:300px;" colspan="0">
			  <?php
				$Stock_status = mysqli_query($_SESSION['connection'],"SELECT rawmaterial.id,sum(stock.amount) AS amount FROM category
				INNER JOIN rawmaterial ON categoryid = category.id
				INNER JOIN batch ON rawmaterial.id = batch.rawmaterialid
				INNER JOIN stock ON stock.batchid = batch.id
				WHERE rawmaterial.id IS NOT NULL || rawmaterial.id IS NULL 
				GROUP BY batch.rawmaterialid");
				$StackVirtualValues = $StockValue = 0;
				while($Fetch_Status = mysqli_fetch_array($Stock_status))
				{
					$inspection = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select sum(quantity) as quantity,sum(amount) as amount from rawmaterial inner join batch on rawmaterial.id=rawmaterialid inner join stockinventory on batchid=batch.id where rawmaterial.id='".$Fetch_Status['id']."' && (stockinventory.inspection='2' || stockinventory.inspection='3') group by rawmaterialid"));	
					$inspection1 = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select sum(quantity) as quantity,sum(amount) as amount from rawmaterial inner join batch on rawmaterial.id=rawmaterialid inner join stockinventory on batchid=batch.id where rawmaterial.id='".$Fetch_Status['id']."' && (stockinventory.inspection='0') group by rawmaterialid"));	
					$StackVirtualValues += ($Fetch_Status['amount']);
					$StockValue += ($Fetch_Status['amount']-$inspection1['amount']);
				}
				echo "<b>Total Stock value:".number_format($StockValue,2).'<br/>';
				echo "Total Virtual Stock value:".number_format($StackVirtualValues,2).'</b>';
			  ?>
		  </td>
		  <td class="td1" id="2" style="width:200px;">
			<h3>Stock Quantity</h3>
			<select id="category" onchange="GetRawmeterialChart(this.value)">
				<?php $SelectCategory=mysqli_query($_SESSION['connection'],"select * from category"); 
				while($FetchCategory = mysqli_fetch_array($SelectCategory))
					echo '<option value="'.$FetchCategory['id'].'">'.$FetchCategory['name'].'</option>';
				?>
			</select>
			<br/>
		  </td>
		  <?php //}
			if($_SESSION['roleid'] == 2)
			{
				$FetchNews = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"select news from news where enable='1'"));
			?>
				<td class="td1"  rowspan="2">
					
					<h3>Latest News:</h3><font color="red"><?php echo $FetchNews['news'];?></font>
					<br/>
					<h4>Sale Orders To Be Approve</h4>
					<?php
						if(mysqli_num_rows(mysqli_query($_SESSION['connection'],"select * from approver where module='Sales' and user='".$_SESSION['id']."'")))
						{
							$SelectSaleOrders = mysqli_query($_SESSION['connection'],"SELECT * FROM `sales_order` WHERE id not in(select sales_order_id from sales_order_approval where approved_by='".$_SESSION['id']."')");
							while($FetchSaleOrders = mysqli_fetch_array($SelectSaleOrders))
							{
								$Digits = array("", "0", "00", "000", "0000", "00000", "000000", "0000000");
								$SONo = "SO".$Digits[7 - strlen($FetchSaleOrders['id'])].($FetchSaleOrders['id']);
								echo '<a href="index.php?page=Sales&subpage=spage->Sale_Order,ssubpage->Sale_Order_Approval&SaleOrderId='.$FetchSaleOrders["id"].'&ApproverId='.$_SESSION['id'].'">'.$SONo.'</a><br/>';
							}
						}
					?>
				</td>
			<?php
			}?>
		</tr>
		<tr rowspan="2" class="tr1">
		  <td class="td1" id="3" colspan="">
			<h3>Total Expenses</h3><br/>
			Start Date:<br/><input type="text" value="<?php echo date('d-m-Y', strtotime("-30 days")); ?>" id="startdate"><br/>
			End Date:<br/><input type="text" value="<?php echo date("d-m-Y"); ?>" id="enddate"><br/>
			<button onclick="GetResults('Invoice')">Submit</button><br/>
			<div id="invoiceresults">
			</div>
			<br/>
		  </td>
		  <td class="td1" id="4" colspan="">
			<h3>Issuance</h3><br/>
			Start Date:<br/><input type="text" value="<?php echo date('d-m-Y', strtotime("-30 days")); ?>" id="startdate1"><br/>
			End Date:<br/><input type="text" value="<?php echo date("d-m-Y"); ?>" id="enddate1"><br/>
			<button onclick="GetResults('Issuance')">Submit</button><br/>
			<div id="issuanceresults">
			</div>
			<br/>
		  </td>
		</tr>
	</table-->
	<br/>
<script>
	//alert(document.getElementById('blocks[]').options.length);
		//var a=[];
	function HideTableDatas()
	{	
		for(var i = 0; i < document.getElementById('blocks[]').options.length; i++) 
		{
			if(document.getElementById('blocks[]').options[i].selected && i != 0)
				document.getElementById(document.getElementById('blocks[]').options[i].value).style.display="none";
			else if(i != 0)
				document.getElementById(i).style.display="block";
		}
	}
	function contains(a=[], obj) 
	{
		for (var i = 0; i < a.length; i++) 
			if (a[i] === obj) 
				return true;
		return false;
	}
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
	GetResults('Invoice');
	GetResults('Issuance');
	function GetResults(Type)
	{	
		var URL="";
		if(Type == "Invoice")
			URL += "?Type="+Type+"&startdate="+document.getElementById("startdate").value+"&enddate="+document.getElementById("enddate").value;
		else
			URL += "?Type="+Type+"&startdate1="+document.getElementById("startdate1").value+"&enddate1="+document.getElementById("enddate1").value;
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
				if(Type == "Invoice")
					document.getElementById("invoiceresults").innerHTML = xmlhttp.responseText;
				else
					document.getElementById("issuanceresults").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/GetResults.php"+URL, true);
		xmlhttp.send();
	}
	GetRawmeterialChart(document.getElementById("category").value)
	function GetRawmeterialChart(Category)
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
				document.getElementById("chart").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/GetRawmeterialChart.php?Category="+Category, true);
		xmlhttp.send();
	}
	Blink();
	function Blink()
	{
		obj=document.getElementById("blink");
		if (obj.style.visibility=="hidden")
			obj.style.visibility="visible";
		else obj.style.visibility="hidden";
		window.setTimeout("Blink();",600);
	}
</script>