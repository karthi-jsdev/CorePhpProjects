<?php
	ini_set("display_errors","0");
?>
<div class="header">
	<div class="wrap">
		<div class="logo">
			<a href="index.html"><img src="images/lastlocvalunewlogo1.png" alt=""></a>
		 </div>
	</div>
</div>
<div class="header-bottom">
	<div class="wrap">
		<div id='cssmenu'>
			<ul>
				<?php
				$Headers = array("Home","Maintenance","Help","Blog","Announcements","contact us");
				foreach($Headers as $Header)
				{
					if(!is_array($Header))
					{
						if($_GET['page'] == $Header)
							echo "<li class='active'><a href='index.php?page=".$Header."'><span>".$Header."</span></a></li>";
						else if($Header == 'contact us')
							echo "<li><a href='mailto:contact@locvalu.com?Subject='><span>".$Header."</span></a></li>";	
						else	
							echo "<li><a href='index.php?page=".$Header."'><span>".$Header."</span></a></li>";
					}
				}
				if($_GET['page'] == 'Maintenance' && $_SESSION['id'])
					header("location: index.php?page=State");
				else if($_SESSION['id'])
				{ ?>
					<li class='active'><a href='includes/Logout.php'><span>Logout</span></a></li>
		<?php 	}
		?>
			</ul>
		</div>
		<div class="clear"></div> 
	</div>
</div>