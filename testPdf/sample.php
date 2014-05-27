<?php
include 'PDFMerger.php';
ini_set('display_errors',1);
$pdf = new PDFMerger;

$pdf->addPDF('samplepdfs/pdf1.pdf', 'all')
	->addPDF('samplepdfs/pdf2.pdf', 'all')
	->merge('file','samplepdfs/merged_pdf_'.time().'.pdf','I');
	
	//REPLACE 'file' WITH 'browser', 'download', 'string', or 'file' for output options
	//You do not need to give a file path for browser, string, or download - just the name.
