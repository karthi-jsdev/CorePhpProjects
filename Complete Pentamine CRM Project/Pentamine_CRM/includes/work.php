<?php
	include("config.php");
	session_start();
	$category = explode(",",$row1['category']);
	foreach($_POST['developer'] as $result)
	{
		$results .= $result.",";
	}
	foreach($_POST['tester'] as $tester)
	{
		$testers .= $tester.",";
	}
	
	if($_POST['submit'])
	{
		$count = mysql_query("SELECT id FROM work ORDER BY id DESC");
		$idval = mysql_fetch_array($count);
		$var = "PTWKID-00".($idval['id']+1);
		//echo $var."+".$_POST['client']."+".$_POST['lead']."+".$_POST['description']."+".$_POST['tdate']."+".$_POST['developer']."+".$_POST['tester'];
		//mysql_query("INSERT INTO work(work_id,client,lead,desc,tdate,developer,tester) values('".$var."','".$_POST['client']."','".$_POST['lead']."', htmlspecialchars($_POST['description']).
		$FetchDescription = mysql_fetch_array(mysql_query("Select * From lead Where ptclid='".$_POST['lead']."'"));
		mysql_query("INSERT INTO work values('null','".$var."','".$_POST['client']."','".$_POST['lead']."',
		'".$_POST['tdate']."','".$results."','".$testers."','".$FetchDescription['ldesc']."','".$_POST['plead']."','".$_POST['priority']."','".date("Y-m-d")."')");
		mysql_query("INSERT INTO workstatus(work_id,description,status,enable) values('".$var."','".$_POST['description']."','Open','1')");
	}
	if($_GET['edit'])
	{
		$editWork = mysql_fetch_array(mysql_query("SELECT * FROM work WHERE id='".$_GET['id']."'"));
	}
	if($_POST['update'])
	{
		mysql_query("UPDATE work SET client='".$_POST['client']."', lead='".$_POST['lead']."',  tdate='".$_POST['tdate']."',developer='".$results."', tester='".$testers."', description='".htmlspecialchars($_POST['description'])."', projectleads='".$_POST['plead']."',priority='".$_POST['priority']."' WHERE id='".$_POST['id']."'");//, lead='".$_POST['lead']."', desc='".$_POST['description']."', tdate='".$_POST['tdate']."',  ");
	}
?>
<html>
	<head>
		<script src="script/datepicker/jquery-1.5.1.js"></script>
		<script src="script/datepicker/jquery.ui.core.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/wysiwyg.js"></script>
		<script src="script/datepicker/jquery.ui.datepicker.js"></script>
		<script>
			function lead_change(lead)
			{
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
						var select = document.getElementById('lead');
						select.options.length = 0; 	//For remove all options of dropdown list
						
						for(var i = 0; i < values.length; i++)
						{
							if(i%2 == 0)
								select.options[select.options.length] = new Option(values[i],values[i+1]);
						}
					}
				}
				xmlhttp.open("GET","includes/getleads.php?q="+lead,true);
				xmlhttp.send();
			}
			$(document).ready(function()
			{
				$("#tdate").datepicker(
				{
					dateFormat: 'yy-mm-dd',
					showOn: "button",
					buttonImage: "images/calendar.png",
					buttonImageOnly: true
				});
			});
		</script>
	</head>
	<body>
		<div style="float:left;margin-top:25px;margin-left:1000px;width:500px">
			<button onclick="window.location.href='?page=worksummary'">Work Summary</button>
		</div>
		<div class="grid_6 first">
			<form action="?page=work" method="post" class="form panel" id="form">
				<header>
					<h2>Work</h2>
				</header>
				<hr>
				<fieldset>
					<div class="clearfix">
						<label>Client:</label>
							<select name="client" onchange="lead_change(this.value)">
								<option value="Select">Select</option>
								<?php 
									if($_GET['ptcid'])
									{
										$client = mysql_query("SELECT * FROM client WHERE ptcid='".$_GET['ptcid']."'");
										$clientRow = mysql_fetch_array($client);
										echo "<option value=".$clientRow['ptcid']." selected>".$clientRow['cname']."</option>";
									}
									else
									{
										$client = mysql_query("SELECT * FROM client");
										
										//$lead = mysql_fetch_array(mysql_query("select * from lead where ptclid='".$_GET[ptclid]."'"));
										while($clientRow = mysql_fetch_array($client))
										{
											if($editWork['client'] == $clientRow['ptcid'])
												echo "<option value=".$clientRow['ptcid']." selected>".$clientRow['cname']."</option>";
											else
												echo "<option value=".$clientRow['ptcid'].">".$clientRow['cname']."</option>";
										}
									}
								?>
							</select>
					</div>
					<div class="clearfix">
						<label>Lead:</label>
							<select name="lead" id="lead">
								<option value="Select">Select</option>
								<?php
								if($_GET['ptclid'] && !$_GET['edit'])
								{
									$leads = mysql_query('SELECT * FROM lead WHERE ptclid="'.$_GET['ptclid'].'"');
									$leadrow= mysql_fetch_array($leads);
									$ExplodeDescription = explode(' ',$leadrow['ldesc']);
									echo "<option value=".$leadrow['ptclid']." selected>".$ExplodeDescription[0].' '.$ExplodeDescription[1].' '.$ExplodeDescription[2].' '.$ExplodeDescription[3].'-'.$leadrow['ptclid']."</option>";
								}
								if($_GET['edit'] && $_GET['id'])
								{	
									$leads = mysql_query('SELECT * FROM lead WHERE cname="'.$editWork['client'].'"');
									while($Leads = mysql_fetch_array($leads))
									{
										$ExplodeDescription = explode(' ',$Leads['ldesc']);
										if($Leads['ptclid'] == $editWork['lead'])
											echo '<option value='.$Leads['ptclid'].' selected>'.$ExplodeDescription[0].' '.$ExplodeDescription[1].' '.$ExplodeDescription[2].' '.$ExplodeDescription[3].'-'.$Leads['ptclid'].'</option>';
										else
											echo '<option value='.$Leads['ptclid'].'>'.$ExplodeDescription[0].' '.$ExplodeDescription[1].' '.$ExplodeDescription[2].' '.$ExplodeDescription[3].'-'.$Leads['ptclid'].'</option>';
									}
								}
								?>
							</select>
					</div>
					<div class="clearfix">
						<label>Description:</label>
						<?php 
							echo '<textarea name="description" id="description">'.$editWork['description'].'</textarea>';
						?>
						<script language="javascript1.2">
							generate_wysiwyg('description');
						</script>
					</div>
					<br/>
					<div class="clearfix">
						<label>Priority:</label>
						<select name="priority">
							<?php 
								$priority = array("Select","Low","Medium","High");
								foreach($priority as $prior)
								{
									if($_GET['edit'] && $editWork['priority'] == $prior)
										echo "<option value=".$prior." selected>".$prior."</option>";
									else
										echo "<option value=".$prior.">".$prior."</option>";
								}
							?>
						</select>
					</div>
					<div class="clearfix">
						<label>Target Date:</label>
						<input type="text" id="tdate" name="tdate" value="<?php echo $editWork['tdate'];?>">
					</div>
					
					<?php
						for($i = 0; $i < count($category); $i++)
						{
							if($category[$i] == "Team Lead")
							{
							echo '<div class="clearfix">
									<label>Project Lead:</label>
									<select name="plead">
										<option value="Select">Select</option>';
											$projectLead = mysql_query("SELECT * FROM assignee");
											while($developerRow = mysql_fetch_array($projectLead))
											{
												if($editWork['projectleads'] == $developerRow['name'])
													echo "<option value=".$developerRow['name']." selected>".$developerRow['name']."</option>";
												else
													echo "<option value=".$developerRow['name'].">".$developerRow['name']."</option>";
											}
									echo '</select></div>';
							}
							else if($category[$i] == 'Developer')
							{
								echo '<div class="clearfix">
										<label>Developers:</label>';
								$var = explode(',',$editWork['developer']);
								$developer = mysql_query("SELECT * FROM assignee");
								echo "";
								while($developerRow = mysql_fetch_array($developer))
								{
									$exist = 0;
									//echo "<span class='radio-input'>";
									foreach($var as $v)
									{
										if($_GET['edit'] && $v == $developerRow['name'])
										{
											echo "<span class='radio-input'><input type='checkbox' name='developer[]' value='".$developerRow['name']."' checked/>".$developerRow['name']."</span>";
											$exist = 1;	
											break;
										}
									}
									if(!$exist)
										echo "<span class='radio-input'><input type='checkbox' name='developer[]' value='".$developerRow['name']."'/>".$developerRow['name']."</span>";
								}
								echo '</div>';
							}
							else if($category[$i] == 'Tester')
							{ 
								echo '<div class="clearfix">
										<label>Testers:</label>';
									$var = explode(',',$editWork['tester']);
									$tester = mysql_query("SELECT * FROM assignee");
									while($testerRow = mysql_fetch_array($tester))
									{
										$exist = 0;
										foreach($var as $v)
										{
											if($_GET['edit'] && $v == $testerRow['name'])
											{
												echo "<span class='radio-input'><input type='checkbox' name='tester[]' value='".$testerRow['name']."' checked/>".$testerRow['name']."</span>";
												$exist = 1;	
												break;
											}
										}
										
										if(!$exist)
											echo "<span class='radio-input'><input type='checkbox' name='tester[]' value='".$testerRow['name']."'/>".$testerRow['name']."</span>";
									}
								}
						}
						?>
				</fieldset>
				<hr>
					<?php
						if($_GET['edit'])
						{
							echo '<input type="hidden"  name="id" value="'.$_GET['id'].'">';
							echo '<button class="button button-green" type="submit" value="update" name="update">Update</button>';
						}
						else
							echo '<button class="button button-green" type="submit" value="submit" name="submit">Submit</button>';
					?>
			</form>
		</div>
	</body>
</html>
<br />
<?php
	$result = mysql_query("SELECT * FROM work");
	if(!mysql_num_rows($result))
		echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
	$rowsperpage = 15;
	$total_pages = ceil(mysql_num_rows($result) / $rowsperpage);
		
	if($_GET['pageno']>1)
		$Limit = "LIMIT ".(($_GET['pageno']-1)*$rowsperpage).",".$rowsperpage;
	else
		$Limit = "LIMIT 0,".$rowsperpage;
		
	$workQuery = mysql_query("SELECT * FROM work ORDER BY id Desc $Limit");
	if(mysql_num_rows($workQuery))
	{
		echo "<div style='width:1000px;height:550px;overflow-x:scroll;overflow-y:auto;'>
				<table border='1'  align= 'left' style='width:1000px' class='paginate sortable full'>
			<tr>
				<th align='left'>Work-ID</th>
				<th align='left'>Client Name</th>
				<th align='left'>Description</th>
				<th align='left'>Priority</th>
				<th align='left'>Project Lead</th>
				<th align='left'>Target Date</th>
				<th align='left'>Developer</th>
				<th align='left'>Tester</th>
			</tr>";
	}
	while($fetchWork = mysql_fetch_array($workQuery))
	{
		echo "<tr>
				<td>".$fetchWork['work_id']."</td>";
				$getClient = mysql_fetch_array(mysql_query("SELECT * FROM client WHERE ptcid = '".$fetchWork['client']."'"));
				echo "<td>".$getClient['cname']."</td>
				<td>".$fetchWork['description']."</td>
				<td>".$fetchWork['priority']."</td>
				<td>".$fetchWork['projectleads']."</td>
				<td>".$fetchWork['tdate']."</td>
				<td>".$fetchWork['developer']."</td>
				<td>".$fetchWork['tester']."</td>
				<td>
					<a href='?page=work&id=".$fetchWork['id']."&edit=1'><img src='images/edit.png' title='edit' /></a>
				</td>
			</tr>";
	}
	echo "</table></div>";
		echo '<div style="float:left;margin-top:20px;margin-left:400px;width:2000px">';
		include("includes/pagination.php");
		echo '</div>';
?>