<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
?>
<html>
	<head>
		<title>LocValu</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href='css/font.css' rel='stylesheet' type='text/css'>
		<script src='js/jquery.min.js'></script>
	</head>
	<body>
		<?php
		include("includes/Header.php");
		if(!isset($_GET['page']))
			$_GET['page'] = "Home";
		include("includes/".$_GET['page'].".php");
		?>
		<div class="copy-right">
			<div class="wrap">
				<p><a href="index.php?page=Home"><img src="images/logovalue1.png" alt=""></a> &nbsp;          2014 version: 1.0 |  By accessing our Site, you agree to our<a href='index.php?page=Terms'> Terms of Use </a> and <a href='index.php?page=Privacy'> Privacy Policy </a>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
			</div>
		</div>
	</body>
</html> 
<script>
	function Ajax(Type, URL, URLData)
	{
		var Responses = "";
		$.ajax(
		{
			type: Type,
			async: false,
			cache: false,
			url: URL,
			data:URLData,
			dataType: 'html',
			success: function(Response)
			{
				Responses = Response;
			}
		});
		return Responses;
	}
</script>