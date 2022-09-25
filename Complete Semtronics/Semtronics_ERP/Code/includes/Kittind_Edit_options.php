<?php
if($_GET['id'])
{?>
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
				<?php
					if($Exixsts = mysql_fetch_array(Select_Issuance_ByNumber()))
						$Exixsts['number']++;
					else
						$Exixsts['number'] = date("Ym")."0000001";
				?>
				<input type="text" id="number" value="<?php echo $Exixsts['number']; ?>" disabled />
			</div>
			<div class="clearfix">
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
			</div>
		</div>
		<?php
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
								join productbom on productbom.rawmaterialid=rawmaterial.id
								join products on products.id=productbom.productcode 
								where productbom.productcode='".$_POST['productid']."' && stockinventory.inspection='1' && rawmaterial.id='".$rmwithqty['id']."'");
				while($batchvalue = mysql_fetch_Assoc($batchvalues))
				{
					$batchid[] = $batchvalue['id'];
					$batchnumber[] = $batchvalue['number'];
				}
				echo "<form action='' method='POST'>
						<tr>
							<td><br/><input type='text' value=".$rmwithqty['materialcode']." name='materialcode' disabled></td>
							<td><br/><input type='hidden' value=".$rmwithqty['id']." name='rawmaterialid' id='rawmaterialid".$rmwithqty['id']."'></td>
							<td><br/><input type='text' value=".$_POST['kittingquantity']*$rmwithqty['qty']." name='kittingquantity' disabled></td>
							<td><br/><select name='batchvalue' id='batchvalue".$rmwithqty['id']."' onchange='availqty(".$rmwithqty['id'].")'>
								<option value=''>select</option>";
							foreach($batchid as $number => $ids)
								echo"<option value=".$ids.">".$batchnumber[$number]."</option>";
							echo"</select></td>
							<td><br/><div><p id='avail_qty".$rmwithqty['id']."'></p></div></td>
							<td><br/><input type='text' value='' required='required' autocomplete='off' name='quantity' id='quantity".$rmwithqty['id']."' onkeypress='return Amount(event,".$rmwithqty['id'].");'></td>
					
					
					<br/>";
				unset($batchid);
				unset($batchnumber);
				$issue = $_POST['issuedto'];
				$productid = $_POST['productid'];
				echo '<td><br/><a class="button button-orange" id="add" onclick="KIInsert('.$rmwithqty['id'].','.$productid.');">Add</a></td></tr>';
			}
		if($_POST['submit'])
		{
		?>
		<tr><td><a class="button button-green" onclick="window.location.assign('?page=Stores&subpage=spage->Issuance,ssubpage->Status&number='+document.getElementById('number').value)">Finish</a></td></tr>
		<?php 
		}
		?>
	<tr>
		<td><br/><input type='hidden' value="<?php echo $_POST['issuedto'];?>" name='issued' id='issued'></td>
		<td><br/><input type='hidden' value="<?php echo $_POST['productid'];?>" name='productid' id='productid'></td>
	</tr></form>
	</table>
	<div><span id="productlist"></span></div>
	</div>