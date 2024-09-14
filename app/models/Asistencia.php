<?php

class Asistencia{
    private $log;
    public function __construct()
    {
        $this->log = new Log();
        $this->pdo = Database::getConnection();
    }
    public function search_cliente($id){
        try{
            $sql = 'select * from clientes where cliente_numero = ? ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function data_as($id, $clase){
        try{
            $fecha = date('Y-m-d');
            $sql = 'select * from asistencias inner join clientes c on c.id_cliente=asistencias.id_alumno where c.cliente_numero = ? and id_clase=? and date(asistencia_creacion)=? limit 1 ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id,$clase,$fecha]);
            $data = $stm->fetch();
            if ($data){
                return 1;
            }else{
                return 2;
            }

        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }
    public function list_mod_hab(){
        try{
            $sql = 'select * from modalidad where estado = 0 and modalidad_asistencia=1 ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_products(){
        try{
            $sql = 'select * from producto where producto_estado = 1  ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_clases_hab($modalidad){
        try{
            $sql = 'select * from aula_config ac   where ac.estado=0 and  ac.id_modalidad=?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$modalidad]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function search_clientes($num){
        try{
            $sql = 'select * from clientes where cliente_numero=? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$num]);
            $data = $stm->fetch();
            if ($data){
                return true;
            }else{

                return false;
            }

        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return false;
        }
    }
    public function buscar_horario($id){
        try{
            $sql = 'select ac.*, t.ingreso from aula_config ac inner join turno t on ac.id_turno = t.id where ac.id = ? ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_salida(){
        try{
            $fecha = date('Y-m-d');
            $sql = 'select * from asistencias inner join clientes c on asistencias.id_alumno = c.id_cliente where asistencias.asistencia_marca=1 and date(asistencias.asistencia_creacion)=?  order by asistencia_salida desc ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function buscar_alumno($text){
        try{
            $sql = "select * from clientes where concat( cliente_nombre , cliente_numero ) like '%$text%' ";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$text]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function reporte_docente($id){
        try{
            $sql = "select * from asistencias where id_alumno=? order by asistencia_creacion desc ";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function curso_activo($text){
        try{
            $sql = "select * from clientes inner join aula_config ac on ac.id = clientes.cliente_horario where id_cliente = ? ";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$text]);
            return $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function seminarios($text){
        try{
            $sql = "SELECT * FROM asistencias a INNER JOIN aula_config ac on ac.id=a.id_clase where a.id_alumno=? ";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$text]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function asistencia_otros($text){
        try{
            $sql = "select * from asistencias inner join aula_config ac on ac.id = asistencias.id_clase inner join modalidad m on ac.id_modalidad = m.id where asistencias.id_alumno = ? and  (m.modalidad_asistencia=3 or m.modalidad_asistencia=4)  ";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$text]);
            return $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function consulta_alumno_fecha($id, $fecha){
        try{
            if($fecha=='2023-02-09'){
                $data='caaa';
            }
            $sql = "select * from asistencias a where id_alumno=? and date(a.asistencia_creacion) =? limit 1";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id,$fecha]);
            $data = $stm->fetch();
            if ($data){
                return $data->asistencia_estado;
            }else{
                return 8;
            }
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 8;
        }
    }
    public function get_days($ini, $fin, $dia){
        try{
            $sql = "
             SELECT *
FROM (
SELECT DATE(ADDDATE(ADDDATE(DATE_SUB(?,INTERVAL 1 DAY ), INTERVAL 1 DAY), INTERVAL @i:=@i+1 DAY)) AS DIASENTREFECHAS
FROM (
SELECT a.a
FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
) a
JOIN (SELECT @i := -1) r1
WHERE 
@i < (TIMESTAMPDIFF(DAY, ?, ? )) ) AS DIAS
WHERE dayofweek(DIASENTREFECHAS) = ? and month(?) = month(DIASENTREFECHAS);
             ";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$ini,$ini,$fin,$dia,$ini]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_ingreso(){
        try{
            $fecha = date('Y-m-d');
            $sql = 'select * from asistencias inner join clientes c on asistencias.id_alumno = c.id_cliente left join aula_config ac on ac.id=c.cliente_horario where asistencias.asistencia_marca=0 and date(asistencias.asistencia_creacion)=? order by asistencia_creacion desc ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function buscar_registro($id){
        try{
            $fecha_=date('Y-m-d');
            $sql = 'select * from  asistencias where id_alumno=? and date(asistencia_creacion)= ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id,$fecha_]);
            $data = $stm->fetch();
            if ($data){
                return true;
            }else{
                return false;
            }
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return false;
        }
    }
    public function buscar_registro_asis($id){
        try{
            $fecha_=date('Y-m-d');
            $sql = 'select * from  asistencias where id_alumno=? and date(asistencia_creacion)= ? and asistencia_marca=0';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id,$fecha_]);
            $data = $stm->fetch();
            if ($data){
                return true;
            }else{
                return false;
            }
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return false;
        }
    }
    public function guardar_asistencia($model){
        $fecha_actual = date('Y-m-d H:i:s');
        try{

            $sql = 'insert into asistencias (id_alumno, asistencia_creacion, asistencia_estado, asistencia_usuario,id_clase) values (?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->id_alumno,
                $model->fecha,
                $model->estado,
                $model->usuario,
                $model->clase
            ]);

            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }
    public function guardar_asistencia_doc($model){
        $fecha_actual = date('Y-m-d H:i:s');
        try{

            $sql = 'insert into asistencias (id_alumno, asistencia_creacion, asistencia_estado, asistencia_usuario) values (?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->id_alumno,
                $model->fecha,
                $model->estado,
                $model->usuario
            ]);

            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }
    public function guardar_asistencia_sms($model){
        $fecha_actual = date('Y-m-d H:i:s');
        try{

            $sql = 'insert into asistencias (id_alumno, asistencia_creacion, asistencia_estado, asistencia_usuario,id_clase) values (?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->id_alumno,
                $model->fecha,
                $model->estado,
                $model->usuario,
                $model->clase
            ]);

            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }
    public function registrar_cliente($id, $nombre){
        $fecha_actual = date('Y-m-d H:i:s');
        try{

            $sql = 'insert into clientes (cliente_numero,cliente_nombre,id_tipodocumento) values (?,?,2)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id,$nombre
            ]);

            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }
    public function marcar_salida($id){
        $fecha_actual = date('Y-m-d H:i:s');
        $fecha_b = date('Y-m-d');
        try{

            $sql = 'update asistencias set asistencia_salida = ? , asistencia_marca=1 where id_alumno=? and date(asistencia_creacion)=?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $fecha_actual,$id,$fecha_b
            ]);

            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }


}