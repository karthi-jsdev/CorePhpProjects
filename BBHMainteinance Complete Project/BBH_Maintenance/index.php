<?php
	session_start();
	ini_set("display_errors","0");
	date_default_timezone_set('Asia/Kolkata');
	if(!$_SESSION['id'])
		header("Location:Login.php");
	include("includes/Config.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title><?php echo $_SESSION['Client']; ?></title>
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
		<link rel="stylesheet" media="screen" href="css/reset.css" />
		<link rel="stylesheet" media="screen" href="css/style.css" />
		<link rel="stylesheet" media="screen" href="css/messages.css" />
		<link rel="stylesheet" media="screen" href="css/forms.css" />
		<link rel="stylesheet" media="screen" href="css/uniform.aristo.css" />
		<link rel="stylesheet" media="screen" href="css/tables.css" />
		<link rel="stylesheet" media="screen" href="css/visualize.css" />
		<link rel="stylesheet" media="screen" href="css/action-buttons.css" />

		<!-- jquerytools -->
		<script src="js/jquery.tools.min.js"></script>
		<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
		<script src="js/visualize.jQuery.js"></script>
		<script type="text/javascript" src="js/global.js"></script>
		<script>
			$(document).ready(function()
			{
				$('table.visualize').visualize({type: 'line', width: '340px', height: '150px'}).css({marginLeft: '20px'});
				$('table.visualize').hide();
			});
		</script>
	</head>

	<body>
		<div id="wrapper">
			<?php include("includes/Header.php"); ?>
			<section id="content">
			    <div class="wrapper">
					<?php
						//Main Section
						if($_SESSION['id'] && $_GET['page'])
						{
							$filename = "includes/".$_GET['page'].".php";
							if(file_exists($filename))
								include($filename);
							else
								echo "Don't try to visit this website anonymously..!";
						}
						else
							include("includes/Dashboard.php");
					?>
					<div class="clear"></div>
			    </div>
			    <div id="push"></div>
			</section>
		</div>
		<?php include("includes/Footer.php"); ?>
	</body>
</html>