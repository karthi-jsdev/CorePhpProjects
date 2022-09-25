<header id="page-header">
    <div class="wrapper">
		<div id="util-nav">		
            <ul>
				<?php
				if($_SESSION['role'])
					echo "<img style='float:left;margin-left:-700px;' src='images/logo.png' height=49px width=200px alt=\"Chiramith Logo\"><li>".$_SESSION['name']." logged in as ".str_replace("_", " ", $_SESSION['role'])." : <a href='index.php?page=Profile'>Profile</a> &nbsp;<a href='includes/Logout.php'>Logout</a></li>";
				?>
            </ul>
			<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Last Login &nbsp;". $_SESSION['lastlogin']; ?>
        </div>
        <h1><?php echo $_SESSION['Client']; ?></h1>
        <div id="main-nav">
            <ul class="clearfix">
            	<?php
				if(!$_GET['page'])
					$_GET['page'] = "Dashboard";
				
				if($_SESSION['roleid'] <= 2)//Super Admin/Admin
					$headers = array("Dashboard", "Masters","Machine_Status", "Machine_Daily_Status", "Machine_Report", "Order", "Reports","Backup");//, "Contact_Us"
				else//User
					$headers = array("Dashboard", "Machine_Status", "Machine_Daily_Status","Reports","Backup");
				
				for($i = 0; $i < count($headers); $i++)
				{
					$page = str_replace("_", " ", $headers[$i]);
					if($_GET['page'] == $headers[$i])
					{
						echo "<li class='active'><a href='?page=".$headers[$i]."'>";
						$currentpage = $page;
					}
					else
						echo "<li><a href='?page=".$headers[$i]."'>";
					echo $page."</a></li>";
				} ?>
            </ul>
        </div>
    </div>
	
    <div id="page-subheader">
        <div class="wrapper">
            <h2>
            	<?php
				if($_GET['page'] == "")
					echo "Dashboard";
				else
					echo $currentpage;
            	?>
            </h2>
        </div>
    </div>
</header>