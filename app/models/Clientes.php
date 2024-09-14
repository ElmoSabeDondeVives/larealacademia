<?php

class Clientes
{
    private $pdo;
    private $log;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    public function guardar($model){
        try{
            if(isset($model->id_cliente)){
                $sql = 'update clientes set
                        cliente_nombre = ?,
                        cliente_razonsocial = ?,
                        id_tipodocumento = ?,
                        cliente_numero = ?,
                        cliente_correo = ?,
                        cliente_direccion = ?,
                        cliente_telefono = ?,
                        cliente_tipo = ?,
                        cliente_horario = ?,
                        id_carrera = ?,
                        cliente_procedencia=?,
                        cliente_num_postulacion=?,
                        cliente_apoderado=?,
                        cliente_apoderado_cel=?,
                        cliente_obs=?
                        where id_cliente = ?';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->cliente_nombre,
                    $model->cliente_razonsocial,
                    $model->id_tipodocumento,
                    $model->cliente_numero,
                    $model->cliente_correo,
                    $model->cliente_direccion,
                    $model->cliente_telefono,
                    $model->id_tipo,
                    $model->id_curso,
                    $model->id_carrera,
                    $model->colegio,
                    $model->postulaciones,
                    $model->apoderado,
                    $model->cel_apoderado,
                    $model->observaciones,
                    $model->id_cliente
                ]);
            }else {
                $sql = 'insert into clientes (cliente_razonsocial, cliente_nombre, id_tipodocumento, cliente_numero, cliente_correo, cliente_direccion, 
                        cliente_telefono, cliente_horario,id_carrera,cliente_procedencia,cliente_num_postulacion,cliente_apoderado,cliente_apoderado_cel,
                      cliente_obs)  values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->cliente_razonsocial,
                    $model->cliente_nombre,
                    $model->id_tipodocumento,
                    $model->cliente_numero,
                    $model->cliente_correo,
                    $model->cliente_direccion,
                    $model->cliente_telefono,
                    $model->horario,
                    $model->id_carrera,
                    $model->colegio,
                    $model->postulaciones,
                    $model->apoderado,
                    $model->cel_apoderado,
                    $model->observaciones,
                ]);
            }
            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }


    public function listar_documentos(){
        try{
            $sql = 'select * from tipo_documentos where tipodocumento_estado = 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_config(){
        try{
            $sql = 'select ac.id as id_horario, ac.descripcion, a.nombre as aula_nombre , t.ingreso, t.salida, m.nombre as modalidad_nombre, ac.estado from aula_config ac inner join aula a on  ac.id_aula= a.id inner join turno t on t.id=ac.id_turno inner join modalidad m on m.id= ac.id_modalidad where ac.estado=0   ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_carreras(){
        try{
            $sql = 'select * from carreras where carrera_estado=0  ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function info_cliente($id){
        try{
            $sql = 'select * from clientes inner join carreras c on clientes.id_carrera = c.id_carrera where id_cliente=?  ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }

    public function listar_clientes(){
        try{
            $sql = 'select * from clientes where cliente_estado = 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }

    public function listar_clientes_editar($id){
        try{
            $sql = 'select * from clientes where id_cliente = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }

    public function eliminar_cliente($id_cliente){
        try{
            $sql = 'delete from clientes where id_cliente = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_cliente]);
            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }
    public function save_foto($id_cliente,$ruta){
        try{
            $sql = 'update clientes set cliente_foto=? where id_cliente = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_cliente,$ruta]);
            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }

    public function listar_cliente_x_numerodoc($doc_numero){
        try{
            $sql = 'select * from clientes where cliente_numero = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$doc_numero]);
            return $stm->fetch();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            return [];
        }
    }

    //Validar dni
    public function validar_dni($cliente_numero){
        try{
            $sql = 'select * from clientes where cliente_numero = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$cliente_numero]);
            $resultado = $stm->fetch();
            (isset($resultado->id_cliente))?$result=true:$result=false;
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function listar_cliente_x_numero($cliente_numero){
        try{
            $sql = 'select * from clientes where cliente_numero = ? and cliente_estado = 1 limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$cliente_numero]);
            $result = $stm->fetch();
            return $result;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }

    //validar dni y cliente
    public function validar_dni_cliente($cliente_numero, $id_cliente){
        try{
            $sql = 'select * from clientes where cliente_numero = ? and id_cliente <> ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$cliente_numero,$id_cliente]);
            $resultado = $stm->fetch();
            (isset($resultado->id_cliente))?$result=true:$result=false;
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    //VALIDACION
    public function validar($id_cliente){
        try{
            $sql = "select * from ventas v inner join clientes c on v.id_cliente = c.id_cliente where v.id_cliente = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_cliente]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    function cambiar_estado_cliente($id_cliente){
        try {
            $sql = "update clientes set
                cliente_estado = 0
                where id_cliente = ?";

            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_cliente
            ]);
            $result = 1;
        }catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

}
