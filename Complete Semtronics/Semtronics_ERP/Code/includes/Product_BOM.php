<section role="main" id="main">
	<?php
	$Columns = array("id", "productcode","rawmaterialid", "quantity", "reference", "tolerance", "package", "make", "files");
	if($_GET['action'] == 'Edit')
	{
		$ProductBOM = mysql_fetch_assoc(ProductBOM_Select_ById());
		foreach($Columns as $Col)
			$_POST[$Col] = $ProductBOM[$Col];
	}
	else if($_GET['action'] == 'Delete')
	{
		ProductBOM_Delete_ById();
		$message = "<br /><div class='message success'><b>Message</b> : One product deleted successfully</div>";
	}
	
	if(isset($_POST['Submit']) || isset($_POST['Update']))
	{
		if(isset($_POST['Submit']))
		{
			//$Product = explode("/",$_POST['productid']);
			if(mysql_num_rows(mysql_query("SELECT * FROM productbom WHERE productcode='".$_POST['productcode']."' AND rawmaterialid='".$_POST['rawmaterialid']."'")))
				$message = "<br /><div class='message error'><b>Message</b> : Product and Rawmaterial already exist </div>";
			else
			{
				if(!isset($_FILES['files']))
					ProductBOM_Insert();
				else if(isset($_FILES['files']))
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
					$product_subcategory = explode("/",$_POST['product_subcategory_id']);
					mysql_query("INSERT INTO productbom values('','".$_POST['productcode']."','".$_POST['rawmaterialid']."','".$_POST['quantity']."','".$_POST['reference']."','".$_POST['tolerance']."','".$_POST['package']."','".$_POST['make']."','".$fileType."','".$fileName."','".$fileSize."','".$content."')");
					mysql_query("INSERT INTO productbom_versioning values('','".$_POST['productcode']."','".$_POST['quantity']."','".$_POST['reference']."','".$_POST['tolerance']."','".$_POST['package']."','".$_POST['make']."','','1','".$fileType."','".$fileName."','".$fileSize."','".$content."')");
				}
				$message = "<br /><div class='message success'><b>Message</b> : Product added successfully</div>";
			}
		}
		else if(isset($_POST['Update']))
		{
			ProductBOM_Update();
			$message = "<br /><div class='message success'><b>Message</b> : Product details updated successfully</div>";
		}
		foreach($Columns as $Col)
			$_POST[$Col] = "";
	} ?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" name="" action="" id="form" class="form panel" onsubmit="return validation()" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
			<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
			<header><h2>Add Product-BOM</h2></header>
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
								if($_GET['id'] && $_POST['productcode'] == $productcodes['id'])
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
						$bom_category = SelectBomCategory();
						while($bomcategory = mysql_fetch_array($bom_category))
						{
							if($_POST['bom_category'] == $bomcategory['id'])
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
						// $SelectRawMeterialcode = SelectRawMeterialcode();
						// while($FetchRawMeterialcode = mysql_fetch_array($SelectRawMeterialcode))
						// {
							// if($_POST['rawmaterialid'] == $FetchRawMeterialcode['id'])
								// echo '<option value="'.$FetchRawMeterialcode['id'].'" selected>'.$FetchRawMeterialcode['materialcode'].'</option>';
							// else
								// echo '<option value="'.$FetchRawMeterialcode['id'].'">'.$FetchRawMeterialcode['materialcode'].'</option>';
						// } ?>
					</select>
				</label>
				<label>Quantity <font color="red">*</font><br/>
					<input type="text" id="quantity" name="quantity" maxlength="11" required="required" value="<?php echo $_POST['quantity']; ?>" onkeypress="return isNumeric(event)"/>
				</label>
				<label>Reference <font color="red">*</font><br/>
					<input type="text" id="reference" name="reference" maxlength="50" required="required" value="<?php echo $_POST['reference']; ?>" onkeypress="return AlphaNumCheck(event)"/>
				</label>
				</div>
				<div class="clearfix">
					<label>Tolerance <br>
						<input type="text" id="tolerance" name="tolerance" maxlength="11" value="<?php echo $_POST['tolerance']; ?>" onkeypress="return isNumeric('b',event)"/>
					</label>
					<label>Package <br>
						<input type="text" id="package" name="package" maxlength="11" value="<?php echo $_POST['package']; ?>" onkeypress="return isNumeric('h',event)"/>
					</label>
					<label>Make &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="text" id="make" name="make" maxlength="11" value="<?php echo $_POST['make']; ?>" onkeypress="return isNumeric('h',event)"/>
					</label>
					<label>FilesUpload <br/>
						<input type="file"  name="files[]" multiple="multiple" id="files" value="<?php echo $_POST['files']; ?>">
					</label>
				</div>
			</fieldset>
			<hr />
			<?php
			if($_GET['action'] == 'Edit')
				echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
			?>
			<button class="button button-gray" type="reset" name="reset" onclick="Reset()">Reset</button>
		</form>
	</div>
		
	<div class="columns">
		<h3>
			<?php
			$ProductBOMTotalRows = mysql_fetch_assoc(ProductBOM_Select_Count_All());
			echo "Total No. of Product-BOM - ".$ProductBOMTotalRows['total'];
			?>
		</h3>
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
				</tr>
			</thead>
			<tbody>
				<?php
				if(!$ProductBOMTotalRows['total'])
					echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
				$Limit = 10;
				$total_pages = ceil($ProductBOMTotalRows['total'] / $Limit);
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1;
				
				$i = $Start = ($_GET['pageno']-1)*$Limit;
				$i++;
				$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
				$ProductBOMRows = ProductBOM_Select_ByLimit($Start, $Limit);
				while($ProductBOM = mysql_fetch_assoc($ProductBOMRows))
				{
					/* $FetchProductCode = mysql_fetch_array(SelectProductCode($ProductBOM['productid']));
					$FetchRawMeterial = mysql_fetch_array(SelectRawMeterial($ProductBOM['rawmaterialid']));
					$Fetchproductcategory = mysql_fetch_array(SelectProductcategory($ProductBOM['productcategory_id']));
					$Fetchproductsubcategory = mysql_fetch_array(SelectProductsubcategory($ProductBOM['productsubcategory_id'])); */
					echo "<tr style='valign:middle;'>
						<td align='center'>".$i++."</td>
						<td align='center'>".$ProductBOM['productcode']."</td>
						<td align='center'>".$ProductBOM['materialcode']."</td>
						<td align='center'>".$ProductBOM['quantity']."</td>
						<td align='center'>".$ProductBOM['reference']."</td>";
					if($ProductBOM['tolerance']=='')
						echo"<td align='center'>-</td>";
					else
						echo"<td align='center'>".$ProductBOM['tolerance']."</td>";
					if($ProductBOM['package']=='')
						echo"<td align='center'>-</td>";
					else
						echo"<td align='center'>".$ProductBOM['package']."</td>";
					if($ProductBOM['make']=='')
						echo"<td align='center'>-</td>";
					else
						echo"<td align='center'>".$ProductBOM['make']."</td>";
						echo"<td align='center'>".$ProductBOM['partnumber']."</td>
					</tr>";
				} ?>
			</tbody>
		</table>
			<?php
	$GETParameters = "page=".$_GET['page']."&subpage=spage->".$_GET['spage'].",ssubpage->".$_GET['ssubpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
	</div>
	<div class="clear">&nbsp;</div>
	
</section>
<script>
	function Reset()
	{
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=spage-><?php echo $_GET['spage']; ?>,ssubpage-><?php echo $_GET['ssubpage']; ?>");
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
				document.getElementById('rawmaterialid').innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/bom_basedrawmaterial.php?bom_category="+document.getElementById('bom_category').value,true);
		xmlhttp.send();
	}
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8 || charCode == 32) 
			return true;
		 if (charCode == 44) 
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
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8||charCode == 35 ||charCode == 36 ||charCode == 46)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==8 ||charCode == 35 ||charCode == 36 ||charCode == 46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function validation()
	{
		var message = "";
		if(document.getElementById("productcode").value == "")
			message = "Please select product Code";
		if(document.getElementById("rawmaterialid").value == "")
			message = "Please select rawmaterial";
		if(document.getElementById("quanity").value == "")
			message = "Please select product_subcategory";
		if(document.getElementById("reference").value == "")
			message = "Please select product category";
		if(document.getElementById("tolerance").value == "")
			message = "Please select product category";
		if(document.getElementById("package").value == "")
			message = "Please select product category";
		if(document.getElementById("make").value == "")
			message = "Please select product category";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
	function deleterow(id)
	{
		var Are = confirm("Are you sure, Do you really want to delete this record?");
		if(Are == true)
			document.location.assign("index.php?page=Stores&subpage=spage->Product_Management,ssubpage-><?php echo $_GET['ssubpage']?>&id="+id+"&action=Delete");
	}
	<?php
	if($_POST['productid'])
	{
		$FetchProductCode = mysql_fetch_array(SelectProductCode($_POST['productid']));
	?>
	GetProductCode(<?php echo substr($FetchProductCode['code'],0,2).",".$_POST['productid']; ?>);
	<?php
	} ?>
	function GetProductCode(Prefix,productid)
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
				document.getElementById('product').innerHTML = xmlhttp.responseText;
		}
		xmlhttp.open("GET","includes/GetProductCode.php?Prefix="+Prefix+"&productid="+productid,true);
		xmlhttp.send();
	}
</script>