<section role="main" id="main">
	<?php 
	if($_POST['finish'])
	{
		if(isset($_FILES['files']))
		{
				foreach($_FILES['files']['tmp_name'] as $i=>$tmp_name)
					{
						$fileName = $_FILES['files']['name'][$i];
						$tmpName  = $_FILES['files']['tmp_name'][$i];
						$fileSize = $_FILES['files']['size'][$i];
						$fileType = $_FILES['files']['type'][$i];

						$fp      = fopen($tmpName, 'r');
						$content = fread($fp, filesize($tmpName));
						$content = addslashes($content);
						fclose($fp);

						if(!get_magic_quotes_gpc())
						{
							$fileName = addslashes($fileName);
						}
						$contents[]=$content;
						$fileNames[]=$fileName;
						$fileSizes[]=$fileSize;
						$fileTypes[]=$fileType;
					}
					$content = implode('!@#%',$contents);
					$fileName = implode('!@#%',$fileNames);
					$fileSize = implode('!@#%',$fileSizes);
					$fileType = implode('!@#%',$fileTypes);
		}
		$Prodcutbomveresions = mysql_fetch_array(mysql_query("SELECT * FROM productbom_versioning JOIN products on products.id=productbom_versioning.productcode where productbom_versioning.productcode='".$_POST['productid'][0]."'  order by versions desc LIMIT 0,1"));
		if($s = mysql_num_rows(mysql_query("SELECT * FROM productbom_versioning JOIN products on products.id=productbom_versioning.productcode where productbom_versioning.productcode='".$_POST['productid'][0]."'  order by versions desc")))
		{
			for($i=0;$i<count($_POST['productid']);$i++)
				mysql_query("INSERT INTO productbom_versioning(id,productcode,quantity,reference,tolerance,package,make,comments,versions,type,name,MAX_FILE_SIZE,files) VALUES ('','".$_POST['productid'][$i]."','".$_POST['quantity'][$i]."','".$_POST['reference'][$i]."','".$_POST['tolerance'][$i]."','".$_POST['package'][$i]."','".$_POST['make'][$i]."','".$_POST['comments']."','".($Prodcutbomveresions['versions']+1)."','".$fileType."','".$fileName."','".$fileSize."','".$content."')");
		}
		else
		{
			for($i=0;$i<count($_POST['productid']);$i++)
				mysql_query("INSERT INTO productbom_versioning(id,productcode,quantity,reference,tolerance,package,make,comments,versions,type,name,MAX_FILE_SIZE,files) VALUES ('','".$_POST['productid'][$i]."','".$_POST['quantity'][$i]."','".$_POST['reference'][$i]."','".$_POST['tolerance'][$i]."','".$_POST['package'][$i]."','".$_POST['make'][$i]."','".$_POST['comments']."','1','".$fileType."','".$fileName."','".$fileSize."','".$content."')");
		}
		$_POST['productid']=""; 
		$_POST['versions']=""; 
	}
	if($_POST['Update'])
	{
		mysql_query("UPDATE productbom SET productcode ='".$_POST['productcode']."', quantity ='".$_POST['quantity']."', reference='".$_POST['reference']."',tolerance='".$_POST['tolerance']."',package='".$_POST['package']."',make='".$_POST['make']."' WHERE id='".$_POST['id']."'");
	}
	if($_GET['versionid'])
	{
		mysql_query("delete from productbom_versioning WHERE id='".$_GET['versionid']."'");
	}
	if($_GET['id'])
	{
		$FetchProductbom = mysql_fetch_array(mysql_query("SELECT productbom.id as id,products.productcode,products.id as productid,productbom.quantity as quantity,productbom.reference as reference,productbom.tolerance,productbom.package,productbom.make FROM productbom JOIN products ON products.id = productbom.productcode WHERE productbom.id='".$_GET['id']."'"));
		$_POST['productid'] = $FetchProductbom['productid'];
		?>
		<div class="columns" style='width:902px;'>
		<form method="post" name="" class="form panel" action="" id="form" >
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
			<input type="hidden" id="rawmaterialid" name="rawmaterialid" value="<?php if($_GET['rawmaterialid']) echo $_GET['rawmaterialid']; ?>" required="required"/>
			<header><h2>Product-BOM Status</h2></header>
			<hr />			
			<fieldset>
				<div class="clearfix">
					<?php $productcode = mysql_query("SELECT * FROM products");?>
					<label>Product Code <font color="red">*</font>
						<select id="productcode" name="productcode">
							<option value="select">Select</option>
							<?php
								while($productcodes = mysql_fetch_array($productcode))
								{
									if($_POST['productid'] == $productcodes['id'])
										echo '<option value="'.$productcodes['id'].'" selected>'.$productcodes['productcode'].'</option>';
									else
										echo '<option value="'.$productcodes['id'].'">'.$productcodes['productcode'].'</option>';
								}
							?>
						</select>
					</label>
					<label>Bom Category<font color="red">*</font>
					<select id="bom_category" name="bom_category" onchange="bomcategory_rawmaterial()">
						<option value="">Select</option>
						<?php
						$bom_category = mysql_query("SELECT bom_category.id,bom_category.bom_category from bom_category");
						while($bomcategory = mysql_fetch_array($bom_category))
						{
							$bom = mysql_fetch_Assoc(mysql_query("Select * From rawmaterial join bom_category on bom_category.id=rawmaterial.bom_category where rawmaterial.id='".$_GET['rawmaterialid']."'"));
							if(($_POST['bom_category'] == $bomcategory['id'])|| ($bomcategory['id'] == $bom['id']))
								echo '<option value="'.$bomcategory['id'].'" selected>'.$bomcategory['bom_category'].'</option>';
							else
								echo '<option value="'.$bomcategory['id'].'">'.$bomcategory['bom_category'].'</option>';
						} ?>
					</select>
				</label>
					<label>Raw Material <font color="red">*</font>
					<select id="rawmaterialid" name="rawmaterialid">
						<option value="">Select</option>
						<?php
							$rawmaterialid = mysql_query("SELECT * from rawmaterial");
							while($rawmaterial = mysql_fetch_array($rawmaterialid))
							{
								if($_GET['rawmaterialid'] == $rawmaterial['id'])
									echo '<option value="'.$rawmaterial['id'].'" selected>'.$rawmaterial['materialcode'].'</option>';
								else
									echo '<option value="'.$rawmaterial['id'].'">'.$rawmaterial['materialcode'].'</option>';
							}
						?>
					</select>
				</label>
					<label>Quantity <font color="red">*</font><br/>
						<?php ?>
						<input type="text" id="quantity" name="quantity" maxlength="11" required="required" value="<?php echo $_POST['quantity']=$FetchProductbom['quantity']; ?>" onkeypress="return isNumeric(event)"/>
					</label>
					<label>Reference <font color="red">*</font><br/>
						<input type="text" id="reference" name="reference" maxlength="50" required="required" value="<?php echo $_POST['reference']=$FetchProductbom ['reference']; ?>" onkeypress="return AlphaNumCheck(event)"/>
					</label>
				</div>
				<div class="clearfix">
					<label>Tolerance <br>
						<input type="text" id="tolerance" name="tolerance" maxlength="11" value="<?php echo $_POST['tolerance']=$FetchProductbom ['tolerance']; ?>" onkeypress="return isNumeric('b',event)"/>
					</label>
					<label>Package <br>
						<input type="text" id="package" name="package" maxlength="11" value="<?php echo $_POST['package']=$FetchProductbom ['package']; ?>" onkeypress="return isNumeric('h',event)"/>
					</label>
					<label>Make &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="text" id="make" name="make" maxlength="11" value="<?php echo $_POST['make']=$FetchProductbom ['make']; ?>" onkeypress="return isNumeric('h',event)"/>
					</label>
				</div>
			</fieldset>
			<hr />
			<?php
				echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
			?>
		</form>
<?php }
	else
	{ ?>
	
	<div class="columns" style='width:902px;'>
		<form method="post" name="" class="form panel" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" onsubmit="return validation();">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
			<header><h2>Product-BOM Status</h2></header>
			<hr />			
			<fieldset>
				<div class="clearfix">
					<?php $productcode = mysql_query("SELECT * FROM products");?>
					<label>Product Code <font color="red">*</font>
						<select id="productcode" name="productcode" onchange="Versions();">
							<option value="select">Select</option>
							<?php
								while($productcodes = mysql_fetch_array($productcode))
								{
									if($_GET['id'] && $_POST['productcode'] == $productcodes['id'])
										echo '<option value="'.$productcodes['id'].'" selected>'.$productcodes['productcode'].'</option>';
									else
										echo '<option value="'.$productcodes['id'].'">'.$productcodes['productcode'].'</option>';
								}
							?>
						</select>
					</label>
					<label>
					<div id="versions_display">
						Versions
						<font color="red">*</font>
							<select name="versions" id="versions">
								<option value="">Select</option>
								<?php
								if($_POST['versions'])
								{
									$InArray = array();
									$_GET['productid'] = $_POST['productid'];
									$productversion = ProductVersions();
									while($product_versions = mysql_fetch_assoc($productversion))
									{
										if(!in_array($product_versions['versions'],$InArray))
										{
											if($_POST['versions']==$product_versions['id'])
												echo '<option value="'.$product_versions['versions'].'" selected>'.$product_versions['versions'].'</option>';
											else
												echo '<option value="'.$product_versions['versions'].'" >'.$product_versions['versions'].'</option>';
											$InArray[] = $product_versions['versions'];
										}
									} 
								} ?>
							</select>
						</div>
					</label>
				</div>
			</fieldset>
			<hr />
			<?php
				echo '<button class="button button-green" type="submit" name="Submit" value="submit">Submit</button>&nbsp;&nbsp;';
			?>
		</form>
	</div>
<?php } ?>	
	<div class="columns">
	<form enctype="multipart/form-data" method="POST" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" >
	<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
		<?php
		if(($_POST['productcode']) && !$_POST['versions'])
		{ ?>
			<h3>
				<?php
				$ProductBOMStatusTotalRows = mysql_fetch_array(ProductBOMStatus_Select_Count_All());
				if(!$ProductBOMStatusTotalRows['total'])
					$ProductBOMStatusTotalRows['total'] = 0;
				echo "Total No. of Product-BOM - ".$ProductBOMStatusTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th align="center">S.NO.</th>
						<th>Product Code</th>
						<th>Rawmaterial Code</th>
						<th>Quantity</th>
						<th>Reference</th>
						<th>Tolerance</th>
						<th>Package</th>
						<th>Make</th>
						<th>Part Number</th>
						<th>Unit Cost</th>
						<th>Total</th>
						<th>Stock</th>
						<th>Action</th>
						<th>Download</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$ProductBOMStatusTotalRows['total'])
						echo '<tr><td colspan="7"><font color="red"><center>Bom not defined for this product</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($ProductBOMStatusTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$ProductBOMStatusRows = ProductBOMStatus($Start, $Limit);
					while($ProductBOMStatus = mysql_fetch_array($ProductBOMStatusRows))
					{
						echo '<input type="hidden" value="'.$ProductBOMStatus['quantity'].'" name="quantity[]">';
						echo '<input type="hidden" value="'.$ProductBOMStatus['reference'].'" name="reference[]">';
						echo '<input type="hidden" value="'.$ProductBOMStatus['tolerance'].'" name="tolerance[]">';
						echo '<input type="hidden" value="'.$ProductBOMStatus['package'].'" name="package[]">';
						echo '<input type="hidden" value="'.$ProductBOMStatus['make'].'" name="make[]">';
						echo '<input type="hidden" value="'.$ProductBOMStatus['productid'].'" name="productid[]">';
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td align='center'>".$ProductBOMStatus['productcode']."</td>
							<td align='center'>".$ProductBOMStatus['materialcode']."</td>
							<td align='center'>".$ProductBOMStatus['quantity']."</td>
							<td align='center'>".$ProductBOMStatus['reference']."</td>
							<td align='center'>".$ProductBOMStatus['tolerance']."</td>
							<td align='center'>".$ProductBOMStatus['package']."</td>
							<td align='center'>".$ProductBOMStatus['make']."</td>
							<td align='center'>".$ProductBOMStatus['partnumber']."</td>
							<td align='center'>".round($ProductBOMStatus['unitprice'],2)."</td>
							<td align='center'>".round(($ProductBOMStatus['unitprice']*$ProductBOMStatus['quantity']),2)."</td>";
							if($ProductBOMStatus['stockquantity']=="")
								echo "<td align='center'>0</td>";
							else	
								echo "<td align='center'>".$ProductBOMStatus['stockquantity']."</td>";
							echo "<td align='center'><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&productid=".$ProductBOMStatus['productid']."&rawmaterialid=".$ProductBOMStatus['rawmaterialid']."&id=".$ProductBOMStatus['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a>  &nbsp; <a href='#' onclick='deleterow(".$ProductBOMStatus['id'].")'>Delete</a></td>
						</tr>";
					}
					/* $bomfile = mysql_query("SELECT * FROM productbom_versioning WHERE versions='".$_POST['versions']."'");
					while($bomfiles = mysql_fetch_array($bomfile))
					{
						if($_GET['bid'])
						{}
						else
							echo "<tr><td><a target='_blank' href='includes/productbomdownload.php?bid=".$bomfiles['id']."'>Download</a></td></tr>";
					} */
					?>
				</tbody>
			</table>
		<table>
			<tr>
				<td>
				<label>Comments <font color="red">*</font><br/>
					<textarea id="comments" name="comments" required="required"></textarea>
				</label>
				</td>
				<td>&nbsp;&nbsp;</td>
				<td>
					<label><br/>&nbsp;&nbsp;&nbsp;FilesUpload<br/>
						&nbsp;&nbsp;&nbsp;<input type="file" name="files[]" multiple="multiple" id="files">
					</label>
				</td>
				<td><br/><br/>
					<button class="button button-blue" type="submit" name="finish" value="finish">Save New Version</button>
				</td>
			</tr>
		</table>
		</form>
	<?php
	}
	else if($_POST['versions'])
	{ ?>
	<form enctype="multipart/form-data" method="POST" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" onsubmit="returtn validation();">
	<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
		<?php
		$ProductBOMStatusTotalRows = mysql_fetch_array(ProductBOMVersioning_Select_Count_All());
		if(!$ProductBOMStatusTotalRows['total'])
			$ProductBOMStatusTotalRows['total'] = 0;
		echo "<h3>Total No. of Product-BOM - ".$ProductBOMStatusTotalRows['total']."</h3>";
		echo "<h4>version-".$_POST['versions']."</h4>";
		?>
		<hr />			
		<table class="paginate sortable full">
			<thead>
				<tr>
					<th width="43px" align="center">S.NO.</th>
					<th align="left">Product Code</th>
					<th align="left">Rawmaterial Code</th>
					<th align="left">Quantity</th>
					<th align="left">Reference</th>
					<th align="left">Tolerance</th>
					<th align="left">Package</th>
					<th align="left">Make</th>
					<th align="left">Part Number</th>
					<th align="left">Unit Cost</th>
					<th align="left">Total</th>
					<th align="left">Stock</th>
					<th align="left">Comments</th>
					<th align="left">Action</th>
					<th align="left">Download</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!$ProductBOMStatusTotalRows['total'])
					echo '<tr><td colspan="7"><font color="red"><center>BOM not defined for this product</center></font></td></tr>';
				$Limit = 10;
				$total_pages = ceil($ProductBOMStatusTotalRows['total'] / $Limit);
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1;
				
				$i = $Start = ($_GET['pageno']-1)*$Limit;
				$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
				$ProductBOMStatusRows = ProductBOMVersioningStatus($Start, $Limit);
				$AllRows = mysql_num_rows($ProductBOMStatusRows);
				while($ProductBOMStatus = mysql_fetch_array($ProductBOMStatusRows))
				{
					echo "<tr style='valign:middle;'>
						<td align='center'>".++$i."</td>
						<td>".$ProductBOMStatus['productcode']."</td>
						<td>".$ProductBOMStatus['materialcode']."</td>
						<td>".$ProductBOMStatus['bomversionquantity']."</td>
						<td>".$ProductBOMStatus['bomversionreference']."</td>
						<td>".$ProductBOMStatus['tolerance']."</td>
						<td>".$ProductBOMStatus['package']."</td>
						<td>".$ProductBOMStatus['make']."</td>
						<td>".$ProductBOMStatus['partnumber']."</td>
						<td>".round($ProductBOMStatus['unitprice'],2)."</td>
						<td>".round(($ProductBOMStatus['unitprice']*$ProductBOMStatus['quantity']),2)."</td>";
						if($ProductBOMStatus['stockquantity']=="")
							echo "<td align='center'>0</td>";
						else	
							echo "<td align='center'>".$ProductBOMStatus['stockquantity']."</td>";
						echo "<td>".$ProductBOMStatus['comments']."</td>";
						echo "<td>";
						$LastVersions = mysql_fetch_array(mysql_query("SELECT versions FROM productbom_versioning WHERE product_id='".$ProductBOMStatus['product_id']."' ORDER BY versions DESC LIMIT 1"));
						if($ProductBOMStatus["versions"] > ($LastVersions["versions"]-1))
							echo "<a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&productid=".$ProductBOMStatus['productid']."&id=".$ProductBOMStatus['id']."&rawmaterialid=".$ProductBOMStatus['rawmaterialid']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a>  &nbsp; <a href='#' onclick='deleterow(".$ProductBOMStatus['versionid'].")'>Delete</a>";
					echo "</td>
					";
				}
					$bomfile = mysql_fetch_assoc(mysql_query("SELECT * FROM productbom_versioning WHERE versions='".$_POST['versions']."'"));
					$names = explode('!@#%',$bomfile['name']);
					foreach($names as $namea)
					{ ?>
						<a href="#" onclick="window.open('includes/productbomdownload.php?bid=<?php echo $bomfile["id"];?>&name=<?php echo $namea;?>', '_blank');"><?php echo $namea;?></a>&nbsp;&nbsp;</tr>
					<?php
					}
				?>
			</tbody>
		</table>
		<?php
		$ProductBOM_Value = ProductBOMStatus_Totalvalue();
		$ProductBOM_Values = mysql_fetch_assoc($ProductBOM_Value);
		echo "<strong>Total Cost is ".number_format($ProductBOM_Values['totalvalues'],2)."</strong>";
		$versionno = mysql_fetch_assoc(mysql_query("SELECT * FROM productbom_versioning ORDER BY id DESC"));
		if($_POST['versions'] != 1)
		{
		?>
		<table>
			<tr>
				<td>
				<label>Comments <font color="red">*</font><br/>
					<textarea id="comments" name="comments" required="required"></textarea>
				</label>
				</td>
				<td>&nbsp;&nbsp;</td>
				<td>
					<label><br/>&nbsp;&nbsp;&nbsp;FilesUpload<br/>
						&nbsp;&nbsp;&nbsp;<input type="file" name="files[]" multiple="multiple" id="files">
					</label>
				</td>
				<td><br/><br/>
					<button class="button button-blue" type="submit" name="finish" value="finish">Save New Version</button>
				</td>
			</tr>
		</table>
		<?php } 
		else {} ?>
	</form>
	<?php } ?>
	</div>
	<div class="clear">&nbsp;</div>
</section>
<script>
	
	
	function validation()
	{
		var message = "";
		if(document.getElementById('versions').value=="")
			message="Please Select the version";
		if(document.getElementById('productcode').value=="")
			message="Please Select the product code";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
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
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
				document.getElementById('product').innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/GetProductCode.php?Prefix="+Prefix+"&productid="+productid,true);
		xmlhttp.send();
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
	/*function rawmaterial()
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
					document.getElementById('rawmaterialid').innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/Product_AndSubcategory.php?productbomstatusid="+document.getElementById('productid').value,true);
		xmlhttp.send();
	}*/
	function Versions()
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
			{
				if(xmlhttp.responseText)
				{
					document.getElementById('versions_display').innerHTML = xmlhttp.responseText;
				}
			}	
		}
		xmlhttp.open("GET","includes/Product_AndSubcategory.php?productcode="+document.getElementById('productcode').value,true);
		xmlhttp.send();
	}
	
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122 || charCode==32)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	function deleterow(id)
	{
		var Are = confirm("Are you sure, Do you really want to delete this record?");
		if(Are == true)
			document.location.assign("index.php?page=Stores&subpage=spage->Product_Management,ssubpage-><?php echo $_GET['ssubpage']?>&versionid="+id+"&action=Delete");
	}
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8) 
			return true;
        if (charCode == 42 || charCode == 45 || charCode == 46 || charCode == 95 || charCode == 64 || charCode == 63) 
			return true;
        var keynum;
        var keychar;
        var charcheck = /[a-zA-Z0-9]/;
        if(window.event)
        {
            keynum = e.keyCode;
        }
        else
		{
            if(e.which)
            {
                keynum = e.which;
            }
            else 
				return true;
        }

        keychar = String.fromCharCode(keynum);
        return charcheck.test(keychar);
    }
	function bomcategory_rawmaterial()
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
				alert(document.getElementById('rawmaterialid').innerHTML = xmlhttp.responseText);
		}
		xmlhttp.open("GET","includes/bom_basedrawmaterial.php?bom_category="+document.getElementById('bom_category').value,true);
		xmlhttp.send();
	}
</script>