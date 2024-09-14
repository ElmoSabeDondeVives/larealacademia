<?php

require 'app/view/pdf/fpdf/fpdf.php';

class PDF extends FPDF
{

    //Cabecera de pagina
    function Header()
    {
        //Arial bold 15
        $this->SetFont('Arial', 'B', 9);
        //Mover
        $this->Cell(190,4, '', 0, 1, 'C');
        $this->Cell(40,10, '', 0, 0, 'C');
        //Titulo
        $this->Cell(150, 10, 'LA REAL ACADEMIA', 0, 1, 'L');
        $this->SetFont('Arial', 'B', 12);
        //$this->SetFont('Arial','B',12);
        //$this->Cell(190,10,'PROFORMA DE VENTA',0,1,'C');
        $this->SetFont('Arial', 'B', 6);
        $this->Cell(40,4, '', 0, 0, 'L');
        $this->Cell(150, 4, 'CALLE YAVARI 372', 0, 1, 'L');
        $this->SetFont('Arial', 'B', 6);
        $this->Cell(40,4, '', 0, 0, 'L');
        $this->Cell(150, 4, 'LORETO - MAYNAS - IQUITOS', 0, 1, 'L');
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 2, '', 'T', 1, 'C');
        $this->Image('styles/login/images/logo_real_login.png', 10, 0, 35);
        //Salto de linea
    }

    //Pie de pagina
    function Footer()
    {
        //$this->Image('media/fire/firma2.png',50,235,110);
        //Posicion: a 1.5 cm del final
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        //Numero de Ipagina
        $fecha = date('d-m-Y h:i:s');
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}' . " " . "|| Hora y fecha de descarga" . " " . $fecha . " || bufeotec.com", 0, 0, 'C');
    }
}
