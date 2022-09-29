<section role="main" id="main">
	<?php
		include("Internal_PO_Queries.php");
		$userid = mysqli_fetch_assoc(Stores_Selection());
		$polist = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from internal_po where id='".$_GET['id']."'"));
		$pOlist = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from internal_po"));
		$usertotal = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select sum(user) as total from approver"));
		$approval_total = array_sum(explode(',',$pOlist['approval']));

		$userrole = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from user where id='".$_SESSION['id']."'"));
		$plist = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from internal_po join user on user.id=user join user_role on user_role.id = userrole_id where user.id='".$_SESSION['id']."'"));
		
		if(isset($_POST['Submit']))
		{
			if(empty($_POST['inhouse_categoryid']) || empty($_POST['quantity']) || empty($_POST['cost']) || empty($_POST['requirement_specification']))
				echo "<br /><div class='message error'><b>Message</b> : Mandatory Fields should not be empty</div>";
			else
			{
				PO_Insertion();
				echo "<br /><div class='message success'><b>Message</b> :PO Created Successfully</div>";
				$_POST['inhouse_categoryid']="";
				$_POST['quantity']="";
				$_POST['cost']="";
				$_POST['requirement_specification']="";
				$_POST['inhouse_statusid']="";
			}
		}
		if($_GET['id'] && $_GET['action']=='edit' && !$_POST['inhouse_categoryid']&&!$_POST['inhouse_statusid'])
		{
			$inhouse_edit = mysqli_fetch_assoc(Inhouse_Edit());
			$_POST['inhouse_categoryid']=$inhouse_edit['inhouse_categoryid'];
			$_POST['quantity']=$inhouse_edit['quantity'];
			$_POST['cost']=$inhouse_edit['cost'];
			$_POST['requirement_specification']=$inhouse_edit['requirement_specification'];
			$_POST['inhouse_statusid']=$inhouse_edit['inhouse_statusid'];
		}
		/*if(isset($_POST['SSubmit']))
		{
			if($_SESSION['id']==6||$_SESSION['id']==9)
			Inhouse_Update();
			echo "<br /><div class='message success'><b>Message</b> :PO Status Updated Successfully</div>";
			$_POST['inhouse_categoryid']="";
			$_POST['quantity']="";
			$_POST['cost']="";
			$_POST['requirement_specification']="";
			$_POST['inhouse_statusid']="";
		}*/
		if(isset($_POST['Update']))
		{
			Inhouse_Update();
			echo "<br /><div class='message success'><b>Message</b> :PO Updated Successfully</div>";
			$_POST['inhouse_categoryid']="";
			$_POST['quantity']="";
			$_POST['cost']="";
			$_POST['requirement_specification']="";
			$_POST['inhouse_statusid']="";
		}
		if($_GET['id']&&$_GET['action']=='delete')
		{
			Inhouse_Delete();
			echo "<br /><div class='message error'><b>Message</b> :PO Deleted Successfully</div>";
		}
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="" id="form" class="form panel" onsubmit="return validation()">
			<header><h2>Internal PO</h2></header>
			<hr />				
			<fieldset>
 			<input type="hidden" value="<?php echo $_POST['id'] = $_GET['id'];?>" name="id">
				<div class="clearfix">
				<?php
					$user = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"SELECT user from approver"));
					
					if(($_GET['action']=='edit') && ($userrole['userrole_id']==4 || $userrole['userrole_id']==8) && ($plist['user']==4 || $plist['user']==8))
					{?>
						<label>Department<font color="red">*</font>
						<select id="inhouse_categoryid" name="inhouse_categoryid">
							<option value="Select">Select</option>
							<?php
							//if($_GET['id'])
								//$Category = Inhouse_Edit();
							//else
							$Category = Inhouse_Category();
							while($Category_list = mysqli_fetch_assoc($Category))
							{
								if($Category_list['id'] == $_POST['inhouse_categoryid'])
									echo "<option value=".$Category_list['id']." selected>".$Category_list['name']."</option>";
								else
									echo "<option value=".$Category_list['id'].">".$Category_list['name']."</option>";
							}?>
						</select>
					</label>
					<label>Quantity <font color="red">*</font>
						<input type="text" id="quantity" name="quantity" required="required" autocomplete="off" value="<?php echo $_POST['quantity']; ?>" onkeypress="return isNumeric(event)"/>
					</label>
					<label>Cost<font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="text" id="cost"  name="cost" required="required" autocomplete="off" value="<?php echo $_POST['cost']; ?>" onkeypress="return isNumeric(event)"/>
					</label>
					<label>Requirment Specification <font color="red">*</font>
						<textarea rows="2" cols="25" id="requirement_specification" name="requirement_specification"><?php echo $_POST['requirement_specification']; ?></textarea>
					</label>
					<label>Status
						<select id="inhouse_statusid" name="inhouse_statusid">
							<option value="Select">Select</option>
							<?php
							$Status = Inhouse_Status();
							while($Status_id = mysqli_fetch_assoc($Status))
							{
								if($Status_id['id'] == $_POST['inhouse_statusid'])
									echo "<option value=".$Status_id['id']." selected>".$Status_id['status']."</option>";
								else
									echo "<option value=".$Status_id['id'].">".$Status_id['status']."</option>";
							}?>
						</select>
					</label>
				</div><?php 
					}
					else if(($_GET['action']='edit' && $_GET['id']) && ($plist['user']!=4 || $plist['user']!=8) && ($userrole['userrole_id']==4 || $userrole['userrole_id']==8))
					{
				?>
					<label>Department<font color="red">*</font>
						<select id="inhouse_categoryid" name="inhouse_categoryid" disabled>
							<option value="Select">Select</option>
							<?php
							//if($_GET['id'])
								//$Category = Inhouse_Edit();
							//else
							$Category = Inhouse_Category();
							while($Category_list = mysqli_fetch_assoc($Category))
							{
								if($Category_list['id'] == $_POST['inhouse_categoryid'])
									echo "<option value=".$Category_list['id']." selected>".$Category_list['name']."</option>";
								else
									echo "<option value=".$Category_list['id'].">".$Category_list['name']."</option>";
							}?>
						</select>
					</label>
					<label>Quantity <font color="red">*</font>
						<input type="text" id="quantity" name="quantity" required="required" autocomplete="off" disabled value="<?php echo $_POST['quantity']; ?>" onkeypress="return isNumeric(event)"/>
					</label>
					<label>Cost<font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="text" id="cost"  name="cost" required="required" autocomplete="off" disabled value="<?php echo $_POST['cost']; ?>" onkeypress="return isNumeric(event)"/>
					</label>
					<label>Requirment Specification <font color="red">*</font>
						<textarea rows="2" cols="25" id="requirement_specification" disabled name="requirement_specification"><?php echo $_POST['requirement_specification']; ?></textarea>
					</label>
					<label>Status
						<select id="inhouse_statusid" name="inhouse_statusid">
							<option value="Select">Select</option>
							<?php
							$Status = Inhouse_Status();
							while($Status_id = mysqli_fetch_assoc($Status))
							{
								if($Status_id['id'] == $_POST['inhouse_statusid'])
									echo "<option value=".$Status_id['id']." selected>".$Status_id['status']."</option>";
								else
									echo "<option value=".$Status_id['id'].">".$Status_id['status']."</option>";
							}?>
						</select>
					</label>
					</div>
					<?php } 
					 else {?>
					<div class="clearfix">
					<label>Department<font color="red">*</font>
						<select id="inhouse_categoryid" name="inhouse_categoryid">
							<option value="Select">Select</option>
							<?php
							//if($_GET['id'])
								//$Category = Inhouse_Edit();
							//else
							$Category = Inhouse_Category();
							while($Category_list = mysqli_fetch_assoc($Category))
							{
								if($Category_list['id'] == $_POST['inhouse_categoryid'])
									echo "<option value=".$Category_list['id']." selected>".$Category_list['name']."</option>";
								else
									echo "<option value=".$Category_list['id'].">".$Category_list['name']."</option>";
							}?>
						</select>
					</label>
					<label>Quantity <font color="red">*</font>
						<input type="text" id="quantity" name="quantity" required="required" autocomplete="off" value="<?php echo $_POST['quantity']; ?>" onkeypress="return isNumeric(event)"/>
					</label>
					<label>Cost<font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="text" id="cost"  name="cost" required="required" autocomplete="off" value="<?php echo $_POST['cost']; ?>" onkeypress="return isNumeric(event)"/>
					</label>
					<label>Requirment Specification <font color="red">*</font>
						<textarea rows="2" cols="25" id="requirement_specification" name="requirement_specification"><?php echo $_POST['requirement_specification']; ?></textarea>
					</label>
					<?php
					if(($userid['id']==$_SESSION['id'] && $_GET['action']=='edit' && $approval_total==$usertotal['total'] && ($polist['inhouse_statusid']==2 || $polist['inhouse_statusid']==3 || $polist['inhouse_statusid']==4)))
					{?>
					<label>Status
						<select id="inhouse_statusid" name="inhouse_statusid">
							<option value="Select">Select</option>
							<?php
							$Status = Inhouse_Status();
							while($Status_id = mysqli_fetch_assoc($Status))
							{
								if($Status_id['id'] == $_POST['inhouse_statusid'])
									echo "<option value=".$Status_id['id']." selected>".$Status_id['status']."</option>";
								else
									echo "<option value=".$Status_id['id'].">".$Status_id['status']."</option>";
							}?>
						</select>
					</label>
					<?php
					}
					else
					{?>
					<label>Status
							<select id="inhouse_statusid" name="inhouse_statusid" disabled>
								<option value="Select">Select</option>
								<?php
								$Status = Inhouse_Status();
								while($Status_id = mysqli_fetch_assoc($Status))
								{
									if($Status_id['id'] == $_POST['inhouse_statusid'])
										echo "<option value=".$Status_id['id']." selected>".$Status_id['status']."</option>";
									else
										echo "<option value=".$Status_id['id'].">".$Status_id['status']."</option>";
								}?>
							</select>
						</label>
					<?php	
					}?>
				</div>
			</fieldset>
			<hr />
			<?php
			}
			if($_GET['action']=='edit')
				echo '<button class="button button-green" type="submit" name="Update" value="Update" onclick="return Validate();">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit" onclick="return Validate();">Submit</button>&nbsp;&nbsp;';
				echo'<button class="button button-gray" type="reset">Reset</button>';
		/*	if($_SESSION['id']==6 || $_SESSION['id']==9)
			{
				if($_GET['action']=='edit' && ($approval_total==$usertotal['total'] && ($polist['inhouse_statusid']==2 || $polist['inhouse_statusid']==3 || $polist['inhouse_statusid']==4)))
				{
					echo '<button class="button button-green" type="submit" name="SSubmit">Status Submit</button>&nbsp;&nbsp;';
					echo'<button class="button button-gray" type="reset">Reset</button>';
				}
				else
				{
					echo '<button class="button button-green" type="submit" name="Submit" onclick="return Validate();">Submit</button>&nbsp;&nbsp;';
					echo'<button class="button button-gray" type="reset">Reset</button>';
				}
			}
			else if(!($_SESSION['id']==6 || $_SESSION['id']==9)&& $_GET['action']=='edit')
			{
				echo '<button class="button button-green" type="submit" name="Update" value="Update" onclick="return Validate();">Update</button>&nbsp;&nbsp;';
				echo'<button class="button button-gray" type="reset">Reset</button>';
			}
			else
			{
				echo '<button class="button button-green" type="submit" name="Submit" onclick="return Validate();">Submit</button>&nbsp;&nbsp;';
				echo'<button class="button button-gray" type="reset">Reset</button>';
			}*/
			?>
		</form>
	</div>
		<?php
		$all = mysqli_fetch_assoc(All_Count());
		$notapproved = mysqli_fetch_assoc(NotApproved_Count());
		$approved = mysqli_fetch_assoc(Approved_Count());
		$issued = mysqli_fetch_assoc(Issued_Count());
		$notissued = mysqli_fetch_assoc(NotIssued_Count());
		?>
		<div class="columns">
			<a href="?page=Stores&subpage=spage->Internal_PO&status_id=">All(<?php if(!$all['alldata']) echo $all['alldata']=0;else echo $all['alldata']; ?>)</a>
			|&nbsp;<a href="?page=Stores&subpage=spage->Internal_PO&status_id=1">NotApproved(<?php if(!$notapproved['napp']) echo $notapproved['napp']=0;else echo $notapproved['napp'];?>)</a>
			|&nbsp;<a href="?page=Stores&subpage=spage->Internal_PO&status_id=2">Approved(<?php if(!$approved['app']) echo $approved['app']=0;else echo $approved['app'];?>)</a>
			|&nbsp;<a href="?page=Stores&subpage=spage->Internal_PO&status_id=3">Issued(<?php if(!$issued['issued']) echo $issued['issued']=0;else echo $issued['issued'];?>)</a>
			|&nbsp;<a href="?page=Stores&subpage=spage->Internal_PO&status_id=4">NotIssued(<?php if(!$notissued['notissued']) echo $notissued['notissued']=0;else echo $notissued['notissued'];?>)</a>
			<hr />	
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.No.</th>
						<th align="left">Department</th>
						<th align="left">Requirement Specification</th>
						<th align="left">Quantity</th>
						<th align="left">Cost</th>
						<th align="left">User</th>
						<th align="left">Status</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$totaldata = mysqli_fetch_assoc(Inhouse_Selection_ByCount());
					$i=1;
					$Limit = 10;
					if(!$totaldata['total'])
						echo'<tr><td style="color:#FF0000;" colspan="16"><center>No data Found</center></td></tr>';
					$total_pages = ceil($totaldata['total'] / $Limit);
					if(!$_GET['pageno'])
						$_GET['pageno'] = 1;
					$i = $Start = ($_GET['pageno']-1)*$Limit;
					$i++;
					$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");		
	
					$userid = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from user join approver on user.id=approver.user where user.id='".$_SESSION['id']."'"));
					$PO_list = Inhouse_Selection($Start,$Limit);	
					while($POlist = mysqli_fetch_assoc($PO_list))
					{			
						echo'<tr>
								<td>'.$i++.'</td>
								<td>'.$POlist['name'].'</td>
								<td>'.wordwrap($POlist['requirement_specification'],30,"\n",true).'</td>
								<td>'.$POlist['quantity'].'</td>
								<td>'.$POlist['cost'].'</td>
								<td>'.$POlist['username'].'</td>
								<td>'.$POlist['status'].'</td>
							';
						if($userid['userrole_id'])
						{
						?>
						<form action="" method="POST">
						<?php
							if($_POST['approv'] == $POlist['id'])
							{	
								mysqli_query($_SESSION['connection'],"Update internal_po set approval='".$POlist['approval'].",".$_SESSION['id']."' where id='".$_POST['approv']."'");
								echo '<td><button class="button button-gray" type="Submit" disabled>Approved</button></td>';
							}
							else
							{
								$s = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from internal_po where id='".$POlist['id']."'"));
								$sss = explode(',',$s['approval']);
								if(in_array($_SESSION['id'], $sss))
									echo '<td><button class="button button-gray" type="Submit" disabled>Approved</button></td>';
								else
								{?>
								<form action="" method="POST">
									<?php
										echo '<input type="hidden" value="'.$POlist['id'].'" name="approv">';
										echo '<td><a href="?page=Stores&subpage=spage->Internal_PO&id='.$POlist['id'].'"><button class="button button-orange" name="approval" type="Submit">Approve</button></a></td>';
										//echo '<td><a href="?page=Stores&subpage=spage->Internal_PO&id='.$POlist['id'].'&action=edit" class="action-button" title="user-edit"><span class="user-edit"></span>  <a href="?page=Stores&subpage=spage->Internal_PO&id='.$POlist['id'].'&action=delete" class="action-button" title="user-delete" onclick="return deletedata();"><span class="user-delete"></span></td>';
								}?>
								</form>
							<?php
							}
						}
						else
						{
							$coun = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select sum(user) as total from approver"));
							$ss = array_sum(explode(',',$POlist['approval']));
							if((!$POlist['approval'] && $POlist['user']==$_SESSION['id'])||(($userrole['userrole_id']==4 || $userrole['userrole_id']==8)&&($ss==$coun['total'])))
							{
								echo '<td><a href="?page=Stores&subpage=spage->Internal_PO&id='.$POlist['id'].'&action=edit" class="action-button" title="user-edit"><span class="user-edit"></span>  <a href="?page=Stores&subpage=spage->Internal_PO&id='.$POlist['id'].'&action=delete" class="action-button" title="user-delete" onclick="return deletedata();"><span class="user-delete"></span></td>
								</tr>';
							}
						}
						$usertotal = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select sum(user) as total from approver"));
						$list = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from internal_po where id='".$POlist['id']."'"));
						$approval_total = array_sum(explode(',',$list['approval']));
						if($approval_total==$usertotal['total'] && ($POlist['inhouse_statusid']==1))
						{
							$list = mysqli_fetch_assoc(mysqli_query($_SESSION['connection'],"select * from internal_po where id='".$POlist['id']."'"));
							$approval_total = array_sum(explode(',',$list['approval']));
							mysqli_query($_SESSION['connection'],"UPDATE internal_po set inhouse_statusid='2' where inhouse_statusid='1' && id='".$list['id']."'");
							header("Location:?page=Stores&subpage=spage->Internal_PO");
						}
						else
						{}
					}
					?></form>
				</tbody>
			</table>
		</div>
	<div class="clear">&nbsp;</div>
	<?php
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&status_id=".$_GET['status_id']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
</section>
<script>
	function deletedata()
	{
		return confirm("Are you sure,Want to delete the data?")
	}
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode == 8 || charCode == 32)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	function AlphaNumCheck(e) 
	{
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8) 
			return true;
        if (charCode == 42 || charCode == 45 || charCode == 46 || charCode == 95 || charCode == 64 || charCode == 63) 
			return true;
        var keynum;
        var keychar;
        var charcheck = /[a-zA-Z0-9]/;
        if(window.event)
        {
            keynum = e.keyCode;
        }
        else
		{
            if(e.which)
            {
                keynum = e.which;
            }
            else 
				return true;
        }

        keychar = String.fromCharCode(keynum);
        return charcheck.test(keychar);
    }
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode==8)
			return true;
		if(charCode==45)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
			return NumberCount();
	}
	
	function NumberCount()
	{
		if(document.getElementById("phone").value.length < 25)
			return true;
		else
			return false;
	}
	function Validate()
	{
		if(document.getElementById("inhouse_categoryid").selectedIndex==0)
		{
			alert("Please Select Inhouse Category");
			return false;
		}
	var qty = document.getElementById("quantity");
	var quantity = qty.value.trim().length;
	if(quantity<=0)
	{
		alert("Please Specify Quantity");
		return false;
	}
	var cost = document.getElementById("cost");
	var cos = cost.value.trim().length;
	if(cos<=0)
	{
		alert("Please Specify Cost");
		return false;
	}
	var specification = document.getElementById("requirement_specification")
	var specify = specification.value.trim().length;
	if(specify<=0)
	{
		alert("Please Provide Required Specification");
		return false;
	}		
	/*if(document.getElementById("inhouse_statusid").selectedIndex==0)
	{
		alert("Please Select Inhouse Status");
		return false;
	}*/
	}
	function validation()
	{
		var message = "";
		if(document.getElementById("password").value.length < 4 || document.getElementById("password").value.length > 15)
			message = "Password should be within 4 to 15 characters";
		if(document.getElementById("name").value.length < 4 || document.getElementById("name").value.length > 15)
			message = "User name should be within 4 to 15 characters";
		if(document.getElementById("lastname").value.length < 1 || document.getElementById("lastname").value.length > 15)
			message = "Last name should be within 1 to 15 characters";
		if(document.getElementById("firstname").value.length < 4 || document.getElementById("firstname").value.length > 15)
			message = "First name should be within 4 to 15 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>