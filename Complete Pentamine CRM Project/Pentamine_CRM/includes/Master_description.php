<html>
	<head>
	<script>
		function productdelete(slno)
	{
		if(confirm("Do your really want to delete your account?"))
			window.location.assign("?page=master_description&delete="+slno);
	}
	</script>
		<link rel="stylesheet" type="text/css" href="style.css" />
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
				<td><button onclick="window.location.href='?page=master'">Product Master</button></td>
			</tr>
			<tr>
				<td><button onclick="window.location.href='?page=mastersub'">Sub Product</button></td>
			</tr>
			<tr>
				<td><button onclick="window.location.href='?page=master_description'">Description Master</button></td>
			</tr>
			<tr>
				<td><button onclick="window.location.href='?page=modeofpayment'">Mode Of Payment</button></td>
			</tr>
			<tr> 
				<td><button onclick="window.location.href='?page=categorymaster'">Category Master</button></td> 
			</tr>
			<tr>
				<td><button onclick="window.location.href='?page=itemmaster'">Item Company Master</button> </td> 
			</tr>
			<tr>
				<td><button onclick="window.location.href='?page=masterassignee'">Assignee Management</button> </td>
			</tr>
			<tr>
				<td><button onclick="window.location.href='?page=masterstatus'">Status Management</button> </td>
			</tr>
		</table>
		</div> 
		<h1>
		Description Management
		</h1>
		<body>
			<form action="" method="POST">
				<?php
					include "config.php";
					ini_set( "display_errors", "0" );
					if($_GET['delete'])
					{
						mysql_query("DELETE FROM finance_description where slno=".$_GET['delete']);				  	
						header('Location:?page=master_description');
					} 	
					if($_POST['submit'])
					{
						$row_sel = mysql_fetch_array(mysql_query("SELECT * FROM finance_description ORDER BY slno DESC"));
						$sql_ins = mysql_query("INSERT INTO finance_description (slno, description_name) VALUES ('".($row_sel['slno']+1)."', '".$_POST['description_name']."')");
					}
					else if($_POST['update'])
					{
						$sql_ins = mysql_query("UPDATE finance_description SET description_name='".$_POST['description_name']."' WHERE slno=".$_POST['id']);
						echo '<script type="text/javascript">alert("Description Type is '.$_POST['description_name'].'\n\n Successfully Updated."); </script>
						Description Type is '.$_POST['description_name'].' Successfully Updated';
						header('Location:?page=master_description ');
					}
					$sql = mysql_query("SELECT * FROM finance_description");					
					echo "<div style='float:left;'><table class='paginate sortable full1'>
						";
					while($row = mysql_fetch_assoc($sql))
					{
						echo '
						<tr>							
							<td class="tablewidth">'.$row['description_name'].'</td>
							<td align="center"><a href="?page=master_description&id='.$row['slno'].'"><img src="images/edit.png" title="edit" /></a></td>
							<td align="center"><a href="#"  onClick="productdelete('.$row["slno"].')"><img src="images/delete.png" title="delete" /></a></td>
						</tr>';
					}
					echo '</table>'; 
					if($_GET['id'] && !$_POST['update'])
					{
						$Edit = mysql_fetch_array(mysql_query("SELECT * FROM finance_description where slno=".$_GET['id']));
						echo '
						<input type="text" value="'.$Edit['description_name'].'" name="description_name">
						<input type="hidden" value="'.$_GET['id'].'" name="id">
						<input type="submit" name="update" value="UpdateDescription">';
					}
					else
						echo '
						<input type="text" value="" name="description_name">
						<input type="submit" name="submit" value="AddDescription"></div>';
				?>
		</form>
	</body>
</html>