<?php
include('Config.php');
if($_GET['batchvalue'] && $_GET['rawmaterial'])
{
	$batch_value = mysql_query("SELECT sum(stockinventory.quantity)as quantity
								FROM rawmaterial 
								join batch on batch.rawmaterialid=rawmaterial.id 
								join stockinventory on stockinventory.batchid=batch.id
								where stockinventory.inspection='1' && batchid='".$_GET['batchvalue']."' && rawmaterial.id='".$_GET['rawmaterial']."'");
	while($batchvalue = mysql_fetch_assoc($batch_value))
	{
		$issuebatch = mysql_fetch_assoc(mysql_query("SELECT batch.id, batch.number, sum(stockissuance.quantity) as quantity FROM batch
							JOIN stock ON stock.batchid=batch.id
							JOIN stockissuance ON stockissuance.batchid=batch.id
							WHERE stock.quantity>0 && batch.rawmaterialid=".$_GET['rawmaterial']."  && stockissuance.batchid=".$_GET['batchvalue']." "));
		
		$inventorybatch = mysql_fetch_assoc(mysql_query("SELECT batch.id, batch.number, sum(stockinventory.quantity) as quantity FROM batch
							JOIN stock ON stock.batchid=batch.id
							JOIN stockinventory ON stockinventory.batchid=batch.id
							WHERE batch.rawmaterialid=".$_GET['rawmaterial']."  && stockinventory.batchid=".$_GET['batchvalue']." && 
							stock.quantity>0 && stockinventory.inspection='1' ORDER BY batch.id"));
		if($_GET['batchvalue'] == $issuebatch['id'])
		{
			$batchvalue = $inventorybatch['quantity'] - $issuebatch['quantity'];
			echo '<input type="text" id="avail_qty2'.$_GET['rawmaterial'].'" name="avail_qty" value="'.$batchvalue.'" disabled>';
		}
		else
			echo '<input type="text" id="avail_qty2'.$_GET['rawmaterial'].'" name="avail_qty" value="'.$batchvalue['quantity'].'" disabled>';
	}
}
?>