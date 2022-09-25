<?php
	include("config.php");
	ini_set( "display_errors", "0" );
	$date = date("Y-m-d");
	if($_POST['name'] && $_POST['submit'])
	{
		$count = mysql_query("SELECT id FROM client ORDER BY id DESC");
		$idval = mysql_fetch_array($count);
		$var = "PTCID-00".($idval['id']+1);
		mysql_query("INSERT INTO client VALUES('null','".$var."','".htmlspecialchars($_POST['name'])."','".htmlspecialchars($_POST['address'])."','".$_POST['email']."','".htmlspecialchars($_POST['phone1'])."','".htmlspecialchars($_POST['phone2'])."',
		'".htmlspecialchars($_POST['pname'])."','".htmlspecialchars($_POST['pos'])."','".$_POST['pnum']."','".$_POST['pemail']."','".$_POST['pname1']."','".$_POST['pos1']."','".$_POST['pnum1']."','".htmlspecialchars($_POST['ref'])."','".$date."')");
	}
	if($_POST['update'])
	{
		mysql_query("UPDATE client SET cname='".$_POST['name']."',caddress='".$_POST['address']."',cemail='".$_POST['email']."',cnum1='".$_POST['phone1']."',cnum2='".$_POST['phone2']."',
		cpname1='".$_POST['pname']."',cppos1='".$_POST['pos']."',cpnum1='".$_POST['pnum']."',cpemail1='".$_POST['pemail']."',cpname2='".$_POST['pname1']."',cppos2='".$_POST['pos1']."',cpnum2='".$_POST['pnum1']."',reference='".$_POST['ref']."' WHERE ptcid='".$_POST['ptcid']."'");
		echo '<script type="text/javascript">alert("PTC-ID is '.$_POST['ptcid'].'\n\n Successfully Updated."); </script>
		PTC-ID is '.$_POST['ptcid'].' Successfully Updated';
	}
	if($_GET['ptcid'] && $_GET['edit'])
	{
		$query = mysql_query("SELECT * FROM client WHERE ptcid='".$_GET['ptcid']."'");
		$row = mysql_fetch_array($query);
	}
	/*if($_GET['del'])
	{
		mysql_query("DELETE FROM client WHERE ptcid='".$_GET['ptcid']."'");
	}*/
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
			<script>
				/*function isNumberKey(evt)
				{
					var charCode = (evt.which) ? evt.which : event.keyCode;
					if (charCode > 31 && (charCode < 48 || charCode > 57))
						return false;
					else
						return true;
				}*/
				var clientstatus = Array("Please Enter Company Name..!", "Company Name Already Exists"), response = 0;
				function existClient(str)
				{
					if(window.XMLHttpRequest)
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
							if(xmlhttp.responseText)
							{
								response = xmlhttp.responseText;
								if(response != 2)
								{
									alert(clientstatus[response]);
									document.getElementById('name').focus();
								}
								else
									return true;
							}
						}
					}
					xmlhttp.open("GET","includes/existclient.php?name="+str,true);
					xmlhttp.send();
				}
				function validateForm(form)
				{
				/*	var ul = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
					if(!ul.test(form.url.value))
					{
						alert("Please enter valid URL ! EX:http://www.pentamine.com ");
						form.url.focus();
						return false;
					}*/
					/*if(form.name.value == "") 
					{
						alert("Please enter Company Name!");
						form.name.focus();
						return false;
					}*/
					if(response != 2)
					{
						alert(clientstatus[response]);
						form.name.focus();
						return false;
					}
					if(form.address.value == "") 
					{
						alert("Please enter Address!");
						form.address.focus();
						return false;
					}
					if(form.email.value == "") 
					{
						alert("Please Enter Email!");
						form.email.focus();
						return false;
					}					
					var mail=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{1,}))$/;
					if(!mail.test(form.email.value))
					{
						alert("Please Enter Valid-Email!");
						form.email.focus();
						return false;
					}
					if(form.phone1.value == "") 
					{
						alert("Please enter phone number!");
						form.phone1.focus();
						return false;
					}
						if(form.phone1.value.length < 10) 
					{
						alert("Please Enter Correct Phone Number!");
						form.phone1.focus();
						return false;
					}
					re = /^[A-z- ]+$/;
						if(form.pname.value == "") 
					{
						alert("Please enter Contact Person name!");
						form.pname.focus();
						return false;
					}
					if(!re.test(form.pname.value)) 
					{
						alert(" Contact Person Accepts only name");
						form.pname.focus();
						return false;
					}
					if(form.pos.value == "") 
					{
						alert("Please enter Contact Person Position!");
						form.pos.focus();
						return false;
					}
					if(form.pnum.value == "") 
					{
						alert("Please enter phone number!");
						form.pnum.focus();
						return false;
					}
					if(form.pnum.value.length < 10) 
					{
						alert("Please Enter Correct Phone Number!");
						form.pnum.focus();
						return false;
					}
					
				}
			</script>
	</head>
	<body style="background-color:#d0e4fe;">
	<div class="grid_6 first">
		<form action="?page=clients" method="POST" onSubmit="return validateForm(this);" name="form" class="form panel" id="form">   
			<?php
			if($var)
			echo '<script type="text/javascript">alert("PTC-ID is '.$var.'\n\n Successfully Submitted."); </script>
			PTC-ID is '.$var.' Successfully Submitted';			
			?>
			<header>
				<h2>Client Management</h2>
			</header>
			<hr>
			<fieldset>
				<div class="clearfix">
					<label>Company Name:</label>
					<?php
						echo '<input type="text" name="name" id="name" onblur="return existClient(this.value)"  value="'.$row['cname'].'" autocomplete="off">';
					?>
				</div>
				<div class="clearfix">
					<label>Company Address:</label>
					<?php
						echo '<textarea cols="90" rows="5" name="address" id="text">'.$row['caddress'].'</textarea>';
					?>
				</div>
				<div class="clearfix">
					<label>E-Mail:</label>
					<?php
						echo '<input type="text"  name="email" value="'.$row['cemail'].'" autocomplete="off">';
					?>
				</div>
				<div class="clearfix">
					<label>Contact  Phone Number 1:</label>
					<?php
						echo '<input type="text"  name="phone1" value="'.$row['cnum1'].'" onkeypress="return isNumberKey(event)" autocomplete="off">';
					?>
				</div>
				<div class="clearfix">
					<label>Contact  Phone Number 2:</label>
					<?php
						echo '<input type="text"  name="phone2" value="'.$row['cnum2'].'" onkeypress="return isNumberKey(event)" autocomplete="off">';
					?>
				</div>
				<div class="clearfix">
					<label>Contact Person Name:</label>
					<?php
						echo'<input type="text"  name="pname" value="'.$row['cpname1'].'"autocomplete="off">';
					?>
				</div>
				<div class="clearfix">
					<label>Contact Person Position:</label>
					<?php
						echo'<input type="text"  name="pos" value="'.$row['cppos1'].'"autocomplete="off">';
					?>
				</div>
				<div class="clearfix">
					<label>Contact Person Number:</label>
					<?php
						echo'<input type="text"  name="pnum" value="'.$row['cpnum1'].'" onkeypress="return isNumberKey(event)"autocomplete="off">';
					?>
				</div>
				<div class="clearfix">
					<label>Contact Person Mail-ID:</label>
					<?php
						echo'<input type="text"  name="pemail" value="'.$row['cpemail1'].'"autocomplete="off">';
					?>
				</div>
				<div class="clearfix">
					<label>Contact Person Name:</label>
					<?php
						echo'<input type="text"  name="pname1" value="'.$row['cpname2'].'"autocomplete="off">';
					?>
				</div>
				<div class="clearfix">
					<label>Contact Person Position:</label>
					<?php
						echo'<input type="text"  name="pos1" value="'.$row['cppos2'].'"autocomplete="off">';
					?>
				</div>
				<div class="clearfix">
					<label>Contact Person Number:</label>
					<?php
						echo'<input type="text"  name="pnum1" value="'.$row['cpnum2'].'" onkeypress="return isNumberKey(event)"autocomplete="off">';
					?>
				</div>
				<div class="clearfix">
					<label>Reference:</label>
					<?php	
						echo'<input type="text"  name="ref" value="'.$row['reference'].'" autocomplete="off">';
					?>
				</div>
			</fieldset>	
			<hr>
					<?php
						if($_GET['edit'])
						{
							echo '<input type="hidden" name="ptcid" value="'.$_GET['ptcid'].'">';
							echo '<button class="button button-green" type="submit" name="update" value="update">Update</button>';
						}
						else
							echo '<button class="button button-green" type="submit" name="submit" value="submit">Submit</button>';
					?>
			</form>
		</div>
	</body>
</html>
<br />
<br />
<br />
<?php
		$result = mysql_query("SELECT * FROM client");
		if(!mysql_num_rows($result))
			echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
		$rowsperpage = 10;
		$total_pages = ceil(mysql_num_rows($result) / $rowsperpage);
			
		if($_GET['pageno']>1)
			$Limit = "LIMIT ".(($_GET['pageno']-1)*$rowsperpage).",".$rowsperpage;
		else
			$Limit = "LIMIT 0,".$rowsperpage;
					
		$query = mysql_query("SELECT * FROM client ORDER BY id Desc $Limit");
		if(mysql_num_rows($query))
		{
			echo "<div style='width:1350px;height:550px;overflow-x:scroll;overflow-y:auto;'>
				  <table border='1'  align= 'left' class='paginate sortable full' width='20'>
					<tr>
						<th>PTC-ID</th>
						<th>Company Name</th>
						<th style='width:10px;'>Company Address</th>
						<th>E-Mail</th>
						<th>Contact  Phone Number 1</th>
						<th>Contact  Phone Number 2</th>
						<th>Contact Person Name</th>
						<th>Contact Person Position</th>
						<th>Contact Person Number</th>
						<th>Contact Person Mail-ID</th>
						<th>Contact Person Name</th>
						<th>Contact Person Position</th>
						<th>Contact Person Number</th>
						<!--th>Contact Person Mail-ID</th-->
						<th>Reference</th>
					</tr>";
		}
		while($row = mysql_fetch_array($query))
		{
		echo    "<tr>
					<td>".$row['ptcid']."</td>
					<td style='width:10px;'>".$row['cname']."
					</td>
					<td>".$row['caddress']."
					</td>
					<td>".$row['cemail']."
					</td>
					<td>".$row['cnum1']."
					</td>
					<td>".$row['cnum2']."
					</td>
					<td>".$row['cpname1']."
					</td>
					<td>".$row['cppos1']."
					</td>
					<td>".$row['cpnum1']."
					</td>
					<td>".$row['cpemail1']."
					</td>
					<td>".$row['cpname2']."
					</td>
					<td>".$row['cppos2']."
					</td>
					<td>".$row['cpnum2']."
					</td>
					<!--td>".$row['cpemail2']."
					</td-->
					<td>".$row['reference']."
					</td>
					<td>
						<a href='?page=clients&ptcid=".$row['ptcid']."&edit=1'><img src='images/edit.png' title='edit' /></a><br />
						<!--a href='?ptcid=".$row['ptcid']."&del=1'><img src='images/delete.png' title='delete' /></a-->
					</td>
				</tr>";
		}
		echo "</table></div>";
		echo '<div style="float:left;margin-top:50px;margin-left:450px;width:2000px">';
		include("includes/pagination.php");
		echo '</div>';
?>