<?php

require 'app/models/Reporte.php';
require 'app/models/Notas.php';
class ReporteController
{
    //Variables fijas para cada llamada al controlador
    private $sesion;
    private $encriptar;
    private $log;
    private $validar;

    private $reporte;
    private $notas;

    public function __construct()
    {
        //Instancias fijas para cada llamada al controlador
        $this->encriptar = new Encriptar();
        $this->log = new Log();
        $this->sesion = new Sesion();
        $this->validar = new Validar();
        $this->reporte = new Reporte();
        $this->notas = new Notas();
    }

    public function inicio()
    {
        try {
            //Llamamos a la clase del Navbar, que sólo se usa
            // en funciones para llamar vistas y la instaciamos
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'], _FULL_KEY_));

            $fecha = date('Y-m-d');
            $productos = $this->reporte->listar_dia();
            $listar_monto_inicial = $this->reporte->listar_monto_apertura_reporte_dia($fecha);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'reportes/reportes.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e) {
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"" . _SERVER_ . "\";</script>";
        }
    }
    public function pagos_al(){
        try{
            if(!$this->validar->validar_parametro('id', 'GET',true,true,11,'numero',0)){
                throw new Exception('ID no declarado');
            }
            $this->nav = new Navbar();

            $config = $this->notas->list_pagos($_GET['id']);
            $al = $this->notas->list_client($_GET['id']);
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'reportes/pagos_al.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function pagos(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            if (isset($_POST['validate'])){
                $data = true;

            }else{
                $data= false;
            }
            $text=$_POST['data_al'];
            $config = $this->notas->buscar_alumno($text);

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'reportes/pagos.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function reporte_c(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $list = $this->reporte->list_clases();
            (isset($_POST['fecha_ini']))? $fecha_ini = $_POST['fecha_ini'] : $fecha_ini = date('Y-m-d');
            (isset($_POST['fecha_fin']))? $fecha_fin = $_POST['fecha_fin'] : $fecha_fin = date('Y-m-d');
            if (isset($_POST['validate'])){
                $data = true;

            }else{
                $data= false;
            }
            $text=$_POST['id_clase'];
            $config = $this->notas->buscar_ventas_clases_date($text,$fecha_ini,$fecha_fin);

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'reportes/reporte_c.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function reporte_concepto(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $list = $this->reporte->list_conceptos();
            if (isset($_POST['validate'])){
                $data = true;
                $fecha_ini = $_POST['fecha_ini'];
                $fecha_fin = $_POST['fecha_fin'];

            }else{
                $data= false;
                $fecha_ini = date('Y-m-d');
                $fecha_fin = date('Y-m-d');
            }
            $text=$_POST['id_concepto'];
            $config = $this->reporte->buscar_ventas_details_fec($text,$fecha_ini,$fecha_fin);

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'reportes/reporte_concepto.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function reporte_dia()
    {
        try {
            //Llamamos a la clase del Navbar, que sólo se usa
            // en funciones para llamar vistas y la instaciamos
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'], _FULL_KEY_));

            //$fecha = date('Y-m-d');
            //$productos = $this->reporte->listar_dia();
            $fecha_filtro = date('Y-m-d');
            $fecha_filtro_fin = date('Y-m-d');

            //$nueva_fecha_fin_ = date('Y-m-d',strtotime($fecha_filtro."- 1 days"));
            //$listar_monto_inicial = $this->reporte->listar_monto_apertura_reporte_dia_filtro($fecha_filtro,$fecha_filtro_fin);
            //$productos = $this->reporte->listar_dia();

            if(isset($_POST['enviar_fecha'])){
                $fecha_filtro = $_POST['fecha_filtro'];
                $fecha_filtro_fin = $_POST['fecha_filtro_fin'];
            }
            $nueva_fecha_fin_ = date('Y-m-d',strtotime($fecha_filtro."- 1 days"));

            $listar_monto_inicial = $this->reporte->listar_monto_apertura_reporte_dia_filtro($fecha_filtro,$fecha_filtro_fin);
            $productos = $this->reporte->listar_dia();
            //$listar_monto_inicial = $this->reporte->listar_monto_apertura_reporte_dia_filtro($fecha_filtro,$fecha_filtro_fin);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'reportes/reporte_dia.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e) {
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"" . _SERVER_ . "\";</script>";
        }
    }

    public function reporte_dia_pdf(){
        try{
            $id = $_GET['id'];
            //Llamamos a la clase del Navbar, que sólo se usa
            // en funciones para llamar vistas y la instaciamos
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));

            $fecha_filtro = date('Y-m-d');
            $fecha_filtro_fin = date('Y-m-d');

            if($_GET['fecha_filtro'] != "" && $_GET['fecha_filtro_fin'] != ""){
                $fecha_filtro = $_GET['fecha_filtro'];
                $fecha_filtro_fin = $_GET['fecha_filtro_fin'];

            }
            $nueva_fecha_fin_ = date('Y-m-d',strtotime($fecha_filtro."- 1 days"));
            $productos = $this->reporte->listar_dia();
            $egreso = $this->reporte->listar_egresos_dia($fecha_filtro,$fecha_filtro_fin);

            $listar_monto_inicial = $this->reporte->listar_monto_apertura_reporte_dia_filtro($fecha_filtro,$fecha_filtro_fin);

            $fecha = date('d-m-Y');
            require _VIEW_PATH_ . 'reportes/reporte_dia_pdf.php';
        }catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function reporte_compras(){
        try{
            //Llamamos a la clase del Navbar, que sólo se usa
            // en funciones para llamar vistas y la instaciamos
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'], _FULL_KEY_));

            $fecha_hoy = date('Y-m-d');

            $productos_stock = $this->reporte->listar_dia_stock($fecha_hoy);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'reportes/reporte_compras.php';
            require _VIEW_PATH_ . 'footer.php';
        }catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function ingresos_y_egresos(){
        try{

            $fecha_hoy = date('Y-m-d');

            $fecha_filtro = date('Y-m-d');
            $fecha_filtro_fin = date('Y-m-d');
            if(isset($_POST['enviar_fecha'])){
                $fecha_filtro = $_POST['fecha_filtro'];
                $fecha_filtro_fin = $_POST['fecha_filtro_fin'];
                $ventas = $this->reporte->listar_ventas_filtro($fecha_filtro,$fecha_filtro_fin);
                $listar_egresos = $this->reporte->listar_egresos($fecha_filtro,$fecha_filtro_fin);
            }

            //Llamamos a la clase del Navbar, que sólo se usa
            // en funciones para llamar vistas y la instaciamos
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'], _FULL_KEY_));


            //$listar_monto_inicial = $this->reporte->listar_monto_apertura($fecha_filtro,$fecha_filtro_fin);

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'reportes/ingresos_y_egresos.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e) {
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"" . _SERVER_ . "\";</script>";
        }
    }

    public function ingresos_egresos_pdf(){
        try{

            $nueva_fecha = $_POST['fecha'];

            $ventas = $this->reporte->listar_ventas_nuevo_filtro($nueva_fecha);
            $listar_egresos = $this->reporte->listar_egresos_nuevo($nueva_fecha);
            $listar_monto_inicial = $this->reporte->listar_monto_apertura_reporte_dia($nueva_fecha);

            require _VIEW_PATH_ . 'reportes/ingresos_y_egresos_pdf.php';
        }catch (Throwable $e) {
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"" . _SERVER_ . "\";</script>";
        }
    }

    public function inventario(){
        try{
            //Llamamos a la clase del Navbar, que sólo se usa
            // en funciones para llamar vistas y la instaciamos
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'], _FULL_KEY_));
            $fecha = date('Y-m-d');
            $productos = $this->reporte->listar_productos();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'reportes/inventario.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e) {
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"" . _SERVER_ . "\";</script>";
        }
    }

    public function salidas_stock(){
        try{
            $id_producto = $_POST['id_producto'];
            $fecha_filtro = $_POST['fecha_filtro'];
            $fecha_filtro_fin = $_POST['fecha_filtro_fin'];
            $identificador = $_POST['identificador'];

            //Identificador 1 es agregados
            //Identificador 2 es ventas
            //Identificador 3 es salidas / donaciones
            if($identificador == 1){
                $result = $this->reporte->consultar_agregados($id_producto, $fecha_filtro,$fecha_filtro_fin);
                $result_ = $this->reporte->consultar_agregados_($id_producto, $fecha_filtro,$fecha_filtro_fin);
                $detalle_ = "<label style='color:black;'>Producto:  ".$result_->producto_nombre."</label>";
                $detalle = " <table class='table table-bordered' width='100%'>
                                        <thead class='text-capitalize'>
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>Descripción</th>
                                            <th>Fecha de Agregado</th>
                                        </tr>
                                        </thead>
                                        <tbody>";
                foreach ($result as $r){
                    $detalle .= "<tr>
                                <td>". $r->stocklog_added ."</td>
                                <td>". $r->stocklog_description ."</td>
                                <td>". $r->stocklog_date ."</td>
                            </tr>";
                }
                $detalle .= "</tbody></table>";

            }elseif ($identificador == 2){
                $result = $this->reporte->consultar_ventas($id_producto, $fecha_filtro,$fecha_filtro_fin);

                $detalle = " <table class='table table-bordered' width='100%'>
                                        <thead class='text-capitalize'>
                                        <tr>
                                            <th>Vendedor</th>
                                            <th>Producto</th>
                                            <th>Documento</th>
                                            <th>Correlativo</th>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Monto</th>
                                            <th>Fecha Venta</th>
                                        </tr>
                                        </thead>
                                        <tbody>";

                foreach ($result as $r){
                    if($r->venta_tipo == "03"){
                        $venta_ = "BOLETA";
                    }
                    $detalle .= "<tr>
                                <td>". $r->persona_nombre.' '.$r->persona_apellido_paterno ."</td>
                                <td>". $r->producto_nombre ."</td>
                                <td>". $venta_ ."</td>
                                <td>". $r->venta_correlativo ."</td>
                                <td>". $r->cliente_nombre ."</td>
                                <td>". $r->venta_detalle_cantidad ."</td>
                                <td>". $r->venta_detalle_precio_unitario ."</td>
                                <td>". $r->venta_fecha ."</td>
                            </tr>";
                }
                $detalle .= "</tbody></table>";
            }else{
                $fecha = date('Y-m-d');
                $result = $this->reporte->salidas_stock($id_producto, $fecha_filtro,$fecha_filtro_fin);
                $result_ = $this->reporte->salidas_stock_($id_producto, $fecha_filtro,$fecha_filtro_fin);

                $detalle_ = "<label style='color:black;'>Producto:  ".$result_->producto_nombre."</label>";
                $detalle = " <table class='table table-bordered' width='100%'>
                                        <thead class='text-capitalize'>
                                        <tr>
                                            <th>Origen</th>
                                            <th>Descripción</th>
                                            <th>Cantidad</th>
                                            <th>Destino</th>
                                            <th>Fecha Salida</th>
                                        </tr>
                                        </thead>
                                        <tbody>";
                foreach ($result as $r){
                    $detalle .= "<tr>
                                <td>". $r->stockout_origin ."</td>
                                <td>". $r->stockout_description ."</td>
                                <td>". $r->stockout_out ."</td>
                                <td>". $r->stockout_destiny ."</td>
                                <td>". $r->stockout_date ."</td>
                            </tr>";
                }
                $detalle .= "</tbody></table>";
            }
        }catch (Throwable $e) {
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"" . _SERVER_ . "\";</script>";
        }
        //Retornamos el json
        echo json_encode(array("detalle"=>$detalle,"detalle_"=>$detalle_));
    }

    //FUNCION PARA HACER LA JUGADA SOBRE LAS FECHAS
    public function datos_x_fecha(){
        try{
            $fecha_hoy = $_POST['fecha'];
            $identificador = $_POST['identificador'];

            if($identificador == 0){
                $nueva_fecha = $fecha_hoy;
            }elseif($identificador == 1){
                $nueva_fecha = date('Y-m-d',strtotime($fecha_hoy."- 1 days"));
            }else{
                $nueva_fecha = date('Y-m-d',strtotime($fecha_hoy."+ 1 days"));
            }
            $result = $this->reporte->listar_ventas_nuevo_filtro($nueva_fecha);
            $egresos_for = $this->reporte->listar_egresos_nuevo($nueva_fecha);
            $listar_monto_inicial = $this->reporte->listar_monto_apertura_reporte_dia($nueva_fecha);

            $tabla_ingresos = " <center><h5>INGRESOS</h5></center>
                                <table class='table table-bordered table-hover' style='border-color: black'>
                                        <thead>
                                        <tr style='background-color: #ebebeb'>
                                            <th>Fecha</th>
                                            <th>Documento</th>
                                            <th>Correlativo</th>
                                            <th>Ver Venta</th>
                                            <th>Nombre</th>
                                            <th>Monto</th>
                                        </tr>
                                        </thead>
                                        <tbody>";
            $ingresos_productos = 0;
            foreach ($result as $r) {
                if($r->venta_tipo == "03"){
                    $venta_ = "BOLETA";
                }elseif($r->venta_tipo == "01"){
                    $venta_ = "FACTURA";
                }
                $styleee = "";
                $importe_total = 0;
                if($r->anulado_sunat == 1){
                    $styleee = "style= 'background: #FA9682;'";
                }else{
                    $importe_total = $r->venta_total;
                }
                $ingresos_productos = $ingresos_productos + $importe_total;
                $ingresos_productos_ = $ingresos_productos ?? 0;
                $tabla_ingresos .= "<tr ".$styleee.">
                                <td>". $r->venta_fecha ."</td>
                                <td>". $venta_ ."</td>
                                <td>". $r->venta_correlativo ."</td>
                                <td><a href='"._SERVER_. 'Ventas/ver_venta/' . $r->id_venta."'> Ver</a></td>
                                <td>". $r->cliente_nombre . $r->cliente_razonsocial."</td>
                                <td>". $r->venta_total ."</td>
                            </tr>";
            }

            $tabla_ingresos .= "<tr><td colspan='5' style='text-align: right'>Total Ingresos Ventas Productos:</td><td style='background-color: #f9f17f'><b> S/.".number_format($ingresos_productos_,2)."</b></td></tr>";
            $tabla_ingresos .= "</tbody></table>";

            $tabla_egresos = " <center><h5>EGRESOS</h5></center>
                                <table class='table table-bordered' width='100%'>
                                        <thead class='text-capitalize'>
                                        <tr style='background-color: #ebebeb'>
                                            <th>Fecha</th>
                                            <th>Nombre</th>
                                            <th>Importe</th>
                                        </tr>
                                        </thead>
                                        <tbody>";
            $egresos_ = 0;
            foreach ($egresos_for as $r){
                $egresos_ = $egresos_ + $r->egreso_monto;
                //$egresos_ = $egresos_ ?? 0;
                $tabla_egresos .= "<tr>
                                <td>". $r->egreso_fecha_registro ."</td>
                                <td>". $r->egreso_descripcion ."</td>
                                <td>". $r->egreso_monto ."</td>
                            </tr>";
            }
            $tabla_egresos .= "<tr><td colspan='2' style='text-align: right'>Total Egresos:</td><td style='background-color: #f9f17f'><b> S/.".number_format($egresos_,2)."</b></td></tr>";
            $tabla_egresos .= "</tbody></table>";


            $balance_final = $ingresos_productos - $egresos_;

            $suma_caja = $balance_final + $listar_monto_inicial->caja_apertura;
            $tabla_datos = "<table class='table'>
                                <tbody>";

            $tabla_datos .= "<tr>
                                <td style='background-color: #ebebeb; font-weight: bold'>TOTAL INGRESOS VENTAS:</td>
                                <td>S/. ". number_format($ingresos_productos,2)."</td>
                            </tr>
                            <tr>
                                <td style='background-color: #ebebeb; font-weight: bold'>TOTAL EGRESOS:</td>
                                <td>S/. ". number_format($egresos_,2) ."</td>
                            </tr>
                            <tr style='border-top: 2px solid green;'>
                                <td style='background-color: #ebebeb; font-weight: bold'>SALDO TOTAL DEL DIA:</td>
                                <td>S/. ".number_format($balance_final,2)."</td>
                            </tr>
                            <tr>
                                <td style='background-color: #ebebeb; font-weight: bold'>MONTO DE APERTURA DE CAJA:</td>
                                <td>S/. ".number_format($listar_monto_inicial->caja_apertura,2)."</td>
                            </tr>
                            <tr style='border-top: 3px solid red;'>
                                <td style='background-color: #ebebeb; font-weight: bold'>TOTAL EN CAJA:</td>
                                <td style='background-color: #f9f17f; font-weight: bold'>S/. ".number_format($suma_caja,2)."</td>
                            </tr>";

            $tabla_datos .= "</tbody></table>";

        }catch (Throwable $e) {
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"" . _SERVER_ . "\";</script>";
        }
        //Retornamos el json
        echo json_encode(array("tabla_ingresos"=>$tabla_ingresos,"tabla_egresos"=>$tabla_egresos,"nueva_fecha"=>$nueva_fecha,"tabla_datos"=>$tabla_datos));
    }


}
