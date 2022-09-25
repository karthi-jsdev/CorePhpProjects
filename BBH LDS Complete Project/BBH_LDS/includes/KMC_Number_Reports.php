<div class="form panel" style="width:1000px">
	<form method='post' action=''>
		<hr/>
		<table>
			<tr>
				<label>KMC Number
				<td>
					<input type="text" name="kmcnumber" value=""  id="kmcnumber"  />&nbsp;
				</td>
				</label>
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
	include("Export_KMCNumberDoctors.php");
?>
<script>

function Export()
	{
		window.open("includes/Export_KMCNumberDoctors.php?export=1&Search=<?php echo $_POST['Search'].'&kmcnumber='.$_POST['kmcnumber']; ?>",'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
//function GetValuesByMonthly()
	//{
		//document.location.assign("index.php?page=<?php echo $_GET['page']; ?>&subpage=<?php echo $_GET['subpage']; ?>&groupid="+document.getElementById('groupid').value+"&departmentId="+document.getElementById('departmentid').value+"&name="+document.getElementById('name').value+"&startdate="+document.getElementById('startdate').value+"&enddate="+document.getElementById('enddate').value);
	//}
</script>