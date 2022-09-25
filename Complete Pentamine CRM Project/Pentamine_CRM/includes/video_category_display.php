<?php
ini_set("display_errors","0");
include("chk.php") ;
require_once("classes/manage_database.php");

$db=new Database();
$del_id=base64_decode($_REQUEST['del_id']);
if ($del_id>0) 
{		
	$msg="";
	$flag=1;
	$chrsql33="SELECT * from video where clientId='".$_SESSION['clientId']."' AND categoryId ='$del_id'";
	$query33=mysql_query($chrsql33);
	if(mysql_num_rows($query33)>0)
	{
		$msg='<div class="message error">You have no permission to delete this Category!<br> In this Category has some videos.</div>';
	}
	else
	{
		$msg='<div class="message success">Category deleted successfully</div>';
		$chrSQL="Delete  From video_category WHERE clientId='".$_SESSION['clientId']."' AND categoryId=$del_id";
	}
	//	echo $chrSQL;
	$delete=mysql_query($chrSQL);
} 

//-----------prepare message after insert or edit records------------
if($_REQUEST["action"]=='insert' && $_REQUEST["keywords"] =='' && !isset($_POST["maxrows"]))
$msg='<div class="message success">Category added successfully</div>';
if($_REQUEST["action"]=='update'  && $_REQUEST["keywords"]=='' && !isset($_POST["maxrows"]))
$msg='<div class="message success">Category updated successfully</div>';

?>
<script src="js/jquery.tables.js"></script>
<!-- Left column/section -->
<script>
function check()
{
if(document.form1.txtcategory.value=="")
{
alert("Please Enter the Categoery Name");
document.form1.txtcategory.focus();
return false;
}
return true;
}

function del()
{
  var ok=confirm("Are you sure, Do you want to delete this record?");
  if(ok==true)
		return true;
  else
  		return false; 
}
</script>
	
<section class="grid_6 first">
    <div class="columns leading">
	<br />
	<?php if($msg!=''){?>
	<div align="center" class="style1"><?php echo $msg;?></div>
	<?php }?>
	
	<?php
	if($alert)
	{	?>
	<div class="alert" align="center"> <?php print $alert; ?></div>
	<?php  } ?>
        <div class="grid_6 first">
			<div align="right">
			<input class="button button-blue" type="button" name="Submit" value="  ADD CATEGORY  "  onClick="document.location.href='index.php?page=videos&subpage=addvideocategory'" >
			</div><br/>
			<div>
            <table class="paginate sortable full">
                <thead>
                    <tr>
                        <th align="left">&nbsp;&nbsp;Category Name</th>
                        <th>Video list</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
					<?php 
					$chrsql = "SELECT * FROM video_category WHERE clientId='".$_SESSION['clientId']."' order by categoryName";
					$rescat = $db->select($chrsql);
					foreach($rescat as $key => $resdata){
					$catid = base64_encode($resdata['categoryId']);
					?>
					<tr>
						<td>&nbsp;&nbsp;<?php echo $resdata['categoryName'];?></td>
						<td align="center"><a class="action-button" href="index.php?page=videos&subpage=videolist&catid=<?php echo $catid; ?>"><span class="video"></span></a></td>
						<td align="center"><a class="action-button" href="index.php?page=videos&subpage=addvideocategory&catid=<?php echo $catid; ?>&action=Edit" title="Edit"><span class="pencil"></span></a></td>
						<td align="center"><a class="action-button" href="index.php?page=videos&del_id=<?php echo $catid ?>" onClick="return del()" title="Delete"><span class="delete"></span></a></td>
                    </tr>
					<?php  }?>
                 </tbody>
            </table>
			</div>
        </div>
    </div>
	
    <div class="clear">&nbsp;</div>

</section>

<!-- End of Left column/section -->