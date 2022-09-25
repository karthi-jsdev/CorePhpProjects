<?php
include("Config.php");
include("Machine_Status_Queries.php");
$Module = array('section_id' =>'customer_id','customer_id' => 'order_id', 'order_id' => 'drawing_id', 'drawing_id' => 'status_id', 'status_id' => 'status_id');
$Labels = array('customer_id' => 'Customer', 'order_id' => 'Order', 'drawing_id' => 'Drawing No.', 'status_id' => 'Status', 'description_id' => 'description_id','section_id' => 'Section');
if($_GET['module'])
{ ?>
	<div class="clearfix">
		<label>&nbsp;&nbsp;<?php echo $Labels[$_GET['module']]; ?></label>
		<select id="<?php echo $_GET['module']; ?>" name="<?php echo $_GET['module']; ?>" onchange="Get_Module_Options('<?php echo $Module[$_GET['module']]."#".$_GET['module']; ?>',this.value)">
			<option value=''>All</option>
			<?php
			if($_GET['module'] == 'section_id')
			{
				$SelectOptions = Master_Select_Section_ById();
				while($SelectOption = mysql_fetch_array($SelectOptions))
					echo str_replace('"'.$_GET[id].'"', '"'.$_GET[id].'" selected',  '<option value="'.$SelectOption['id'].'">'.$SelectOption['name'].'</option>');
			}
			else if($_GET['module'] == 'customer_id')
			{
				echo $_GET['section_id'];
				$SelectOptions = Master_Select_All_Customers();
				while($SelectOption = mysql_fetch_array($SelectOptions))
					echo '<option value="'.$SelectOption['id'].'">'.$SelectOption['name'].'</option>';
			}
			else if($_GET['module'] == 'order_id')
			{
				$SelectOptions = Master_Select_Order_ById();
				while($SelectOption = mysql_fetch_array($SelectOptions))
					echo '<option value="'.$SelectOption['id'].'">'.$SelectOption['number'].'</option>';
			}
			else if($_GET['module'] == 'drawing_id')
			{
				$SelectOptions = Master_Select_DrawingNo_ById();
				while($SelectOption = mysql_fetch_array($SelectOptions))
					echo '<option value="'.$SelectOption['id'].'">'.$SelectOption['drawing_number'].'</option>';
			}
			else if($_GET['module'] == 'status_id')
			{
				echo str_replace('"'.$_GET['id'].'"', '"'.$_GET['id'].'" selected', '<option value="1">Running</option>
				<option value="2">Nearing</option>
				<option value="3">Future</option>
				<option value="4">Not Running</option>');
			} ?>
		</select>
	</div><br />
<?php
}

if($_GET['module'] == 'drawing_id')
{ ?>$
	<div class="clearfix">
		<label>&nbsp;&nbsp;&nbsp;Description</label>
		<select id="description_id" name="description_id" onchange="Get_Module_Options('status_id#description_id',this.value)">
			<option value=''>All</option>
			<?php
			$SelectOptions = Master_Select_Description_ById();
			while($SelectOption = mysql_fetch_array($SelectOptions))
			{
				echo '<option value="'.$SelectOption['id'].'">'.$SelectOption['description'].'</option>';
			} ?>
		</select>
	</div>
	<?php
} ?>