<?php
require 'app/models/Active.php';
require 'app/models/Clientes.php';
require 'app/models/Asistencia.php';
require 'app/models/Notas.php';
require 'app/models/Reporte.php';
require 'app/models/Archivo.php';
class ClientesController
{
    private $encriptar;
    private $menu;
    private $log;
    private $active;
    private $nav;
    private $validar;
    private $clientes;
    private $asistencia;
    private $notas;
    private $reporte;
    private $archivo;

    public function __construct()
    {
        $this->encriptar = new Encriptar();
        //$this->menu = new Menu();
        $this->log = new Log();
        $this->active = new Active();
        $this->validar = new Validar();
        $this->archivo = new Archivo();

        $this->clientes = new Clientes();
        $this->asistencia = new Asistencia();
        $this->notas = new Notas();
        $this->reporte = new Reporte();

    }

    public function inicio(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));

            $tipo_documento = $this->clientes->listar_documentos();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'clientes/index.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function agregar(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $horarios = $this->clientes->list_config();
            $carreras = $this->clientes->list_carreras();
            $tipo_documento = $this->clientes->listar_documentos();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'clientes/agregar.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function listar(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $clientes = $this->clientes->listar_clientes();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'clientes/listar.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function editar(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $tipo_documento = $this->clientes->listar_documentos();
            $carreras = $this->clientes->list_carreras();
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $horarios = $this->clientes->list_config();
            //$_SESSION['id_cliente'] = $id;
            $clientes = $this->clientes->listar_clientes_editar($id);

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'clientes/editar.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    //FUNCIONES
    public function guardar_cliente(){
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $ok_data = true;
            //Validacion de datos
            if($ok_data){
                $model = new Clientes();
                if(isset($_POST['id_cliente'])){
                    $validacion = $this->clientes->validar_dni_cliente($_POST['cliente_numero'], $_POST['id_cliente']);
                    $model->id_cliente = $_POST['id_cliente'];
                }else{
                    $validacion = $this->clientes->validar_dni($_POST['cliente_numero']);
                    //Código 5: DNI duplicado
                }
                if($validacion){
                    $result = 5;
                    //$message = "Ya existe un cliente con este Documento de Identidad registrado";
                }else{
                    if($_POST['id_tipodocumento']==4){
                        $model->cliente_razonsocial = $_POST['cliente_razonsocial'];
                        $model->cliente_nombre = "";
                        $model->id_tipodocumento = $_POST['id_tipodocumento'];
                        $model->cliente_numero = $_POST['cliente_numero'];
                        $model->cliente_correo = $_POST['cliente_correo'];
                        $model->cliente_direccion = $_POST['cliente_direccion'];
                        $model->cliente_telefono = $_POST['cliente_telefono'];
                        $model->id_tipo = '';
                        $model->id_curso = '';
                        $model->id_carrera = '';
                        $model->colegio = '';
                        $model->postulaciones = 0;
                        $model->apoderado = '';
                        $model->cel_apoderado = '';
                        $model->observaciones = '';
                        $result = $this->clientes->guardar($model);
                    }else{
                        $model->cliente_razonsocial = "";
                        $model->cliente_nombre = $_POST['cliente_nombre'];
                        $model->id_tipodocumento = $_POST['id_tipodocumento'];
                        $model->cliente_numero = $_POST['cliente_numero'];
                        $model->cliente_correo = $_POST['cliente_correo'];
                        $model->cliente_direccion = $_POST['cliente_direccion'];
                        $model->cliente_telefono = $_POST['cliente_telefono'];
                        $model->horario = $_POST['horario'];
                        $model->id_tipo = $_POST['id_tipo'];
                        $model->id_curso = $_POST['id_curso'];
                        $model->id_carrera = $_POST['id_carrera'];
                        $model->colegio = $_POST['colegio'];
                        if ($_POST['postulaciones']==''){
                            $num_p=0;
                        }else{
                            $num_p=$_POST['postulaciones'];
                        }
                        $model->postulaciones = $num_p;

                        $model->apoderado = $_POST['apoderado'];
                        $model->cel_apoderado = $_POST['cel_apoderado'];
                        $model->observaciones = $_POST['observaciones'];
                        $result = $this->clientes->guardar($model);
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
    public function guardar_foto(){
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $ok_data = true;
            //Validacion de datos
            if($ok_data){
                $id_cliente =$_POST['id_cliente'];
                if ($_FILES['foto_cliente']['name'] != null) {
                    //Conseguimos la extension del archivo y especificamos la ruta
                    $ext = pathinfo($_FILES['foto_cliente']['name'], PATHINFO_EXTENSION);
                    $file_path = "media/alumnos/" .str_replace(' ','_', 'alumno') . '_' . date('dmYHis') . "." . $ext;
                    //Para subir archivos en general o imagenes sin comprimir
                    //if(move_uploaded_file($_FILES['usuario_imagenp']['tmp_name'], $file_path)){
                    //Para subir imagenes comprimidas
                    if ($this->archivo->subir_imagen_comprimida($_FILES['foto_cliente']['tmp_name'], $file_path, false)) {
                        $imagen = $file_path;
                    } else {
                        $imagen = '';
                    }
                } else {
                    $imagen = '';
                }
                $result=$this->clientes->save_foto($id_cliente, $imagen);

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
    public function reporte_g(){
        try{
            if(!$this->validar->validar_parametro('id', 'GET',true,true,11,'numero',0)){
                throw new Exception('ID no declarado');
            }
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $cursos = $this->asistencia->curso_activo($_GET['id']);
            $list = $this->notas->cursos($_GET['id']);
            $config = $this->notas->list_pagos($_GET['id']);
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
            require _VIEW_PATH_ . 'clientes/reporte_g.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function ficha_matricula(){
        try{
            if(!$this->validar->validar_parametro('id', 'GET',true,true,11,'numero',0)){
                throw new Exception('ID no declarado');
            }
            $this->nav = new Navbar();
            $cliente= $this->clientes->info_cliente($_GET['id']);


            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'clientes/ficha_matricula.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function ficha_pdf(){
        try{
            if(!$this->validar->validar_parametro('id', 'GET',true,true,11,'numero',0)){
                throw new Exception('ID no declarado');
            }
            $this->nav = new Navbar();
            $cliente= $this->clientes->info_cliente($_GET['id']);

            require _VIEW_PATH_ . 'clientes/ficha_pdf.php';

        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function eliminar_cliente(){
        $result = 2;
        $message = 'OK';
        try{
            $ok_data = true;
            $ok_data = $this->validar->validar_parametro('id_cliente', 'POST',true,$ok_data,11,'numero',0);
            if($ok_data) {
                $id_cliente = $_POST['id_cliente'];
                $result = $this->clientes->eliminar_cliente($id_cliente);
            } else {
                //Código 6: Integridad de datos erronea
                $result = 6;
                $message = "Integridad de datos fallida. Algún parametro se está enviando mal";
            }
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }

    public function obtener_datos_x_ruc(){
        //Array donde vamos a recetar los cambios, en caso hagamos alguno
        $cliente = [];
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try {
            $ok_data = true;
            $ruc = $_POST['numero_ruc'];
            $buscar_cliente = $this->clientes->listar_cliente_x_numero($ruc);
            if(isset($buscar_cliente->id_cliente)){
                $razon_social	= $buscar_cliente->cliente_razonsocial;
                $estado = "";
                $condicion = "";
                $direccion = $buscar_cliente->cliente_direccion;
            } else {
                $result = json_decode(file_get_contents('https://consultaruc.win/api/ruc/'.$ruc),true);

                $razon_social = $result['result']['razon_social'];
                $estado = $result['result']['estado'];
                $condicion = $result['result']['condicion'];

            }
            $datos = array(
                'razon_social' => $razon_social,
                'estado' => $estado,
                'condicion' => $condicion,
                'direccion' => $direccion,
            );

        } catch (Exception $e) {
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $message = $e->getMessage();
            $result= [];
        }
        //Retornamos el json
        echo json_encode(array("result" => $datos));
    }

    public function obtener_datos_x_dni(){
        //Array donde vamos a recetar los cambios, en caso hagamos alguno
        $cliente = [];
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try {
            $ok_data = true;
            $dni = $_POST['numero_dni'];
            $buscar_cliente = $this->clientes->listar_cliente_x_numero($_POST['numero_dni']);
            if(isset($buscar_cliente->id_cliente)){
                $dni	= $buscar_cliente->cliente_numero;
                $nombre = $buscar_cliente->cliente_nombre;
                $paterno = "";
                $materno = "";
                $direccion = $buscar_cliente->cliente_direccion;
            } else {
                /*$ws = "https://dni.optimizeperu.com/api/persons/$dni?format=json";
                $header = array();

                $ch = curl_init();
                curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,1);
                curl_setopt($ch,CURLOPT_URL,$ws);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                curl_setopt($ch,CURLOPT_HTTPAUTH,CURLAUTH_ANY);
                curl_setopt($ch,CURLOPT_TIMEOUT,30);
                curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
                //para ejecutar los procesos de forma local en windows
                //enlace de descarga del cacert.pem https://curl.haxx.se/docs/caextract.html
                curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__)."/../models/cacert.pem");

                $datos = curl_exec($ch);
                curl_close($ch);
                $datos = json_decode($datos);*/
                $result = json_decode(file_get_contents('https://consultaruc.win/api/dni/'.$dni),true);

                //var_dump($result);

                $dni	= $result['result']['DNI'];
                $nombre = $result['result']['Nombre'];
                $paterno = $result['result']['Paterno'];
                $materno = $result['result']['Materno'];
                $direccion = "";
                //echo $result['result']['estado'];
            }

            $datos = array(
                'dni' => $dni,
                'name' => $nombre,
                'first_name' => $paterno,
                'last_name' => $materno,
                'direccion' => $direccion,
            );

            //$datos = json_decode($datos);

        } catch (Exception $e) {
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => $datos));
    }
    public function obtener_datos_cliente(){
        //Array donde vamos a recetar los cambios, en caso hagamos alguno
        $cliente = [];
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try {
            $ok_data = true;
            $buscar_cliente = $this->clientes->listar_cliente_x_numero($_POST['numero']);
            if(!empty($buscar_cliente)){
                $dni	= $buscar_cliente->cliente_numero;
                if($buscar_cliente->id_tipodocumento == 4){
                    $nombre = $buscar_cliente->cliente_razonsocial;
                }else{
                    $nombre = $buscar_cliente->cliente_nombre;
                }
                $paterno = "";
                $materno = "";
                $direccion = $buscar_cliente->cliente_direccion;
                $result = 1;
            } else {

                $result = 2;

                $dni	= '';
                $nombre = '';
                $paterno = '';
                $materno = '';
                $direccion = "";
                //echo $result['result']['estado'];
            }

            $datos = array(
                'dni' => $dni,
                'name' => $nombre,
                'first_name' => $paterno,
                'last_name' => $materno,
                'direccion' => $direccion,
                'resultado' => $result,
            );

            //$datos = json_decode($datos);

        } catch (Exception $e) {
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => $datos));
    }

    function cambiar_estado_cliente(){
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion
            $ok_data = $this->validar->validar_parametro('id_cliente', 'POST',true,$ok_data,11,'texto',0);
            //Validacion de datos
            if($ok_data) {
                $id_cliente = $_POST['id_cliente'];
                $result = $this->clientes->cambiar_estado_cliente($id_cliente);

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