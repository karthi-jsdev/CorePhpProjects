<?php

include ("includes/include/f_config.php");
include ("includes/include/f_functions.php");

error_reporting(0);

$db=new Database();

if (isset($_POST['submit'])) 
{ 
	//echo '<pre>'; print_r($_POST); echo '</pre>';
	$i = 0;
	$id = array();
	$feed = array();
	foreach ($_POST AS $key => $value) 
	{
		if ($key == 'id') 
		{
			foreach ($value AS $data) 
			{
				$id[] .= $data ;
			}
		}
		if ($key == 'feed') 
		{
			foreach ($value AS $data) 
			{
				$feed[] .= $data;
			}
		}
	}
	
	for ($i = 0; $i < count($id); $i++) 
	{
		if ($feed[$i] == 1) 
		{
			$sql = "UPDATE config SET `value` = '".$id[$i]."' WHERE `option` = 'channel1'";
			mysql_query($sql) or die("Error:".mysql_error());
		} 
		else if ($feed[$i] == 2) 
		{
			$sql = "UPDATE config SET `value` = '".$id[$i]."' WHERE `option` = 'channel2'";
			mysql_query($sql);
		} 
		else if ($feed[$i] == 3) 
		{
			$sql = "UPDATE config SET `value` = '".$id[$i]."' WHERE `option` = 'channel3'";
			mysql_query($sql);
		}
		unset($sql);
	}
	
}

//--------start paging----------------
if (!$currentpage) 
{
	$currentpage = 1;
}
$start = PAGESIZE*($currentpage-1); 
$end = $start + PAGESIZE;
$maxrows = $_REQUEST["maxrows"];
if($maxrows == '' || !is_numeric($maxrows)) 
{
	$maxrows = 10;
} 
else 
{
	$maxrows = $maxrows;
}


if($_REQUEST["search"] == 1) 
{ 	
	  $sql = '';
	  $keywords = trim(stripslashes(clean_data($_REQUEST["keywords"])));
	  $exp_keywords = explode(" ",$keywords);
	if(count($exp_keywords) >= 1)  
	{
		$sql = "SELECT * FROM video WHERE (title LIKE '%$exp_keywords[0]%') ORDER BY title"; 
	} 
	else 
	{
		$sql = "SELECT * FROM video WHERE (title LIKE '%$keywords%')  ORDER BY title";
	}
} 
else 
{ 
	$sql = "SELECT * FROM video ORDER BY enterdate DESC"; 
}
		
	$sel_rows = $db->select($sql);
	$no_of_rows = count($sel_rows);	
	$no_pages = ceil($no_of_rows/$maxrows);
	
	//--------------lower and upper limit settings -----------
	if($no_of_rows==0) 
	{
		$message="No record found"; 
	}

$display=base64_decode($_REQUEST["display"]);

if(($display == 1) or  (!$display) or !is_numeric($display)) 
{
	$display = 1;
	$lower_limit = 0;
	$start=$maxrows*($display-1); 
	$end=$start+$maxrows;
} 
else 
{
	if($no_of_rows <= ($display-1)*$maxrows)
	$display--;
	$lower_limit = ($display-1)*$maxrows;
	$start=$maxrows*($display-1); 
	$end=$start+$maxrows;
}
//--------------------ends-----------------------

//for bottom paging
if(($display<4) && $no_pages>5) 
{
	$bottom_start = 1;  
	$bottom_end = 5; 
	$next = $bottom_end + 1; 
	$prvious = 0;
}
else if($display <= 4 && $no_pages<=5) 
{
	$bottom_start = 1;
	$bottom_end = $no_pages;
	$next = 0;
	$prvious = 0;
} 
else if($display > 1 && $no_pages >= 5) 
{
	$bottom_end = $display + 2;
	$bottom_start = $display - 2;
	if($bottom_end>$no_pages) 
	{
		$bottom_end = $no_pages;
		$bottom_start = $no_pages-4;
	}
}
//---------------------ends paging---------------

//display result  query
$sql .= " LIMIT $lower_limit,$maxrows";

$select_rows = $db->select($sql);
?> 

<style type="text/css">
.selector { margin-bottom: none; }
</style>

<script src="js/jquery.tables.js"></script>
<!-- Left column/section -->

<section class="grid_6 first">
    <div class="columns leading">
        <div class="grid_6 first">
            <h3>Video Gallery - only 3 videos are allowed in the feeds, others are reset automatically</h3>
            <hr />

            <table class="paginate full">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
						
						<?php //starting of foreach loop
										$sql = "SELECT * FROM `config`";
										$result = mysql_query($sql);
										while($tmp = mysql_fetch_assoc($result)){
											$field = $tmp['option'];
											$config[$field] = $tmp['value'];
										}
										//echo '<pre>'; print_r($config); echo '</pre>';
										$counter=$lower_limit+1;
										foreach($select_rows as $key=> $data) {		
											$gallery_id		=	$data['video_id'];
											$gallery_title	=	$data['title'];											
											$gallery_status  =	$data['status'];
											//$feed = $data['feed'];
											
											if ($config['channel1'] == $gallery_id) {
												$channel1 = "selected='selected'";
											} else {
												unset($channel1);
											}
											if ($config['channel2'] == $gallery_id) {
												$channel2 = "selected='selected'";
											} else {
												unset($channel2);
											}
											if ($config['channel3'] == $gallery_id) {
												$channel3 = "selected='selected'";
											} else {
												unset($channel3);
											}
											
											if($gallery_status==1) $image_name="accept.png"; else $image_name="delete.png";
										?>
							
                            <tr>
								<td> <?php echo $counter; ?> </td>
								<td> <?php echo stripslashes($gallery_title); ?> </td>
								<td> <img src="images/icons/<?php echo $image_name; ?>" /> </td>
								<td>
								
									<input type='hidden' name='id[]' value="<?php echo $gallery_id; ?>" />
									<select name='feed[]'>
										<option value='0'>--Select--</option>
										<option value='1'><?php echo $config['feed1']; ?></option>
										<option value='2'><?php echo $config['feed2']; ?></option>
										<option value='3'><?php echo $config['feed3']; ?></option>
									</select>
								</td>
                            </tr>
						<?php $counter++;
						 }  //ends of for each loop  
						?>
				</tbody>
			</table>
			<center><input class="button button-blue" type='submit' name='submit' value='Submit' /></center>
		</div>
	</div>

</section>

<!-- End of Left column/section -->