<?php
	if($_GET['id'])
	{
		$_POST['student_id'] = $_GET['id'];
		$_POST['section_id'] = $_GET['section_id'];
	}
?>
<section role="main" id="main">
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; ?>" required="required"/>
			<header><h2>Fees Details</h2></header><hr />
			<fieldset>
				<div class="clearfix">
					<label>Student <font color="red">*</font>
						<select name="student_id" id="student_id">
							<option value="">Select</option>
							<?php
							$SelectName = Select_StudentName();
							while($FetchName = mysqli_fetch_assoc($SelectName))
							{
								if($FetchName['id'] == $_POST['student_id'])
									echo "<option value='".$FetchName['id']."' selected>".$FetchName['first_name']."</option>";
								else
									echo "<option value='".$FetchName['id']."'>".$FetchName['first_name']."</option>";
							} ?>
						</select>
					</label>
					<label>Class <font color="red">*</font>
						<select name="section_id" id="section_id">
							<option value="">Select</option>
							<?php
							$SelectClass = Class_Select_All();
							while($FetchClass  = mysqli_fetch_array($SelectClass))
							{
								$FetchClassName = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"Select * from class where id='".$FetchClass['classid']."'"));
								if($FetchClass['id']==$_POST['section_id'])
									echo '<option value="'.$FetchClass['id'].'" selected>'.$FetchClassName['name'].'-'.$FetchClass['name'].'</option>';
								else
									echo '<option value="'.$FetchClass['id'].'">'.$FetchClassName['name'].'-'.$FetchClass['name'].'</option>';
							} ?>
						</select>
					</label>
					<!--div id="sections">
						<?php
						if($_POST['section_id'])
						{ ?>
							<label>
								Section Name<font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
								<select name="section_id" id="section_id">
									<option value="">Select</option>
									<?php
									$SelectClass = Section_Select($_POST['section_id']);
									while($FetchClass  = mysqli_fetch_array($SelectClass))
									{
										if($FetchClass['id']==$_POST['section_id'])
											echo '<option value="'.$FetchClass['id'].'" selected>'.$FetchClass['name'].'</option>';
										else
											echo '<option value="'.$FetchClass['id'].'">'.$FetchClass['name'].'</option>';
									} ?>
								</select>
							</label>
						<?php
						} ?>
					</div-->
					<label>Category <font color="red">*</font>
						<select name="category_id" id="category_id">
							<option value="">Select</option>
							<?php
							$SelectCategory = Select_Category();
							while($FetchCategory  = mysqli_fetch_array($SelectCategory))
							{
								if($FetchCategory['id'] == $_POST['category_id'])
									echo '<option value="'.$FetchCategory['id'].'" selected>'.$FetchCategory['name'].'</option>';
								else
									echo '<option value="'.$FetchCategory['id'].'">'.$FetchCategory['name'].'</option>';
							} ?>
						</select>
					</label>
				</div>
			</fieldset>
			<hr /><button class="button button-green" type="submit" name="Submit">Search</button>
		</form>
	</div>
	<?php
	if(isset($_POST['Submit']))
	{ ?>
	<div class="columns">
		<h3>Fees Payment Details</h3><hr />
		<table class="paginate sortable full">
			<thead>
				<tr>
					<th width="43px" align="center">S.No.</th>
					<th>Terms</th>
					<th>Total Amount</th>
					<th>Amount Pending</th>
					<th>Payment Done</th>
					<th>Payment Date</th>
					<th>Fee Category</th>
					<th>Discount</th>
					<th>Fine</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
				$FeeDetails = Select_Fees_ByStudentId();
				$i = 1;
				if(!mysqli_num_rows($FeeDetails))
					echo '<tr><td colspan="9"><font color="red"><center>No data found</center></font></td></tr>';
				while($FeeDetail = mysqli_fetch_assoc($FeeDetails))
				{
					$SelectedTerms = "";
					$Terms = Select_Terms_ById($FeeDetail['terms']);
					while($Term = mysqli_fetch_assoc($Terms))
						$SelectedTerms .= $Term['name'].", ";
					echo "<tr style='valign:middle;'>
						<td align='center'>".$i++."</td>
						<td>".substr($SelectedTerms,0 , strlen($SelectedTerms)-2)."</td>
						<td>".$FeeDetail['total_amount']."</td>
						<td>".$FeeDetail['amount_pending']."</td>
						<td>".$FeeDetail['payment_done']."</td>
						<td>".substr($FeeDetail['payment_date'], 0,16)."</td>
						<td>".$FeeDetail['category_name']."</td>
						<td>".$FeeDetail['discount_name']."</td>
						<td>".$FeeDetail['fine']."</td>
					</tr>";
				} ?>
			</tbody>
		</table>
	</div>
	<?php
	} ?>
	<div class="clear">&nbsp;</div>
</section>
<script>
	/*function GetSections(class_id, section_id)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
			xmlhttp=new XMLHttpRequest();
		else
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var results = xmlhttp.responseText;
				document.getElementById('sections').innerHTML = results;
			}
		}
		xmlhttp.open("GET","includes/GetSections.php?class_id="+class_id+"&section_id="+section_id,true);
		xmlhttp.send();
	}*/
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode==8)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	
	function validation()
	{
		var message = "";
		if(!document.getElementById("category_id").value)
			message = "Please select fees category";
		if(!document.getElementById("section_id").value)
			message = "please select section";
		if(!document.getElementById("student_id").value)
			message = "please select student";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>