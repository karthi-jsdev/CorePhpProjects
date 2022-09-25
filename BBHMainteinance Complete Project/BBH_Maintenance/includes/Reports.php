<head>
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#complaintdate").datepicker({dateFormat: 'dd-mm-yy',maxDate: 0});
			$("#resolveddate").datepicker({dateFormat: 'dd-mm-yy',maxDate: 0});
		});
	</script>
</head>
<?php
	include("includes/Reports_Queries.php");
	include("includes/Assets_Queries.php");  

?>
<br />
<center>
	<?php
	if(!$_GET['subpage'])
		$_GET['subpage'] = "Summary";
	$subheaders = array("Summary","Department","Sub-Department","Technician","Zone","All","Call Slip","Delayed Call Slip","Unresolved","Weekly Reports","Biomedical","BiomedicalKPI","Priority Summary","Priority Details");
	if($_SESSION['roleid'] == 5 || $_SESSION['groupid'] == 1)
	{
		$subheaders[] = "Assets";
		$subheaders[] = "AMC Period";
	}
	$subheaders[] = "Reopened";
	for($i = 0; $i < count($subheaders); $i++)
	{
		$split = explode("_", $subheaders[$i]);
		for($j = 0; $j < count($split); $j++)
		{
			if(!$j)
				$subpagename = $split[$j];
			else
				$subpagename = $subpagename." ".$split[$j];
		}
		if($_GET['subpage'] == $subheaders[$i])
			echo "<a class='active button button-orange' href='index.php?page=".$_GET['page']."&subpage=".$subheaders[$i]."'>".$subpagename."</a>&nbsp;";
		else
			echo "<a class='button button-gray' href='index.php?page=".$_GET['page']."&subpage=".$subheaders[$i]."'>".$subpagename."</a>&nbsp;";
	} ?>
</center>
<br />

	<?php
	if($_GET['subpage'] == 'Department')
	{ ?>
		<div class="form panel">
			<form method='post' action=''>
				<hr/>
				<table>
					<tr>
						<td>
							<b>Department:</b>
							<br/>
							<select name="department" id="department">
								<?php
									echo '<option value="">All</option>';
									$SelectDepartment = Reports_Departments();
									while($FetchDepartment = mysqli_fetch_array($SelectDepartment))
									{
										if($_POST['department'] == $FetchDepartment['id'])
											echo '<option value="'.$FetchDepartment['id'].'" selected>'.$FetchDepartment['name'].'</option>';
										else
											echo '<option value="'.$FetchDepartment['id'].'">'.$FetchDepartment['name'].'</option>';
									} ?>
							</select>
						</td>
						<td>
							<b>Status:</b>
							<br/>
							<select name="status" id="status">
								<?php
								echo '<option value="">All</option>';
								$SelectStatus = Reports_Statuses();
								while($FetchStatus = mysqli_fetch_array($SelectStatus))
								{
									if($_POST['status'] == $FetchStatus['id'])
										echo '<option value="'.$FetchStatus['id'].'" selected>'.$FetchStatus['name'].'</option>';
									else
										echo '<option value="'.$FetchStatus['id'].'">'.$FetchStatus['name'].'</option>';
								} ?>
							</select>
						</td>
						<td>
							<b>Start Date:</b>
							<br/>
							<input type="text" name="complaintdate" id="complaintdate" value="<?php if($_POST['complaintdate']) echo $_POST['complaintdate']; else echo date('d-m-Y', strtotime("-30 days"));?>">
						</td>
						<td style="padding-right:20px;">
							<b>End Date:</b>
							<br/>
							<input type="text" name="resolveddate" id="resolveddate" value="<?php if($_POST['resolveddate']) echo $_POST['resolveddate']; else echo date('d-m-Y');?>">
						</td>
						<td>
							<br/>
							<input type="submit" class="button button-green" name="Search" value="Search">&nbsp;
							<?php
							if(mysqli_num_rows(Report_Department()) && $_POST['Search'])
								echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&department='.$_POST['department'].'&status='.$_POST['status'].'&complaintdate='.$_POST['complaintdate'].'&resolveddate='.$_POST['resolveddate'].'&Search=1")\'>Download</a>';
							?>
						</td>
					</tr>
				</table>
			</form>
			<hr/>
		</div>
	<?php
	}
	else if($_GET['subpage'] == 'Sub-Department')
	{ ?>
		<div class="form panel">
			<form method='post' action=''>
				<hr/>
				<table>
					<tr>
						<td>
							<b>Sub-Department:</b>
							<br/>
							<?php
							if($_SESSION['roleid'] == '5')
							{
								echo '<select name="subdepartment" id="subdepartment">
								<option value="">All</option>';
								$SelectGroup = Reports_SubDepartment();
								while($FetchGroup = mysqli_fetch_array($SelectGroup))
								{
									if($_POST['subdepartment'] == $FetchGroup['id'])
										echo '<option value="'.$FetchGroup['id'].'" selected>'.$FetchGroup['name'].'</option>';
									else
										echo '<option value="'.$FetchGroup['id'].'" >'.$FetchGroup['name'].'</option>';
								}
							}
							else if($_SESSION['roleid'] == '1')
							{
								echo '<select name="subdepartment" id="subdepartment">
									<option value="">All</option>';
								$SelectGroup = Reports_Sub_Department($_SESSION['groupid']);
								while($FetchGroup = mysqli_fetch_array($SelectGroup))
								{
									if($_POST['subdepartment'] == $FetchGroup['id'])
										echo '<option value="'.$FetchGroup['id'].'" selected>'.$FetchGroup['name'].'</option>';
									else
										echo '<option value="'.$FetchGroup['id'].'" >'.$FetchGroup['name'].'</option>';
								}
							} ?>
						</select>
						<td>
							<b>Status:</b>
							<br/>
							<select name="status" id="status">
								<?php
								echo '<option value="">All</option>';
								$SelectStatus = Reports_Statuses();
								while($FetchStatus = mysqli_fetch_array($SelectStatus))
								{
									if($_POST['status'] == $FetchStatus['id'])
										echo '<option value="'.$FetchStatus['id'].'" selected>'.$FetchStatus['name'].'</option>';
									else
										echo '<option value="'.$FetchStatus['id'].'">'.$FetchStatus['name'].'</option>';
								} ?>
							</select>
						</td>
						<td>
							<b>Start Date:</b>
							<br/>
							<input type="text" name="complaintdate" id="complaintdate" value="<?php if($_POST['complaintdate']) echo $_POST['complaintdate']; else echo date('d-m-Y', strtotime("-30 days"));?>">
						</td>
						<td style="padding-right:20px;">
							<b>End Date:</b>
							<br/>
							<input type="text" name="resolveddate" id="resolveddate" value="<?php if($_POST['resolveddate']) echo $_POST['resolveddate']; else echo date('d-m-Y');?>">
						</td>
						<td>
							<br/>
							<input type="submit" class="button button-green" name="Search" value="Search">&nbsp;
							<?php
							if(mysqli_num_rows(Report_SubDepartment()) && $_POST['Search'])
								echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&subdepartment='.$_POST['subdepartment'].'&status='.$_POST['status'].'&complaintdate='.$_POST['complaintdate'].'&resolveddate='.$_POST['resolveddate'].'&Search=1")\'>Download</a>';
							?>
						</td>
					</tr>
				</table>
			</form>
			<hr/>
		</div>
	<?php
	}
	else if($_GET['subpage'] == 'Weekly Reports')
	{ ?>
		<div class="form panel" style="width:1100px">
			<form method='post' action=''>
				<hr/>
			<table>
				<tr>
						<td>
							<b>Sub-Department:</b>
							<br/>
							<?php
							if($_SESSION['roleid'] == '5')
							{
								echo '<select name="subdepartment" id="subdepartment">
								<option value="">All</option>';
								$SelectGroup = Reports_SubDepartment();
								while($FetchGroup = mysqli_fetch_array($SelectGroup))
								{
									if($_POST['subdepartment'] == $FetchGroup['id'])
										echo '<option value="'.$FetchGroup['id'].'" selected>'.$FetchGroup['name'].'</option>';
									else
										echo '<option value="'.$FetchGroup['id'].'" >'.$FetchGroup['name'].'</option>';
								}
							}
							else if($_SESSION['roleid'] == '1')
							{
								echo '<select name="subdepartment" id="subdepartment">
									<option value="">All</option>';
								$SelectGroup = Reports_Sub_Department($_SESSION['groupid']);
								while($FetchGroup = mysqli_fetch_array($SelectGroup))
								{
									if($_POST['subdepartment'] == $FetchGroup['id'])
										echo '<option value="'.$FetchGroup['id'].'" selected>'.$FetchGroup['name'].'</option>';
									else
										echo '<option value="'.$FetchGroup['id'].'" >'.$FetchGroup['name'].'</option>';
								}
							} ?>
						</select>
						</td>
						<td>
						<b>Technician:</b>
						<br/>
							<?php
							if($_SESSION['roleid'] == '5')
							{
								echo '<select name="technician" id="technician">
								<option value="">All</option>';
								$SelectGroup = Reports_Technician();
								while($FetchGroup = mysqli_fetch_array($SelectGroup))
								{
									if($_POST['technician'] == $FetchGroup['id'])
										echo '<option value="'.$FetchGroup['id'].'" selected>'.$FetchGroup['firstname'].'</option>';
									else
										echo '<option value="'.$FetchGroup['id'].'" >'.$FetchGroup['firstname'].'</option>';
								}
							}
							else if($_SESSION['roleid'] == '1')
							{
								echo '<select name="technician" id="technician">
									<option value="">All</option>';
								$SelectTechnician = mysqli_query($_SESSION['connection'],"Select * From user where (userroleid='3' and groupid='".$_SESSION['groupid']."') order by firstname asc");	
								while($FetchTechnician = mysqli_fetch_array($SelectTechnician))
								{
									if($_POST['technician'] == $FetchTechnician['id'])
										echo '<option value="'.$FetchTechnician['id'].'" selected>'.$FetchTechnician['firstname'].'</option>';
									else
										echo '<option value="'.$FetchTechnician['id'].'" >'.$FetchTechnician['firstname'].'</option>';
								}
							} ?>
						</select>
					</td>
					<td>
						<b>Status:</b>
						<br/>
						<select name="status" id="status">
							<?php
							echo '<option value="">All</option>';
							$SelectStatus = Reports_Statuses();
							while($FetchStatus = mysqli_fetch_array($SelectStatus))
							{
								if($_POST['status'] == $FetchStatus['id'])
									echo '<option value="'.$FetchStatus['id'].'" selected>'.$FetchStatus['name'].'</option>';
								else
									echo '<option value="'.$FetchStatus['id'].'">'.$FetchStatus['name'].'</option>';
							} ?>
						</select>
					</td>
					<td>
						<b>Start Date:</b>
						<br/>
						<input type="text" name="complaintdate" id="complaintdate" value="<?php if($_POST['complaintdate']) echo $_POST['complaintdate']; else echo date('d-m-Y', strtotime("-7 days"));?>">
					</td>
					<td style="padding-right:20px;">
						<b>End Date:</b>
						<br/>
						<input type="text" name="resolveddate" id="resolveddate" value="<?php if($_POST['resolveddate']) echo $_POST['resolveddate']; else echo date('d-m-Y');?>">
					</td>
					<td>
						<br/>
						<input type="submit" class="button button-green" name="Search" value="Search">&nbsp;
						<?php
						$Report_SubDepartment_Weekly = mysqli_fetch_array(Report_SubDepartment_WeeklyReport());
						if(($Report_SubDepartment_Weekly['total']) && $_POST['Search'])
							echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&technician='.$_POST['technician'].'&subdepartment='.$_POST['subdepartment'].'&status='.$_POST['status'].'&complaintdate='.$_POST['complaintdate'].'&resolveddate='.$_POST['resolveddate'].'&Search=1")\'>Download</a>';
						?>
					</td>
				</tr>
			</table>
			</form>
			<hr/>
		</div>
	<?php
	}
	else if($_GET['subpage'] == 'Technician')
	{ 
	?>
		<div class="form panel">
			<form method='post' action=''>
			<hr/>
			<table>
				<tr>
					<td>
						<b>Technician:</b>
						<br/>
							<?php
							if($_SESSION['roleid'] == '5')
							{
								echo '<select name="technician" id="technician">
								<option value="">All</option>';
								$SelectGroup = Reports_Technician();
								while($FetchGroup = mysqli_fetch_array($SelectGroup))
								{
									if($_POST['technician'] == $FetchGroup['id'])
										echo '<option value="'.$FetchGroup['id'].'" selected>'.$FetchGroup['firstname'].'</option>';
									else
										echo '<option value="'.$FetchGroup['id'].'" >'.$FetchGroup['firstname'].'</option>';
								}
							}
							else if($_SESSION['roleid'] == '1')
							{
								echo '<select name="technician" id="technician">
									<option value="">All</option>';
								$SelectTechnician = mysqli_query($_SESSION['connection'],"Select * From user where (userroleid='3' and groupid='".$_SESSION['groupid']."') order by firstname asc");	
								while($FetchTechnician = mysqli_fetch_array($SelectTechnician))
								{
									if($_POST['technician'] == $FetchTechnician['id'])
										echo '<option value="'.$FetchTechnician['id'].'" selected>'.$FetchTechnician['firstname'].'</option>';
									else
										echo '<option value="'.$FetchTechnician['id'].'" >'.$FetchTechnician['firstname'].'</option>';
								}
							} ?>
						</select>
					</td>
					<td>
						<b>Status:</b>
						<br/>
						<select name="status" id="status">
							<?php
							echo '<option value="">All</option>';
							$SelectStatus = Reports_Statuses();
							while($FetchStatus = mysqli_fetch_array($SelectStatus))
							{
								if($_POST['status'] == $FetchStatus['id'])
									echo '<option value="'.$FetchStatus['id'].'" selected>'.$FetchStatus['name'].'</option>';
								else
									echo '<option value="'.$FetchStatus['id'].'">'.$FetchStatus['name'].'</option>';
							} ?>
						</select>
					</td>
					<td>
						<b>Start Date:</b>
						<br/>
						<input type="text" name="complaintdate" id="complaintdate" value="<?php if($_POST['complaintdate']) echo $_POST['complaintdate']; else echo date('d-m-Y', strtotime("-30 days"));?>">
					</td>
					<td style="padding-right:20px;">
						<b>End Date:</b>
						<br/>
						<input type="text" name="resolveddate" id="resolveddate" value="<?php if($_POST['resolveddate']) echo $_POST['resolveddate']; else echo date('d-m-Y');?>">
					</td>
					<td>
						<br/>
						<input type="submit" class="button button-green" name="Search" value="Search">&nbsp;
						<?php
						if(mysqli_num_rows(Report_Technician()) && $_POST['Search'])
								echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&technician='.$_POST['technician'].'&status='.$_POST['status'].'&complaintdate='.$_POST['complaintdate'].'&resolveddate='.$_POST['resolveddate'].'&Search=1")\'>Download</a>';
						?>
					</td>
				</tr>
			</table>
			<hr/>
			</form>
		</div>
	<?php
	}
	else if($_GET['subpage'] == 'Zone')
	{ ?>
		<div class="form panel">
			<form method='post' action=''>
			<hr/>
			<table>
				<tr>
					<td>
						<b>Zone:</b>
						<br/>
						<select name="zone" id="zone">
							<?php
							echo '<option value="">All</option>';
							$SelectZone = Reports_Zones();
							while($FetchZone = mysqli_fetch_array($SelectZone))
							{
								if($_POST['zone'] == $FetchZone['id'])
									echo '<option value="'.$FetchZone['id'].'" selected>'.$FetchZone['name'].'</option>';
								else
									echo '<option value="'.$FetchZone['id'].'" >'.$FetchZone['name'].'</option>';
							} ?>
						</select>
					</td>
					<td>
						<b>Status:</b>
						<br/>
						<select name="status" id="status">
							<?php
							echo '<option value="">All</option>';
							$SelectStatus = Reports_Statuses();
							while($FetchStatus = mysqli_fetch_array($SelectStatus))
							{
								if($_POST['status'] == $FetchStatus['id'])
									echo '<option value="'.$FetchStatus['id'].'" selected>'.$FetchStatus['name'].'</option>';
								else
									echo '<option value="'.$FetchStatus['id'].'">'.$FetchStatus['name'].'</option>';
							} ?>
						</select>
					</td>
					<td>
						<b>Start Date:</b>
						<br/>
						<input type="text" name="complaintdate" id="complaintdate" value="<?php if($_POST['complaintdate']) echo $_POST['complaintdate']; else echo date('d-m-Y', strtotime("-30 days"));?>">
					</td>
					<td style="padding-right:20px;">
						<b>End Date:</b>
						<br/>
						<input type="text" name="resolveddate" id="resolveddate" value="<?php if($_POST['resolveddate']) echo $_POST['resolveddate']; else echo date('d-m-Y');?>">
					</td>
					<td>
						<br/>
						<input type="submit" class="button button-green" name="Search" value="Search">&nbsp;
						<?php
						if(mysqli_num_rows(Report_Zone()) && $_POST['Search'])
								echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&zone='.$_POST['zone'].'&status='.$_POST['status'].'&complaintdate='.$_POST['complaintdate'].'&resolveddate='.$_POST['resolveddate'].'&Search=1")\'>Download</a>';
						?>
					</td>
				</tr>
			</table>
			<hr/>
			</form>
		</div>
	<?php
	}
	else if($_GET['subpage'] == "Unresolved")
	{ ?>
		<div class="form panel">
			<form method='post' action=''>
				<hr/>
				<table>
					<tr>
						<td>
							<b>Sub-Department:</b>
							<br/>
							<?php
							if($_SESSION['roleid'] == '5')
							{
								echo '<select name="subdepartment" id="subdepartment">
								<option value="">All</option>';
								$SelectGroup = Reports_SubDepartment();
								while($FetchGroup = mysqli_fetch_array($SelectGroup))
								{
									if($_POST['subdepartment'] == $FetchGroup['id'])
										echo '<option value="'.$FetchGroup['id'].'" selected>'.$FetchGroup['name'].'</option>';
									else
										echo '<option value="'.$FetchGroup['id'].'" >'.$FetchGroup['name'].'</option>';
								}
							}
							else if($_SESSION['roleid'] == '1')
							{
								echo '<select name="subdepartment" id="subdepartment">
									<option value="">All</option>';
								$SelectGroup = Reports_Sub_Department($_SESSION['groupid']);
								while($FetchGroup = mysqli_fetch_array($SelectGroup))
								{
									if($_POST['subdepartment'] == $FetchGroup['id'])
										echo '<option value="'.$FetchGroup['id'].'" selected>'.$FetchGroup['name'].'</option>';
									else
										echo '<option value="'.$FetchGroup['id'].'" >'.$FetchGroup['name'].'</option>';
								}
							} ?>
						</select>
						<td>
							<b>Status:</b>
							<br/>
							<select name="status" id="status">
								<?php
								echo '<option value="">Unresolved</option>';
								$SelectUnresolvedStatus = Reports_Statuses_Unresolved();
								while($FetchUnresolvedStatus = mysqli_fetch_array($SelectUnresolvedStatus))
								{
									if($_POST['status'] == $FetchUnresolvedStatus['id'])
										echo '<option value="'.$FetchUnresolvedStatus['id'].'" selected>'.$FetchUnresolvedStatus['name'].'</option>';
									else
										echo '<option value="'.$FetchUnresolvedStatus['id'].'">'.$FetchUnresolvedStatus['name'].'</option>';
								} ?>
							</select>
						</td>
						<td>
							<br/>
							<input type="submit" class="button button-green" name="Search" value="Search">&nbsp;
							<?php
							if(mysqli_num_rows(Report_SubDepartment_Unresolved()) && $_POST['Search'])
								echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&subdepartment='.$_POST['subdepartment'].'&status='.$_POST['status'].'&Search=1")\'>Download</a>';
							?>
						</td>
					</tr>
				</table>
			</form>
			<hr/>
		</div>
	<?php
	}
	else if($_GET['subpage'] == "Summary")
	{ ?>
	<div class="form panel" style="width:650px">
		<hr/>
		<table>
			<tr>
				<td>
					<b>Start Date:</b>
					<br/>
					<input type="text" name="complaintdate" id="complaintdate" value="<?php if($_GET['ComplaintDate']) echo $_GET['ComplaintDate']; else echo date('d-m-Y', strtotime("-30 days"));?>">
				</td>
				<td style="padding-right:20px;">
					<b>End Date:</b>
					<br/>
					<input type="text" name="resolveddate" id="resolveddate" value="<?php if($_GET['ResolvedDate']) echo $_GET['ResolvedDate']; else echo date('d-m-Y');?>">
				</td>
				<td>
					<br/>
					<a class="button button-green" onclick="GetValuesByDates()">Search</a>
					<?php
					if($_GET['ComplaintDate'] && $_GET['ResolvedDate'])
						echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&ComplaintDate='.$_GET['ComplaintDate'].'&ResolvedDate='.$_GET['ResolvedDate'].'")\'>Download</a>';
					?>
				</td>
			</tr>
		</table>
		<hr/>
	</div>
	<br />
		<?php
		if($_GET['ComplaintDate'] && $_GET['ResolvedDate'])
			echo '<button class="btn1">Show Charts</button>
		<button class="btn2">Hide Charts</button>';
	}
	else if($_GET['subpage'] =="Call Slip")
	{
		echo '<div class="form panel">
				<hr/>
				<table>
					<tr>
						<td>
							<b>Year</b>
							<br/>
							<select name="year" id="year">
							<option value="Select">Select</option>';
							for($i=2012;$i<=date('Y');$i++)
							{	
								if($_GET['Year'] == $i || (!$_GET['Year'] && $i == date('Y')))
									echo '<option value="'.$i.'" selected>'.$i.'</option>';
								else 
									echo '<option value="'.$i.'">'.$i.'</option>';
							}
							echo '</select>
						</td>
						<td><b>Month</b>
							<br/>
							<select name="month" id="month">
							<option value="Select">Select</option>';
							$months = array("January","Febuary","March","April","May","June","July","August","September","October","November","December");			
							for($i=0;$i<count($months);$i++)
							{
								$var = $i+1;
								if($_GET['Month'] == $var || (!$_GET['Month'] && $var == date('m')))
									echo '<option value="'.$var.'" selected>'.$months[$i].'</option>';
								else
									echo '<option value="'.$var.'">'.$months[$i].'</option>';
							}
							echo '</select>
						</td>
						<td><br/>
						<a class="button button-green" onclick="GetValuesByMonthly()">Search</a>&nbsp;';
						if($_GET['Month'] && $_GET['Year'] && mysqli_num_rows(Reports_All_Month_And_Year($_GET['Month'],$_GET['Year'])))
							echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&Month='.$_GET['Month'].'&Year='.$_GET['Year'].'&ComplaintDate='.$_GET['ComplaintDate'].'&ResolvedDate='.$_GET['ResolvedDate'].'")\'>Download</a>';
					echo	'</td>
					</tr>
				</table>
			</div>';
	}
	else if($_GET['subpage'] =="Delayed Call Slip")
	{
		echo '<div class="form panel">
				<hr/>
				<table>
					<tr>
						<td>
							<b>Year</b>
							<br/>
							<select name="year" id="moreyear">
							<option value="Select">Select</option>';
							for($i=2012;$i<=date('Y');$i++)
							{	
								if($_GET['Year'] == $i || (!$_GET['Year'] && $i == date('Y')))
									echo '<option value="'.$i.'" selected>'.$i.'</option>';
								else 
									echo '<option value="'.$i.'">'.$i.'</option>';
							}
							echo '</select>
						</td>
						<td><b>Month</b>
							<br/>
							<select name="moremonth" id="moremonth" multiple="multiple">
							<option value="Select">Select</option>';
							$months = array("January","Febuary","March","April","May","June","July","August","September","October","November","December");			
							$Months = explode(" ",$_GET['Month']);
							$MoreMonths = array();
							for($i=1;$i<count($months);$i++)
							{
								$var = $i+1;
								echo '<option value="'.$var.'">'.$months[$i-1].'</option>';
							}
							echo '</select>
						</td>
						<td><br/>
						<a class="button button-green" onclick="GetValuesByMoreMonthly()">Search</a>&nbsp;';
						if($_GET['Month'] && $_GET['Year'] && $_GET['Month'][0] != "0")
						{
							$Months = explode(' ',$_GET['Month']);
							$i = 0;
							foreach($Months as $Month) 
							{
								if(!$i)
								{
									if(mysqli_num_rows($SelectTickets = Reports_More_Month_And_Year($Month,$_GET['Year'])))
										echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&Month='.$_GET['Month'].'&Year='.$_GET['Year'].'&ComplaintDate='.$_GET['ComplaintDate'].'&ResolvedDate='.$_GET['ResolvedDate'].'")\'>Download</a>';	
									$i = mysqli_num_rows($SelectTickets = Reports_More_Month_And_Year($Month,$_GET['Year']));
								}
							}
						}
					echo '</td>
					</tr>
				</table>
			</div>';
	}
	else if($_GET['subpage'] =="Assets")
	{ ?>
		<div class="form panel" style="width:1050px">
		<form action='' method='POST'>
			<table>
					<tr>
						<td>
							<fieldset>
								<div class="clearfix">
									<label>Division</label>
									<select id="divisionid" name="divisionid">
										<option value="">All</option>
										<?php $Select_Division = Assets_Select_Division();
										while($Fetch_Division = mysqli_fetch_array($Select_Division))
										{
											if($Fetch_Division['id'] == $_POST['divisionid'])
												echo "<option value='".$Fetch_Division['id']."' selected>".$Fetch_Division['name']."</option>";
											else
												echo "<option value='".$Fetch_Division['id']."'>".$Fetch_Division['name']."</option>";
										} ?>
									</select>
								</div>
							</fieldset>
						</td>
						<td>
							<fieldset>
								<div class="clearfix">
							<label>Department</label>
							<select id="departmentid" name="departmentid" >
								<option value="">All</option>
								<?php
									$Departments = Assets_Department();
									while($Department = mysqli_fetch_array($Departments))
									{
										if($Department['id'] == $_POST['departmentid'])
											echo "<option value='".$Department['id']."' selected>".$Department['name']."</option>";
										else
											echo "<option value='".$Department['id']."'>".$Department['name']."</option>";
									} ?>
							</select>
							</div>
							</fieldset>
						</td>
						<td>
							<fieldset>
								<div class="clearfix">
									<label>Location</label>
									<select id="locationid" name="locationid">
										<option value="">All</option>
										<?php
											$Locations = Assets_Location();
											while($Location = mysqli_fetch_array($Locations))
											{
												if($Location['id'] == $_POST['locationid'])
													echo "<option value='".$Location['id']."' selected>".$Location['name']."</option>";
												else
													echo "<option value='".$Location['id']."'>".$Location['name']."</option>";
											} ?>
									</select>
								</div>	
							</fieldset>
						</td>
						<td>
							<label>Item</label>
							<select id="itemid" name="itemid">
								<option value="">All</option>
								<?php $Select_items = Assets_Select_item_All();
								while($Fetch_item = mysqli_fetch_array($Select_items))
								{
									if($_POST['itemid'] == $Fetch_item['id'])
										echo "<option value='".$Fetch_item['id']."'selected>".$Fetch_item['name']."</option>";
									else
										echo "<option value='".$Fetch_item['id']."'>".$Fetch_item['name']."</option>";
								}
								?>
							</select>
						</td>
						<td>
							<label>Connection Type</label>
							<select id='connectiontypeid' name='connectiontypeid'>
							<?php
							if($_POST['connectiontypeid'] =='')	
								echo "<option value='' selected>All</option>
								<option value='0'>none</option>
								<option value='1'>Standby</option>
								<option value='2'>Network</option>";
							else if($_POST['connectiontypeid'] ==0)
								echo "<option value=''>All</option>
								<option value='0' selected>none</option>
								<option value='1'>Standby</option>
								<option value='2'>Network</option>";
							else if	($_POST['connectiontypeid'] ==1)
								echo "<option value=''>All</option>
								<option value='0'>none</option>
								<option value='1' selected>Standby</option>
								<option value='2'>Network</option>";
							else if	($_POST['connectiontypeid'] ==2)
								echo "<option value=''>All</option>
								<option value='0'>none</option>
								<option value='1'>Standby</option>
								<option value='2' selected>Network</option>";	
							?>	
							</select>
						</td>
					</tr>
					<?php
					echo "
					<tr>
					<td colspan='2'><input type='submit' class='button button-green' name='submit' value='Search'></button>&nbsp;&nbsp;";
					if(mysqli_num_rows(Assets_Status_By_Id()) && $_POST['submit'])
						echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&DivisionId='.$_GET['divisionid'].'&DepartmentId='.$_GET['departmentid'].'&Locationid='.$_GET['locationid'].'&Itemid='.$_GET['itemid'].'")\'>Download</a>';
						
			echo "</td>
				</tr>
			</table>		
		</form></div>"; 
	}
	else if($_GET['subpage'] =="KPI")
	{ 
		echo '<div class="form panel">
				<hr/>
				<table>
					<tr>
						<td>
							<b>Year</b>
							<br/>
							<select name="year" id="year">
							<option value="">Select</option>';
							for($i=2012; $i <= date('Y'); $i++)
							{
								if($_GET['Year'] == $i || (!$_GET['Year'] && $i == date('Y')))
									echo '<option value="'.$i.'" selected>'.$i.'</option>';
								else 
									echo '<option value="'.$i.'">'.$i.'</option>';
							}
							echo '</select>
						</td>
						<td><b>Month</b>
							<br/>
							<select name="month" id="month">
							<option value="">Select</option>';
							$months = array("January","Febuary","March","April","May","June","July","August","September","October","November","December");			
							for($i=0;$i<count($months);$i++)
							{
								$var = $i+1;
								if($_GET['Month'] == $var || (!$_GET['Month'] && $var == date('m')))
									echo '<option value="'.$var.'" selected>'.$months[$i].'</option>';
								else
									echo '<option value="'.$var.'">'.$months[$i].'</option>';
							}
							echo '</select>
						</td>
						<td><br/>
						<a class="button button-green" onclick="GetValuesByMonthly()">Search</a>&nbsp;';
						//if(mysqli_num_rows(Reports_Sub_Department($SubgroupId)))
						//{
						if($_GET['Month'] && $_GET['Year'])
							echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&Month='.$_GET['Month'].'&Year='.$_GET['Year'].'")\'>Download</a>';
						//}	
					echo '</td>
					</tr>
				</table>
			</div>';
	}
	else if($_GET['subpage']=='AMC Period')
	{
		echo '<div class="form panel">
				<hr/>
				<table>
					<tr>
						<td>
							<b>Year</b>
							<br/>
							<select name="year" id="year">
							<option value="Select">Select</option>';
							for($i=2012;$i<=date('Y');$i++)
							{	
								if($_GET['Year'] == $i || (!$_GET['Year'] && $i == date('Y')))
									echo '<option value="'.$i.'" selected>'.$i.'</option>';
								else 
									echo '<option value="'.$i.'">'.$i.'</option>';
							}
							echo '</select>
						</td>
						<td><b>Month</b>
							<br/>
							<select name="month" id="month">
							<option value="Select">Select</option>';
							$months = array("January","Febuary","March","April","May","June","July","August","September","October","November","December");			
							for($i=0;$i<count($months);$i++)
							{
								$var = $i+1;
								if($_GET['Month'] == $var || (!$_GET['Month'] && $var == date('m')))
									echo '<option value="'.$var.'" selected>'.$months[$i].'</option>';
								else
									echo '<option value="'.$var.'">'.$months[$i].'</option>';
							}
						echo '</select>
						</td>
						<td><br/>
						<a class="button button-green" onclick="GetValuesByMonthly()">Search</a>&nbsp;';
						if($_GET['Month'] && mysqli_num_rows(Amc_Period_Report(date("Y-m-t", strtotime($_GET['Year']."-".$_GET['Month']."-01"))))) 
						{
							$Asset_Status = Amc_Period_Report(date("Y-m-t", strtotime($_GET['Year']."-".$_GET['Month']."-01")));
							if($Assets = mysqli_fetch_assoc($Asset_Status))
							{
								$Diff = explode(' ',$Assets['amcperiod']);
								if($Assets['monthdiff'] >= $Diff[0])
									echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&Month='.$_GET['Month'].'&Year='.$_GET['Year'].'")\'>Download</a>';
							}
						}
					echo '</td>
					</tr>
				</table>
			</div>';
	}
	else if($_GET['subpage']=='Reopened')
	{ ?>
		<div class="form panel">
			<form method='post' action=''>
				<hr/>
				<table>
					<tr>
						<td>
							<b>Sub-Department:</b>
							<br/>
							<?php
							if($_SESSION['roleid'] == '5')
							{
								echo '<select name="subdepartment" id="subdepartment">
								<option value="">All</option>';
								$SelectGroup = Reports_SubDepartment();
								while($FetchGroup = mysqli_fetch_array($SelectGroup))
								{
									if($_POST['subdepartment'] == $FetchGroup['id'])
										echo '<option value="'.$FetchGroup['id'].'" selected>'.$FetchGroup['name'].'</option>';
									else
										echo '<option value="'.$FetchGroup['id'].'" >'.$FetchGroup['name'].'</option>';
								}
							}
							else if($_SESSION['roleid'] == '1')
							{
								echo '<select name="subdepartment" id="subdepartment">
									<option value="">All</option>';
								$SelectGroup = Reports_Sub_Department($_SESSION['groupid']);
								while($FetchGroup = mysqli_fetch_array($SelectGroup))
								{
									if($_POST['subdepartment'] == $FetchGroup['id'])
										echo '<option value="'.$FetchGroup['id'].'" selected>'.$FetchGroup['name'].'</option>';
									else
										echo '<option value="'.$FetchGroup['id'].'" >'.$FetchGroup['name'].'</option>';
								}
							} ?>
						</select>
						<td>
						<b>Technician:</b>
						<br/>
							<?php
							if($_SESSION['roleid'] == '5')
							{
								echo '<select name="technician" id="technician">
								<option value="">All</option>';
								$SelectGroup = Reports_Technician();
								while($FetchGroup = mysqli_fetch_array($SelectGroup))
								{
									if($_POST['technician'] == $FetchGroup['id'])
										echo '<option value="'.$FetchGroup['id'].'" selected>'.$FetchGroup['firstname'].'</option>';
									else
										echo '<option value="'.$FetchGroup['id'].'" >'.$FetchGroup['firstname'].'</option>';
								}
							}
							else if($_SESSION['roleid'] == '1')
							{
								echo '<select name="technician" id="technician">
									<option value="">All</option>';
								$SelectTechnician = mysqli_query($_SESSION['connection'],"Select * From user where (userroleid='3' and groupid='".$_SESSION['groupid']."') order by firstname asc");	
								while($FetchTechnician = mysqli_fetch_array($SelectTechnician))
								{
									if($_POST['technician'] == $FetchTechnician['id'])
										echo '<option value="'.$FetchTechnician['id'].'" selected>'.$FetchTechnician['firstname'].'</option>';
									else
										echo '<option value="'.$FetchTechnician['id'].'" >'.$FetchTechnician['firstname'].'</option>';
								}
							} ?>
						</select>
					</td>
						<td>
							<b>Start Date:</b>
							<br/>
							<input type="text" name="complaintdate" id="complaintdate" value="<?php if($_POST['complaintdate']) echo $_POST['complaintdate']; else echo date('d-m-Y', strtotime("-30 days"));?>">
						</td>
						<td style="padding-right:20px;">
							<b>End Date:</b>
							<br/>
							<input type="text" name="resolveddate" id="resolveddate" value="<?php if($_POST['resolveddate']) echo $_POST['resolveddate']; else echo date('d-m-Y');?>">
						</td>
						<td>
							<br/>
							<input type="submit" class="button button-green" name="Search" value="Search">&nbsp;
							<?php
							if(mysqli_num_rows(Report_Reopened()) && $_POST['Search'])
								echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&subdepartment='.$_POST['subdepartment'].'&technician='.$_POST['technician'].'&complaintdate='.$_POST['complaintdate'].'&resolveddate='.$_POST['resolveddate'].'&Search=1")\'>Download</a>';
							?>
						</td>
					</tr>
				</table>
			</form>
			<hr/>
		</div>
	<?php
	}
	else if($_GET['subpage']=='Biomedical')
	{ ?>
		<div class="form panel">
			<form action="" method="post">
			<hr/>
			<table>
				<tr>
					<td>
						<b>Department:</b>
						<br/>
						<select name="department" id="department">
							<?php
								echo '<option value="">All</option>';
								$SelectDepartment = Reports_BioDepartments();
								while($FetchDepartment = mysqli_fetch_array($SelectDepartment))
								{
									if($_POST['department'] == $FetchDepartment['id'])
										echo '<option value="'.$FetchDepartment['id'].'" selected>'.$FetchDepartment['name'].'</option>';
									else
										echo '<option value="'.$FetchDepartment['id'].'">'.$FetchDepartment['name'].'</option>';
								} ?>
						</select>
					</td>
					<td>
						<b>Technician:</b>
						<br/>
							<select name="technician" id="technician">
							<option value="">All</option>
							<?php
							if($_SESSION['roleid'] == '5')
							{
								$SelectGroup = Reports_Technician_Biomedical();
								while($FetchGroup = mysqli_fetch_array($SelectGroup))
								{
									if($_POST['technician'] == $FetchGroup['id'])
										echo '<option value="'.$FetchGroup['id'].'" selected>'.$FetchGroup['firstname'].'</option>';
									else
										echo '<option value="'.$FetchGroup['id'].'" >'.$FetchGroup['firstname'].'</option>';
								}
							}
							else if($_SESSION['roleid'] == '1')
							{
								$SelectTechnician = mysqli_query($_SESSION['connection'],"Select * From user where (userroleid='3' and groupid='3') order by firstname asc");	
								while($FetchTechnician = mysqli_fetch_array($SelectTechnician))
								{
									if($_POST['technician'] == $FetchTechnician['id'])
										echo '<option value="'.$FetchTechnician['id'].'" selected>'.$FetchTechnician['firstname'].'</option>';
									else
										echo '<option value="'.$FetchTechnician['id'].'" >'.$FetchTechnician['firstname'].'</option>';
								}
							} ?>
						</select>
					</td>
					
					<td>
						<b>Status:</b>
						<br/>
						<select name="status" id="status">
							<?php
							echo '<option value="">All</option>';
							$SelectStatus = Reports_BioStatuses_All();
							while($FetchStatus = mysqli_fetch_array($SelectStatus))
							{
								if($_POST['status'] == $FetchStatus['id'])
									echo '<option value="'.$FetchStatus['id'].'" selected>'.$FetchStatus['name'].'</option>';
								else
									echo '<option value="'.$FetchStatus['id'].'">'.$FetchStatus['name'].'</option>';
							} ?>
						</select>
					</td>
					
					<td>
						<b>Equipment:</b>
						<br/>
						<select name="equipment" id="equipment">
							<?php
							echo '<option value="">All</option>';
							$Selectequipment = Reports_Equipments_All();
							while($FetchEquipment = mysqli_fetch_array($Selectequipment))
							{
								if($_POST['equipment'] == $FetchEquipment['id'])
									echo '<option value="'.$FetchEquipment['id'].'" selected>'.$FetchEquipment['equipment'].'</option>';
								else
									echo '<option value="'.$FetchEquipment['id'].'">'.$FetchEquipment['equipment'].'</option>';
							} ?>
						</select>
					</td>
					<td>
						<b>Critical Equipment</b>
						<?php 
							if($_POST['critical']) 	
								echo  '<input type="checkbox" name="critical" id="critical" value="1" checked></input>';
							else	
								echo  '<input type="checkbox" name="critical" id="critical" value="1"></input>';
						?>	
					</td>
				</tr>
				<tr>
					<td>
						<b>Start Date:</b>
						<br/>
						<input type="text" name="complaintdate" id="complaintdate" value="<?php if($_POST['complaintdate']) echo $_POST['complaintdate']; else echo date('d-m-Y', strtotime("-30 days"));?>">
					</td>
					<td style="padding-right:20px;">
						<b>End Date:</b>
						<br/>
						<input type="text" name="resolveddate" id="resolveddate" value="<?php if($_POST['resolveddate']) echo $_POST['resolveddate']; else echo date('d-m-Y');?>">
					</td>
					<td>
						<br/>
						<input type="submit" class="button button-green" name="Search" value="Search">&nbsp;
						<?php
						//if(mysqli_num_rows(Report_All()) && $_POST['Search'])
							//echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&DeprtmentId='.$_GET['DeprtmentId'].'&TechnicianId='.$_GET['TechnicianId'].'&ZoneId='.$_GET['ZoneId'].'&StatusId='.$_GET['StatusId'].'&ComplaintDate='.$_GET['ComplaintDate'].'&ResolvedDate='.$_GET['ResolvedDate'].'")\'>Download</a>';
						if(mysqli_num_rows(Report_BiomedicalAll()) && $_POST['Search'])
							echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&department='.$_POST['department'].'&technician='.$_POST['technician'].'&status='.$_POST['status'].'&equipment='.$_POST['equipment'].'&critical='.$_POST['critical'].'&complaintdate='.$_POST['complaintdate'].'&resolveddate='.$_POST['resolveddate'].'&Search=1")\'>Download</a>';
						?>
					</td>
				</tr>
			</table>
			<hr/>
			</form>
		</div>
	<?php
	}
	else if($_GET['subpage'] == 'BiomedicalKPI')
	{
		echo '<div class="form panel">
				<hr/>
				<table>
					<tr>
						<td>
							<b>Year</b>
							<br/>
							<select name="year" id="year">
							<option value="Select">Select</option>';
							for($i=2012;$i<=date('Y');$i++)
							{	
								if($_GET['Year'] == $i || (!$_GET['Year'] && $i == date('Y')))
									echo '<option value="'.$i.'" selected>'.$i.'</option>';
								else 
									echo '<option value="'.$i.'">'.$i.'</option>';
							}
							echo '</select>
						</td>
						<td><b>Month</b>
							<br/>
							<select name="month" id="month">
							<option value="Select">Select</option>';
							$months = array("January","Febuary","March","April","May","June","July","August","September","October","November","December");			
							for($i=0;$i<count($months);$i++)
							{
								$var = $i+1;
								if($_GET['Month'] == $var || (!$_GET['Month'] && $var == date('m')))
									echo '<option value="'.$var.'" selected>'.$months[$i].'</option>';
								else
									echo '<option value="'.$var.'">'.$months[$i].'</option>';
							}
							echo '</select>
						</td>
						<td><br/>
						<a class="button button-green" onclick="GetValuesByMonthly1(\'chart\')">Search</a>&nbsp;';
						if($_GET['Month'] && $_GET['Year'] && mysqli_num_rows(BiomedicalKPIReports_All_Month_And_Year($_GET['Month'],$_GET['Year'])))
							echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&Month='.$_GET['Month'].'&Year='.$_GET['Year'].'")\'>Download</a>';
					echo	'</td>
					</tr>
				</table>
			</div>';
	}
	else if($_GET['subpage'] == 'Priority Summary')
	{ ?>
		<div class="form panel" style="width:650px">
			<form action="" method="post">
				<hr/>
				<table>
					<tr>
						<td>
							<b>Start Date:</b>
							<br/>
							<input type="text" name="complaintdate" id="complaintdate" value="<?php if($_GET['ComplaintDate']) echo $_GET['ComplaintDate']; else echo date('d-m-Y', strtotime("-30 days"));?>">
						</td>
						<td style="padding-right:20px;">
							<b>End Date:</b>
							<br/>
							<input type="text" name="resolveddate" id="resolveddate" value="<?php if($_GET['ResolvedDate']) echo $_GET['ResolvedDate']; else echo date('d-m-Y');?>">
						</td>
						<td>
							<br/>
							<a class="button button-green" onclick="GetValuesByDates()">Search</a>
							<?php
							if($_GET['ComplaintDate'] && $_GET['ResolvedDate'])
								echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&ComplaintDate='.$_GET['ComplaintDate'].'&ResolvedDate='.$_GET['ResolvedDate'].'")\'>Download</a>';
							?>
						</td>
					</tr>
				</table>
				<hr/>
			</form>	
		</div>
	<br />
<?php	} 
	else if($_GET['subpage'] == 'Priority Details')
	{ ?>
	<div class="form panel">
			<form method='post' action=''>
				<hr/>
				<table>
					<tr>
						<td>
							<b>Priority:</b>
							<br/>
							<select name="priority" id="priority">
								<?php
									echo '<option value="">All</option>';
									$Priorityname = mysqli_query($_SESSION['connection'],"SELECT * FROM priority order by id asc");
									while($FetchPriority = mysqli_fetch_array($Priorityname))
									{
										if($_POST['priority'] == $FetchPriority['id'])
											echo '<option value="'.$FetchPriority['id'].'" selected>'.$FetchPriority['name'].'</option>';
										else
											echo '<option value="'.$FetchPriority['id'].'">'.$FetchPriority['name'].'</option>';
									} ?>
							</select>
						</td>
						
						<td>
							<b>Start Date:</b>
							<br/>
							<input type="text" name="complaintdate" id="complaintdate" value="<?php if($_POST['complaintdate']) echo $_POST['complaintdate']; else echo date('d-m-Y', strtotime("-30 days"));?>">
						</td>
						<td style="padding-right:20px;">
							<b>End Date:</b>
							<br/>
							<input type="text" name="resolveddate" id="resolveddate" value="<?php if($_POST['resolveddate']) echo $_POST['resolveddate']; else echo date('d-m-Y');?>">
						</td>
						<td>
							<br/>
							<input type="submit" class="button button-green" name="Search" value="Search">&nbsp;
							<?php
							if(mysqli_num_rows(Report_Department()) && $_POST['Search'])
								echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&priority='.$_POST['priority'].'&complaintdate='.$_POST['complaintdate'].'&resolveddate='.$_POST['resolveddate'].'&Search=1")\'>Download</a>';
							?>
						</td>
					</tr>
				</table>
			</form>
			<hr/>
		</div>
<?php	} 
	else
	{ ?>
		<div class="form panel">
			<form action="" method="post">
			<hr/>
			<table>
				<tr>
					<td>
						<b>Department:</b>
						<br/>
						<select name="department" id="department">
							<?php
								echo '<option value="">All</option>';
								$SelectDepartment = Reports_Departments();
								while($FetchDepartment = mysqli_fetch_array($SelectDepartment))
								{
									if($_POST['department'] == $FetchDepartment['id'])
										echo '<option value="'.$FetchDepartment['id'].'" selected>'.$FetchDepartment['name'].'</option>';
									else
										echo '<option value="'.$FetchDepartment['id'].'">'.$FetchDepartment['name'].'</option>';
								} ?>
						</select>
					</td>
					<td>
						<b>Technician:</b>
						<br/>
							<select name="technician" id="technician">
							<option value="">All</option>
							<?php
							if($_SESSION['roleid'] == '5')
							{
								$SelectGroup = Reports_Technician();
								while($FetchGroup = mysqli_fetch_array($SelectGroup))
								{
									if($_POST['technician'] == $FetchGroup['id'])
										echo '<option value="'.$FetchGroup['id'].'" selected>'.$FetchGroup['firstname'].'</option>';
									else
										echo '<option value="'.$FetchGroup['id'].'" >'.$FetchGroup['firstname'].'</option>';
								}
							}
							else if($_SESSION['roleid'] == '1')
							{
								$SelectTechnician = mysqli_query($_SESSION['connection'],"Select * From user where (userroleid='3' and groupid='".$_SESSION['groupid']."') order by firstname asc");	
								while($FetchTechnician = mysqli_fetch_array($SelectTechnician))
								{
									if($_POST['technician'] == $FetchTechnician['id'])
										echo '<option value="'.$FetchTechnician['id'].'" selected>'.$FetchTechnician['firstname'].'</option>';
									else
										echo '<option value="'.$FetchTechnician['id'].'" >'.$FetchTechnician['firstname'].'</option>';
								}
							} ?>
						</select>
					</td>
					<td>
						<b>Zone:</b>
						<br/>
						<select name="zone" id="zone">
							<?php
							echo '<option value="">All</option>';
							$SelectZone = Reports_Zones();
							while($FetchZone = mysqli_fetch_array($SelectZone))
							{
								if($_POST['zone'] == $FetchZone['id'])
									echo '<option value="'.$FetchZone['id'].'" selected>'.$FetchZone['name'].'</option>';
								else
									echo '<option value="'.$FetchZone['id'].'" >'.$FetchZone['name'].'</option>';
							} ?>
						</select>
					</td>
					<td>
						<b>Status:</b>
						<br/>
						<select name="status" id="status">
							<?php
							echo '<option value="">All</option>';
							$SelectStatus = Reports_Statuses_All();
							while($FetchStatus = mysqli_fetch_array($SelectStatus))
							{
								if($_POST['status'] == $FetchStatus['id'])
									echo '<option value="'.$FetchStatus['id'].'" selected>'.$FetchStatus['name'].'</option>';
								else
									echo '<option value="'.$FetchStatus['id'].'">'.$FetchStatus['name'].'</option>';
							} ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<b>Start Date:</b>
						<br/>
						<input type="text" name="complaintdate" id="complaintdate" value="<?php if($_POST['complaintdate']) echo $_POST['complaintdate']; else echo date('d-m-Y', strtotime("-30 days"));?>">
					</td>
					<td style="padding-right:20px;">
						<b>End Date:</b>
						<br/>
						<input type="text" name="resolveddate" id="resolveddate" value="<?php if($_POST['resolveddate']) echo $_POST['resolveddate']; else echo date('d-m-Y');?>">
					</td>
					<td>
						<br/>
						<input type="submit" class="button button-green" name="Search" value="Search">&nbsp;
						<?php
						//if(mysqli_num_rows(Report_All()) && $_POST['Search'])
							//echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&DeprtmentId='.$_GET['DeprtmentId'].'&TechnicianId='.$_GET['TechnicianId'].'&ZoneId='.$_GET['ZoneId'].'&StatusId='.$_GET['StatusId'].'&ComplaintDate='.$_GET['ComplaintDate'].'&ResolvedDate='.$_GET['ResolvedDate'].'")\'>Download</a>';
						if(mysqli_num_rows(Report_All()) && $_POST['Search'])
							echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&department='.$_POST['department'].'&technician='.$_POST['technician'].'&zone='.$_POST['zone'].'&status='.$_POST['status'].'&complaintdate='.$_POST['complaintdate'].'&resolveddate='.$_POST['resolveddate'].'&Search=1")\'>Download</a>';
						?>
					</td>
				</tr>
			</table>
			<hr/>
			</form>
		</div>
	<?php	
	}
	include("includes/Export.php");
	?>
<script>
	function GetValuesByDates()
	{
		var ComplaintDate = document.getElementById('complaintdate').value, ResolvedDate = document.getElementById('resolveddate').value;
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&ComplaintDate="+ComplaintDate+"&ResolvedDate="+ResolvedDate);
	}
	function GetValuesByMonthly()
	{
		var Month = document.getElementById('month').value, Year = document.getElementById('year').value;
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&Month="+Month+"&Year="+Year);
	}	
	function GetValuesByMonthly1(chart)
	{
		var chart = "chart";
		var Month = document.getElementById('month').value, Year = document.getElementById('year').value;
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&Month="+Month+"&Year="+Year+"&chart="+chart);
	}	
	function GetValuesByMoreMonthly()
	{
		var Month = document.getElementById('moremonth').value, Year = document.getElementById('moreyear').value;
		var Months="",i;
		for (i=0;i<document.getElementById('moremonth').length;i++) {
			if (document.getElementById('moremonth')[i].selected) {
				Months = Months + i + " ";
			}
		}
		document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&Month="+Months+"&Year="+Year);
	}
	function Export(PostBackValues)
	{
		window.open("includes/Export.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
	function Asset_Values(Division,Department)
	{
		var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var results = xmlhttp.responseText;
				var values = results.split("#");
				if(Division)
					var select = document.getElementById('departmentid');
				else if(Department)
					var select = document.getElementById('locationid');
				select.options.length = 0; 	//For remove all options of dropdown list
				
				for(var i = 0; i < values.length; i++)
				{
					if(i%2 == 0)
						select.options[select.options.length] = new Option(values[i],values[i+1]);
				}
			}
		}
		xmlhttp.open("GET","includes/Assets_Department_Location.php?Division="+Division+"&Department="+Department,true);
		xmlhttp.send();
	}
</script>