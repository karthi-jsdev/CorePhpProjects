<?php
	include("config.php");
	ini_set( "display_errors", "0" );
	//Product
	if($_POST['addproduct'])
	{
		$count = mysql_query("SELECT slno FROM producttype ORDER BY slno DESC");
		$idval = mysql_fetch_array($count);
		$var = $idval['slno']+1;
		mysql_query("insert into producttype values ('null','".$var."','".$_POST['type1']."')");
	}
	if($_POST['update'])
	{
		mysql_query("UPDATE producttype SET type='".$_POST['producttype']."' WHERE slno='".$_POST['slno']."'");
		echo '<script type="text/javascript">alert("Product Type is '.$_POST['producttype'].'\n\n Successfully Updated."); </script>
			Product Type is '.$_POST['producttype'].' Successfully Updated';
	}
	if($_GET['slno'] && ($_GET['edit']==1))
	{
		$query = mysql_query("SELECT * FROM producttype WHERE slno='".$_GET['slno']."'");
		$row1 = mysql_fetch_array($query);
	}
	if(($_GET['del']==1) && ($_GET['id']))
		mysql_query("DELETE FROM producttype WHERE id='".$_GET['id']."'");
	//Sub-Product
	
	//Assignee
	
	//Status
		
	
?>
<html>
<head>
<script>
	function productdelete(id)
	{
		if(confirm("Do your really want to delete your account?"))
			window.location.assign("?page=master&del=1&id="+id);
	}

	function product_change(str)
	{	
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById('sub').innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","includes/getsub1.php?id="+str,true);
		xmlhttp.send();
	}
</script>
</head>
	<link rel="stylesheet" type="text/css" href="style.css">
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
	<body style="background-color:#d0e4fe;">	
		<form action="?page=master" method="POST">
			<div style="float:left;margin-top:50px;margin-left:100px;width:250px">
				<h2>Product Management</h2>
					<table class='paginate sortable table2'>
					<tr><th>PRODUCT NAME</th></tr>
					<?php
					if(!($_GET['edit']==1))
					{
						$query=mysql_query("select * from producttype");
						while($row=mysql_fetch_array($query))
						{
							echo "<tr><td>".$row['type']."</td>
							<td><a href='?page=master&slno=".$row['slno']."&edit=1'><img src='images/edit.png' title='edit' /></a></td>
							<td><a href='#' onClick='productdelete(".$row['id'].")'><img src='images/delete.png' title='delete' /></a>
							</td></tr>";
						}
					}
					elseif($_GET['slno'] && ($_GET['edit']==1))
					{
						echo "<tr> 
						<td> <input type='text' name='producttype' value='".$row1['type']."'></td>
						<td><a href='?page=master&slno=".$row1['slno']."&edit=1'><img src='images/edit.png' title='edit' /></a></td>
						<td><a href='#' onClick='productdelete(".$row['id'].")'><img src='images/delete.png' title='delete' /></a><br />	
						</td></tr>";
					}
					?>
					</table>
					<?php
					if(!($_GET['edit']==1))
						echo '<input type="text" name="type1">
							<input type="submit" value="Add Product" name="addproduct">';
					else
					{
						echo '<input type="hidden"  name="update" value="1">
						<input type="hidden" name="slno" value="'.$_GET['slno'].'">';
						echo '<input type="submit" value="Update" >';
					} ?>
				<br />
			</div>	
		</form>
</html>