<?php
require('../fpdf17/fpdf.php');
include('Config.php');
include('Reports_Queries.php');
ini_set("display_errors","0");
date_default_timezone_set('Asia/Kolkata');
class People
{
	public function all() 
	{
		try
		{
			global $mysql_hostname,$mysql_user, $mysql_password,$mysql_database;
			$db = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_database", $mysql_user, $mysql_password);
			$query = $db->prepare(Report_Data_Download());
			$query->execute();
			$people = $query->fetchAll(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			//echo "Exeption: " .$e->getMessage();
			$result = false;
		}
		$query = null;
		$db = null;
		return $people;		
	}
}
class PeoplePDF extends FPDF 
{
	//Create basic table
	public function CreateTable($header, $data)
	{
		//Header
		$this->SetFillColor(0);
		$this->SetTextColor(255);
		$this->SetFont('','B');
		foreach ($header as $col) 
		{
			//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
			$this->Cell($col[1], 10, $col[0], 1, 0, 'L', true);
		}
		$this->Ln();
		// Data
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		foreach ($data as $row)
		{
			$i = 0;
			foreach ($row as $field) 
			{
				$this->Cell($header[$i][1], 10,$field, 1, 0, 'L',true);
				$i++;
			}
			$this->Ln();
		}
	}
	function Header()
	{
		// Select Arial bold 15
		$this->SetFont('courier','B',15);
		// Move to the right
		$this->Cell(80);
		// Framed title
		$this->Image('../images/logo.png',10,11,-250);
		$this->Cell(90,12,'Chiramith Precision India Summary Of Reports',0,0,'C');
		// Line break
		//$this->Ln(7);
		//$this->Cell(190,10,'Summary Of Reports ',0,0,'C');
		$this->Ln(13);
	}
	function Footer()
	{
		// Go to 1.5 cm from bottom
		$this->SetY(-15);
		// Select Arial italic 8
		$this->SetFont('courier','B',8);
		// Print centered page number
		$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
	}
}
	// Column headings
	$header = array
				(
					array('Customer',47),
					array('Order',20),
					array('Product',35),
					array('DrawingNo.',40),
					array('Grade',22),
					array('MaterialSize',23),
					array('Machine',16),
					array('MacSpec',20),
					array('No.ofTools',21),
					array('Startdate',20),
					array('Enddate',20)
				);
	//Get data
	$people = new People();
	$data = $people->all();
	$pdf = new PeoplePDF('L');
	$pdf->Cell(200,80,'reportSubtitle');
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->AddPage();
	$pdf->CreateTable($header,$data);
	$pdf->Output('CHIRAMITH PRECISION(INDIA) Report'.date("d-m-Y H-i").'.pdf','D');
	//$pdf->Output();
?>