<?php
require 'app/models/Active.php';
require 'app/models/Notas.php';
class NotasController
{
    private $encriptar;
    private $menu;
    private $log;
    private $active;
    private $nav;
    private $validar;
    private $notas;

    public function __construct()
    {
        $this->encriptar = new Encriptar();
        //$this->menu = new Menu();
        $this->log = new Log();
        $this->active = new Active();
        $this->validar = new Validar();
        $this->notas = new Notas();
    }
    /*     --------------------------- Funciones ------------------------------- */
    public function registro(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $config = $this->notas->list_config();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'notas/registro.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function ingreso(){
        try{
            if(!$this->validar->validar_parametro('id', 'GET',true,true,11,'numero',0)){
                throw new Exception('ID no declarado');
            }
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $tipo = $this->notas->tipo_clase($_GET['id']);
            if ($tipo->modalidad_asistencia==1){
                $config = $this->notas->list_alumn_seminario($_GET['id']);
            }else{
            $config = $this->notas->list_alumn($_GET['id']);
            }
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'notas/ingreso.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function alumno(){
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
            require _VIEW_PATH_ . 'notas/alumno.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function notas_pdf(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'], _FULL_KEY_));
            $id = $_GET['id'] ?? 0;
            if ($id == 0) {
                throw new Exception('ID Sin Declarar');
            }
            $aula_c= $this->notas->nombre_aula($_GET['id']);
            $detalles = $this->notas->notas_al($_GET['id']);


            require _VIEW_PATH_ . 'Notas/notas_pdf.php';
        }catch (Throwable $e) {
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"" . _SERVER_ . "\";</script>";
        }
    }
    public function consulta(){
        try{
            if(!$this->validar->validar_parametro('id', 'GET',true,true,11,'numero',0)){
                throw new Exception('ID no declarado');
            }
            $this->nav = new Navbar();
            $eva = $this->notas->list_eva($_GET['id']);
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $evalacion = $_POST['id_evaluacion'];
            $config = $this->notas->list_alumn_eva($evalacion);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'notas/consulta.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function reporte(){
        try{
            if(!$this->validar->validar_parametro('id', 'GET',true,true,11,'numero',0)){
                throw new Exception('ID no declarado');
            }
            $this->nav = new Navbar();

            $alumno = $this->notas->list_eva($_GET['id']);
            $navs = $this->nav->listar_menus($this->encriptar->desencriptar($_SESSION['ru'],_FULL_KEY_));
            $list = $this->notas->cursos($_GET['id']);

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'notas/reporte.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            //En caso de errores insertamos el error generado y redireccionamos a la vista de inicio
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function registro_n(){
        //Código de error general
        $result = 2;
        //Mensaje a devolver en caso de hacer consulta por app
        $message = 'OK';

        try{
            $fecha_e = $_POST['fecha'];
            $concepto = $_POST['concepto'];
            $curso = $_POST['curso'];
            $id_usuario = $this->encriptar->desencriptar($_SESSION['c_u'],_FULL_KEY_);
            $mtk = microtime();
            $ok_data = true;
            $evaluacion = $this->notas->save_evaluacion($curso, $concepto, $id_usuario, $mtk);
            if ($evaluacion==1){
                if($ok_data) {
                    $id_eva = $this->notas->get_id_ev($mtk);
                    $notas = json_decode($_POST['notas']);
                    foreach ($notas as $n){
                        $nota_ = $n->nota;
                        $alumno = $n->id;
                        $result = $this->notas->save($nota_, $alumno, $id_usuario, $fecha_e,$id_eva->id_evaluacion, $curso);
                    }



                }
            }else{
                $result =2 ;
            }


        } catch (Throwable $e){
            //Registramos el error generado y devolvemos el mensaje enviado por PHP
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $message = $e->getMessage();
        }
        //Retornamos el json
        echo json_encode(array("result" => array("code" => $result, "message" => $message)));
    }




}
