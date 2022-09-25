<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Pentamine Technology- Admin Panel</title>
<link rel="stylesheet" media="screen" href="../css/reset.css" />
<link rel="stylesheet" media="screen" href="../css/style.css" />
<link rel="stylesheet" media="screen" href="../css/messages.css" />
<link rel="stylesheet" media="screen" href="../css/forms.css" />
<link rel="stylesheet" media="screen" href="../css/uniform.aristo.css" />
<!--link rel="stylesheet" media="screen" href="../css/tables.css" /-->
<link rel="stylesheet" media="screen" href="../css/visualize.css" />
<link rel="stylesheet" media="screen" href="../css/action-buttons.css" />
<link rel="stylesheet" type="text/css" href="../style.css">
<!-- jquerytools -->
<script src="../js/jquery.tools.min.js"></script>
<script type="text/javascript" src="../js/jquery.uniform.min.js"></script>
<script src="../js/visualize.jQuery.js"></script>
<header id="page-header">
    <div class="wrapper">
        <h1>PENTAMINE TECHNOLOGIES ADMIN REGISTRATION</h1> 
    </div>
	<!--div id="page-subheader">
        <div class="wrapper">
            <h2>
            	<?php
            	if($_GET['page']=="" || $_GET['page']=="dashboard")
				{
					echo "Dashboard";
				} ?>
            </h2>
        </div>
    </div-->
</header>
<br/>
<html>
	<head>
		<script>
		function validateForm(form)
		{
			if(form.username.value == "") 
			{
				alert("Please enter username!");
				form.username.focus();
				return false;
			}
			if(form.password.value == "") 
			{
				alert("Please enter password!");
				form.password.focus();
				return false;
			}
			if(form.repassword.value == "") 
			{
				alert("Please enter repassword!");
				form.repassword.focus();
				return false;
			}
			if(form.password.value != form.repassword.value) 
			{
				alert("Please enter correct password!");
				form.password.focus();
				return false;
			}
		}		
		</script>	
	</head>
	<body style="background-color:#d0e4fe;">
		<form action="../login.php" method="post" onSubmit="return validateForm(this);" name="form">
			<table>
				<tr>
					<td>
						User Name:
					</td>
					<td>
						<input type="text" name="username">
					</td>
				</tr>
				<tr>
					<td>
						Password:
					</td>
					<td>
						<input type="password" name="password">
					</td>
				</tr>
				<tr>
					<td>
						Re-Type Password:
					</td>
					<td>
						<input type="password" name="repassword">
					</td>
				</tr>
				<tr>
					<td>
						Contact:
					</td>
					<td>
						<input type="text" name="contact">
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="Submit">
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>