<?php 
	session_start();
	include("includes/config.php");
		ini_set( "display_errors", "0" );
		if($_POST['username'] && !$_POST['posting'])
		{
			mysql_query("insert into user(username,password,contact,role,product) values ('".$_POST['username']."','".$_POST['password']."','".$_POST['contact']."','".$_POST['role']."','".$_POST['product']."')");
			echo "<script>alert('successfully created')</script>";
		}
	$c=0;
	if(isset($_POST["posting"]) && $_POST["posting"]=="1")
	{
		$var1=$_POST["username"];
		$var2=$_POST["password"];
		$sel="select * from user where username='".$_POST["username"]."' AND password='".$_POST["password"]."'";
		$qr=mysql_query($sel);
		if(mysql_num_rows($qr)>0) 
		{
			$arr=mysql_fetch_array($qr);
			$_SESSION['clientId']=$arr["username"];
			header("Location:index.php?page=dashboard");
		}
		else
			$c=1;
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
		<title>Pentamine Technology - Admin Panel</title>
		<link rel="stylesheet" media="screen" href="css/reset.css" />
		<link rel="stylesheet" media="screen" href="css/style.css" />
		<link rel="stylesheet" media="screen" href="css/messages.css" />
		<link rel="stylesheet" media="screen" href="css/uniform.aristo.css" />
		<link rel="stylesheet" media="screen" href="css/forms.css" />
		<script src="js/html5.js"></script>
		<!-- jquerytools -->
		<script type="text/javascript" src="js/jquery.tools.min.js"></script>
		<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
		<!--[if lte IE 9]>
		<link rel="stylesheet" media="screen" href="css/ie.css" />
		<script type="text/javascript" src="js/ie.js"></script>
		<![endif]-->
		<!--[if IE 8]>
		<link rel="stylesheet" media="screen" href="css/ie8.css" />
		<![endif]-->
		<script src="js/global.js"></script>
		<script> 
		$(document).ready(function(){
			$.tools.validator.fn("#username", function(input, value) {
				return value!='Username' ? true : {     
					en: "Please complete this mandatory field"
				};
			});
			
			$.tools.validator.fn("#password", function(input, value) {
				return value!='Password' ? true : {     
					en: "Please complete this mandatory field"
				};
			});
			$("#form").validator({ 
				position: 'top', 
				offset: [25, 10],
				messageClass:'form-error',
				message: '<div><em/></div>' // em element is the arrow
			});
		});
		</script> 
	</head>
	<body class="login">
		<div class="login-box">
		  <div class="login-hd">Pentamine Technology Login</div>
			<div class="login-box-top">
				<!--div class="message info">Type anything to log in</div-->
					 <?php 
				  if($c==1)
				  {
					echo "<div class='message error'>Invalid Username or Password!!!</div>";
				  }
				  ?>
				<form id="form"  action="login.php" method="post">
				<p>
					<input type="text" id="username"  class="full" value="" name="username" required="required" placeholder="Username" />
				</p>
				<p>
					<input type="password" id="password" class="full" value="" name="password" required="required" placeholder="Password" />
				</p>
				<p class="clearfix">
					<span class="fl" style="line-height: 23px;">
						<input type="checkbox" id="remember" class="" value="1" name="remember"/>
						<label class="choice" for="remember">Remember me?</label>
					</span>

					<input class="button button-gray fr" type="submit" value="Submit" />
					<input type="hidden" name="posting" id="posting" value="1">
				</p>
			</form>
			<table>
				<tr>
					<td>
						<strong>HELP:</strong>&nbsp;<a href="#">I forgot my password.</a>
					</td>
					<td  width='50px'></td>
				</tr>	
			</table>
			</div>
		</div>
	</body>
</html>