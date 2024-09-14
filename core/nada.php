<?php
if ($result == 1) {
/* Realizar Pago Por concepto  */
$data_product = $this->ventas->producto_precio($_POST['id_producto']);
$consulta_cliente = $this->clientes->listar_cliente_x_numerodoc($_POST['id']);
$id_turno = $this->turno->listar();
$model->id_cliente = $consulta_cliente->id_cliente;
$model->id_usuario = $this->encriptar->desencriptar($_SESSION['c_u'], _FULL_KEY_);
$model->id_cliente = $consulta_cliente->id_cliente;;
$model->id_turno = $id_turno->id_turno;
$model->id_tipo_pago = 3;
$model->venta_tipo_moneda = 1;
$model->venta_tipo_envio = 0;
$model->venta_tipo = '03';
$producto_venta_fecha = date("Y-m-d H:i:s");
$serie_ = $this->ventas->listar_correlativos_x_serie(3);
$model->venta_serie = $serie_->serie;
$model->venta_correlativo = $serie_->correlativo + 1;
$model->producto_venta_des_global = 0;
$model->producto_venta_totalgratuita = 0;
$model->producto_venta_totalexonerada = $data_product->producto_precio_valor;
$model->producto_venta_totalinafecta = 0;
$model->producto_venta_totalgravada = 0;
$model->producto_venta_totaligv = 0;
$model->producto_venta_des_total = 0;
$model->producto_venta_icbper = 0;
$model->producto_venta_total = $data_product->producto_precio_valor;
$model->producto_venta_pago = 0;
$model->producto_venta_vuelto = 0;
$model->producto_venta_fecha = $producto_venta_fecha;
$model->tipo_documento_modificar = '';
$model->serie_modificar = '';
$model->numero_modificar = '';
$model->notatipo_descripcion = '';
$model->id_clase = $_POST['clase'];

$guardar = $this->ventas->guardar_venta($model);
if ($guardar == 1) {
$id_cliente = $consulta_cliente->id_cliente;
$jalar_id = $this->ventas->jalar_id_venta($producto_venta_fecha, $id_cliente);
$idventa = $jalar_id->id_venta;
if ($idventa != 0) { //despues de registrar la venta se sigue a registrar el detalle
$model->id_venta = $idventa;
$model->id_producto_precio = $data_product->id_producto_precio;
$model->venta_detalle_valor_unitario = $data_product->producto_precio_valor;
$model->venta_detalle_precio_unitario = $data_product->producto_precio_valor;
$model->venta_detalle_nombre_producto = $data_product->producto_nombre;
$model->venta_detalle_cantidad = 1;
$model->venta_detalle_total_igv = 0;
$model->venta_detalle_porcentaje_igv = 0;
$model->venta_detalle_valor_total = $data_product->producto_precio_valor;
$model->venta_detalle_total_price = $data_product->producto_precio_valor;
$model->venta_detalle_descuento = 0;
$guardar_detalle = $this->ventas->guardar_detalle_venta($model);
if ($guardar_detalle == 1) {
$return = 1;
} else {
$return = 2;
}
if ($return == 1) {
$return = $this->ventas->actualizarCorrelativo_x_id_Serie($serie_->id_serie, $serie_->correlativo + 1);

//INICIO - LISTAR COLUMNAS PARA TICKET DE VENTA
include('libs/ApiFacturacion/phpqrcode/qrlib.php');
$venta = $this->ventas->listar_venta($idventa);
$detalle_venta = $this->ventas->listar_detalle_ventas($idventa);
$empresa = $this->ventas->listar_empresa_x_id_empresa($venta->id_empresa);
$cliente = $this->ventas->listar_clienteventa_x_id($venta->id_cliente);
//INICIO - CREACION QR
$nombre_qr = $empresa->empresa_ruc . '-' . $venta->venta_tipo . '-' . $venta->venta_serie . '-' . $venta->venta_correlativo;
$contenido_qr = $empresa->empresa_ruc . '|' . $venta->venta_tipo . '|' . $venta->venta_serie . '|' . $venta->venta_correlativo . '|' .
$venta->venta_totaligv . '|' . $venta->venta_total . '|' . date('Y-m-d', strtotime($venta->venta_fecha)) . '|' .
$cliente->tipodocumento_codigo . '|' . $cliente->cliente_numero;
$ruta = 'libs/ApiFacturacion/imagenqr/';
$ruta_qr = $ruta . $nombre_qr . '.png';
QRcode::png($contenido_qr, $ruta_qr, 'H - mejor', '3');
//FIN - CREACION QR
if ($venta->venta_tipo == "03") {
$venta_tipo = "BOLETA DE VENTA ELECTRÓNICA";
} elseif ($venta->venta_tipo == "01") {
$venta_tipo = "FACTURA DE VENTA ELECTRÓNICA";
} elseif ($venta->venta_tipo == "07") {
$venta_tipo = "NOTA DE CRÉDITO ELECTRÓNICA";
$motivo = $this->ventas->listar_tipo_notaC_x_codigo($venta->venta_codigo_motivo_nota);
} else {
$venta_tipo = "NOTA DE DÉBITO ELECTRÓNICA";
$motivo = $this->ventas->listar_tipo_notaD_x_codigo($venta->venta_codigo_motivo_nota);

}
if ($cliente->id_tipodocumento == "4") {
$cliente_nombre = $cliente->cliente_razonsocial;
} else {
$cliente_nombre = $cliente->cliente_nombre;
}

$return = 1;
if($return == 1){
require _VIEW_PATH_ . 'ventas/ticket_dia.php';
}
}


}

$result = $this->asistencia->guardar_asistencia_sms($model);
} else {
$return = 2;
}

}