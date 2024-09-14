<?php


class Aula
{
    private $log;

    public function __construct()
    {
        $this->log = new Log();
        $this->pdo = Database::getConnection();
    }
    public function save_aula($model){
        $fecha_actual = date('Y-m-d H:i:s');
        try{

                $sql = 'insert into aula (nombre, creacion, estado, usuario) values (?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->name,
                    $fecha_actual,
                    0,
                    $model->usuario
                ]);

            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }
    public function save_turno($model){
        $fecha_actual = date('Y-m-d H:i:s');
        try{

                $sql = 'insert into turno (ingreso, salida, creacion, estado,usuario) values (?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->ingreso,
                    $model->salida,
                    $fecha_actual,
                    0,
                    $model->usuario
                ]);

            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }
    public function save_tipo($model){
        $fecha_actual = date('Y-m-d H:i:s');
        try{

                $sql = 'insert into modalidad (nombre, creacion, estado,usuario,modalidad_asistencia) values (?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->nombre,
                    $fecha_actual,
                    0,
                    $model->usuario,
                    $model->asistencia
                ]);

            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }
    public function save_tipo_edit($model){
        $fecha_actual = date('Y-m-d H:i:s');
        try{

                $sql = 'update   modalidad set nombre =?, estado =?,usuario=?,modalidad_asistencia=? where modalidad.id =?';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->nombre,
                    $model->estado,
                    $model->usuario,
                    $model->asistencia,
                    $model->id
                ]);

            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }
    public function delete_i($model){
        $fecha_actual = date('Y-m-d H:i:s');
        try{

                $sql = 'update  modalidad set  estado =1 where modalidad.id =?';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id
                ]);

            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }
    public function save_cofig($model){
        $fecha_actual = date('Y-m-d H:i:s');
        try{

                $sql = 'insert into aula_config (id_aula, id_turno, id_modalidad,descripcion, creacion,estado,usuario,aula_fecha_ini,aula_fecha_fin,aula_dias) values (?,?,?,?,?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->aula,
                    $model->turno,
                    $model->modalidad,
                    $model->descripcion,
                    $fecha_actual,
                    0,
                    $model->usuario,
                    $model->fecha_ini,
                    $model->fecha_fin,
                    $model->fechas

                ]);

            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }
    public function list_aula(){
        try{
            $sql = 'select * from aula ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function aula_data($id){
        try{
            $sql = 'select * from aula_config where id=? ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_aula_hab(){
        try{
            $sql = 'select * from aula where aula.estado=0 ';
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
            $sql = 'select ac.descripcion, a.nombre as aula_nombre , t.ingreso, t.salida, m.nombre as modalidad_nombre, ac.estado, ac.id as id_aula, m.id as id_modalidad, t.id as id_turno , ac.aula_fecha_ini, ac.aula_fecha_fin, ac.aula_dias from aula_config ac inner join aula a on  ac.id_aula= a.id inner join turno t on t.id=ac.id_turno inner join modalidad m on m.id= ac.id_modalidad  order by ac.id desc ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_tipo(){
        try{
            $sql = 'select * from modalidad ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function lista_asistencia($fecha, $id){
        try{
            $sql = 'select * from asistencias a inner join clientes c on c.id_cliente=a.id_alumno where c.cliente_horario=? and date(a.asistencia_creacion) = ? ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id,$fecha]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_tipo_hab(){
        try{
            $sql = 'select * from modalidad where modalidad.estado=0 ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_turno(){
        try{
            $sql = 'select * from turno ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_turno_hab(){
        try{
            $sql = 'select * from turno where turno.estado=0 ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }


}