<?php
ini_set("display_errors","0");
include("chk.php") ;
$db=new Database();

if(isset($_REQUEST["status"])) 
{
	$condition ='id='.base64_decode($_REQUEST["id"]);
	$arFieldsValues = array();
	$arFieldsValues['status'] = $_REQUEST["status"];
	$db->update('bearer',$arFieldsValues,$condition);
}
$delete_id = base64_decode($_REQUEST["id"]);
if($delete_id) 
{	 
	$condition = 'id='.$delete_id;
     	$num = $db->delete('news_events',$condition);
	if($num == 1) $alert = "<div class='message success'> <h3>DELETED!</h3> <p>Record deleted successfully</p> </div>";
}

//-----------prepare message after insert or edit records------------
if($_REQUEST["action"]=='insert' && $_REQUEST["keywords"] =='' && !isset($_POST["maxrows"]))
$alert='<div class="message success"> <h3>ADDED!</h3> <p>Record inserted successfully</p> </div>';
if($_REQUEST["action"]=='update'  && $_REQUEST["keywords"]=='' && !isset($_POST["maxrows"]))
$alert='<div class="message success"> <h3>UPDATED!</h3> <p>Record updated successfully</p> </div>';
if(isset($_REQUEST["status"]) && (!isset($_POST["maxrows"])))
$alert='<div class="message success"> <h3>UPDATED!</h3> <p>Record updated successfully</p> </div>';

//--------------count total number of records in the bearer table--------
$sql = "SELECT count(*) AS total FROM news_events where clientId='".$_SESSION['clientId']."'";
$result = $db->select($sql);
foreach($result as $key => $value);
$total = $value['total'];


//--------start paging----------------
if (!$currentpage)
	$currentpage = 1;
$start = PAGESIZE * ($currentpage - 1); 
$end = $start + PAGESIZE;
$maxrows = $_REQUEST["maxrows"];
if($maxrows==''|| !is_numeric($maxrows)) 
{
	$maxrows=10;
} 
else 
{
	$maxrows = $maxrows;
}


if($_REQUEST["search"]==1) 
{ 	
	$keywords = trim(stripslashes(clean_data($_REQUEST["keywords"])));
	$exp_keywords = explode(" ",$keywords);
	if(count($exp_keywords) > 1)  
	{
		$sql = "SELECT * FROM news_events WHERE clientId='".$_SESSION['clientId']."' AND (newsEvents like '%$exp_keywords[0]%') ORDER BY id"; 
	}
	else 
	{
		$sql = "SELECT * FROM news_events WHERE clientId='".$_SESSION['clientId']."' AND (newsEvents like '%$keywords%' ) ORDER BY id";
	}
}
else 
{ 
	$sql = "SELECT * FROM news_events where clientId='".$_SESSION['clientId']."' ORDER BY id"; 
}
		
$result = $db->select($sql);
$no_of_rows = count($result);	
$no_pages = ceil($no_of_rows / $maxrows);
	
//--------------lower and upper limit settings -----------
if($no_of_rows==0)
{  
	$message = "No record found"; 
}
$display = base64_decode($_REQUEST["display"]);

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
	$bottom_start=1;
	$bottom_end=5;
	$next=$bottom_end+1;
	$prvious=0;  
} 
else if($display <= 4 && $no_pages<=5) 
{
	$bottom_start=1;
	$bottom_end=$no_pages;
	$next=0;
	$prvious=0;
} 
else if($display > 1 && $no_pages>=5) 
{
	$bottom_end=$display+2;
	$bottom_start=$display-2;
	if($bottom_end>$no_pages) 
	{
		$bottom_end=$no_pages;
		$bottom_start=$no_pages-4;
	}
}
	
//---------------------ends paging---------------

	//display result  query
	$sql .= " LIMIT $lower_limit,$maxrows"; 
	$result = $db->select($sql);

?>
<!-- Left column/section -->
<script language="javascript">
function del()
{
  var ok=confirm("Are you sure, Do you want to delete this record?");
  if(ok==true)
		return true;
  else
  		return false; 
}

function super_msg()
{
	 alert("You have no privilege to delete this record");
	 return false;
}

function super_msg1()
{
	 alert("This is super bearer, you cant edit this record");
	 return false;
}
</script>
<section class="grid_6 first">	
    <div class="columns">
        <div class="grid_6 first">
			<br/>
			<table width="100%">
				<tr>
					<td width="70%" >
					</td>
					<?php
					if($alert)
					{	?>
					<?php print $alert; ?>
					<?php  } ?>
					<td>
					<a class="button button-green" href="index.php?page=news&subpage=addnews&maxrows=<?php echo $maxrows;?>" align="right">Add New News & Events </a>
					</td>
				</tr>
			</table>
			<table class="form panel full">
			<tbody>
				<tr>
					<form name="search" method="post">
					<input type="Hidden" name="display" value="<?php echo $code; ?>" />
					<input type="Hidden" name="maxrows" value="<?php echo $maxrows; ?>" />
					<td>
						<div class="clearfix"  style="padding:10px;">
							<label>Description Search</label>
							<input type="text" class="paragraph" name="keywords" value="<?php echo stripslashes($keywords); ?>" />
							<input type="hidden" name="search" value="1" />
					</form>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a class="button button-blue" href="javascript:document.search.submit();">Search</a>
						</div>
					</td>
				</tr>
				<tr>	
					<td>
						<form name="number" method="post">				
							<input type="Hidden" name="keywords" value="<?php echo stripslashes($keywords); ?>" />
							<input type="hidden" name="search" value="<?php echo $search; ?>" />
							<?php $code=base64_encode(1);?>
							<input type="hidden" name="display" value="<?php echo $code; ?>">
							
							<div class="clearfix"  style="padding:10px;">
							<label>Content's per page:</label>
								<select class="paragraph" onChange=javascript:document.number.submit(); size = 1 name = maxrows>
									<option value="2" <?php if($maxrows==2) echo "selected";?>>2</option>
									<option value="10" <?php if($maxrows==10) echo "selected";?>>10</option>
									<option value="20" <?php if($maxrows==20) echo "selected";?>>20</option>
									<option value="30" <?php if($maxrows==30) echo "selected";?>>30</option>
									<option value="40" <?php if($maxrows==40) echo "selected";?>>40</option>
									<option value="50" <?php if($maxrows==50) echo "selected";?>>50</option>
									<option value="60" <?php if($maxrows==60) echo "selected";?>>60</option>
									<option value="70" <?php if($maxrows==70) echo "selected";?>>70</option>
									<option value="80" <?php if($maxrows==80) echo "selected";?>>80</option>
									<option value="90" <?php if($maxrows==90) echo "selected";?>>90</option>
									<option value="100" <?php if($maxrows==100) echo "selected";?>>100</option>
								</select>
							</div>
						</form>
					</td>
				</tr>
				<tr>
					<td>
						<div style="padding:10px;">
						<?php 
							if($no_of_rows <> 0)
							{
								?>
								Viewing
								<?php echo $lower_limit+1; ?>
								- <b>
								<?php if($end > $no_of_rows) { echo $no_of_rows;} else { echo $end;}?>
								</b> of
								<?php echo $no_of_rows; ?>
								Bearer
								<?php
							}
						?>
						</div>
					</td>
				</tr>
			</div>
			</table>
			
			<?php
			if($no_of_rows != 0)
			{ ?>
					<table class="paginate sortable full">
						<thead>
							<tr>
								<th align="center">Id</th>
								<th align="left">News & Events</th>
								<th align="center">Status</th>
								<th align="center">Edit</th>
								<th align="center">Delete</th>
							</tr>
						</thead>
						<tbody>
						<?php //starting of foreach loop
							$counter = $lower_limit+1;
							foreach($result as $key=> $data) 
							{		
								$id = $data['id'];
								$newsEvents = $data['newsEvents'];
								$status  = $data['status'];												
								if($status == 1) $image_name = "accept"; else $image_name = "delete";
								?>
								<tr>
									<td align="center"><?php echo $counter; ?></td>
									<td><?php echo stripslashes($newsEvents); ?></td>
									<td align="center"><a class="action-button"><span class="<?php echo $image_name;?>"></span></a></td>
									<td align="center"><a class="action-button" href="index.php?page=news&subpage=addnews&id=<?=base64_encode($id)?>&direct=1&maxrows=<?=$maxrows;?>&display=<?=$_REQUEST[display];?>&keywords=<?=stripslashes($keywords)?>&search=<?=$search?>&action=Edit" class="links" title="View News & Events"><span class="pencil" /></a> </td>							
									<td align="center"><a class="action-button" href="index.php?page=news&id=<?php echo base64_encode($id); ?>&direct=1&maxrows=<?php echo $maxrows;?>&display=<?php echo $_REQUEST[display];?>&keywords=<?php echo stripslashes($keywords);?>&search=<?php echo $search; ?>&action=Delete" class="links" title="Delete" onClick="return del()"><span class="delete" /></a></td>
								</tr>
							<?php $counter++;
							}  //ends of foreeach loop  
							?>
						</tbody>
					</table>
							
				<?php
				} 
				else
				{ 	?>
					<div class="alert" align="center"><br>
						<font color="red">
						<?php print $message;?>
						</font>
					</div>
					<br>
					<?php 
				} 
					
				if($no_pages>1)
				{
				?>
				<br/>
					<ul class="pagination clearfix">      
						<?php
						if($display>1 && $no_pages>1)
						{ 
							$pre=base64_encode($display-1);
							?>
								<li class="prev">
								<a class="button-blue" href="index.php?page=news&maxrows=<?php echo $maxrows;?>&display=<?php echo $pre;?>&keywords=<?php echo stripslashes($keywords);?>&search=<?php echo $search; ?>">&laquo;</a>
								</li>
							<?php  
						}
						else
						{	?>													
							<li class="prev"><a class="button-blue" href="#">&laquo;</a></li>
							<?php 
						}
						for($i=$bottom_start;$i<=$bottom_end;$i++)
						{ 
							if($display!=$i)
							{  
								$current=base64_encode($i);
								?>
								<li class="page"><a class="button-blue" href="index.php?page=news&maxrows=<?php echo $maxrows;?>&display=<?=$current;?>&keywords=<?=stripslashes($keywords)?>&search=<?=$search?>"><?php echo $i; ?></a></li>
								<?php
							}
							else
							{	?>						
							<li class="page">
							<a class="button-blue current" href=""><?php echo $i; ?></a>
							</li>	
							<?php
							}
						} 
						if($display<$no_pages)
						{ 
							$nex=base64_encode($display+1);
							?>				
							<li class="next">
							<a class="button-blue" href="index.php?page=news&maxrows=<?php echo $maxrows;?>&display=<?php echo $nex;?>&keywords=<?php echo stripslashes($keywords);?>&search=<?php $search; ?>">&raquo;</a>
							</li>
							<?php  
						}
						else
						{	?>
							<li class="next"><a class="button-blue" href="#">&raquo;</a></li>
							<?php 
						}	?>
					</ul>
				<?php
				}
				if($_REQUEST["keywords"]!="")
				{
					?>
					<br>
					<div align="center"> <a href="index.php?page=news&maxrows=<?php echo $maxrows;?>" class="button button-gray">Return to Listing </a> </div>
			<?php
				}
			?>
			
    </div>            
    <div class="clear">&nbsp;</div>

</section>

<!-- End of Left column/section -->