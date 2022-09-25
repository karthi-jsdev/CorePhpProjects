<header id="page-header">
    <div class="wrapper">
        <div id="util-nav">
            <ul>
				<?php
				if($_SESSION['role'])
					echo "<li>".$_SESSION['name']." logged in as ".str_replace("_", " ", $_SESSION['role'])." : <a href='index.php?page=Profile'>Edit Profile</a> &nbsp;<a href='includes/Logout.php'>Logout</a></li>";
				?>
            </ul>
        </div>
        <h1><?php echo $_SESSION['Client']; ?></h1>
        <div id="main-nav">
            <ul class="clearfix">
            	<?php
				if(!$_GET['page'])
					$_GET['page'] = "Dashboard";
				
				if($_SESSION['roleid'] == 11 ||$_SESSION['roleid'] == 10 ||$_SESSION['roleid'] == 9 ||$_SESSION['roleid'] == 8 ||$_SESSION['roleid'] == 7 ||$_SESSION['roleid'] == 6 ||$_SESSION['roleid'] == 5 ||$_SESSION['roleid'] == 4 || $_SESSION['roleid'] == 3 || $_SESSION['roleid'] == 2 || $_SESSION['roleid'] == 1)//Super Admin/Admin
					$headers = array("Dashboard", "Masters", "Stores", "Sales","Reports");//, "Contact_Us"
				
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
	
    <div id="page-subheader"></div>
</header>