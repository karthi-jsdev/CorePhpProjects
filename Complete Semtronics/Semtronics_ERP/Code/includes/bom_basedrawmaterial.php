<?php
include('Config.php');
include('Product_Management Queries.php');
ini_set("display_errors","0");
if($_GET['bom_category'])
{
	$bomrawmaterial = select_rawmaterialbombased();
	?>
	<select name="rawmaterialid" id="rawmaterialid">
		<option value="">Select</option>
		<?php
		while($brawmaterial = mysql_fetch_assoc($bomrawmaterial))
		{
			echo '<option value="'.$brawmaterial['id'].'">'.$brawmaterial['materialcode'].'</option>';
		} ?>
	</select>
<?php 
}