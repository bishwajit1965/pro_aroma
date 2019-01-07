<?php

include_once('fpdf.php');
// $db = new PDO('mysql:host=localhost; dbname=aroma', 'root', '');

class myPDF extends FPDF
{
    public function header()
    {
        $this->SetFont("Arial", "B", 14);
        $this->Image("images/logo.jpg");
        $this->Cell(0, 10, 'This is the header');
        $this->Ln(20);
    }
    public function footer()
    {
        $this->SetFont("Arial", "B", 14);
        $this->Cell(0, 20, "Page " .$this->PageNo() .'/{nb}');
    }
}

ob_start();
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
for ($i=1; $i<50; $i++) {
    $pdf->Cell(0, 10, 'This is client number' .$i, 1, 10);
}
$pdf->Output();
ob_end_flush();
