<?php
ini_set("display_errors","0");
if($_GET['action']=='Edit')
		{
			 $Products = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"select * from productbom where id='".$_GET['id']."'"));
		}
		if($_POST['Update'])
		{
			 mysqli_query($_SESSION['connection'],"UPDATE productbom SET rawmaterialid='".$_POST['rawmaterialid']."',quantity='".$_POST['quantity']."',reference='".$_POST['reference']."'  WHERE  id='".$_POST['id']."'");
			 $_POST['productid'] = $_POST['productsid'];
		}
?>
<section role="main" id="main">
	<div class="columns" style='width:902px;'>
			<form method="post" name="" class="form panel" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form">
	<?php
		if(!$_GET['id'])
		{ ?>
				<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
				<header><h2>Product-BOM Status</h2></header>
				<hr />			
				<fieldset>
					<div class="clearfix">
						<label>Product Category <font color="red">*</font>
						<select id="productcat" name="productcat" onchange="GetProductCode(this.value,'')">
							<option value="">Select</option>
							<?php
								$SelectProductcategorycode = SelectProductcategorycode();
								while($FetchProductcategorycode = mysqli_fetch_array($SelectProductcategorycode))
								{
									$FetchProductCode = mysqli_fetch_array(SelectProductCode($_POST['productid']));
									if(substr($FetchProductCode['code'],0,3) == substr($FetchProductcategorycode['prefix'],0,3))
										echo '<option value="'.$FetchProductcategorycode['prefix'].'" selected>'.$FetchProductcategorycode['name']."-".$FetchProductcategorycode['prefix'].'</option>';
									else
										echo '<option value="'.$FetchProductcategorycode['prefix'].'">'.$FetchProductcategorycode['name']."-".$FetchProductcategorycode['prefix'].'</option>';
								}
							?>
						</select>
						</label>
						<div id="product"></div>
					</div>
				</fieldset>
				<hr />
				<?php
					echo '<button class="button button-green" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
				 } 
	else
	{
	?>
		<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
		<input type="hidden" name="productsid" value="<?php if($_GET['productid']) echo $_GET['productid']; ?>" required="required"/>
		<fieldset>
			<div class="clearfix">
					<label>Raw Materiel <font color="red">*</font>
					<select id="rawmaterialid" name="rawmaterialid">
						<option value="">Select</option>
						<?php
							$SelectRawMeterialcode = SelectRawMeterialcode();
							while($FetchRawMeterialcode = mysqli_fetch_array($SelectRawMeterialcode))
							{
								if($Products['rawmaterialid'] == $FetchRawMeterialcode['id'])
									echo '<option value="'.$FetchRawMeterialcode['id'].'" selected>'.$FetchRawMeterialcode['materialcode'].'</option>';
								else
									echo '<option value="'.$FetchRawMeterialcode['id'].'">'.$FetchRawMeterialcode['materialcode'].'</option>';
							}
						?>
					</select>
					</label>
					<label>Quantity <font color="red">*</font><br/>
					<input type="text" id="quantity" name="quantity" maxlength="11" required="required" value="<?php echo $Products['quantity']; ?>" onkeypress="return isNumeric(event)"/>
					</label>
					<label>Reference <font color="red">*</font><br/>
					<input type="text" id="reference" name="reference" maxlength="50" required="required" value="<?php echo $Products['reference']; ?>" onkeypress="return AlphaNumCheck(event)"/>
					</label>
			</div>
		</fieldset>
		<?php
			if($_GET['action'] == 'Edit')
				echo '<button class="button button-green" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
			?>
			<button class="button button-gray" type="reset">Reset</button>
	<?php } ?>	
	</form>
	</div>
		
		<div class="columns">
		<?php
			if($_POST['productid'])
			{
		?>
			<h3>Product-BOM Status
				<?php
				$ProductBOMStatusTotalRows = mysqli_num_rows(ProductBOMStatus_Select_Count_All($_POST['productid']));
				echo " : No. of total ProductBOM - ".$ProductBOMStatusTotalRows;
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
						<th align="left">Part Number</th>
						<th align="left">Unit Cost</th>
						<th align="left">Total</th>
						<th align="left">Stock</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!$ProductBOMStatusTotalRows)
						echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
					$Limit = 10;
					$total_pages = ceil($ProductBOMStatusTotalRows / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
					$ProductBOMStatusRows = ProductBOMStatus($Start, $Limit,$_POST['productid']);
					while($ProductBOMStatus = mysqli_fetch_array($ProductBOMStatusRows))
					{
						echo "<tr style='valign:middle;'>
							<td align='center'>".$i++."</td>
							<td align='center'>".$ProductBOMStatus['productcode']."</td>
							<td align='center'>".$ProductBOMStatus['materialcode']."</td>
							<td align='center'>".$ProductBOMStatus['quantity']."</td>
							<td align='center'>".$ProductBOMStatus['reference']."</td>
							<td align='center'>".$ProductBOMStatus['partnumber']."</td>
							<td align='center'>".$ProductBOMStatus['unitprice']."</td>
							<td align='center'>".($ProductBOMStatus['unitprice']*$ProductBOMStatus['quantity'])."</td>
							<td align='center'>".$ProductBOMStatus['stockquantity']."</td>
							<td ><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&productid=".$ProductBOMStatus['productid']."&id=".$ProductBOMStatus['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a>  &nbsp; <a href='#' onclick='deleterow(".$ProductBOMStatus['id'].")'>Delete</a></td>
						</tr>";	
					} ?>
				</tbody>
			</table>
			<label>Comments <font color="red">*</font><br/>
				<textarea id="comments" name="comments" required="required"></textarea>
			</label>
			<button class="button button-blue" type="submit" name="finish" value="finish">Finish</button>
		</div>
	<div class="clear">&nbsp;</div>
	<?php
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
	<?php
	}?>
</section>
<script>
	<?php
	if($_POST['productid'])
	{
		$FetchProductCode = mysqli_fetch_array(SelectProductCode($_POST['productid']));
	?>
	GetProductCode(<?php echo $FetchProductCode['code'].",".$_POST['productid']; ?>);
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
			{
				document.getElementById('product').innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/GetProductCode.php?Prefix="+Prefix+"&productid="+productid,true);
		xmlhttp.send();
	}
</script>