<?php
	include("Config.php");
?>
<table class="paginate sortable full" border='1'>
	<thead>
		<tr>
			<th width="43px" align="center">S.NO.</th>
			<td>Scholarship Name</td>
			<td>Amount</td>
			<td>Mode</td>
		</tr>
		<?php
		$i = 1;
		$Scholarshipname = mysqli_query($_SESSION['connection'],"SELECT * From discount order by id asc");
		while($scholarship = mysqli_fetch_array($Scholarshipname))
		{
			echo "<tr><td>".$i++."</td>
			<td><a href='#' style='text-decoration:none;' onclick='post_value(".$scholarship['id'].",".$scholarship['discount'].",".$scholarship['mode'].")'>".$scholarship['name']."</a></td>
			<td>".$scholarship['discount']."</td>";
			if($scholarship['mode'] == "0")
				echo "<td>Percentage</td>";
			else	
				echo "<td>Amount</td></tr>";
		} ?>
	</thead>	
</table>
 <script langauge="javascript">
function post_value(id, discount, mode)
{
	opener.document.myform.scholarid<?php echo $_GET['monthid'];?>.value = id;
	if(mode == 0)
	{
		opener.document.myform.scholaramount<?php echo $_GET['monthid'];?>.value = (discount/100) * <?php echo $_GET['amounttobepaid'];?>;
		opener.document.myform.amount<?php echo $_GET['monthid'];?>.value = (discount/100) * <?php echo $_GET['amounttobepaid'];?>;
		opener.document.myform.amounttobepaid<?php echo $_GET['monthid'];?>.value = (discount/100) * <?php echo $_GET['amounttobepaid'];?>;
	}	
	else
	{
		opener.document.myform.scholaramount<?php echo $_GET['monthid'];?>.value = discount;
		opener.document.myform.amount<?php echo $_GET['monthid'];?>.value = <?php echo $_GET['amounttobepaid'];?> - (discount);
		opener.document.myform.amounttobepaid<?php echo $_GET['monthid'];?>.value = <?php echo $_GET['amounttobepaid'];?> - (discount);
	}	
	opener.document.myform.scholarmode<?php echo $_GET['monthid'];?>.value = mode;
	self.close(); 
}
</script>