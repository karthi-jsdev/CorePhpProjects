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
			<link rel="stylesheet" type="text/css" href="style.css">  
	</head>
	<body>
		<div style="float:left;margin-top:25px;margin-left:900px;width:500px">
			<button onclick="window.location.href='?page=resource'">Resource</button> 
		</div>
		<form action="" method="POST">
			<?php
				include"config.php"; 
				ini_set( "display_errors", "0" );
				$i=3;$j=2; 
				$sql_product = mysql_query("SELECT * FROM producttype ORDER BY id DESC"); 
				echo'<div style="float:left;margin-top:10px;margin-left:-110px;width:200px;"><strong>Product</strong>
						<table class="paginate sortable">
						<tr>
							<th>slno</th>
							<th>Type</th>
							<th>Count</th>
						</tr>'; 
				$all = mysql_query("SELECT * FROM resource");
				echo '<tr><td>1</td><td><a href="?page=resourcesummary" style="text-decoration:none;">All</a></td><td>'.mysql_num_rows($all).'</td></tr>';
				
				$other = mysql_query("SELECT * FROM resource WHERE product='other'");
				$other_list = mysql_fetch_array($other);
				echo '<tr><td>2</td>
						<td><a href="?page=resourcesummary&other='.$other_list['product'].'" style="text-decoration:none;">Other</a></td><td>'.mysql_num_rows($other).'</td></tr>';
				while($row_product = mysql_fetch_array($sql_product))
				{ 
					$quer_pro = mysql_query("SELECT * FROM resource WHERE product LIKE '%".$row_product['type']."%'");
					echo'<tr> 
							<td>'.$i++.'</td>
							<td class="tablewidth1"><a href="?page=resourcesummary&prod=1&type='.$row_product['type'].'" style="text-decoration:none;">'.$row_product['type'].'</a></td>
							<td>'.mysql_num_rows($quer_pro).'</td>
						</tr>';
				}
				echo'</table><br/>';
				
				$product_sub = mysql_query("SELECT * FROM productsubtype ORDER BY id DESC"); 
				echo'<strong>SubProduct</strong><table class="paginate sortable">
							<tr>
								<th>slno</th>
								<th>Type</th>
								<th>Count</th>
							</tr>';
				$other_sub = mysql_query("SELECT * FROM resource WHERE subproduct='other'");
				$other_listsub = mysql_fetch_array($other);
				echo '<tr><td>1</td>
						<td><a href="?page=resourcesummary&othersub='.$other_listsub['product'].'" style="text-decoration:none;">Other</a></td><td>'.mysql_num_rows($other_sub).'</td></tr>';							
				while($sub_pro = mysql_fetch_array($product_sub))
				{
					$su_query = mysql_query("SELECT subproduct FROM resource WHERE subproduct LIKE '%".$sub_pro['type']."%'");
					
					echo'<tr>
							<td>'.$j++.'</td>
							<td class="tablewidth1"><a href="?page=resourcesummary&prod=2&type='.$sub_pro['type'].'" style="text-decoration:none;">'.$sub_pro['type'].'</a></td>
							<td>'.mysql_num_rows($su_query).'</td>
						</tr>'; 
				}
				echo'</table></div>';
				
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1; 
				$rowsperpage = 20;
				$start = ($_GET['pageno']-1)*$rowsperpage;  
				if($_GET['other'])	
				{
					$cond = "WHERE product='".$_GET['other']."'";
					$type_pro = mysql_query("SELECT * FROM resource $cond ORDER BY id DESC LIMIT $start,$rowsperpage");
				}
				else if($_GET['othersub']) 
				{
					$cond = "WHERE subproduct='".$_GET['othersub']."'";
					$type_pro = mysql_query("SELECT * FROM resource $cond ORDER BY id DESC LIMIT $start,$rowsperpage");
				}
				else
				{
					if($_GET['type'])
					{
						if($_GET['prod']==1)
							$cond = "WHERE product='".$_GET['type']."'";
						else
							$cond = "WHERE subproduct='".$_GET['type']."'";
							
						$type_pro = mysql_query("SELECT * FROM resource $cond ORDER BY id DESC LIMIT $start,$rowsperpage");
					}
					//else if($_GET['subprotype'])
						//$type_pro = mysql_query("SELECT * FROM resource WHERE subproduct='%".$_GET['subprotype']."%' ORDER BY id DESC LIMIT $start,$rowsperpage");
					else
						$type_pro = mysql_query("SELECT * FROM resource ORDER BY id DESC LIMIT $start,$rowsperpage");
				}
				$total_pages = ceil(mysql_num_rows(mysql_query("SELECT * FROM resource $cond")) / $rowsperpage);
				echo '<div style="float:left;padding-top:10px;margin-left:10px;width:790px">';
				if(mysql_num_rows($type_pro) == 0)
					echo'<strong>No Values</strong>';
				else
				{
					echo '<table class="paginate sortable full">
							<tr>
								<th>PTRID</th>
								<th>product</th>
								<th>SubProduct</th>
								<th>Description</th>
								<th>Date</th> 
								<th>UpdatedBy</th>
							</tr>';
					while($type_otherprod = mysql_fetch_array($type_pro))
					{
						echo'<tr>
								<td>'.$type_otherprod['PTRID'].'</td>
								<td>'.$type_otherprod['product'].'</td>
								<td>'.$type_otherprod['subproduct'].'</td>
								<td class="tablewidth">'.$type_otherprod['description'].'</td>
								<td>'.$type_otherprod['date'].'</td> 
								<td>'.$type_otherprod['updatedby'].'</td>   
							</tr>';
					}
					echo'</table>';
				} 
				$GetValues = "page=".$_GET['page']."&other=".$_GET['other']."&othersub=".$_GET['othersub']."&";
				if($total_pages > 1)
					include('pagination_1.php');
				echo'</div>';
			?>
		</form>
	</body>
</html>