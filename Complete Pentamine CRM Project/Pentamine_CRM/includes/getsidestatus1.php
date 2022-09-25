<?php
echo '<link rel="stylesheet" type="text/css" href="style.css" />
		<div style="float:left;margin-top:-80px;margin-left:-250px;width:250px">';
			$sql1 = mysql_query("SELECT * FROM status");
			if(mysql_num_rows($sql1))
			{
				echo "<table  border='1'  align='left' class='paginate sortable full1'>
					<tr>
						<th align='left'>Status</th>
						<th align='left'>No. of Items</th>
					</tr>";
					echo "<tr><td>";?> <a href='?page=leadsummary' style='text-decoration:underline;'>All</a></td>
					<?php
					echo "<td>";
					$var_value = 0;
					foreach($product as $prod)
					{
						$query1 = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."'");
						$var = mysql_num_rows($query1);
						$var_value = $var + $var_value;
					}
					echo "<a>".$var_value."</a>";
					echo "</td></tr>";
					while($row1_status = mysql_fetch_array($sql1))
					{
						echo "<tr><td>";?><a href='?page=leadsummary&id=<?php echo $row1_status['slno'];?>' style='text-decoration:underline;'><?php echo $row1_status['status']."</a></td>";
						echo "<td>";
						$var_value1 = 0;
						foreach($product as $prod)
						{
							$query = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid IN (SELECT ptclid FROM comments WHERE status_id ='".$row1_status['slno']."' and enable='1')");
							$var = mysql_num_rows($query);
							$var_value1 = $var + $var_value1;
						}
						echo "<a>".$var_value1."</a>";
						echo "</td></tr>";
					}	
					echo "<tr><td>"; ?><a href='?page=leadsummary&nostatus=nos' style='text-decoration:underline;'>No Status</a><?php echo "</td>";
					$var_value2 = 0;
					echo "<td>";
					foreach($product as $prod)
					{
						$query1 = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid NOT IN(SELECT ptclid FROM comments)");
						$var = mysql_num_rows($query1);
						$var_value2 = $var + $var_value2;
					}
					echo "<a>".$var_value2."</a>";
					echo "</td></tr>";
					echo "<tr><td>";?><a  href='?page=leadsummary&nowork=nowork' style='text-decoration:underline;' ><?php echo "Work Not Enabled</a></td>";
					$var_value2 = 0;
					echo "<td>";
					foreach($product as $prod)
					{
						$sql1_st = mysql_fetch_array(mysql_query("SELECT * FROM status WHERE status='Closed/Won'"));
						$query1 = mysql_query("SELECT * FROM lead WHERE ptype='".$prod."' AND ptclid NOT IN(SELECT lead FROM work) AND ptclid IN(Select ptclid From comments Where status_id='".$sql1_st['slno']."' AND enable='1')");
						$var = mysql_num_rows($query1);
						$var_value2 = $var + $var_value2;
					}
					echo "<a style='text-decoration:underline;'>".$var_value2."</a>";
					echo "</td></tr>";
				echo "</table><br /><br /><br />";
			}
			else
				echo "No Status";
	
				$product_query = mysql_query("SELECT * FROM producttype");
			if(mysql_num_rows($product_query))
			{
					echo "<br /><br /><br />
					<table  border='1'  align='left' class='paginate sortable full1'>
						<tr>
							<th>Product</th>
							<th>No. of Items</th>
						</tr>";
						foreach($product as $prod)
						{
							$product_query1 = mysql_query("SELECT * FROM producttype WHERE slno='".$prod."'");
							while($product_row=mysql_fetch_array($product_query1))
							{
								$status_id = mysql_fetch_array(mysql_query("Select * From status Where status='Closed/Won'"));
								echo "<tr><td>";?><a href='?page=leadsummary&product=<?php echo $product_row['slno'];?>&status=<?php echo $status_id['slno'];?>' style='text-decoration:underline;'><?php echo $product_row['type']."</a></td>";
								$product_number = mysql_query("select * from lead where ptype='".$product_row['slno']."' AND (ptclid IN(Select ptclid From comments WHERE (status_id != '8'  and enable=1)  AND (status_id != '7'  and enable=1))  OR ptclid NOT IN (SELECT ptclid FROM comments))");
								echo "<td><a>".mysql_num_rows($product_number)."</a></td></tr>";
							}
						}
					echo	"</table>";
				
	}					
	echo '<br>';
	echo "<table  border='1'  align='left' class='paginate sortable full1'>
					<tr>
						<th align='left'>Product</th>
						<th align='left'>Closed Leads</th>
					</tr>";
			foreach($product as $prod)
			{
				$product_query1 = mysql_query("SELECT * FROM producttype WHERE slno='".$prod."'");
				while($product_row=mysql_fetch_array($product_query1))
				{
					$status_id = mysql_fetch_array(mysql_query("Select * From status Where status='Closed/Won'"));
					echo "<tr><td>";?><a style='text-decoration:underline;' href='?page=leadsummary&product1=<?php echo $product_row['slno'];?>&status1=<?php echo $status_id['slno'];?>'><?php echo $product_row['type']."</a></td>";
					$product_number = mysql_query("select * from lead where ptype='".$product_row['slno']."' AND ptclid IN(Select ptclid From comments WHERE status_id = '".$status_id['slno']."' AND enable=1)");
					echo "<td><a style='text-decoration:underline;'>".mysql_num_rows($product_number)."</a></td></tr>";
				}
			}
	echo "</table></div>";
?>