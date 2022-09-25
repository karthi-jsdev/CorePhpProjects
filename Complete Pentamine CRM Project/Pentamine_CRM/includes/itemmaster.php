<html> 	
	<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script>
		function validate()
		{
		if(document.getElementById('company').value =='' || document.getElementById('company').value==null)
		{
			alert('Enter company name');
			return false;
		}
		}
	</script>
	<style>
		.tablewidth 
		{ 	 
			width:15em; 
			word-wrap:break-word;
			word-break: break-all; 	 	
		} 
	</style>
	</head>
		<div style="float:left;margin-top:50px;margin-left:-200px;width:250px">
		
			<table>
			<tr>
				<td>
					<button onclick="window.location.href='?page=master'">Product Master</button>
				</td>
			</tr>
			<tr>
				<td>
					<button onclick="window.location.href='?page=mastersub'">Sub Product</button>
				</td>
			</tr>
			<tr>
				<td>
					<button onclick="window.location.href='?page=master_description'">Description Master</button>
				</td>
			</tr>
			<tr>
				<td>
					<button onclick="window.location.href='?page=modeofpayment'">Mode Of Payment</button>
				</td>
			
			</tr>
			
			<tr>
				<td>
					<button onclick="window.location.href='?page=categorymaster'">Category Master</button>
				</td>
			</tr>
			<tr>
				<td>
					<button onclick="window.location.href='?page=itemmaster'">Items Company Master</button>
				</td>
			</tr>
			<tr>
				<td>
					<button onclick="window.location.href='?page=masterassignee'">Assignee Management</button>
				</td>
			</tr>
			<tr>
				<td>
					<button onclick="window.location.href='?page=masterstatus'">Status Management</button>
				</td>
			</tr>
		</table>
			</div>
			<h1>
			ItemCompanyMaster
		</h1>
	<body> 
		<form action="" method="POST">
			<?php
			include"config.php";
			$i=1;
			if($_POST['submit'])
			{
				mysql_query("INSERT INTO inventory_itemcompanymaster (companyname) VALUES ('".$_POST['company']."')");
				//echo'<script>alert("Inserted Successfully")</script>';
				header('Location: ?page=itemmaster');
			}
			if($_GET['id'])
			{
				$sql_update = mysql_query("SELECT * FROM inventory_itemcompanymaster WHERE id='".$_GET['id']."'");
				$row_update = mysql_fetch_array($sql_update);
			if($_POST['update'])
			{
				$sql_upd = mysql_query("UPDATE inventory_itemcompanymaster SET companyname='".$_POST['company']."' WHERE id='".$_GET['id']."'");
				header('Location: ?page=itemmaster');
			}
			}
			if($_GET['delete'])
			{
				mysql_query("DELETE FROM inventory_itemcompanymaster WHERE id='".$_GET['delete']."'");
				header("Location: ?page=itemmaster");
			}
			$sql_sel = mysql_query("SELECT * FROM inventory_itemcompanymaster");
			if(mysql_num_rows($sql_sel)==0)
				echo'<strong>NO VALUES</strong>';
			else
			{
			echo '<div style="float:left;"><table border="1"  align="left" class="paginate sortable full1">
				<tr>
				<td><strong>slno</strong></td>
				<td><strong>ItemMaster</strong></td>
				</tr>';
			while($row_sel = mysql_fetch_array($sql_sel))
				echo'<tr>
				<td>'.$i++.'</td>
				<td class="tablewidth">'.$row_sel['companyname'].'</td>
				<td><a href="?page=itemmaster&id='.$row_sel['id'].'"><img src="images/edit.png" title="edit" /></a></td>
				<td><a href="?page=itemmaster&delete='.$row_sel['id'].'"><img src="images/delete.png" title="delete" /></a></td>
				</tr>';
			}
			echo'</table><br /><br />'; 
			if($_GET['id'])
				echo'<input type="text" id="company" name="company" value="'.$row_update['companyname'].'">
				<input type="submit" name="update" value="Updatecompanyname" onclick="return validate()">';
			else
				echo'<input type="text" id="company" name="company" value="">
				<input type="submit" name="submit" value="Addcompanyname" onclick="return validate()"></div>';
			 ?>
		</form>
	</body>
</html>