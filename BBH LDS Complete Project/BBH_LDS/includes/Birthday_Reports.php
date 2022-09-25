<div class="form panel" style="width:1000px">
	<form method='post' action=''>
		<hr/>
		<table>
			<tr>
				<td>
					<div class="clearfix">
						<label>Month </label>
						<select name="month" id="month">
							<option value="" >Select</option>
							<?php
								$month = array("1"=>"January","2"=>"Febrauary","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");
								foreach($month as $key => $value)
								{
								   if($_POST['month'] == $key)
										echo '<option value='.$key.' selected>'.$value.'</option>';
								   else
										echo '<option value='.$key.'>'.$value.'</option>';
								}
							?>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<br/>
					<input type="submit" class="button button-green"  name="Search" value="Search" />&nbsp;
				</td>
			</tr>
		</table>
	</form>
	<hr/>
</div>
<?php
	include("Export_BirthdayDoctors.php");
?>
<script>

function Export()
	{
		window.open("includes/Export_BirthdayDoctors.php?export=1&Search=<?php echo $_POST['Search'].'&month='.$_POST['month']; ?>",'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
//function GetValuesByMonthly()
	//{
		//document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&groupid="+document.getElementById('groupid').value+"&departmentId="+document.getElementById('departmentid').value+"&name="+document.getElementById('name').value+"&startdate="+document.getElementById('startdate').value+"&enddate="+document.getElementById('enddate').value);
	//}
</script>