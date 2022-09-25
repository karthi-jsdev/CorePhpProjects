<?php
function fn_resize_image($srcFile, $dstWidth, $dstHeight, $dstFile = null, $jpegQuality = 80) {
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

function mailer($to,$subject,$message,$rplyto) {

	if (!class_exists("phpmailer")) {
		require_once("classes/class.phpmailer.php");
	}

	$mail = new PHPMailer();

	$toaddress		= $to;
	$mailhost 		= "ssl://smtp.gmail.com";
	$fromaddress 	= "alumni@christuniversity.in";
	$frompwd 		= "IND@banCU09"; 
	$fromname		= "iAlert Admin";

	$mail->IsSMTP();
	$mail->Mailer = "smtp";
	$mail->Port = 465;
	$mail->Host = $mailhost;
	$mail->SMTPAuth = true;
	$mail->Username = $fromaddress;
	$mail->Password = $frompwd;
	 
	$mail->From = $fromaddress;
	$mail->FromName = $fromname;
	$mail->AddReplyTo($rplyto);
	$mail->WordWrap = 50;
	$mail->AddAddress($toaddress);
	$mail->IsHTML(true);
	$mail->Subject = $subject;
	$mail->Body = $message;
	if(!$mail->Send()) {
		return(0);
	} else {
		return(0);
	}
}
