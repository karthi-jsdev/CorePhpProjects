<?php
include("config.php");
	ini_set( "display_errors", "0" );
if($_POST['addproduct1'])
	{
		$count = mysql_query("SELECT slno FROM productsubtype ORDER BY slno DESC");
		$idval = mysql_fetch_array($count);
		$var = $idval['slno']+1;
		mysql_query("insert into productsubtype values ('null','".$var."','".$_POST['type']."','".$_POST['ptype']."')");
	}
	if($_POST['update1'])
	{
		mysql_query("UPDATE productsubtype SET type='".$_POST['type']."' WHERE slno='".$_POST['slno']."'");
		echo '<script type="text/javascript">alert("Product Type is '.$_POST['type'].'\n\n Successfully Updated."); </script>
			Product Type is '.$_POST['type'].' Successfully Updated';
	}
	if($_GET['slno'] && ($_GET['edit']==2))
	{
		$query1 = mysql_query("SELECT * FROM productsubtype WHERE slno='".$_GET['slno']."'");
		$row2 = mysql_fetch_array($query1);
	}
	if(($_GET['del']==2) && ($_GET['id']))
		mysql_query("DELETE FROM productsubtype WHERE id='".$_GET['id']."'");
?>
<html>
<head>
<script>
	function productdelete(id)
	{
		if(confirm("Do your really want to delete your account?"))
			window.location.assign("?page=mastersub&del=2&id="+id);
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
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
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
					<button onclick="window.location.href='?page=itemmaster'">Item Company Master</button>
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
		<form action="?page=mastersub" method="POST">
			
			<div style="float:left;margin-top:50px;margin-left:100px;width:270px">
				<h2>Sub-Product Management</h2>
				Product Type:
				<select name="ptype" onchange="product_change(this.value)">
					<option value="Select" >Select</option>
					<?php
					$query=mysql_query("select * from producttype");
					while($row=mysql_fetch_array($query))
					{
						if(($_GET['edit']==2) && $row2['type_id'] == $row['slno'])
							echo "<option value='".$row['slno']."' selected>".$row['type']."</option>";
						else
							echo "<option value='".$row['slno']."'>".$row['type']."</option>";
					}
					?>
				</select> 
				<?php
				if((!$_GET['edit']==2))
					echo '<div id="sub">
							</div>';
				elseif($_GET['slno'] && ($_GET['edit']==2))
				{
					echo "<table><tr> <td>
					<!--input type='text' name='slno' value='".$row2['slno']."'></td-->
					<td> <input type='text' name='type' value='".$row2['type']."'></td>";
					/*echo "<td><a href='?page=master&slno=".$row1['slno']."&del=1'><img src='images/delete.png' title='delete' /></a></td>";
					echo 	"<td>
						<a href='?page=master&slno=".$row1['slno']."&edit=1'><img src='images/edit.png' title='edit' /></a><br />
						*/
					echo "</tr></table>";
				}
				if(!($_GET['edit'] == 2))
					echo '<input type="text" name="type" autocomplete="off">
						<input type="submit" value="Add Sub-Product" name="addproduct1">';
				else
				{
					echo '<input type="hidden"  name="update1" value="1">
					<input type="hidden" name="slno" value="'.$_GET['slno'].'">';
					echo '<input type="submit" value="Update">';
				}
				?>
			</div>
			
						
		</form>
</html>