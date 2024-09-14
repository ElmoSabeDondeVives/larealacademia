<?php
//Llamamos a la libreria
require_once 'app/view/pdf/pdf_base_proforma.php';
//creamos el objeto
$pdf=new PDF();
//Añadimos una pagina
$pdf->AddPage();
//Define el marcador de posición usado para insertar el número total de páginas en el documento
$pdf->AliasNbPages();
$pdf->SetFont('Arial','BU',14);
//Mover
//$pdf->Cell(30);
//$pdf->Cell(130,10,'PROFORMA DE VENTA',0,1,'C');
$pdf->Ln();
$pdf->SetFont('Arial','BU',14);
$pdf->Cell(70,6,'DATOS DEL CLIENTE:',0,1,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,6,'NOMBRE        :'." ".$datos_proforma->cliente_nombre.$datos_proforma->cliente_razonsocial,1,1,'L',0);
if($datos_proforma->cliente_numero = "11111111"){
    $mostrar = "SIN DOCUMENTO";
}else{
    $mostrar = $datos_proforma->cliente_numero;
}
$pdf->Cell(190,6,'DNI / RUC       :'." ".$mostrar,1,1,'L',0);
$pdf->Cell(190,6,'FECHA            :'." ".date('d-m-Y', strtotime($datos_proforma->proforma_fecha_generada)),1,1,'L',0);
$pdf->Cell(190,6,'DIRECCIÓN    :'." ".$datos_proforma->cliente_direccion,1,1,'L',0);
$pdf->Ln();
$pdf->Cell(30);
//$pdf->SetFont('Arial','BU',14);
//$pdf->Cell(130,10,'DATOS DE LOS PRODUCTOS',0,1,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','',10);
$pdf->Cell(25,6,'TIPO',1,0,'C',1);
$pdf->Cell(30,6,'CANTIDAD',1,0,'C',1);
$pdf->Cell(80,6,'DESCRIPCIÓN',1,0,'C',1);
$pdf->Cell(28,6,'P. UNIT.',1,0,'C',1);
$pdf->Cell(28,6,'TOTAL',1,0,'C',1);
$pdf->Ln();
$total_ = 0;
foreach ($listar_pdf as $lp) {
    if($lp->proforma_detalle_mm == 1){
        $ver = "Por Menor";
    }else{
        $ver = "Por Mayor";
    }

    $total = $lp->proforma_detalle_producto_cantidad * $lp->proforma_detalle_precio;
    $pdf->CellFitSpace(25,6,$ver,1,0,'C',0);
    $pdf->CellFitSpace(30,6,$lp->proforma_detalle_producto_cantidad,1,0,'C',0);
    $pdf->CellFitSpace(80,6,$lp->producto_nombre,1,0,'C',0);
    $pdf->CellFitSpace(28,6,'S/. '.$lp->proforma_detalle_precio,1,0,'C',0);
    $pdf->CellFitSpace(28,6,'S/. '.$total,1,1,'C',0);
    $total_ = $total_ + $total;

}
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$pdf->Cell(118,10,'MONTO TOTAL PRESUPUESTADO',0,0,'C',0);
$pdf->Cell(30,10,'S/. '.$total_,0,1,'R',0);
$pdf->Ln();

//$pdf->Image('media/fire/firma2.png',50,235,110);

$pdf->Output('','Proforma_'.$fecha);
?>