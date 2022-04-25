<?php
	require 'plantillas/fpdf/fpdf.php';
	//include 'barcode.php';
    $inicial = 10000000;//$_GET['inicial'];
    $type = 'PC';//$_GET['type'];
    $cantidad =10;// $_GET['cantidad'];


	
	$pdf = new FPDF('L','mm', array(90, 180));
	$pdf->AddPage('L', 'A4',0);
	$y = 20;

	$fecha = date('m-d-Y h:i:s a', time());
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(200);
	$pdf->Cell(30,5,"Fecha Generada: $fecha",0,1,'C');
	
    for ($i=0; $i < $cantidad; $i++) { 
        
		$code = $type.$inicial;
        
		//barcode('codigos/'.$code.'.png', $code, 50, 'horizontal', 'code128', true);
        //$pdf->Image("codigos/$code.png",10,$y,70,0,'PNG');
		$pdf->Image('codigos/'.$code.'.png',10,$y,50,0,'PNG');
		
        $inicial++;
		$y = $y+10;
        
    }
	$pdf->Output('I', 'barcode.pdf');	
	
?>