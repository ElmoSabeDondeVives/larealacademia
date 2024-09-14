<?php
require 'app/models/Ventas.php';
require 'app/models/Inventario.php';
require 'app/models/Clientes.php';
require 'app/models/Correlativo.php';
require 'app/models/Turno.php';
require 'app/models/Admin.php';
require 'app/models/Nmletras.php';
require 'app/models/ApiFacturacion.php';
require 'app/models/GeneradorXML.php';
class VentasController
{
    //Variables fijas para cada llamada al controlador
    private $sesion;
    private $encriptar;
    private $log;
    private $validar;
    private $ventas;
    private $inventario;
    private $clientes;
    private $correlativo;
    private $turno;
    private $admin;
    private $apiFacturacion;
    private $numLetra;
    private $generadorXML;

    public function __construct()
    {
        //Instancias fijas para cada llamada al controlador
        $this->encriptar = new Encriptar();
        $this->log = new Log();
        $this->sesion = new Sesion();
        $this->validar = new Validar();

        $this->ventas = new Ventas();
        $this->inventario = new Inventario();
        $this->clientes = new Clientes();
        $this->correlativo = new Correlativo();
        $this->turno = new Turno();
        $this->admin = new Admin();
        $this->generadorXML= new GeneradorXML();
        $this->apiFacturacion= new ApiFacturacion();
        $this->numLetra = new Nmletras();
    }

    public function realizar_venta(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));

            $_SESSION['productos'] = array();
            //LISTAMOS LOS PRODUCTOS
            $productos = $this->inventario->listar_productos();
            //LISTAMOS LOS CLIENTES
            $clientes = $this->ventas->listar_clientes();

            $tiponotacredito = $this->ventas->listAllCredito();
            $tiponotadebito = $this->ventas->listAllDebito();
            $lista_clases = $this->ventas->lista_clases();
            $tipo_pago = $this->ventas->listar_tipo_pago();
            $tipos_documento = $this->clientes->listar_documentos();


            $fecha = date('Y-m-d');
            $caja_apertura_fecha = $this->admin->listar_ultima_fecha($fecha);
            if($caja_apertura_fecha == true){
                require _VIEW_PATH_ . 'header.php';
                require _VIEW_PATH_ . 'navbar.php';
                require _VIEW_PATH_ . 'ventas/realizar_venta.php';
                require _VIEW_PATH_ . 'footer.php';
            }else{
                echo "<script language=\"javascript\">alert(\"Para realizar una venta debes aperturar Caja. Redireccionando Al Inicio\");</script>";
                echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
            }
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function tabla_productos(){
        try{
            require _VIEW_PATH_ . 'ventas/tabla_productos.php';
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<br><br><div style='text-align: center'><h3>Ocurrió Un Error Al Cargar La Informacion</h3></div>";
        }
    }

    public function historial_ventas(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $filtro = false;
            $fecha_ini = date('Y-m-d');
            $fecha_fin = date('Y-m-d');
            $ventas_cant = $this->ventas->listar_ventas_sin_enviar();

            if(isset($_POST['enviar_registro'])){
                $query = "SELECT * FROM ventas v inner join clientes c on v.id_cliente = c.id_cliente inner join monedas mo
                        on v.id_moneda = mo.id_moneda INNER JOIN usuarios u on v.id_usuario = u.id_usuario 
                        inner join tipo_pago tp on v.id_tipo_pago = tp.id_tipo_pago 
                        where v.venta_estado_sunat = 0";
                $select = "";
                $where = true;
                if($_POST['tipo_venta']!=""){
                    $where = true;
                    $select = $select . " and v.venta_tipo = '" . $_POST['tipo_venta'] . "'";
                    $tipo_venta = $_POST['tipo_venta'];
                }

                if($_POST['fecha_inicio'] != "" AND $_POST['fecha_final'] != ""){
                    $where = true;
                    $select = $select . " and DATE(v.venta_fecha) between '" . $_POST['fecha_inicio'] ."' and '" . $_POST['fecha_final'] ."'";
                    $fecha_ini = $_POST['fecha_inicio'];
                    $fecha_fin = $_POST['fecha_final'];
                }

                if($where){
                    $datos = true;
                    $order = " order by v.venta_fecha asc";
                    $query = $query . $select . $order;
                    $ventas = $this->ventas->listar_ventas($query);
                }

                /*if($_POST['tipo_venta']!="" && $_POST['estado_cpe']!=""){
                    $ventas = $this->ventas->listar_ventas_filtro_todo($_POST['tipo_venta'],$_POST['estado_cpe'],$_POST['fecha_inicio'], $_POST['fecha_final']);
                    $tipo_venta = $_POST['tipo_venta'];
                    $estado_cpe = $_POST['estado_cpe'];
                }elseif($_POST['tipo_venta']!=""){
                    $ventas = $this->ventas->listar_ventas_filtro_tipo($_POST['tipo_venta'],$_POST['fecha_inicio'], $_POST['fecha_final']);
                    $tipo_venta = $_POST['tipo_venta'];
                }elseif($_POST['estado_cpe']!=""){
                    $ventas = $this->ventas->listar_ventas_filtro_estado($_POST['estado_cpe'],$_POST['fecha_inicio'], $_POST['fecha_final']);
                    $tipo_venta = $_POST['tipo_venta'];
                    $estado_cpe = $_POST['estado_cpe'];
                }else{
                    $ventas = $this->ventas->listar_ventas_filtro_fecha($_POST['fecha_inicio'], $_POST['fecha_final']);
                }*/
                $fecha_ini = $_POST['fecha_inicio'];
                $fecha_fin = $_POST['fecha_final'];
                $filtro = true;
            }

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'ventas/historial_ventas.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function historial_ventas_enviadas(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));

            $filtro = false;
            $fecha_ini = date('Y-m-d');
            $fecha_fin = date('Y-m-d');
            if(isset($_POST['enviar_registro'])){
                $query = "SELECT * FROM ventas v inner join clientes c on v.id_cliente = c.id_cliente inner join monedas mo
                        on v.id_moneda = mo.id_moneda INNER JOIN usuarios u on v.id_usuario = u.id_usuario 
                        inner join tipo_pago tp on v.id_tipo_pago = tp.id_tipo_pago 
                        where v.venta_estado_sunat = 1";
                $select = "";
                $where = true;
                if($_POST['tipo_venta']!=""){
                    $where = true;
                    $select = $select . " and v.venta_tipo = '" . $_POST['tipo_venta'] . "'";
                    $tipo_venta = $_POST['tipo_venta'];
                }

                if($_POST['fecha_inicio'] != "" AND $_POST['fecha_final'] != ""){
                    $where = true;
                    $select = $select . " and DATE(v.venta_fecha) between '" . $_POST['fecha_inicio'] ."' and '" . $_POST['fecha_final'] ."'";
                    $fecha_ini = $_POST['fecha_inicio'];
                    $fecha_fin = $_POST['fecha_final'];
                }

                if($where){
                    $datos = true;
                    $order = " order by v.venta_fecha asc";
                    $query = $query . $select . $order;
                    $ventas = $this->ventas->listar_ventas($query);
                }

                /*if($_POST['tipo_venta']!="" && $_POST['estado_cpe']!=""){
                    $ventas = $this->ventas->listar_ventas_filtro_todo($_POST['tipo_venta'],$_POST['estado_cpe'],$_POST['fecha_inicio'], $_POST['fecha_final']);
                    $tipo_venta = $_POST['tipo_venta'];
                    $estado_cpe = $_POST['estado_cpe'];
                }elseif($_POST['tipo_venta']!=""){
                    $ventas = $this->ventas->listar_ventas_filtro_tipo($_POST['tipo_venta'],$_POST['fecha_inicio'], $_POST['fecha_final']);
                    $tipo_venta = $_POST['tipo_venta'];
                }elseif($_POST['estado_cpe']!=""){
                    $ventas = $this->ventas->listar_ventas_filtro_estado($_POST['estado_cpe'],$_POST['fecha_inicio'], $_POST['fecha_final']);
                    $tipo_venta = $_POST['tipo_venta'];
                    $estado_cpe = $_POST['estado_cpe'];
                }else{
                    $ventas = $this->ventas->listar_ventas_filtro_fecha($_POST['fecha_inicio'], $_POST['fecha_final']);
                }*/
                $fecha_ini = $_POST['fecha_inicio'];
                $fecha_fin = $_POST['fecha_final'];
                $filtro = true;
            }

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'ventas/historial_ventas_enviadas.php';
            require _VIEW_PATH_ . 'footer.php';
        }catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function imprimir_ticket_pdf(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'], _FULL_KEY_));
            $id = $_GET['id'] ?? 0;
            if ($id == 0) {
                throw new Exception('ID Sin Declarar');
            }

            $dato_venta = $this->ventas->listar_venta_x_id_pdf($id);
            $detalle_venta = $this->ventas->listar_venta_detalle_x_id_venta_pdf($id);
            $fecha_hoy = date('d-m-Y H:i:s');
            $ruta_qr = "libs/ApiFacturacion/imagenqr/$dato_venta->empresa_ruc-$dato_venta->venta_tipo-$dato_venta->venta_serie-$dato_venta->venta_correlativo.png";

            if ($dato_venta->venta_tipo == "03") {
                $tipo_comprobante = "BOLETA DE VENTA ELECTRONICA";
                $serie_correlativo = $dato_venta->venta_serie."-".$dato_venta->venta_correlativo;
                if($dato_venta->cliente_numero == "11111111"){
                    $documento = "DNI:                        SIN DOCUMENTO";
                }else{
                    $documento = "DNI:                        $dato_venta->cliente_numero";
                }
            } else if ($dato_venta->venta_tipo == "01") {
                $tipo_comprobante = "FACTURA DE VENTA ELECTRONICA";
                $serie_correlativo = $dato_venta->venta_serie."-".$dato_venta->venta_correlativo;
                $documento = "RUC:                      $dato_venta->cliente_numero";
            } else if ($dato_venta->venta_tipo == "07") {
                $tipo_comprobante = "NOTA DE CRÉDITO DE VENTA ELECTRONICA";
                $serie_correlativo = $dato_venta->venta_serie."-".$dato_venta->venta_correlativo;
                $documento = "DOCUMENTO: $dato_venta->cliente_numero";
            } else {
                $tipo_comprobante = "NOTA DE DÉBITO DE VENTA ELECTRONICA";
                $serie_correlativo = $dato_venta->venta_serie."-".$dato_venta->venta_correlativo;
                $documento = "DOCUMENTO: $dato_venta->cliente_numero";
            }
            $importe_letra = $this->numLetra->num2letras(intval($dato_venta->venta_total));
            $arrayImporte = explode(".", $dato_venta->venta_total);
            $montoLetras = $importe_letra . ' con ' . $arrayImporte[1] . '/100 ' . $dato_venta->moneda;
            //$qrcode = $dato_venta->pago_seriecorrelativo . '-' . $tiempo_fecha[0] . '.png';
            $dato_impresion = 'DATOS DE IMPRESIÓN:';
            require _VIEW_PATH_ . 'ventas/imprimir_ticket_pdf.php';
        }catch (Throwable $e) {
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"" . _SERVER_ . "\";</script>";
        }
    }

    public function ticket_pdf(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'], _FULL_KEY_));
            $id = $_GET['id'] ?? 0;
            if ($id == 0) {
                throw new Exception('ID Sin Declarar');
            }
            $venta = $this->ventas->listar_venta($id);
            $empresa = $this->ventas->listar_empresa_x_id_empresa($venta->id_empresa);
            $dato_venta = $this->ventas->listar_venta_x_id_pdf($id);
            $detalle_venta = $this->ventas->listar_venta_detalle_x_id_venta_pdf($id);
            $cliente = $this->ventas->listar_clienteventa_x_id($venta->id_cliente);
            $fecha_hoy = date('d-m-Y H:i:s');
            $ruta_qr = "libs/ApiFacturacion/imagenqr/$dato_venta->empresa_ruc-$dato_venta->venta_tipo-$dato_venta->venta_serie-$dato_venta->venta_correlativo.png";

            if($venta->venta_tipo == "03"){
                $venta_tipo = "BOLETA DE VENTA ELECTRÓNICA";
            }elseif($venta->venta_tipo == "01"){
                $venta_tipo = "FACTURA DE VENTA ELECTRÓNICA";
            }elseif($venta->venta_tipo == "07"){
                $venta_tipo = "NOTA DE CRÉDITO ELECTRÓNICA";
                $motivo = $this->ventas->listar_tipo_notaC_x_codigo($venta->venta_codigo_motivo_nota);
            }else{
                $venta_tipo = "NOTA DE DÉBITO ELECTRÓNICA";
                $motivo = $this->ventas->listar_tipo_notaD_x_codigo($venta->venta_codigo_motivo_nota);

            }
            if($cliente->id_tipodocumento == "4"){
                $dnni="RUC";
                $cliente_nombre = $cliente->cliente_razonsocial;
            }else{
                $dnni="DNI";
                $cliente_nombre = $cliente->cliente_nombre;
            }
            if ($dato_venta->venta_tipo == "03") {
                $tipo_comprobante = "BOLETA DE VENTA ELECTRONICA";
                $serie_correlativo = $dato_venta->venta_serie."-".$dato_venta->venta_correlativo;
                if($dato_venta->cliente_numero == "11111111"){
                    $documento = "SIN DOCUMENTO";
                }else{
                    $documento = "$dato_venta->cliente_numero";
                }
            } else if ($dato_venta->venta_tipo == "01") {
                $tipo_comprobante = "FACTURA DE VENTA ELECTRONICA";
                $serie_correlativo = $dato_venta->venta_serie."-".$dato_venta->venta_correlativo;
                $documento = "$dato_venta->cliente_numero";
            } else if ($dato_venta->venta_tipo == "07") {
                $tipo_comprobante = "NOTA DE CRÉDITO DE VENTA ELECTRONICA";
                $serie_correlativo = $dato_venta->venta_serie."-".$dato_venta->venta_correlativo;
                $documento = "DOCUMENTO: $dato_venta->cliente_numero";
            } else {
                $tipo_comprobante = "NOTA DE DÉBITO DE VENTA ELECTRONICA";
                $serie_correlativo = $dato_venta->venta_serie."-".$dato_venta->venta_correlativo;
                $documento = "DOCUMENTO: $dato_venta->cliente_numero";
            }
            $importe_letra = $this->numLetra->num2letras(intval($dato_venta->venta_total));
            $arrayImporte = explode(".", $dato_venta->venta_total);
            $montoLetras = $importe_letra . ' con ' . $arrayImporte[1] . '/100 ' . $dato_venta->moneda;
            //$qrcode = $dato_venta->pago_seriecorrelativo . '-' . $tiempo_fecha[0] . '.png';
            $dato_impresion = 'DATOS DE IMPRESIÓN:';
            require _VIEW_PATH_ . 'ventas/ticket_pdf.php';
        }catch (Throwable $e) {
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"" . _SERVER_ . "\";</script>";
        }
    }

    public function envio_resumenes_diario(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));

            $filtro = false;
            $fecha_ini = date('Y-m-d');
            $fecha_fin = '';
            if(isset($_POST['enviar_registro'])){
                $query = "SELECT * FROM ventas v inner join clientes c on v.id_cliente = c.id_cliente inner join monedas mo
                        on v.id_moneda = mo.id_moneda INNER JOIN usuarios u on v.id_usuario = u.id_usuario 
                        inner join tipo_pago tp on v.id_tipo_pago = tp.id_tipo_pago 
                        where v.venta_estado_sunat = 0 and v.venta_tipo <> '01' and v.tipo_documento_modificar <> '01'
                        and v.venta_tipo_envio <> 1";
                $select = "";
                $where = true;
                $tipo_venta = $_POST['tipo_venta'];

                if($_POST['fecha_inicio'] != "" ){
                    $where = true;
                    $select = $select . " and DATE(v.venta_fecha) = '" . $_POST['fecha_inicio'] ."'";
                    $fecha_ini = $_POST['fecha_inicio'];
                    //$fecha_fin = $_POST['fecha_final'];
                }

                if($where){
                    $datos = true;
                    $order = " order by v.venta_fecha asc";
                    $query = $query . $select . $order;
                    $ventas = $this->ventas->listar_ventas($query);
                }

                /*if($_POST['tipo_venta']!="" && $_POST['estado_cpe']!=""){
                    $ventas = $this->ventas->listar_ventas_filtro_todo($_POST['tipo_venta'],$_POST['estado_cpe'],$_POST['fecha_inicio'], $_POST['fecha_final']);
                    $tipo_venta = $_POST['tipo_venta'];
                    $estado_cpe = $_POST['estado_cpe'];
                }elseif($_POST['tipo_venta']!=""){
                    $ventas = $this->ventas->listar_ventas_filtro_tipo($_POST['tipo_venta'],$_POST['fecha_inicio'], $_POST['fecha_final']);
                    $tipo_venta = $_POST['tipo_venta'];
                }elseif($_POST['estado_cpe']!=""){
                    $ventas = $this->ventas->listar_ventas_filtro_estado($_POST['estado_cpe'],$_POST['fecha_inicio'], $_POST['fecha_final']);
                    $tipo_venta = $_POST['tipo_venta'];
                    $estado_cpe = $_POST['estado_cpe'];
                }else{
                    $ventas = $this->ventas->listar_ventas_filtro_fecha($_POST['fecha_inicio'], $_POST['fecha_final']);
                }*/
                $filtro = true;
            }

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'ventas/envio_resumen_diario.php';
            require _VIEW_PATH_ . 'footer.php';
        }catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function historial_resumen_diario(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));

            $filtro = false;
            $fecha_ini = date('Y-m-d');
            $fecha_fin = date('Y-m-d');
            if(isset($_POST['enviar_registro'])){

                $resumen = $this->ventas->listar_resumen_diario_fecha($_POST['fecha_inicio'], $_POST['fecha_final']);

                $fecha_ini = $_POST['fecha_inicio'];
                $fecha_fin = $_POST['fecha_final'];
                $filtro = true;
            }

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'ventas/historial_resumen_diario.php';
            require _VIEW_PATH_ . 'footer.php';
        }catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function historial_bajas_facturas(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));

            $filtro = false;
            $fecha_ini = date('Y-m-d');
            $fecha_fin = date('Y-m-d');
            if(isset($_POST['enviar_registro'])){

                $bajas = $this->ventas->listar_comunicacion_baja_fecha($_POST['fecha_inicio'], $_POST['fecha_final']);

                $fecha_ini = $_POST['fecha_inicio'];
                $fecha_fin = $_POST['fecha_final'];
                $filtro = true;
            }

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'ventas/historial_bajas_facturas.php';
            require _VIEW_PATH_ . 'footer.php';
        }catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function generar_nota(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $venta = $this->ventas->listar_venta($id);
            $detalle_venta = $this->ventas->listar_detalle_ventas($id);
            $tipo_pago = $this->ventas->listar_tipo_pago();
            $productos = $this->inventario->listar_productos();
            //LISTAMOS LOS CLIENTES
            $clientes = $this->ventas->listar_clientes();
            $tipos_documento = $this->clientes->listar_documentos();

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'ventas/generar_nota.php';
            require _VIEW_PATH_ . 'footer.php';
        }catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function ver_detalle_resumen(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $resumen = $this->ventas->listar_resumen_diario_x_id($id);
            $detalle_resumen = $this->ventas->listar_resumen_diario_detalle_x_id($id);


            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'ventas/ver_detalle_resumen.php';
            require _VIEW_PATH_ . 'footer.php';
        }catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function ver_venta(){
        try{
            //Llamamos a la clase del Navbar, que sólo se usa
            // en funciones para llamar vistas y la instaciamos
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            //creamos la vartiable que recibimos por metodo GET
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $sale = $this->ventas->listar_venta($id);
            $productssale = $this->ventas->listar_detalle_ventas($id);
            //Hacemos el require de los archivos a usar en las vistas
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'ventas/ver_venta.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    //FUNCIONES
    public function addproduct(){
        try{
            if(isset($_POST['codigo']) && isset($_POST['producto']) && isset($_POST['unids']) && isset($_POST['precio']) && isset($_POST['cantidad']) && isset($_POST['tipo_igv'])){
                $repeat = false;
                foreach($_SESSION['productos'] as $p){
                    if($_POST['codigo'] == $p[0]){
                        $repeat = true;
                    }
                }
                if(!$repeat){
                    array_push($_SESSION['productos'], [$_POST['codigo'], $_POST['producto'], $_POST['unids'], round($_POST['precio'], 2), $_POST['cantidad'], $_POST['tipo_igv'], $_POST['product_descuento']]);
                    $result = 1;
                } else {
                    $result = 3;
                }
            } else {
                $result = 2;
            }
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function editar_cantidad_tabla(){
        try{
            if(isset($_POST['id'])){
                $buscar = $_POST['id'];
                $valor_nueva_cantidad = $_POST['valor_nueva_cantidad'];
                $editar = count($_SESSION['productos']);
                for($i=0; $i < $editar; $i++){
                    if($_SESSION['productos'][$i][0] == $buscar){
                        $_SESSION['productos'][$i][4] = $valor_nueva_cantidad;
                    }
                }
                $_SESSION['productos'] = array_values($_SESSION['productos']);
                $result = 1;
            }

        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo json_encode($result);
    }

    public function eliminar_producto(){
        try{
            if(isset($_POST['codigo'])){
                $buscar = $_POST['codigo'];
                $totalar = count($_SESSION['productos']);
                for($i=0; $i < $totalar; $i++){
                    if($_SESSION['productos'][$i][0] == $buscar){
                        unset($_SESSION['productos'][$i]);
                    }
                }
                $_SESSION['productos'] = array_values($_SESSION['productos']);
                $result = 1;
            } else {
                $result = 2;
            }
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function guardar_venta(){
        //Código de error general
        $result = 0;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion
            //$ok_data = $this->validar->validar_parametro('saleproduct_type', 'POST',false,$ok_data,11,'texto',0);
            //Validacion de datos
            if($ok_data){
                $model = new Ventas();
                if($this->clientes->validar_dni($_POST['cliente_number'])){
                    //Código 5: DNI duplicado
                    $return = 1;
                    $message = "Ya existe un cliente con este DNI registrado";
                } else{
                    $model->cliente_razonsocial = "";
                    $model->cliente_nombre = "";
                    if($_POST['select_tipodocumento'] == 4){
                        $model->cliente_razonsocial = $_POST['cliente_name'];
                    }else{
                        $model->cliente_nombre = $_POST['cliente_name'];
                    }
                    $model->id_tipodocumento = $_POST['select_tipodocumento'];
                    $model->cliente_numero = $_POST['cliente_number'];
                    $model->cliente_correo = "";
                    $model->cliente_direccion = $_POST['cliente_direccion'];
                    $model->cliente_telefono = $_POST['cliente_telefono'];

                    $return = $this->clientes->guardar($model);
                }
                if($return == 1){
                    $model->venta_tipo_envio = "0";
                    if(isset($_POST['id_venta'])){
                        $id_venta_ = $_POST['id_venta'];
                        $dato_venta = $this->ventas->listar_venta_x_id($id_venta_);
                        $model->venta_tipo_envio= $dato_venta->venta_tipo_envio;
                    }
                    $consulta_cliente = $this->clientes->listar_cliente_x_numerodoc($_POST['cliente_number']);
                    $id_turno = $this->turno->listar();
                    $model->id_cliente = $consulta_cliente->id_cliente;
                    $model->id_usuario = $this->encriptar->desencriptar($_SESSION['c_u'], _FULL_KEY_);
                    $model->id_turno = $id_turno->id_turno;
                    //$model->venta_nombre = $_POST['client_name'];
                    //$model->venta_direccion = $_POST['saleproduct_direccion'];
                    $producto_venta_tipo = $_POST['saleproduct_type'];
                    $model->venta_tipo =  $producto_venta_tipo;
                    $model->id_tipo_pago =  $_POST['id_tipo_pago'];
                    //obtener serie con el id
                    $serie_ = $this->ventas->listar_correlativos_x_serie($_POST['serie']);
                    $model->venta_serie = $serie_->serie;
                    $model->venta_correlativo = $serie_->correlativo + 1;
                    $model->venta_tipo_moneda = $_POST['tipo_moneda'];
                    $producto_venta_correlativo = 1;
                    $model->producto_venta_correlativo = $producto_venta_correlativo;

                    $model->producto_venta_totalgratuita = $_POST['saleproduct_gratuita'];
                    $model->producto_venta_totalexonerada = $_POST['saleproduct_exonerada'];
                    $model->producto_venta_totalinafecta = $_POST['saleproduct_inafecta'];
                    $model->producto_venta_totalgravada = $_POST['saleproduct_gravada'];
                    $model->producto_venta_totaligv = $_POST['saleproduct_igv'];
                    $model->producto_venta_icbper = $_POST['saleproduct_icbper'];
                    $model->producto_venta_total = $_POST['saleproduct_total'];
                    if(empty($_POST['pago_con_'])){
                        $model->producto_venta_pago = 0;
                    }else{
                        $model->producto_venta_pago = $_POST['pago_con_'];
                    }
                    if(empty($_POST['vuelto_'])){
                        $model->producto_venta_vuelto = 0;
                    }else{
                        $model->producto_venta_vuelto = $_POST['vuelto_'];
                    }
                    if(empty($_POST['des_global'])){
                        $model->producto_venta_des_global = 0;
                    }else{
                        $model->producto_venta_des_global = $_POST['des_global'];
                    }
                    if(empty($_POST['des_total'])){
                        $model->producto_venta_des_total = 0;
                    }else{
                        $model->producto_venta_des_total = $_POST['des_total'];
                    }
                    $producto_venta_fecha = date("Y-m-d H:i:s");
                    $model->producto_venta_fecha = $producto_venta_fecha;

                    $model->tipo_documento_modificar = $_POST['Tipo_documento_modificar'];
                    $model->serie_modificar = $_POST['serie_modificar'];
                    $model->numero_modificar = $_POST['numero_modificar'];
                    $model->notatipo_descripcion = $_POST['notatipo_descripcion'];
                    $model->id_clase = $_POST['id_clase'];

                    $guardar = $this->ventas->guardar_venta($model);

                    if($guardar == 1){
                        $id_cliente = $consulta_cliente->id_cliente;
                        $jalar_id = $this->ventas->jalar_id_venta($producto_venta_fecha,$id_cliente);
                        $idventa = $jalar_id->id_venta;
                    }

                    if($idventa != 0) { //despues de registrar la venta se sigue a registrar el detalle
                        $fecha_bolsa = date("Y");
                        if ($fecha_bolsa == "2020"){
                            $impuesto_icbper = 0.20;
                        } else if ($fecha_bolsa == "2021"){
                            $impuesto_icbper = 0.30;
                        } else if ($fecha_bolsa == "2022") {
                            $impuesto_icbper = 0.40;
                        } else{
                            $impuesto_icbper = 0.50;
                        }
                        $igv_porcentaje = 0.18;
                        $ICBPER = 0;
                        foreach ($_SESSION['productos'] as $p){
                            $cantidad = $p[4];
                            $precio_unitario = $p[3];
                            $descuento_item = $p[6];
                            $factor_porcentaje = 1;
                            $porcentaje=0;
                            $igv_detalle=0;
                            if($p[5] == 10){
                                $igv_detalle = $p[3]*$p[4]*$igv_porcentaje;
                                $factor_porcentaje = 1+ $igv_porcentaje;
                                $porcentaje = $igv_porcentaje * 100;
                            }
                            $subtotal = $precio_unitario * $cantidad;
                            if($p[6] > 0){
                                $subtotal = $subtotal - $descuento_item;
                            }
                            $id_producto_precio = $p[0];
                            $model->id_venta = $idventa;
                            $model->id_producto_precio = $id_producto_precio;
                            $model->venta_detalle_valor_unitario = $precio_unitario;
                            $model->venta_detalle_precio_unitario = $precio_unitario * $factor_porcentaje;
                            $model->venta_detalle_nombre_producto = $p[1];
                            $model->venta_detalle_cantidad = $cantidad;
                            $model->venta_detalle_total_igv = $igv_detalle;
                            $model->venta_detalle_porcentaje_igv = $porcentaje;
                            $model->venta_detalle_valor_total = $subtotal;
                            $model->venta_detalle_total_price = $subtotal * $factor_porcentaje;
                            $model->venta_detalle_descuento = $descuento_item;

                            $guardar_detalle = $this->ventas->guardar_detalle_venta($model);
                            if($guardar_detalle == 1){
                                $reducir = $cantidad;
                                $id_producto = $this->ventas->listar_id_producto_productoprecio($id_producto_precio);
                                $this->ventas->guardar_stock_nuevo($reducir, $id_producto);
                                $return = 1;
                            } else {
                                $return = 2;
                            }

                            
                        }
                        if($return == 1){
                            $return = $this->ventas->actualizarCorrelativo_x_id_Serie($_POST['serie'],$_POST['correlativo']);

                            //INICIO - LISTAR COLUMNAS PARA TICKET DE VENTA
                            include('libs/ApiFacturacion/phpqrcode/qrlib.php');
                            $venta = $this->ventas->listar_venta($idventa);
                            $detalle_venta =$this->ventas->listar_detalle_ventas($idventa);
                            $empresa = $this->ventas->listar_empresa_x_id_empresa($venta->id_empresa);
                            $cliente = $this->ventas->listar_clienteventa_x_id($venta->id_cliente);
                            //INICIO - CREACION QR
                            $nombre_qr = $empresa->empresa_ruc. '-' .$venta->venta_tipo. '-' .$venta->venta_serie. '-' .$venta->venta_correlativo;
                            $contenido_qr = $empresa->empresa_ruc.'|'.$venta->venta_tipo.'|'.$venta->venta_serie.'|'.$venta->venta_correlativo. '|'.
                                $venta->venta_totaligv.'|'.$venta->venta_total.'|'.date('Y-m-d', strtotime($venta->venta_fecha)).'|'.
                                $cliente->tipodocumento_codigo.'|'.$cliente->cliente_numero;
                            $ruta = 'libs/ApiFacturacion/imagenqr/';
                            $ruta_qr = $ruta.$nombre_qr.'.png';
                            QRcode::png($contenido_qr, $ruta_qr, 'H - mejor', '3');
                            //FIN - CREACION QR
                            if($venta->venta_tipo == "03"){
                                $venta_tipo = "BOLETA DE VENTA ELECTRÓNICA";
                            }elseif($venta->venta_tipo == "01"){
                                $venta_tipo = "FACTURA DE VENTA ELECTRÓNICA";
                            }elseif($venta->venta_tipo == "07"){
                                $venta_tipo = "NOTA DE CRÉDITO ELECTRÓNICA";
                                $motivo = $this->ventas->listar_tipo_notaC_x_codigo($venta->venta_codigo_motivo_nota);
                            }else{
                                $venta_tipo = "NOTA DE DÉBITO ELECTRÓNICA";
                                $motivo = $this->ventas->listar_tipo_notaD_x_codigo($venta->venta_codigo_motivo_nota);

                            }
                            if($cliente->id_tipodocumento == "4"){
                                $cliente_nombre = $cliente->cliente_razonsocial;
                            }else{
                                $cliente_nombre = $cliente->cliente_nombre;
                            }
                            /*if($return == 1){
                                require _VIEW_PATH_ . 'ventas/ticket_pdf.php';
                            }*/
                            $return = 1;
                        }
                    }else {
                        $return = 2;
                    }
                }
            } else {
                //Código 6: Integridad de datos erronea
                $return = 6;
                $message = "Integridad de datos fallida. Algún parametro se está enviando mal";
            }
        }catch (Exception $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $return, "message" => $message, "idventa"=>$idventa)));
    }

    public function search_by_barcode(){
        try{
            if(isset($_POST['product_barcode'])){
                $product = $this->ventas->search_by_barcode($_POST['product_barcode']);
                $result = $product;
                if(empty($result)){
                    $result = 2;
                } else {
                    $result = $result->producto_nombre . '|' . $result->id_medida . '|' . $result->producto_stock . '|' . $result->id_producto_precio . '|' . $result->producto_precio_unidad . '|' . $result->producto_precio_valor . '|' . $result->medida_codigo_unidad . '|' . $result->producto_precio_codigoafectacion;
                }
            } else {
                $result = 2;
            }
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }
    public function consultar_serie_nota(){
        try{
            $concepto = $_POST['concepto'];
            $series = "";
            $correlativo = "";
            if($concepto == "LISTAR_SERIE"){
                $tipo_documento_modificar = $_POST['tipo_documento_modificar'];
                if($tipo_documento_modificar == "01" && $_POST['tipo_venta'] == "07"){
                    $id_serie = 5;
                }elseif($tipo_documento_modificar == "03" && $_POST['tipo_venta'] == "07"){
                    $id_serie = 6;
                }elseif($tipo_documento_modificar == "01" && $_POST['tipo_venta'] == "08"){
                    $id_serie = 7;
                }elseif($tipo_documento_modificar == "03" && $_POST['tipo_venta'] == "08"){
                    $id_serie = 8;
                }
                $series = $this->ventas->listarSerie_NC_x_id($_POST['tipo_venta'], $id_serie);
                /*if($_POST['tipo_venta'] == "07"){
                    $series = $this->pedido->listarSerie_NC_factura($_POST['tipo_venta']);

                    if($tipo_documento_modificar == "01"){
                        $id =
                        $series = $this->pedido->listarSerie_NC_factura($_POST['tipo_venta']);
                    }else{
                        $series = $this->pedido->listarSerie($_POST['tipo_venta']);
                    }
                }else{

                }*/

                //$series = $this->pedido->listarSerie($_POST['tipo_venta']);
            }else{
                $correlativo_ = $this->ventas->listar_correlativos_x_serie($_POST['id_serie']);
                $correlativo = $correlativo_->correlativo + 1;
            }
            //$series = $this->pedido->listarSerie($_POST['tipo_venta']);
        }catch (Exception $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        $respuesta = array("serie" => $series, "correlativo" =>$correlativo);
        echo json_encode($respuesta);
    }
    public function consultar_serie(){
        try{
            $concepto = $_POST['concepto'];
            $series = "";
            $correlativo = "";
            if($concepto == "LISTAR_SERIE"){
                $series = $this->ventas->listarSerie($_POST['tipo_venta']);
            }else{
                $correlativo_ = $this->ventas->listar_correlativos_x_serie($_POST['id_serie']);
                $correlativo = $correlativo_->correlativo + 1;
            }
            //$series = $this->pedido->listarSerie($_POST['tipo_venta']);
        }catch (Exception $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        $respuesta = array("serie" => $series, "correlativo" =>$correlativo);
        echo json_encode($respuesta);
    }
    public function tipo_nota_descripcion(){
        try{
            //$id_producto = $_POST['id_producto'];
            //$result = $this->pedido->listar_precio_producto($id_producto);
            $tipo_comprobante = $_POST['tipo_comprobante'];
            if($tipo_comprobante != ""){
                if($tipo_comprobante == "07"){
                    $dato_nota = $this->ventas->listar_descripcion_segun_nota_credito();
                    $nota = "Tipo Nota de Crédito";
                }else{
                    $dato_nota = $this->ventas->listar_descripcion_segun_nota_debito();
                    $nota = "Tipo Nota de Débito";
                }

                $nota_descripcion = "<label>".$nota."</label>";
                $nota_descripcion .= "<select class='form-control' id='notatipo_descripcion'>";
                foreach ($dato_nota as $dn){
                    $nota_descripcion.= "<option value='".$dn->codigo."'>".$dn->tipo_nota_descripcion."</option>";
                }
                $nota_descripcion .= "</select>";
            }

        }catch (Exception $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode($nota_descripcion);
    }
    public function ticket_electronico(){
        try{

            $id = $_POST['id'];
            //INICIO - LISTAR COLUMNAS PARA TICKET DE VENTA
            include('libs/ApiFacturacion/phpqrcode/qrlib.php');

            $venta = $this->ventas->listar_venta($id);
            $detalle_venta =$this->ventas->listar_detalle_ventas($id);
            $empresa = $this->ventas->listar_empresa_x_id_empresa($venta->id_empresa);
            $cliente = $this->ventas->listar_clienteventa_x_id($venta->id_cliente);
            //INICIO - CREACION QR
            $nombre_qr = $empresa->empresa_ruc. '-' .$venta->venta_tipo. '-' .$venta->venta_serie. '-' .$venta->venta_correlativo;
            $contenido_qr = $empresa->empresa_ruc.'|'.$venta->venta_tipo.'|'.$venta->venta_serie.'|'.$venta->venta_correlativo. '|'.
                $venta->venta_totaligv.'|'.$venta->venta_total.'|'.date('Y-m-d', strtotime($venta->venta_fecha)).'|'.
                $cliente->tipodocumento_codigo.'|'.$cliente->cliente_numero;
            $ruta = 'libs/ApiFacturacion/imagenqr/';
            $ruta_qr = $ruta.$nombre_qr.'.png';
            if (!file_exists($ruta_qr)){
                QRcode::png($contenido_qr, $ruta_qr, 'H - mejor', '3');
            }
            //FIN - CREACION QR
            if($venta->venta_tipo == "03"){
                $venta_tipo = "BOLETA DE VENTA ELECTRÓNICA";
            }elseif($venta->venta_tipo == "01"){
                $venta_tipo = "FACTURA DE VENTA ELECTRÓNICA";
            }elseif($venta->venta_tipo == "07"){
                $venta_tipo = "NOTA DE CRÉDITO ELECTRÓNICA";
                $motivo = $this->ventas->listar_tipo_notaC_x_codigo($venta->venta_codigo_motivo_nota);
            }else{
                $venta_tipo = "NOTA DE DÉBITO ELECTRÓNICA";
                $motivo = $this->ventas->listar_tipo_notaD_x_codigo($venta->venta_codigo_motivo_nota);

            }
            if($cliente->id_tipodocumento == "4"){
                $cliente_nombre = $cliente->cliente_razonsocial;
            }else{
                $cliente_nombre = $cliente->cliente_nombre;
            }
            $result = 1;
            require _VIEW_PATH_ . 'ventas/ticket_electronico.php';

        }catch (Exception $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        echo json_encode(array("result" => array("code" => $result)));

    }
    public function excel_ventas_enviadas(){
        try{
            $usuario_nombre = $this->encriptar->desencriptar($_SESSION['p_n'],_FULL_KEY_);
            $usuario_apellido = $this->encriptar->desencriptar($_SESSION['p_p'],_FULL_KEY_);
            $usuario_materno = $this->encriptar->desencriptar($_SESSION['p_m'],_FULL_KEY_);
            $usuario = $usuario_nombre. ' ' .$usuario_apellido. ' ' .$usuario_materno;

            $tipo_venta = $_GET['tipo_venta'];
            $fecha_ini = $_GET['fecha_inicio'];
            $fecha_fin = $_GET['fecha_final'];

            if($fecha_ini != "" && $fecha_fin != ""){
                $fecha_vacio = "DESDE EL ".date('m-d-Y', strtotime($fecha_ini))." HASTA EL ".date('m-d-Y', strtotime($fecha_fin));
            }else{
                $fecha_vacio = utf8_decode("FECHA SIN LÍMITE");
            }

            $query = "SELECT * FROM ventas v inner join clientes c on v.id_cliente = c.id_cliente inner join monedas mo
                        on v.id_moneda = mo.id_moneda INNER JOIN usuarios u on v.id_usuario = u.id_usuario inner join
                        personas p on u.id_persona = p.id_persona
                        inner join tipo_pago tp on v.id_tipo_pago = tp.id_tipo_pago 
                        where v.venta_estado_sunat = 1 ";
            $select = "";
            $where = true;
            if ($tipo_venta != "") {
                $where = true;
                $select = $select . " and v.venta_tipo = '" . $tipo_venta . "'";
                $tipo_venta_a = $_GET['tipo_venta'];
            }

            if ($fecha_ini != "" and $fecha_fin != "") {
                $where = true;
                $select = $select . " and DATE(v.venta_fecha) between '" . $_GET['fecha_inicio'] . "' and '" . $_GET['fecha_final'] . "'";
                $fecha_ini = $_GET['fecha_inicio'];
                $fecha_fin = $_GET['fecha_final'];
            }

            if ($where) {
                $datos = true;
                $order = " order by v.venta_fecha asc";
                $query = $query . $select . $order;
                $ventas = $this->ventas->listar_ventas($query);
            }

            $fecha_ini = $_GET['fecha_inicio'];
            $fecha_fin = $_GET['fecha_final'];
            $filtro = true;

            if($tipo_venta_a == "03"){
                $tipo_comprobante = "BOLETA";
            }elseif ($tipo_venta_a == "01"){
                $tipo_comprobante = "FACTURA";
            }elseif($tipo_venta_a == "07"){
                $tipo_comprobante = "NOTA DE CRÉDITO";
            }elseif($tipo_venta_a == "08"){
                $tipo_comprobante = "NOTA DE DÉBITO";
            }else{
                $tipo_comprobante = "TODOS";
            }

            $fecha_hoy = date("d-m-y");
            $nombre_excel = 'historial_de_ventas_enviadas' . '_' . $fecha_hoy;

            //creamos el archivo excel
            header( "Content-Type: application/vnd.ms-excel;charset=utf-8");
            header("Content-Disposition: attachment; filename=".$nombre_excel.".xls");
            require _VIEW_PATH_ . 'ventas/excel_ventas_enviadas.php';
        } catch (Exception $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
    }
    public function crear_xml_enviar_sunat(){
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion
            //$ok_data = $this->validar->validar_parametro('id_comanda_detalle', 'POST',true,$ok_data,11,'texto',0);

            //Validacion de datos
            if($ok_data) {
                $id_venta = $_POST['id_venta'];
                $venta = $this->ventas->listar_soloventa_x_id($id_venta);
                $detalle_venta = $this->ventas->listar_detalle_ventas($id_venta);
                $empresa = $this->ventas->listar_empresa_x_id_empresa($venta->id_empresa);
                $cliente = $this->ventas->listar_clienteventa_x_id($venta->id_cliente);
                //$producto = $this->ventas->listar_producto_x_id($detalle_venta->id_producto);
                //ASIGAMOS NOMBRE AL ARCHIVO XML
                $nombre = $empresa->empresa_ruc.'-'.$venta->venta_tipo.'-'.$venta->venta_serie.'-'.$venta->venta_correlativo;
                $ruta = "libs/ApiFacturacion/xml/";
                //validamos el tipo de comprobante para crear su archivo XML
                if($venta->venta_tipo == '01' || $venta->venta_tipo == '03'){
                    $this->generadorXML->CrearXMLFactura($ruta.$nombre, $empresa, $cliente, $venta, $detalle_venta);
                }else{
                    $detalle_venta = $this->ventas->listar_venta_detalle_x_id_venta_venta($id_venta);
                    if ($venta->venta_tipo == '07'){

                        $descripcion_nota = $this->ventas->listar_tipo_notaC_x_codigo($venta->venta_codigo_motivo_nota);
                        $this->generadorXML->CrearXMLNotaCredito($ruta.$nombre, $empresa, $cliente, $venta, $detalle_venta,$descripcion_nota);
                    }else{
                        $descripcion_nota = $this->ventas->listar_tipo_notaD_x_codigo($venta->venta_codigo_motivo_nota);
                        $this->generadorXML->CrearXMLNotaDebito($ruta.$nombre, $empresa, $cliente, $venta, $detalle_venta,$descripcion_nota);
                    }
                }
                //SE PROCEDE A FIRMAR EL XML CREADO
                $result = $this->apiFacturacion->EnviarComprobanteElectronico($empresa,$nombre,"libs/ApiFacturacion/","libs/ApiFacturacion/xml/","libs/ApiFacturacion/cdr/", $id_venta);
                //FIN FACTURACION ELECTRONICA
                if($result == 1){
                    $result = $this->ventas->guardar_estado_de_envio_venta($id_venta, '1', '1');
                }

            }else {
                //Código 6: Integridad de datos erronea
                $result = 6;
                $message = "Integridad de datos fallida. Algún parametro se está enviando mal";
            }
        }catch (Exception $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function crear_enviar_resumen_sunat(){
        //Código de error general
        $result = 1;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion
            //$ok_data = $this->validar->validar_parametro('id_comanda_detalle', 'POST',true,$ok_data,11,'texto',0);

            //Validacion de datos
            if($ok_data) {
                $fecha = $_POST['fecha'];
                $ventas = $this->ventas->listar_venta_x_fecha($fecha, '01');
                //CONTROLAMOS VARIOS ENVIOS EL MISMO DIAS
                $serie = date('Ymd');
                $fila_serie = $this->ventas->listar_serie_resumen('RC');

                //$correlativo = 1;
                if($fila_serie->serie != $serie){
                    //$result = $this->ventas->actualizar_serie_resumen('RC', $serie);
                    $correlativo = 1;
                }else{
                    $correlativo = $fila_serie->correlativo + 1;
                }

                if($result == 1){
                    //$result = $this->ventas->actualizar_correlativo_resumen('RC', $correlativo);
                    if($result == 1){
                        $cabecera = array(
                            "tipocomp"		=>"RC",
                            "serie"			=>$serie,
                            "correlativo"	=>$correlativo,
                            "fecha_emision" =>date('Y-m-d'),
                            "fecha_envio"	=>date('Y-m-d')
                        );
                        //$cabecera = $this->ventas->listar_serie_resumen('RC');
                        $items = $ventas;
                        $ruta = "libs/ApiFacturacion/xml/";
                        $emisor = $this->ventas->listar_empresa_x_id_empresa('1');
                        $nombrexml = $emisor->empresa_ruc.'-'.$cabecera['tipocomp'].'-'.$cabecera['serie'].'-'.$cabecera['correlativo'];

                        //CREAMOS EL XML DEL RESUMEN
                        $this->generadorXML->CrearXMLResumenDocumentos($emisor, $cabecera, $items, $ruta.$nombrexml, $fecha);

                        $result = $this->apiFacturacion->EnviarResumenComprobantes($emisor,$nombrexml,"libs/ApiFacturacion/","libs/ApiFacturacion/xml/");
                        $ticket = $result['ticket'];
                        if($result['result'] == 1){
                            $ruta_xml = $ruta.$nombrexml.'.XML';
                            $guardar_resumen =$this->ventas->guardar_resumen_diario($fecha,$cabecera['serie'],$cabecera['correlativo'],$ruta_xml,'1',$result['mensaje'],$result['ticket']);
                            if($guardar_resumen == 1){
                                if($fila_serie->serie != $serie){
                                    $this->ventas->actualizar_serie_resumen('RC', $serie);
                                    //$correlativo = 1;
                                }
                                //$this->ventas->actualizar_serie_resumen('RC', $serie);
                                $this->ventas->actualizar_correlativo_resumen('RC', $correlativo);
                                $id_resumen = $this->ventas->listar_envio_resumen_x_ticket($result['ticket']);
                                foreach ($items as $i) {
                                    $guardar_resumen_detalle = $this->ventas->guardar_resumen_diario_detalle($id_resumen->id_envio_resumen,$i->id_venta);
                                    if($guardar_resumen_detalle == 1){
                                        if($i->anulado_sunat == "1" && $i->venta_condicion_resumen == "1"){
                                            $result = $this->ventas->guardar_estado_de_envio_venta($i->id_venta, '2', '0');
                                            $this->ventas->editar_venta_condicion_resumen_anulado_x_venta($i->id_venta, '3');
                                        }else{
                                            $result = $this->ventas->guardar_estado_de_envio_venta($i->id_venta, '2', '1');
                                        }
                                    }
                                }
                                if($result == 1){
                                    $result = $this->apiFacturacion->ConsultarTicket($emisor, $cabecera, $ticket,"libs/ApiFacturacion/cdr/", 1);

                                }

                            }
                        }elseif($result['result'] == 4){
                            $message = $result['mensaje'];
                            $result = 4;
                        }elseif($result['result'] == 3){
                            $result = 3;
                        }
                    }
                }


            }else {
                //Código 6: Integridad de datos erronea
                $result = 6;
                $message = "Integridad de datos fallida. Algún parametro se está enviando mal";
            }
        }catch (Exception $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function consultar_ticket_resumen(){
        //Código de error general
        $result = 1;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion
            //$ok_data = $this->validar->validar_parametro('id_comanda_detalle', 'POST',true,$ok_data,11,'texto',0);

            //Validacion de datos
            if($ok_data) {
                $id_resumen = $_POST['id_resumen_diario'];
                $resumen_diario = $this->ventas->listar_resumen_diario_x_id($id_resumen);
                $serie = $resumen_diario->envio_resumen_serie;
                $correlativo = $resumen_diario->envio_resumen_correlativo;
                $ticket = $resumen_diario->envio_resumen_ticket;

                if(!empty($resumen_diario)){
                    //$result = $this->ventas->actualizar_correlativo_resumen('RC', $correlativo);
                    if($result == 1){
                        $cabecera = array(
                            "tipocomp"		=>"RC",
                            "serie"			=>$serie,
                            "correlativo"	=>$correlativo,
                            "fecha_emision" =>date('Y-m-d'),
                            "fecha_envio"	=>date('Y-m-d')
                        );
                        //$cabecera = $this->ventas->listar_serie_resumen('RC');

                        $ruta = "libs/ApiFacturacion/xml/";
                        $emisor = $this->ventas->listar_empresa_x_id_empresa('1');
                        $nombrexml = $emisor->empresa_ruc.'-'.$cabecera['tipocomp'].'-'.$cabecera['serie'].'-'.$cabecera['correlativo'];

                        $result = $this->apiFacturacion->ConsultarTicket($emisor, $cabecera, $ticket,"libs/ApiFacturacion/cdr/", 1);

                    }
                }


            }else {
                //Código 6: Integridad de datos erronea
                $result = 6;
                $message = "Integridad de datos fallida. Algún parametro se está enviando mal";
            }
        }catch (Exception $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function comunicacion_baja(){
        //Código de error general
        $result = 1;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion
            //$ok_data = $this->validar->validar_parametro('id_comanda_detalle', 'POST',true,$ok_data,11,'texto',0);

            //Validacion de datos
            if($ok_data) {
                $id_venta = $_POST['id_venta'];

                //$fecha = $_POST['fecha'];
                //$ventas = $this->ventas->listar_venta_x_fecha($fecha, '03');
                //CONTROLAMOS VARIOS ENVIOS EL MISMO DIAS
                $serie = date('Ymd');
                $fila_serie = $this->ventas->listar_serie_resumen('RA');
                $venta = $this->ventas->listar_venta_x_id($id_venta);

                //$correlativo = 1;
                if($fila_serie->serie != $serie){
                    //$result = $this->ventas->actualizar_serie_resumen('RA', $serie);
                    $correlativo = 1;
                }else{
                    $correlativo = $fila_serie->correlativo + 1;
                }

                if($result == 1){
                    //$result = $this->ventas->actualizar_correlativo_resumen('RA', $correlativo);
                    if($result == 1){
                        $cabecera = array(
                            "tipocomp"		=>"RA",
                            "serie"			=>$serie,
                            "correlativo"	=>$correlativo,
                            "fecha_emision" =>date('Y-m-d'),
                            "fecha_envio"	=>date('Y-m-d')
                        );
                        //$cabecera = $this->ventas->listar_serie_resumen('RA');
                        $items = $venta;
                        $ruta = "libs/ApiFacturacion/xml/";
                        $emisor = $this->ventas->listar_empresa_x_id_empresa('1');
                        $nombrexml = $emisor->empresa_ruc.'-'.$cabecera['tipocomp'].'-'.$cabecera['serie'].'-'.$cabecera['correlativo'];

                        //CREAMOS EL XML DEL RESUMEN
                        $this->generadorXML->CrearXmlBajaDocumentos($emisor, $cabecera, $items, $ruta.$nombrexml);

                        $result = $this->apiFacturacion->EnviarResumenComprobantes($emisor,$nombrexml,"libs/ApiFacturacion/","libs/ApiFacturacion/xml/");
                        $ticket = $result['ticket'];
                        if($result['result'] == 1){
                            $id_user = $this->encriptar->desencriptar($_SESSION['c_u'],_FULL_KEY_);
                            $ruta_xml = $ruta.$nombrexml.'.XML';
                            $guardar_anulacion =$this->ventas->guardar_venta_anulacion(date('Y-m-d', strtotime($venta->venta_fecha)),$cabecera['serie'],$cabecera['correlativo'],$ruta_xml,$result['mensaje'],$id_venta,$id_user,$result['ticket']);
                            if($guardar_anulacion == 1){
                                if($fila_serie->serie != $serie){
                                    $result = $this->ventas->actualizar_serie_resumen('RA', $serie);
                                }
                                $this->ventas->actualizar_correlativo_resumen('RA', $correlativo);
                                $result = $this->ventas->editar_estado_venta_anulado($id_venta);
                                if($result == 1){
                                    $result = $this->apiFacturacion->ConsultarTicket($emisor, $cabecera, $ticket,"libs/ApiFacturacion/cdr/",2);
                                }

                            }
                        }elseif($result['result'] == 4){
                            $result = 4;
                            $message = $result['mensaje'];
                        }elseif($result['result'] == 3){
                            $result = 3;
                        }
                    }
                }


            }else {
                //Código 6: Integridad de datos erronea
                $result = 6;
                $message = "Integridad de datos fallida. Algún parametro se está enviando mal";
            }
        }catch (Exception $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function anular_boleta_cambiarestado(){
        //Código de error general
        $result = 1;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion
            //$ok_data = $this->validar->validar_parametro('id_comanda_detalle', 'POST',true,$ok_data,11,'texto',0);

            //Validacion de datos
            if($ok_data) {
                $id_venta = $_POST['id_venta'];
                $estado = $_POST['estado'];
                $dato = $this->ventas->listar_venta_x_id($id_venta);
                if($dato->venta_tipo == '01'){
                    $result = $this->ventas->actualizar_venta_anulado_factura_sinenviar($id_venta);
                }else{
                    $result = $this->ventas->actualizar_venta_anulado($id_venta,$estado);
                }

            }else {
                //Código 6: Integridad de datos erronea
                $result = 6;
                $message = "Integridad de datos fallida. Algún parametro se está enviando mal";
            }
        }catch (Exception $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function cambiarestado_enviado(){
        //Código de error general
        $result = 1;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion
            //$ok_data = $this->validar->validar_parametro('id_comanda_detalle', 'POST',true,$ok_data,11,'texto',0);

            //Validacion de datos
            if($ok_data) {
                $id_venta = $_POST['id'];
                $venta = $this->ventas->listar_venta($id_venta);
                if ($_POST['accion'] == "1033"){
                    $respuesta = "La Factura numero ".$venta->venta_serie."-".$venta->venta_correlativo.", ha sido aceptada";
                    $result = $this->ventas->actualizar_venta_enviado($id_venta,$respuesta);
                }else if($_POST['accion'] == "1032"){
                    $respuesta = "El comprobante ya esta informado y se encuentra con estado anulado o rechazado";
                    $result = $this->ventas->actualizar_venta_enviado_anulado($id_venta,$respuesta);
                }

            }else {
                //Código 6: Integridad de datos erronea
                $result = 6;
                $message = "Integridad de datos fallida. Algún parametro se está enviando mal";
            }
        }catch (Exception $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
}