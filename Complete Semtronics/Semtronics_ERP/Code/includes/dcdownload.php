<?php
	/** Error reporting */
	error_reporting(E_ALL);
	ini_set("display_errors","0");
	include("Config.php");
	set_time_limit(100);
	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
	
	/** Include PHPExcel */
	require_once('PHPExcel_1.8.0_doc/Classes/PHPExcel.php');
	require_once('PHPExcel_1.8.0_doc/Classes/PHPExcel/IOFactory.php');
	
	// Create new PHPExcel object
	echo date('H:i:s') , " Create new PHPExcel object" , EOL;
	$objPHPExcel = new PHPExcel();
	$styleArray = array(
	'borders' => array(
	'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_THIN,
		'color' => array('argb' => '000000'),
	),),);
	$TableHeaderStyle = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 10,
        'name'  => 'Verdana'
    ));
	
	$TableNoData = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'FF0000'),
        'size'  => 10,
        'name'  => 'Verdana'
    ),
	'alignment' => array(
		'wrap'       => true,
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
	));
	
	// Set document properties
	echo date('H:i:s') , " Set document properties" , EOL;
	$objPHPExcel->getProperties()->setCreator("Pentamine Technologies Pvt. Ltd.")
	->setLastModifiedBy("Pentamine Technologies Pvt. Ltd.")
	->setTitle("DELIVERY CHALLAN")
	->setSubject("Delivery Challan")
	->setDescription("Delivery Challan of the Semtronics ERP")
	->setKeywords("Pentamine Semtronics ERP")
	->setCategory("Reports");
	$Sheet = -1;
	if($_GET['number'])
	{
		$Sheet++;
		$objPHPExcel->createSheet($Sheet);
		$objPHPExcel->getSheet($Sheet)->setTitle('Delivery Challan');
		// Add some data
		echo date('H:i:s') , " Add some data" , EOL;
		$objPHPExcel->setActiveSheetIndex($Sheet)
		//FROM & TO ADDRESS
		->setCellValue('A6', "M/s. SEMTRONICS MICROSYSTEMS PVT LTD\nNO.39/3B,2ND FLOOR,KANAKAPURA MAIN ROAD\nOPPOSITE JBS NURSING HOME, BANASHANKARI\nBANGALORE -- 560 070\nPHONE NO: 080-26715997\nE-mail ID: info@semtronicsMicrosystems.com\nECC NO: AAPCS0701GEM001\nRANGE: KANAKAPURA II\nDIVISION: KANAKAPURA \nVAT No.: 29770605984")
		->setCellValue('A18',$_GET['toaddress'])
		
		//BUYER AND SELLER DETAILS
		->setCellValue('C6', 'DCNo.')
		->setCellValue('C7', $_GET['dcno'])
		->setCellValue('E6', 'Dated')
		->setCellValue('E7', $_GET['dated'])
		->setCellValue('C9', 'Supplier Ref.')
		->setCellValue('C10', $_GET['sref'])
		->setCellValue('E9', "Other's Ref.")
		->setCellValue('E10', $_GET['oref'])
		->setCellValue('C12', "Buyer's Order No.")
		->setCellValue('C13', $_GET['bno'])
		->setCellValue('E12', 'Dated')
		->setCellValue('E13', $_GET['bdated'])
		
		//DELIVERY DETAILS
		->setCellValue('C15', "ANNEXURE II")
		->setCellValue('E15', "ESugam No.")
		->setCellValue('E16', $_GET['esno'])
		->setCellValue('C18', "Despatch Through")
		->setCellValue('C19', $_GET['despatch'])
		->setCellValue('E18', "Destination")
		->setCellValue('E19', $_GET['destination'])
		->setCellValue('C21', "Terms of delivery")
		->setCellValue('D21', $_GET['tod'])
		
		//PRODUCT DETAILS
		->setCellValue('A26', 'S.No.')
		->setCellValue('B26', 'Description of Goods')
		->setCellValue('C26', 'Quantity')
		->setCellValue('D26', 'Price')
		->setCellValue('E26', 'Remarks')->getStyle('A26:E26')->applyFromArray($TableHeaderStyle);
 
		$i=0;
		$Vendors = mysqli_query($_SESSION['connection'],"SELECT stockinventory.unitprice,location.name,issuance.number, rawmaterial.id, rawmaterial.materialcode, rawmaterial.partnumber, rawmaterial.description, stockissuance.quantity, issuanceuser.issuanceuser as issuanceuser, issuance.issueddate FROM stockissuance JOIN batch ON batch.id=stockissuance.batchid JOIN rawmaterial ON rawmaterial.id=batch.rawmaterialid JOIN issuanceuser ON issuanceuser.id=stockissuance.issuedto JOIN issuance ON issuance.id=stockissuance.issuanceid JOIN stockinventory on batch.id=stockinventory.batchid join location on location.id=locationid WHERE issuance.number='".$_GET['number']."' ORDER BY stockissuance.id");
		SetHeader($Sheet, "DELIVERY CHALLAN");
		while($VendorData = mysqli_fetch_assoc($Vendors))
		{
			$objPHPExcel->setActiveSheetIndex($Sheet)
			->setCellValue('A'.(26+(++$i)), $i)
			->setCellValue('B'.(26+$i), $VendorData['description'])
			->setCellValue('C'.(26+$i), $VendorData['quantity'])
			->setCellValue('D'.(26+$i), $VendorData['quantity'] * $VendorData['unitprice'])
			->setCellValue('E'.(27), 'Not for sale');
			$j=$i;
		}
		// Add some data
		//echo date('H:i:s') , " Add some data" , EOL;
		$objPHPExcel->setActiveSheetIndex($Sheet)
		->setCellValue('A'.($i+29), "Company's VAT TIN")
		->setCellValue('B'.($i+29), "29770605984")
		->setCellValue('A'.($i+30), "Company's CST No.")
		->setCellValue('B'.($i+30), "29770605984")
		->setCellValue('A'.($i+31), "Company's PAN")
		->setCellValue('B'.($i+31), "AAPCS0701G")
		
		->setCellValue('C'.($i+29), "for Semtronics Micro Systems Pvt.Ltd\nAUTHORISED SIGNATORY");
		
		$objPHPExcel->setActiveSheetIndex($Sheet)->getStyle('A26:E'.(27+$i))->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet($Sheet)->mergeCells('A6:B16')->getStyle('A6:B16')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet($Sheet)->mergeCells('A18:B24')->getStyle('A18:B24')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet($Sheet)->mergeCells('D21:E22')->getStyle('D21:E22')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet($Sheet)->getStyle('C6:E19')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet($Sheet)->mergeCells('C'.($i+29).':E'.($i+30))->getStyle('C'.($i+29).':E'.($i+30))->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet($Sheet)->getStyle('B'.($i+29).':B'.($i+30))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setWrapText(true);				
		//Streatch column width based on the content
		for($col = 'A'; $col !== 'L'; $col++)
			$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
	}
	// Sheet Header------------------------------------------------------------------------------
	function SetHeader($SheetIndex, $Title)
	{
		global $objPHPExcel;
		$objPHPExcel->setActiveSheetIndex($SheetIndex)->mergeCells('A1:G2');
		$objPHPExcel->setActiveSheetIndex($SheetIndex)->mergeCells('A3:G4')->getStyle('A3:G4')->getFont()->setSize(16)->setBold(true);
		$objPHPExcel->setActiveSheetIndex($SheetIndex)->mergeCells('A3:G4')->getStyle('A3:G4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setWrapText(true);
		$objPHPExcel->setActiveSheetIndex($SheetIndex)->setCellValue('A3', $Title);
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('Logo');
		$objDrawing->setDescription('Logo');
		$objDrawing->setPath('../images/logo.jpg');
		$objDrawing->setHeight(36);
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
	}
	
	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);
	// Save Excel 2007 file
	$callStartTime = microtime(true);
	
	//FOR PRINITNG DATA INTO LANDSCAPE MODE
	$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
	$objWriter->save("Delivery Challan.xlsx");
	//$objWriter->save('php://output');
	$callEndTime = microtime(true);
	$callTime = $callEndTime - $callStartTime;

	echo date('H:i:s') , " Write to Excel2007 format" , EOL;
	echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
	echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
	// Echo memory usage
	echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;

	// Echo memory peak usage
	echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

	// Echo done
	echo date('H:i:s') , " Done writing files" , EOL;
	echo 'File has been created in ' , getcwd() , EOL;

	//header("Location: Delivery Challan.xlsx");
?>
<script>
	window.location.href= 'Delivery Challan.xlsx';
</script>