<?php
require 'app/models/Active.php';
require 'app/models/Aula.php';
require 'app/models/Funciones.php';
class AulaController
{
    private $encriptar;
    private $funciones;
    private $menu;
    private $log;
    private $active;
    private $nav;
    private $validar;
    private $aula;
    public function __construct()
    {
        $this->encriptar = new Encriptar();
        //$this->menu = new Menu();
        $this->log = new Log();
        $this->active = new Active();
        $this->validar = new Validar();
        $this->aula = new Aula();
        $this->funciones = new Funciones();

    }
    /*Funciones de Vistas */

    public function registro(){
        try{
            $this->nav = new Navbar();

            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $config = $this->aula->list_config();
            $la = $this->aula->list_aula_hab();
            $lt = $this->aula->list_turno_hab();
            $lti = $this->aula->list_tipo_hab();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'aula/registro.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function consulta(){
        try{
            $this->nav = new Navbar();

            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $config = $this->aula->list_config();
            $la = $this->aula->list_aula_hab();
            $lt = $this->aula->list_turno_hab();
            $lti = $this->aula->list_tipo_hab();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'aula/consulta.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function registro_aula(){
        try{
            $list = $this->aula->list_aula();
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'aula/registro_aula.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function registro_turno(){
        try{
            $list = $this->aula->list_turno();
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'aula/registro_turno.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function registro_tipo(){
        try{
            $list = $this->aula->list_tipo();
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'aula/registro_tipo.php';
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

            $ok_data = $this->validar->validar_parametro('name', 'POST',true,$ok_data,50,'texto',0);

            if($ok_data) {
                //Creamos el modelo y ingresamos los datos a guardar
                $model = new Aula();
                $model->name = $_POST['name'];
                $model->usuario = $id_usuario;

                //Guardamos el menú y recibimos el resultado
                $result = $this->aula->save_aula($model);
            }

        } catch (Throwable $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function registro_t(){
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $id_usuario = $this->encriptar->desencriptar($_SESSION['c_u'],_FULL_KEY_);
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion

            $ok_data = $this->validar->validar_parametro('ingreso', 'POST',true,$ok_data,50,'texto',0);
            $ok_data = $this->validar->validar_parametro('salida', 'POST',true,$ok_data,50,'texto',0);

            if($ok_data) {
                //Creamos el modelo y ingresamos los datos a guardar
                $model = new Aula();
                $model->ingreso = $_POST['ingreso'];
                $model->salida = $_POST['salida'];
                $model->usuario = $id_usuario;

                //Guardamos el menú y recibimos el resultado
                $result = $this->aula->save_turno($model);
            }

        } catch (Throwable $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function edit_turno(){
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $id_usuario = $this->encriptar->desencriptar($_SESSION['c_u'],_FULL_KEY_);
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion

            $ok_data = $this->validar->validar_parametro('ingreso', 'POST',true,$ok_data,50,'texto',0);
            $ok_data = $this->validar->validar_parametro('salida', 'POST',true,$ok_data,50,'texto',0);

            if($ok_data) {
                //Creamos el modelo y ingresamos los datos a guardar
                $table = 'turno';
                $campos = array(
                    'ingreso'=>$_POST['ingreso'],
                    'salida'=>$_POST['salida'],
                    'estado'=>$_POST['estado']
                );
                $cond = array(
                    'id'=>$_POST['id']
                );
                //Guardamos el menú y recibimos el resultado
                $result = $this->funciones->update($table,$campos,$cond);
            }

        } catch (Throwable $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function edit_aula(){
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $id_usuario = $this->encriptar->desencriptar($_SESSION['c_u'],_FULL_KEY_);
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion

            $ok_data = $this->validar->validar_parametro('name', 'POST',true,$ok_data,250,'texto',0);
            $ok_data = $this->validar->validar_parametro('id', 'POST',true,$ok_data,10,'numero',0);

            if($ok_data) {
                //Creamos el modelo y ingresamos los datos a guardar
                $table = 'aula';
                $campos = array(
                    'nombre'=>$_POST['name'],
                    'estado'=>$_POST['estado']
                );
                $cond = array(
                    'id'=>$_POST['id']
                );
                //Guardamos el menú y recibimos el resultado
                $result = $this->funciones->update($table,$campos,$cond);
            }

        } catch (Throwable $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function registro_ti(){
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $id_usuario = $this->encriptar->desencriptar($_SESSION['c_u'],_FULL_KEY_);
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion

            $ok_data = $this->validar->validar_parametro('modalidad', 'POST',true,$ok_data,50,'texto',0);

            if($ok_data) {
                //Creamos el modelo y ingresamos los datos a guardar
                $model = new Aula();
                $model->nombre = $_POST['nombre'];
                $model->asistencia = $_POST['asistencia'];

                $model->usuario = $id_usuario;

                //Guardamos el menú y recibimos el resultado
                $result = $this->aula->save_tipo($model);
            }

        } catch (Throwable $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function registro_ti_edit(){
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
            $ok_data = $this->validar->validar_parametro('modalidad', 'POST',true,$ok_data,50,'texto',0);

            if($ok_data) {
                //Creamos el modelo y ingresamos los datos a guardar
                $model = new Aula();
                $model->id = $_POST['id'];
                $model->estado = $_POST['estado'];
                $model->nombre = $_POST['nombre'];
                $model->asistencia = $_POST['asistencia'];

                $model->usuario = $id_usuario;

                //Guardamos el menú y recibimos el resultado
                $result = $this->aula->save_tipo_edit($model);
            }

        } catch (Throwable $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function delete_i(){
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
                //Creamos el modelo y ingresamos los datos a guardar
                $model = new Aula();
                $model->id = $_POST['id'];


                //Guardamos el menú y recibimos el resultado
                $result = $this->aula->delete_i($model);
            }

        } catch (Throwable $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function registro_config(){
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $id_usuario = $this->encriptar->desencriptar($_SESSION['c_u'],_FULL_KEY_);
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion

            $ok_data = $this->validar->validar_parametro('aula', 'POST',true,$ok_data,10,'numero',0);
            $ok_data = $this->validar->validar_parametro('tipo', 'POST',true,$ok_data,10,'numero',0);
            $ok_data = $this->validar->validar_parametro('moda', 'POST',true,$ok_data,10,'numero',0);
            $ok_data = $this->validar->validar_parametro('descrip', 'POST',true,$ok_data,100,'texto',0);

            if($ok_data) {
                //Creamos el modelo y ingresamos los datos a guardar
                $model = new Aula();
                $model->aula = $_POST['aula'];
                $model->turno = $_POST['turno'];
                $model->modalidad = $_POST['moda'];
                $model->descripcion = $_POST['descrip'];
                $model->usuario = $id_usuario;
                $model->fecha_ini = $_POST['fecha_ini'];
                $model->fecha_fin = $_POST['fecha_fin'];
                $model->fechas = $_POST['total'];

                //Guardamos el menú y recibimos el resultado
                $result = $this->aula->save_cofig($model);
            }

        } catch (Throwable $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function edit_config(){
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';
        try{
            $id_usuario = $this->encriptar->desencriptar($_SESSION['c_u'],_FULL_KEY_);
            $ok_data = true;
            //Validamos que todos los parametros a recibir sean correctos. De ocurrir un error de validación,
            //$ok_true se cambiará a false y finalizara la ejecucion de la funcion

            $ok_data = $this->validar->validar_parametro('aula', 'POST',true,$ok_data,10,'numero',0);
            $ok_data = $this->validar->validar_parametro('tipo', 'POST',true,$ok_data,10,'numero',0);
            $ok_data = $this->validar->validar_parametro('moda', 'POST',true,$ok_data,10,'numero',0);
            $ok_data = $this->validar->validar_parametro('descrip', 'POST',true,$ok_data,100,'texto',0);

            if($ok_data) {
                $table ='aula_config';
                //Creamos el modelo y ingresamos los datos a guardar

                $camps = array(
                    'id_aula'=>$_POST['aula'],
                    'id_turno'=>$_POST['turno'],
                    'id_modalidad'=>$_POST['moda'],
                    'descripcion'=>$_POST['descrip'],
                    'aula_dias'=>$_POST['total'],
                    'aula_fecha_ini'=>$_POST['fecha_ini'],
                    'aula_fecha_fin'=>$_POST['fecha_fin'],
                    'estado'=>$_POST['estado'],
                );
                $cond = array(
                    'id'=> $_POST['id_c']
                );

                //Guardamos el menú y recibimos el resultado
                $result = $this->funciones->update($table,$camps,$cond);
            }

        } catch (Throwable $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }
    public function consulta_d(){
        try{
            if(!$this->validar->validar_parametro('id', 'GET',true,true,11,'numero',0)){
                throw new Exception('ID no declarado');
            }else{
                $this->nav = new Navbar();
                if (isset($_POST['validate'])){
                    $fecha_b = $_POST['fecha_b'];

                }else{
                    $fecha_b= date('Y-m-d');
                }
                $lista = $this->aula->lista_asistencia($fecha_b,$_GET['id']);

                $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
                require _VIEW_PATH_ . 'header.php';
                require _VIEW_PATH_ . 'navbar.php';
                require _VIEW_PATH_ . 'Aula/consulta_d.php';
                require _VIEW_PATH_ . 'footer.php';
            }

        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function consulta_pdf(){
        try{
            if(!$this->validar->validar_parametro('id', 'GET',true,true,11,'numero',0)){
                throw new Exception('ID no declarado');
            }else{
                $this->nav = new Navbar();
                if (isset($_POST['validate'])){
                    $fecha_b = $_POST['fecha_b'];

                }else{
                    $fecha_b= date('Y-m-d');
                }
                $aula= $this->aula->aula_data($_GET['id']);
                $lista = $this->aula->lista_asistencia($fecha_b,$_GET['id']);

                $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));

                require _VIEW_PATH_ . 'Aula/consulta_pdf.php';

            }

        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

}