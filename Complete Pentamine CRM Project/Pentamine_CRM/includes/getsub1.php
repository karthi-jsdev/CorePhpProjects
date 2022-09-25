<?php
include("config.php");
?>
<table class='paginate sortable table2'>
			<tr><th>Sub-Product Name</th></tr>
			<?php
				if($_GET['id'])
				{
					$query=mysql_query("select * from productsubtype where type_id='".$_GET['id']."'");
					while($row=mysql_fetch_array($query))
					{
						echo "<tr> <td>".$row['type']."</td>";//<td>".$row['id']."</td>
						echo "<td><a href='?page=mastersub&slno=".$row['slno']."&edit=2'><img src='images/edit.png' title='edit' /></a></td>";
						echo 	"<td>
							<a href='#'onClick='productdelete(".$row['id'].")'><img src='images/delete.png' title='delete' /></a><br />
						</td></tr>";
					}
				}
			?>
</table>