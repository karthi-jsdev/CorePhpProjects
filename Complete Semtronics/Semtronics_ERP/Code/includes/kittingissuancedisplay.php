<?php
include("config.php");
if($_GET['productid'] && $_GET['issuedto'])
{
	$kittinglist = mysqli_query($_SESSION['connection'],"SELECT materialcode,rawmaterial.id,productbom.quantity as qty,productbom.productcode,sum(stockinventory.quantity) as quantity,sum(stockissuance.quantity) as squantity
									FROM rawmaterial 
									join batch on batch.rawmaterialid=rawmaterial.id 
									join stockinventory on stockinventory.batchid=batch.id
									join stockissuance on stockissuance.batchid=batch.id
									join issuance on stockissuance.issuanceid=issuance.id
									join issuanceuser on stockissuance.issuedto=issuanceuser.id
									join productbom on productbom.rawmaterialid=rawmaterial.id
									join products on products.id=productbom.productcode 
									where productbom.productcode='".$_GET['productid']."' && issuedto='".$_GET['issuedto']."' stockinventory.inspection='1' group by rawmaterial.id");
	while($kitting_list = mysqli_fetch_assoc($kittinglist))
	{
		echo '<tr>
				<td>'.$kitting_list['materialcode'].'</td>
				<td>'.$kitting_list['qty'].'</td>
				<td>'.$kitting_list['quantity'].'</td>
				<td>'.$kitting_list['squantity'].'</td>
		</tr>';
	}
}
?>