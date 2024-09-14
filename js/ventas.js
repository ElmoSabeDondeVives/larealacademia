function quitarProducto(cod) {
    var cadena = "codigo=" + cod;
    $.ajax({
        type:"POST",
        url: urlweb + "api/Ventas/eliminar_producto",
        data : cadena,

        success:function (r) {
            if(r==1){
                respuesta('¡Producto Eliminado!', 'success');
                $('#tabla_productos').load(urlweb + 'Ventas/tabla_productos');
            } else {
                respuesta('Error al eliminar registro', 'error');
            }
        }
    });
}


function realizar_venta(){
    var valor = true;
    var boton = 'btn_generarventa';
    //datos cliente
    var client_number = $('#client_number').val();
    var client_name = $('#client_name').val();
    var saleproduct_direccion = $('#client_address').val();
    var client_telefono = $('#client_telefono').val();
    var select_tipodocumento = $('#select_tipodocumento').val();
    //var saleproductgas_telefono = $('#client_telefono').val();
    //datos venta
    var saleproduct_type = $('#tipo_venta').val();
    var serie = $('#serie').val();
    var numero = $('#numero').val();
    var tipo_moneda = $('#tipo_moneda').val();
    //var saleproduct_naturaleza = $('#naturaleza_sell').val();
    var id_tipo_pago = $('#id_tipo_pago').val();
    var total = $('#montototal').val();
    var gravada = $('#gravada').val();
    var igv = $('#igv').val();
    var saleproduct_inafecta = $('#inafecta').val();
    var saleproduct_exonerada = $('#exonerada').val();
    var saleproduct_icbper = $('#icbper').val();
    var saleproduct_total = total;
    var saleproduct_gravada = gravada;
    var saleproduct_igv = igv;
    var saleproduct_gratuita = $('#gratuita').val();
    var pago_con_ = $('#pago_con_').val();
    var vuelto_ = $('#vuelto_').val();
    //var des_global = $('#descuento_global').val();
    var des_global = 0;
    //var des_total = $('#des_total').val();
    var des_total = 0;
    var id_clase = $('#id_clase').val();

    var Tipo_documento_modificar = "";
    var serie_modificar = "";
    var numero_modificar = "";
    var notatipo_descripcion = "";
    if (saleproduct_type === "07" || saleproduct_type === "08"){
        Tipo_documento_modificar = $('#Tipo_documento_modificar').val();
        serie_modificar = $('#serie_modificar').val();
        numero_modificar = $('#numero_modificar').val();
        notatipo_descripcion = $('#notatipo_descripcion').val();
    }
    var valor_ = true;
    if(saleproduct_type == "01"){
        if(client_number.length == 11){
            valor_ =true;
        }else{
            valor_ = false;
        }

    }

    valor = validar_campo_vacio('tipo_venta', saleproduct_type, valor);
    valor = validar_campo_vacio('serie', serie, valor);
    valor = validar_campo_vacio('numero', numero, valor);
    valor = validar_campo_vacio('client_number', client_number, valor);


    if(valor){
        if(valor_){
            var cadena = "cliente_number=" + client_number +
                "&cliente_name=" + client_name +
                "&cliente_direccion=" + saleproduct_direccion +
                "&cliente_telefono=" + client_telefono +
                "&select_tipodocumento=" + select_tipodocumento +
                "&saleproduct_type=" + saleproduct_type +
                "&serie=" + serie +
                "&correlativo=" + numero +
                "&tipo_moneda=" + tipo_moneda +
                "&id_tipo_pago=" + id_tipo_pago +
                "&saleproduct_exonerada=" + saleproduct_exonerada +
                "&saleproduct_inafecta=" + saleproduct_inafecta +
                "&saleproduct_icbper=" + saleproduct_icbper +
                "&saleproduct_total=" + saleproduct_total +
                "&saleproduct_gravada=" + saleproduct_gravada +
                "&notatipo_descripcion=" + notatipo_descripcion +
                "&serie_modificar=" + serie_modificar +
                "&numero_modificar=" + numero_modificar +
                "&Tipo_documento_modificar=" + Tipo_documento_modificar +
                "&saleproduct_gratuita=" + saleproduct_gratuita +
                "&pago_con_=" + pago_con_ +
                "&vuelto_=" + vuelto_ +
                "&des_global=" + des_global +
                "&des_total=" + des_total +
                "&id_clase=" + id_clase +
                "&saleproduct_igv=" + saleproduct_igv;
            $.ajax({
                type: "POST",
                url: urlweb + "api/Ventas/guardar_venta",
                data: cadena,
                dataType: 'json',
                beforeSend: function () {
                    cambiar_estado_boton(boton, 'cobrando...', true);
                },
                success: function (r) {
                    cambiar_estado_boton(boton, "<i class=\"fa fa-money\"></i> GENERAR VENTA", false);
                    switch (r.result.code) {
                        case 1:
                            respuesta('¡Venta realizada correctamente!', 'success');
                            location.href = urlweb + 'Ventas/ver_venta/' + r.result.idventa;
                            break;
                        case 2:
                            respuesta('Error al generar Venta', 'error');
                            break;
                        case 5:
                            respuesta('Error al generar Venta, revisar Cliente', 'error');
                            break;
                        default:
                            respuesta('¡Algo catastrofico ha ocurrido!', 'error');
                            break;
                    }
                }
            });
        }else{
            respuesta('El RUC debe tener 11 dígitos, Usted seleccionó FACTURA', 'error');
        }

    }


}
function enviar_comprobante_sunat(id_venta) {
    var cadena = "id_venta=" + id_venta;
    var boton = 'btn_enviar'+id_venta;
    $.ajax({
        type: "POST",
        url: urlweb + "api/Ventas/crear_xml_enviar_sunat",
        data: cadena,
        dataType: 'json',
        beforeSend: function () {
            cambiar_estado_boton(boton, 'enviando...', true);
        },
        success:function (r) {
            cambiar_estado_boton(boton, "<i style=\"font-size: 16pt;\" class=\"fa fa-check margen\"></i>", false);
            switch (r.result.code) {
                case 1:
                    respuesta('¡Comprobante Enviado a Sunat!', 'success');
                    setTimeout(function () {
                        location.reload();
                        //location.href = urlweb +  'Pedido/gestionar';
                    }, 1000);
                    break;
                case 2:
                    respuesta('Error al generar el comprobante electronico', 'error');
                    setTimeout(function () {
                        location.reload();
                        //location.href = urlweb +  'Pedido/gestionar';
                    }, 1000);
                    break;
                case 3:
                    respuesta('Error, Sunat rechazó el comprobante', 'error');
                    setTimeout(function () {
                        location.reload();
                        //location.href = urlweb +  'Pedido/gestionar';
                    }, 1000);
                    break;
                case 4:
                    respuesta('Error de comunicacion con Sunat', 'error');
                    setTimeout(function () {
                        location.reload();
                        //location.href = urlweb +  'Pedido/gestionar';
                    }, 1000);
                    break;
                case 5:
                    respuesta('Error al guardar en base de datos', 'error');
                    setTimeout(function () {
                        location.reload();
                        //location.href = urlweb +  'Pedido/gestionar';
                    }, 1000);
                    break;
                default:
                    respuesta('¡Algo catastrofico ha ocurrido!', 'error');
                    setTimeout(function () {
                        location.reload();
                        //location.href = urlweb +  'Pedido/gestionar';
                    }, 1000);
                    break;
            }
        }

    });
}
function comunicacion_baja(id_venta){
    var cadena = "id_venta=" + id_venta;
    var boton = 'btn_anular'+id_venta;
    $.ajax({
        type: "POST",
        url: urlweb + "api/Ventas/comunicacion_baja",
        data: cadena,
        dataType: 'json',
        beforeSend: function () {
            cambiar_estado_boton(boton, 'Anulando...', true);
        },
        success:function (r) {
            cambiar_estado_boton(boton, "ANULAR", false);
            switch (r.result.code) {
                case 1:
                    respuesta('¡Comprobante Enviado a Sunat!', 'success');
                    setTimeout(function () {
                        location.reload();
                        //location.href = urlweb +  'Pedido/gestionar';
                    }, 1000);
                    break;
                case 2:
                    respuesta('Error al generar el comprobante electronico', 'error');
                    setTimeout(function () {
                        location.reload();
                        //location.href = urlweb +  'Pedido/gestionar';
                    }, 1000);
                    break;
                case 3:
                    respuesta('Error, Sunat rechazó el comprobante', 'error');
                    setTimeout(function () {
                        location.reload();
                        //location.href = urlweb +  'Pedido/gestionar';
                    }, 1000);
                    break;
                case 4:
                    respuesta('Error de comunicacion con Sunat', 'error');
                    setTimeout(function () {
                        location.reload();
                        //location.href = urlweb +  'Pedido/gestionar';
                    }, 1000);
                    break;
                case 5:
                    respuesta('Error al guardar en base de datos', 'error');
                    setTimeout(function () {
                        location.reload();
                        //location.href = urlweb +  'Pedido/gestionar';
                    }, 1000);
                    break;
                default:
                    respuesta('¡Algo catastrofico ha ocurrido!', 'error');
                    break;
            }
        }

    });
}
function anular_boleta_cambiarestado(id_venta, estado){
    var cadena = "id_venta=" + id_venta + "&estado=" + estado;
    var boton = 'btn_anular_boleta'+id_venta;
    $.ajax({
        type: "POST",
        url: urlweb + "api/Ventas/anular_boleta_cambiarestado",
        data: cadena,
        dataType: 'json',
        beforeSend: function () {
            cambiar_estado_boton(boton, 'Anulando...', true);
        },
        success:function (r) {
            cambiar_estado_boton(boton, "ANULAR", false);
            switch (r.result.code) {
                case 1:
                    respuesta('¡Comprobante Anulado, listo para ser enviado por Resumen Diario!', 'success');
                    setTimeout(function () {
                        location.reload();
                        //location.href = urlweb +  'Pedido/gestionar';
                    }, 1000);
                    break;
                case 3:
                    respuesta('¡Comprobante Anulado!', 'success');
                    break;
                case 2:
                    respuesta('Error al anular el comprobante electronico', 'error');
                    setTimeout(function () {
                        location.reload();
                        //location.href = urlweb +  'Pedido/gestionar';
                    }, 1000);
                    break;
                default:
                    respuesta('¡Algo catastrofico ha ocurrido!', 'error');
                    break;
            }
        }

    });
}
function crear_enviar_resumen_sunat(){
    var fecha_post = $('#fecha_post').val();
    var cadena = "fecha=" + fecha_post;
    var boton = 'boton_enviar_resumen';
    $.ajax({
        type: "POST",
        url: urlweb + "api/Ventas/crear_enviar_resumen_sunat",
        data: cadena,
        dataType: 'json',
        beforeSend: function () {
            cambiar_estado_boton(boton, 'Enviando...', true);
        },
        success:function (r) {
            cambiar_estado_boton(boton, "Enviar Comprobantes", false);
            switch (r.result.code) {
                case 1:
                    respuesta('¡Resumen Creado y Enviado a Sunat!', 'success');
                    setTimeout(function () {
                        location.reload();
                        //location.href = urlweb +  'Pedido/gestionar';
                    }, 1000);
                    break;
                case 2:
                    respuesta('Error al generar el Resumen Diario', 'error');
                    break;
                case 3:
                    respuesta('Error, Sunat rechazó el comprobante', 'error');
                    break;
                case 4:
                    respuesta(r.result.message, 'error');
                    break;
                default:
                    respuesta('¡Algo catastrofico ha ocurrido!', 'error');
                    break;
            }
        }

    });
}

function consultar_documento(valor){
    var tipo_doc = $('#select_tipodocumento').val();


    $.ajax({
        type: "POST",
        url: urlweb + "api/Clientes/obtener_datos_cliente",
        data: "numero="+valor,
        dataType: 'json',
        success:function (r) {
            if(r.result.resultado == 1){
                $("#client_name").val(r.result.name+ ' ' + r.result.first_name+ ' ' + r.result.last_name);
                $("#client_address").val(r.result.direccion);
            }else{
                if(tipo_doc == "2"){
                    ObtenerDatosDni(valor);
                }else if(tipo_doc == "4"){
                    if(valor.length == 11){
                        ObtenerDatosRuc(valor)
                    }else{
                        respuesta('¡El RUC tiene que teer 11 dígitos!', 'error');
                    }
                }
            }
        }
    });

}
function ObtenerDatosDni(valor){
    var numero_dni =  valor;

    var formData = new FormData();
    formData.append("token", "uTZu2aTvMPpqWFuzKATPRWNujUUe7Re1scFlRsTy9Q15k1sjdJVAc9WGy57m");
    formData.append("dni", numero_dni);
    var request = new XMLHttpRequest();
    request.open("POST", "https://api.migo.pe/api/v1/dni");
    request.setRequestHeader("Accept", "application/json");
    request.send(formData);
    //$('.loader').show();
    request.onload = function() {
        var data = JSON.parse(this.response);
        if(data.success){
            //$('.loader').hide();
            console.log("Datos Encontrados");

            //$('#cotizacion_beneficiario').val(data.nombre);
            $("#client_name").val(data.nombre);
            //$('#cliente_direccion').val('');
            //$('#cliente_condicion').val("HABIDO");
        }else{
            //$('.loader').hide();
            console.log(data.message);
        }
    };

    /*$.ajax({
        type: "POST",
        url: urlweb + "api/Cliente/obtener_datos_x_dni",
        data: "numero_dni="+numero_dni,
        dataType: 'json',
        success:function (r) {
            $("#client_name").val(r.result.name+ ' ' + r.result.first_name+ ' ' + r.result.last_name);
        }
    });*/
}

function ObtenerDatosRuc(valor){
    var numero_ruc =  valor;

    var formData = new FormData();
    formData.append("token", "uTZu2aTvMPpqWFuzKATPRWNujUUe7Re1scFlRsTy9Q15k1sjdJVAc9WGy57m");
    formData.append("ruc", numero_ruc);
    var request = new XMLHttpRequest();
    request.open("POST", "https://api.migo.pe/api/v1/ruc");
    request.setRequestHeader("Accept", "application/json");
    request.send(formData);
    $('.loader').show();
    request.onload = function() {
        var data = JSON.parse(this.response);
        if(data.success){
            //$('.loader').hide();
            console.log("Datos Encontrados");
            //$('#cotizacion_beneficiario').val(data.nombre_o_razon_social);
            $("#client_name").val(data.nombre_o_razon_social);
            $("#client_address").val(data.direccion);
        }else{
            //$('.loader').hide();
            console.log(data.message);
        }
    };
    /*$.ajax({
        type: "POST",
        url: urlweb + "api/Cliente/obtener_datos_x_ruc",
        data: "numero_ruc="+numero_ruc,
        dataType: 'json',
        success:function (r) {
            $("#client_name").val(r.result.razon_social);
        }
    });*/
}