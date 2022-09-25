<?php
include("Config.php");
if($_GET['Type']=="Invoice")
{
	$FetchData = mysql_fetch_array(mysql_query("SELECT count( * ) AS total, SUM( stockinventory.amount ) as amount , SUM( tax.percent ) AS percentage, SUM( stockinventory.amount + stockinventory.taxamount ) AS amounttax
	FROM `invoice`
	JOIN stockinventory ON stockinventory.invoiceid = invoice.id
	JOIN tax ON tax.id = stockinventory.taxid
	WHERE invoicedate between '".date('Y-m-d',strtotime($_GET['startdate']))."' and '".date('Y-m-d',strtotime($_GET['enddate']))."'"));
	echo '<br/>Total Invoices : '.$FetchData['total'].'<br/>
	Total Tax &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.number_format($FetchData['percentage'],2).'<br/>
	Total Amount &nbsp;: '.number_format($FetchData['amount'],2).'<br/>
	Total Expenses for This Period : '.number_format($FetchData['amounttax'],2).'';
	
}
else if($_GET['Type']=="Issuance")
{
	$FetchData = mysql_fetch_array(mysql_query("SELECT count( * ) AS total, SUM( stockissuance.amount ) as amount 
	FROM `stockissuance`
	JOIN issuance ON stockissuance.issuanceid = issuance.id
	WHERE issuance.issueddate between '".date('Y-m-d',strtotime($_GET['startdate1']))."' and '".date('Y-m-d',strtotime($_GET['enddate1']))."'"));
	echo '<br/>Total Issuance : '.$FetchData['total'].'<br/>
	Stock Issuance Amount : '.number_format($FetchData['amount'],2).'<br/><br/>';
}
?>
