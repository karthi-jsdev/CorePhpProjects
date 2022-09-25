<section role="main" id="main">
	<?php
		include('Config.php');
		if(isset($_POST['Submit']))
		{
			$productcode = "LIKE '%S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."%'";
			if(strlen($_POST['ranges'])==3)
				$productvalues = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM products WHERE productcode ".$productcode." and ranges LIKE '%".substr($_POST['ranges'],0,1)."%' && length(ranges)='3' ORDER BY id DESC"));
			else if(strlen($_POST['ranges'])==4 && ($_POST['ranges']>=1200&&$_POST['ranges']<=2000))
				$productvalues = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM products WHERE productcode ".$productcode." and ranges LIKE '%".substr($_POST['ranges'],0,1)."%' && length(ranges)='4' ORDER BY id DESC"));
			else if(strlen($_POST['ranges'])==4 && ($_POST['ranges']>=1000&&$_POST['ranges']<=1199))
				$productvalues = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM products WHERE productcode ".$productcode." and ranges LIKE '%".substr($_POST['ranges'],0,1)."%' && length(ranges)='4' ORDER BY id DESC"));
			$productcodeA = array();
			$productcodeA = $productvalues['productcode'];
			$productcodes = "S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."";
			$values = mysql_num_rows(mysql_query("SELECT * FROM products WHERE productcode ".$productcode." && ranges='".$_POST['ranges']."'"));
			if($values>0)
				echo "<br/><div class='message error'><b>Message</b> :Product Code and Ranges already exists.Please change</div>";
			else
			{
				//if($productvalues['total']==0 && ($productvalues['productcode'] != $productcodes &&  $productvalues['ranges']!=$_POST['ranges']))
				if($productvalues['total']==0)
					mysql_query("INSERT INTO products VALUES ('','S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."','".$_POST['ranges']."-')");
				
				else if($productvalues['total']>1 && (strlen($_POST['ranges'])==3))
				{
					$rangelimit = mysql_fetch_array(mysql_query("SELECT * FROM products WHERE productcode ".$productcode." and ranges LIKE '%".substr($_POST['ranges'],0,1)."%' && length(ranges)='3' ORDER BY id DESC LIMIT 0,1"));
					$productcodes = array();
					$productcodes = $rangelimit['productcode'];
					$proincrement = $productcodes[7];
					$asciicodes = ord($proincrement)+1;
					$asciivalue = chr($asciicodes);
					mysql_query("INSERT INTO products VALUES ('','S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."-".$asciivalue."','".$_POST['ranges']."')");
					$_POST['ranges'] = "";
				}
				else if((strlen($_POST['ranges'])==4) && $productvalues['total']>1 && ($_POST['ranges']>=1200&&$_POST['ranges']<=2000))
				{
					$rangelimit = mysql_fetch_array(mysql_query("SELECT * FROM products WHERE productcode ".$productcode." and ranges LIKE '%".substr($_POST['ranges'],0,1)."%' && length(ranges)='4' ORDER BY id DESC LIMIT 0,1"));
					$productcodes = array();
					$productcodes = $rangelimit['productcode'];
					$proincrement = $productcodes[8];
					$asciicodes = ord($proincrement)+1;
					$asciivalue = chr($asciicodes);
					mysql_query("INSERT INTO products VALUES ('','S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."-".$asciivalue."','".$_POST['ranges']."')");
					$_POST['ranges'] = "";
				}
				else if((strlen($_POST['ranges'])==4) && $productvalues['total']>1 && ($_POST['ranges']>=1000&&$_POST['ranges']<=1199))
				{ 
					$rangelimit = mysql_fetch_array(mysql_query("SELECT * FROM products WHERE productcode ".$productcode." and ranges LIKE '%".substr($_POST['ranges'],0,1)."%' && length(ranges)='4' ORDER BY id DESC LIMIT 0,1"));
					$productcodes = array();
					$productcodes = $rangelimit['productcode'];
					$proincrement = $productcodes[8];
					$asciicodes = ord($proincrement)+1;
					$asciivalue = chr($asciicodes);
					mysql_query("INSERT INTO products VALUES ('','S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."-".$asciivalue."','".$_POST['ranges']."')");
					$_POST['ranges'] = "";
				}
				else if($productvalues['total']==1)
				{
					$asciivalue = 'A';
					mysql_query("INSERT INTO products VALUES ('','S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."-".$asciivalue."','".$_POST['ranges']."')");
					$_POST['drivertype'] = "";
					$_POST['structure'] = "";
					$_POST['ic'] = "";
					$_POST['wattagerange'] = "";
					$_POST['currentrange'] = "";
					$_POST['ranges'] = "";
				}
			}
		}
			/* $productvalues = mysql_fetch_array(mysql_query("SELECT * FROM products WHERE ranges LIKE '%".substr($_POST['ranges'],0,1)."%' && (length(ranges)='3' || length(ranges)='4') ORDER BY id DESC LIMIT 0,1"));
			$productcodeA = array();
			$productcodeA = $productvalues['productcode'];
			$productcode = "'S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."'";
			$values = mysql_num_rows(mysql_query("SELECT * FROM products WHERE productcode='".$productvalues['productcode']."' && ranges='".$_POST['ranges']."'"));
			$productcodes = "S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."";
			if($values>0)
				echo "<br/><div class='message error'><b>Message</b> :Product Code and Ranges already exists.Please change</div>";
			else
			{
				$zerocount = substr_count($_POST['ranges'],0);
				if($zerocount==2)
				{
					mysql_query("INSERT INTO products VALUES ('','S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."','".$_POST['ranges']."')");
					$_POST['drivertype'] = "";
					$_POST['structure'] = "";
					$_POST['ic'] = "";
					$_POST['wattagerange'] = "";
					$_POST['currentrange'] = "";
					$_POST['ranges'] = "";
				}
				else if($_POST['ranges']==1000 || $_POST['ranges']==2000)
				{
					mysql_query("INSERT INTO products VALUES ('','S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."','".$_POST['ranges']."')");
					$_POST['drivertype'] = "";
					$_POST['structure'] = "";
					$_POST['ic'] = "";
					$_POST['wattagerange'] = "";
					$_POST['currentrange'] = "";
					$_POST['ranges'] = "";
				}
				else if($zerocount==2 && strlen($_POST['ranges'])==4 && )
				{
					mysql_query("INSERT INTO products VALUES ('','S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."','".$_POST['ranges']."')");
					$_POST['drivertype'] = "";
					$_POST['structure'] = "";
					$_POST['ic'] = "";
					$_POST['wattagerange'] = "";
					$_POST['currentrange'] = "";
					$_POST['ranges'] = "";
				}
				else if(strlen($_POST['ranges'])==3 && ($productvalues['productcode']!=$productcodes && $productvalues['ranges']!=$_POST['ranges']))
				{
					$rangelimit = mysql_fetch_array(mysql_query("SELECT * FROM products WHERE ranges LIKE '%".substr($_POST['ranges'],0,1)."%' && length(ranges)='3' ORDER BY id DESC LIMIT 0,1"));
					$productcodes = array();
					$productcodes = $rangelimit['productcode'];
					$proincrement = $productcodes[6];
					$asciicodes = ord($proincrement)+1;
					$asciivalue = chr($asciicodes);
					mysql_query("INSERT INTO products VALUES ('','S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."".$asciivalue."','".$_POST['ranges']."')");
					$_POST['ranges'] = "";
				}
				else if(strlen($_POST['ranges'])==4 && ($productvalues['productcode']!=$productcodes && $productvalues['ranges']!=$_POST['ranges']))
				{
					$rangelimit = mysql_fetch_array(mysql_query("SELECT * FROM products WHERE ranges LIKE '%".substr($_POST['ranges'],0,2)."%' && length(ranges)='4' ORDER BY id DESC LIMIT 0,1"));
					$productascii = array();
					$productascii = $rangelimit['productcode'];
					$proincrement = $productascii[7];
					$asciicodes = ord($proincrement)+1;
					$asciivalue = chr($asciicodes);
					mysql_query("INSERT INTO products VALUES ('','S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."".$asciivalue."','".$_POST['ranges']."')");
				}
				else
				{
					$asciivalue = 'A';
					mysql_query("INSERT INTO products VALUES ('','S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."".$asciivalue."','".$_POST['ranges']."')");
					$_POST['drivertype'] = "";
					$_POST['structure'] = "";
					$_POST['ic'] = "";
					$_POST['wattagerange'] = "";
					$_POST['currentrange'] = "";
					$_POST['ranges'] = "";
				}
			} */
		else if($_POST['Update'])
		{
			$productcode = "'%S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."%'";
			$productcod = "LIKE '%S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."%'";
			echo "SELECT count(*) as total FROM products WHERE productcode ".$productcod." and ranges LIKE '%".substr($_POST['ranges'],0,1)."%' && length(ranges)='3' ORDER BY id DESC";
			if(strlen($_POST['ranges'])==3)
				$productvalues = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM products WHERE productcode ".$productcod." and ranges LIKE '%".substr($_POST['ranges'],0,1)."%' && length(ranges)='3' ORDER BY id DESC"));
			else if(strlen($_POST['ranges'])==4 && ($_POST['ranges']>=1200&&$_POST['ranges']<=2000))
				$productvalues = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM products WHERE productcode ".$productcod." and ranges LIKE '%".substr($_POST['ranges'],0,2)."%' && length(ranges)='4' ORDER BY id DESC"));
			else if(strlen($_POST['ranges'])==4 && ($_POST['ranges']>=1000&&$_POST['ranges']<=1199))
				$productvalues = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM products WHERE productcode ".$productcod." and ranges LIKE '%".substr($_POST['ranges'],0,1)."%' && length(ranges)='4' ORDER BY id DESC"));
			$productcodeA = array();
			$productcodeA = $productvalues['productcode'];
			$productcodes = "S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."";
			$values = mysql_num_rows(mysql_query("SELECT * FROM products WHERE productcode ".$productcod." && ranges='".$_POST['ranges']."' WHERE id='".$_POST['id']."'"));
			echo $productvalues['total'];
			if($values>0)
				echo "<br/><div class='message error'><b>Message</b> :Product Code and Ranges already exists.Please change</div>";
			else
			{
				if($productvalues['total']==0)
					mysql_query("UPDATE products SET productcode='S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."',ranges='".$_POST['ranges']."' WHERE id='".$_POST['id']."'");
				
				else if($productvalues['total']>=2 && (strlen($_POST['ranges'])==3))
				{
					echo "SELECT * FROM products WHERE productcode=".$productcode." and ranges LIKE '%".substr($_POST['ranges'],0,1)."%' && length(ranges)='3' ORDER BY id DESC";
					$rangelimit = mysql_fetch_array(mysql_query("SELECT * FROM products WHERE productcode ".$productcod." and ranges LIKE '%".substr($_POST['ranges'],0,1)."%' && length(ranges)='3' ORDER BY id DESC "));
					$productcodes = array();
					$productcodes = $rangelimit['productcode'];
					echo $proincrement = $productcodes[6];
					$asciicodes = ord($proincrement)+1;
					$asciivalue = chr($asciicodes);
					if($_POST['ranges']==$rangelimit['ranges'] && $rangelimit['productcode']==$productcode)
						mysql_query("UPDATE products SET productcode='S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."".$asciivalue."',ranges='".$_POST['ranges']."' WHERE id='".$_POST['id']."'");
					$_POST['ranges'] = "";
				}
				else if((strlen($_POST['ranges'])==4) && $productvalues['total']>1 && ($_POST['ranges']>=1200&&$_POST['ranges']<=2000))
				{
					$rangelimit = mysql_fetch_array(mysql_query("SELECT * FROM products WHERE productcode ".$productcode." and ranges LIKE '%".substr($_POST['ranges'],0,2)."%' && length(ranges)='4' ORDER BY id DESC LIMIT 0,1"));
					$productcodes = array();
					$productcodes = $rangelimit['productcode'];
					$proincrement = $productcodes[7];
					$asciicodes = ord($proincrement)+1;
					$asciivalue = chr($asciicodes);
					mysql_query("UPDATE products SET productcode='S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."".$asciivalue."',ranges='".$_POST['ranges']."' WHERE id='".$_POST['id']."'");
					$_POST['ranges'] = "";
				}
				else if((strlen($_POST['ranges'])==4) && $productvalues['total']>1 && ($_POST['ranges']>=1000&&$_POST['ranges']<=1199))
				{
					$rangelimit = mysql_fetch_array(mysql_query("SELECT * FROM products WHERE productcode ".$productcode." and ranges LIKE '%".substr($_POST['ranges'],0,2)."%' && length(ranges)='4' ORDER BY id DESC LIMIT 0,1"));
					$productcodes = array();
					$productcodes = $rangelimit['productcode'];
					$proincrement = $productcodes[7];
					$asciicodes = ord($proincrement)+1;
					$asciivalue = chr($asciicodes);
					mysql_query("UPDATE products SET productcode='S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."".$asciivalue."',ranges='".$_POST['ranges']."' WHERE id='".$_POST['id']."'");
					$_POST['ranges'] = "";
				}
				else if($productvalues['total']>=1)
				{
					$asciivalue = 'A';
					mysql_query("UPDATE products SET productcode='S".$_POST['drivertype']."".$_POST['structure']."".$_POST['ic']."".$_POST['wattagerange']."".$_POST['currentrange']."".$asciivalue."',ranges='".$_POST['ranges']."' WHERE id='".$_POST['id']."'");
					$_POST['drivertype'] = "";
					$_POST['structure'] = "";
					$_POST['ic'] = "";
					$_POST['wattagerange'] = "";
					$_POST['currentrange'] = "";
					$_POST['ranges'] = "";
				}
			}
			$_POST['ranges'] = "";
		}
		if($_GET['id'] && $_GET['action']=='Edit')
		{
			$values = mysql_fetch_assoc(mysql_query("SELECT * FROM products WHERE id='".$_GET['id']."'"));
			$productcode = array();
			$productcode = $values['productcode'];
			$_POST['drivertype'] = $productcode[1];
			$_POST['structure'] = $productcode[2];
			$_POST['ic'] = $productcode[3];
			$_POST['wattagerange'] = $productcode[4];
			$_POST['currentrange'] = $productcode[5];
			$_POST['ranges'] = $values['ranges'];
		}
		if($_GET['id'] && $_GET['action']=='Delete')
			mysql_query("DELETE FROM products WHERE id='".$_GET['id']."'");
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&innersubpage=".$_GET['innersubpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION['id']; ?>" required="required"/>
			<header><h2>Productcode</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<?php 
						$drivertype = mysql_query("SELECT * FROM drivertype");
						$drivertypes = mysql_fetch_assoc(mysql_query("SELECT * FROM drivertype WHERE indexvalue='".$_POST['drivertype']."'"));
					?>
					<label>Driver Type</label>
					<select id="drivertype" name="drivertype">
						<option value="select">Select</option>
						<?php
							while($drivers = mysql_fetch_assoc($drivertype))
							{
								
								if($_GET['id'] && ($_POST['drivertype'] == $drivers['indexvalue']))
									echo'<option value="'.$drivers['indexvalue'].'" selected>'.$drivers['drivertype'].'</option>';
								/* else if($_POST['drivertype'] == $drivers['indexvalue'])
									echo'<option value="'.$drivers['indexvalue'].'" selected>'.$drivers['drivertype'].'</option>'; */
								else
									echo'<option value="'.$drivers['indexvalue'].'">'.$drivers['drivertype'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="clearfix">
					<label>Structure</label>
					<select id="structure" name="structure">
						<option value="select">Select</option>
						<?php
							$structure = mysql_query("SELECT * FROM structure");
							while($structures = mysql_fetch_assoc($structure))
							{
								if($_GET['id'] && ($_POST['structure'] == $structures['indexvalue']))
									echo'<option value="'.$structures['indexvalue'].'" selected>'.$structures['structure'].'</option>';
								/* else if($_POST['structure'] == $structures['indexvalue'])
									echo'<option value="'.$structures['indexvalue'].'" selected>'.$structures['structure'].'</option>'; */
								else
									echo'<option value="'.$structures['indexvalue'].'">'.$structures['structure'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="clearfix">
					<label>IC</label>
					<select id="ic" name="ic">
						<option value="select">Select</option>
						<?php
							$ic = mysql_query("SELECT * FROM ic");
							while($ics = mysql_fetch_assoc($ic))
							{
								if($_GET['id'] && ($_POST['ic'] == $ics['indexvalue']))
									echo'<option value="'.$ics['indexvalue'].'" selected>'.$ics['ic'].'</option>';
								/* else if($_POST['ic'] == $ics['indexvalue'])
									echo'<option value="'.$ics['indexvalue'].'" selected>'.$ics['ic'].'</option>'; */
								else
									echo'<option value="'.$ics['indexvalue'].'">'.$ics['ic'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="clearfix">
					<label>Wattage ranges</label>
					<select id="wattagerange" name="wattagerange">
						<option value="select">Select</option>
						<?php
							$wattagerange =  mysql_query("SELECT * FROM wattagerange");
							while($wattage = mysql_fetch_assoc($wattagerange))
							{
								if($_GET['id'] && ($_POST['wattagerange'] == $wattage['indexvalue']))
									echo'<option value="'.$wattage['indexvalue'].'" selected>'.$wattage['wattagerange'].'</option>';
								/* else if($_POST['wattagerange'] == $wattage['indexvalue'])
									echo'<option value="'.$wattage['indexvalue'].'" selected>'.$wattage['wattagerange'].'</option>'; */
								else
									echo'<option value="'.$wattage['indexvalue'].'">'.$wattage['wattagerange'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="clearfix">
					<label>Current ranges</label>
					<select id="currentrange" name="currentrange">
						<option value="select">Select</option>
						<?php
							$currentrange = mysql_query("SELECT * FROM currentrange");
							while($current = mysql_fetch_assoc($currentrange))
							{
								if($_GET['id'] && ($_POST['currentrange'] == $current['indexvalue']))
									echo'<option value="'.$current['indexvalue'].'" selected>'.$current['currentrange'].'</option>';
								/* else if($_POST['currentrange'] == $current['indexvalue'])
									echo'<option value="'.$current['indexvalue'].'" selected>'.$current['currentrange'].'</option>'; */
								else
									echo'<option value="'.$current['indexvalue'].'">'.$current['currentrange'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="clearfix">
					<label>Current ranges</label>
					<input type="text" name="ranges" id="ranges" value="<?php echo $_POST['ranges']?>" onkeypress="return isNumericfunction(event);">
				</div>
			</fieldset>
			<hr />
			<?php
			if($_GET['action'] == 'Edit')
				echo '<button class="button button-green" type="submit" name="Update" value="Update" onclick="return validation();">Update</button>&nbsp;&nbsp;';
			else
				echo '<button class="button button-green" type="submit" name="Submit" onclick="return validation();">Submit</button>&nbsp;&nbsp;';
				?>
			<button class="button button-gray" type="reset">Reset</button>
		</form>
		</div>
		<div class="columns">
			<hr />			
			<table class="paginate sortable full">
				<thead>
					<tr>
						<th width="43px" align="center">S.NO.</th>
						<th align="left">Productcode</th>
						<th align="left">Ranges</th>
						<th align="left">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i=1;
						$enabledisable = mysql_query("SELECT * FROM products");
						if(mysql_num_rows($enabledisable)==0)
							echo '<tr><td colspan="4" style="color:red;"><center>No data found</center></td></tr>';
						else
						{
							while($edisable = mysql_fetch_assoc($enabledisable))
							{
								echo'<tr>
										<td>'.$i++.'</td>
										<td>'.$edisable['productcode'].'</td>
										<td>'.$edisable['ranges'].'</td>
										<td><!--a href="?page=Masters&subpage=Stockmaster&innersubpage=Products&id='.$edisable['id'].'&action=Edit" class=action-button title=user-edit><span class=user-edit></span></a--><a href="?page=Masters&subpage=Stockmaster&innersubpage=Products&id='.$edisable['id'].'&action=Delete"class=action-button title=user-delete onclick="return deleterows();"><span class=user-delete></span></a></td>
									</tr>';
							}
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="clear">&nbsp;</div>
	<?php
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
</section>
<script>
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode == 8 || charCode == 9 ||charCode == 35 ||charCode == 36 ||charCode == 46)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122 || charCode == 32)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode==48 || charCode==49 || charCode==8 || charCode==127 || charCode==37 || charCode==38 || charCode==39 || charCode==40)
			return true;
		else
			return false;
	}
	function isNumericfunction(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if(charCode>=48 && charCode<=57 || charCode==8 || charCode==127 || charCode==37 || charCode==38 || charCode==39 || charCode==40)
			return true;
		else
			return false;
	}
	function validation()
	{
		if(document.getElementById("drivertype").selectedIndex==""||document.getElementById("drivertype").selectedIndex==null)
		{
			alert('Please enter Drivertype');
			return false;
		}
		else if(document.getElementById("structure").selectedIndex==""||document.getElementById("structure").selectedIndex==null)
		{
			alert('Please enter Structure');
			return false;
		}
		else if(document.getElementById("ic").selectedIndex==""||document.getElementById("ic").selectedIndex==null)
		{
			alert('Please enter Ic');
			return false;
		}
		else if(document.getElementById("wattagerange").selectedIndex==""||document.getElementById("wattagerange").selectedIndex==null)
		{
			alert('Please enter Wattagerange');
			return false;
		}
		else if(document.getElementById("currentrange").selectedIndex==""||document.getElementById("currentrange").selectedIndex==null)
		{
			alert('Please enter currentrange');
			return false;
		}
		else if(document.getElementById("ranges").value==""||document.getElementById("ranges").value==null)
		{
			alert('Please enter Range');
			return false;
		}
	}
	function deleterows()
	{
		var x = confirm("Are you sure want to delete?");
		if(x==true){}
		else
			return false;
	}
</script>