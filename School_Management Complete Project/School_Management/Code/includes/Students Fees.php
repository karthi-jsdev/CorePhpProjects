<?php
	include("Config.php");
	include("includes/Student_Fees_Queries.php");
	if($_GET['Student_id'] && $_GET['Student_section_id'])
	{ 
		$Student_Details = Student_Name();
		while($Student_Details_Name = mysql_fetch_array($Student_Details))
		{
			$Section_Name = $Student_Details_Name['sectionname'];
			$Class_Names = $Student_Details_Name['classname'];
			$Admission_Number = $Student_Details_Name['admission_no'];
			$Admission_Date = $Student_Details_Name['admission_date'];
			$Student_Name = $Student_Details_Name['first_name'].$Student_Details_Name['last_name'];
			$Student_Date_Of_Birth = $Student_Details_Name['admission_date'];
			$Student_Gender =  $Student_Details_Name['gender'];
			$Student_Blood_Group_Name = $Student_Details_Name['bloodgroupname'];
			$Student_mother_tongue =  $Student_Details_Name['mother_tongue'];
			$Student_religion = $Student_Details_Name['religionname'];
			$Student_Caste = $Student_Details_Name['communityname'];
			$Student_Sub_cast = $Student_Details_Name['subcastname'];
			$Student_Father_Name = $Student_Details_Name['father_name'];
			$Student_Father_Occupation = $Student_Details_Name['father_occupation'];
			$Student_Father_Income = $Student_Details_Name['annual_income'];
			$Student_Residence = $Student_Details_Name['residenceaddress'];
			$Student_Mother_Name = $Student_Details_Name['mother_name'];
			$Student_Mother_Occupation = $Student_Details_Name['mother_occupation'];
			$Student_Office_Address = $Student_Details_Name['officeaddress'];
			$Student_Contact_Number = $Student_Details_Name['contact_no'];
			$Student_Image = $Student_Details_Name['user_img'];
		}
	?>
		<form class="form panel" name="myform">
			<div class="clearfix">
				<label> Admission Number:
				<?php
					echo $Admission_Number;
				?>
				</label>
				<label> Admission Date:
				<?php
					echo date('d-m-Y',strtotime($Admission_Date));
				?>
				</label>
				<label> Name:
				<?php
					echo $Student_Name;
				?>
				</label>
				<label> Date Of Birth:
				<?php
					echo date('d-m-Y',strtotime($Student_Date_Of_Birth));
				?>
				</label>
			</div>
			<div class="clearfix">
				<label> Gender:
				<?php
					if($Student_Gender == 1)
						echo Male;
					else
						echo Female;
				?>
				</label>
				<label> Class & Section:
				<?php
					echo $Class_Names." ".$Section_Name;
				?>
				</label>
				<label> Blood Group:
				<?php
					echo $Student_Blood_Group_Name;
				?>
				</label>
				<label> Mother Tongue:
				<?php
					echo $Student_mother_tongue;
				?>
				</label>
				<label> Religion:
				<?php
					echo $Student_religion;
				?>
				</label>
				<label> Caste:
				<?php
					echo $Student_Caste;
				?>
				</label>
				<label> SubCaste:
				<?php
					echo $Student_Sub_cast;
				?>
				</label>
				<label> Father Name:
				<?php
					echo $Student_Father_Name;
				?>
				</label>
				<label> Father Occupation:
				<?php
					echo $Student_Father_Occupation;
				?>
				</label>
				<label> Annual Income:
				<?php
					echo $Student_Father_Income;
				?>
				</label>
				<label> Residence Address:
				<?php
					echo $Student_Residence;
				?>
				</label>
				<label> Mother Name:
				<?php
					echo $Student_Mother_Name;
				?>
				</label>
				<label> Mother Occupation:
				<?php
					echo $Student_Mother_Occupation;
				?>
				</label>
				<label> Office Address:
				<?php
					echo $Student_Office_Address;
				?>
				</label>
				<label> Contact Number:
				<?php
					echo $Student_Contact_Number;
				?>
				</label>
				<label> Student Image:
				<?php
					echo '<img src="data:image/jpeg;base64,'.base64_encode($Student_Image).'"  width="90px" height="90px" alt="photo"/>';
				?>
				</label>
			</div>
			<table class="paginate sortable">
				<thead>
					<tr>
						<td>Month</td>
						<?php
							$AllCategoryIds = Array();
							$Condition = "fees_category_assign.id =".str_replace("," ," || fees_category_assign.id=", $_GET['feescategoryid']);
							$FeesCount = mysql_num_rows(mysql_query("SELECT * FROM fees_catagory join fees_category_assign on fees_catagory.id = fees_category_assign.feescategoryid where ".$Condition." order by fees_category_assign.feescategoryid asc"));
							$Feescategoryname = mysql_query("SELECT fees_category_assign.id,fees_catagory.name FROM fees_catagory join fees_category_assign on fees_catagory.id = fees_category_assign.feescategoryid where ".$Condition." order by fees_category_assign.feescategoryid asc");
							while($Feesname = mysql_fetch_array($Feescategoryname))
							{
								$AllCategoryIds[] = $Feesname['id'];
								echo '<td>'.$Feesname['name'].'</td>';
							}
							echo '<td>Scholarship</td>';
							echo '<td>Fine</td>';
							echo '<td></td><td></td><td>Amount</td>';
							echo "<tr><td>Total Amount</td>";
							$FeescategoryamountCondition = "fees_category_assign.id =".str_replace("," ," || fees_category_assign.id=", $_GET['feescategoryid']);
							$Feescategoryamount = mysql_query("SELECT * FROM fees_category_assign join fees_catagory on fees_catagory.id = fees_category_assign.feescategoryid where ".$FeescategoryamountCondition." order by fees_category_assign.feescategoryid asc");
							while($Feesamount = mysql_fetch_array($Feescategoryamount))
							{
								echo '<td>'.$Feesamount['amount'].'</td>';
							}
							echo "</tr>";
						?>
					</tr>
				</thead>
				<tbody>
					<?php 
					$FeescategoryCondition = "fees_category_assign.id =".str_replace("," ," || fees_category_assign.id=", $_GET['feescategoryid']);
					$Feescategorymonth = mysql_query("SELECT * FROM fees_category_assign where ".$FeescategoryCondition." order by feescategoryid asc");
					$Monthname = Array("1" => "May", "2" => "Jun", "3" => "Jul", "4" => "Aug", "5" => "Sep", "6" => "Oct", "7" => "Nov", "8" => "Dec", "9" => "Jan", "10" => "Feb", "11" => "Mar", "12" => "Apr");
					$k = 0;
					$Checkboxenable[] = array();
					
					while($Feesmonth = mysql_fetch_array($Feescategorymonth))
					{
						$MonthId = explode(",",$Feesmonth['monthids']);
						for($j=1; $j<=count($Monthname); $j++)
						{	
							for($i=0; $i<count($MonthId); $i++)
							{
								$Checkboxenable[$j][$k] = "disabled";
								if($j==$MonthId[$i]) // $j acts as key of month
								{
									$Checkboxenable[$j][$k] = "enabled";  
									break;
								}
							}
						}
						$k++;
					}
					$Fines = Array();
					$Finename = mysql_query("SELECT * FROM fine order by days DESC");
					while($Fineamount = mysql_fetch_array($Finename))
						$Fines[$Fineamount['days']] = $Fineamount['amount']; //$Fineamount['days'] as Key
					
					$CurrentDateTime = new DateTime(date("Y-m-d"));
					$Feescategorycount = explode(",",$_GET['feescategoryid']);
					$l = array(0,5,6,7,8,9,10,11,12,1,2,3,4);
					$CurrentYear = date("Y");
					$CurrentYearAndMonth = date("Y-m");
					$CurrentMonth = date("m");
					if(date('m') < 5)
					{
						$PrevYear = $CurrentYear-1;
						$ll  = array(0,($PrevYear."-5"),($PrevYear."-6"),($PrevYear."-7"),($PrevYear."-8"),($PrevYear."-9"),($PrevYear."-10"),($PrevYear."-11"),($PrevYear."-12"),($CurrentYear."-1"),($CurrentYear."-2"),($CurrentYear."-3"),($CurrentYear."-4"));
					}
					else
					{
						$NextYear = $CurrentYear+1;
						$ll  = array(0,($CurrentYear."-5"),($CurrentYear."-6"),($CurrentYear."-7"),($CurrentYear."-8"),($CurrentYear."-9"),($CurrentYear."-10"),($CurrentYear."-11"),($CurrentYear."-12"),($NextYear."-1"),($NextYear."-2"),($NextYear."-3"),($NextYear."-4"));
					}
					
					$FineCount = 0;
					for($j=1; $j<=count($Monthname); $j++)
					{
						echo "<tr><td>".$Monthname[$j]."</td>";
						$DisabledCategories = 0; 
						$AmountToBePaid = "";
						$Feescategory = 0; 
						for($i=0; $i<$FeesCount; $i++)
						{
							if($Payment_log = mysql_fetch_array(mysql_query("SELECT paidamount,amounttobepaid,feescategory_id FROM payment_log where student_id = '".$_GET['Student_id']."' && month_id=$j ORDER BY id DESC LIMIT 1")))
							{
								$AmountToBePaid = $Payment_log['amounttobepaid'];
								$Feescategory = $Payment_log['feescategory_id'];
								if($Payment_log['amounttobepaid'] == 0 && $Checkboxenable[$j][$i] == "enabled" && $Payment_log['feescategory_id'] != 0)
									echo "<td><input type='checkbox' id='".$Feescategorycount[$i]."a".$j."' name='monthnames[]' value='".$Feescategorycount[$i].".".$j."' ".$Checkboxenable[$j][$i]." onclick='Passing_amount(".$j.")' checked  disabled/></td>";
								else if($Payment_log['paidamount'] == 0 && $_POST['Update'])
									echo "<td><input type='checkbox' id='".$Feescategorycount[$i]."a".$j."' name='monthnames[]' value='".$Feescategorycount[$i].".".$j."' ".$Checkboxenable[$j][$i]." onclick='Passing_amount(".$j.")'/></td>";
								else
									echo "<td><input type='checkbox' id='".$Feescategorycount[$i]."a".$j."' name='monthnames[]' value='".$Feescategorycount[$i].".".$j."' ".$Checkboxenable[$j][$i]." onclick='Passing_amount(".$j.")' /></td>";
							}
							else
								echo "<td><input type='checkbox' id='".$Feescategorycount[$i]."a".$j."' name='monthnames[]' value='".$Feescategorycount[$i].".".$j."' ".$Checkboxenable[$j][$i]." onclick='Passing_amount(".$j.")' /></td>";
							if($Checkboxenable[$j][$i] == "disabled")
								$DisabledCategories++; 
						}
						if($DisabledCategories == $FeesCount)
							$Display = "disabled";
						echo "<td>
						<input type='hidden' id='scholarid".($j)."' name='scholarid".($j)."' />
						<input type='hidden' id='scholaramount".($j)."' name='scholaramount".($j)."' />
						<input type='hidden' id='scholarmode".($j)."' name='scholarmode".($j)."'/>";
						$Scholarship_log = mysql_fetch_array(mysql_query("SELECT scholarshipamount,finepaid FROM payment_log where student_id = '".$_GET['Student_id']."' && month_id=$j ORDER BY id DESC LIMIT 1"));
						if($Scholarship_log['scholarshipamount'] > 0)
							echo "<input type='checkbox' id='Scholarshipapplicable".($j)."' onclick='Passing_Scholarship(".$j.")' checked disabled /></td>";
						else	
							echo "<input type='checkbox' id='Scholarshipapplicable".($j)."' onclick='Passing_Scholarship(".$j.")' $Display /></td>";
						$Display = "";
						$Fine = 0; $FineDisplay = "style='display:none'";
						//if($j-1 <= $CurrentMonth)
						//{
							$datetime1 = new DateTime(date("Y-m-", strtotime($ll[$j])).cal_days_in_month(CAL_GREGORIAN,$l[$j],date('Y', strtotime($ll[$j]))));
							$interval = $datetime1->diff($CurrentDateTime);
							$NoOfDays = $interval->format('%R%a');
							foreach ($Fines as $key => $value)
							{
								if($NoOfDays >= $key)// && $ll[$j] <= $CurrentYearAndMonth)
								{
									$FineDisplay = "";
									$Fine = $value;
									echo "<td>".$FineApplicable[$j]."<div>Fine +$Fine</div></td>";
									break;
								}
							}		
						//}
						if($Scholarship_log['finepaid'] == 1)	
							echo "<td><input type='checkbox' id='fine".($j)."' name='".$Fine."' value='".$Fine."' checked disabled/></td>";
						else
							echo "<td><D $FineDisplay><input type='checkbox' id='fine".($j)."' name='".$Fine."' value='".$Fine."' /></D></td>"; 
							
						echo "	
						<td>
						<div id='totalamount".$j."'></div>
						<input type='hidden' id='amounttobepaid".$j."' name='amounttobepaid".$j."' value='".$AmountToBePaid."' /></td>";
						
						$PaidAmount = mysql_fetch_array(mysql_query("SELECT sum(paidamount)as totalpaidamount,sum(scholarshipamount) as scholarshipamount,finepaid,sum(fineamount) as fineamount from payment_log where student_id = '".$_GET['Student_id']."' && month_id = '".$j."'"));
						if($AmountToBePaid != "" && $AmountToBePaid == 0 && $Feescategory !=0)
						{
							if($PaidAmount['scholarshipamount'] == 0 && $PaidAmount['finepaid'] == 1)
							{
								$Withoutscholarship = $PaidAmount['totalpaidamount'] + $PaidAmount['fineamount']; 
								echo "<td colspan='2'>".$Withoutscholarship." &nbsp;Fully Paid</td>";
							}
							else if($PaidAmount['finepaid'] == 1)	
							{
								echo "<td colspan='2'>Total Amount &nbsp;".$PaidAmount['totalpaidamount']."</td>";
								$PaidAmount = $PaidAmount['totalpaidamount'] - $PaidAmount['scholarshipamount'] + $PaidAmount['fineamount'];
								echo "<td colspan='2'>Paid Amount  &nbsp;".$PaidAmount."</td>";
							}	
							else
							{
								$withoutfine = $PaidAmount['totalpaidamount'] - $PaidAmount['scholarshipamount'];
								echo "<td colspan='2'>Total Amount &nbsp;".$PaidAmount['totalpaidamount']."</td>";
								echo "<td colspan='2'>Paid Amount  &nbsp;".$withoutfine	."</td>";
							}
						}
						else
							echo "<td><input type='textbox' id='".$j."' name='amount".$j."' value='' style='width:70px' placeholder='Amount' onkeypress='return isNumericAndValidAmount(event, ".$j.")'/></td>
							<td><input type='button' class='button button-green'  name='paid' value='Pay' style='width:70px' onclick='Passing_Values(".$j.");' /></td>";
						if($AmountToBePaid != "" && $AmountToBePaid == 0 && $Feescategory !=0 && ($_SESSION['FM_roleid'] == 1 || $_SESSION['FM_roleid'] == 2))
						{
							echo "<td style='color:green;font-weight:bold'>Paid</td>";
							echo "<td><input type='button' class='button button-orange' name='feesedit".$j."' id='feesedit".$j."' value='Delete' onclick='Passing_fees(".$j.");Passingeditedvalues(".$j.");'/></td>";
						}	
						
						echo "</tr>";
					} ?>
				</tbody>
			</table>
		</form>	
	<?php 
	}

	else
		echo 'Please Search Students to view their Fees Details';
	?>
 <script>
	function Passing_Values(monthid)
	{
		var UncheckedCount = 0;
		<?php
		foreach($AllCategoryIds as $AllCategoryId)
		{ ?>
		if(document.getElementById('<?php echo $AllCategoryId."a";?>'+monthid).checked == false && document.getElementById('<?php echo $AllCategoryId."a";?>'+monthid).disabled == false)
			UncheckedCount++;
		if(UncheckedCount)
			alert("Pay all the fees category");
		else if(((document.getElementById('<?php echo $AllCategoryId."a";?>'+monthid).checked == true ) && Number($("#amounttobepaid"+monthid).val()) != Number($("#"+monthid).val())))
			alert("Pay the full fees");
		<?php
		} ?>	
		else
		{
			//if($("#fine"+monthid).val()+)
			//{
				var monthvals = [], categoryids = [];
				monthvals = $('input:checkbox[name="monthnames[]"]:checked').map(function () 
				{
					var allmonths = this.id.split("a");
					if(allmonths[1] == monthid)
					{
						categoryids.push(allmonths[0]);
						return this.id;
						monthvals.push(this.id);
					}
				}).get();
				
				var amount = [];
				amount = $('input:text[name="amount[]"]').map(function () 
				{
					if(monthid == this.id)
					{
						var allamount = this.value;
						return allamount;
						amount.push(allamount);
					}
				}).get();
				if(document.getElementById("fine"+monthid).checked == true)
					var isFinePaid = 1;
				else
					var isFinePaid = 0;
				Ajax("POST","includes/Get_Fees_Action.php", "Student_id=<?php echo $_GET['Student_id'];?>&feescategoryids="+categoryids+"&amount="+amount+"&monthid="+monthid+"&amounttobepaid="+$("#amounttobepaid"+monthid).html()+"&fine="+$("#fine"+monthid).val()+"&scholaramount="+$("#scholaramount"+monthid).val()+"&isFinePaid="+isFinePaid+"&section_id="+<?php echo $_GET['Student_section_id'];?>);
				location.reload(); 
			//}
		}
	}
	function Passing_fees(monthid)
	{
		document.getElementById("feesedit"+monthid).value = "Delete";
		<?php
		foreach($AllCategoryIds as $AllCategoryId)
		{ ?>
			document.getElementById('<?php echo $AllCategoryId."a";?>'+monthid).disabled = false;
			document.getElementById('Scholarshipapplicable'+monthid).disabled = false;
			document.getElementById('fine'+monthid).disabled = false;
			$( document ).ready(function()
			{
				$('#uniform-Scholarshipapplicable'+monthid).removeAttr('class');
				$('#Scholarshipapplicable'+monthid).removeAttr('style');
				$('#uniform-fine'+monthid).removeAttr('class');
				$('#fine'+monthid).removeAttr('style');
				$('#uniform-<?php echo $AllCategoryId."a";?>'+monthid).removeAttr('class');
				$('#<?php echo $AllCategoryId."a";?>'+monthid).removeAttr('style');
				
			});
			
		<?php
		} ?>
		Passingeditedvalues(monthid);
		var Are = confirm("Are you sure, Do you really want to delete this record?");
		if(Are == true)
			location.reload(); 
	}
	function Passingeditedvalues(monthid)
	{
		var monthvals = [], categoryids = [];
		monthvals = $('input:checkbox[name="monthnames[]"]:checked').map(function () 
		{
			var allmonths = this.id.split("a");
			if(allmonths[1] == monthid)
			{
				categoryids.push(allmonths[0]);
				return this.id;
				monthvals.push(this.id);
			}
		}).get();
		
		var amount = [];
		amount = $('input:text[name="amount[]"]').map(function () 
		{
			if(monthid == this.id)
			{
				var allamount = this.value;
				return allamount;
				amount.push(allamount);
			}
		}).get();
		
		<?php
		foreach($AllCategoryIds as $AllCategoryId)
		{ ?>
			document.getElementById('<?php echo $AllCategoryId."a";?>'+monthid).disabled = false;
			document.getElementById('Scholarshipapplicable'+monthid).disabled = false;
			document.getElementById('fine'+monthid).disabled = false;
			$( document ).ready(function()
			{
				$('#uniform-<?php echo $AllCategoryId."a";?>'+monthid).removeAttr('class');
				$('#<?php echo $AllCategoryId."a";?>'+monthid).removeAttr('style');
				
			});
		<?php
		} ?>
		if(document.getElementById("fine"+monthid).checked == true)
			var isFinePaid = 1;
		else
			var isFinePaid = 0;
		
		Ajax("POST","includes/Get_Fees_Edited_Action.php", "Student_id=<?php echo $_GET['Student_id'];?>&feescategoryids="+categoryids+"&amount="+amount+"&monthid="+monthid+"&amounttobepaid="+$("#amounttobepaid"+monthid).html()+"&fine="+$("#fine"+monthid).val()+"&scholaramount="+$("#scholaramount"+monthid).val()+"&isFinePaid="+isFinePaid);
	}
	function Passing_amount(monthid)
	{
		var CategoryIds = [];
		CategoryIds = $('input:checkbox[name="monthnames[]"]:checked').map(function () 
		{
			var CategoryMonth = this.id.split("a");
			if(CategoryMonth[1] == monthid)
			{
				return CategoryMonth[0];//CategoryId
				CategoryIds.push(CategoryMonth[0]);
			}
		}).get();
		var Response = Ajax("POST","includes/Get_Amount_Values.php","CategoryIds="+CategoryIds+"&student_id=<?php echo $_GET['Student_id'];?>&monthid="+monthid).split("$");
		$(("#totalamount"+monthid)).html(Response[0]);
		$(("#amounttobepaid"+monthid)).val(Response[1]);
		$(("#"+monthid)).val(Response[1]);
	}
	
	function isNumericAndValidAmount(evt, monthid)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 9  || charCode == 46)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		else
		{
			if(Number($("#amounttobepaid"+monthid).val()) >= Number($("#"+monthid).val()+""+String.fromCharCode(charCode)))
				return true;
			else
				return false;
		}
	}
	
	function Passing_Scholarship(monthid)
	{
		<?php
		foreach($AllCategoryIds as $AllCategoryId)
		{ ?>
			if(document.getElementById('<?php echo $AllCategoryId."a";?>'+monthid).checked == false && document.getElementById('Scholarshipapplicable'+monthid).checked == true && document.getElementById('<?php echo $AllCategoryId."a";?>'+monthid).disabled == false)
			{
				alert("Pay all the fees category");
				document.getElementById('Scholarshipapplicable'+monthid).checked = false;
			}			
			else if (document.getElementById('Scholarshipapplicable'+monthid).checked == true && document.getElementById('<?php echo $AllCategoryId."a";?>'+monthid).checked == true)
			{
				window.open("includes/Scholarship.php?monthid="+monthid+"&amounttobepaid="+$("#amounttobepaid"+monthid).val(), 'opener', "width=600, height=400");
			}
			else if (document.getElementById('Scholarshipapplicable'+monthid).checked == false)
			{
				$(("#"+monthid)).val($("#totalamount"+monthid).html());
			}	
		<?php
		} ?>	
	}
</script>