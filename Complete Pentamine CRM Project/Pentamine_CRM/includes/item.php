<html>
	<head>
	    <link rel="stylesheet" type="text/css" href="style.css" />
		<script>
			function validate()
			{
				if(document.getElementById('itemname').value == "" || document.getElementById('itemname').value == null)
				{
					alert('Item Name is Required');
					return false;
				}
				if(document.getElementById('rackno').value == "" || document.getElementById('rackno').value == null)
				{
					alert('RackNo. is Required');
					return false;
				}
				if(document.getElementById('partno').value == "" || document.getElementById('partno').value == null)
				{
					alert('PartNo. is Required');
					return false;
				}
				if(document.getElementById('companyname').selectedIndex == 0 ) 
				{
					alert ( "Please select Companyname");
					return false;
				} 
				
			} 
			function validat() 
			{	
				if(document.getElementById('itemspecification').value == "" || document.getElementById('itemspecification').value == null)
				{
					alert('ItemSpecification is Required');
					return false;
				} 
				if(document.form.elements["product[]"])
				{
					var arrCheckboxes = document.form.elements["product[]"];
					var checkCount = 0;
				for (var i = 0; i < arrCheckboxes.length; i++)
				{
					checkCount += (arrCheckboxes[i].checked) ? 1 : 0;
				} 
				if (checkCount == 0)
				{
					alert("Please Select Atleast 1 Product");
					return false;
				}  
				}	
				if(document.form.elements["vendor[]"])
				{
					var arrCheckboxes = document.form.elements["vendor[]"];
					var checkCount = 0;
				for (var i = 0; i < arrCheckboxes.length; i++)
				{
					checkCount += (arrCheckboxes[i].checked) ? 1 : 0;
				} 
				if (checkCount == 0)
				{ 
					alert("Please Select Atleast 1 Vendor");
					return false;
				} 
				} 
			}
		</script> 
		<script language="JavaScript" type="text/javascript" src="js/wysiwyg.js"></script> 
		<style>
			.tablewidth 
			{ 	 
				width:35em; 
				word-wrap:break-word;
				word-break: break-all; 	 	
			} 
			.checkbox-grid li 
			{
				display: block;
				float: left;
				width: 100%;
			} 
		</style>
	</head>
	<body> 
		<div style="float:left;margin-top:25px;margin-left:900px;width:500px">
			<button onclick="window.location.href='?page=item'">AddItem</button>
			<button onclick="window.location.href='?page=itemsummary'">ItemSummary</button>
			<button onclick="window.location.href='?page=vendor'">Vendor</button>
		</div>
		&nbsp; 
			<form action="" method="POST" name="form" onsubmit="return validat();">
			<?php 
				include "config.php";
				ini_set( "display_errors", "0" );				
				$selected_product = implode(",",$_POST['product']) ;
				$selected_vendor = implode(",",$_POST['vendor']);
				if($_POST['submit'])
				{ 	
				$sql_select = mysql_query("SELECT PTIID FROM inventory_item ORDER BY id DESC");
				if(mysql_num_rows($sql_select))
				{
					$data = mysql_fetch_array($sql_select);
					$ptiid = substr($data['PTIID'],6,4)+1;
					if(strlen($ptiid) == 1)
						$ptiid ="PTIID-000".$ptiid;
					if(strlen($ptiid) == 2)
						$ptiid ="PTIID-00".$ptiid;
					if(strlen($ptiid) == 3)
						$ptiid ="PTIID-0".$ptiid;
				}
				else 
				{
					$ptiid = "PTIID-0001";
				}    
					mysql_query("INSERT INTO inventory_item (PTIID,itemname,rackno,partno,companyname,itemspecification,productlist,vendors) VALUES ('".$ptiid."','".$_POST['itemname']."','".$_POST['rackno']."','".$_POST['partno']."','".$_POST['companyname']."','".$_POST['itemspecification']."','".$selected_product."','".$selected_vendor."')");
					header("Location: ?page=item");
				}
				if($_GET['id'])
				{
				$sql_item = mysql_query("SELECT * FROM inventory_item WHERE id='".$_GET['id']."'");
				$row_item = mysql_fetch_array($sql_item);
					if($_POST['update'])
					{	
						mysql_query("UPDATE inventory_item SET itemname='".$_POST['itemname']."',rackno='".$_POST['rackno']."',partno='".$_POST['partno']."',companyname='".$_POST['companyname']."',itemspecification='".$_POST['itemspecification']."',productlist='".$selected_product."',vendors='".$selected_vendor."' WHERE id='".$_GET['id']."'");
						$_GET['id']='';
						header("Location: ?page=item");
					}
				}
				if($_GET['id'])
					echo '<td><input type="text"  value="'.$row_item['PTIID'].'"></td>';
				echo '<center><strong>Inventory Item</strong></center><table class="paginate sortable fulll"><tr>'; 
				if($_GET['id'])
					echo '<td><strong>Item Name</strong></td><td><input type="text" id="itemname" name="itemname" value="'.$row_item['itemname'].'"></td>';
				else
					echo '<td><strong>Item Name</strong></td><td><input type="text" id="itemname" name="itemname" value=""></td>';
				if($_GET['id'])
					echo '<td><strong>RackNo.</strong></td><td><input type="text" id="rackno" name="rackno" value="'.$row_item['rackno'].'"></td>';
				else
					echo '<td><strong>RackNo.</strong></td><td><input type="text" id="rackno" name="rackno" value=""></td>';
				
				if($_GET['id'])	
					echo '<td><strong>PartNo.</strong></td><td><input type="text" id="partno" name="partno" value="'.$row_item['partno'].'"></td>';
				else	
					echo '<td><strong>PartNo.</strong></td><td><input type="text" id="partno" name="partno" value=""></td>';
				
				$sql_sel = mysql_query("SELECT * FROM inventory_itemcompanymaster");
				echo '<td><strong>CompanyName</strong></td><td><select id="companyname" name="companyname"><option value="select">select</option>';
				$products = mysql_fetch_assoc(mysql_query("SELECT * FROM inventory_item where id=".$_GET['id']));
				while($row_sel = mysql_fetch_array($sql_sel))
				{	
					$found = 0;
					foreach($products as $value)
						if($value == $row_sel['companyname'])
							$found = 1;
					if($found)
						echo'<option value="'.$row_sel['companyname'].'" selected="selected">'.$row_sel['companyname'].'</option>';
					else
						echo'<option value="'.$row_sel['companyname'].'">'.$row_sel['companyname'].'</option>';
				}
				echo '</select></td></tr>';
				
				if($_GET['id'])
					echo '<tr><td><strong>ItemSpecification</strong></td><td colspan="8"><textarea rows="5" cols="100" name="itemspecification" id="itemspecification" bgcolor="white">'.$row_item['itemspecification'].'</textarea></td>';
				else	
					echo '<td><strong>ItemSpecification</strong></td><td colspan="8"><textarea rows="5" cols="100" name="itemspecification" id="itemspecification" bgcolor="white"></textarea></td></tr>';
				
			?>
				<script language="javascript1.2">
					generate_wysiwyg('itemspecification');
				</script>
			<?php				
				$sql_pro = mysql_query("SELECT * FROM producttype");
				echo '<tr><td><strong>Product</strong></td>';
				$products = mysql_fetch_assoc(mysql_query("SELECT * FROM inventory_item where id=".$_GET['id']));
				$product = explode(",", $products['productlist']);
				$k = 1;
				while($row_pro = mysql_fetch_array($sql_pro))
				{
					if($k == 1)
						echo "<tr>"; 
					$found = 0;
					foreach($product as $value)
						if($value == $row_pro['type'])
							$found = 1;  
					if($found) 
						echo '<td colspan="2"><ul class="checkbox-grid"><li><input type="checkbox" id="product" value="'.$row_pro['type'].'" name="product[]" checked="checked" >'.$row_pro['type'].'</li></ul></td>';
					else 
						echo '<td colspan="2"><ul class="checkbox-grid"><li><input type="checkbox" id="product" value="'.$row_pro['type'].'" name="product[]" >'.$row_pro['type'].'</li></ul></td>';					
					if($k % 4 == 0)
					{
						echo "</tr>";
						$k = 1;
					}
					else
						$k++;
				}
				if($k % 4 != 0)
					echo "</tr>";
				//echo'</tr>';
				$sql_ven = mysql_query("SELECT DISTINCT(Vendorname) as Vendorname FROM vendor");
				echo '<tr><td><strong>Vendor</strong></td>';
				$vendors = mysql_fetch_assoc(mysql_query("SELECT * FROM inventory_item where id=".$_GET['id']));
				$vendor = explode(",", $products['vendors']); 
				$v=1;
				while($row_ven = mysql_fetch_array($sql_ven))
				{
					if($v == 1)
						echo "<tr>"; 
					$found = 0;
					foreach($vendor as $value)
						if($value == $row_ven['Vendorname'])
							$found = 1;
					if($found)
						echo '<td colspan="2"><ul class="checkbox-grid"><li><input type="checkbox" id="vendor" value="'.$row_ven['Vendorname'].'" name="vendor[]" checked="checked" >'.$row_ven['Vendorname'].'</li></ul></td>';
					else
						echo '<td colspan="2"><ul class="checkbox-grid"><li><input type="checkbox" id="vendor" value="'.$row_ven['Vendorname'].'" name="vendor[]" >'.$row_ven['Vendorname'].'</li></ul></td>';	
					if($v % 4 == 0)
					{
						echo "</tr>";
						$v = 1;
					}
					else
						$v++;
				}
				if($v % 4 != 0)
					echo "</tr>"; 
				if($_GET['id'])
					echo'<tr><td><input type="submit" value="update" name="update" onclick="return validate()"></td>';
				else
					echo'<td><input type="submit" value="submit" name="submit" onclick="return validate()"></td>';
				echo'</tr></table>'; 
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1; 
				$rowsperpage = 20;
				$start = ($_GET['pageno']-1)*$rowsperpage;
				$sql_ret = mysql_query("SELECT * FROM inventory_item ORDER BY id DESC LIMIT $start,$rowsperpage");
				$total_pages = ceil(mysql_num_rows(mysql_query("SELECT * FROM inventory_item")) / $rowsperpage); 
				if(mysql_num_rows($sql_ret) == 0)
					echo '<strong>No values</strong>';
				else
				{
					echo'<br/><table class="paginate sortable fulll" width="1150px">
						<tr>
							<th>PTIID</th>
							<th>ItemName</th>
							<th>RackNo.</th>
							<th>PartNo.</th>
							<th>CompanyName</th>
							<th>ItemSpecification</th>
							<th>Product</th>
							<th>Vendor</th>
						</tr>';
					while($row_value = mysql_fetch_array($sql_ret))
					{
						echo'<tr>
								<td>'.$row_value['PTIID'].'</td>
								<td>'.$row_value['itemname'].'</td>
								<td>'.$row_value['rackno'].'</td>
								<td>'.$row_value['partno'].'</td>
								<td>'.$row_value['companyname'].'</td>
								<td class="tablewidth">'.$row_value['itemspecification'].'</td>
								<td>'.$row_value['productlist'].'</td>
								<td>'.$row_value['vendors'].'</td>
								<td><a href="?page=item&id='.$row_value['id'].'"><img src="images/edit.png" title="edit" /></a></td>
							</tr>';
					}
					echo '</table>';
				}
				$GetValues = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
				if($total_pages > 1)
				include('pagination_1.php'); 
			?>
		</form>
	</body>
</html>
