<?php
	require 'fpdf/fpdf.php';
	include 'barcode.php';
    $inicial = 10000000;//$_GET['inicial'];
    $type = 'PC';//$_GET['type'];
    $cantidad =10;// $_GET['cantidad'];


	
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetAutoPageBreak(true, 20);
	$y = $pdf->GetY();
	
    for ($i=0; $i < $cantidad; $i++) { 
        
		$code = $type.$inicial;
        
		barcode('codigos/'.$code.'.png', $code, 50, 'horizontal', 'code128', true,1);
        $pdf->Image('codigos/'.$code.'.png',10,$y,70,30,'PNG');
		//$pdf->Image('codigos/'.$code.'.png',10,$y,50,0,'PNG');
		
		$y = $y+15;
        $inicial++;
        
    }
	$pdf->Output();	
	
?>