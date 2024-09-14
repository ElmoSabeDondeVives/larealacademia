<?php
require 'app/models/Active.php';
require 'app/models/Archivo.php';
require 'app/models/Seminario.php';
class SeminarioController
{
    private $encriptar;
    private $menu;
    private $log;
    private $active;
    private $nav;
    private $validar;
    private $seminario;
    private $archivo;
    public function __construct()
    {
        $this->encriptar = new Encriptar();
        //$this->menu = new Menu();
        $this->log = new Log();
        $this->active = new Active();
        $this->validar = new Validar();
        $this->seminario = new Seminario();
        $this->archivo = new Archivo();

    }
    public function registro(){
        try{
            $this->nav = new Navbar();

            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $seminarios = $this->seminario->list_seminarios();

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'seminario/registro.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function preguntas(){
        try{
            $this->nav = new Navbar();

            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $preguntas = $this->seminario->list_preguntas();

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'seminario/preguntas.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function seminario(){
        try{
            $this->nav = new Navbar();

            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $seminario = $this->seminario->seminario($id);
            $preguntas = $this->seminario->list_pregunta($id);

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'seminario/seminario.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function seminario_pdf(){
        try{
            $this->nav = new Navbar();

            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $seminario = $this->seminario->seminario($id);
            $preguntas = $this->seminario->list_pregunta($id);


            require _VIEW_PATH_ . 'seminario/seminario_pdf.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function respuestas(){
        try{
            $this->nav = new Navbar();

            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $seminario = $this->seminario->seminario($id);
            $preguntas = $this->seminario->list_pregunta($id);

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'seminario/respuestas.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function materias(){
        try{
            $this->nav = new Navbar();

            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $list = $this->seminario->list_mat();


            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'seminario/materias.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function registro_materia(){
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $id_usuario = $this->encriptar->desencriptar($_SESSION['c_u'],_FULL_KEY_);
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion

            $ok_data = $this->validar->validar_parametro('name', 'POST',true,$ok_data,50,'texto',0);

            if($ok_data) {
                //Creamos el modelo y ingresamos los datos a guardar
                $model = new Seminario();
                $model->name = $_POST['name'];
                $model->usuario = $id_usuario;

                //Guardamos el menú y recibimos el resultado
                $result = $this->seminario->save_materia($model);
            }

        } catch (Throwable $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function agregar(){
        try{
            $this->nav = new Navbar();

            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $materias = $this->seminario->list_mat_hab();

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'seminario/agregar.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function guardar(){
        try{
            $this->nav = new Navbar();

            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $materias = $this->seminario->list_mat_hab();


            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'seminario/guardar.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function guardar_pregunta(){
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $id_usuario = $this->encriptar->desencriptar($_SESSION['c_u'],_FULL_KEY_);
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion

            $ok_data = $this->validar->validar_parametro('pregunta', 'POST',true,$ok_data,10000,'texto',0);
            $ok_data = $this->validar->validar_parametro('materia', 'POST',true,$ok_data,10,'numero',0);
            $ok_data = $this->validar->validar_parametro('nivel', 'POST',true,$ok_data,10,'numero',0);
            $ok_data = $this->validar->validar_parametro('alter1', 'POST',true,$ok_data,10000,'texto',0);
            $ok_data = $this->validar->validar_parametro('alter2', 'POST',true,$ok_data,10000,'texto',0);
            $ok_data = $this->validar->validar_parametro('alter3', 'POST',true,$ok_data,10000,'texto',0);
            $ok_data = $this->validar->validar_parametro('alter4', 'POST',true,$ok_data,10000,'texto',0);
            $ok_data = $this->validar->validar_parametro('alter5', 'POST',true,$ok_data,10000,'texto',0);
            $ok_data = $this->validar->validar_parametro('respuesta_', 'POST',true,$ok_data,2,'numero',0);

            if($ok_data) {
                //Creamos el modelo y ingresamos los datos a guardar
                $model = new Seminario();
                $model->pregunta = $_POST['pregunta'];
                $model->materia = $_POST['materia'];
                $model->nivel = $_POST['nivel'];
                $model->a1 = $_POST['alter1'];
                $model->a2 = $_POST['alter2'];
                $model->a3 = $_POST['alter3'];
                $model->a4 = $_POST['alter4'];
                $model->a5 = $_POST['alter5'];
                $model->respuesta = $_POST['respuesta_'];
                $model->usuario = $id_usuario;
                if ($_FILES['imagen']['name'] != null) {
                    //Conseguimos la extension del archivo y especificamos la ruta
                    $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                    $file_path = "media/preguntas/" .str_replace(' ','_', 'pregunta_') . '_' . date('dmYHis') . "." . $ext;
                    //Para subir archivos en general o imagenes sin comprimir
                    //if(move_uploaded_file($_FILES['usuario_imagenp']['tmp_name'], $file_path)){
                    //Para subir imagenes comprimidas
                    if ($this->archivo->subir_imagen_comprimida($_FILES['imagen']['tmp_name'], $file_path, false)) {
                        $model->imagen = $file_path;
                    } else {
                        $model->imagen = '';
                    }
                } else {
                    $model->imagen = '';
                }

                //Guardamos el menú y recibimos el resultado
                $result = $this->seminario->save_pregunta($model);
            }

        } catch (Throwable $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function guardar_seminario(){
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $id_usuario = $this->encriptar->desencriptar($_SESSION['c_u'],_FULL_KEY_);
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion

            $ok_data = $this->validar->validar_parametro('titulo', 'POST',true,$ok_data,10000,'texto',0);

            if($ok_data) {
                $codigo= microtime();
                //Creamos el modelo y ingresamos los datos a guardar
                $save = $this->seminario->save_titulo($_POST['titulo'],$_POST['fecha'],$id_usuario,$codigo,$_POST['nivel']);
                $get_id = $this->seminario->get_id_seminario($codigo);
                if ($get_id->id_seminario){
                    $datos = json_decode($_POST['data']);
                    if($datos){
                        foreach ($datos as $da){
                            foreach ($da as $d){
                               $result= $this->seminario->save_info($get_id->id_seminario, $d->id_pregunta);
                            }
                        }
                    }
                }else{
                    $result=2;
                }
            }

        } catch (Throwable $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function consulta_preguntas(){
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $id_usuario = $this->encriptar->desencriptar($_SESSION['c_u'],_FULL_KEY_);
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion


            if($ok_data) {
                //Creamos el modelo y ingresamos los datos a guardar
                $info = json_decode($_POST['data']);
                $nivel = $_POST['nivel'];
                $data = array();
                $json = new \stdClass();
                foreach ($info as $d){
                    $get_i = $this->seminario->random_preguntas($d->id, $d->cant,$nivel);

                    $data[$d->id] = $get_i;
                }



                //Guardamos el menú y recibimos el resultado
                /*$result = $this->seminario->save_pregunta($model);*/
            }

        } catch (Throwable $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode($data);
    }



}