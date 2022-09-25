<html>
	<head>
	<link rel="stylesheet" type="text/css" href="style.css">
		<script>
			function validate()
			{
				var ca = document.getElementById('category_Value').value;
				if(ca==null || ca=='')
				{
					alert(' Value Required');
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
<body>
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
	<form action="" method="POST">
		<?php
			include"config.php";
			$i=1;
			echo'<h1>CATEGORY MASTER</h1>';
			if($_GET['id'])
			{
				$sel = mysql_query("SELECT * FROM vendor_category WHERE id='".$_GET['id']."'");
				$r_sel = mysql_fetch_array($sel);
				if($_POST['update'])
				{	
					$up = mysql_query("UPDATE vendor_category SET Categoryname='".$_POST['category_name']."' WHERE id='".$_GET['id']."'");
					header("Location: ?page=categorymaster");
				}
			}
			if($_GET['delete'])
			{
				mysql_query("DELETE FROM vendor_category WHERE id='".$_GET['delete']."'");
				header("Location: ?page=categorymaster");
			}	
			if($_POST['submit'])
				mysql_query("INSERT INTO vendor_category (Categoryname) values ('".$_POST['category_name']."')");
			echo '<div style="float:left;"><table class="paginate sortable full1">
				
					<tr>
						<th>slno</th>
						<th>Categoryname</th>
					</tr>';		
			$sql_cat = mysql_query("SELECT * FROM vendor_category");
			while($row_cat = mysql_fetch_array($sql_cat))
			{
				echo '<tr>
						<td>'.$i++.'</td>
						<td class="tablewidth">'.$row_cat['Categoryname'].'</td>
						<td><a href="?page=categorymaster&id='.$row_cat['id'].'"><img src="images/edit.png" title="edit" /></a></td>
						<td><a href="?page=categorymaster&delete='.$row_cat['id'].'"><img src="images/delete.png" title="edit" /></a></td>
					</tr>';
			}
			echo '</table><br/>'; 
			 
			if($_GET['id'])
			{
				echo'<input type="text" id="category_Value" value="'.$r_sel['Categoryname'].'" name="category_name">
				<input type="submit" name="update" value="updatedname" onclick="return validate()">';
			}
			else
			{
				echo '<input type="text" id="category_Value" value="" name="category_name">
				  <input type="submit" name="submit" value="AddCategory" onclick="return validate()"></div>';
			}
			
		?>
		</div>
		</form>	
	</body>
</html>