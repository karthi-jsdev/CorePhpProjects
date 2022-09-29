<?php
include('Config.php');
?>
<br/>
<section role="main" id="main">
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#date").datepicker({dateFormat: 'yy-mm-dd'});
			$("#date").datepicker().datepicker("setDate", new Date());
			$("#bdate").datepicker({dateFormat: 'yy-mm-dd'});
			$("#bdate").datepicker().datepicker("setDate", new Date());
		});
	</script>
	<?php 
		if(!$_GET['number'])
			echo '<h2>Please select Issuance to create Delivery Challan</h2>Go to Summary->Click on any issuancecode->In status click Create DC button->In DC Fill required details Followed by clicking create DC';
		else
		{
	?>
	<div class="columns" style='width:902px;'>
		<div style="float:left">
			<form action="" method="POST">
				<?php
					echo '<img src="images/logo.jpg" alt="semtronics_logo" width="180px" height="50px">';
				?>
				<br/>
				<p>
					M/s. SEMTRONICS  MICROSYSTEMS PVT LTD<br/>
					NO.39/3B,2ND FLOOR,KANAKAPURA MAIN ROAD,<br/>	
					OPPOSITE JBS NURSING HOME, BANASHANKARI<br/>
					BANGALORE  -- 560 070<br/>
					PHONE NO: 080-26715997<br/>
					e mail ID: info@semtronicsMicrosystems.com<br/>
					ECC NO: AAPCS0701GEM001<br/>
					RANGE:   KANAKAPURA II<br/>
					DIVISION: KANAKAPURA<br/>
					VAT NO:	29770605984<br/>
				</p>
				<p>To<br/>
				<textarea rows='3' cols='50' id='toaddress' name='toaddress'><?php echo $_POST['toaddress'];?></textarea>
				</p><br/><br/><br/>
			</div>
			<div style="float:right"> 
				<?php
					echo '<h1>Delivery Challan</h1>';
				?>
				<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				DC No.<input type="text" id="dcno" name="dcno" value="<?php echo $_POST['dcno'];?>">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Dated<input type="text" id="date" name="date" value="<?php echo $_POST['date'];?>"><br/><br/>
				&nbsp;&nbsp;&nbsp;&nbsp;
				Supplier's Ref.<input type="text" id="sref" name="sref" value="<?php echo $_POST['sref'];?>">
				Other's Ref.<input type="text" id="oref" name="oref" value="<?php echo $_POST['oref'];?>"><br/><br/>
				&nbsp;Buyer's Order No.<input type="text" id="bono" name="bono" value="<?php echo $_POST['bono'];?>">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Dated<input type="text" id="bdate" name="bdate" value="<?php echo $_POST['bdate'];?>"><br/><br/><br/>
				
				<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				ANNEXURE II&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				E SUGAM NO.<input type="text" id="esno" name="esno" value="<?php echo $_POST['esno'];?>"><br/><br/>
				Despatch through<input type="text" id="despatch" name="despatch" value="<?php echo $_POST['despatch'];?>">&nbsp;
				<input type="hidden" id="despatch1" name="despatch1" value="<?php echo $_GET['number'];?>">
				Destination<input type="text" id="destination" name="destination" value="Bangalore"><br/><br/>
				Terms of Delivery<textarea rows='2' cols='60' id='tod' name='tod'><?php echo $_POST['tod'];?></textarea><br/>
				<input type="submit" class="button button-green" value="Create DC" name="dc" onclick="dcdownload();">
			<h3>
			</div>
			<table class="paginate sortable full">
				<thead>
					<tr>
						<td width="10px">Slno</td>
						<td>Description Of Goods</td>
						<td>Quantity</td>
						<td>Price</td>
						<td>Remarks</td>
					</tr>
				</thead>
				<tbody>
			<?php
			$i=1;
			$issuance_dc = mysqli_query($_SESSION['connection'],"SELECT stockinventory.unitprice,location.name,issuance.number,rawmaterial.id, rawmaterial.materialcode, rawmaterial.partnumber, rawmaterial.description, stockissuance.quantity, issuanceuser.issuanceuser as issuanceuser, issuance.issueddate FROM stockissuance JOIN batch ON batch.id=stockissuance.batchid JOIN rawmaterial ON rawmaterial.id=batch.rawmaterialid JOIN issuanceuser ON issuanceuser.id=stockissuance.issuedto JOIN issuance ON issuance.id=stockissuance.issuanceid JOIN stockinventory on batch.id=stockinventory.batchid join location on location.id=locationid WHERE issuance.number='".$_GET['number']."' ORDER BY stockissuance.id");
			while($issuance = mysqli_fetch_assoc($issuance_dc))
			{
				echo '<tr>
						<td>'.$i++.'</td>
						<td>'.$issuance['description'].'</td>
						<td>'.$issuance['quantity'].'</td>
						<td>'.$issuance['quantity']*$issuance['unitprice'].'</td>';
					if($i==2)
						echo'<td>Not For Sale</td>';
					echo'</tr>';
			}
			?>
				</tbody>
			</table><br/>
			<div style="float:left">
				<h3>
					Company's VAT TIN : 29770605984<br/>			
					Company's CST No. : 29770605984<br/>				
					Company's PAN : AAPCS0701G<br/>
				</h3>
			</div>
			<div style="float:right">
				<h3>
					for Semtronics Micro Systems Pvt.Ltd<br/>
						AUTHORISED SIGNATORY
				</h3>
			</div>
		<?php }?>
		</form>
	</div>
</section>
<script>
function dcdownload()
{
	if(document.getElementById("dcno").value==""||document.getElementById("dcno").value==null)
	{
		alert("Please Enter Delivery Challan No.");
		return false;
	}
	else if(document.getElementById("date").value==""||document.getElementById("date").value==null)
	{
		alert("Please Select Date");
		return false;
	}
	else if(document.getElementById("sref").value==""||document.getElementById("sref").value==null)
	{
		alert("Please Enter Supplier's Reference");
		return false;
	}
	else if(document.getElementById("oref").value==""||document.getElementById("oref").value==null)
	{
		alert("Please Enter Other's Reference");
		return false;
	}
	else if(document.getElementById("bono").value==""||document.getElementById("bono").value==null)
	{
		alert("Please Enter Buyer's Order Number");
		return false;
	}
	else if(document.getElementById("bdate").value==""||document.getElementById("bdate").value==null)
	{
		alert("Please Enter Buyer's Order Number date");
		return false;
	}
	else if(document.getElementById("esno").value==""||document.getElementById("esno").value==null)
	{
		alert("Please Enter E Sugam No.");
		return false;
	}
	else if(document.getElementById("despatch").value==""||document.getElementById("despatch").value==null)
	{
		alert("Please Enter Despatch Mode");
		return false;
	}
	else if(document.getElementById("destination").value==""||document.getElementById("destination").value==null)
	{
		alert("Please Enter Destination");
		return false;
	}
	else if(document.getElementById("tod").value==""||document.getElementById("tod").value==null)
	{
		alert("Please Enter Terms of Delivery");
		return false;
	}
	else if(document.getElementById("toaddress").value==""||document.getElementById("toaddress").value==null)
	{
		alert("Please Enter To address");
		return false;
	} 
	else
		window.open("includes/dcdownload.php?number="+document.getElementById("despatch1").value+"&dcno="+document.getElementById("dcno").value+"&dated="+document.getElementById("date").value+"&sref="+document.getElementById("sref").value+"&oref="+document.getElementById("oref").value+"&bno="+document.getElementById("bono").value+"&bdated="+document.getElementById("bdate").value+"&esno="+document.getElementById("esno").value+"&despatch="+document.getElementById("despatch").value+"&destination="+document.getElementById("destination").value+"&tod="+document.getElementById("tod").value+"&toaddress="+document.getElementById("toaddress").value,true);
}
</script>