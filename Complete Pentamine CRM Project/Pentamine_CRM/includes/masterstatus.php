<?php
include("config.php");
	ini_set( "display_errors", "0" );
if($_POST['addstatus'])
	{
		$count = mysql_query("SELECT slno FROM status ORDER BY slno DESC");
		$idval = mysql_fetch_array($count);
		$var = $idval['slno']+1;
		mysql_query("insert into status values ('null','".$var."','".$_POST['status']."')");		
	}
	if($_POST['update3'])
	{
		mysql_query("UPDATE status SET status='".$_POST['status']."' WHERE slno='".$_POST['slno']."'");
		echo 'status Name is '.$_POST['status'].' Successfully Updated';
	}	
	if($_GET['slno'] && ($_GET['edit'] == 4))
	{
		$query = mysql_query("SELECT * FROM status WHERE slno='".$_GET['slno']."'");
		$row1 = mysql_fetch_array($query);
	}	
	if(($_GET['del'] == 4) && ($_GET['id']))
		mysql_query("DELETE FROM status WHERE id='".$_GET['id']."'");
		?>
		<html>
<head>
<script>
function productdelete(id)
	{
		if(confirm("Do your really want to delete your account?"))
			window.location.assign("?page=masterstatus&del=4&id="+id);
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
	</div>	<body style="background-color:#d0e4fe;">	
		<form action="?page=masterstatus" method="POST">
			
					<div style="float:left;margin-top:100px;margin-left:100px;width:300px">
						<h2>Status Management</h2>
							<table class='paginate sortable table2'>
							<tr><th>Status</th></tr>
						</tr>
							<?php
								if(!($_GET['edit']==4))
								{
									$query=mysql_query("select * from status");
									while($row=mysql_fetch_array($query))
									{
											echo "<tr><td>".$row['status']."</td>";
											echo "<td><a href='?page=masterstatus&slno=".$row['slno']."&edit=4'><img src='images/edit.png' title='edit' /></a></td>";
											echo 	"<td>
												<a href='#'onClick='productdelete(".$row["id"].")'><img src='images/delete.png' title='delete' /></a><br />
											</td></tr>";
									}
								}
								elseif($_GET['slno'] && ($_GET['edit']==4))
								{
									echo "<tr>
									<td> <input type='text' name='status' value='".$row1['status']."'></td>";
									echo "<td><a href='?page=masterstatus&slno=".$row1['slno']."&edit=4'><img src='images/edit.png' title='edit' /></a></td>";
									echo 	"<td>
										<a href='#' onClick='productdelete(".$row["id"].")'><img src='images/delete.png' title='delete' /></a><br />
									</td></tr>";
								}
								?>
								</table>
								<?php
								if(!($_GET['edit']==4))
									echo	'<input type="text" name="status">
										<input type="submit" value="Add Status" name="addstatus">';
								else
								{
									echo '<input type="hidden"  name="update3" value="1">
									<input type="hidden" name="slno" value="'.$_GET['slno'].'">';
									echo '<input type="submit" value="Update" >';
								}
							?>
						</table>
					</div>
						
		</form>
</html>