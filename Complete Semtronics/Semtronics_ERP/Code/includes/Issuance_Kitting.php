<?php
if($_GET['id'])
{
	$kittingvalues = mysql_fetch_assoc(mysql_query("SELECT 	issuance.id as iid,issuance.number as ino,issuance.issueddate as date,
															issuanceuser.id as isuid,issuanceuser.issuanceuser as isuisu,
															materialcode,rawmaterial.id as rawid,
															stockissuance.id as sid,stockissuance.batchid as sib,stockissuance.quantity as siqty,stockissuance.amount as siamt,
															stock.batchid as sb,stock.quantity as sqty,stock.amount as samt,
															productbom.quantity as qty,productbom.productcode,sum(stockinventory.quantity) as quantity,sum(stockissuance.quantity) as squantity,
															products.id as productid,products.productcode,batch.number as bno
															FROM rawmaterial 
															join batch on batch.rawmaterialid=rawmaterial.id 
															join stock on stock.batchid=batch.id
															join stockinventory on stockinventory.batchid=batch.id
															join stockissuance on stockissuance.batchid=batch.id
															join issuance on stockissuance.issuanceid=issuance.id
															join issuanceuser on stockissuance.issuedto=issuanceuser.id
															join productbom on productbom.rawmaterialid=rawmaterial.id
															join products on products.id=productbom.productcode 
															where stockissuance.id='".$_GET['id']."' && rawmaterial.id='".$_GET['rid']."' && products.id='".$_GET['productid']."'"));
?>
<section role="main" id="main">
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#issuancedate").datepicker({dateFormat: 'yy-mm-dd'});
			$("#issuancedate").datepicker().datepicker("setDate", new Date());
		});
	</script>
<div class="columns" style='width:902px;'>
	<?php echo $message; ?>
	<form class="form panel" method="POST" action="" onsubmit="return validation()">
		<header><h2>Kitting Issuance</h2></header>
		<hr />				
		<fieldset>
			<div class="clearfix">
				<label>&nbsp;&nbsp;Issuance Code <font color="red">*</font></label>
				<input type="text" id="number" value="<?php echo $kittingvalues['ino']; ?>" disabled />
				<label>&nbsp;Select Date<font color="red">*</font></label>
				<input type="text" autocomplete="off" id="issuancedate" name="issuancedate" required="required" value="<?php echo $kittingvalues['date']; ?>"/>
			</div>
			<div class="clearfix">
				<label>&nbsp;&nbsp;Issued To <font color="red">*</font></label>
				<select required="required" id="client" onchange='var OptionSplit = this.value.split("$"); document.getElementById("issuedto").value = OptionSplit[0]; document.getElementById("issuedtoname").value = OptionSplit[1];'>
					<option value="">Select</option>
					<?php
					$Users = Select_All_Users();
					while($User = mysql_fetch_assoc($Users))
					{
						if($User['id'] == $_POST['issuedto'] || $kittingvalues['isuid']==$User['id'])
							echo "<option value='".$User['id']."$".$User['issuanceuser']."' selected>".$User['issuanceuser']."</option>";
						else
							echo "<option value='".$User['id']."$".$User['issuanceuser']."'>".$User['issuanceuser']."</option>";
					}
					?>
				</select>
				<input type="hidden" id="issuedto" name="issuedto" value="" />
				<input type="hidden" id="issuedtoname" value="" />
			</div>
			<div class="clearfix">
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
								else
									echo'<option value="'.$wattage['indexvalue'].'">'.$wattage['wattagerange'].'</option>';
							}
						?>
					</select>
				</label>
			</div>
			<div class="clearfix">
				<label>Current ranges
					<select id="currentrange" name="currentrange" onchange="dsiwcranges()">
						<option value="select">Select</option>
						<?php
							$currentrange = mysql_query("SELECT * FROM currentrange");
							while($current = mysql_fetch_assoc($currentrange))
							{
								if($_GET['id'] && ($_POST['currentrange'] == $current['indexvalue']))
									echo'<option value="'.$current['indexvalue'].'" selected>'.$current['currentrange'].'</option>';
								else
									echo'<option value="'.$current['indexvalue'].'">'.$current['currentrange'].'</option>';
							}
						?>
					</select>
				</label>
			<label>Product Code<font color="red">*</font>
				<?php $product = mysql_query("SELECT * FROM products"); ?>
				<select name="productid" id="productid">
					<option value="">Select</option>
					<?php
						while($product_value = mysql_fetch_assoc($product))
						{
							if($_GET['productid']==$product_value['id'])
								echo '<option value="'.$product_value['id'].'" selected>'.$product_value['productcode'].'</option>';
							else
								echo '<option value="'.$product_value['id'].'" >'.$product_value['productcode'].'</option>';
						} 
					 ?> 	
				</select>
			</label>
				<label>Kitting Quantity <font color="red">*</font>
					<input type="text" id="kittingquantity" name="kittingquantity" required="required" value="<?php echo $_GET['kittingqty']; ?>" onkeypress="return isNumeric(event)"/>
				</label>
			</div>
		</div>
	</form>
<br/>
	<table class="paginate sortable full">
		<tr>
			<th>Rawmaterial</th>
			<th></th>
			<th>Kitting Quantity</th>
			<th>Batch-<?php echo $kittingvalues['bno'];?></th>
			<th>Available Quantity</th>
			<th>Issuance Quantity</th>
		</tr>
	<?php
		$rawmateriallist= mysql_query("SELECT distinct(materialcode),rawmaterial.id,productbom.quantity as qty,productbom.productcode,sum(stockinventory.quantity) as quantity
										FROM rawmaterial 
										join batch on batch.rawmaterialid=rawmaterial.id 
										join stockinventory on stockinventory.batchid=batch.id
										join productbom on productbom.rawmaterialid=rawmaterial.id
										join products on products.id=productbom.productcode 
										where productbom.productcode='".$_GET['productid']."' && rawmaterial.id='".$_GET['rid']."'&& stockinventory.inspection='1' group by rawmaterial.id ");
		$batchid =array();
		$batchnumber =array();
		while($rmwithqty = mysql_fetch_Assoc($rawmateriallist))
		{
			$batchvalues = mysql_query("SELECT distinct(batch.id),batch.number
							FROM rawmaterial 
							join batch on batch.rawmaterialid=rawmaterial.id 
							join stockinventory on stockinventory.batchid=batch.id
							join productbom on productbom.rawmaterialid=rawmaterial.id
							join products on products.id=productbom.productcode 
							where productbom.productcode='".$_GET['productid']."' && stockinventory.inspection='1' && rawmaterial.id='".$_GET['rid']."'");
			while($batchvalue = mysql_fetch_Assoc($batchvalues))
			{
				$batchid[] = $batchvalue['id'];
				$batchnumber[] = $batchvalue['number'];
			}
			echo "<form action='' method='POST'>
					<tr>
						<td><br/><input type='text' value=".$rmwithqty['materialcode']." name='materialcode' disabled></td>
						<td><br/><input type='hidden' value=".$rmwithqty['id']." name='rawmaterialid' id='rawmaterialid".$rmwithqty['id']."'></td>
						<td><br/><input type='text' value=".$_GET['kittingqty']." name='kittingquantity' disabled></td>
						<td><br/><select name='batchvalue' id='batchvalue".$rmwithqty['id']."' onchange='availqty(".$rmwithqty['id'].")'>
							<option value=''>select</option>";
						foreach($batchid as $number => $ids)
							echo"<option value=".$ids.">".$batchnumber[$number]."</option>";
						echo"</select></td>
						<td><br/><div><p id='avail_qty".$rmwithqty['id']."'></p></div></td>
						<td><br/><input type='text' onpaste='return false;' value='".$kittingvalues['siqty']."' required='required' autocomplete='off' name='quantity' id='quantity".$kittingvalues['rawid']."' onkeypress='return Amount(event,".$rmwithqty['id'].");'></td>
				
				
				<br/>";
			unset($batchid);
			unset($batchnumber);
			$issue = $_POST['issuedto'] = $kittingvalues['isuid'];
			$productid = $_GET['productid'];
			$_POST['productid'] = $_GET['productid'];
			$_POST['id'] = $_GET['id'];
			echo '<td><br/><a class="button button-orange" id="add1" onclick="KIInsert('.$rmwithqty['id'].','.$productid.');">Update</a></td></tr>';	
		}
	?>
	<tr><td><a class="button button-green" onclick="window.location.assign('?page=Stores&subpage=spage->Issuance,ssubpage->Status&number='+document.getElementById('number').value)">Finish</a></td></tr>
	<tr>
		<td><br/><input type='hidden' value="<?php echo $_POST['issuedto'];?>" name='issued' id='issued'></td>
		<td><br/><input type='hidden' value="<?php echo $_POST['productid'];?>" name='productid' id='productid'></td>
		<td><br/><input type='hidden' value="<?php echo $_POST['id'];?>" name='getid' id='getid'></td>
	</tr></form>
	</table>
	<div><span id="productlist"></span></div>
	</div>
</section>
<?php
}else
{
?><section role="main" id="main">
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#issuancedate").datepicker({dateFormat: 'yy-mm-dd'});
			$("#issuancedate").datepicker().datepicker("setDate", new Date());
		});
	</script>
<div class="columns" style='width:902px;'>
	<?php echo $message; ?>
	<form class="form panel" method="POST" action="" onsubmit="return validation()">
		<header><h2>Kitting Issuance</h2></header>
		<hr />				
		<fieldset>
			<div class="clearfix">
				<label>&nbsp;&nbsp;Issuance Code <font color="red">*</font></label>
				<?php
					if($Exixsts = mysql_fetch_array(Select_Issuance_ByNumber()))
						$Exixsts['number']++;
					else
						$Exixsts['number'] = date("Ym")."0000001";
				?>
				<input type="text" id="number" value="<?php echo $Exixsts['number']; ?>" disabled />
				<label>&nbsp;Select Date<font color="red">*</font></label>
				<input type="text" autocomplete="off" id="issuancedate" name="issuancedate" required="required" value="<?php echo $_POST['issuancedate']; ?>"/>
			</div>
			<div class="clearfix">
				<label>&nbsp;&nbsp;Issued To <font color="red">*</font></label>
				<select required="required" id="client" onchange='var OptionSplit = this.value.split("$"); document.getElementById("issuedto").value = OptionSplit[0]; document.getElementById("issuedtoname").value = OptionSplit[1];'>
					<option value="">Select</option>
					<?php
					$Users = Select_All_Users();
					while($User = mysql_fetch_assoc($Users))
					{
						if($User['id'] == $_POST['issuedto'])
							echo "<option value='".$User['id']."$".$User['issuanceuser']."' selected>".$User['issuanceuser']."</option>";
						else
							echo "<option value='".$User['id']."$".$User['issuanceuser']."'>".$User['issuanceuser']."</option>";
					}
					?>
				</select>
				<input type="hidden" id="issuedto" name="issuedto" value="" />
				<input type="hidden" id="issuedtoname" value="" />
			</div>
			<div class="clearfix">
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
								else
									echo'<option value="'.$wattage['indexvalue'].'">'.$wattage['wattagerange'].'</option>';
							}
						?>
					</select>
				</label>
			</div>
			<div class="clearfix">
				<label>Current ranges
					<select id="currentrange" name="currentrange" onchange="dsiwcranges()">
						<option value="select">Select</option>
						<?php
							$currentrange = mysql_query("SELECT * FROM currentrange");
							while($current = mysql_fetch_assoc($currentrange))
							{
								if($_GET['id'] && ($_POST['currentrange'] == $current['indexvalue']))
									echo'<option value="'.$current['indexvalue'].'" selected>'.$current['currentrange'].'</option>';
								else
									echo'<option value="'.$current['indexvalue'].'">'.$current['currentrange'].'</option>';
							}
						?>
					</select>
				</label>
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
				<label>Kitting Quantity <font color="red">*</font>
					<input type="text" id="kittingquantity" name="kittingquantity" required="required" value="<?php if(!$_POST['Save']) echo $_POST['kittingquantity']; ?>" onkeypress="return isNumeric(event)"/>
				</label>
				<br/><input type="submit" class="button button-green" name="submit" value="submit">
			</div>
		</div>
	</form>
<br/>
	<?php
		if($_POST['submit'])
		{
			echo'<table class="paginate sortable full">
				<tr>
					<th>Rawmaterial</th>
					<th></th>
					<th>Kitting Quantity</th>
					<th>Batch</th>
					<th>Available Quantity</th>
					<th>Issuance Quantity</th>
				</tr>';
			$rawmateriallist= mysql_query("SELECT distinct(materialcode),rawmaterial.id,productbom.quantity as qty,productbom.productcode,sum(stockinventory.quantity) as quantity
											FROM rawmaterial 
											join batch on batch.rawmaterialid=rawmaterial.id 
											join stockinventory on stockinventory.batchid=batch.id
											join productbom on productbom.rawmaterialid=rawmaterial.id
											join products on products.id=productbom.productcode 
											where productbom.productcode='".$_POST['productid']."' && stockinventory.inspection='1' group by rawmaterial.id ");
			$batchid =array();
			$batchnumber =array();
			while($rmwithqty = mysql_fetch_Assoc($rawmateriallist))
			{
				$batchvalues = mysql_query("SELECT distinct(batch.id),batch.number
								FROM rawmaterial 
								join batch on batch.rawmaterialid=rawmaterial.id 
								join stockinventory on stockinventory.batchid=batch.id
								join stock on stock.batchid=batch.id
								join productbom on productbom.rawmaterialid=rawmaterial.id
								join products on products.id=productbom.productcode 
								where productbom.productcode='".$_POST['productid']."' && stock.quantity>0 && stockinventory.inspection='1' && rawmaterial.id='".$rmwithqty['id']."'");
				while($batchvalue = mysql_fetch_Assoc($batchvalues))
				{
					$batchid[] = $batchvalue['id'];
					$batchnumber[] = $batchvalue['number'];
				}
				echo "<form action='' method='POST'>
						<tr>
							<td><br/><input type='text' value=".$rmwithqty['materialcode']." name='materialcode' disabled></td>
							<td><br/><input type='hidden' value=".$rmwithqty['id']." name='rawmaterialid' id='rawmaterialid".$rmwithqty['id']."'></td>
							<td><br/><input type='text' value=".$_POST['kittingquantity']*$rmwithqty['qty']." name='kittingquantity' id='kittingquantity' disabled></td>
							<td><br/><select name='batchvalue' id='batchvalue".$rmwithqty['id']."' onchange='availqty(".$rmwithqty['id'].")'>
								<option value=''>select</option>";
							foreach($batchid as $number => $ids)
								echo"<option value=".$ids.">".$batchnumber[$number]."</option>";
							echo"</select></td>
							<td><br/><div><p id='avail_qty".$rmwithqty['id']."'></p></div></td>
							<td><br/><input type='text' onpaste='return false;' value='' required='required' autocomplete='off' name='quantity' id='quantity".$rmwithqty['id']."' onkeypress='return Amount(event,".$rmwithqty['id'].");'></td>
					
					
					<br/>";
				unset($batchid);
				unset($batchnumber);
				$issue = $_POST['issuedto'];
				$productid = $_POST['productid'];
				echo '<td><br/><a class="button button-orange" id="add" onclick="KIInsert('.$rmwithqty['id'].','.$productid.');" >Add</a></td></tr>';
			}
		}
		if($_POST['submit'])
		{
			if(mysql_num_rows($rawmateriallist)!=0)
			{
			?>
				<tr><td><a class="button button-green" onclick="window.location.assign('?page=Stores&subpage=spage->Issuance,ssubpage->Status&number='+document.getElementById('number').value)">Finish</a></td></tr>
			<?php 
			}
			else
				echo'<tr><td colspan="6" style="color:red;"><center>No Data Found</center></td></tr>';
		}
		?>
	<tr>
		<td><br/><input type='hidden' value="<?php echo $_POST['issuedto'];?>" name='issued' id='issued'></td>
		<td><br/><input type='hidden' value="<?php echo $_POST['productid'];?>" name='productid' id='productid'></td>
	</tr></form>
	</table>
	<div><span id="productlist"></span></div>
	</div>
</section>
<?php } ?>
<script>
	function validation(rawmaterial)
	{
		if(document.getElementById("batchvalue"+rawmaterial).value=="" || document.getElementById("batchvalue"+rawmaterial).value==null)
		{
			alert("Please select any batch for this rawmaterial");
			return false;
		}
		else if(document.getElementById("avail_qty2"+rawmaterial).value==0)
		{
			alert("Sorry!!! Unable to add this batch since it has zero quantity");
			return false;
		}
		else if(document.getElementById("quantity"+rawmaterial).value=="" || document.getElementById("quantity"+rawmaterial).value==null)
		{
			alert("Please specify any Kitting Quantity to issue");
			return false;
		}
		else if(document.getElementById("quantity"+rawmaterial).value==0)
		{
			alert("Quantity must be greater than zero");
			return false;
		}
		else
			KIInsert(rawmaterial,productid);
	}
	function deleteissuance()
	{
		var x=confirm("Are you sure want to delete?");
		if(x==true)
		{
			<?php
				$_POST['id'] = $_GET['id'];
				$StockIssuance = mysql_fetch_array(mysql_query("SELECT * FROM stockissuance WHERE id='".$_POST['id']."'"));
				mysql_query("UPDATE stock SET quantity=quantity+".$StockIssuance['quantity'].", amount=amount+".$StockIssuance['amount'].", taxamount=taxamount+".$StockIssuance['taxamount']." WHERE batchid='".$StockIssuance['batchid']."'");
				mysql_query("DELETE FROM stockissuance WHERE id='".$_POST['id']."'");
			?>
		}
		else
			return false;
	}	
	function Amount(evt,rawmaterial)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(Number(document.getElementById("quantity"+rawmaterial).value+''+String.fromCharCode(charCode)) > Number(document.getElementById("avail_qty2"+rawmaterial).value))
			return false;
		if(charCode == 8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function availqty(rawmaterial)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				if(xmlhttp.responseText)
					document.getElementById("avail_qty"+rawmaterial).innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/availableqty.php?batchvalue="+document.getElementById("batchvalue"+rawmaterial).value+"&rawmaterial="+rawmaterial, true);
		xmlhttp.send();
		//window.location("LOCATION:?page=Stores&subpage=spage->Issuance,ssubpage->Kitting&kittingqty="<?php echo $_GET['kittingqty']; ?>"&productid="<?php echo $_GET['productid']; ?>"&id="<?php echo $_GET['id']; ?>"&rid="<?php echo $_GET['rid']; ?>"");
	}
	function KIInsert(rawmaterial,productid)
	{
		if(document.getElementById("avail_qty2"+rawmaterial).value==0)
			document.getElementById("add").style.visibility='hidden';
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
			<?php echo $_SESSION['IssuanceId'] = $_SESSION['LastId'] = ""; ?>
				if(xmlhttp.responseText)
				{
					document.getElementById("productlist").innerHTML = xmlhttp.responseText;
					<?php 
					if($_GET['id'])
					{
					?>
					document.getElementById("add1").style.visibility="hidden";
					<?php } ?>
				}
			}
		}
		<?php
		if($_GET['id'])
			{
		?>
			xmlhttp.open("GET","includes/KittingIssuance.php?batchid="+document.getElementById("batchvalue"+rawmaterial).value+"&issuancedate="+document.getElementById("issuancedate").value+"&number="+document.getElementById("number").value+"&issuedto="+document.getElementById("issued").value+"&rawmaterialid="+document.getElementById("rawmaterialid"+rawmaterial).value+"&quantity="+document.getElementById("quantity"+rawmaterial).value+"&productid="+document.getElementById("productid").value+"&kittingquantity="+document.getElementById("kittingquantity").value+"&getid="+document.getElementById("getid").value, true);
			xmlhttp.send();
		<?php }
		else if($_GET['id'] && $_GET['action']='delete')
			{
		?>
			xmlhttp.open("GET","includes/KittingIssuance.php?batchid="+document.getElementById("batchvalue"+rawmaterial).value+"&issuancedate="+document.getElementById("issuancedate").value+"&number="+document.getElementById("number").value+"&issuedto="+document.getElementById("issued").value+"&rawmaterialid="+document.getElementById("rawmaterialid"+rawmaterial).value+"&quantity="+document.getElementById("quantity"+rawmaterial).value+"&productid="+document.getElementById("productid").value+"&kittingquantity="+document.getElementById("kittingquantity").value+"&getid="+document.getElementById("getid").value, true);
			xmlhttp.send();
		<?php }
		else
		{?>
			xmlhttp.open("GET","includes/KittingIssuance.php?batchid="+document.getElementById("batchvalue"+rawmaterial).value+"&issuancedate="+document.getElementById("issuancedate").value+"&number="+document.getElementById("number").value+"&issuedto="+document.getElementById("issued").value+"&rawmaterialid="+document.getElementById("rawmaterialid"+rawmaterial).value+"&quantity="+document.getElementById("quantity"+rawmaterial).value+"&productid="+document.getElementById("productid").value+"&kittingquantity="+document.getElementById("kittingquantity").value, true);
			xmlhttp.send();
		<?php
		}
		?>
	}
	var SNo = 1;
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
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
	function GetOptions(Module, Id)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				if(xmlhttp.responseText)
					document.getElementById(Module).innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/Issuance_Get_Options.php?Module="+Module+"&id="+Id, true);
		xmlhttp.send();
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
</script>