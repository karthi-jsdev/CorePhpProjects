<?php
	include("config.php");
	if($_POST['empsubmit'])
	{
		$count = mysql_query("SELECT id FROM employee ORDER BY id DESC");
		$idval = mysql_fetch_array($count);
		$var = "PTEID-00".($idval['id']+1);
		mysql_query("INSERT INTO employee(empid,name,address,pnum,pemail,cemail,date,qualification,dob,anniversary)  VALUES('".$var."','".htmlspecialchars($_POST['name'])."','".htmlspecialchars($_POST['address'])."','".$_POST['pnum']."','".$_POST['pemail']."','".$_POST['cemail']."',
		'".$_POST['date']."','".$_POST['qualification']."','".$_POST['dob']."','".$_POST['adate']."')");
	}
	if($_POST['empupdate'])
	{
		mysql_query("UPDATE employee SET name='".$_POST['name']."',address='".$_POST['address']."',pnum='".$_POST['pnum']."',pemail='".$_POST['pemail']."',cemail='".$_POST['cemail']."',
		date='".$_POST['date']."',qualification='".$_POST['qualification']."',dob='".$_POST['dob']."',anniversary='".$_POST['adate']."' WHERE id='".$_POST['id']."'");
		echo '<script type="text/javascript">alert("Pentamine Employee ID is '.$_POST['id'].'\n\n Successfully Updated."); </script>
			Pentamine Employee ID is '.$_POST['id'].' Successfully Updated';
	}
	if($_GET['id'] && $_GET['empedit'])
	{
		$query = mysql_query("SELECT * FROM employee WHERE empid='".$_GET['id']."'");
		$row = mysql_fetch_array($query);
	}
?>
<html>
	<head>
		<link rel="stylesheet" href="css/datepicker/jquery.ui.core.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.datepicker.css">
		<link rel="stylesheet" href="css/datepicker/jquery.ui.theme.css">
		<link rel="stylesheet" href="css/styles1.css">
		<script src="script/datepicker/jquery-1.5.1.js"></script>
		<script src="script/datepicker/jquery.ui.core.js"></script>
		<script src="script/datepicker/jquery.ui.datepicker.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
			<script>
				function isNumberKey(evt)
				{
					var charCode = (evt.which) ? evt.which : event.keyCode;
					if (charCode > 31 && (charCode < 48 || charCode > 57))
						return false;
					else
						return true;
				}
				/*var clientstatus = Array("Please Enter Company Name..!", "Company Name Already Exists"), response = 0;
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
					var mail=/^([a-zA-Z0-9_\.\-]{1,30})+\@(([a-zA-Z0-9\-]{3,50})+\.)+([a-zA-Z0-9]{2,4})+$/;
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
						alert(" Contact Person contains only name");
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
					
				}*/
					$(document).ready(function()
			{
				$("#date").datepicker(
				{
					dateFormat: 'yy-mm-dd',
					showOn: "button",
					buttonImage: "images/calendar.png",
					buttonImageOnly: true
				});
				$("#dob").datepicker(
				{
					dateFormat: 'yy-mm-dd',
					showOn: "button",
					buttonImage: "images/calendar.png",
					buttonImageOnly: true
				});
				$("#adate").datepicker(
				{
					dateFormat: 'yy-mm-dd',
					showOn: "button",
					buttonImage: "images/calendar.png",
					buttonImageOnly: true
				});
			});
			</script>
	</head>
	<body style="background-color:#d0e4fe;">
	<?php if($row1['role'] == 'admin')
	{ ?>
	<div style="float:left;margin-top:25px;margin-left:950px;width:400px">
			<button onclick="window.location.href='?page=empsummary'">Employee Summary</button>
			<button onclick="window.location.href='?page=empleave'">Leave Permission</button>
	</div>
<div style="float:left;margin-top:0px;margin-left:-10px;width:100px">
	<div class="grid_6 first">
		<form action="?page=employee" method="POST" onSubmit="return validateForm(this);" name="form" id="form" class="form panel">   
		<!--div style="float:left;margin-top:-0px;margin-left:25px;width:450px"-->
			<?php
			if($var)
			echo '<script type="text/javascript">alert("Pentamine Employee ID is '.$var.'\n\n Successfully Submitted."); </script>
			Pentamine Employee ID is '.$var.' Successfully Submitted';
			?>
			<header>
				<h2>Employee Management</h2>
			</header>
			<hr>
			<fieldset>
				<div class="clearfix">
					<label>Name:</label>
					<?php
						echo '<input type="text" name="name" id="name" value="'.$row['name'].'" autocomplete="off">'; //  onblur="return existClient(this.value)"
					?>
				</div>
				<div class="clearfix">
					<label>Date of Birth:</label>
					<?php
						echo '<input type="text" name="dob" id="dob" value="'.$row['dob'].'" autocomplete="off">'; //  onblur="return existClient(this.value)"
					?>
				</div>
				<div class="clearfix">
					<label>Anniversary Date:</label>
					<?php
						echo '<input type="text" name="adate" id="adate" value="'.$row['anniversary'].'" autocomplete="off">'; //  onblur="return existClient(this.value)"
					?>
				</div>
				<div class="clearfix">
					<label>Address:</label>
					<?php
						echo '<textarea name="address" id="text">'.$row['address'].'</textarea>'; //
					?>
				</div>
				<div class="clearfix">
					<label>Contact Number:</label>
					<?php
						echo'<input type="text"  name="pnum" value="'.$row['pnum'].'" onkeypress="return isNumberKey(event)"autocomplete="off">'; //
					?>
				</div>
				<div class="clearfix">
					<label>Personal E-Mail ID:</label>
					<?php
						echo '<input type="text"  name="pemail"  value="'.$row['pemail'].'" autocomplete="off">'; //
					?>	
				</div>
				<div class="clearfix">
					<label>Professional E-Mail ID:</label>
					<?php
						echo '<input type="text"  name="cemail"  value="'.$row['cemail'].'" autocomplete="off">'; //value="'.$row['cemail'].'"
					?>
				</div>
				<div class="clearfix">
					<label>Date of Joining:</label>
					<?php
						echo '<input type="text"  name="date"  id="date" value="'.$row['date'].'" autocomplete="off">'; //
					?>
				</div>
				<div class="clearfix">
					<label>Qualification:</label>
					<?php
						echo'<input type="text"  name="qualification" value="'.$row['qualification'].'" autocomplete="off">'; //
					?>
				</div>
			</fieldset>
			<hr>
			<?php
					if($_GET['empedit'])
					{
						echo '<input type="hidden" name="id" value="'.$_GET['id'].'">';
						echo '<button class="button button-green" type="submit" name="empupdate" value="update">Update</button>';
					}
					else
						echo '<button class="button button-green" type="submit" name="empsubmit" value="1">Submit</button>';
				?>
			<!--/div-->
		</form>
	</div>
</div>
	</body>
</html>
<div style="float:left;margin-top:500px;margin-left:-75px;width:100px">
<?php
		$result = mysql_query("SELECT * FROM employee");
		if(!mysql_num_rows($result))
			echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
		$rowsperpage = 10;
		$total_pages = ceil(mysql_num_rows($result) / $rowsperpage);
			
		if($_GET['pageno']>1)
			$Limit = "LIMIT ".(($_GET['pageno']-1)*$rowsperpage).",".$rowsperpage;
		else
			$Limit = "LIMIT 0,".$rowsperpage;
					
		$query = mysql_query("SELECT * FROM employee ORDER BY id Desc $Limit");
		if(mysql_num_rows($query))
		{
			echo "<div style='width:1350px;height:550px;overflow-x:scroll;overflow-y:auto;'>
				  <table border='1'  align= 'left' class='paginate sortable full' width='20'>
					<tr>
						<th>Employee-ID</th>
						<th>Name</th>
						<th>Company Address</th>
						<th>Contact  Phone Number</th>
						<th>Pesonal E-Mail-ID</th>
						<th>Professional Email-ID</th>
						<th>Starting Date</th>
						<th>Qualification</th>
					</tr>";
		}
		while($row = mysql_fetch_array($query))
		{
		echo    "<tr>
					<td>".$row['empid']."</td>
					<td>".$row['name']."
					</td>
					<td>".$row['address']."
					</td>
					<td>".$row['pnum']."
					</td>
					<td>".$row['pemail']."
					</td>
					<td>".$row['cemail']."
					</td>
					<td>".$row['date']."
					</td>
					<td>".$row['qualification']."
					</td>
					<td>
						<a href='?page=employee&id=".$row['empid']."&empedit=1'><img src='images/edit.png' title='edit' /></a><br />
						<!--a href='?ptcid=".$row['ptcid']."&del=1'><img src='images/delete.png' title='delete' /></a-->
					</td>
				</tr>";
		}
		echo "</table></div>";
		echo '</div><div style="float:left;margin-top:650px;margin-left:450px;width:2000px">';
		include("includes/pagination.php");
		echo '</div>';
}
else
	include('includes/empleave.php');
?>