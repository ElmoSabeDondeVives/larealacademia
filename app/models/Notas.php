<?php

class Notas
{
    private $log;

    public function __construct()
    {
        $this->log = new Log();
        $this->pdo = Database::getConnection();
    }


    /*    Funciones v- */
    public function list_config(){
        try{
            $sql = 'select ac.id, ac.descripcion, a.nombre as aula_nombre , t.ingreso, t.salida, m.nombre as modalidad_nombre, ac.estado from aula_config ac inner join aula a on  ac.id_aula= a.id inner join turno t on t.id=ac.id_turno inner join modalidad m on m.id= ac.id_modalidad   ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_alumn($id){
        try{
            $sql = 'select clientes.*, a.nombre as aula_nombre , t.ingreso, t.salida, m.nombre as modalidad_nombre from clientes inner join aula_config ac on ac.id= cliente_horario inner join aula a on ac.id_aula = a.id inner join turno t on ac.id_turno= t.id inner join modalidad m on ac.id_modalidad = m.id where cliente_horario=?   ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_alumn_seminario($id){
        try{
            $sql = 'select c.*, ac.descripcion as aula_nombre, t.ingreso, t.salida, m.nombre as modalidad_nombre from asistencias inner join clientes c on c.id_cliente = asistencias.id_alumno inner join aula_config ac on ac.id=asistencias.id_clase inner join turno t on t.id=ac.id_turno inner join modalidad m on m.id=ac.id_modalidad where asistencias.id_clase=? ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function nombre_aula($id){
        try{
            $sql = 'select * from evalucion where id_evaluacion=? ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function notas_al($id){
        try{
            $sql = 'select * from notas inner join clientes c on notas.id_cliente = c.id_cliente left join carreras ca on c.id_carrera=ca.id_carrera where nota_concepto=? order by  nota_valor desc; ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function tipo_clase($id){
        try{
            $sql = 'select *, m.modalidad_asistencia  from aula_config inner join modalidad m on aula_config.id_modalidad = m.id where aula_config.id=?  ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_alumn_eva($id){
        try{
            $sql = 'select * from notas inner join clientes c on notas.id_cliente = c.id_cliente where nota_concepto=?  ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
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
    public function buscar_ventas_clases($text){
        try{
            $sql = "select * from ventas inner join clientes c on ventas.id_cliente = c.id_cliente  where venta_clase=? ";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$text]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function buscar_ventas_clases_date($text,$fecha_ini, $fecha_fin){
        try{
            $sql = "select * from ventas inner join clientes c on ventas.id_cliente = c.id_cliente  where venta_clase=? and date(venta_fecha) between ? and ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$text,$fecha_ini,$fecha_fin]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function cursos($id){
        try{
            $sql = "SELECT id_curso, ac.descripcion FROM notas inner join aula_config ac on ac.id = notas.id_curso where id_cliente=? GROUP by id_curso";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function notas_clase($id,$cliente){
        try{
            $sql = "select notas.nota_fecha as fecha_nota, notas.nota_valor as notita from notas where id_curso=? and id_cliente=? ORDER BY notas.nota_fecha ASC";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id,$cliente]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_eva($id){
        try{
            $sql = 'select * from evalucion where id_curso=?   ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_pagos($id){
        try{
            $sql = 'select * from ventas where id_cliente=?   ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_client($id){
        try{
            $sql = 'select * from clientes where id_cliente=?   ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function list_notas_al($id){
        try{
            $sql = 'select * from notas where id_cliente=?   ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function get_id_ev($id){
        try{
            $sql = 'select * from evalucion where evaluacion_mtk=?  limit 1 ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            return $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function save($nota, $alumno, $usuario,$fecha_e,$concepto,$curso){
        $fecha_actual = date('Y-m-d H:i:s');
        try{

            $sql = 'insert into notas (id_curso, nota_concepto, nota_fecha, nota_valor, nota_usuario, id_cliente,nota_creacion) values (?,?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $curso,
                $concepto,
                $fecha_e,
                $nota,
                $usuario,
                $alumno,
                $fecha_actual
            ]);

            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }
    public function save_evaluacion($curso, $concepto, $usuario,$mtk){
        $fecha_actual = date('Y-m-d H:i:s');
        try{

            $sql = 'insert into evalucion (id_curso, evaluacion_concepto, evaluacion_creacion, evaluacion_usuario,evaluacion_mtk) values (?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $curso,
                $concepto,
                $fecha_actual,
                $usuario,
                $mtk
            ]);

            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }




}