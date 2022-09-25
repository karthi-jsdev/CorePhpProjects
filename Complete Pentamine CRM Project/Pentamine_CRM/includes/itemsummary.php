<html>
	<head>
		<style>
			.tablewidth 
			{ 	 
				width:35em; 
				word-wrap:break-word;
				word-break: break-all; 	 	
			}
			.tablewidth1
			{ 	 
				width:12em; 
				word-wrap:break-word;
				word-break: break-all; 	 	
			}
		</style>
		<link rel="stylesheet" type="text/css" href="style.css" /> 
	</head>
	<body>
		<div style="float:left;margin-top:25px;margin-left:900px;width:500px">
			<button onclick="window.location.href='?page=item'">AddItem</button>
			<button onclick="window.location.href='?page=itemsummary'">ItemSummary</button>
			<button onclick="window.location.href='?page=vendor'">Vendor</button>
		</div>
		<form action="" method="POST">
			<?php
				include"config.php";
				ini_set( "display_errors", "0" ); 
				$i=2;$j=1;  
				$sql_product = mysql_query("SELECT * FROM producttype ORDER BY id DESC"); 
				echo'<div style="float:left;margin-top:0px;margin-left:-110px;">
					<strong>Product</strong><table class="paginate sortable fulll">
						<tr>
							<th>slno</th>
							<th>Type</th>
							<th>Count</th>
						</tr>'; 
				$all = mysql_query("SELECT * FROM inventory_item");
				echo '<tr><td>1</td>
						<td><a href="?page=itemsummary" style="text-decoration:none;">All</a></td>
						<td>'.mysql_num_rows($all).'</td>
					</tr>';
				while($row_product = mysql_fetch_array($sql_product))
				{
					$quer_pro = mysql_query("SELECT productlist FROM inventory_item WHERE productlist LIKE '%".$row_product['type']."%'");
					echo'
						<tr> 
							<td>'.$i++.'</td>
							<td class="tablewidth1"><a href="?page=itemsummary&prod=1&type='.$row_product['type'].'" style="text-decoration:none;">'.$row_product['type'].'</a></td>
							<td>'.mysql_num_rows($quer_pro).'</td>
						</tr>';
				}
				echo'</table><br/>';
				$sql_vendor = mysql_query("SELECT DISTINCT(Vendorname) as Vendorname FROM vendor ORDER BY id DESC");
				echo'<strong>Vendor</strong><table class="paginate sortable fulll">
						<tr>
							<th>slno</th>
							<th>Vendor</th>
							<th>Count</th>
						</tr>';
				while($row_vendor = mysql_fetch_array($sql_vendor))
				{
					$quer_ven = mysql_query("SELECT vendors FROM inventory_item WHERE vendors LIKE '%".$row_vendor['Vendorname']."%'");
					echo'<tr>
							<td>'.$j++.'</td> 
							<td class="tablewidth1"><a href="?page=itemsummary&prod=2&type='.$row_vendor['Vendorname'].'" style="text-decoration:none;">'.$row_vendor['Vendorname'].'</a></td>
							<td>'.mysql_num_rows($quer_ven).'</td>
						</tr>';
				}
				echo'</table></div>'; 
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1; 
				$rowsperpage = 20;
				$start = ($_GET['pageno']-1)*$rowsperpage; 
				if($_GET['type'])
				{
					if($_GET['prod']==1)
					$condition= "WHERE productlist='".$_GET['type']."'"; 
				else 
					$condition= "WHERE vendors LIKE '%".$_GET['type']."%'"; 
					$sql_pvret = mysql_query("SELECT * FROM inventory_item $condition ORDER BY id DESC LIMIT $start,$rowsperpage");
				}
				else
					$sql_pvret = mysql_query("SELECT * FROM inventory_item ORDER BY id DESC LIMIT $start,$rowsperpage");
				$total_pages = ceil(mysql_num_rows(mysql_query("SELECT * FROM inventory_item $condition")) / $rowsperpage);
				echo '<div style="float:left;padding-top:10px;margin-left:10px;width:790px">';
				if(mysql_num_rows($sql_pvret) == 0)
					echo '<strong>No Values</strong>';
				else
				{
					echo'<table class="paginate sortable fulll" width="1000px">
							<tr>
								<td><strong>PTIID</strong></td>
								<td><strong>ItemName</strong></td>
								<td><strong>RackNo.</strong></td>
								<td><strong>PartNo.</strong></td>
								<td><strong>Companyname</strong></td>
								<td><strong>ItemSpecification</strong></td>
								<td><strong>Product</strong></td>
								<td><strong>Vendor</strong></td>
							</tr>';
					while($row_prodret = mysql_fetch_array($sql_pvret))
					{
						echo'<tr>
								<td>'.$row_prodret['PTIID'].'</td>
								<td>'.$row_prodret['itemname'].'</td>
								<td>'.$row_prodret['rackno'].'</td>
								<td>'.$row_prodret['partno'].'</td>
								<td>'.$row_prodret['companyname'].'</td>
								<td class="tablewidth">'.$row_prodret['itemspecification'].'</td>
								<td>'.$row_prodret['productlist'].'</td>
								<td>'.$row_prodret['vendors'].'</td>
							</tr>';
					}
					echo '</table>';
				}
				$GetValues = "page=".$_GET['page']."&type=".$_GET['type']."&prod=".$_GET['prod']."&";
				if($total_pages > 1)
				include('pagination_1.php');
				echo'</div>';
			?>
		</form>
	</body>
</html>