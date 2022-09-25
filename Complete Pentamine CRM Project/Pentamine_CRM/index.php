<?php
	include("includes/config.php");
	session_start();
	if(!$_SESSION['clientId'])
		header('Location:login.php');
	$query = mysql_query("SELECT * FROM user WHERE username='".$_SESSION['clientId']."'");
	$row1 = mysql_fetch_array($query);
	ini_set("display_errors","0");
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<?php
	if($row1['role'] == 'admin')
		echo "<title>Pentamine Technology- Admin Panel</title>";
	else
		echo "<title>Pentamine Technology- User Panel</title>";
	
?>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" media="screen" href="css/reset.css" />
<link rel="stylesheet" media="screen" href="css/style.css" />
<link rel="stylesheet" media="screen" href="css/messages.css" />
<link rel="stylesheet" media="screen" href="css/forms.css" />
<link rel="stylesheet" media="screen" href="css/uniform.aristo.css" />
<link rel="stylesheet" media="screen" href="css/tables.css" />
<link rel="stylesheet" media="screen" href="css/visualize.css" />
<link rel="stylesheet" media="screen" href="css/action-buttons.css" />
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="css/datepicker/jquery.ui.core.css">
<link rel="stylesheet" href="css/datepicker/jquery.ui.datepicker.css">
<link rel="stylesheet" href="css/datepicker/jquery.ui.theme.css">
<link rel="stylesheet" href="css/styles1.css">
<script src="script/datepicker/jquery-1.5.1.js"></script>
<script src="script/datepicker/jquery.ui.core.js"></script>
<script src="script/datepicker/jquery.ui.datepicker.js"></script>
<script src="js/jquery.tools.min.js"></script>
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script src="js/visualize.jQuery.js"></script>
<script type="text/javascript" src="js/global.js"></script>
</head>
	<body>
		
		<div id="wrapper">
		   
		   <header id="page-header">
					<div class="wrapper">
						<div id="util-nav">
							<ul>
								<li>Logged in as <?php echo $_SESSION['clientId']; ?>:</li>
								<!--li><a href="#">Help</a>style="text-decoration: none</li-->
								<li><a href="includes/logoff.php">Logout</a></li>
							</ul>
						</div>
						<h1>PENTAMINE TECHNOLOGIES ENTERPRISE RESOURCE MANAGEMENT</h1>
						<div id="main-nav" style='width:1200px'>
							<ul class="clearfix">
							<?php
							if($_GET['page']=="" || $_GET['page']=="dashboard")
								echo "<li class='active'><a href='?page=dashboard'>Dashboard</a></li>";
							else
								echo "<li><a href='?page=dashboard'>Dashboard</a></li>";
							if($row1['role'] == 'admin')
							{
								if($_GET['page']=="clients")
								{
									echo "<li class='active'><a href='?page=clients'>Clients</a></li>";
								}	
								else
								{
									echo "<li><a href='?page=clients'>Clients</a></li>";
								}
							}
							if($_GET['page']=="employee")
							{
								echo "<li class='active'><a href='?page=employee'>Employee</a></li>";
							}
							else if($_GET['page']=="empsummary")
							{
								echo "<li class='active'><a href='?page=employee'>Employee</a></li>";
							}
							else if($_GET['page']=="empleave")
							{
								echo "<li class='active'><a href='?page=employee'>Employee</a></li>";
							}
							else
							{
								echo "<li><a href='?page=employee'>Employee</a></li>";
							}
							if($_GET['page']=="leads")
							{
								echo "<li class='active'><a href='?page=leads'>Lead</a></li>";
							}
							else if	($_GET['page']=="leadsummary")
							{
								echo "<li class='active'><a href='?page=leads'>Lead</a></li>";
							}
							else if	($_GET['page']=="leadstatus")
							{
								echo "<li class='active'><a href='?page=leads'>Lead</a></li>";
							}
							else
							{
								echo "<li><a href='?page=leads'>Lead</a></li>";
							}
							if($_GET['page']=="work")
							{
								echo "<li class='active'><a href='?page=work'>Work</a></li>";
							}
							else if	($_GET['page']=="worksummary")
							{
								echo "<li class='active'><a href='?page=work'>Work</a></li>";
							}
							else if	($_GET['page']=="workstatus")
							{
								echo "<li class='active'><a href='?page=work'>Work</a></li>";
							}
							else if($_GET['page']=="workpayment")
							{
								echo "<li class='active'><a href='?page=work'>Work</a></li>";
							}
							else
							{
								echo "<li><a href='?page=work'>Work</a></li>";
							}
							if($_GET['page']=="task")
							{
								echo "<li class='active'><a href='?page=task'>Task</a></li>";
							}
							else if	($_GET['page']=="tasksummary")
							{
								echo "<li class='active'><a href='?page=task'>Task</a></li>";
							}
							else if	($_GET['page']=="taskstatus")
							{
								echo "<li class='active'><a href='?page=task'>Task</a></li>";
							}
							else
							{
								echo "<li><a href='?page=task'>Task</a></li>";
							}						
							if($row1['role'] == 'admin')
							{
								if($_GET['page']=="master")
									echo "<li class='active'><a href='?page=master'>Master</a></li>";
								else if	($_GET['page']=="mastersub")
									echo "<li class='active'><a href='?page=master'>Master</a></li>";
								else if	($_GET['page']=="master_description")
									echo "<li class='active'><a href='?page=master'>Master</a></li>";	
								else if	($_GET['page']=="modeofpayment")
									echo "<li class='active'><a href='?page=master'>Master</a></li>";	
								else if	($_GET['page']=="itemmaster")
									echo "<li class='active'><a href='?page=master'>Master</a></li>";
								else if	($_GET['page']=="masterassignee")
									echo "<li class='active'><a href='?page=master'>Master</a></li>";
								else if	($_GET['page']=="masterstatus")
									echo "<li class='active'><a href='?page=master'>Master</a></li>";		
								else
									echo "<li><a href='?page=master'>Master</a></li>";
								if($_GET['page']=="user")
									echo "<li class='active'><a href='?page=user'>User</a></li>";
								else
									echo "<li><a href='?page=user'>User</a></li>";
								if($_GET['page']=="finance")
									echo "<li class='active'><a href='?page=finance'>Finance</a></li>";
								else if	($_GET['page']=="fullfinancialdetails")
									echo "<li class='active'><a href='?page=finance'>Finance</a></li>";
								else if	($_GET['page']=="reports")
									echo "<li class='active'><a href='?page=finance'>Finance</a></li>";	
								else
									echo "<li><a href='?page=finance'>Finance</a></li>";
								if($_GET['page']=="item")
									echo "<li class='active'><a href='?page=item'>Inventory</a></li>";
								else if	($_GET['page']=="itemsummary")
									echo "<li class='active'><a href='?page=item'>Inventory</a></li>";
								else if	($_GET['page']=="vendor")
									echo "<li class='active'><a href='?page=item'>Inventory</a></li>";	
								else
									echo "<li><a href='?page=item'>Inventory</a></li>";	
								if($_GET['page']=="recurring")
									echo "<li class='active'><a href='?page=recurring'>Recurring</a></li>";
								else if	($_GET['page']=="recurringsummary")
									echo "<li class='active'><a href='?page=recurring'>Recurring</a></li>";
								else
									echo "<li><a href='?page=recurring'>Recurring</a></li>";
								if($_GET['page']=="resource")
									echo "<li class='active'><a href='?page=resource'>Resource</a></li>";
								else if	($_GET['page']=="resourcesummary")
									echo "<li class='active'><a href='?page=resource'>Resource</a></li>";
								else
									echo "<li><a href='?page=resource'>Resource</a></li>";		
								if($_GET['page']=="statusreports")
									echo "<li class='active'><a href='?page=statusreports'>Reports</a></li>";
								else
									echo "<li><a href='?page=statusreports'>Reports</a></li>";									
							}
							?>
							</ul>
						</div>
					</div>
				</header>
			
			<section id="content">
				<div class="wrapper">
					<!-- Main Section -->			
				<?php 
							if($_GET['page']=="" || $_GET['page']=="dashboard")
							{
								require_once("includes/content.php"); 
							}
							else if($_GET['page']=="employee")
							{
								require_once("includes/employee.php"); 
							}
							else if($_GET['page']=="empleave")
							{
								require_once("includes/empleave.php"); 
							}
							else if($_GET['page']=="user")
							{
								require_once("includes/user1.php"); 
							}
							else if($_GET['page']=="task")
							{
								require_once("includes/task.php"); 
							}
							if($_GET['page']=="clients")
							{
								require_once("includes/client.php"); 
							}
							if($_GET['page']=="leads")
							{
								require_once("includes/lead.php"); 
							}
							
							if($_GET['page']=="leadstatus")
							{
								require_once("includes/leadstatus.php"); 
							}
							if($_GET['page']=="taskstatus")
							{
								require_once("includes/taskstatus.php"); 
							}
							if($_GET['page']=="tasksummary")
							{
								require_once("includes/tasksummary.php"); 
							}
							if($_GET['page']=="leadsummary")
							{
								require_once("includes/leadsummary.php"); 
							}
							if($_GET['page']=="work")
							{
								require_once("includes/work.php"); 
							}
							if($_GET['page']=="master")
							{
								require_once("includes/master.php"); 
							}
							if($_GET['page']=="finance")
							{
								require_once("includes/finance.php"); 
							}
							if($_GET['page']=="vendor")
							{
								require_once("includes/vendor.php"); 
							}
							if($_GET['page']=="fullfinancialdetails")
							{
								require_once("includes/fullfinancialdetails.php"); 
							}
							if($_GET['page']=="reports")
							{
								require_once("includes/reports.php"); 
							}
							if($_GET['page']=="master_description")
							{
								require_once("includes/Master_description.php"); 
							}
							if($_GET['page']=="modeofpayment")
							{
								require_once("includes/Modeofpayment.php"); 
							}
							if($_GET['page']=="categorymaster")
							{
								require_once("includes/categorymaster.php"); 
							}
							if($_GET['page']=="item")
							{
								require_once("includes/item.php"); 
							}
							if($_GET['page']=="itemmaster")
							{
								require_once("includes/itemmaster.php"); 
							}
							if($_GET['page']=="mastersub")
							{
								require_once("includes/mastersub.php"); 
							}
							if($_GET['page']=="masterassignee")
							{
								require_once("includes/masterassignee.php"); 
							}
							if($_GET['page']=="masterstatus")
							{
								require_once("includes/masterstatus.php"); 
							}
							if($_GET['page']=="recurring")
							{
								require_once("includes/recurring.php"); 
							}
							if($_GET['page']=="recurringsummary")
							{
								require_once("includes/recurringsummary.php"); 
							}
							if($_GET['page']=="worksummary")
							{
								require_once("includes/worksummary.php"); 
							}
							if($_GET['page']=="workstatus")
							{
								require_once("includes/workstatus.php"); 
							}
							if($_GET['page']=="resource")
							{
								require_once("includes/resource.php"); 
							}
							if($_GET['page']=="resourcesummary")
							{
								require_once("includes/resourcesummary.php"); 
							}
							if($_GET['page']=="itemsummary")
							{
								require_once("includes/itemsummary.php"); 
							}
							if($_GET['page']=="empsummary")
							{
								require_once("includes/empsummary.php"); 
							}
							if($_GET['page']=="employeestatus")
							{
								require_once("includes/employeestatus.php"); 
							}
							if($_GET['page']=="statusreports")
							{
								require_once("includes/statusreports.php"); 
							}
							if($_GET['page']=="workpayment")
							{
								require_once("includes/workpayment.php"); 
							}
						?>			                
					<!-- Main Section End -->
					<!-- Sidebar -->
				   <?php //require_once("includes/sidebar.php"); ?>
					<!-- Sidebar End -->                
					<div class="clear"></div>
				</div>
				<div id="push"></div>
			</section>
		</div>   
		<?php //require_once("includes/footer.php"); ?>

		
	</body>
</html>
