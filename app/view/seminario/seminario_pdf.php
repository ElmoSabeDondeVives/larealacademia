<?php

//LLAMAMOS A LA LIBRERIA que está en la vista de report
//require 'app/view/report/pdf_base.php';
//llamamos a la clase pdf_base.php que esta en la vista sellgas
//require_once 'pdf_base_ticket.php';
//se llama directo a la libreria
require 'app/view/pdf/fpdf/fpdf.php';
//require 'app/view/report/pdf_base.php';
// creamos el objeto
$pdf = new FPDF('P');
//Define el marcador de posición usado para insertar el número total de páginas en el documento
$pdf->AddPage();
//CABECERA DEL ARCHIVO
//Logo
$fecha = date('d-m-Y', strtotime($aula_c->evaluacion_creacion));
$pdf->Image(_SERVER_ . 'media/logo/logo_real-removebg.png', 30, 10, '65', '25', 'png');
$pdf->Ln(22);
$pdf->SetFont('Helvetica', 'BU', 14);
$pdf->Cell(190, 4, "SIMULACRO", 0, 1, 'C');
$file ='';
foreach ($preguntas as $p){
    $file .= $p->pregunta_descripcion. ' ';
}



 $col = 0;
 $y0 =0;
function SetCol($col)
{
    //Establecer la posición de una columna dada
    $this->col=$col;
    $x=10+$col*75;
    $this->SetLeftMargin($x);
    $this->SetX($x);
}
function AcceptPageBreak()
{
    //Método que acepta o no el salto automático de página
    if($this->col<2)
    {
        //Ir a la siguiente columna
        $this->SetCol($this->col+1);
        //Establecer la ordenada al principio
        $this->SetY($this->y0);
        //Seguir en esta página
        return false;
    }
    else
    {
        //Volver a la primera columna
        $this->SetCol(0);
        //Salto de página
        return true;
    }
}
function TituloArchivo($num,$label)
{
    $this->SetY(55);
    //Arial 12
    $this->SetFont('Arial','',12);
    //Color de fondo
    $this->SetFillColor(200,220,255);
    //Título
    $this->Cell(0,6,"Archivo $num : $label",0,1,'L',true);
    //Salto de línea
    $this->Ln(4);
    //Guardar ordenada
    $this->y0=$this->GetY();
}

function CuerpoArchivo($file)
{
    //Leemos el fichero
    $f=fopen($file,'r');
    $txt=fread($f,filesize($file));
    fclose($f);
    //Times 12
    $this->SetFont('Times','',12);
    //Imprimimos el texto justificado
    $this->MultiCell(60,5,$txt);
    //Salto de línea
    $this->Ln();
    //Volver a la primera columna
    $this->SetCol(0);
}

function ImprimirArchivo($num,$title,$file)
{
    $this->AddPage();
    $this->TituloArchivo($num,$title);
    $this->CuerpoArchivo($file);
}
$pdf=new PDF();
$title='Mostramos un archivo txt';
$pdf->SetTitle($title);
$pdf->SetY(65);
$pdf->ImprimirArchivo(1,'Archivo de prueba ','prueba1.txt');
$pdf->ImprimirArchivo(2,'Otro archivo','prueba2.txt');
$pdf->Output();

$pdf->Ln(3);
//$ruta_guardado = 'media/comprobantes/'."$serie_correlativo-" .date('Ymd').'.pdf';
$pdf->Output();

































/*
require_once 'app/view/doompdf/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
ob_start();
include "pdf_seminario.php";
$html = ob_get_clean();
$dompdf->loadHtml($html);
$dompdf->render();
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=documento.pdf");
echo $dompdf->output();*/