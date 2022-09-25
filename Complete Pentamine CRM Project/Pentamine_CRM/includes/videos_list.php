<?php
ini_set("display_errors","0");
require ("include/f_config.php");
require ("include/f_functions.php");

$db=new Database();
$catid=intval(base64_decode($_GET['catid']));
if(isset($_REQUEST["status"]))
{
	$condition='videoId ='.base64_decode($_REQUEST["videoId"]);
	$arFieldsValues=array();
	$arFieldsValues['status']=$_REQUEST["status"];
	$db->update('video',$arFieldsValues,$condition);
}
$cat=base64_decode($_GET['catid']);
$sql_admnew1="select * from  category where categoryId='$cat'";
$result_admnew1= $db->select($sql_admnew1);
$img_height=$result_admnew1[0]['image_height'];
$img_height_new=explode(',',$img_height);
$img_width=$result_admnew1[0]['image_width'];
$img_width_new=explode(',',$img_width);
$image_folder=$result_admnew1[0]['image_folder'];
$delete_id=intval(base64_decode($_GET["del_id"]));
if($delete_id)
{
    $sql_video 	=	"SELECT * FROM video WHERE clientId='".$_SESSION['clientId']."' AND videoId=$delete_id";
	$res_video	= $db->select($sql_video);
	foreach($res_video as $key=> $data) 
	{
		$thumb = $data['thumbImg'];
		if ($data['type'] == 0) 
		{
			if (ftpLogin($ftpstream, $config['f_user'], $config['f_password'])) 
			{
				if (ftpDelete($ftpstream, $data['path'])) 
				{
					$alert = '<div class="message success">File deleted successfully .... !</div>';
					
				} 
				else 
				{
					$alert = '<div class="message success">File could not delete ..... !</div>';
				}
			}
			ftpClose($ftpstream);
		} 
	}

	if(trim($thumb)!='')
	{
		$urlregex = "^(https?|ftp)\:\/\/([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*(\:[0-9]{2,5})?(\/([a-z0-9+\$_-]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@/&%=+\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?\$";
		if (!eregi($urlregex, $thumb)) 
		{
			$link = './thumb/' . $thumb;
			unlink($link);
		}
	}
	
//==================for sort order====================================	
	$select_total_del="select * from video where clientId='".$_SESSION['clientId']."' AND videoId=$delete_id";
     	$select_total_dell=$db->select($select_total_del);
	 $sortorder=trim(stripslashes($select_total_dell[0]['sortOrder']));
	 $condition='videoId='.$delete_id;
	 $num=$db->delete('video',$condition);
	 $select_total_cnt=$db->select("select * from video where clientId='".$_SESSION['clientId']."' AND categoryId =$catid");
	 $num_cnt_menu=count($select_total_cnt);
	 if($num_cnt_menu>0)
	 {
		 $sql_sorting_new1="select * from video where clientId='".$_SESSION['clientId']."' AND sortOrder > $sortorder and categoryId = $catid ORDER BY sortOrder DESC";
		 $result_sorting_new1= $db->select($sql_sorting_new1);
		foreach($result_sorting_new1 as $key=> $dataz)
		{	
			$arFieldsValuesz['sortOrder']=$dataz['sortOrder']-1;
			$resulter=$db->update('video',$arFieldsValuesz,'videoId='.$dataz['videoId']);
		}
	  }
//==========================================	
	 $condition='videoId='.$delete_id;
	 $num=$db->delete('video',$condition);
	 
   
	 if($num==1) $alert='<div class="message success">Record deleted successfully</div>';
}
		//-----------prepare message after insert or edit records------------
		if($_REQUEST["action"]=='insert' && $_REQUEST["keywords"] =='' && !isset($_POST["maxrows"]))
		$alert='<div class="message success">Record inserted successfully</div>';
		if($_REQUEST["action"]=='update'  && $_REQUEST["keywords"]=='' && !isset($_POST["maxrows"]))
		$alert='<div class="message success">Record updated successfully</div>';
		if(isset($_REQUEST["status"]) && (!isset($_POST["maxrows"])))
		$alert='<div class="message success">Record updated successfully</div>';
//--------------count total number of records in the bearer table--------
		$select_total_sql="select count(*) as total from video where clientId='".$_SESSION['clientId']."' AND categoryId=$catid";
		$select_total=$db->select($select_total_sql);
		foreach($select_total as $key=>$res);
		$total_number_bearer=$res['total'];


//--------start paging----------------
if (!$currentpage)
	$currentpage = 1;
$start=PAGESIZE*($currentpage-1); 
$end=$start+PAGESIZE;
$maxrows=$_REQUEST["maxrows"];
if($maxrows==''|| !is_numeric($maxrows))
{
	$maxrows=10;
}
else 
{
	$maxrows=$maxrows;
}


	if($_REQUEST["search"]==1)
	{ 	
	      	$keywords=trim(stripslashes(clean_data($_REQUEST["keywords"])));
		$exp_keywords=explode(" ",$keywords);
		  if(count($exp_keywords)>=1)  
		  {
		  	$sel_bearer="select * from video where clientId='".$_SESSION['clientId']."' AND (title like '%$exp_keywords[0]%') order by title"; 
		  }
		  else 
		  {
		    $sel_bearer="select * from video where clientId='".$_SESSION['clientId']."' AND (title like '%$keywords%')  order by sortOrder";
		  }
	}
	else  
	{
		$sel_bearer="select * from video where clientId='".$_SESSION['clientId']."' AND categoryId =$catid order by sortOrder"; 
	}
		
	$sel_rows=$db->select($sel_bearer);
	$no_of_rows=count($sel_rows);	
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
		$bottom_start=1;  $bottom_end=5; $nex=$bottom_end+1; $prvious=0;  
	}
	else if($display <= 4 && $no_pages<=5)
	{
		$bottom_start=1;  $bottom_end=$no_pages; $next=0; $prvious=0;  
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
	$select_bearer=$sel_bearer."  limit $lower_limit,$maxrows "; 
	$select_rows=$db->select($select_bearer);
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
	 alert("This is super gallery, you cant edit this record");
	 return false;
}
</script>
<section class="first">
    <div class="columns">
        <div class="grid_6 first">
			<br />
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
					<a class="button button-green" href="index.php?page=upload&maxrows=<?php echo $maxrows;?>" align="right">Add New Video </a>
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
            <table class="paginate full">
				<?php if($msg!=''){?>
                <tr> 
					<td>
						<div align="center" class="style1"><?php echo $msg;?></div>
					</td>
                </tr>
				<?php }?>
				
                <thead>
                    <tr>
                        <th align="center">Id</th>
                        <th align="left">Title</th>
                        <th align="center">Status</th>
                        <th align="center">Sort Order</th>
						<th align="center">Visibility</th>
                        <th align="center">Edit</th>
						<th align="center">Delete</th>
                    </tr>
                </thead>
                <tbody>
				<?php //starting of foreach loop
					$counter = $lower_limit+1;
					foreach($select_rows as $key=> $data)
					{		
						$gallery_id		=	$data['videoId'];
						$gallery_title	=	$data['title'];											
						$gallery_status  =	$data['status'];
						$sort_order 	=	$data['sortOrder'];											
						if($gallery_status == 1) $image_name="accept"; else $image_name="delete";						
					?>
                    <tr align="center">
                        <td>
							<?php echo $counter; ?>
						</td>
                        <td align="left"> 
							<?php echo stripslashes($gallery_title); ?></td>
						<td>
							<a class="action-button"><span class="<?php echo $image_name; ?>"/>"></a>
						</td>
                        <td>
							<?php echo $sort_order;?>
						</td>
                        <td>
							<a class="action-button" href="index.php?page=videos&subpage=videolist&maxrows=<?php echo $maxrows;?>&display=<?php echo $_REQUEST[display];?>&keywords=<?php echo stripslashes($keywords);?>&search=<?php echo $search;?>&videoId=<?php echo base64_encode($gallery_id);?>&catid=<?php echo base64_encode($catid);?>&status=<?php if($gallery_status == 1) echo "0"; else echo "1";?>&cat=<?php echo $cat;?>"  title="<?php if($gallery_status == 1) echo"Disable"; else echo"Enable";?>">
                            <?php if($gallery_status == 1) echo"<span class='delete'/>"; else echo"<span class='accept'/>";?>
                            </a>
						</td>
						<td>
							<a class="action-button" href="index.php?page=upload&videoId=<?php echo base64_encode($gallery_id);?>&direct=1&maxrows=<?php echo $maxrows;?>&display=<?php echo $_REQUEST[display];?>&keywords=<?php echo stripslashes($keywords);?>&search=<?php echo $search;?>&action=Edit&cat=<?php echo base64_encode($catid);?>" title="View bearer Details"><span class="pencil"/></a>
						</td>
						<td>
							<a class="action-button" href="index.php?page=videos&subpage=videolist&del_id=<?php echo base64_encode($gallery_id);?>&direct=1&maxrows=<?php echo $maxrows;?>&catid=<?php echo base64_encode($catid);?>&display=<?php echo $_REQUEST[display];?>&keywords=<?php echo stripslashes($keywords);?>&search=<?php echo $search;?>&action=Delete&cat=<?php echo $cat;?>" title="Delete"  onClick="return del()"><span class="delete"/></a>
						</td>
                    </tr>
					<?php $counter++;
					} ?>
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
								<a class="button-blue" href="index.php?page=videos&subpage=videolist&maxrows=<?php echo $maxrows;?>&display=<?php echo $pre;?>&keywords=<?php echo stripslashes($keywords);?>&search=<?php echo $search; ?>&catid=<?php echo base64_encode($catid);?>">&laquo;</a>
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
								<li class="page"><a class="button-blue" href="index.php?page=videos&subpage=videolist&maxrows=<?php echo $maxrows;?>&display=<?php echo $current;?>&keywords=<?php echo stripslashes($keywords);?>&search=<?php echo $search; ?>&catid=<?php echo base64_encode($catid);?>"><?php echo $i; ?></a></li>
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
							<a class="button-blue" href="index.php?page=videos&subpage=videolist&maxrows=<?php echo $maxrows;?>&display=<?php echo $nex;?>&keywords=<?php echo stripslashes($keywords);?>&search=<?php echo $search; ?>&catid=<?php echo base64_encode($catid);?>">&raquo;</a>
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
					<div align="center"> <a href="index.php?page=videos&subpage=videolist&catid=<?php echo base64_encode($catid);?>&maxrows=<?php echo $maxrows;?>" class="button button-gray">Return to Listing </a> </div>
			<?php
				}
			?>
    </div>            
    <div class="clear">&nbsp;</div>

</section>

<!-- End of Left column/section -->
