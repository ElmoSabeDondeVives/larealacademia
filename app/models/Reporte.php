<?php


class Reporte
{
    private $pdo;
    private $log;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }


    public function listar_dia(){
        try{
            $sql = 'select * from producto p inner join producto_precio pp on p.id_producto = pp.id_producto ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }
    public function detalles_venta($id){
        try{
            $sql = 'select * from ventas_detalle where id_venta=? ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function list_clases(){
        try{
            $sql = 'select aula_config.*, t.ingreso, t.salida, m.nombre as modalidad_nombre  from aula_config inner join turno t on aula_config.id_turno = t.id inner join modalidad m on aula_config.id_modalidad = m.id where aula_config.estado=0 ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function list_conceptos(){
        try{
            $sql = 'select * from producto where producto_estado=1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function buscar_ventas_details($id){
        try{
            $sql = 'select * from ventas_detalle vd inner join ventas v on vd.id_venta = v.id_venta inner join producto_precio pp on vd.id_producto_precio = pp.id_producto_precio inner join clientes c on v.id_cliente = c.id_cliente left join aula_config ac on c.cliente_horario = ac.id  where pp.id_producto=? ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function buscar_ventas_details_fec($id,$fecha_ini,$fecha_fin){
        try{
            $sql = 'select * from ventas_detalle vd inner join ventas v on vd.id_venta = v.id_venta inner join producto_precio pp on vd.id_producto_precio = pp.id_producto_precio inner join clientes c on v.id_cliente = c.id_cliente left join aula_config ac on c.cliente_horario = ac.id  where pp.id_producto=? and date(v.venta_fecha) between ? and ? ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id,$fecha_ini,$fecha_fin]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    //Funcion Especial para Listar Los Productos
    public function listar_dia_stock($fecha){
        try{
            $sql = 'select * from producto p inner join producto_precio pp on p.id_producto = pp.id_producto inner join stocklog s on p.id_producto = s.id_producto
                    inner join proveedores p2 on pp.id_proveedor = p2.id_proveedor where date(s.stocklog_date) = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }

    public function total_productos_now($id_producto){
        try{
            $sql = 'select producto_stock from producto where id_producto = ? and producto_estado = 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_producto
            ]);
            $r = $stm->fetch();
            $result = $r->producto_stock;
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }

    public function sacar_descuento($id){
        try{
            $sql = 'select * from ventas v inner join ventas_detalle vd on v.id_venta = vd.id_venta inner join producto_precio pp on vd.id_producto_precio = pp.id_producto_precio
                    inner join producto p on pp.id_producto = p.id_producto where p.id_producto = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }

    public function consulta_general($fecha_filtro, $fecha_filtro_fin){
        try{
            $sql = 'select * from producto p inner join startproduct s on p.id_producto = s.id_producto inner join stockout s2 on p.id_producto = s2.id_producto
                    inner join stocklog s3 on p.id_producto = s3.id_producto inner join ventas v on p.id_usuario = v.id_usuario';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha_filtro, $fecha_filtro_fin]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }

    public function products_selled($fecha_filtro,$fecha_filtro_fin, $id_producto){
        try{
            $sql = "select sum(pvd.venta_detalle_cantidad) total from ventas pv inner join ventas_detalle pvd on pv.id_venta = pvd.id_venta 
                inner join producto_precio pp on pvd.id_producto_precio = pp.id_producto_precio where date(pv.venta_fecha) between ? and ? and pp.id_producto = ? and pv.venta_total <> 0
                and pv.venta_cancelar <> 'false'";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $fecha_filtro,$fecha_filtro_fin,
                $id_producto
            ]);
            $r = $stm->fetch();
            $result = $r->total;
        }catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }

    public function total_por_producto($fecha_filtro,$fecha_filtro_fin, $id_producto){
        try{
            $sql = "select sum(pvd.venta_detalle_valor_total) total from ventas pv inner join ventas_detalle pvd on pv.id_venta = pvd.id_venta inner join
                    producto_precio pp on pvd.id_producto_precio = pp.id_producto_precio where date(pv.venta_fecha) between ? and ? and pp.id_producto = ?
                    and pv.venta_total <> 0 and pv.venta_cancelar <> 0";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $fecha_filtro,$fecha_filtro_fin,
                $id_producto
            ]);
            $r = $stm->fetch();
            $result = $r->total;
        }catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }
    public function total_por_producto_toda_fila($fecha_filtro,$fecha_filtro_fin, $id_producto){
        try{
            $sql = "select * from ventas pv inner join ventas_detalle pvd on pv.id_venta = pvd.id_venta inner join
                    producto_precio pp on pvd.id_producto_precio = pp.id_producto_precio where date(pv.venta_fecha) between ? and ? and pp.id_producto = ?
                    and pv.venta_total <> 0 and pv.venta_cancelar <> 0";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $fecha_filtro,$fecha_filtro_fin,
                $id_producto
            ]);
            $r = $stm->fetchAll();
            $result = $r;
        }catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }

    public function jalar_fecha_fin($id){
        try{
            $sql = 'select date(fecha_registro) fecha from startproduct where id_producto = ? order by fecha_registro asc limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }

    public function inicial($fecha_filtro,$fecha_filtro_fin, $id_producto){
        try{
            $sql = 'select startproduct_stock from startproduct where date(fecha_registro) between ? and ? and id_producto = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $fecha_filtro,
                $fecha_filtro_fin,
                $id_producto
            ]);
            $r = $stm->fetch();
            $result = $r->startproduct_stock;

        }catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }

    public function jalar_nuevo_valor_inicial($nueva_fecha_inicio,$nueva_fecha_fin,$id_producto){
        try{
            $sql = 'select startproduct_stock from startproduct st inner join producto p on st.id_producto = p.id_producto 
                    where date(fecha_registro) between ? and ? and st.id_producto = ?
                    order by id_startproduct asc limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $nueva_fecha_inicio,
                $nueva_fecha_fin,
                $id_producto]);
            $r = $stm->fetch();
            $result = $r->startproduct_stock;
        }catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }


    public function stockadded($fecha_filtro,$fecha_filtro_fin, $id_producto){
        try{
            $sql = 'select sum(stocklog_added) entrada from stocklog 
                    where date(stocklog_date) between ? and ? and id_producto = ? 
                    order by id_stocklog asc limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $fecha_filtro,
                $fecha_filtro_fin,
                $id_producto
            ]);
            $r = $stm->fetch();
            $result = $r->entrada;
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }

    public function stockout($fecha_filtro,$fecha_filtro_fin, $id_producto){
        try{
            $sql = 'select sum(stockout_out) salida from stockout where date(stockout_date) between ? and ? and id_producto = ?
                 order by id_stockout asc limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $fecha_filtro,$fecha_filtro_fin,
                $id_producto
            ]);
            $r = $stm->fetch();
            $result = $r->salida;

        }catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }


    public function listar_egresos_dia($fecha_filtro,$fecha_filtro_fin){
        try{
            $sql = 'select * from egresos where date(egreso_fecha_registro) between ? and ? and egreso_estado = 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha_filtro,$fecha_filtro_fin]);
            $result = $stm->fetchAll();
            return $result;
        }catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }

    public function listar_egresos_nuevo($fecha_nueva){
        try{
            $sql = 'select * from egresos where date(egreso_fecha_registro) = ? and egreso_estado = 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha_nueva]);
            $result = $stm->fetchAll();
            return $result;
        }catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }

    public function listar_productos(){
        try{
            $sql = 'select * from producto p inner join producto_precio pp on p.id_producto = pp.id_producto order by p.producto_nombre';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }



    public function inventario_inicial($id_producto){
        try{
            $sql = 'select startproduct_stock from startproduct where id_turn = ? and id_product = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_producto
            ]);
            $r = $stm->fetch();
            $result = $r->startproduct_stock;

        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }


    public function listar_ventas($fecha){
        try{
            $sql = 'select * from producto_venta sp inner join clientes c on sp.id_cliente = c.id_cliente where date(producto_venta_fecha) = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $fecha
            ]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }

    public function listar_monto_apertura_reporte_dia($fecha_hoy){
        try{
            $sql = 'select * from caja where date(caja_apertura_fecha) = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha_hoy]);
            $result = $stm->fetch();
            return $result;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }

    public function listar_monto_apertura_reporte_dia_filtro($fecha_filtro, $fecha_filtro_hoy){
        try{
            $sql = 'select sum(caja_apertura) total_apertura from caja where date(caja_apertura_fecha) between ? and ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha_filtro, $fecha_filtro_hoy]);
            $result = $stm->fetch();
            return $result;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }

    public function filtro_busqueda($fecha_filtro, $fecha_filtro_hoy){
        try{
            $sql = 'select * from caja where date(caja_cierre_fecha) between ? and ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha_filtro,$fecha_filtro_hoy]);
            $return = $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $return = 0;
        }
        return $return;
    }

    public function listar_egresos($fecha_hoy, $fecha_filtro_fin){
        try{
            $sql = 'select * from egresos where date(egreso_fecha_registro) between ? and ? and egreso_estado = 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha_hoy,$fecha_filtro_fin]);
            $result = $stm->fetchAll();
            return $result;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }

    public function listar_monto_apertura($fecha_hoy,$fecha_filtro_fin){
        try{
            $sql = 'select SUM(caja_apertura) total from caja where date(caja_apertura_fecha) between ? and ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha_hoy,$fecha_filtro_fin]);
            $result = $stm->fetch();
            return $result;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }

    public function listar_ventas_filtro($fecha_hoy,$fecha_filtro_fin){
        try{
            $sql = 'select * from ventas pv inner join clientes c on pv.id_cliente = c.id_cliente 
                    where date(pv.venta_fecha) between ? and ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha_hoy,$fecha_filtro_fin]);
            $result = $stm->fetchAll();
            return $result;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }

    public function listar_ventas_nuevo_filtro($fecha){
        try{
            $sql = 'select * from ventas pv inner join clientes c on pv.id_cliente = c.id_cliente 
                    where date(pv.venta_fecha) = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha]);
            $result = $stm->fetchAll();
            return $result;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }

    //FUNCION PARA CONSULTAR PRODUCTOS AGREGADOS
    public function consultar_agregados($id_producto, $fecha_filtro,$fecha_filtro_fin){
        try{
            $sql = 'select * from stocklog st inner join producto p on st.id_producto = p.id_producto
                    where st.id_producto = ? and date(stocklog_date) between ? and ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_producto, $fecha_filtro,$fecha_filtro_fin]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function consultar_agregados_($id_producto, $fecha_filtro,$fecha_filtro_fin){
        try{
            $sql = 'select * from stocklog st inner join producto p on st.id_producto = p.id_producto
                    where st.id_producto = ? and date(stocklog_date) between ? and ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_producto, $fecha_filtro,$fecha_filtro_fin]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function consultar_ventas($id_producto, $fecha_filtro,$fecha_filtro_fin){
        try{
            $sql = 'select * from ventas pv inner join ventas_detalle vd on 
                    pv.id_venta = vd.id_venta inner join producto_precio pp on vd.id_producto_precio = pp.id_producto_precio inner join producto p on pp.id_producto = p.id_producto
                    inner join clientes c on pv.id_cliente = c.id_cliente inner join usuarios u on p.id_usuario = u.id_usuario 
                    inner join personas p2 on u.id_persona = p2.id_persona where pp.id_producto = ? and date(pv.venta_fecha) between ? and ? 
                    and pv.venta_total <> 0 and pv.venta_cancelar <> 0';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_producto, $fecha_filtro,$fecha_filtro_fin]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function salidas_stock($id_producto, $fecha_filtro,$fecha_filtro_fin){
        try{
            $sql = 'select * from stockout st inner join producto p on st.id_producto = p.id_producto where st.id_producto = ? and 
                    date(stockout_date) between ? and ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_producto, $fecha_filtro,$fecha_filtro_fin]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function salidas_stock_($id_producto, $fecha_filtro,$fecha_filtro_fin){
        try{
            $sql = 'select * from stockout st inner join producto p on st.id_producto = p.id_producto where st.id_producto = ? and 
                    date(stockout_date) between ? and ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_producto, $fecha_filtro,$fecha_filtro_fin]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function jalar_descuento_x_prod($id_producto){
        try{
            $sql = 'select * from ventas_detalle vd inner join ventas v on vd.id_venta = v.id_venta inner join producto_precio pp on vd.id_producto_precio = pp.id_producto_precio
                    where pp.id_producto = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_producto]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

}