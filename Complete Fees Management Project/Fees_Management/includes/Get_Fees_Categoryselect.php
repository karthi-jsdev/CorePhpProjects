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
				$Classid = mysqli_fetch_array(mysqli_query($_SESSION['connection'],"SELECT classid FROM section  where id='".$_POST['sectionid']."'"));
				$Feescategory = mysqli_query($_SESSION['connection'],"SELECT fees_catagory.name,fees_category_assign.id,fees_category_assign.classids FROM fees_category_assign
				JOIN fees_catagory ON fees_catagory.id = fees_category_assign.feescategoryid
				order by fees_category_assign.id desc");
				echo "<select name='feescategoryid'>";
				echo "<option value=''>Select</option>";
				while($Fees = mysqli_fetch_array($Feescategory))
				{
					$i++;
					$Seperatedfeedcategorynames = explode(",",$Fees['classids']);
					if(in_array($Classid['classid'], $Seperatedfeedcategorynames))
					{
						$Existflag = 1;
						if($_POST['feescategoryid'] == $Fees['id'])	
							echo '<option value='.$Fees['id'].' selected>'.$Fees['name'].'</option>';
						else	
							echo '<option value='.$Fees['id'].'>'.$Fees['name'].'</option>';
					}
				}
				echo "</select>";
				if($Existflag == 0)
					echo "Fees Category Not Assigned";
			?>
		</tr>
	</table>
	<?php 
	}
	?>