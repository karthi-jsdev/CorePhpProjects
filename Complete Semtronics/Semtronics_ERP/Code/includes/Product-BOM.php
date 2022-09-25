<section role="main" id="main">
	<?php
	//include('includes/Product_Management Queries.php');
		$Columns = array("id", "productid","rawmaterialid", "quantity", "reference");
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
				ProductBOM_Insert();
				$message = "<br /><div class='message success'><b>Message</b> : Product added successfully</div>";
			}
			else if(isset($_POST['Update']))
			{
				ProductBOM_Update();
				$message = "<br /><div class='message success'><b>Message</b> : Product details updated successfully</div>";
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns" style='width:902px;'>
		<?php 
			echo $message; 
		?>
		<form method="post" name="" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
			<header><h2>Add Product-BOM</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>Product Category <font color="red">*</font>
					<select id="productcat" name="productcat" onchange="GetProductCode(this.value,'')">
						<option value="">Select</option>
						<?php
							$SelectProductcategorycode = SelectProductcategorycode();
							while($FetchProductcategorycode = mysql_fetch_array($SelectProductcategorycode))
							{
								$FetchProductCode = mysql_fetch_array(SelectProductCode($_POST['productid']));
								if(substr($FetchProductCode['code'],0,2) == substr($FetchProductcategorycode['prefix'],0,2))
									echo '<option value="'.$FetchProductcategorycode['prefix'].'" selected>'.$FetchProductcategorycode['name']."-".$FetchProductcategorycode['prefix'].'</option>';
								else
									echo '<option value="'.$FetchProductcategorycode['prefix'].'">'.$FetchProductcategorycode['name']."-".$FetchProductcategorycode['prefix'].'</option>';
							}
						?>
					</select>
					</label>
					<div id="product"></div>
				</div>
				<div class="clearfix">
					<label>Raw Material <font color="red">*</font>
					<select id="rawmaterialid" name="rawmaterialid">
						<option value="">Select</option>
						<?php
							$SelectRawMeterialcode = SelectRawMeterialcode();
							while($FetchRawMeterialcode = mysql_fetch_array($SelectRawMeterialcode))
							{
								if($_POST['rawmaterialid'] == $FetchRawMeterialcode['id'])
									echo '<option value="'.$FetchRawMeterialcode['id'].'" selected>'.$FetchRawMeterialcode['materialcode'].'</option>';
								else
									echo '<option value="'.$FetchRawMeterialcode['id'].'">'.$FetchRawMeterialcode['materialcode'].'</option>';
							}
						?>
					</select>
					</label>
					<label>Quantity <font color="red">*</font><br/>
					<input type="text" id="quantity" name="quantity" maxlength="11" required="required" value="<?php echo $_POST['quantity']; ?>" onkeypress="return isNumeric(event)"/>
					</label>
					<label>Reference <font color="red">*</font><br/>
					<input type="text" id="reference" name="reference" maxlength="50" required="required" value="<?php echo $_POST['reference']; ?>" onkeypress="return AlphaNumCheck(event)"/>
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
			<button class="button button-gray" type="reset">Reset</button>
		</form>
		</div>
		
		<div class="columns">
			<h3>Product-BOM List
				<?php
				$ProductBOMTotalRows = mysql_fetch_assoc(ProductBOM_Select_Count_All());
				echo " : No. of total Product - ".$ProductBOMTotalRows['total'];
				?>
			</h3>
			<!--div class="clearfix">
				<label>Product Category <font color="red">*</font>
				<select id="productcat" name="productcat" onchange="GetProductCodeForSearch(this.value,'')">
					<option value="">Select</option>
					<?php
						$SelectProductcategorycode = SelectProductcategorycode();
						while($FetchProductcategorycode = mysql_fetch_array($SelectProductcategorycode))
						{
							$FetchProductCode = mysql_fetch_array(SelectProductCode($_POST['productid']));
							if(substr($FetchProductCode['code'],0,2) == substr($FetchProductcategorycode['prefix'],0,2))
								echo '<option value="'.$FetchProductcategorycode['prefix'].'" selected>'.$FetchProductcategorycode['name']."-".$FetchProductcategorycode['prefix'].'</option>';
							else
								echo '<option value="'.$FetchProductcategorycode['prefix'].'">'.$FetchProductcategorycode['name']."-".$FetchProductcategorycode['prefix'].'</option>';
						}
					?>
				</select>
				</label>
				<div id="product"></div>
			</div-->
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Product Code</th>
						<th align="left">Rawmeterial Code</th>
						<th align="left">Quantity</th>
						<th align="left">Reference</th>
						<th align="left">Part Number</th>
						<th align="left">Action</th>
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
						$FetchProductCode = mysql_fetch_array(SelectProductCode($ProductBOM['productid']));
						$FetchRawMeterial = mysql_fetch_array(SelectRawMeterial($ProductBOM['rawmaterialid']));
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td align='center'>".$FetchProductCode['code']."</td>
							<td align='center'>".$FetchRawMeterial['materialcode']."</td>
							<td align='center'>".$ProductBOM['quantity']."</td>
							<td align='center'>".$ProductBOM['reference']."</td>
							<td align='center'>".$FetchRawMeterial['partnumber']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$ProductBOM['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a>  &nbsp; <a href='#' onclick='deleterow(".$ProductBOM['id'].")'>Delete</a></td>
						</tr>";
					} ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="clear">&nbsp;</div>
	<?php
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
</section>
<script>
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8) 
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
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode == 8)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode==8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function validation()
	{
		var message = "";
		if(document.getElementById("rawmaterialid").value == "")
			message = "Please select Raw Meterial Code";
		if(document.getElementById("productcat").value)
		{
			if(document.getElementById("productid").value == "")
				message = "Please select product code";
		}
		if(document.getElementById("productcat").value == "")
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
			document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&id="+id+"&action=Delete");
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