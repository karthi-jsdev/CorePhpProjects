<?php 
	session_start();
	include("includes/config.php");
		ini_set( "display_errors", "0" );
		if($_POST['submit'])
		{
			foreach($_POST['product'] as $result)
			{
				$results .= $result.",";
			}
			foreach($_POST['cat'] as $cat)
			{
				$category .= $cat.",";
			}
			mysql_query("insert into user(username,password,contact,role,assignee,product,category) values ('".$_POST['username']."','".$_POST['password']."','".$_POST['contact']."','".$_POST['role']."','".$_POST['Assignees']."','".$results."','".$category."')");
			echo "<script>alert('successfully created')</script>";
		}
		if($_POST['update'])
		{
			foreach($_POST['product'] as $result)
			{
				$results .= $result.",";
			}
			foreach($_POST['cat'] as $cat)
			{
				$category .= $cat.",";
			}
			mysql_query("update user set username='".$_POST['username']."',password='".$_POST['password']."',contact='".$_POST['contact']."',role='".$_POST['role']."',assignee ='".$_POST['Assignees']."', product='".$results."',category='".$category."' WHERE id='".$_POST['id']."'");
			echo '<script type="text/javascript">alert("USER NAME is '.$_POST['username'].'\n\n Successfully Updated."); </script>
			USERNAME is '.$_POST['username'].' Successfully Updated';
		}
		if($_GET['id'] && $_GET['edit'])
		{
			$query = mysql_query("SELECT * FROM user WHERE id='".$_GET['id']."'");
			$row = mysql_fetch_array($query);
		}
		
		if($_GET['del'])
		{
			mysql_query("DELETE FROM user WHERE id='".$_GET['id']."'");
		}	
?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Pentamine Technology- Admin Panel</title>
<link rel="stylesheet" media="screen" href="../css/reset.css" />
<link rel="stylesheet" media="screen" href="../css/style.css" />
<link rel="stylesheet" media="screen" href="../css/messages.css" />
<link rel="stylesheet" media="screen" href="../css/forms.css" />
<link rel="stylesheet" media="screen" href="../css/uniform.aristo.css" />
<!--link rel="stylesheet" media="screen" href="../css/tables.css" /-->
<link rel="stylesheet" media="screen" href="../css/visualize.css" />
<link rel="stylesheet" media="screen" href="../css/action-buttons.css" />
<link rel="stylesheet" type="text/css" href="../style.css">
<!-- jquerytools -->
<script src="../js/jquery.tools.min.js"></script>
<script type="text/javascript" src="../js/jquery.uniform.min.js"></script>
<script src="../js/visualize.jQuery.js"></script>
<!--header id="page-header"-->
    <!--div class="wrapper"-->
	
    <!--/div-->
	<!--div id="page-subheader">
        <div class="wrapper">
            <h2>
            	<?php
            	if($_GET['page']=="" || $_GET['page']=="dashboard")
				{
					echo "Dashboard";
				} ?>
            </h2>
        </div>
    </div-->
<!--/header-->
<br/>
<html>
	<head><link rel="stylesheet" type="text/css" href="style.css">
	<style>
			div.scrollWrapper
			{
			  height:300px;
			  width:1290px;
			  overflow:scroll;
			}
		</style>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script>
		function validateForm(form)
		{
			if(form.username.value == "") 
			{
				alert("Please enter username!");
				form.username.focus();
				return false;
			}
			if(form.password.value == "") 
			{
				alert("Please enter password!");
				form.password.focus();
				return false;
			}
			if(form.repassword.value == "") 
			{
				alert("Please enter repassword!");
				form.repassword.focus();
				return false;
			}
			if(form.password.value != form.repassword.value) 
			{
				alert("Please enter correct password!");
				form.repassword.focus();
				return false;
			}
			}
			function confirmation() {
					var answer = confirm("Delete Lead?")
					if (!answer){
						
						window.location = "by_hand.php";
						}
				}		
				
		</script>	
	</head>
	<div class="grid_6 first">
	<body style="background-color:#d0e4fe;">
		<form action="?page=user" method="post" onSubmit="return validateForm(this);" name="form" id="form" class="form panel">
		<header>
		<h2>PENTAMINE TECHNOLOGIES ADMIN REGISTRATION</h2>
	</header>
		<hr>
			<fieldset>
				<div class="clearfix">
					<label>User Name:</label>
					<?php
							echo '<input type="text" name="username" value="'.$row['username'].'" autocomplete="off">';
						?>
				</div>
				<div class="clearfix">
					<label>Password:</label>
					<?php echo '<input type="password" name="password" value="'.$row['password'].'">'; ?>
				</div>		
				<div class="clearfix">
					<label>Re-Type Password:</label>
					<input type="password" name="repassword" value="<?php echo $row['password'];?>">
				</div>	
				<div class="clearfix">
					<label>Contact:</label>
					<?php
						echo '<input type="text" name="contact"  value="'.$row['contact'].'" autocomplete="off">';
					?>
				</div>
				<div class="clearfix">
					<label>Role:</label>
						<select name="role" >
							<option value="Select" >Select</option>
							<?php
								if($row['role'] == "admin")
									echo '<option value="admin" selected>Admin</option>';
								else
									echo '<option value="admin" >Admin</option>';
								
								if($row['role'] == "user")
									echo '<option value="user" selected>User</option>';
								else
									echo '<option value="user" >User</option>';
							?>
						</select> 
				</div>
				<div class="clearfix">
					<label>Assignee:</label>
					<select name="Assignees" >
							<option value="Select" >Select</option>
							<?php
							$query2=mysql_query("select * from assignee");
							while($row1=mysql_fetch_array($query2))
							{
								if($_GET['edit'] && $row['assignee']==$row1['name'])
									echo "<option value='".$row1['name']."' selected>".$row1['name']."</option>";
								else
									echo "<option value='".$row1['name']."' >".$row1['name']."</option>";
							}
							?>
						</select> 	
				</div>
				<div class="clearfix">
						<label>Category:</label>
						<?php
							$category = array("Team Lead","Developer","Tester");
							$exp_cat = explode(",",$row['category']);
							foreach($category as $cat)
							{
								$exist = 0;
								foreach($exp_cat as $ex)
								{
									if($_GET['edit'] && $ex==$cat)
									{
										echo "<span class='radio-input'><input type='checkbox' value='".$cat."' name='cat[]' checked />".$cat."</span>";
										$exist = 1;
										break;
									}
								}
								if(!$exist)
									echo "<span class='radio-input'><input type='checkbox' value='".$cat."' name='cat[]'/>".$cat."</span>";
							}
						?>	
				</div>	
				<div class="clearfix">
					<label>Product:</label>
						<?php
							$query = mysql_query('SELECT * FROM producttype');
							$pre = explode(',',$row['product']);
							while($row1 = mysql_fetch_array($query))
							{
								$exists = 0;
								foreach($pre as $pre1)
								{
									if($_GET['edit'] && $pre1 == $row1['slno'])
									{
										echo '<span class="radio-input"><input type="checkbox" name="product[]" value="'.$row1['slno'].'" checked />'.$row1['type'].'</span>';
										$exists = 1;
										break;
									}
								}
								if(!$exists)
									echo '<span class="radio-input"><input type="checkbox" name="product[]" value="'.$row1['slno'].'" />'.$row1['type'].'</span>';
										
							}
						?>
					</div>	
			</fieldset>
			<hr>
			<?php
				if($_GET['edit'])
				{
					echo '<button class="button button-green" type="hidden" name="update" value="update" >update</button>';
					echo '<input type="hidden" name="id" value="'.$_GET['id'].'">';
				}
				else
					echo '<button class="button button-green" type="submit" name="submit" value="Submit">Submit</button>';
			?>			
		</form>
	</body>
</html>
<br /><br />
		<div style="float:left;margin-top:0px;margin-left:20px;width:50px">
		<?php
			$result = mysql_query("SELECT * FROM user");
			if(!mysql_num_rows($result))
				echo '<tr><td colspan="5"><font color="red"><center>No data found</center></font></td></tr>';
			$rowsperpage = 10;
			$total_pages = ceil(mysql_num_rows($result) / $rowsperpage);
				
			if($_GET['pageno']>1)
				$Limit = "LIMIT ".(($_GET['pageno']-1)*$rowsperpage).",".$rowsperpage;
			else
				$Limit = "LIMIT 0,".$rowsperpage;
				
			$query = mysql_query("SELECT * FROM user ORDER BY id Desc $Limit");
			if(mysql_num_rows($query))
			{
			echo "<div style='width:900px;height:550px;overflow-x:scroll;overflow-y:auto;'>
				<table border='1'  align= 'left' class='paginate sortable full'>
						<tr>
							<th>User Name</th>
							<th>Password</th>
							<th>Contact</th>
							<th>Role</th>
							<th>Assignee</th>
							<th>Category</th>
							<th>Products</th>
						</tr>";
			}
	while($row = mysql_fetch_array($query))
	{
	echo    "<tr>
				<td>".$row['username']."</td>
				<td>".$row['password']."
				</td>
				<td>".$row['contact']."
				</td>
				<td>".$row['role']."
				</td>
				<td>".$row['assignee']."
				</td>
				";
				$ids = explode(',',$row['product']);
				$cat = explode(',',$row['category']);
				echo 	"<td>";
				for($i = 0; $i < count($cat); $i++)
				{
					if($cat[$i] != "")
						echo $cat[$i].",";
				}
		echo 	"	</td>";
		echo 	"<td>";
				for($i = 0; $i < count($ids); $i++)
				{
					$query1 = mysql_query("SELECT * FROM producttype WHERE slno='".$ids[$i]."'");
					$row1 = mysql_fetch_array($query1);
					echo $row1['type'].",";
				}
		echo 	"	</td><td>
					<a href='?page=user&id=".$row['id']."&edit=1'><img src='images/edit.png' title='edit' /></a>
					<a href='?page=user&id=".$row['id']."&del=1' onclick='confirmation()'><img src='images/delete.png' title='delete' /></a>
				</td>
			</tr>";
	}
	echo "</table></div></div>";
	echo '<div style="float:left;margin-top:-0px;margin-left:650px;width:2000px">';
		
		include("includes/pagination.php");
		echo '</div>';
?>