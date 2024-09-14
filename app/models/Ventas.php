<?php

class Ventas
{
    private $pdo;
    private $log;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    //Listar Toda La Info Sobre Personas
    public function listar_clientes(){
        try{
            $sql = 'select * from clientes where cliente_estado = 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    //consulta para listar los tipos de igv
    public function listAllIgv(){
        try{
            $sql = 'select * from igv where igv_estado = 1 order by igv_codigoafectacion asc ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function guardar_venta($model){
        try{
            $sql = 'insert into ventas ( id_usuario, id_cliente, id_turno, id_tipo_pago, id_moneda, venta_tipo_envio,
                    venta_tipo, venta_serie, venta_correlativo, venta_descuento_global, venta_totalgratuita, venta_totalexonerada, 
                    venta_totalinafecta, venta_totalgravada, venta_totaligv, venta_totaldescuento, venta_icbper, venta_total, 
                    venta_pago_cliente, venta_vuelto, venta_fecha, tipo_documento_modificar, 
                    serie_modificar, correlativo_modificar, venta_codigo_motivo_nota,venta_clase) 
                    value (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->id_usuario,
                $model->id_cliente,
                $model->id_turno,
                $model->id_tipo_pago,
                $model->venta_tipo_moneda,
                $model->venta_tipo_envio,
                $model->venta_tipo,
                $model->venta_serie,
                $model->venta_correlativo,
                $model->producto_venta_des_global,
                $model->producto_venta_totalgratuita,
                $model->producto_venta_totalexonerada,
                $model->producto_venta_totalinafecta,
                $model->producto_venta_totalgravada,
                $model->producto_venta_totaligv,
                $model->producto_venta_des_total,
                $model->producto_venta_icbper,
                $model->producto_venta_total,
                $model->producto_venta_pago,
                $model->producto_venta_vuelto,
                $model->producto_venta_fecha,
                $model->tipo_documento_modificar,
                $model->serie_modificar,
                $model->numero_modificar,
                $model->notatipo_descripcion,
                $model->id_clase
            ]);
            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }

    public function jalar_id_venta($producto_venta_fecha ,$id_cliente){
        try{
            $sql = 'select id_venta from ventas where venta_fecha = ? and id_cliente = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$producto_venta_fecha ,$id_cliente]);
            $result = $stm->fetch();

        }  catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function producto_precio($id_producto){
        try{
            $sql = 'select * from producto_precio inner join producto p on producto_precio.id_producto = p.id_producto where producto_precio.id_producto=? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_producto]);
            $result = $stm->fetch();

        }  catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function guardar_detalle_venta($model){
        try{
            $sql = 'insert into ventas_detalle (id_venta, id_producto_precio, venta_detalle_valor_unitario, 
                            venta_detalle_precio_unitario, venta_detalle_nombre_producto, venta_detalle_cantidad, 
                            venta_detalle_total_igv, venta_detalle_porcentaje_igv, venta_detalle_valor_total, 
                            venta_detalle_importe_total, venta_detalle_descuento) 
                            values (?,?,?,?,?,?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->id_venta,
                $model->id_producto_precio,
                $model->venta_detalle_valor_unitario,
                $model->venta_detalle_precio_unitario,
                $model->venta_detalle_nombre_producto,
                $model->venta_detalle_cantidad,
                $model->venta_detalle_total_igv,
                $model->venta_detalle_porcentaje_igv,
                $model->venta_detalle_valor_total,
                $model->venta_detalle_total_price,
                $model->venta_detalle_descuento
            ]);
            return 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return 2;
        }
    }

    public function listar_id_producto_productoprecio($id_producto_precio){
        try{
            $sql = "Select * from producto p inner join producto_precio p2 on p.id_producto = p2.id_producto 
                    where p2.id_producto_precio = ? AND producto_estado = 1";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_producto_precio]);
            $result = $stm->fetch();
            $result = $result->id_producto;
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }

    public function guardar_stock_nuevo($reducir, $id_producto){
        try{
            $sql = 'update producto set producto_stock = producto_stock - ? where id_producto = ? and producto_estado =1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $reducir, $id_producto
            ]);

            $result = 1;
        }catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    public function  actualizarCorrelativo_x_id_Serie($id_serie, $correlativo){
        try {
            $sql = 'update serie set correlativo = ? where id_serie = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $correlativo, $id_serie
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listar_venta($id){
        try {
            $sql = 'select * from ventas v inner join usuarios u on v.id_usuario = u.id_usuario inner join clientes c 
                    on c.id_cliente = v.id_cliente inner join tipo_pago tp on v.id_tipo_pago = tp.id_tipo_pago where v.id_venta = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listar_detalle_ventas($id){
        try {
            $sql = 'select * from ventas_detalle vd inner join producto_precio pp on vd.id_producto_precio = pp.id_producto_precio
                    inner join producto p on pp.id_producto = p.id_producto inner join tipo_afectacion ta on 
                    pp.producto_precio_codigoafectacion = ta.codigo inner join medida m on pp.id_medida = m.id_medida 
                    where vd.id_venta = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listAllCredito(){
        try{
            $sql = 'select * from tipo_ncreditos';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listAllDebito(){
        try{
            $sql = 'select * from tipo_ndebitos';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function lista_clases(){
        try{
            $sql = 'select aula_config.*, t.ingreso, t.salida from aula_config inner join modalidad m on aula_config.id_modalidad = m.id inner join turno t on aula_config.id_turno = t.id where aula_config.estado =0';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function search_by_barcode($product_barcode){
        try {
            $sql = 'select * from producto p inner join producto_precio pp on p.id_producto = pp.id_producto inner join medida m on pp.id_medida = m.id_medida
                    where p.producto_codigo_barra = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$product_barcode]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    public function listarSerie_NC_x_id($tipo_venta, $id){
        try{
            $sql = 'select * from serie where tipocomp = ? and id_serie=? and estado = 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$tipo_venta, $id]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function listarSerie($tipo_venta){
        try{
            $sql = 'select * from serie where tipocomp = ? and estado = 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$tipo_venta]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function listar_correlativos_x_serie($id_serie){
        try{
            $sql = 'select * from serie where id_serie = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_serie]);
            $return = $stm->fetch();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $return = [];
        }
        return $return;
    }
    //FUNCION PARA LISTAR LOS TIPOS DE PAGOS
    public function listar_tipo_pago(){
        try{
            $sql = 'select * from tipo_pago where tipo_pago_estado = 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function listar_descripcion_segun_nota_credito(){
        try{
            $sql = "select * from tipo_ncreditos where estado = 0";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([]);
            $result = $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function listar_descripcion_segun_nota_debito(){
        try{
            $sql = "select * from tipo_ndebitos where estado = 0";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([]);
            $result = $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function listar_empresa_x_id_empresa($id_empresa){
        try{
            $sql = "SELECT * FROM empresa where id_empresa = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_empresa]);
            $result = $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function listar_clienteventa_x_id($id_cliente){
        try{
            $sql = "SELECT * FROM  clientes c inner join tipo_documentos td on c.id_tipodocumento = td.id_tipodocumento
                        where id_cliente = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_cliente]);
            $result = $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function listar_tipo_notaC_x_codigo($venta_codigo_motivo_nota){
        try{
            $sql = "select * from tipo_ncreditos where codigo = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$venta_codigo_motivo_nota]);
            $result = $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function listar_tipo_notaD_x_codigo($venta_codigo_motivo_nota){
        try{
            $sql = "select * from tipo_ndebitos where codigo = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$venta_codigo_motivo_nota]);
            $result = $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function listar_ventas_sin_enviar(){
        try{
            $sql = 'SELECT * FROM ventas v inner join clientes c on v.id_cliente = c.id_cliente inner join monedas mo
                        on v.id_moneda = mo.id_moneda INNER JOIN usuarios u on v.id_usuario = u.id_usuario 
                        inner join tipo_pago tp on v.id_tipo_pago = tp.id_tipo_pago 
                        where v.venta_estado_sunat = 0';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function listar_ventas($sql){
        try{

            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return [];
        }
    }
    public function listar_soloventa_x_id($id){
        try{
            $sql = "SELECT * FROM ventas v inner join monedas mo on v.id_moneda = mo.id_moneda 
                    inner join tipo_pago tp on v.id_tipo_pago = tp.id_tipo_pago 
                        where v.id_venta = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function listar_venta_detalle_x_id_venta_venta($id){
        try{
            $sql = "SELECT * FROM ventas_detalle vd inner join producto_precio pp on vd.id_producto_precio = pp.id_producto_precio
            inner join medida um on pp.id_medida = um.id_medida inner join tipo_afectacion ta on 
            pp.producto_precio_codigoafectacion = ta.codigo inner join producto p on pp.id_producto = p.id_producto 
            where vd.id_venta = ? ";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function guardar_estado_de_envio_venta($id_venta, $tipo_envio, $estado){
        try{
            $date = date('Y-m-d H:i:s');
            $sql = "UPDATE ventas SET venta_tipo_envio = ?, venta_estado_sunat = ?, venta_fecha_envio=? where id_venta = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$tipo_envio, $estado, $date,$id_venta]);
            $result = 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 5;
        }
        return $result;
    }
    public function editar_venta_condicion_resumen_anulado_x_venta($id_venta, $venta_condicion){
        try{
            $date = date('Y-m-d H:i:s');
            $sql = "UPDATE ventas SET venta_condicion_resumen = ? where id_venta = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$venta_condicion,$id_venta]);
            $result = 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 5;
        }
        return $result;
    }
    public function actualizar_venta_anulado($id_venta, $estado){
        try{
            $sql = "UPDATE ventas SET venta_condicion_resumen = ?,
                                             venta_tipo_envio = ?,
                    anulado_sunat = ?, venta_cancelar = ?, venta_estado_sunat = ?
                                             where id_venta = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$estado,2,1,0,0,$id_venta]);
            $result = 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    public function actualizar_venta_anulado_factura_sinenviar($id_venta){
        try{
            $sql = "UPDATE ventas SET venta_condicion_resumen = ?,
                                             venta_tipo_envio = ?,
                    anulado_sunat = ?, venta_cancelar = ?, venta_estado_sunat = ?, venta_respuesta_sunat = ?
                                             where id_venta = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([1,1,1,0,1,'ANULADO',$id_venta]);
            $result = 3;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    public function actualizar_venta_enviado($id_venta,$respuesta){
        try{
            $date = date('Y-m-d H:i:s');
            $sql = "UPDATE ventas SET venta_tipo_envio = ?,
                                             venta_estado_sunat = ?,
                    venta_fecha_envio = ?, venta_respuesta_sunat = ?
                                             where id_venta = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([1,1,$date,$respuesta,$id_venta]);
            $result = 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    public function actualizar_venta_enviado_anulado($id_venta,$respuesta){
        try{
            $date = date('Y-m-d H:i:s');
            $sql = "UPDATE ventas SET venta_tipo_envio = ?,
                                             venta_estado_sunat = ?,
                    venta_fecha_envio = ?, venta_respuesta_sunat = ?, anulado_sunat = ?, venta_cancelar = ?
                                             where id_venta = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([1,1,$date,$respuesta,1,0,$id_venta]);
            $result = 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    public function guardar_ruta_xml_venta($id_venta,$ruta_xml){
        try{
            $sql = "UPDATE ventas SET venta_rutaXML = ? where id_venta = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$ruta_xml,$id_venta]);
            $result = 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    public function guardar_ruta_cdr_venta($id_venta,$ruta_cdr){
        try{
            $sql = "UPDATE ventas SET venta_rutaCDR = ? where id_venta = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$ruta_cdr,$id_venta]);
            $result = 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    public function guardar_repuesta_venta($id_venta, $estado_sunat){
        try{
            $sql = "UPDATE ventas SET venta_respuesta_sunat = ? where id_venta = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$estado_sunat,$id_venta]);
            $result = 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    public function listar_resumen_diario_x_id_venta($id_venta){
        try{
            $sql = "select * from envio_resumen_detalle er inner join ventas v on er.id_venta = v.id_venta where er.id_venta = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_venta]);
            $result = $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function actualizar_estadoconsulta_x_ticket($ticket,$nombre_ruta_cdr,$mensaje_consulta){
        try{
            $sql = "UPDATE envio_resumen SET envio_resumen_nombreCDR = ?,
                                             envio_resumen_estadosunat_consulta = ?
                                             where envio_resumen_ticket = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$nombre_ruta_cdr,$mensaje_consulta,$ticket]);
            $result = 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    public function actualizar_estadoconsulta_x_ticket_anulado($ticket,$nombre_ruta_cdr,$mensaje_consulta){
        try{
            $sql = "UPDATE ventas_anulados SET venta_anulado_rutaCDR = ?,
                                             venta_anulado_estado_sunat = ?
                                             where venta_anulacion_ticket = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$nombre_ruta_cdr,$mensaje_consulta,$ticket]);
            $result = 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    public function listar_venta_x_fecha($fecha, $tipo_venta){
        try{
            $sql = "SELECT * FROM ventas v inner join clientes c on v.id_cliente = c.id_cliente inner join monedas mo
                        on v.id_moneda = mo.id_moneda INNER JOIN usuarios u on v.id_usuario = u.id_usuario 
                    inner join tipo_pago tp on v.id_tipo_pago = tp.id_tipo_pago inner join
                        tipo_documentos td on c.id_tipodocumento = td.id_tipodocumento
                        where DATE(v.venta_fecha) = ? and v.venta_tipo <> ? and v.venta_estado_sunat = 0 
                          and v.tipo_documento_modificar <> '01' and v.venta_tipo_envio <> 1 limit 350";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha, $tipo_venta]);
            $result = $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function listar_serie_resumen($codigo){
        try{
            $sql = "SELECT * FROM serie where tipocomp = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$codigo]);
            $result = $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function actualizar_serie_resumen($codigo, $serie){
        try{
            $sql = "UPDATE serie SET serie = ? where tipocomp = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$serie,$codigo]);
            $result = 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    public function guardar_resumen_diario($fecha,$serie,$correlativo,$ruta_xml,$estado,$mensaje,$ticket){
        try{
            $sql = "insert into envio_resumen (envio_resumen_fecha, envio_resumen_serie, envio_resumen_correlativo, envio_resumen_nombreXML,
                                                envio_resumen_estado, envio_resumen_estadosunat, envio_resumen_ticket) value (?,?,?,?,?,?,?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha,$serie,$correlativo,$ruta_xml,$estado,$mensaje,$ticket]);
            $result = 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    public function actualizar_correlativo_resumen($codigo, $correlativo){
        try{
            $sql = "UPDATE serie SET correlativo = ? where tipocomp = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$correlativo,$codigo]);
            $result = 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    public function listar_envio_resumen_x_ticket($ticket){
        try{
            $sql = "select * from envio_resumen where envio_resumen_ticket = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$ticket]);
            $result = $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function guardar_resumen_diario_detalle($id_envio_resumen,$id_venta){
        try{
            $sql = "insert into envio_resumen_detalle (id_envio_resumen, id_venta, envio_resumen_detalle_condicion) value (?,?,1)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_envio_resumen,$id_venta]);
            $result = 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    public function listar_resumen_diario_fecha($fechaini, $fechafin){
        try{
            $sql = "select * from envio_resumen where DATE(envio_sunat_datetime) between ? and ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fechaini, $fechafin]);
            $result = $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function listar_resumen_diario_x_id($id_resumen){
        try{
            $sql = "select * from envio_resumen where id_envio_resumen = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_resumen]);
            $result = $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function listar_resumen_diario_detalle_x_id($id_resumen){
        try{
            $sql = "select * from envio_resumen_detalle er inner join ventas v on er.id_venta = v.id_venta where er.id_envio_resumen = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_resumen]);
            $result = $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function listar_venta_x_id($id){
        try{
            $sql = "SELECT * FROM ventas v inner join clientes c on v.id_cliente = c.id_cliente inner join monedas mo
                        on v.id_moneda = mo.id_moneda INNER JOIN usuarios u on v.id_usuario = u.id_usuario
                    inner join tipo_pago tp on v.id_tipo_pago = tp.id_tipo_pago 
                        where v.id_venta = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    public function guardar_venta_anulacion($fecha,$serie,$correlativo,$ruta_xml,$mensaje,$id_venta,$id_user,$ticket){
        try{
            $sql = "insert into ventas_anulados (venta_anulado_fecha, venta_anulado_serie, venta_anulado_correlativo, 
                    venta_anulacion_ticket, venta_anulado_rutaXML, venta_anulado_estado_sunat, id_venta, id_user) 
                    value (?,?,?,?,?,?,?,?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fecha,$serie,$correlativo,$ticket,$ruta_xml,$mensaje,$id_venta,$id_user]);
            $result = 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    public function editar_estado_venta_anulado($id_venta){
        try{
            $sql = "UPDATE ventas SET anulado_sunat = ?, venta_cancelar = ? where id_venta = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([1, 0,$id_venta]);
            $result = 1;
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 5;
        }
        return $result;
    }
    public function listar_comunicacion_baja_fecha($fechaini, $fechafin){
        try{
            $sql = "select * from ventas_anulados va inner join ventas v on va.id_venta = v.id_venta";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fechaini, $fechafin]);
            $result = $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }


    public function listar_venta_x_id_pdf($id){
        try{
            $sql = "select * from ventas v inner join empresa e on v.id_empresa = e.id_empresa inner join clientes c on v.id_cliente = c.id_cliente inner join monedas mo
                        on v.id_moneda = mo.id_moneda inner join usuarios u on v.id_usuario = u.id_usuario inner join tipo_pago tp on v.id_tipo_pago = tp.id_tipo_pago inner join monedas m2 
                        on v.id_moneda = m2.id_moneda
                        where v.id_venta = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listar_venta_detalle_x_id_venta_pdf($id){
        try{
            $sql = "select * from ventas_detalle vd inner join producto_precio pp on vd.id_producto_precio = pp.id_producto_precio
                    inner join producto p on pp.id_producto = p.id_producto inner join tipo_afectacion ta on 
                    pp.producto_precio_codigoafectacion = ta.codigo inner join medida m on pp.id_medida = m.id_medida  
                    where vd.id_venta = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();
        } catch (Throwable $e){
            $this->log->insertar($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
}