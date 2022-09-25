<?php
// For escaping and trimming strings
function img_upload($pic1)
{
	$filename1 = $HTTP_POST_FILES['$pic1']['tmp_name'];
		$image_name1 = $HTTP_POST_FILES['$pic1']['name'];
		move_uploaded_file($filename1,"uploads/images/".$image_name1);		
		
		return trim($image_name1);
		
}
function img_upload2($pic2)
{
	$filename2 = $HTTP_POST_FILES['$pic2']['tmp_name'];
		$image_name2 = $HTTP_POST_FILES['$pic2']['name'];
		move_uploaded_file($filename2,"uploads/images/".$image_name2);		
		
		return trim($image_name2);
		
}
function img_upload3($pic3)
{
	$filename3 = $HTTP_POST_FILES['$pic3']['tmp_name'];
		$image_name23 = $HTTP_POST_FILES['$pic3']['name'];
		move_uploaded_file($filename3,"uploads/images/".$image_name3);		
		
		return trim($image_name3);
		
}

function checkuploadimage($image)
{
		$flag;
		switch ($image){
			case "image/gif" 	: $flag = TRUE;
						break;
			case "image/JPEG" 	: $flag = TRUE;
						break;
			case "image/jpeg" 	: $flag = TRUE;
						break;
			case "image/pjpg" 	: $flag = TRUE;
						break;
			case "image/png" 	: $flag = TRUE;
						break;	
			case "image/x-png" 	: $flag = TRUE;
						break;		
			case "image/img" 	: $flag = TRUE;
						break;
			case "image/pJPEG" 	: $flag = TRUE;
						break;
			case "image/pJPG" 	: $flag = TRUE;
						break;
			case "image/Pjpg" 	: $flag = TRUE;
						break;
			case "image/pjpeg" 	: $flag = TRUE;
						break;
			case "image/bmp" 	: $flag = TRUE;
						break;
			default: $flag = FALSE;
		}
		return $flag;
}
function upload_image($temp_name,$file_name)
{
 
	if(@move_uploaded_file($temp_name,$file_name)){ 
	return true;}
	else{
	return false;}
		
}
function checkuploadsound($audio)
{
		$flag;
		echo $audio;
		switch ($audio){
			case "audio/mpeg" 	: $flag = TRUE;
						break;
			case "audio/wav" 	: $flag = TRUE;
						break;
			case "audio/wma" 	: $flag = TRUE;
						break;
			default: $flag = FALSE;
		}
		return $flag;						
}	
function upload_sound($temp_name,$file_name)
{
	if(@move_uploaded_file($temp_name,$file_name)){
	return true;}
	else{
	return false;}
		
}	

function checkuploadvideo($video)
{
		$flag;
		//echo $video;
		switch ($video){
			case "video/mpg" 	: $flag = TRUE;
						break;
			case "video/MPG" 	: $flag = TRUE;
						break;
			case "video/mpeg" 	: $flag = TRUE;
						break;
			case "video/MPEG" 	: $flag = TRUE;
						break;
			case "video/avi" 	: $flag = TRUE;
						break;		
			case "video/AVI" 	: $flag = TRUE;
						break;
			case "video/3gp" 	: $flag = TRUE;
						break;
			case "video/3GP" 	: $flag = TRUE;
						break;
			case "video/mp4" 	: $flag = TRUE;
						break;
			case "video/MP4" 	: $flag = TRUE;
						break;
			case "video/wmv" 	: $flag = TRUE;
						break;
			case "video/WMV" 	: $flag = TRUE;
						break;
			case "video/wma" 	: $flag = TRUE;
						break;
			case "video/WMA" 	: $flag = TRUE;
						break;
			case "video/x-ms-wmv" 	: $flag = TRUE;
						break;
			case "application/x-flash-video" 	: $flag = TRUE;
			            break;	
		    case "video/x-msvideo" 	: $flag = TRUE; 
			            break;	
			 case "video/quicktime" 	: $flag = TRUE;	
			            break;			
			default: $flag = FALSE;
		}
		return $flag;
}
function upload_video($temp_name,$file_name)
{
	if(@move_uploaded_file($temp_name,$file_name)){
	return true;}
	else{
	return false;}
		
}
function resizeImage($srcFile, $dstWidth, $dstHeight, $dstFile = null, $jpegQuality = 80) 
{
    list($srcWidth, $srcHeight, $type) = getimagesize($srcFile); 
	switch ($type) { 
    case 1 : 
        $srcHandle = imagecreatefromgif($srcFile); 
        break; 
    case 2 : 
        $srcHandle = imagecreatefromjpeg($srcFile); 
        break; 
    case 3 : 
        $srcHandle = imagecreatefrompng($srcFile); 
        break; 
    default : 
        echo 'File Type Not Supported! '; 
        return false; 
    } 
    if (!$srcHandle) { 
        echo 'Could not execute imagecreatefrom() function! '; 
        return false; 
    } 
    // Source is wider than the Destination 
    if ($srcWidth / $srcHeight >= $dstWidth / $dstHeight) { 
        $width = $dstWidth; 
        $xOffset = 0; 
        $height = round(($width / $srcWidth) * $srcHeight); 
        $yOffset = round(($dstHeight - $height) / 2); 
    } 
    // Source is narrower than the Destination 
    else
	{ 
        $height = $dstHeight; 
        $yOffset = 0; 
        $width = round(($height / $srcHeight) * $srcWidth); 
        $xOffset = round(($dstWidth - $width) / 2); 
    } 
    $dstHandle = imagecreatetruecolor($width, $height); 
 	imagefill( $dstHandle, 0, 0, imagecolorallocate( $dstHandle, 255, 255, 255 ) ) or die('imagecolorallocate() white');
    //imagefill( $dstHandle, 0, 0, imagecolorallocate( $dstHandle, 187, 187, 187 ) ) or die('imagecolorallocate() white');
    if (!imagecopyresampled($dstHandle, $srcHandle, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight)) { 
        echo 'Could not execute imagecopyresampled() function! '; 
        return false; 
    } 
    imagedestroy($srcHandle); 
    switch ($type) { 
    case 1 : 
        imagegif($dstHandle, $dstFile); 
        break; 
    case 2 : 
        imagejpeg($dstHandle, $dstFile, $jpegQuality); 
        break; 
    case 3 : 
        imagepng($dstHandle, $dstFile); 
        break; 
    default : 
        echo 'File Type Not Supported! '; 
        return false; 
    } 
    imagedestroy($dstHandle); 
    return true; 
}
?>