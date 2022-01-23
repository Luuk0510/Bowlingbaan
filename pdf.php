<?php
require 'connectie.php';
require 'functions.php';
    $query = "SELECT * FROM `boeker`";
    $result = selectAll($pdo, $query);
    ob_end_clean();
    require_once ('fpdf/fpdf.php');
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,'boeker');
    $pdf->Ln();
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(10,10,'id');
    $pdf->Cell(20,10,'naam');
    $pdf->Cell(30,10,'adres');
    $pdf->Cell(20,10,'postcode');
    $pdf->Cell(35,10,'telefoonnummer');
    $pdf->Cell(30,10,'email');
    
    $pdf->Ln();
    foreach($result as $row){
        $pdf->Cell(10,10,$row['id']);
        $pdf->Cell(20,10,$row['naam']);
        $pdf->Cell(30,10,$row['adres']);
        $pdf->Cell(20,10,$row['postcode']);
        $pdf->Cell(35,10,$row['telefoonnummer']);
        $pdf->Cell(30,10,$row['email']);
        $pdf->Ln();
    }
    $pdf->Output();
