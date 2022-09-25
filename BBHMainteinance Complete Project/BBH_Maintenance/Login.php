<?php
	session_start();
	$_SESSION['Client'] = "Bangalore Baptist Hospital Maintenance Portal";
	include("includes/Config.php");
	ini_set("display_errors","0");
	include("includes/Login_Queries.php");
	if($_SESSION['id'])
		header("Location:index.php");
	else if(isset($_POST["posting"]))
	{
		$UserName = mysqli_real_escape_string($_SESSION['connection'],$_POST["username"]); //$var2=md5($_POST["password"]);
		$Password = mysqli_real_escape_string($_SESSION['connection'],$_POST["userpassword"]);
		$User_Data = User_Login($UserName, $Password);
		if($User = mysqli_fetch_assoc($User_Data))
		{
			$_SESSION['id'] = $User['id'];
			$_SESSION['name'] = $User['firstname'];
			$_SESSION['phone'] = $User['phonenumber'];
			$_SESSION['departmentid'] = $User['departmentid'];
			$_SESSION['roleid'] = $User['userroleid'];
			$UserRole = mysqli_fetch_assoc(User_Role($User['userroleid']));
			$_SESSION['role'] = $UserRole['role'];
			$_SESSION['departmentadmin'] = $User['deptadmin'];
			$_SESSION['groupid'] = $User['groupid'];
			$_SESSION['groups'] = $_SESSION['groupids'] = $AllGroupNames = array();
			$Groups = User_Select_AllGroups();
			while($Group = mysqli_fetch_assoc($Groups))
			{
				$AllGroupNames[] = $Group['name'];
				if($Group['defaultadmin'] == $User['id'])
				{
					$_SESSION['groups'][] = $Group['name'];
					$_SESSION['groupids'][] = $Group['id'];
				}
				else
				{
					$Admins = explode(".", $Group['admins']);
					foreach($Admins as $Admin)
						if($Admin == $User['id'])
						{
							$_SESSION['groups'][] = $Group['name'];
							$_SESSION['groupids'][] = $Group['id'];
						}
				}
			}
			if(is_numeric($_SESSION['groupid']) && !in_array($_SESSION['groupid'], $_SESSION['groupids']))
			{
				$_SESSION['groups'][] = $AllGroupNames[$_SESSION['groupid']-1];
				$_SESSION['groupids'][] = $_SESSION['groupid'];
			}
			if($_SESSION['role']!='Admin' || $_SESSION['role']!='Super Admin')
			{
				$Added_Admin = User_Select_AllGroups();
				while($Fetch_Added_Admin= mysqli_fetch_array($Added_Admin))
				{
					$Add_Admins = explode('.',$Fetch_Added_Admin['admins']);
					foreach($Add_Admins as $Add_Admin)
					{
						if($Add_Admin==$User['id'])
							$_SESSION['admin']='1';
					}
				}
			}
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
		<div>
			<div style="float:left">
				<table>
					<tr>
						<td><h2>User Guide Videos</h2></td>
					</tr>
					<tr>
						<td><strong>How to Login</strong></td>
					</tr>
					<tr>
						<td><a class="button button-orange" href="Training Videos/BBH_Login/index.html" onclick="basicPopup(this.href);return false;"><img src="images/indeximages/login.jpg" width="90px" height="45px"/></a></td>
					</tr>
					<tr>
						<td><br /><strong>How to Raise Complaint</strong></td>
					</tr>
					<tr>
						<td><a class="button button-orange" href="Training Videos/BBH_RaiseComplaint/index.html" onclick="basicPopup(this.href);return false;"><img src="images/indeximages/raisecomplaint.jpg" width="90px" height="45px"/></a></td>
					</tr>
					<tr>
						<td><br /><strong>How to CloseComplaint</strong></td>
					</tr>
					<tr>
						<td><a class="button button-orange" href="Training Videos/CloseComplaint/index.html" onclick="basicPopup(this.href);return false;"><img src="images/indeximages/CloseComplaint.jpg" width="90px" height="45px"/></a></td>
					</tr>
					<tr>
						<td><br /><strong>How to Move Ticket</strong></td>
					</tr>
					<tr>
						<td><a class="button button-orange" href="Training Videos/Move_Ticket/index.html" onclick="basicPopup(this.href);return false;"><img src="images/indeximages/moveto.jpg" width="90px" height="45px"/></a></td>
					</tr>
					<!--tr>
						<td><br /><strong>How to Create Asset</strong></td>
					</tr>
					<tr>
						<td><a class="button button-orange" href="Training Videos/Assets/index.html" onclick="basicPopup(this.href);return false;"><img src="images/indeximages/asset.jpg" width="90px" height="45px"/></a></td>
					</tr>
					<tr>
						<td><br /><strong>How to Generate Reports</strong></td>
					</tr>
					<tr>
						<td><a class="button button-orange" href="Training Videos/Reports/index.html" onclick="basicPopup(this.href);return false;"><img src="images/indeximages/Report.jpg" width="90px" height="45px"/></a></td>
					</tr-->
			</table>
		</div>
		<div style="float:right;" class="login-box">
			<div class="login-hd"><h2>Bangalore Baptist Hospital <br /> <br />Maintenance Portal</h2></div><br />
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