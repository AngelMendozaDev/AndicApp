<?php
require_once("../libs/FPHP/fpdf.php");

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../media/icons/logo.png',1,0.5,5);
    // Arial bold 15
    $this->SetFont('Arial','B',12);
    // Movernos a la derecha
    $this->Ln(0.8);
    $this->Cell(10);
    // Título
    $this->Cell(3,0.5,'ASOCIACION NACIONAL PARA EL  DESARROLLO',0,2,'C');
    $this->Cell(3,0.5,'INTEGRAL COMUNITARIO A.C.',0,1,'C');
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-7);
    // Arial italic 8
    $this->SetFont('Arial','I',7);
    // Número de página
    $this->Cell(0,10,utf8_decode('Santa Catarina Tláhuac,CDMX C.P. 13100 Cel. 5531149389'),0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF('P','cm','Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Helvetica','b',10);
$pdf->Ln(1.5);
$pdf->Cell(14);
$pdf->Cell(0,0,utf8_decode('CDMX a 31 de MES de AÑO'),0,1,'R');
$pdf->Ln(0.5);
$pdf->Cell(14);
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(0,0,utf8_decode('OFICIO No. VINC/040/2022'),0,1,'R');
$pdf->Ln(2);
$pdf->Write(0.5,
"MTRA. COLUMBA GRACIELA RIVERA TREJO
DIRECTORA DEL PLANTEL ENAG-CETIS 11
P R E S E N T E.");
$pdf->Ln(0.15);
$pdf->Cell(10);
$pdf->MultiCell(0,0.5,utf8_decode("AT´N: LIC. CAROLINA BARRETO \n JEFA DEL DPTO.  DE VINCULACIÓN"),0,'R');
$pdf->Ln(2);
$pdf->SetFont('Helvetica','',12);
$pdf->MultiCell(0,.8,utf8_decode("Por medio de la presente me permito informarle que el (la) C. Mahuitzic Enid Peláez García, estudiante de la carrera de  Sistemas de Impresión Offset y Serigrafía, con número de control 17309060110308, fue aceptado(a) para realizar sus PRACTICAS PROFESIONALES en la  Asociación Nacional para el Desarrollo Integral Comunitario A.C. , cubriendo un total de 240 horas, a partir del día 1 DE ABRIL   al día de  TERMINO 23 DE JUNIO del año en curso."),0,'J');
$pdf->Ln(2);
$pdf->Cell(0,0,utf8_decode('Agradezco las atenciones se sirva brindar al portador de la presente.'));
$pdf->Ln(2);
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(0,0,utf8_decode('ATENTAMENTE'),0,1);
$pdf->Ln(4);
$pdf->MultiCell(0,.5,utf8_decode("JOSUE FRANCISCO GOMEZ MAYA \n PRESIDENTE DE ANDIC A.C."),0,'L');

$pdf->Output();
