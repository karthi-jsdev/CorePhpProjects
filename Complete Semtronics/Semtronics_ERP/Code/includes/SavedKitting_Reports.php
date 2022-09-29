
			<form method="post" class="form panel" action="" id="form" onsubmit="return validation();">
				<hr />			
				<fieldset>
					<div class="clearfix">
						<label>Product Category<font color="red">*</font>
						<?php $SelectProductCode = mysqli_query($_SESSION['connection'],"select * from product_category");?>
						<select name="productcode" id="productcode" onchange="product_subcategory();">
							<option value="">Select</option>
							<?php
								while($FetchProductCode = mysqli_fetch_array($SelectProductCode))
								{
									if($_POST['productcode']==$FetchProductCode['id'])
										echo '<option value="'.$FetchProductCode['id'].'" selected>'.$FetchProductCode['name'].'</option>';
									else
										echo '<option value="'.$FetchProductCode['id'].'">'.$FetchProductCode['name'].'</option>';
								}
							?>
						</select>
					</label>
					<label>Product Sub-Category<font color="red">*</font>
						<select name="product_subcategory_id" id="product_subcategory_id" onchange="product();">
							<option value="">Select</option>
							<?php 
							if($_POST['product_subcategory_id'])
							{
								$_GET['product_category_id'] = $_POST['productcode'];
								$product_sub = Product_Subcategory();
								$productsubcategory = explode("/",$_POST['product_subcategory_id']);
								while($product_subvalue = mysqli_fetch_assoc($product_sub))
								{
									if($productsubcategory[0]==$product_subvalue['id'])
										echo '<option value="'.$product_subvalue['id'].'" selected>'.$product_subvalue['name'].'</option>';
									else
										echo '<option value="'.$product_subvalue['id'].'">'.$product_subvalue['name'].'</option>';
								}
							} ?>
						</select>
					</label>	
					<label>Product Code
					<font color="red">*</font>
						<select name="productid" id="productid"  onchange="GetKittingName('',this.value)">
							<option value="">Select</option>
							<?php 
							if($_POST['productid'])
							{
								$_GET['product_subcategory_id'] = $_POST['product_subcategory_id'];
								$product = Product1();
								$productexplode = explode("/",$_POST['productid']);
								while($product_value = mysqli_fetch_assoc($product))
								{
									if($productexplode[0]==$product_value['id'])
										echo '<option value="'.$product_value['id'].'" selected>'.$product_value['code'].'</option>';
									else
										echo '<option value="'.$product_value['id'].'">'.$product_value['code'].'</option>';
								}
							} ?>
						</select>
					</label>
						<div id="product"></div>
						<div id="kittingname_display">
							<label>Kitting Name <font color="red">*</font><br>
								<select name="kittingname" id="kittingname">
									<option value="">Select</option>
									<?php
									$FetchProductCode = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * From product Where id='".$_GET['productid']."'"));
									$Select_Kitting  = mysqli_query($_SESSION['connection'],"Select * From kitting "); 
									if($_POST['kittingname'])
									{
										$Kitting = array();
										while($FetchKittingName = mysqli_fetch_array($Select_Kitting))
										{
											if(!in_array($FetchKittingName['kittingname'],$Kitting))
											{
												if($_POST['kittingname']==$FetchKittingName['kittingname'])
													echo '<option value="'.$FetchKittingName['kittingname'].'" selected>'.$FetchKittingName['kittingname'].'</option>';
												else
													echo '<option value="'.$FetchKittingName['kittingname'].'">'.$FetchKittingName['kittingname'].'</option>';
												$Kitting[] = $FetchKittingName['kittingname'];
											}
										}
									} ?>
								</select>
							</label>	
						</div>
						<?php
						echo '<br/><button class="button button-green" type="submit" value="Search" name="Search">Search</button>&nbsp;&nbsp;';
						?>
					</div>
				</fieldset>
				<hr />
			</form>
		<?php
		if($_POST['kittingname'] && mysqli_num_rows(mysqli_query($_SESSION['connection'],"Select * From kitting where kittingname='".$_POST['kittingname']."'")))
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
		<div align="right"><a href="#" title="Download" onclick='Export_Data("getdata=KittingName_Report")'><img src="images/icons/download.png"></a></div>
			<?php	
			$SelectKittingData = mysqli_query($_SESSION['connection'],"Select * From kitting where kittingname='".$_POST['kittingname']."'");
			$i = 1;
			while($FetchKittingData = mysqli_fetch_array($SelectKittingData))
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
			echo '</table>';
		} 
		?>
<script>
	
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
	
	function GetKittingName(kittingname,productid)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp=new XMLHttpRequest();
		else
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.responseText)
			{
				document.getElementById('kittingname_display').innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/GetKittingName.php?kittingname="+kittingname+"&productid="+productid,true);
		xmlhttp.send();
	}
	
	function validation()
	{
		var message = "";
		if(document.getElementById('kittingname').value == "")
			message = "Please select the kitting name";
		if(document.getElementById('productid').value == "")
			message = "Please Select The product";	
		if(document.getElementById('product_subcategory_id').value == "")
			message = "Please select The productsubcategory";	
		if(document.getElementById('productcode').value == "")
			message = "Please select The productcategory";
			
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
	function Export_Data(PostBackValues)
	{
		window.open("includes/ExportKittingReportData.php?export=1&"+PostBackValues+"&kittingname="+document.getElementById("kittingname").value,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
</script>