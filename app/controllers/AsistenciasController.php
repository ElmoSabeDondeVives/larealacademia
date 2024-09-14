<?php
require 'app/models/Active.php';
require 'app/models/Asistencia.php';
require 'app/models/Ventas.php';
require 'app/models/Clientes.php';
require 'app/models/Turno.php';
require 'app/models/Nmletras.php';
require 'app/models/ApiFacturacion.php';
require 'app/models/GeneradorXML.php';
class AsistenciasController {
    private $encriptar;
    private $menu;
    private $log;
    private $active;
    private $nav;
    private $validar;
    private $asistencia;
    private $ventas;
    private $clientes;
    private $turno;
    private $apiFacturacion;
    private $numLetra;
    private $generadorXML;
    public function __construct()
    {
        $this->encriptar = new Encriptar();
        //$this->menu = new Menu();
        $this->log = new Log();
        $this->active = new Active();
        $this->validar = new Validar();
        $this->asistencia = new Asistencia();
        $this->ventas = new Ventas();
        $this->clientes = new Clientes();
        $this->turno = new Turno();
        $this->generadorXML= new GeneradorXML();
        $this->apiFacturacion= new ApiFacturacion();
        $this->numLetra = new Nmletras();

    }
    /*   Funciones de vista de Asistencia  */
    public function salida(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $list= $this->asistencia->list_salida();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'asistencia/salida.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function registro(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $list= $this->asistencia->list_ingreso();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'asistencia/registro.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function registro_d(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $modalidad = $this->asistencia->list_mod_hab();
            $conceptos = $this->asistencia->list_products();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'asistencia/registro_d.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }




    /* Funcione de CRUD */
    public function search_clases(){
        try{
            $id = $_POST['id'];
            $result = $this->asistencia->list_clases_hab($id);

        }catch (Exception $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        $data = array("result" => $result);
        echo json_encode($data);
    }

    public function existencia_cliente(){
        try{
            $num = $_POST['id'];
            $dat = $this->asistencia->search_clientes($num);
            if ($dat){
                $result=1;
            }else{
                $result =2;
            }

        }catch (Exception $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        $data = array("result" => $result);
        echo json_encode($data);
    }
    public function reporte_personal(){
        try{
            if(!$this->validar->validar_parametro('id', 'GET',true,true,11,'numero',0)){
                throw new Exception('ID no declarado');
            }
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $cursos = $this->asistencia->curso_activo($_GET['id']);
            $asistencias = $this->asistencia->seminarios($_GET['id']);
            if ($cursos){
                $a=0;
                $dias = explode('/',$cursos->aula_dias);
                $data=array();
                $cont=0;
                foreach ($dias as $d ){
                    if ($d == 0){
                        continue;
                    }else{
                        $data[$cont]["dia"]=$d;
                        $data[$cont]["fecha"]= $this->asistencia->get_days($cursos->aula_fecha_ini, $cursos->aula_fecha_fin, $d);
                    }
                    $cont++;
                }

            }



            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'asistencia/reporte_personal.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function reporte_docente(){
        try{
            if(!$this->validar->validar_parametro('id', 'GET',true,true,11,'numero',0)){
                throw new Exception('ID no declarado');
            }
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $list= $this->asistencia->reporte_docente($_GET['id']);


            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'asistencia/reporte_docente.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function registro_a(){
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $id_usuario = $this->encriptar->desencriptar($_SESSION['c_u'],_FULL_KEY_);
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion

            $ok_data = $this->validar->validar_parametro('id', 'POST',true,$ok_data,10,'numero',0);

            if($ok_data) {

                $id_cliente = $this->asistencia->search_cliente($_POST['id']);
                if ($id_cliente){
                    /*  Buscar Registro con la fecha de hoy */
                    $registro = $this->asistencia->buscar_registro($id_cliente->id_cliente);
                    if (!$registro ){
                        /* Buscar Horario */

                        if ($id_cliente->cliente_horario !=null){
                            if ($id_cliente->cliente_tipo==0){
                                /*  registro de asistencia de alumnos */
                                $fecha = date('Y-m-d H:i:s');
                                $hora = date('H:i');
                                $horario  = $this->asistencia->buscar_horario($id_cliente->cliente_horario);
                                $nuevahora = strtotime ( '+15 minute' , strtotime($horario->ingreso) ) ;
                                $nuevahora= date('H:i:s',$nuevahora);
                                if ($hora < $nuevahora){
                                    $model = new Asistencia();
                                    $model->id_alumno = $id_cliente->id_cliente;
                                    $model->fecha = $fecha;
                                    $model->estado = 0;
                                    $model->usuario= $id_usuario;

                                    $result = $this->asistencia->guardar_asistencia($model);
                                }else{
                                    $model = new Asistencia();
                                    $model->id_alumno = $id_cliente->id_cliente;
                                    $model->fecha = $fecha;
                                    $model->estado = 1;
                                    $model->usuario= $id_usuario;

                                    $result = $this->asistencia->guardar_asistencia($model);

                                }
                            }else{
                                /* Registro de asistencia de Docentes */
                                $fecha = date('Y-m-d H:i:s');
                                $model = new Asistencia();
                                $model->id_alumno = $id_cliente->id_cliente;
                                $model->fecha = $fecha;
                                $model->estado = 0;
                                $model->usuario= $id_usuario;

                                $result = $this->asistencia->guardar_asistencia_doc($model);
                            }


                            //Guardamos el menú y recibimos el resultado

                        }
                    }else{
                        $result=8;
                    }


                }
                //Creamos el modelo y ingresamos los datos a guardar

            }

        } catch (Throwable $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function reporte(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            if (isset($_POST['validate'])){
                $data = true;

            }else{
                $data= false;
            }
            $text=$_POST['data_al'];
            $config = $this->asistencia->buscar_alumno($text);

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'asistencia/reporte.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function registro_doc(){
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $id_usuario = $this->encriptar->desencriptar($_SESSION['c_u'],_FULL_KEY_);
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion

            $ok_data = $this->validar->validar_parametro('id', 'POST',true,$ok_data,10,'numero',0);

            if($ok_data) {

                $id_cliente = $this->asistencia->search_cliente($_POST['id']);
                if ($id_cliente){
                    /*  Buscar Registro con la fecha de hoy */
                    $registro = $this->asistencia->buscar_registro_asis($id_cliente->id_cliente);
                    if ($registro ){
                        /* Buscar Horario */
                        $result= $this->asistencia->marcar_salida($id_cliente->id_cliente);
                    }else{
                        $result=8;
                    }


                }
                //Creamos el modelo y ingresamos los datos a guardar

            }

        } catch (Throwable $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function registro_xdia(){
        //Código de error general
        $result = 2;
        $fecha=date('Y-m-d H:i:s');
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $id_usuario = $this->encriptar->desencriptar($_SESSION['c_u'],_FULL_KEY_);
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion

            $ok_data = $this->validar->validar_parametro('id', 'POST',true,$ok_data,10,'numero',0);
            $ok_data = $this->validar->validar_parametro('id_producto', 'POST',true,$ok_data,10,'numero',0);

            if($ok_data) {
                if ($_POST['tipo'] == 1) {
                    $registrar = $this->asistencia->registrar_cliente($_POST['id'], $_POST['nombre']);
                    if ($registrar) {
                        $id_cliente = $this->asistencia->search_cliente($_POST['id']);
                        if ($id_cliente) {
                            /*  Buscar Registro con la fecha de hoy */
                            $registro = false;
                            if (!$registro) {
                                if ($id_cliente->cliente_horario == null) {
                                        $model = new Asistencia();
                                        $model->id_alumno = $id_cliente->id_cliente;
                                        $model->fecha = $fecha;
                                        $model->estado = 0;
                                        $model->usuario = $id_usuario;
                                        $model->clase = $_POST['clase'];

                                        $result = $this->asistencia->guardar_asistencia_sms($model);

                                } else {
                                    $result = 8;
                                }


                            } else {
                                $result = 8;
                            }

                        }
                    }
                }else if($_POST['tipo'] == 2){
                    $id_cliente = $this->asistencia->search_cliente($_POST['id']);
                    $cosnulta_e = $this->asistencia->data_as($_POST['id'],$_POST['clase']);
                    if ($cosnulta_e==2){
                        if ($id_cliente) {
                            $registro = false;
                            if (!$registro) {
                                $model = new Asistencia();
                                $model->id_alumno = $id_cliente->id_cliente;
                                $model->fecha = $fecha;
                                $model->estado = 0;
                                $model->usuario = $id_usuario;
                                $model->clase = $_POST['clase'];
                                $result = $this->asistencia->guardar_asistencia($model);

                            } else {
                                $result = 8;
                            }
                        }
                    }else{
                        $result= 8;
                    }

                }
                if ($_POST['cobro']==1){
                    if ($result == 1) {
                        /* Realizar Pago Por concepto  */
                        $data_product = $this->ventas->producto_precio($_POST['id_producto']);
                        $consulta_cliente = $this->clientes->listar_cliente_x_numerodoc($_POST['id']);
                        $id_turno = $this->turno->listar();
                        $model->id_cliente = $consulta_cliente->id_cliente;
                        $model->id_usuario = $this->encriptar->desencriptar($_SESSION['c_u'], _FULL_KEY_);
                        $model->id_cliente = $consulta_cliente->id_cliente;;
                        $model->id_turno = $id_turno->id_turno;
                        $model->id_tipo_pago = 3;
                        $model->venta_tipo_moneda = 1;
                        $model->venta_tipo_envio = 0;
                        $model->venta_tipo = '03';
                        $producto_venta_fecha = date("Y-m-d H:i:s");
                        $serie_ = $this->ventas->listar_correlativos_x_serie(3);
                        $model->venta_serie = $serie_->serie;
                        $model->venta_correlativo = $serie_->correlativo + 1;
                        $model->producto_venta_des_global = 0;
                        $model->producto_venta_totalgratuita = 0;
                        $model->producto_venta_totalexonerada = $data_product->producto_precio_valor;
                        $model->producto_venta_totalinafecta = 0;
                        $model->producto_venta_totalgravada = 0;
                        $model->producto_venta_totaligv = 0;
                        $model->producto_venta_des_total = 0;
                        $model->producto_venta_icbper = 0;
                        $model->producto_venta_total = $data_product->producto_precio_valor;
                        $model->producto_venta_pago = 0;
                        $model->producto_venta_vuelto = 0;
                        $model->producto_venta_fecha = $producto_venta_fecha;
                        $model->tipo_documento_modificar = '';
                        $model->serie_modificar = '';
                        $model->numero_modificar = '';
                        $model->notatipo_descripcion = '';
                        $model->id_clase = $_POST['clase'];

                        $guardar = $this->ventas->guardar_venta($model);
                        if ($guardar == 1) {
                            $id_cliente = $consulta_cliente->id_cliente;
                            $jalar_id = $this->ventas->jalar_id_venta($producto_venta_fecha, $id_cliente);
                            $idventa = $jalar_id->id_venta;
                            if ($idventa != 0) {
                                //despues de registrar la venta se sigue a registrar el detalle
                                $model->id_venta = $idventa;
                                $model->id_producto_precio = $data_product->id_producto_precio;
                                $model->venta_detalle_valor_unitario = $data_product->producto_precio_valor;
                                $model->venta_detalle_precio_unitario = $data_product->producto_precio_valor;
                                $model->venta_detalle_nombre_producto = $data_product->producto_nombre;
                                $model->venta_detalle_cantidad = 1;
                                $model->venta_detalle_total_igv = 0;
                                $model->venta_detalle_porcentaje_igv = 0;
                                $model->venta_detalle_valor_total = $data_product->producto_precio_valor;
                                $model->venta_detalle_total_price =$data_product->producto_precio_valor;
                                $model->venta_detalle_descuento = 0;
                                $guardar_detalle = $this->ventas->guardar_detalle_venta($model);
                                if ($guardar_detalle == 1) {
                                    $return = 1;
                                } else {
                                    $return = 2;
                                }
                                if ($return == 1) {
                                    $return = $this->ventas->actualizarCorrelativo_x_id_Serie($serie_->id_serie, $serie_->correlativo + 1);

                                    //INICIO - LISTAR COLUMNAS PARA TICKET DE VENTA
                                    include('libs/ApiFacturacion/phpqrcode/qrlib.php');
                                    $venta = $this->ventas->listar_venta($idventa);
                                    $detalle_venta = $this->ventas->listar_detalle_ventas($idventa);
                                    $empresa = $this->ventas->listar_empresa_x_id_empresa($venta->id_empresa);
                                    $cliente = $this->ventas->listar_clienteventa_x_id($venta->id_cliente);
                                    //INICIO - CREACION QR
                                    $nombre_qr = $empresa->empresa_ruc . '-' . $venta->venta_tipo . '-' . $venta->venta_serie . '-' . $venta->venta_correlativo;
                                    $contenido_qr = $empresa->empresa_ruc . '|' . $venta->venta_tipo . '|' . $venta->venta_serie . '|' . $venta->venta_correlativo . '|' .
                                        $venta->venta_totaligv . '|' . $venta->venta_total . '|' . date('Y-m-d', strtotime($venta->venta_fecha)) . '|' .
                                        $cliente->tipodocumento_codigo . '|' . $cliente->cliente_numero;
                                    $ruta = 'libs/ApiFacturacion/imagenqr/';
                                    $ruta_qr = $ruta . $nombre_qr . '.png';
                                    QRcode::png($contenido_qr, $ruta_qr, 'H - mejor', '3');
                                    //FIN - CREACION QR
                                    if ($venta->venta_tipo == "03") {
                                        $venta_tipo = "BOLETA DE VENTA ELECTRÓNICA";
                                    } elseif ($venta->venta_tipo == "01") {
                                        $venta_tipo = "FACTURA DE VENTA ELECTRÓNICA";
                                    } elseif ($venta->venta_tipo == "07") {
                                        $venta_tipo = "NOTA DE CRÉDITO ELECTRÓNICA";
                                        $motivo = $this->ventas->listar_tipo_notaC_x_codigo($venta->venta_codigo_motivo_nota);
                                    } else {
                                        $venta_tipo = "NOTA DE DÉBITO ELECTRÓNICA";
                                        $motivo = $this->ventas->listar_tipo_notaD_x_codigo($venta->venta_codigo_motivo_nota);

                                    }
                                    if ($cliente->id_tipodocumento == "4") {
                                        $cliente_nombre = $cliente->cliente_razonsocial;
                                    } else {
                                        $cliente_nombre = $cliente->cliente_nombre;
                                    }
                                    if($return == 1){
                                        require _VIEW_PATH_ . 'ventas/ticket_dia.php';
                                    }
                                }


                            }

                        } else {
                            $return = 2;
                        }

                    }
                }







            }

        }catch (Throwable $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }












}
