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
				
				if($_SESSION['roleid'] == 5)//Super Admin/Admin/Supervisor/Technician
					$headers = array("Dashboard", "Masters","Raise_Complaint","Complaint_Status","Close_Complaint","Reports","Assets","BiomedicalMasters","Biomed_Assets");//, "Contact_Us","Biomedical","Biomedical_Status",","Asset_Status",,"Biomedical_Status","Biomedical"
				else if($_SESSION['roleid'] == 1)
				{
					if($_SESSION['groupid'] == 1)
						$headers = array("Dashboard", "Raise_Complaint","Complaint_Status","Close_Complaint","Reports","Assets","BiomedicalMasters","Biomed_Assets");//,"Biomedical","Biomedical_Status",,"Asset_Status","Biomedical_Status","Biomedical"
					else if($_SESSION['departmentadmin'])
						$headers = array("Dashboard", "Raise_Complaint","Complaint_Status","Close_Complaint");
					else	
						$headers = array("Dashboard", "Raise_Complaint","Complaint_Status","Close_Complaint","Reports");
				}
				else
					$headers = array("Dashboard", "Raise_Complaint","Complaint_Status","Close_Complaint");
				
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