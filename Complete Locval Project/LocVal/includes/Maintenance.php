<div class='content-bottom'>
	<div class='section group' align='center'>
		<?php
		if(!$_SESSION['id'])
		{ ?>
			<div class='login-title'>
				<h1 align='center'>Maintenance Login</h1><br />
			</div>
			<form id="form" action="#">
				<table>
					<tr>
						<p>
							<td>User Name </td>
							<td><input type="text" id="username" required="required" placeholder="Username"/></td>
						</p>
					</tr>
					<tr>
						<p>
							<td>Password </td>
							<td><input type="password" id="password" required="required" placeholder="Password" /></td>
						</p>
					</tr>
					<tr>
						<p>
							<center>
							<td><input type="button" name='submit' value="Submit" onclick="Authentication();"/></td>
							</center>
							<input type="hidden" name="posting" id="posting" value="1" />
						</p>
					</tr>
				</table>	
			</form>
		<?php
		}
		else if($_SESSION['id'])
		{ ?>
			<ul>
				<?php
				$subheaders = array("State","County","City","Metro Market","Manage Announcements");
				for($i = 0; $i < count($subheaders); $i++)
				{
					$split = explode("_", $subheaders[$i]);
					for($j = 0; $j < count($split); $j++)
					{
						if($j == 0)
							$subpagename = $split[$j];
						else
							$subpagename = $subpagename." ".$split[$j];
					}
					if($_GET['page'] == $subheaders[$i])
						echo "<a class='active' style=color:black;font-weight:bold; href='index.php?page=".$subheaders[$i]."'>".$subpagename."&nbsp;&nbsp;&nbsp;</a>&nbsp;";
					else
						echo "<a href='index.php?page=".$subheaders[$i]."'>".$subpagename."&nbsp;&nbsp;&nbsp;</a>&nbsp;";
				} ?>
			</ul>
			<div class="clear"></div> 
<?php	}
		?>
	</div>
</div>
<script>
	function Authentication()
	{
		var message= "";
		if(!$("#username").val())
			messsage = "Enter the username";
		if(!$("#password").val())
			message = "Enter the password";
		if(message)
			alert(message);
		var Response = 	Ajax("POST","includes/Authentication.php","username="+$("#username").val()+"&password="+$("#password").val());
		if(Response)
			window.location.href="index.php?page=Maintenance";
	}
</script>