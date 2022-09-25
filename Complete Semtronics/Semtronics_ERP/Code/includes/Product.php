<section role="main" id="main">
	<?php
	//include('includes/Product_Management Queries.php');
		$Columns = array("id","productcode", "description", "watt", "wattmax", "inputvoltage", "inputvoltagemax", "outputvoltage", "outputvoltagemax", "outputcurrent", "efficiency", "l", "b", "h","packquantity","remarks");
		if($_GET['action'] == 'Edit')
		{
			$Product = mysql_fetch_assoc(Product_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Product[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Product_Delete_ById();
			$message = "<br /><div class='message success'><b>Message</b> : One product deleted successfully</div>";
		}
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			if(isset($_POST['Submit']))
			{
				$ExplodeProductCode = explode("/",$_POST['product_subcategoryid']);
				$FetchCode = mysql_fetch_assoc(Select_ProductCode(substr($ExplodeProductCode[1],0,3)));
				$Digits = array("", "0", "00", "000");
				if(mysql_num_rows(Select_ProductCode(substr($ExplodeProductCode[1],0,3))))
					$Code = substr($ExplodeProductCode[1],0,3).$Digits[3 - strlen((substr($FetchCode['code'], -3))+1)].((substr($FetchCode['code'], -3))+1);
				else
					$Code = substr($ExplodeProductCode[1],0,3).$Digits[3 - strlen((substr($FetchCode['code'], -3)))].((substr($FetchCode['code'], -3)));
				Product_Insert($Code);
				$message = "<br /><div class='message success'><b>Message</b> : Product added successfully</div>";
			}
			else if(isset($_POST['Update']))
			{
				Product_Update();
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
		<form method="post" name="" action="index.php?page=Stores&subpage=spage-><?php echo $_GET['spage']; ?>,ssubpage-><?php echo $_GET['ssubpage']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id'];?>" required="required"/>
			<header><h2>Add Product</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<?php
						$productcode = mysql_query("SELECT * FROM products");
					?>
					<label>Product Code <font color="red">*</font>
					<select id="productcode" name="productcode" onchange="product_subcategory()">
						<option value="">Select</option>
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
					<label>Pack Quantity <font color="red">*</font>
					<input type="text" id="packquantity" name="packquantity" maxlength="11" required="required" value="<?php echo $_POST['packquantity']; ?>" onkeypress="return isNumeric('packquantity',event)"/>
					</label>
					<label>Watt Min<br/>
						<input type="text" id="watt"  maxlength="11" name="watt" value="<?php echo $_POST['watt']; ?>" onkeypress="return isNumeric('watt',event)"/>
					</label>
					<label>Watt Max<font color="red">*</font><br/>
						<input type="text" id="wattmax"  maxlength="11" name="wattmax" required="required" value="<?php echo $_POST['wattmax']; ?>" onkeypress="return isNumeric('watt',event)"/>
					</label>
				</div>
				<div class="clearfix">
					<label>I/P Volt Min<font color="red">*</font><br/>
						<input type="text" id="inputvoltage" name="inputvoltage" maxlength="11" required="required" value="<?php echo $_POST['inputvoltage']; ?>" onkeypress="return isNumeric('inputvoltage',event)"/>
					</label>
					<label>I/P Volt Max<font color="red">*</font><br/>
						<input type="text" id="inputvoltagemax" name="inputvoltagemax" maxlength="11" required="required" value="<?php echo $_POST['inputvoltagemax']; ?>" onkeypress="return isNumeric('inputvoltage',event)"/>
					</label>
					<label>O/P Volt Min<br/>
						<input type="text" id="outputvoltage" name="outputvoltage" maxlength="11" value="<?php echo $_POST['outputvoltage']; ?>" onkeypress="return isNumeric('outputvoltage',event)"/>
					</label>
					<label>O/P Volt Max<font color="red">*</font><br/>
						<input type="text" id="outputvoltagemax" name="outputvoltagemax" maxlength="11" required="required" value="<?php echo $_POST['outputvoltagemax']; ?>" onkeypress="return isNumeric('outputvoltage',event)"/>
					</label>
				</div>
				<div class="clearfix">
					<label>O/P Current <font color="red">*</font>
					<input type="text" id="outputcurrent" name="outputcurrent" maxlength="11" required="required" value="<?php echo $_POST['outputcurrent']; ?>" onkeypress="return AlphaNumCheck(event)"/>
					</label>
					<label>Efficiency <font color="red">*</font>
					<input type="text" id="efficiency" name="efficiency" maxlength="11" required="required" value="<?php echo $_POST['efficiency']; ?>" onkeypress="return isNumeric('efficiency',event)"/>
					</label>
					<label>L(mm)<br>
					<input type="text" id="l" name="l" maxlength="11" value="<?php echo $_POST['l']; ?>" onkeypress="return isNumeric('l',event)"/>
					</label>
					<label>B(mm)<br>
					<input type="text" id="b" name="b" maxlength="11" value="<?php echo $_POST['b']; ?>" onkeypress="return isNumeric('b',event)"/>
					</label>
				</div>
				<div class="clearfix">
					<label>H(mm)<br>
					<input type="text" id="h" name="h" maxlength="11" value="<?php echo $_POST['h']; ?>" onkeypress="return isNumeric('h',event)"/>
					</label>
					<label>Description <font color="red">*</font>
						<textarea name="description" id="description" maxlength="100" required="required"><?php echo $_POST['description'];?></textarea>
					</label>
					<label>Remarks <font color="red">*</font>
					<textarea name="remarks" id="remarks" maxlength="1000" required="required"><?php echo $_POST['remarks'];?></textarea>
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
				$ProductTotalRows = mysql_fetch_assoc(Product_Select_Count_All());
				echo "Total No. of Products - ".$ProductTotalRows['total'];
				?>
			</h3>
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Code</th>
						<th align="left">Description</th>
						<th align="left">Watt Min</th>
						<th align="left">Watt Max</th>
						<th align="left">I/P Voltage Min</th>
						<th align="left">I/P Voltage Max</th>
						<th align="left">O/P Voltage Min</th>
						<th align="left">O/P Voltage Max</th>
						<th align="left">O/P Current</th>
						<th align="left">Efficiency</th>
						<th align="left">L</th>
						<th align="left">B</th>
						<th align="left">H</th>
						<th align="left">Pack Quantity</th>
						<th align="left">Remarks</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$ProductTotalRows['total'])
						echo '<tr><td colspan="16"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($ProductTotalRows['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$ProductRows = Product_Select_ByLimit($Start, $Limit);
					while($Product = mysql_fetch_assoc($ProductRows))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td align='center'>".$Product['productcode']."</td>
							<td align='left'>".$Product['description']."</td>
							<td align='center'>".$Product['watt']."</td>
							<td align='center'>".$Product['wattmax']."</td>
							<td align='center'>".$Product['inputvoltage']."</td>
							<td align='center'>".$Product['inputvoltagemax']."</td>
							<td align='center'>".$Product['outputvoltage']."</td>
							<td align='center'>".$Product['outputvoltagemax']."</td>
							<td align='center'>".$Product['outputcurrent']."</td>
							<td align='center'>".$Product['efficiency']."</td>
							<td align='center'>".$Product['l']."</td>
							<td align='center'>".$Product['b']."</td>
							<td align='center'>".$Product['h']."</td>
							<td align='center'>".$Product['packquantity']."</td>
							<td align='center'>".$Product['remarks']."</td>
							<td align='center'><a href='index.php?page=".$_GET['page']."&subpage=spage->".$_GET['spage'].",ssubpage->".$_GET['ssubpage']."&id=".$Product['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a>  &nbsp; <a href='#' onclick='deleterow(".$Product['id'].")'>Delete</a></td>
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
			{
				document.getElementById('product_subcategoryid').innerHTML = xmlhttp.responseText;
			}
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
		xmlhttp.open("GET","includes/Product_AndSubcategory.php?product_subcategoryid="+document.getElementById('product_subcategoryid').value,true);
		xmlhttp.send();
	}
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8 || charCode==45) 
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
		if(charCode == 8)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function isNumeric(id,evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(id=="inputvoltage" || id=="outputvoltage")
		{
			if(charCode==45)
				return true;		
		}
		if(id=="efficiency")
		{
			if((charCode==60 || charCode==62 || charCode==61) || charCode==37)
				return true;
		}
		if(charCode==8)
			return true;
		if(document.getElementById(id).value.indexOf('.') >= 0 && charCode == 46)
			return false;
		if(charCode == 46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function validation()
	{
		var message = "";
		if(document.getElementById("remarks").value.length < 5)
			message = "remarks should be 5 characters";
		if(document.getElementById("packquantity").value==0)
			message = "Packquantity should not be Zero";	
		/* if(document.getElementById("h").value==0)
			message = "H should not be Zero";	
		if(document.getElementById("b").value==0)
			message = "B should not be Zero";	
		if(document.getElementById("l").value==0)
			message = "L should not be Zero";	 */	
		if(document.getElementById("efficiency").value==0)
			message = "Efficiency should not be Zero";	
		if(document.getElementById("outputcurrent").value==0)
			message = "Outputcurrent should not be Zero";
		if(document.getElementById("outputvoltagemax").value==0)
			message = "Outputvoltage should not be Zero";	
		/* if(document.getElementById("outputvoltage").value==0)
			message = "Outputvoltage should not be Zero";	 */
		if(document.getElementById("inputvoltagemax").value==0)
			message = "Inputvoltage should not be Zero";
		if(document.getElementById("inputvoltage").value==0)
			message = "Inputvoltage should not be Zero";
		if(document.getElementById("wattmax").value==0)
			message = "Watt should not be Zero";				
		/* if(document.getElementById("watt").value==0)
			message = "Watt should not be Zero";	 */
		if(document.getElementById("description").value.length < 5)
			message = "Description should be 5 characters";
		if(document.getElementById("productcode").value == "")
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
			document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo 'spage->'.$_GET['spage'].',ssubpage->'.$_GET['ssubpage']; ?>&id="+id+"&action=Delete");
	}
</script>