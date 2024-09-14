<?php
//Llamamos a la libreria
require_once 'app/view/pdf/pdf_base_simulacro.php';
//creamos el objeto
$pdf=new PDF();

//Añadimos una pagina
$pdf->AddPage();
$pdf->SetFont('Arial','BU',15);
//Mover
$pdf->Cell(190,8,'FICHA DE MATRICULA',0,1,'C');
/*$pdf->Ln();*/
($cliente->cliente_foto==null)? $ruta = 'media/alumnos/perfil.jpg': $ruta=$cliente->cliente_foto;
/* ------------------- FICHA DE MATRICULA ----------------------- */
$pdf->Image(_SERVER_.$ruta, 10, 47, 40);
$pdf->SetFont('Arial','',9);
$pdf->Cell(40,5,'FOTO',0,0,'C');
$pdf->Cell(150,5,'',0,1,'L');
/* NOMBRES Y APELLIDOS */
$pdf->Cell(40,8,'','LTR',0,'L');
$pdf->Cell(150,8,'  NOMBRES Y APELLIDOS : ' . $cliente->cliente_nombre ,0,1,'L');
/* -- DIRECICION  */
$pdf->Cell(40,8,'','LR',0,'L');
$pdf->Cell(150,8,'  DIRECCION :',0,1,'L');
$pdf->Cell(40,8,'','LR',0,'L');
$pdf->Cell(150,8,'  '.$cliente->cliente_direccion,0,1,'L');
$pdf->Cell(40,8,'','LR',0,'L');
$pdf->Cell(150,8,'  CELULAR : ',0,1,'L');
$pdf->Cell(40,8,'','LBR',0,'L');
$pdf->Cell(150,8,'  '.$cliente->cliente_telefono,0,1,'L');
$pdf->Cell(190,8,'COLEGIO DE PROCEDENCIA:',0,1,'L');
$pdf->Cell(190,8,$cliente->cliente_procedencia,'B',1,'L');
$pdf->Cell(190,8,'FACULTAD QUE POSTULA:',0,1,'L');
$pdf->Cell(190,8,$cliente->carrera_descripcion,'B',1,'L');
$pdf->Cell(190,2,'',0,1,'L');
$pdf->Cell(58,8,'NÚMERO DE VECES QUE POSTULA:',0,0,'L');
$pdf->Cell(10,8,$cliente->cliente_num_postulacion,1,1,'C');
$pdf->Cell(190,2,'',0,1,'L');
$pdf->Cell(190,8,'CORREO ELECTRÓNICO: ',0,1,'L');
$pdf->Cell(190,8,$cliente->cliente_correo,'B',1,'L');
$pdf->Ln();
$pdf->Cell(190,8,'NOMBRE DE APODERADO: ',0,1,'L');
$pdf->Cell(190,8,$cliente->cliente_apoderado,'B',1,'L');
$pdf->Cell(190,8,'CELULAR APODERADO: ',0,1,'L');
$pdf->Cell(190,8,$cliente->cliente_apoderado_cel,'B',1,'L');
$pdf->Cell(190,8,'OBSERVACIONES: ',0,1,'L');
$pdf->Cell(190,8,$cliente->cliente_obs,'B',1,'L');


$pdf->SetFont('Arial','BU',5);




$pdf->Output('','FICHA MATRICULA.pdf');


