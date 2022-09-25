<?php
	ini_set("display_errors","0");
	include("../BBH_LDS/includes/Config.php");
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>BBH</title>
<!-- favicon -->
<link rel="shortcut icon" href="favicon.ico" />
<!-- Stylesheets -->
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" media="screen" href="css/forms.css" />
<link rel="stylesheet" type="text/css" media="screen" href="http://124.40.244.14/css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="http://124.40.244.14/css/reset.css">
<link rel="stylesheet" type="text/css" media="screen" href="http://124.40.244.14/css/960.css">
<link rel="stylesheet" type="text/css" media="screen" href="http://124.40.244.14/css/typography.css">
<link rel="stylesheet" href="http://124.40.244.14/css/login/slide.css" type="text/css" media="screen" />
<link rel="stylesheet" href="http://124.40.244.14/css/downmenu/menu.css" type="text/css" />
<link rel="stylesheet" type="text/css" media="screen" href="http://124.40.244.14/css/color.css" id="colorswitch">
<link rel="stylesheet" type="text/css" media="screen" href="http://124.40.244.14/css/fonts/droid/stylesheet.css">
<link rel="stylesheet" href="http://124.40.244.14/css/minitab/minitab.css">
<link rel="stylesheet" href="http://124.40.244.14/css/notice/notice.css">
<link rel="stylesheet" href="http://124.40.244.14/css/news/news.css" type="text/css" />
<link rel="stylesheet" href="http://124.40.244.14/css/accordion/jquery.ui.all.css">

<!-- Scripts -->
<script src="http://124.40.244.14/js/login/jquery-1.3.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="http://124.40.244.14/js/downmenu/menu.js"></script>
<script type="text/javascript" src="http://124.40.244.14/js/jquery.min.js"></script>
<script type="text/javascript" src="http://124.40.244.14/js/notice/jquery.jticker.js"></script>
<script src="http://124.40.244.14/js/accordion/jquery.ui.widget.js"></script>
<script src="http://124.40.244.14/js/accordion/jquery.ui.accordion.js"></script>

<script type="text/javascript">
		/*$(window).load(
		function()
		{
			$('#slider ul').nivoSlider(
			{
				effect:'random',
				animSpeed:400,
				pauseTime:3000,
				startSlide:0,
				directionNav:true,
				directionNavHide:true,
				controlNav:false,
				keyboardNav:true,
			});
		});*/

		$(document).ready(function()
		{
			$('.zoom').each(function(){$(this).hover(function(){$(this).stop().animate({opacity:0.5},'slow');},function(){$(this).stop().animate({opacity:1.0},'slow');})});
		});

		$(document).ready(function() {
			$( "#accordion" ).accordion();
		});
</script>    
<body onload="jQuery('#typewrite').trigger('play')">

<!--start page_wrap-->
<div id="page_wrap" class="container_12 clearfix top">
    
    <!--start header-->
    <header id="header" style="border:0px solid;" class="grid_12 clearfix">
        
    	<!--start logo-->
		
		<div  id="logo1" class="grid_3 alpha" style="float:left;">
        	<a href="index.php"></a>      	
    	</div>
		<div  id="logo2" class="grid_3 alpha" style="float:left;">
        	<a href="index.php"></a>      	
    	</div>
		<div   id="logo" class="grid_3 alpha" style="float:left;">
        	<a href="index.php"></a>      	
    	</div>
        <!--end logo-->
        
        <!--start navigation-->
		<div id="menu">
			<?php
			if(!$_GET['page'])
				$_GET['page']="Present Leave";
			$Modules = array("Present Leave","Future Leave","Past Leave");
			foreach($Modules as $Module)
				echo '<a onmouseover="dropdownmenu(this,event,menu1,\"170px\")" class="top_menu" href="BBHLDSUI.php?page='.$Module.'" style="width:140px;"><span id="text" >'.$Module.'</span></a><div id="splitter" ></div>';
			?>
		</div>
    </header>
    <!--end header-->
    
    <div class="clear"></div>
<!--start content-->
 <section  id="content" class="grid_12 clearfix">
	<div class="alpha">
		<?php
		include("../BBH_LDS/includes/LeaveQueries.php");
		if($_GET['page'])
			include("../BBH_LDS/includes/Leave Apply ".$_GET['page'].".php");
		?>
	</div>
</section>
  <!--end content-->
   
  <!--start footer-->
	<footer id="footer" class="grid_12">
	<!--start subfooter-->
		<div id="sub_footer" class="grid_12 alpha">
			<div class="grid_6 alpha">	

				<p>&copy; Copyright BANGALORE BAPTIST HOSPITAL All rights reserved .<!-- <a href="inner.php?aid=62">Privacy Policy</a>--> </p>
			</div>
			<div class="grid_6 omega align_right">
				<p><a href="#top">Back to Top</a></p>
			</div>
		</div>
   <!--end subfooter-->
    
   </footer>
  <!--end footer-->
   <div class="clear"></div>
<!--end page_wrap-->
</div>
</body>
</html>