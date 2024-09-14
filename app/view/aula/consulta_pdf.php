<?php
/**
 * Created by PhpStorm
 * User: LuisSalazar
 * Date: 13/12/2020
 * Time: 10:00 p. m.
 */
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
$pdf->Image(_SERVER_.'media/logo/logo_real-removebg.png',30,10, '65', '25', 'png');
$pdf->Ln(22);
$pdf->SetFont('Helvetica','BU',14);
$pdf->Cell(190,6,$aula->descripcion,0,1,'C');
$pdf->Cell(190,4,"ASISTENCIA - ".$fecha_b,0,1,'C');
$pdf->Ln(3);
$pdf->SetFont('Helvetica','B',7);
$pdf->Cell(10, 6, '#', 1,'','C',0);
$pdf->Cell(100, 6, 'NOMBRE Y APELLIDOS',1,0,'L',0);
$pdf->Cell(80, 6, 'INGRESO', 1,1,'L',0);

$pdf->SetWidths(array(10,100,80));
//PRODUCTOS
$aa=1;
$pdf->SetFont('Helvetica','',7);
foreach ($lista as $d){
    $pdf->Row_L(array($aa, $d->cliente_nombre ,$d->asistencia_creacion),0);

    $aa++;
}
/*foreach ($detalle_venta as $f){
    //INICIO - MODIFICACION DE LOS DETALLES
    $precio_uni = number_format(round("$f->venta_detalle_precio_unitario",2), 2, ',', ' ');
    $precio_total = number_format(round("$f->venta_detalle_valor_total",2), 2, ',', ' ');
    $pdf->Row_(array($aa, $f->venta_detalle_cantidad ,$f->venta_detalle_nombre_producto,$precio_uni, '0.00', $precio_total));
    //FIN - MODIFICACION DE LOS DETALLES

    $cant = strlen($f->venta_detalle_nombre_producto);
    $filas = ceil($cant / 65);
    if($filas==0){$filas=1;}
    $filas_tot+=$filas;
    $he = 4 * $filas;
    /*$pdf->SetFont('Helvetica', '', 7);
    $pdf->Cell(10, $he, "$aa", 1,'','C');
    //$pdf->Cell(15, 20, number_format(round("$f->venta_detalle_cantidad ",2), 2, ',', ' '), 1,'','C');
    $pdf->Cell(15, $he, "$cant $filas $he", 1, 0,'C');
    $pdf->MultiAlignCell(100,4,"$f->venta_detalle_nombre_producto",1,0,'L');
    //$pdf->CellFitSpace(100,5,"$f->venta_detalle_nombre_producto",1,0,'L');
    $pdf->Cell(20, $he, number_format(round("$f->venta_detalle_precio_unitario",2), 2, ',', ' '),1,0,'C');
    $pdf->Cell(15, $he, "0.00", 1, 0, 'C');
    $pdf->Cell(20, $he, number_format(round("$f->venta_detalle_valor_total",2), 2, ',', ' '),1,1,'C');*/
//$aa++;
//}*/


$pdf->Ln(3);
//$ruta_guardado = 'media/comprobantes/'."$serie_correlativo-" .date('Ymd').'.pdf';
$pdf->Output('','ASISTENCIA '.$fecha_b.'.pdf');
?>
