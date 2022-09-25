<?php
ini_set("display_errors","0");

$db=new Database();
require("includes/classes/class.Util.php");
$util=new Util();
$error_Msg = array();
$maxrows=$_REQUEST["maxrows"];
$keywords=$_REQUEST["keywords"];
		
if($_REQUEST["action"]=="Edit")
{
	$id1= base64_decode($_REQUEST['flashId']);	
	$sql_flash="select * from  flashgallery where flashId=$id1";
	$result_flash= $db->select($sql_flash);
	foreach($result_flash as $key=>$data)
	{	
		$title		=	stripslashes($data["imgDesc"]);		
		$url		=	stripslashes($data["linkDest"]);
		$path		=	stripslashes($data["path"]);		
		$status		=	$data["status"];
	}
}
if( $_REQUEST["Update"] )
{
	$maxrows	=	$_REQUEST["maxrows"];
	$keywords	=	$_REQUEST["keywords"];	
	
	//---------------stored posted data to the corresponding variable-----------------------
	$flashId			=	base64_decode($_REQUEST['flashId']);
	$title				=	$_REQUEST['title'];
	$url				=	$_REQUEST['url'];
	$status				=	$_REQUEST['status'];
	//validation------------------------------	
	if(trim($title) == "")
		$error_Msg[] = "Title required";	
	if($url!="")
	{
		$flag=$util->isValidUrl($url);
		if(!$flag)
		{	
			$error_Msg[] = "Enter Valid url";		
		}
	}
}
if($_REQUEST["Submit"])
{
	$maxrows	=	$_REQUEST["maxrows"];
	$keywords	=	$_REQUEST["keywords"];	
	
	//---------------stored posted data to the corresponding variable-----------------------
	$flashId			=	base64_decode($_REQUEST['flashId']);
	$title				=	$_REQUEST['title'];
	$url				=	$_REQUEST['url'];
	$status				=	$_REQUEST['status'];
	$flash				=	$_FILES['flash']['name'];			
	$crDate				=	date("Y-m-d");
	//validation------------------------------	
	if(trim($title) == "")
		$error_Msg[] = "Title required";	
	if($url!="")
	{
		$flag=$util->isValidUrl($url);
		if(!$flag)
		{	
			$error_Msg[] = "Enter Valid url";		
		}
	}
	if(trim($flash) == "")
		$error_Msg[] = "Image required";	
	
	$foto  = $_FILES['flash']['name'];					
	$type  = $_FILES['flash']['type'];
	$temp  = $_FILES['flash']['tmp_name'];
	
	 $select_total=$db->select("select * from flashgallery ORDER BY flashId DESC LIMIT 1");
	 foreach($select_total as $key=>$res)
	 {
		$id=$res['flashId'];
	 }
	
	$num=$id;
	$path  = "images/flashimages/";	
	$extension = substr($foto,strrpos($foto,"."));
	$img=(int)$num+1;
	$filename  = $path.$img.$extension;							
	if(checkuploadimage($type))
	{
		if(upload_image($temp,$filename))
		{
			$pth       = $path.'thumb_'.$img.$extension; // after resize
			list($width, $height, $type, $attr) = getimagesize($filename);
			resizeImage($filename,$width,$height,$pth,'100');				
			$arFieldsValues['image']	=	$img.$extension;
			unlink($filename);					
		}
		else
		{
			$error_Msg[] ="Image file is not uploaded";
		}
	}
	else{
		$error_Msg[] ="Invalid image file in image";
	}
}
if(count($error_Msg)==0)
{
	$arFieldsValues=array();
	$arFieldsValues['imgDesc']	=	clean_data($title);
	$arFieldsValues['linkDest']	=	clean_data($url);
	$arFieldsValues['status']	=	clean_data($status);		
	
	if($_REQUEST["Update"])
	{		
		$result=$db->update('flashgallery',$arFieldsValues,'flashId='.$flashId);
		header("Location:flash.php?action=update&maxrows=$maxrows&keywords=$keywords");
		exit;
	}
	if($_REQUEST["Submit"])
	{
		$arFieldsValues['path']		=	$img.$extension;
		$arFieldsValues['crDate']	=	$crDate;
		$result=$db->insert('flashgallery',$arFieldsValues);	
		header("Location: flash.php?action=insert&maxrows=$maxrows&keywords=$keywords");
		exit;
	}

}
?> 

<!-- Left column/section -->

<section class="grid_6 first">

    <div class="columns">
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
			  <input name="flashId" type="hidden" id="flashId" value="<?php echo base64_encode($id1);?>">
			  <input name="maxrows" type="hidden" id="maxrows" value="<?php echo $maxrows; ?>">
			  <input name="keywords" type="hidden" id="keywords" value="<?php echo $keywords; ?>">
			  <input name="display" type="hidden" id="display" value="<?php echo $display; ?>">
			  <input name="search" type="hidden" id="search" value="<?php echo $search; ?>">
                <fieldset>
                    <div class="clearfix">
                        <label>Title <font color="red">*</font></label><textarea name="title" cols="41" rows="3" id="title"><?php echo $title; ?></textarea>
                    </div>
                    <div class="clearfix">
                        <label>Url Link <font color="red">*</font></label><input type="text" name="url" value="<?php echo $url; ?>">
                    </div>
                    <div class="clearfix">
                        <label>Image <font color="red">*</font></label>
						<?php
						if($_REQUEST['action']!='Edit')
						{
						?>
						<input type="file" name="flash" >&nbsp;
						<span><font color="red">Image Dimension is 322 X 369</font></span>
						<?php }?>
                    </div>
                    <div class="clearfix">
                        <label>Status</label>
						<?php if($status==''){ $status=1;}?> 
						<span class="radio-input"> <input name="status" type="radio" value="1" <?php if($status==1){ echo "Checked"; } ?>>Active</span> 
						<span class="radio-input"><input type="radio" name="status" value="0" <?php if($status==0){ echo "Checked"; } ?>>Not Active</span>
                    </div>
                </fieldset>
                <hr />
				<?php if($_GET["action"]=='Edit') { ?>
                          <input class="button button-green" type="submit" name="Update" value="Update">
                          <?php } else {?>
                          <input class="button button-green" type="submit" name="Submit" value="Submit">
                          <?php } ?> &nbsp;
                <button class="button button-gray" type="reset">Reset</button>
            </form>
        </div>
    </div>

    <div class="clear">&nbsp;</div>

</section>

<!-- End of Left column/section -->