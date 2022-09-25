<header id="page-header">
    <div class="wrapper">
        <div id="util-nav">
            <ul>
				<?php
				if($_SESSION['SM_role'])
					echo "<li>".$_SESSION['SM_name']." logged in as ".str_replace("_", " ", $_SESSION['SM_role'])." : <a href='index.php?page=Profile'>Edit Profile</a> &nbsp;<a href='includes/Logout.php'>Logout</a></li>";
				?>
            </ul>
        </div>
        <h1><?php echo $_SESSION['SM_Client']; ?></h1>
        <div id="main-nav">
            <ul class="clearfix">
            	<?php
				if(!$_GET['page'])
					$_GET['page'] = "Dashboard";
				
				//if($_SESSION['SM_roleid'] == 3 || $_SESSION['SM_roleid'] == 2 || $_SESSION['SM_roleid'] == 1)//Super Admin/Admin/Student
				$headers = array("Dashboard", "Masters", "Students", "Staff", "Salary", "Reports");
				$FetchModules = mysql_fetch_array(mysql_query("select * from user_role where id='".$_SESSION['SM_roleid']."'"));
				$ExplodeModules = explode(',',$FetchModules['modules']);
				for($i = 0; $i < count($ExplodeModules); $i++)
				{
					$page = str_replace("_", " ", $ExplodeModules[$i]);
					if($_GET['page'] == $ExplodeModules[$i])
					{
						echo "<li class='active'><a href='?page=".$ExplodeModules[$i]."'>";
						$currentpage = $page;
					}
					else
						echo "<li><a href='?page=".$ExplodeModules[$i]."'>";
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