<?php
	session_start();
	$_SESSION['Client'] = "Bangalore Baptist Hospital Leave Display System";
	include("includes/Config.php");
	ini_set("display_errors","0");
	include("includes/Login_Queries.php");
	if($_SESSION['id'])
		header("Location:index.php");
	else if(isset($_POST["posting"]))
	{
		$UserName = mysql_real_escape_string($_POST["username"]); //$var2=md5($_POST["password"]);
		$Password = mysql_real_escape_string($_POST["userpassword"]);
		$User_Data = User_Login($UserName, $Password);
		if($User = mysql_fetch_assoc($User_Data))
		{
			$_SESSION['id'] = $User['id'];
			$_SESSION['name'] = $User['firstname'];
			$_SESSION['role'] = $User['role'];
			header("Location:index.php");
		}
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>BBH Maintenance : Login</title>
		<link rel="stylesheet" media="screen" href="css/reset.css" />
		<link rel="stylesheet" media="screen" href="css/style.css" />
		<link rel="stylesheet" media="screen" href="css/messages.css" />
		<link rel="stylesheet" media="screen" href="css/forms.css" />
		<script src="js/html5.js"></script>
	</head>
	<body class="login">
		<div style="float:right;" class="login-box">
			<div class="login-hd"><h2>Bangalore Baptist Hospital <br /> <br />Leave Display System</h2></div><br />
			<div class="login-hd"><h3>Login Here</h3></div>
			<div class="login-box-top">
				<?php
				if(isset($_POST["posting"]) && !$_SESSION['id'])
					echo "<div class='message error'>Invalid Username or Password!!!</div>";
				?>
				<form id="form"  action="Login.php" method="post">
					<p>
						<input type="text" name="username" id="username" class="full" value="" required="required" placeholder="Username" onkeypress="return isAlphaOrNumeric(event)"/>
					</p>
					<p>
						<input type="password" name="userpassword" id="password" class="full" value="" required="required" placeholder="Password" />
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
			<div class="login-hd"><h4>Designed and developed by <a href="http://www.pentamine.com" target="_blank">Pentamine Technologies Pvt. Ltd.</a></h4></div>
		</div>
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
	function basicPopup(url) 
	{
		popupWindow = window.open(url,'popUpWindow','height=475,width=650,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes')
	}
</script>