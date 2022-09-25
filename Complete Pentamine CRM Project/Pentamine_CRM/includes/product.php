<?php  
	include"config.php"; 
	ini_set( "display_errors", "0" );
	$i=2;$j=1;
	$sql_product = mysql_query("SELECT * FROM producttype ORDER BY id DESC"); 
	echo'<div style="float:left;margin-top:-250px;margin-left:-200px;"><table class="paginate sortable full">
				<tr>
					<th>slno</th>
					<th>Type</th>
					<th>Count</th>
				</tr>'; 
		$all = mysql_query("SELECT * FROM resource");
		echo '<tr><td>1</td><td><a href="?page=resourcesummary" style="text-decoration:none;">All</a></td><td>'.mysql_num_rows($all).'</td></tr>';
		while($row_product = mysql_fetch_array($sql_product))
		{ 	
			$quer_pro = mysql_query("SELECT product FROM resource WHERE product LIKE '%".$row_product['type']."%'");
			echo'
				<tr> 
					<td>'.$i++.'</td>
					<td><a href="?page=resourcesummary&type='.$row_product['type'].'" style="text-decoration:none;">'.$row_product['type'].'</a></td>
					<td>'.mysql_num_rows($quer_pro).'</td>
				</tr>';
		}
		echo'</table><br/>';
		$product_sub = mysql_query("SELECT * FROM productsubtype ORDER BY id DESC");
			echo'<table class="paginate sortable full">
						<tr>
							<th>slno</th>
							<th>Type</th>
							<th>Count</th>
						</tr>'; 
			while($sub_pro = mysql_fetch_array($product_sub))
			{
				$su_query = mysql_query("SELECT subproduct FROM resource WHERE  subproduct LIKE '%".$sub_pro['type']."%'");
				
				echo'<tr>
						<td>'.$j++.'</td>
						<td><a href="?page=resourcesummary&subprotype='.$sub_pro['type'].'" style="text-decoration:none;">'.$sub_pro['type'].'</a></td>
						<td>'.mysql_num_rows($su_query).'</td>
					</tr>'; 
			}
			echo'</table></div>';  
			$r_comment = mysql_query("SELECT * FROM resource_comment WHERE PTRID='".$_GET['id']."' ORDER BY id DESC");
			if(mysql_num_rows($r_comment)==0)
				echo"<br/><strong><center>No Values</center></strong>";
			else
			{	
				echo'<table class="paginate sort full">
						<tr>
							<td>CommentDate</td>
							<td>Comment</td>
							<td>Follow update</td>
							<td>Product</td>
							<td>SubProduct</td>
						</tr>';
				while($valu_comment = mysql_fetch_array($r_comment))
				{
					echo'<tr>
							<td>'.$valu_comment['commentdate'].'</td>
							<td>'.$valu_comment['comment'].'</td>
							<td>'.$valu_comment['followupdate'].'</td>  
							<td>'.$valu_comment['product'].'</td>		
							<td>'.$valu_comment['subproduct'].'</td>										
						</tr>';
				}
				echo '<table>';
			} 
		?>