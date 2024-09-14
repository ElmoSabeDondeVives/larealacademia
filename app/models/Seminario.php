<?php
class Seminario
{
    private $log;

    public function __construct()
    {
        $this->log = new Log();
        $this->pdo = Database::getConnection();
    }
    public function save_pregunta($model){
        $fecha_actual = date('Y-m-d H:i:s');
        try{

            $sql = 'insert into preguntas (id_materia, id_nivel, pregunta_descripcion, pregunta_respuesta, alternativa1, alternativa2, alternativa3, alternativa4, pregunta_estado, pregunta_usuario, alternativa5,pregunta_imagen) values (?,?,?,?,?,?,?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->materia,
                $model->nivel,
                $model->pregunta,
                $model->respuesta,
                $model->a1,
                $model->a2,
                $model->a3,
                $model->a4,
                0,
                $model->usuario,
                $model->a5,
                $model->imagen

            ]);

            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }
    public function save_materia($model){
        $fecha_actual = date('Y-m-d H:i:s');
        try{

            $sql = 'insert into materias(materia_descripcion, materia_creacion ) values (?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->name,
                $model->usuario,

            ]);

            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }
    public function save_titulo($titulo,$fecha,$usuario,$codigo,$nivel){

        try{

            $sql = 'insert into seminario(seminario_titulo, seminario_creacion, seminario_usuario,seminario_cod,seminario_nivel) values (?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $titulo,
                $fecha,
                $usuario,
                $codigo,
                $nivel

            ]);

            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }
    public function save_info($id_s,$id_p){

        try{

            $sql = 'insert into seminario_preguntas(id_seminario, id_pregunta) values (?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_s,
                $id_p,

            ]);

            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }
    public function list_preguntas(){
        try{
            $sql = 'select * from preguntas inner join materias m on preguntas.id_materia = m.id_materia ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_seminarios(){
        try{
            $sql = 'select * from seminario order by  id_seminario desc ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_pregunta($id){
        try{
            $sql = 'select * from seminario_preguntas inner join preguntas p on seminario_preguntas.id_pregunta = p.id_pregunta where id_seminario=?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function seminario($id){
        try{
            $sql = 'select * from seminario where id_seminario=?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function get_id_seminario($cod){
        try{
            $sql = 'select id_seminario from seminario where seminario_cod=? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$cod]);
            return $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function random_preguntas($materia,$cantidad,$nivel){
        try{
                $sql = 'SELECT * FROM preguntas WHERE id_materia=? and id_nivel=? ORDER BY RAND() LIMIT '.$cantidad .' ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$materia, $nivel]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_mat(){
        try{
            $sql = 'select * from materias ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }

    public function list_mat_hab(){
        try{ /*Lista de Materias habilitados*/
            $sql = 'select * from materias where materia_estado=0 ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }


}