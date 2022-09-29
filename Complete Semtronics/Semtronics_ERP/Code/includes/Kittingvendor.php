<?php
ini_set("display_errors","0");
include("Config.php");
include("Product_Management Queries.php");
?>
 <table border='1'>
	<thead>
		<tr>
			<th width="43px" align="center">S.NO.</th>
			<th align="left">Vendor Code</th>
			<th align="left">Vendor Name</th>
			<th align="left">Credit Limit</th>
			<th align="left">Credit Period</th>
			<th align="left">Lead Time</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
		$Vendors = Vendor_Select_ByRawmaterial();
		while($Vendor = mysqli_fetch_assoc($Vendors))
		{
			$Vendor_rawmaterialid = explode(".", $Vendor['rawmaterialid']);
			//if(in_array($_GET['rawmaterialid'], $Vendor_rawmaterialid))
			//{
				echo "<tr>
					<td>".$i++."</td>
					<td>".$Vendor['vendorid']."</td>
					<td><a href='#' style='text-decoration:none;' onclick =\"post_value('".$Vendor['id']."','".$Vendor['name']."','".$Vendor['leadtime']."')\" >".$Vendor['name']."</a></td>
					<td>".$Vendor['creditlimit']."</td>
					<td>".$Vendor['creditperiodid']."</td>
					<td>".$Vendor['leadtime']."</td>
				</tr>";
			//}
		} ?>
	</tbody>
 </table>
 <script langauge="javascript">
function post_value(id, name, leadtime)
{
	opener.document.vendor.vendorid<?php echo $_GET['inc'];?>.value = id;
	opener.document.vendor.vendorname<?php echo $_GET['inc'];?>.value = name;
	opener.document.vendor.vendorleadtime<?php echo $_GET['inc'];?>.value = leadtime;
	if(leadtime > <?php echo $_GET['vendorleadtime'];?>)
		opener.document.vendor.vendorleadtime.value = leadtime;
	self.close();
}
</script>