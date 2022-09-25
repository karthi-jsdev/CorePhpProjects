<?php
include("config.php");
	ini_set( "display_errors", "0" );
if($_POST['addassignee'])
	{
		$count = mysql_query("SELECT slno FROM assignee ORDER BY slno DESC");
		$idval = mysql_fetch_array($count);
		$var = $idval['slno']+1;
		mysql_query("insert into assignee values ('null','".$var."','".$_POST['assignee']."')");		
	}
	if($_POST['update2'])
	{
		mysql_query("UPDATE assignee SET name='".$_POST['name']."' WHERE slno='".$_POST['slno']."'");
		echo 'Assignee Name is '.$_POST['name'].' Successfully Updated';
	}	
	if($_GET['slno'] && ($_GET['edit'] == 3))
	{
		$query = mysql_query("SELECT * FROM assignee WHERE slno='".$_GET['slno']."'");
		$row1 = mysql_fetch_array($query);
	}	
	if(($_GET['del'] == 3) && ($_GET['id']))
		mysql_query("DELETE FROM assignee WHERE id='".$_GET['id']."'");
		?>
		<html>
<head>
<script>
function productdelete(id)
	{
		if(confirm("Do your really want to delete the assignee?"))
			window.location.assign("?page=masterassignee&del=3&id="+id);
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
		<form action="?page=masterassignee" method="POST">
			
			<div style="float:left;margin-top:50px;margin-left:100px;width:300px">
				<h2>Assignee Management</h2>
							<table class='paginate sortable table2'>
							<tr><th>Assignee Name</th></tr>
						</tr>
							<?php
								if(!($_GET['edit']==3))
								{
									$query1=mysql_query("select * from assignee");
									while($row=mysql_fetch_array($query1))
									{
											echo "<tr><td>".$row['name']."</td>";
											echo "<td><a href='?page=masterassignee&slno=".$row['slno']."&edit=3'><img src='images/edit.png' title='edit' /></a></td>";
											echo 	"<td>
												<a href='#' onClick='productdelete(".$row["id"].")'><img src='images/delete.png' title='delete' /></a><br />
											</td></tr>";
									}
								}
								elseif($_GET['slno'] && ($_GET['edit']==3))
								{
									echo "<tr>
									<td> <input type='text' name='name' value='".$row1['name']."'></td>";
									echo "<td><a href='?page=masterassignee&slno=".$row1['slno']."&edit=3'><img src='images/edit.png' title='edit' /></a></td>";
									echo 	"<td>
										<a href='#' onClick='productdelete(".$row1['id'].")'><img src='images/delete.png' title='delete' /></a><br />
									</td></tr>";
								}
								?>
								</table>
								<?php
								if(!($_GET['edit']==3))
									echo	'<input type="text" name="assignee">
										<input type="submit" value="Add Assignee" name="addassignee">';
								else
								{
									echo '<input type="hidden"  name="update2" value="1">
									<input type="hidden" name="slno" value="'.$_GET['slno'].'">';
									echo '<input type="submit" value="Update" >';
								}
							?>
						</table>
					</div>
					
						
		</form>
</html>