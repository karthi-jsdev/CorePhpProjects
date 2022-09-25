<header id="page-header">
    <div class="wrapper">
        <div id="util-nav">
            <ul>
				<?php
				echo "<li>".$_SESSION['name']." logged in as ".str_replace("_", " ", $_SESSION['role'])." <a href='includes/Logout.php'>Logout</a></li>";
				?>
            </ul>
        </div>
        <h1><?php echo $_SESSION['Client']; ?></h1>
        <div id="main-nav">
            <ul class="clearfix">
            	<?php
				if(!$_GET['page'])
					$_GET['page'] = "Dashboard";
				
				$headers = array("Dashboard","Masters","Resource Update","Leave Apply","Reports","Backup");
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