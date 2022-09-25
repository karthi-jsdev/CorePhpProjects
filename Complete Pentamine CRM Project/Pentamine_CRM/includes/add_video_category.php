<?php
ini_set("display_errors","0");
include("chk.php") ;
$catid=intval(base64_decode($_GET['catid']));
$action=$_GET['action'];

if($_REQUEST['action']=='Edit')
{
	$chrsql="SELECT * FROM video_category WHERE clientId='".$_SESSION['clientId']."' AND categoryId=$catid";
	$rescat=$db->select($chrsql);
	$txtcategory=$rescat[0]['categoryName'];
	$status=$rescat[0]['status'];
}
if($_REQUEST["Submit"]  || $_REQUEST["Update"] )
{
     $flag=1;
     $msg='';
     $txtcategory  =  trim($_POST['txtcategory']);
     $status=$_POST['status'];
     if($txtcategory  ==  '')
     {	
     	$msg	=	"Enter Category Name";
		$flag=0;
     }
}
if($flag==1)
{	
	if($_REQUEST['Submit']) 
	{	
     	//$chrSQL="insert into video_category(categoryName) values('$txtcategory') ";
		$chrSQL="insert into video_category(clientId,categoryName) values('".$_SESSION['clientId']."','$txtcategory') ";
	 	$query=mysql_query($chrSQL) or die('Invalid Data Insersion');
	 	header("location:index.php?page=videos&action=insert&maxrows=$maxrows&display=$display&keywords=$keywords");
	
   	}
	if($_REQUEST['Update'])
   	{ 
     	$catid=$_POST['catid'];
     	$chrSQL="UPDATE video_category SET categoryName='$txtcategory', status='$status' WHERE clientId='".$_SESSION['clientId']."' AND categoryId=$catid";     
	 	$query=mysql_query($chrSQL) or die('Invalid Data Insersion');
	 	header("location:index.php?page=videos&action=update&maxrows=$maxrows&display=$display&keywords=$keywords&search=$search");
	}   
}  
   
?>

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
    <div class="columns">
        <div class="grid_6 first">
        	<form id="form" class="form panel" action="" method="post"  name="form" enctype="multipart/form-data">
                <header><h2>Fields marked <font color="red">*</font> are Mandatory </h2></header>
                <hr />
				<?php if($msg!=''){?>
				<?php echo "<div class='message error'>".$msg."</div>";?>
				<?php } ?>
                <fieldset>
                    <div class="clearfix">
						 <input type="hidden" name="catid" value="<?php echo $catid;?>" />
                        <label>Add Category <font color="red">*</font></label><input name="txtcategory" type="text" class="frmborder" id="txtcategory" value="<?php echo $txtcategory;?> " size="30" />
                    </div>
                    <div class="clearfix">
                        <label> Status </label>
						<?php if($status==""){$status=1;}?>
						<span class="radio-input"><input type="radio" name="status" value="1" <?php if($status==1){ echo "Checked"; } ?>/>Active&nbsp;&nbsp;&nbsp;</span> 
						<span class="radio-input"><input type="radio" name="status" value="0" <?php if($status==0){ echo "Checked"; } ?>/>Deactive</span>
                    </div>
                </fieldset>
                <hr />
				<?php if($_GET[action]=='Edit') { ?>				
				<input class="button button-green" type="submit" name="Update" value="Update">
				<?php } else {?>
				<input class="button button-green" type="submit" name="Submit" value="Submit">
				<?php } ?>
				&nbsp;&nbsp;&nbsp;
                <button class="button button-gray" type="reset">Reset</button>
            </form>
        </div>
    </div>

    <div class="clear">&nbsp;</div>

</section>

<!-- End of Left column/section -->

