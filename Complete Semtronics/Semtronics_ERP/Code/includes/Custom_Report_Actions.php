<?php
	/** Error reporting */
	error_reporting(E_ALL);
	ini_set("display_errors","0");
	//date_default_timezone_set('Asia/Kolkata');
	//ini_set('display_startup_errors', FALSE);

	$_GET['Modules'] = (isset($_GET['Module']) && $_GET['Module']) ? array($_GET['Module']) : array("Vendor", "Invoice", "Stock_Status", "Inspection", "Issuance", "Product", "Product_BOM", "Saved_Kitting", $_GET['Module'] = "Custom_Report");
	
	include("Custom_Reports_Queries.php");
	include("Config.php");
	set_time_limit(100);
	
	if($_GET['startdate'])
	{
		$_GET['startdate'] = date("Y-m-d", strtotime($_GET['startdate']));
		$Sdate = date("d-m-Y", strtotime($_GET['startdate']));
	}
	else
		$_GET['startdate'] = $Sdate = "";
		
	if($_GET['enddate'])
	{
		$_GET['enddate'] = date("Y-m-d 23:59:59", strtotime($_GET['enddate']));
		$Edate = date("d-m-Y", strtotime($_GET['enddate']));
	}
	else
		$_GET['enddate'] = $Edate = "";
		
	if(!isset($_GET['vendor_id']))
		$_GET['vendor_id'] = "";
	if(!isset($_GET['vendor_category_id']))
		$_GET['vendor_category_id'] = "";
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
	->setTitle("Custom Report")
	->setSubject("Custom Report")
	->setDescription("Custom report of the Semtronics ERP")
	->setKeywords("Pentamine Semtronics ERP")
	->setCategory("Reports");
	$Sheet = -1;

	// Vendor------------------------------------------------------------------------------
	if(in_array("Vendor", $_GET['Modules']))
	{
		$Sheet++;
		$objPHPExcel->createSheet($Sheet);
		$objPHPExcel->getSheet($Sheet)->setTitle('Vendor');
		// Add some data
		echo date('H:i:s') , " Add some data" , EOL;
		$objPHPExcel->setActiveSheetIndex($Sheet)
		->setCellValue('A6', 'S.No.')
		->setCellValue('B6', 'Vendor Id')
		->setCellValue('C6', 'Vendor Name')
		->setCellValue('D6', 'Category')
		->setCellValue('E6', 'Address')
		->setCellValue('F6', 'Phone No.')
		->setCellValue('G6', 'E-Mail Id')
		->setCellValue('H6', 'Cont. Person')
		->setCellValue('I6', 'Credit Limit')
		->setCellValue('J6', 'Credit Period')
		->setCellValue('K6', 'Lead Time')->getStyle('A6:K6')->applyFromArray($TableHeaderStyle);
		$i=0;
		$Vendors = Select_Vendors();
		SetHeader($Sheet, "Vendor Report ", "Total Vendors : ".mysqli_num_rows($Vendors));
		while($VendorData = mysqli_fetch_assoc($Vendors))
		{
			$VendorCategories = "";
			$CreditIdExplode = explode('.',$VendorData['categoryid']);
			$k = count($CreditIdExplode);
			foreach($CreditIdExplode as $CreditId)	
			{
				$k -= 1;
				$FetchCreditId = mysqli_fetch_array(Select_VendorCategory_ById($CreditId));
				$VendorCategories .= $FetchCreditId['name'];
				if($k)
					$VendorCategories .= $VendorCategories.',';
			}
			$objPHPExcel->setActiveSheetIndex($Sheet)
			->setCellValue('A'.(6+(++$i)), $i)
			->setCellValue('B'.(6+$i), $VendorData['vendorid'])
			->setCellValue('C'.(6+$i), $VendorData['name'])
			->setCellValue('D'.(6+$i), $VendorCategories)
			->setCellValue('E'.(6+$i), $VendorData['address'])
			->setCellValue('F'.(6+$i), $VendorData['phonenumber'])
			->setCellValue('G'.(6+$i), $VendorData['email'])
			->setCellValue('H'.(6+$i), $VendorData['contactperson'])
			->setCellValue('I'.(6+$i), $VendorData['creditlimit'])
			->setCellValue('J'.(6+$i), $VendorData['period'])
			->setCellValue('K'.(6+$i), $VendorData['leadtime']);
		}
		if(!$i)
			$objPHPExcel->setActiveSheetIndex($Sheet)->setCellValue('A7', "No Data Found!")->mergeCells('A7:K7')->getStyle('A7:K7')->applyFromArray($TableNoData);
		$objPHPExcel->setActiveSheetIndex($Sheet)->getStyle('A6:K'.(7+$i))->applyFromArray($styleArray);
		
		//Streatch column width based on the content
		for($col = 'A'; $col !== 'L'; $col++)
			$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
	}
	
	// Invoices------------------------------------------------------------------------------
	if(in_array("Invoice", $_GET['Modules']))
	{
		$Sheet++;
		$objPHPExcel->getSheet($Sheet)->setTitle('Invoices');
		$objPHPExcel->setActiveSheetIndex($Sheet)
		->setCellValue('A6', 'S.No.')
		->setCellValue('B6', 'Invoice Number')
		->setCellValue('C6', 'Vendor')
		->setCellValue('D6', 'Invoice Date')
		->setCellValue('E6', 'Amount')
		->setCellValue('F6', 'Tax Amount')
		->setCellValue('G6', 'Total Amount')->getStyle('A6:G6')->applyFromArray($TableHeaderStyle);

		$i=0;
		$Invoices = Select_Invoices();
		SetHeader($Sheet, "Invoice Report ".date("d-M-Y", strtotime($_GET['startdate']))." : ".date("d-M-Y", strtotime($_GET['enddate'])), "Total Invoices : ".mysqli_num_rows($Invoices));
		while($InvoiceData = mysqli_fetch_assoc($Invoices))
		{
			$objPHPExcel->setActiveSheetIndex($Sheet)
			->setCellValue('A'.(6+(++$i)), $i)
			->setCellValue('B'.(6+$i), $InvoiceData['number'])
			->setCellValue('C'.(6+$i), $InvoiceData['name'])
			->setCellValue('D'.(6+$i), date('d-m-Y',strtotime($InvoiceData['invoicedate'])))
			->setCellValue('E'.(6+$i), $InvoiceData['sum(amount)'])
			->setCellValue('F'.(6+$i), round($InvoiceData['sum(taxamount)'],2))
			->setCellValue('G'.(6+$i), round($InvoiceData['sum(amount)']+$InvoiceData['sum(taxamount)'],2));
		}
		if(!$i)
			$objPHPExcel->setActiveSheetIndex($Sheet)->setCellValue('A7', "No Data Found!")->mergeCells('A7:G7')->getStyle('A7:G7')->applyFromArray($TableNoData);
		$objPHPExcel->setActiveSheetIndex($Sheet)->getStyle('A6:G'.(7+$i))->applyFromArray($styleArray);
		
		//Streatch column width based on the content
		for($col = 'A'; $col !== 'H'; $col++)
			$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
	}
	
	// Stock_Status------------------------------------------------------------------------------
	if(in_array("Stock_Status", $_GET['Modules']))
	{
		echo "Stock_Status";
		$Sheet++;
		$objPHPExcel->createSheet($Sheet);
		$objPHPExcel->getSheet($Sheet)->setTitle('Stock Status');
		$objPHPExcel->setActiveSheetIndex($Sheet)
		->setCellValue('A6', 'S.No.')
		->setCellValue('B6', 'Raw Material code')
		->setCellValue('C6', 'Stock Quantity')
		->setCellValue('D6', 'Unit Price')
		->setCellValue('E6', 'Amount')
		->setCellValue('F6', 'Description')
		->setCellValue('G6', 'Part Number')
		->setCellValue('H6', 'Category Name')
		->setCellValue('I6', 'Location')->getStyle('A6:I6')->applyFromArray($TableHeaderStyle);

		$i=0;
		$AllStock_Status = Select_Stock_Status_By_Limit();
		$Stock_location = Select_Stock_Location();
		$Stock_quantity = mysqli_fetch_assoc($AllStock_Status);
		$inspection1 = Select_Stock_Status_Inspection1($Stock_quantity);
		$inspection = Select_Stock_Status_Inspection($Stock_quantity);
		$AllStock_Status = Select_Stock_Status();
		SetHeader($Sheet, "Stock Status Report ", "Total Number of Stocks : ".mysqli_num_rows($AllStock_Status));
		while($Stock_Status = mysqli_fetch_assoc($AllStock_Status))
		{
			$objPHPExcel->setActiveSheetIndex($Sheet)
			->setCellValue('A'.(6+(++$i)), $i)
			->setCellValue('B'.(6+$i), $Stock_Status['materialcode'])
			->setCellValue('C'.(6+$i), ($Stock_Status['quantity']-$inspection1['quantity']-$inspection['quantity']))
			->setCellValue('D'.(6+$i), $Stock_Status['unitprice'])
			->setCellValue('E'.(6+$i), round($Stock_Status['amount']-$inspection['amount']-$inspection1['amount'],2))
			->setCellValue('F'.(6+$i), $Stock_Status['description'])
			->setCellValue('G'.(6+$i), $Stock_Status['partnumber'])
			->setCellValue('H'.(6+$i), $Stock_Status['name'])
			->setCellValue('I'.(6+$i), $Stock_location['locationname']);
		}
		if(!$i)
			$objPHPExcel->setActiveSheetIndex($Sheet)->setCellValue('A7', "No Data Found!")->mergeCells('A7:I7')->getStyle('A7:I7')->applyFromArray($TableNoData);
		$objPHPExcel->setActiveSheetIndex($Sheet)->getStyle('A6:I'.(7+$i))->applyFromArray($styleArray);
		
		//Stretch column width based on the content
		for($col = 'A'; $col !== 'I'; $col++)
			$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
	}
	
	// Inspection------------------------------------------------------------------------------
	if(in_array("Inspection", $_GET['Modules']))
	{
		$Sheet++;
		$objPHPExcel->createSheet($Sheet);
		$objPHPExcel->getSheet($Sheet)->setTitle('Inspections');
		// Add some data
		echo date('H:i:s') , " Add some data" , EOL;
		$objPHPExcel->setActiveSheetIndex($Sheet)
		->setCellValue('A6', 'S.No.')
		->setCellValue('B6', 'Invoice Number')
		->setCellValue('C6', 'Rawmaterial Code')
		->setCellValue('D6', 'Vendor')
		->setCellValue('E6', 'Quantity')->getStyle('A6:E6')->applyFromArray($TableHeaderStyle);
		$i=0;
		$Inspections = Select_Inspections();
		SetHeader($Sheet, "Inspection Report ", "Total Inspections : ".mysqli_num_rows($Inspections));
		while($InspectionData = mysqli_fetch_assoc($Inspections))
		{
			$objPHPExcel->setActiveSheetIndex($Sheet)
			->setCellValue('A'.(6+(++$i)), $i)
			->setCellValue('B'.(6+$i), $InspectionData['number'])
			->setCellValue('C'.(6+$i), $InspectionData['materialcode'])
			->setCellValue('D'.(6+$i), $InspectionData['name'])
			->setCellValue('E'.(6+$i), $InspectionData['sum(quantity)']);
		}
		if(!$i)
			$objPHPExcel->setActiveSheetIndex($Sheet)->setCellValue('A7', "No Data Found!")->mergeCells('A7:E7')->getStyle('A7:E7')->applyFromArray($TableNoData);
		$objPHPExcel->setActiveSheetIndex($Sheet)->getStyle('A6:E'.(7+$i))->applyFromArray($styleArray);
		
		//Streatch column width based on the content
		for($col = 'A'; $col !== 'F'; $col++)
			$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
	}
	
	// Issuances------------------------------------------------------------------------------
	if(in_array("Issuance", $_GET['Modules']))
	{
		$Sheet++;
		$objPHPExcel->createSheet($Sheet);
		$objPHPExcel->getSheet($Sheet)->setTitle('Issuances');
		// Add some data
		echo date('H:i:s') , " Add some data" , EOL;
		$objPHPExcel->setActiveSheetIndex($Sheet)
		->setCellValue('A6', 'S.No.')
		->setCellValue('B6', 'Issuance Code')
		->setCellValue('C6', 'Issued To')
		->setCellValue('D6', 'Total Raw Materials')
		->setCellValue('E6', 'Date and Time')
		->setCellValue('F6', 'Issuance Date')->getStyle('A6:F6')->applyFromArray($TableHeaderStyle);
		$i=0;
		$Issuances = Select_Issuances();
		SetHeader($Sheet, "Issuance Report ".$Sdate." : ".$Edate, "Total Issuances : ".mysqli_num_rows($Issuances));
		while($IssuanceData = mysqli_fetch_assoc($Issuances))
		{
			$objPHPExcel->setActiveSheetIndex($Sheet)
			->setCellValue('A'.(6+(++$i)), $i)
			->setCellValue('B'.(6+$i), $IssuanceData['number'])
			->setCellValue('C'.(6+$i), $IssuanceData['issuanceuser'])
			->setCellValue('D'.(6+$i), $IssuanceData['total'])
			->setCellValue('E'.(6+$i), substr($IssuanceData['issueddate'],0,16))
			->setCellValue('F'.(6+$i), $IssuanceData['issuancedate']);
		}
		if(!$i)
			$objPHPExcel->setActiveSheetIndex($Sheet)->setCellValue('A7', "No Data Found!")->mergeCells('A7:F7')->getStyle('A7:F7')->applyFromArray($TableNoData);
		$objPHPExcel->setActiveSheetIndex($Sheet)->getStyle('A6:F'.(7+$i))->applyFromArray($styleArray);
		
		//Streatch column width based on the content
		for($col = 'A'; $col !== 'G'; $col++)
			$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
	}
	
	// Products------------------------------------------------------------------------------
	if(in_array("Product", $_GET['Modules']))
	{
		$Sheet++;
		$objPHPExcel->createSheet($Sheet);
		$objPHPExcel->getSheet($Sheet)->setTitle('Product');
		// Add some data
		echo date('H:i:s') , " Add some data" , EOL;
		$objPHPExcel->setActiveSheetIndex($Sheet)
		->setCellValue('A6', 'S.No.')
		->setCellValue('B6', 'Code')
		->setCellValue('C6', 'Description')
		->setCellValue('D6', 'Watt')
		->setCellValue('E6', 'Watt Max')
		->setCellValue('F6', 'I/P Voltage')
		->setCellValue('G6', 'I/P Voltage Max')
		->setCellValue('H6', 'O/P/P Voltage')
		->setCellValue('I6', 'O/P Voltage Max')
		->setCellValue('J6', 'O/P Current')
		->setCellValue('K6', 'Efficiency')
		->setCellValue('L6', 'L')
		->setCellValue('M6', 'B')
		->setCellValue('N6', 'H')
		->setCellValue('O6', 'Pack Quantity')
		->setCellValue('P6', 'Remarks')->getStyle('A6:P6')->applyFromArray($TableHeaderStyle);
		$i=0;
		$Product = Select_Product();
		SetHeader($Sheet, "Product Report ", "Total No of Products : ".mysqli_num_rows($Product));
		while($ProductData = mysqli_fetch_assoc($Product))
		{
			$objPHPExcel->setActiveSheetIndex($Sheet)
			->setCellValue('A'.(6+(++$i)), $i)
			->setCellValue('B'.(6+$i), $ProductData['productcode'])
			->setCellValue('C'.(6+$i), $ProductData['description'])
			->setCellValue('D'.(6+$i), $ProductData['watt'])
			->setCellValue('E'.(6+$i), $ProductData['wattmax'])
			->setCellValue('F'.(6+$i), $ProductData['inputvoltage'])
			->setCellValue('G'.(6+$i), $ProductData['inputvoltagemax'])
			->setCellValue('H'.(6+$i), $ProductData['outputvoltage'])
			->setCellValue('I'.(6+$i), $ProductData['outputvoltagemax'])
			->setCellValue('J'.(6+$i), $ProductData['outputcurrent'])
			->setCellValue('K'.(6+$i), $ProductData['efficiency'])
			->setCellValue('L'.(6+$i), $ProductData['l'])
			->setCellValue('M'.(6+$i), $ProductData['b'])
			->setCellValue('N'.(6+$i), $ProductData['h'])
			->setCellValue('O'.(6+$i), $ProductData['packquantity'])
			->setCellValue('P'.(6+$i), $ProductData['remarks']);
		}
		if(!$i)
			$objPHPExcel->setActiveSheetIndex($Sheet)->setCellValue('A7', "No Data Found!")->mergeCells('A7:P7')->getStyle('A7:P7')->applyFromArray($TableNoData);
		$objPHPExcel->setActiveSheetIndex($Sheet)->getStyle('A6:P'.(7+$i))->applyFromArray($styleArray);
		
		//Streatch column width based on the content
		for($col = 'A'; $col !== 'Q'; $col++)
			$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
	}
	
	// Sheet Header------------------------------------------------------------------------------
	function SetHeader($SheetIndex, $Title, $SubTitle)
	{
		global $objPHPExcel;
		$objPHPExcel->setActiveSheetIndex($SheetIndex)->mergeCells('A1:G2');
		$objPHPExcel->setActiveSheetIndex($SheetIndex)->mergeCells('A3:G4')->getStyle('A3:G4')->getFont()->setSize(16)->setBold(true);
		$objPHPExcel->setActiveSheetIndex($SheetIndex)->setCellValue('A3', $Title);
		$objPHPExcel->setActiveSheetIndex($SheetIndex)->mergeCells('A5:G5')->getStyle('A5:G5')->getFont()->setSize(14)->setBold(true);
		$objPHPExcel->setActiveSheetIndex($SheetIndex)->setCellValue('A5', $SubTitle);
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

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
	$objWriter->save($_GET['Module'].".xlsx");
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
?>

<script>
	window.location.href= '<?php echo $_GET['Module']; ?>.xlsx';
</script>