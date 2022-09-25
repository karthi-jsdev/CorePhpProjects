<?php 
//ini_set("display_errors","0");
session_start();
?>

<header id="page-header">
    <div class="wrapper">
		<div id="util-nav">
            <ul>
                <li>Logged in as: <?php echo $_SESSION['FM_name'];?> Role is : <?php echo $_SESSION['FM_role'];?></li>
                <li><a href="includes/Logout.php">Logout</a></li>
		    </ul>
		</div>
		<div style="float:left;margin-top:0px;margin-left:-80px;">
			<img src="images/Logo.png" width="100px" height="80px" style="align:right;">
		&nbsp;&nbsp;</div>
        <h1>Fees Management</h1>
        <div id="main-nav">
            <ul class="clearfix">
            	<?php
				foreach($_SESSION['FM_modules'] as $Header)
				{
					if($_GET['page'] == $Header)
						echo "<li class='active'><a href='?page=".$Header."'>".str_replace("_"," ",$Header)."</a></li>";
					else
						echo "<li><a href='?page=".$Header."'>".str_replace("_"," ",$Header)."</a></li>";
				}
				?>
			</ul>
        </div>
    </div>
    <div id="page-subheader">
        <div class="wrapper">
            <h2>
            	<?php
					echo str_replace("_"," ",$_GET['page']);
				?>
            	</h2>
            <!--input placeholder="Search..." type="text" name="q" value="" /-->
        </div>
    </div>
</header>
