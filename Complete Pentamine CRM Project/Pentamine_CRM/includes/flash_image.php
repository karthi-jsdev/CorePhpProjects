<?php
ini_set("display_errors","0");
include("chk.php");
$db=new Database();
require("classes/class.Util.php");
$util=new Util();
		
$id1=base64_decode($_REQUEST['flashId']);

$sql_flash="select * from  flashgallery where flashId=$id1";	
$result_flash= $db->select($sql_flash);
foreach($result_flash as $key=>$data)
{	
	$title		=	stripslashes($data["desc"]);		
	$url		=	stripslashes($data["linkDest"]);
	$path		=	stripslashes($data["path"]);		
	$status		=	$data["status"];
}
	
if($_REQUEST["Submit"])
{  	
	//---------------stored posted data to the corresponding variable-----------------------
	$flashId			=	base64_decode($_REQUEST['flashId']);
	$flash				=	$_FILES['flash']['name'];	
	if(trim($flash) == "")
		$error_Msg[] = "Image required";	
		
	//validation------------------------------		
	if(count($error_Msg)==0)
	{		
		$foto  = $_FILES['flash']['name'];					
		$type  = $_FILES['flash']['type'];
		$temp  = $_FILES['flash']['tmp_name'];		
		$num=$id1;
		$path  = "images/flashimages/";	
		$extension = substr($foto,strrpos($foto,"."));
		$img=(int)$num;
		$imgpathname=$img.$extension; 	
		$filename  = $path.$img.$extension;							
		if(checkuploadimage($type))
		{
			if(upload_image($temp,$filename))
			{
				$pth       = $path.'thumb_'.$img.$extension; // after resize
				list($width, $height, $type, $attr) = getimagesize($filename);
				resizeImage($filename,$width,$height,$pth,'100');
				unlink($filename);	
		   		$sqlquery = "update flashgallery set  path='$imgpathname' where flashId='$flashId'";
		 		mysql_query($sqlquery);
			 	$flashId=base64_encode($id1);
				header("location:index.php?page=flash&flashId=$flashId");
				exit;				
			}
			else
			{
				$error_Msg[] ="Image file is not uploaded";
			}
		}
		else
		{
			$error_Msg[] ="Invalid image file in image";
		}
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
</script>
<script>
	function loadVideo(val){
		if(val=='0'){
			if (document.getElementById('bfile').style.display=="none") document.getElementById('bfile').style.display="block";
			if (document.getElementById('ufile').style.display=="block") document.getElementById('ufile').style.display="none";
		}
		if(val=='1'){
			if (document.getElementById('bfile').style.display=="block") document.getElementById('bfile').style.display="none";
			if (document.getElementById('ufile').style.display=="none") document.getElementById('ufile').style.display="block";
		}
	}
</script>
<section class="grid_6 first">

    <div class="columns">
		<center>
        <div class="grid_6 first">
        	<form id="form" class="form panel" action="" method="post"  name="form" enctype="multipart/form-data">
                <header><h2>Fields marked <font color="red">*</font> are Mandatory</h2></header>
                <hr />
                 <?php
			if(count($error_Msg)!=0)
			{
				$alert=message_box($error_Msg);
				print $alert;
			}
		?>
                <fieldset>
                    <div class="clearfix">
						<input name="flashid" type="hidden" id="flashId" value="<?php echo base64_encode($id1); ?>" />
                        <img src="images/flashimages/thumb_<?=$path?>" height="300px" width="450px"/>
                    </div>
                    <div class="clearfix">
                        <label>To Change Image <br /> <font color="red">Image Dimension is 322 X 369</font></label><input type="file" name="flash" >
                    </div>
                   
                </fieldset>
                <hr />
                <button class="button button-green" type="submit" name="Submit" value="Submit">Submit</button>&nbsp;
                <button class="button button-gray" href="flash.php" type="reset">Reset</button>&nbsp;
				<a href="flash.php"  class="links">Return to List</a>
            </form>
        </div>
    </div>
	</center>
    <div class="clear">&nbsp;</div>

</section>

<!-- End of Left column/section -->

