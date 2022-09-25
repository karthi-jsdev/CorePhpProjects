<html>
	<head>
	<script>
			function productdelete(slno)
		{
			if(confirm("Do your really want to delete your account?"))
				window.location.assign("?page=modeofpayment&delete="+slno);
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
		<link rel="stylesheet" type="text/css" href="style.css">
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
		<h1>Mode Of Payment</h1>
	<body>
		<form action="" method="POST">
			<?php
				include "config.php";
				ini_set( "display_errors", "0" );
				if($_GET['delete'])
				{
					mysql_query("DELETE FROM finance_modeofpayment where slno=".$_GET['delete']);				  	
					header('Location:?page=modeofpayment');
				} 	
				if($_POST['submit'])
				{
					$row_sel = mysql_fetch_array(mysql_query("SELECT * FROM finance_modeofpayment ORDER BY slno DESC"));
					$sql_ins = mysql_query("INSERT INTO finance_modeofpayment (slno, modeofpayment) VALUES ('".($row_sel['slno']+1)."', '".$_POST['modeofpayment']."')");
					$_GET['id']=NULL;
				}
				else if($_POST['update'] && $_GET['id'])
				{
					$sql_ins = mysql_query("UPDATE finance_modeofpayment SET modeofpayment='".$_POST['modeofpayment']."' WHERE slno=".$_GET['id']);
					echo '<script type="text/javascript">alert("Mode Of Payment is '.$_POST['modeofpayment'].'\n\n Successfully Updated."); </script>
					Mode Of Payment is '.$_POST['modeofpayment'].' Successfully Updated';
					$_GET['id']=NULL;
				}
				$sql = mysql_query("SELECT * FROM finance_modeofpayment");
				
				echo "<div style='float:left;'><table class='paginate sortable full1'>
					";
				while($row = mysql_fetch_assoc($sql))
				{
					echo '
					<tr>
						<td class="tablewidth">'.$row['modeofpayment'].'</td>
						<td align="center"><a href="?page=modeofpayment&id='.$row['slno'].'"><img src="images/edit.png" title="edit" /></a></td>
						<td align="center"><a href="#" onClick="productdelete('.$row["slno"].')"><img src="images/delete.png" title="delete" /></a></td>
					</tr>';
				}
				echo '</table>'; 
				if($_GET['id'] && !$_POST['update'])
				{
					$Edit = mysql_fetch_array(mysql_query("SELECT * FROM finance_modeofpayment where slno=".$_GET['id']));
					echo '
					<input type="text" value="'.$Edit['modeofpayment'].'" name="modeofpayment">
					<input type="hidden" value="'.$_GET['id'].'" name="id">
					<input type="submit" name="update" value="UpdateMode">';
				}
				else
					echo'<input type="text" value="" name="modeofpayment">
					<td><input type="submit" name="submit" value="AddMode"></td></div>';
			?>
		</form>
	</body>
</html>