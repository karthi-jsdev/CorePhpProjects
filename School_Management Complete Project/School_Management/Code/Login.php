<?php
	session_start();
	$_SESSION['SM_Client'] = "SCHOOL MANAGEMENT";
	include("includes/Config.php");
	ini_set("display_errors","0");
	include("includes/Login_Queries.php");
	if($_SESSION['SM_id'])
		header("Location:index.php");
	else if(isset($_POST["posting"]))
	{
		$_POST["name"] = mysql_real_escape_string($_POST["name"]); //$var2=md5($_POST["password"]);
		$_POST["password"] = mysql_real_escape_string($_POST["password"]);
		$User_Data = User_Login();
		if($User = mysql_fetch_assoc($User_Data))
		{
			$_SESSION['SM_id'] = $User['id'];
			$_SESSION['SM_name'] = $User['name'];
			$_SESSION['SM_phone'] = $User['phone'];
			$_SESSION['SM_roleid'] = $User['userrole_id'];
			$UserRole = mysql_fetch_assoc(User_Role($User['userrole_id']));
			$_SESSION['SM_role'] = $UserRole['role'];
			header("Location:index.php");
		}
	}
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title><?php echo $_SESSION['SM_Client']; ?> : Login</title>
		<link rel="stylesheet" media="screen" href="css/reset.css" />
		<link rel="stylesheet" media="screen" href="css/style.css" />
		<link rel="stylesheet" media="screen" href="css/messages.css" />
		<link rel="stylesheet" media="screen" href="css/forms.css" />
		<script src="js/html5.js"></script>
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
	</head>
	<body class="login">
		<div style="float:left;margin-top:0px;margin-left:550px;">
			<img src="images/Picture4.jpg" width="300px" height="300px" style="align:right;">
		</div>
		<div class="login-box">
			<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
			<div class="login-hd"><h2><?php echo $_SESSION['SM_Client'];?></h2></div>
			<div class="login-hd"><h3>Login Here</h3></div>
			<div class="login-box-top">
				<?php
				if(isset($_POST["posting"]) && !$_SESSION['SM_id'])
					echo "<div class='message error'>Invalid Username or Password!!!</div>";
				?>
				<form id="form"  action="Login.php" method="post">
					<p>
						<input type="text" name="name" id="name" class="full" value="" required="required" placeholder="Username" onkeypress="return isAlphaOrNumeric(event)"/>
					</p>
					<p>
						<input type="password" name="password" id="password" class="full" value="" required="required" placeholder="Password" />
					</p>
					<p class="clearfix">
						<center>
							<input class="button button-gray" type="submit" value="Submit" />
						</center>
						<input type="hidden" name="posting" id="posting" value="1" />
					</p>
				</form>
			</div>
			<br /><br /><br />
			<div class="login-hd"><h4><font color=""  style="">Designed and developed by </font><a href="http://www.pentamine.com" target="_blank"><font color=""  style=""><br/>Pentamine Technologies Pvt. Ltd.</a></h4></div></font>
		</div>
	</body>
</html>

<script>
	function isAlphaOrNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return true;
	}
</script>