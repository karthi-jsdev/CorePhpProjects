<?php
	include("Config.php");
	ini_set("display_errors","0");
	if($_POST['sectionid'])
	{?>
	<table>
		<tr>
			<?php
				$i = 1;
				$Existflag = 0;
				$Classid = mysql_fetch_array(mysql_query("SELECT classid FROM section  where id='".$_POST['sectionid']."'"));
				
				$Feescategory = mysql_query("SELECT fees_catagory.name,fees_category_assign.id,fees_category_assign.classids FROM fees_category_assign
				JOIN fees_catagory ON fees_catagory.id = fees_category_assign.feescategoryid
				order by fees_category_assign.id desc");
				while($Fees = mysql_fetch_array($Feescategory))
				{
					$i++;
					$Seperatedfeedcategorynames = explode(",",$Fees['classids']);
					if(in_array($Classid['classid'], $Seperatedfeedcategorynames))
					{
						$Existflag = 1;
						if(in_array($Fees['id'], $_POST['fees_catagoryids']))
							echo '<td><input type="checkbox" id="feescategoryid'.$i.'" name="feescategoryid[]" value="'.$Fees['id'].'" checked />'.$Fees['name'].'</td>';
						else
							echo '<td><input type="checkbox" name="feescategoryid[]" id="feescategoryid'.$i.'" value="'.$Fees['id'].'" />'.$Fees['name'].'</td>';
					}
				}
				if($Existflag == 0)
					echo "Fees Category Not Assigned";
			?>
		</tr>
	</table>
	<?php 
	}
	?>