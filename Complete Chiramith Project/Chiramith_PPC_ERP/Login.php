<?php
	session_start();
	$_SESSION['Client'] = "CHIRAMITH PRECISION(INDIA) ERP";
	include("includes/Config.php");
	ini_set("display_errors","0");
	date_default_timezone_set('Asia/Kolkata');
	include("includes/Login_Queries.php");
	if($_SESSION['id'])
		header("Location:index.php");
	else if(isset($_POST["posting"]))
	{
		$_POST["name"] = mysql_real_escape_string($_POST["name"]); //$var2=md5($_POST["password"]);
		$_POST["password"] = mysql_real_escape_string($_POST["password"]);
		$User_Data = User_Login();
		if($User = mysql_fetch_assoc($User_Data))
		{
			$_SESSION['logindatetime'] = date("Y-m-d H:i:s");
			mysql_query("INSERT into userhistory VALUES('', '".$User['id']."','".$_SESSION['logindatetime']."','".$_SESSION['logindatetime']."','')");
			$lastlogin = mysql_fetch_array(mysql_query("SELECT logintime FROM userhistory ORDER BY id DESC LIMIT 1,1"));
			$_SESSION['lastlogin'] = substr($lastlogin['logintime'], 0, 16);
			$_SESSION['id'] = $User['id'];
			$_SESSION['name'] = $User['name'];
			$_SESSION['phone'] = $User['phone'];
			$_SESSION['roleid'] = $User['userrole_id'];
			$UserRole = mysql_fetch_assoc(User_Role($User['userrole_id']));
			$_SESSION['role'] = $UserRole['role'];
			header("Location:index.php");
		}
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title><?php echo $_SESSION['Client']; ?> : Login</title>
		<link rel="stylesheet" media="screen" href="css/reset.css" />
		<link rel="stylesheet" media="screen" href="css/style.css" />
		<link rel="stylesheet" media="screen" href="css/messages.css" />
		<link rel="stylesheet" media="screen" href="css/forms.css" />
		<script src="js/html5.js"></script>
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
	</head>
	<div><img src="images/factory.png" alt="Chiramith Factory" width="100%" height="771px"></div>
	<body class="login">
		<div class="login-box">
			<img src="images/logo.png" alt="Chiramith Logo" width="350px" height="100px">
			<div class="login-hd"><h1><font style="BACKGROUND-COLOR:#EEE" face="script MT Bold"><?php echo $_SESSION['Client'];?></font></h1></div>
			<div class="login-hd"><h3><font style="BACKGROUND-COLOR:#EEE" face="script MT Bold">Login Here</font></h3></div>
			<div class="login-box-top">
				<?php
				if(isset($_POST["posting"]) && !$_SESSION['id'])
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
			<div class="login-hd"><h4 style="BACKGROUND-COLOR:#EEE">Designed and developed by <a href="http://www.pentamine.com" target="_blank">Pentamine Technologies Pvt. Ltd.</a></h4></div>
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
	UserHistory();
	function UserHistory()
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				//document.getElementById(PaginationFor).innerHTML = xmlhttp.responseText
			}
		}
		xmlhttp.open("GET","includes/UserHistory.php", true);
		xmlhttp.send();
		setTimeout(function(){UserHistory();}, 5000);
	}
</script>

