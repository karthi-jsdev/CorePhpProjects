<?php include("includes/Product_Management Queries.php"); ?>
<section role="main" id="main">
	<div class="columns" style='width:902px;'>
	<?php
	if(!$_GET['ssubpage'])
		$_GET['ssubpage'] = "Sample_Kitting";
	echo "<br/>";
	$Subpages = array("Sample_Kitting", "Saved_Kitting");
	$Buttons = "";
	foreach($Subpages as $Subpage)
		echo str_replace($_GET['ssubpage'].'" class="button button-gray', $_GET['ssubpage'].'" class="button button-orange',
		'<a href="index.php?page=Stores&subpage=spage->'.$_GET['spage'].',ssubpage->'.$Subpage.'" class="button button-gray">'.str_replace("_"," ", $Subpage).'</a>&nbsp;');
	
	if($_POST['Save'])
	{
		if($_POST['productid'])
		{
			$ProductBOMStatusRows = ProductBOMStatus_Select_ByLimit($_POST['productid']);
			//$ProductCode = $RawMeterialCode = $Quantity = $Reference = $PartNumber = $UnitCost = $Total = $Stock = $KittingQuantity = $TotalPrice = $VendorName = "";
			$i = $j = 1;
			while($ProductBOMStatus = mysql_fetch_array($ProductBOMStatusRows))
			{
				$ProductCode = $ProductBOMStatus['productcode'];
				$RawMeterialCode =$ProductBOMStatus['materialcode'];
				$Quantity = $ProductBOMStatus['quantity'];
				$Reference = $ProductBOMStatus['reference'];
				$PartNumber = $ProductBOMStatus['partnumber'];
				$UnitCost = $ProductBOMStatus['unitprice'];
				$Total = ($ProductBOMStatus['unitprice']*$ProductBOMStatus['quantity']);
				$Stock = $ProductBOMStatus['stockquantity'];
				$KittingQuantity = ($_POST['kittingquantity']*$ProductBOMStatus['quantity']);
				$TotalPrice = ($ProductBOMStatus['unitprice']*$_POST['kittingquantity']*$ProductBOMStatus['quantity']);
				$_POST['vendornames'] = $_POST['vendorname'.$i++];
				if($_POST['vendornames'])
				{
					mysql_query("INSERT INTO kitting(kittingname,productcode,rawmeterialcode,quantity,reference,partnumber,unitcost,total,stock,kittingquantity,totalprice,vendorname) values('KIT".$_POST['productid'].$_POST['kittingquantity']."','".$ProductCode."','".$RawMeterialCode."','".$Quantity."','".$Reference."','".$PartNumber."','".$UnitCost."','".$Total."','".$Stock."','".$KittingQuantity."','".$TotalPrice."','".$_POST['vendornames']."')");
					if($j==1)
						echo "<br/><br/><div class='message success'><b>Message</b> : Kitting data saved successfully and kitting name is K".$_POST['productid']."-".$_POST['kittingquantity']."</div>";
				}
				$j++;
			}
		}
	}
	if($_GET['ssubpage'] == 'Sample_Kitting')
	{ ?>
	<div class="columns" style='width:902px;'>
		<form method="post" name="" class="form panel" action="" id="form" class="form panel" onsubmit="return samkitvalidation();">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
			<header><h2>Kitting Status</h2></header>
			<hr />
				<!--label>Product Category<font color="red">*</font>
					<?php //$SelectProductCode = mysql_query("select * from product_category");?>
					<select name="productcode" id="productcode" onchange="product_subcategory();">
						<option value="">Select</option>
						<?php
							/* while($FetchProductCode = mysql_fetch_array($SelectProductCode))
							{
								if($_POST['productcode']==$FetchProductCode['id'])
									echo '<option value="'.$FetchProductCode['id'].'" selected>'.$FetchProductCode['name'].'</option>';
								else
									echo '<option value="'.$FetchProductCode['id'].'">'.$FetchProductCode['name'].'</option>';
							} */
						?>
					</select>
				</label>
				<label>Product Sub-Category<font color="red">*</font>
					<select name="product_subcategory_id" id="product_subcategory_id" onchange="product();">
						<option value="">Select</option>
						<?php 
						/* if($_POST['product_subcategory_id'])
						{
							$_GET['product_category_id'] = $_POST['productcode'];
							$product_sub = Product_Subcategory();
							$productsubcategory = explode("/",$_POST['product_subcategory_id']);
							while($product_subvalue = mysql_fetch_assoc($product_sub))
							{
								if($productsubcategory[0]==$product_subvalue['id'])
									echo '<option value="'.$product_subvalue['id'].'" selected>'.$product_subvalue['name'].'</option>';
								else
									echo '<option value="'.$product_subvalue['id'].'">'.$product_subvalue['name'].'</option>';
							}
						} */ ?>
					</select>
				</label-->
				<fieldset>
				Enable OR Disable first 5dropdown<input type="checkbox" id="disablevalue" onclick="disabledsiwc()">
				<br/><br/>
				<div class="clearfix">
					<div id="disablevalues">
					<?php 
						$drivertype = mysql_query("SELECT * FROM drivertype");
						$drivertypes = mysql_fetch_assoc(mysql_query("SELECT * FROM drivertype WHERE indexvalue='".$_POST['drivertype']."'"));
					?>
					<label>Driver Type
						<select id="drivertype" name="drivertype" onchange="dsiwcranges()">
							<option value="select">Select</option>
							<?php
								while($drivers = mysql_fetch_assoc($drivertype))
								{
									
									if($_GET['id'] && ($_POST['drivertype'] == $drivers['indexvalue']))
										echo'<option value="'.$drivers['indexvalue'].'" selected>'.$drivers['drivertype'].'</option>';
									/* else if($_POST['drivertype'] == $drivers['indexvalue'])
										echo'<option value="'.$drivers['indexvalue'].'" selected>'.$drivers['drivertype'].'</option>'; */
									else
										echo'<option value="'.$drivers['indexvalue'].'">'.$drivers['drivertype'].'</option>';
								}
							?>
						</select>
					</label>
					<label>Structure
						<select id="structure" name="structure" onchange="dsiwcranges()">
							<option value="select">Select</option>
							<?php
								$structure = mysql_query("SELECT * FROM structure");
								while($structures = mysql_fetch_assoc($structure))
								{
									if($_GET['id'] && ($_POST['structure'] == $structures['indexvalue']))
										echo'<option value="'.$structures['indexvalue'].'" selected>'.$structures['structure'].'</option>';
									/* else if($_POST['structure'] == $structures['indexvalue'])
										echo'<option value="'.$structures['indexvalue'].'" selected>'.$structures['structure'].'</option>'; */
									else
										echo'<option value="'.$structures['indexvalue'].'">'.$structures['structure'].'</option>';
								}
							?>
						</select>
					</label>
					<label>IC
						<select id="ic" name="ic" onchange="dsiwcranges()">
							<option value="select">Select</option>
							<?php
								$ic = mysql_query("SELECT * FROM ic");
								while($ics = mysql_fetch_assoc($ic))
								{
									if($_GET['id'] && ($_POST['ic'] == $ics['indexvalue']))
										echo'<option value="'.$ics['indexvalue'].'" selected>'.$ics['ic'].'</option>';
									/* else if($_POST['ic'] == $ics['indexvalue'])
										echo'<option value="'.$ics['indexvalue'].'" selected>'.$ics['ic'].'</option>'; */
									else
										echo'<option value="'.$ics['indexvalue'].'">'.$ics['ic'].'</option>';
								}
							?>
						</select>
					</label>
					<label>Wattage ranges
						<select id="wattagerange" name="wattagerange" onchange="dsiwcranges()">
							<option value="select">Select</option>
							<?php
								$wattagerange =  mysql_query("SELECT * FROM wattagerange");
								while($wattage = mysql_fetch_assoc($wattagerange))
								{
									if($_GET['id'] && ($_POST['wattagerange'] == $wattage['indexvalue']))
										echo'<option value="'.$wattage['indexvalue'].'" selected>'.$wattage['wattagerange'].'</option>';
									/* else if($_POST['wattagerange'] == $wattage['indexvalue'])
										echo'<option value="'.$wattage['indexvalue'].'" selected>'.$wattage['wattagerange'].'</option>'; */
									else
										echo'<option value="'.$wattage['indexvalue'].'">'.$wattage['wattagerange'].'</option>';
								}
							?>
						</select>
					</label>
					<label>Current ranges
						<select id="currentrange" name="currentrange" onchange="dsiwcranges()">
							<option value="select">Select</option>
							<?php
								$currentrange = mysql_query("SELECT * FROM currentrange");
								while($current = mysql_fetch_assoc($currentrange))
								{
									if($_GET['id'] && ($_POST['currentrange'] == $current['indexvalue']))
										echo'<option value="'.$current['indexvalue'].'" selected>'.$current['currentrange'].'</option>';
									/* else if($_POST['currentrange'] == $current['indexvalue'])
										echo'<option value="'.$current['indexvalue'].'" selected>'.$current['currentrange'].'</option>'; */
									else
										echo'<option value="'.$current['indexvalue'].'">'.$current['currentrange'].'</option>';
								}
							?>
						</select>
					</label>
				</div>
					<label>Product Code<font color="red">*</font>
						<?php $product = mysql_query("SELECT * FROM products"); ?>
						<select name="productid" id="productid">
							<option value="">Select</option>
							<?php
								while($product_value = mysql_fetch_assoc($product))
								{
									if($_POST['productid']==$product_value['id'])
										echo '<option value="'.$product_value['id'].'" selected>'.$product_value['productcode'].'</option>';
									else
										echo '<option value="'.$product_value['id'].'" >'.$product_value['productcode'].'</option>';
								} 
							 ?> 	
						</select>
					</label>
				<div id="product"></div>
					<label>Kitting Quantity <font color="red">*</font>
					<input type="text" id="kittingquantity" name="kittingquantity" required="required" value="<?php if(!$_POST['Save']) echo $_POST['kittingquantity']; ?>" onkeypress="return isNumeric(event)"/>
					</label>
			</div>
			</fieldset>
			<hr />
			<?php
				echo '<button class="button button-green" type="submit"  value="Submit" name="Submit" onclick="return samkitvalidation();">Submit</button>&nbsp;&nbsp;';
			?>
		</form>
		
	<div class="columns">
		<?php
		if($_POST['productid'] && !$_POST['kittingname'] && !$_POST['Save'])
		{ ?>
			<h3>
				<?php
				$ProductBOMStatusTotalRows = mysql_fetch_assoc(ProductBOMStatus_Select_Number_Count_All($_POST['productid']));
				if(!$ProductBOMStatusTotalRows['total'])
					$ProductBOMStatusTotalRows['total'] = 0;
				echo "Kitting details - ".$ProductBOMStatusTotalRows['total'];
				if($ProductBOMStatusTotalRows['total'])
					echo '<a href="#" style="float:right;"  onclick=\'Export()\'><img src="images/icons/download.png"></a>';
				?>
			</h3>
			<hr />	
			<form name='vendor' method='post' onsubmit="return validatevendor();">
				<input type="hidden" name="kittingquantity" value="<?php echo $_POST['kittingquantity']; ?>" />
				<input type="hidden" name="productid" value="<?php echo $_POST['productid']; ?>" />
				<table class="paginate sortable full">
					<thead>
						<tr>
							<th width="43px" align="center">S.NO.</th>
							<th align="left">Product Code</th>
							<th align="left">Rawmaterial Code</th>
							<th align="left">Quantity</th>
							<th align="left">Reference</th>
							<th align="left">Part Number</th>
							<th align="left">Unit Cost</th>
							<th align="left">Total cost</th>
							<th align="left">Stock</th>
							<th align="left">Kitting Quantity</th>
							<th align="left">Total Price of kitting</th>
							<th align="left">Vendor Name</th>
							<th align="left">Lead Time</th>
							<th align="left">Required Cost Of Kitting</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(!$ProductBOMStatusTotalRows['total'])
							echo '<tr><td colspan="11"><font color="red"><center>BOM not defined for this product</center></font></td></tr>';
						$i=1;
						$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
						$ProductBOMStatusRows = ProductBOMStatus_Select_ByLimit($_POST['productid']);
						while($ProductBOMStatus = mysql_fetch_array($ProductBOMStatusRows))
						{
							$Totalkitting = round((($_POST['kittingquantity']*$ProductBOMStatus['quantity'])-$ProductBOMStatus['stockquantity']) * $ProductBOMStatus['unitprice'],2);
							$Totalcostofkitting += round(($ProductBOMStatus['unitprice']*$_POST['kittingquantity']*$ProductBOMStatus['quantity']),2);
							$Totalexpenditureofkitting += round((($_POST['kittingquantity']*$ProductBOMStatus['quantity'])-$ProductBOMStatus['stockquantity']) * $ProductBOMStatus['unitprice'],2);
							echo "<tr style='valign:middle;'>
								<td align='center'>".$i++."</td>
								<td>".$ProductBOMStatus['productcode']."</td>
								<td>".$ProductBOMStatus['materialcode']."</td>
								<td>".$ProductBOMStatus['quantity']."</td>
								<td>".$ProductBOMStatus['reference']."</td>
								<td>".$ProductBOMStatus['partnumber']."</td>
								<td>".round($ProductBOMStatus['unitprice'],2)."</td>
								<td>".round(($ProductBOMStatus['unitprice']*$ProductBOMStatus['quantity']),2)."</td>";
								if($ProductBOMStatus['stockquantity'] == NULL)
									echo "<td>0</td>";
								else
									echo "<td>".$ProductBOMStatus['stockquantity']."</td>";
								echo "<td>".($_POST['kittingquantity']*$ProductBOMStatus['quantity'])."</td>
								<td>".round(($ProductBOMStatus['unitprice']*$_POST['kittingquantity']*$ProductBOMStatus['quantity']),2)."</td>";
								if($ProductBOMStatus['stockquantity']< ($_POST['kittingquantity']*$ProductBOMStatus['quantity']))
								{
									echo "<td><input type='hidden' id='vendorid".($i-1)."' name='vendorid".($i-1)."'/><input type='text' id='vendorname".($i-1)."' name='vendorname".($i-1)."' onclick=\"window.open('includes/Kittingvendor.php?rawmaterialid=".$ProductBOMStatus['rawmaterialid']."&inc=".($i-1)."&vendorleadtime='+document.getElementById('vendorleadtime').value,'opener','width=600,height=500,status')\" onkeypress='return false;' /></td>
									<td><input type='text' style='border:0px;' id='vendorleadtime".($i-1)."' onkeypress='return false;'/></td>";
								}
								else 
									echo "<td>-</td><td>-</td>";
								if($ProductBOMStatus['stockquantity'] <$_POST['kittingquantity']*$ProductBOMStatus['quantity'])
									echo "<td>".$Totalkitting."</td>";
								else
									echo "<td> 0 </td>";
						echo "</tr>";	
						} ?>
						<tr><td colspan='12'><center><button class="button button-green" type="submit" value="Save" name="Save">Save</button></center>&nbsp;&nbsp;</td></tr>
					</tbody>
				</table>
			
			<h3>Kitting Summary</h3>
			<table  style="width:500px;" class="paginate sortable full">
				<thead>
					<tr>
						<th>Total Cost Of Kitting</th>
						<?php
							echo "<td>".$Totalcostofkitting."</td>";
						?>
					</tr>
					<tr>
						<th>Max Lead Time</th>
						<td><input type="text" id='vendorleadtime' style='border: 0;' name='vendorleadtime' value='0' onkeypress='return false;' /></td>
					</tr>
					<tr>
						<th>Total Expenditure Of Complete Kitting</th>
						<?php echo "<td>".$Totalexpenditureofkitting."</td>"; ?>
					</tr>
				</thead>
			</table>
		</form>	
		<hr />
		<?php
		} ?>
	</div>
	<?php
	}
	else if(($_POST['productid'] && $_POST['kittingname']) || $_GET['ssubpage']=='Saved_Kitting')
	{ ?>
		<br/><br/>
		<div class="columns" style='width:902px;'>
			<form method="post" name="" class="form panel" action="?page=Stores&subpage=spage->Purchase_Planner,ssubpage->Saved_Kitting" id="form" class="form panel" onsubmit="return validation();">
				<hr />			
				<fieldset>
					<div class="clearfix">
						<!--label>Product Category<font color="red">*</font>
						<?php //$SelectProductCode = mysql_query("select * from product_category");?>
						<select name="productcode" id="productcode" onchange="product_subcategory();">
							<option value="">Select</option>
							<?php
								/* while($FetchProductCode = mysql_fetch_array($SelectProductCode))
								{
									if($_POST['productcode']==$FetchProductCode['id'])
										echo '<option value="'.$FetchProductCode['id'].'" selected>'.$FetchProductCode['name'].'</option>';
									else
										echo '<option value="'.$FetchProductCode['id'].'">'.$FetchProductCode['name'].'</option>';
								} */
							?>
						</select>
					</label>
					<label>Product Sub-Category<font color="red">*</font>
						<select name="product_subcategory_id" id="product_subcategory_id" onchange="product();">
							<option value="">Select</option>
							<?php 
							/* if($_POST['product_subcategory_id'])
							{
								$_GET['product_category_id'] = $_POST['productcode'];
								$product_sub = Product_Subcategory();
								$productsubcategory = explode("/",$_POST['product_subcategory_id']);
								while($product_subvalue = mysql_fetch_assoc($product_sub))
								{
									if($productsubcategory[0]==$product_subvalue['id'])
										echo '<option value="'.$product_subvalue['id'].'" selected>'.$product_subvalue['name'].'</option>';
									else
										echo '<option value="'.$product_subvalue['id'].'">'.$product_subvalue['name'].'</option>';
								}
							} */ ?>
						</select>
					</label-->	
					<label>Product Code<font color="red">*</font></label>
						<?php $product = mysql_query("SELECT * FROM products"); ?>
						<select name="productid" id="productid" onchange="GetKittingName()">
							<option value="">Select</option>
							<?php
								while($product_value = mysql_fetch_assoc($product))
								{
									if($_POST['productid']==$product_value['id'])
										echo '<option value="'.$product_value['id'].'" selected>'.$product_value['productcode'].'</option>';
									else
										echo '<option value="'.$product_value['id'].'" >'.$product_value['productcode'].'</option>';
								} 
							 ?> 	
						</select>
					</div>
					<div id="product"></div>
					<div id="kittingname_display">
					<div class="clearfix">
						<label>Kitting Name <font color="red">*</font><br></label>
							<select name="kittingname" id="kittingname">
								<option value="">Select</option>
								<?php
								$FetchProductCode = mysql_fetch_array(mysql_query("Select * From products Where id='".$_POST['productid']."'"));
								$Select_Kitting  = mysql_query("Select distinct(kittingname) From kitting where productcode='".$FetchProductCode['id']."'"); 
								if($_POST['kittingname'])
								{
									while($FetchKittingName = mysql_fetch_array($Select_Kitting))
									{
										/* if(!in_array($FetchKittingName['kittingname'],$Kitting))
										{ */
											if($_POST['kittingname']==$FetchKittingName['kittingname'])
												echo '<option value="'.$FetchKittingName['kittingname'].'" selected>'.$FetchKittingName['kittingname'].'</option>';
											else
												echo '<option value="'.$FetchKittingName['kittingname'].'">'.$FetchKittingName['kittingname'].'</option>';
											//$Kitting[] = $FetchKittingName['kittingname'];
										/* } */
									}
								}?>
							</select>
						</div>
					</div>
						<?php
							echo '<br/><button class="button button-green" type="submit" value="Search" name="Search">Search</button>&nbsp;&nbsp;';
						?>
				</fieldset>
			</div>
				<hr />
			</form>
		</div><br/>
		<?php
		if($_POST['kittingname'] && mysql_num_rows(mysql_query("Select * From kitting where kittingname='".$_POST['kittingname']."'")))
		{ ?>
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th>S.NO.</th>
						<th align="left">Kitting Name</th>
						<th align="left">Product Code</th>
						<th align="left">Rawmaterial Code</th>
						<th align="left">Quantity</th>
						<th align="left">Reference</th>
						<th align="left">Part Number</th>
						<th align="left">Unit Cost</th>
						<th align="left">Total cost</th>
						<th align="left">Stock</th>
						<th align="left">Kitting Quantity</th>
						<th align="left">Total Price of kitting</th>
						<th align="left">Vendor Name</th>
					</tr>
				</thead>
			<?php
			$SelectKittingData = mysql_query("Select * From kitting where kittingname='".$_POST['kittingname']."'");
			$i = 1;
			while($FetchKittingData = mysql_fetch_array($SelectKittingData))
			{
				echo '<tr>
						<td>'.$i++.'</td>
						<td>'.$FetchKittingData['kittingname'].'</td>
						<td>'.$FetchKittingData['productcode'].'</td>
						<td>'.$FetchKittingData['rawmeterialcode'].'</td>
						<td>'.$FetchKittingData['quantity'].'</td>
						<td>'.$FetchKittingData['reference'].'</td>
						<td>'.$FetchKittingData['partnumber'].'</td>
						<td>'.$FetchKittingData['unitcost'].'</td>
						<td>'.$FetchKittingData['total'].'</td>';
						if($FetchKittingData['stock']==NULL)
							echo '<td>0</td>';
						else
							echo '<td>'.$FetchKittingData['stock'].'</td>';
						echo '<td>'.$FetchKittingData['kittingquantity'].'</td>
						<td>'.$FetchKittingData['totalprice'].'</td>
						<td>'.$FetchKittingData['vendorname'].'</td>
					</tr>';
			}
		}
	} ?>	
			</table>
				
	<div class="clear">&nbsp;</div>
	<?php
	$GETParameters = "page=Stores&subpage=spage->Purchase_Planner,ssubpage->".$_GET['ssubpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
</section>
<script>
	function disabledsiwc()
	{
		if(document.getElementById("disablevalue").checked==true)
			document.getElementById("disablevalues").style.visibility="hidden";
		else if(document.getElementById("disablevalue").checked==false)
			document.getElementById("disablevalues").style.visibility="visible";
	}
	function dsiwcranges()
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp=new XMLHttpRequest();
		else
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
				document.getElementById('productid').innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/Product_BasedPlanner.php?drivertype="+document.getElementById("drivertype").value+"&structure="+document.getElementById("structure").value+"&ic="+document.getElementById("ic").value+"&wattagerange="+document.getElementById("wattagerange").value+"&currentrange="+document.getElementById("currentrange").value,true);
		xmlhttp.send();
	}
	function GetProductCode(Prefix,productid)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp=new XMLHttpRequest();
		else
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
				document.getElementById('product').innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/GetProductCode.php?Prefix="+Prefix+"&productid="+productid,true);
		xmlhttp.send();
	}
	
	function GetKittingName()
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp=new XMLHttpRequest();
		else
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
				document.getElementById('kittingname').innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/GetKittingName.php?productid="+document.getElementById("productid").value,true);
		xmlhttp.send();
	}
	function samkitvalidation()
	{
		if(document.getElementById("disablevalue").checked==false)
		{
			if(document.getElementById('drivertype').selectedIndex == "")
			{
				alert("Please Select The Drivertype");	
				return false;
			}
			else if(document.getElementById('structure').selectedIndex == "")
			{
				alert("Please select The Structure");
				return false;
			}
			else if(document.getElementById('ic').selectedIndex == "")
			{
				alert("Please Select The Ic");	
				return false;
			}
			else if(document.getElementById('wattagerange').selectedIndex == "")
			{
				alert("Please select The Wattagerange");
				return false;
			}
			else if(document.getElementById('currentrange').selectedIndex == "")
			{
				alert("Please select The Currentrange");
				return false;
			}
			else if(document.getElementById('productid').selectedIndex == "")
			{
				alert("Please Select The Productcode");	
				return false;
			}
			else if(document.getElementById('kittingname').selectedIndex == "")
			{
				alert("Please select The Kittingname");
				return false;
			}
		}
		else if(document.getElementById("disablevalue").checked==true)
		{
			if(document.getElementById('productid').selectedIndex == "")
			{
				alert("Please Select The Productcode");	
				return false;
			}
			else if(document.getElementById('kittingname').selectedIndex == "")
			{
				alert("Please select The Kittingname");
				return false;
			}
		}
	}
	function validation()
	{
		var message = "";
		<?php if($_GET['ssubpage']=='Saved_Kitting')
		{ ?>
		if(document.getElementById('productid').selectedIndex == "")
			message = "Please Select The productcode";	
		else if(document.getElementById('kittingname').selectedIndex == "")
			message = "Please select The Kittingname";	
		<?php } ?>
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	
	function Export()
	{
		var j, Ids = "";
		for(j=1; j<=<?php echo ($i-1);?>;j++)
		{
			if(document.getElementById('vendorid'+j).value == "")
				document.getElementById('vendorid'+j).value = " ";
			if(j == 1)
				Ids = document.getElementById('vendorid'+j).value;
			else
				Ids += ",".document.getElementById('vendorid'+j).value;
		}
		window.open("includes/ExportKittingData.php?export=1&productid=<?php echo $_POST['productid'];?>&productcat=<?php echo $_POST['productcode'];?>&kittingquantity=<?php echo $_POST['kittingquantity'];?>&Ids="+Ids,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	function product_subcategory()
	{
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
				document.getElementById('product_subcategory_id').innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/Product_AndSubcategory.php?product_category_id="+document.getElementById('productcode').value,true);
		xmlhttp.send();
	}
	function product()
	{
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
				document.getElementById('productid').innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/Product_AndSubcategory.php?product_subcategory_id="+document.getElementById('product_subcategory_id').value,true);
		xmlhttp.send();
	}
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function validatevendor()
	{
		var message="";
		if(document.getElementById('vendorname1').value.length == "")
			message = "Please Select The vendor name";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>