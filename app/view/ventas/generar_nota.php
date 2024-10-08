<?php
/**
 * Created by PhpStorm
 * User: LuisSalazar
 * Date: 31/05/2021
 * Time: 01:35 p. m.
 */
?>
<hr><h2 class="concss">
    <a href="http://localhost/fire"><i class="fa fa-fire"></i> INICIO</a> >
    <i class="<?php echo $_SESSION['icono'];?>"></i> <?php echo $_SESSION['accion'];?>
</h2><hr>

<!--Modal para Productos-->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 80% !important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Listado de Productos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <table id="dataTable2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th style="width: 200px;">Producto</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>SubTotal</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($productos as $p){
                            $productnamefull = $p->producto_nombre;
                            ?>
                            <tr>
                                <td><?php echo $p->producto_codigo_barra;?></td>
                                <td><?php echo $productnamefull;?></td>
                                <td><?php echo $p->producto_stock;?></td>
                                <td>S/. <input type="text" class="form-control" onchange="onchangeundprice<?php echo $p->id_producto_precio;?>()"  style="width: 80px;" onkeypress="return valida(event)" id="product_price<?php echo $p->id_producto_precio;?>" value="<?php echo $p->producto_precio_valor;?>"> </td>
                                <td><input type="text" class="form-control" onchange="onchangeund<?php echo $p->id_producto_precio;?>()" style="width: 70px;" id="total_product<?php echo $p->id_producto_precio;?>" onkeypress="return valida(event)" value="1"></td>
                                <td>S/. <input type="text" class="form-control" onchange="onchangetotalprice<?php echo $p->id_producto_precio;?>()"  style="width: 80px;" id="total_price<?php echo $p->id_producto_precio;?>" onkeypress="return valida(event)" value="<?php echo $p->producto_precio_valor;?>">
                                    <input type="hidden" id="tipo_igv<?php echo $p->id_producto_precio;?>" name="tipo_igv<?php echo $p->id_producto_precio;?>" value="<?php echo $p->producto_precio_codigoafectacion;?>">
                                </td>
                                <td><button class="btn btn-success btn-xs" type="button" onclick="agregarProducto<?php echo $p->id_producto_precio;?>(<?php echo $p->id_producto_precio;?>, '<?php echo $productnamefull;?>',<?php echo $p->id_medida;?>,<?php echo $p->producto_stock;?>)"><i class="fa fa-check-circle"></i> Elegir Producto</button></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!--Modal para Clientes-->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 80% !important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Clientes Registrados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <a style="float: right;" href="<?php echo _SERVER_;?>Clientes/agregar" class="btn btn-success"><i class="fa fa-pencil"></i> Cliente Nuevo</a>
                    <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                        <thead class="text-capitalize">
                        <tr>
                            <th>Nombre</th>
                            <th>DNI ó RUC </th>
                            <th>Dirección</th>
                            <th>Telefono o Celular</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $a = 1;
                        foreach ($clientes as $m){
                            ?>
                            <tr>
                                <td><?php echo $m->cliente_nombre.$m->cliente_razonsocial;?></td>
                                <td><?php echo $m->cliente_numero;?></td>
                                <td><?php echo $m->cliente_direccion;?></td>
                                <td><?php echo $m->cliente_telefono;?></td>
                                <td><button type="button" class="btn btn-xs btn-success btne" onclick="agregarPersona('<?php echo $m->cliente_nombre.$m->cliente_razonsocial;?>','<?php echo $m->cliente_numero;?>','<?php echo $m->cliente_direccion;?>','<?= $m->cliente_telefono;?>','<?= $m->id_tipodocumento;?>')" ><i class="fa fa-check-circle"></i> Elegir Cliente</button></td>
                            </tr>
                            <?php
                            $a++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <!--<section class="container-fluid">
        <h1>
            <?php echo $_SESSION['controlador'];?> /
            <small><?php echo $_SESSION['accion'];?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="<?php echo $_SESSION['icono'];?>"></i> <?php echo $_SESSION['controlador'];?></a></li>
        </ol>
    </section>-->
    <section class="content" style="background-color: #ffffff; box-shadow: 10px 10px 5px #888888;border-radius: 30px; padding: 15px; margin: 50px; min-height: 500px">
        <div class="row">
            <div class="col-lg-12">
                <h3 style="text-align: center">Notas de Crédito/Débito</h3>
            </div>
        </div><br>
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-3">
                <label>Tipo de Comprobante</label>
                <select id="tipo_venta" class="form-control" onchange = "selecttipoventa_(this.value)">
                    <!--<option value="03">BOLETA</option>
                    <option value="01">FACTURA</option>-->
                    <option value= "">Seleccionar...</option>
                    <!--<option value="03">BOLETA</option>
                    <option value="01">FACTURA</option>-->
                    <option value= "07">NOTA DE CREDITO</option>
                    <option value= "08">NOTA DE DEBITO</option>
                </select>
            </div>
            <div class="col-lg-2">
                <label>Serie</label>
                <select name="serie" id="serie" class="form-control" onchange="ConsultarCorrelativo()">
                    <option value="">Seleccionar</option>
                </select>
            </div>
            <div class="col-lg-2">
                <label>Numero</label>
                <input class="form-control" type="text" id="numero" readonly>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="tipo_moneda">Moneda</label><br>
                    <select class="form-control" id="tipo_moneda" name="tipo_moneda">
                        <option value="1">SOLES</option>
                        <option value="2">DOLARES</option>
                    </select>
                    <input type="hidden" id="id_venta" name="id_venta">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="text-align: center">
                <h5><strong>Datos del Cliente</strong></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-2">
                <label>Tipo de Pago</label>
                <select class="form-control" id="id_tipo_pago" name="id_tipo_pago">
                    <?php
                    foreach ($tipo_pago as $tp){
                        ?>
                        <option <?php echo ($tp->id_tipo_pago == 3) ? 'selected' : '';?> value="<?php echo $tp->id_tipo_pago;?>"><?php echo $tp->tipo_pago_nombre;?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-3">
                <label>Tipo Documento</label>
                <select  class="form-control" name="select_tipodocumento" id="select_tipodocumento">
                    <option value="">Seleccionar...</option>
                    <?php
                    foreach ($tipos_documento as $td){
                        ($td->id_tipodocumento == $venta->id_tipodocumento)?$sele='selected':$sele='';
                        echo "<option value='".$td->id_tipodocumento."' ".$sele.">".$td->tipodocumento_identidad."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-2" style="margin-top: 8px">
                <br>
                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#basicModal" style="width: 100%"><i class="fa fa-search"></i> Buscar Cliente</button>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-2">
                <label for="client_number">DNI ó RUC:</label>
                <input class="form-control" type="text" id="client_number" value="<?= $venta->cliente_numero?>" onchange="consultar_documento(this.value)">
            </div>
            <div class="col-lg-5">
                <label for="client_name">Nombre:</label>
                <input class="form-control" type="text" id="client_name" value="<?= (($venta->id_tipodocumento == 2)? $venta->cliente_nombre : $venta->cliente_razonsocial); ?>" placeholder="Ingrese Nombre...">
            </div>

        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-5">
                <label for="client_address">Direccion:</label>
                <textarea class="form-control" name="client_address" id="client_address"  rows="2" placeholder="Ingrese Dirección..."><?= $venta->cliente_direccion?></textarea>
                <!--<input class="form-control" type="text" id="client_address">-->
            </div>
            <div class="col-lg-2">
                <label for="client_address">Telefono:</label>
                <input class="form-control" type="text" id="client_telefono" placeholder="Ingrese telefono..." value="<?= $venta->cliente_telefono?>">
            </div>

        </div><hr>

        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-3">
                <button style="width: 100%; padding: 1.2rem; font-size: 1.5rem" class="btn btn-success" type="button" data-toggle="modal" data-target="#largeModal"><i class="fa fa-search"></i> Buscar Producto</button>
            </div>
            <div class="col-lg-1" style="text-align: center; font-size: 3rem;"> Ó </div>
            <div class="col-lg-4">
                <label for="client_address">Código de Barra:</label>
                <input class="form-control" type="text" id="product_barcode" onkeyup="buscar_producto_barcode()">
            </div>
            <div class="col-lg-2">
                <label>PAGO DEL CLIENTE</label>
                <input style="width: 85%;" type="text" class="form-control" id="pago_cliente" onkeyup="calcular_vuelto(this.value)" onkeypress="return validar_numeros_decimales_dos(this.id)">
            </div>
            <div class="col-lg-2" id="mostrar">
                <br>
                <button style="margin-top: 8px; width: 100%" class="btn btn-success" type="button" onclick="buscar_producto_barcode()" ><i class="fa fa-search"></i> Buscar Código</button>
            </div>
        </div><hr>

        <div id="general">
            <div class="row" id="busqueda">
                <div class="col-lg-12" style="text-align: center; font-size: 1.5rem">BÚSQUEDA DE PRODUCTOS - CÓDIGO DE BARRA</div>
            </div>
            <br>
            <div class="row" id="detalle">
                <div class="col-lg-1"></div>
                <div class="col-lg-4">
                    <label for="client_address">Nombre Producto:</label>
                    <input class="form-control" type="text" id="product_nameb" readonly>
                </div>
                <div class="col-lg-3">
                    <label for="client_address">Cód. Producto:</label>
                    <input class="form-control" type="text" id="id_productforsaleb" readonly>
                </div>
                <div class="col-lg-2">
                    <label for="client_address">Stock:</label>
                    <input class="form-control" type="text" id="product_stockb" readonly>
                </div>
                <!--<div class="col-lg-3">
                    <label for="tipo_igv">Tipo de IGV</label><br>
                    <?php $igv = $this->ventas->listAllIgv(); ?>
                    <select class="form-control" id="tipo_igv" style="background: whitesmoke; color: #000000" disabled>
                        <?php
                foreach ($igv as $ig){
                    ?>
                            <option <?php echo ($ig->id_igv == 3) ? 'selected' : '';?> value="<?php echo $ig->id_igv;?>"><?php echo $ig->igv_tipodeafectacion;?></option>
                            <?php
                }
                ?>
                    </select>
                </div>-->
            </div><br>

            <div class="row" id="detalle_">
                <div class="col-lg-1"></div>

                <div class="col-lg-2">
                    <label for="product_cantb">Cantidad:</label>
                    <input class="form-control" type="text" id="product_cantb" onchange="onchangeundZ()" value="1" onkeypress="return valida(event);">
                </div>
                <div class="col-lg-2">
                    <label for="product_priceb">Precio(S/.):</label><br>
                    <input class="form-control" type="text"  onchange="onchangeundpriceZ()" id="product_priceb">
                </div>
                <div class="col-lg-2">
                    <label for="product_totalb">Total(S/.):</label><br>
                    <input class="form-control" type="text" id="product_totalb" onchange="onchangetotalpriceZ()">
                    <input type="hidden" id="codigo_afectacion" name="codigo_afectacion">
                </div>
                <div class="col-lg-2">
                    <br>
                    <button style="margin-top: 8px; width: 100%" class="btn btn-primary" type="button" onclick="agregarProductoZ()" ><i class="fa fa-plus"></i> Agregar Producto</button>
                </div>
            </div><br>
        </div>

        <div class="row"  id="credito_debito">
            <div class="col-lg-1"></div>
            <div class="col-lg-3">
                <label>Documento a modificar</label>
                <select name="" class="form-control" id="Tipo_documento_modificar" disabled>
                    <option <?= (($venta->venta_tipo == '03')?$selec='selected':$selec=''); ?> value="03">BOLETA</option>
                    <option <?= (($venta->venta_tipo == '01')?$selec='selected':$selec=''); ?> value="01">FACTURA</option>
                </select>
            </div>
            <div class="col-lg-2" id="serie_nota">
                <label>Serie</label>
                <input class="form-control" type="text" id="serie_modificar" value="<?= $venta->venta_serie;?>" readonly>
            </div>
            <div class="col-lg-2" id="numero_nota">
                <label>Numero</label>
                <input class="form-control" type="text" id="numero_modificar" value="<?= $venta->venta_correlativo;?>" readonly>
            </div>
            <div class="col-lg-3" id="nota_descripcion">
            </div>
            <div class="col-lg-1"></div>
        </div>

        <div id="tabla_productos"></div><br>

        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <button type="button" id="btn_generarventa" class="btn btn-primary" style="width: 100%; padding: 1.2rem; font-size: 1.5rem; width: 100%" onclick="preguntar('¿Está seguro que desea realizar esta Venta?','realizar_venta','Si','No')">
                    <i class="fa fa-money"></i> GENERAR VENTA</button>
            </div>
        </div>
    </section>

    <script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
    <script src="<?php echo _SERVER_ . _JS_;?>ventas.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tabla_productos').load('<?php echo _SERVER_;?>Ventas/tabla_productos');
            $("#product_barcode").focus();
            $("#credito_debito").hide();
            $("#mostrar").hide();
            $("#detalle").hide();
            $("#detalle_").hide();
            $("#busqueda").hide();
            $("#general").hide();
        });
        var productfull = "";
        var unid = "";

        function selecttipoventa_(valor){
            selecttipoventa(valor);
            if (valor == "07" || valor == "08"){
                $('#credito_debito').show();

                if(valor == "07"){
                    $('#notaCredito').show();
                    $('#notaDebito').hide();
                }else{
                    $('#notaCredito').hide();
                    $('#notaDebito').show();
                }
                var tipo_comprobante =  valor;
                $.ajax({
                    type: "POST",
                    url: urlweb + "api/Ventas/tipo_nota_descripcion",
                    data: "tipo_comprobante="+tipo_comprobante,
                    dataType: 'json',
                    success:function (r) {
                        $("#nota_descripcion").html(r);
                    }
                });
            } else{
                $('#credito_debito').hide();
            }
        }

        function calcular_vuelto(valor){
            var monto_cliente = valor;
            var monto_total = $('#montototal').val();
            var vuelto_sin_ = monto_cliente - monto_total;
            var vuelto_sin = vuelto_sin_.toFixed(2);
            $('#pago_con').html(monto_cliente);
            $('#pago_con_').val(monto_cliente);
            $('#vuelto').html(vuelto_sin);
            $('#vuelto_').val(vuelto_sin);
        }

        function recargar_productos() {
            $('#tabla_productos').load('<?php echo _SERVER_;?>Ventas/tabla_productos');
        }

        <?php
        foreach ($productos as $p){
        ?>
        function agregarProducto<?php echo $p->id_producto_precio;?>(cod, producto, unids, stock) {
            var cant = $("#total_product<?php echo $p->id_producto_precio;?>").val() * 1;
            var precio = $("#product_price<?php echo $p->id_producto_precio;?>").val() * 1;
            var tipo_igv = $("#tipo_igv<?php echo $p->id_producto_precio;?>").val() * 1;
            var cadena = "codigo=" + cod +
                "&producto=" + producto +
                "&unids=" + unids +
                "&precio=" + precio +
                "&tipo_igv=" + tipo_igv +
                "&cantidad=" + cant;
            if(stock >= cant){
                $.ajax({
                    type:"POST",
                    url: urlweb + "api/Ventas/addproduct",
                    data : cadena,
                    success:function (r) {
                        switch (r) {
                            case "1":
                                respuesta('¡Producto Agregado!', 'success');
                                $('#tabla_productos').load(urlweb + 'Ventas/tabla_productos');
                                break;
                            case "2":
                                respuesta('Hubo Un Error');
                                break;
                            case "3":
                                respuesta('El Producto YA ESTA AGREGADO', 'error');
                                break;
                            default:
                                respuesta('¡Algo catastrofico ha ocurrido!', 'error');
                                break;
                        }
                    }
                });
            } else {
                respuesta('NO HAY STOCK DISPONIBLE','error');
            }

        }

        function onchangeund<?php echo $p->id_producto_precio;?>() {
            var cant = $("#total_product<?php echo $p->id_producto_precio;?>").val();
            var precio = $("#product_price<?php echo $p->id_producto_precio;?>").val();
            var subtotal = cant * precio;
            subtotal.toFixed(2);
            $("#total_price<?php echo $p->id_producto_precio;?>").val(subtotal);
        }

        function onchangeundprice<?php echo $p->id_producto_precio;?>() {
            var cant = $("#total_product<?php echo $p->id_producto_precio;?>").val();
            var precio = $("#product_price<?php echo $p->id_producto_precio;?>").val();
            var subtotal = cant * precio;
            subtotal.toFixed(2);
            subtotal = parseFloat(subtotal);
            $("#total_price<?php echo $p->id_producto_precio;?>").val(subtotal);
        }

        function onchangetotalprice<?php echo $p->id_producto_precio;?>() {
            var subtotal = $("#total_price<?php echo $p->id_producto_precio;?>").val();
            var cant = $("#total_product<?php echo $p->id_producto_precio;?>").val();
            var precio = subtotal / cant;
            precio.toFixed(2);
            $("#product_price<?php echo $p->id_producto_precio;?>").val(precio);
        }
        <?php
        }
        ?>

        function agregarPersona(nombre, numero, direccion, telefono, id_tipodocumento) {
            $("#client_number").val(numero);
            $("#client_name").val(nombre);
            $("#client_address").val(direccion);
            $("#client_telefono").val(telefono);
            $("#select_tipodocumento").val(id_tipodocumento);
            respuesta('El cliente se agregó correctamente!','success');

        }

        function onchangeundZ() {
            var cant = $("#product_cantb").val();
            var precio = $("#product_priceb").val();
            var subtotal = cant * precio;
            subtotal.toFixed(2);
            $("#product_totalb").val(subtotal);
        }

        function onchangeundpriceZ() {
            var cant = $("#product_cantb").val();
            var precio = $("#product_priceb").val();
            var subtotal = cant * precio;
            subtotal.toFixed(2);
            subtotal = parseFloat(subtotal);
            $("#product_totalb").val(subtotal);
        }

        function onchangetotalpriceZ() {
            var subtotal = $("#product_totalb").val();
            var cant = $("#product_cantb").val();
            var precio = subtotal / cant;
            precio.toFixed(2);
            $("#product_priceb").val(precio);
        }

        function buscar_producto_barcode() {
            var valor = "correcto";
            var product_barcode = $('#product_barcode').val();
            if(product_barcode == ""){
                alertify.error('El campo Código de Barra está vacío');
                $('#product_barcode').css('border','solid red');
                valor = "incorrecto";
            } else {
                $('#product_barcode').css('border','');
            }

            if (valor == "correcto"){
                var cadena = "product_barcode=" + product_barcode;
                $.ajax({
                    type:"POST",
                    url: urlweb + "api/Ventas/search_by_barcode",
                    data: cadena,
                    success:function (r) {
                        if(r=="2"){
                            alertify.error("ERROR O PRODUCTO NO REGISTRADO");
                            $('#product_nameb').val('');
                            $('#id_productforsaleb').val('');
                            $('#product_stockb').val('');
                            $('#product_priceb').val('');
                            $('#product_totalb').val('');
                            $('#codigo_afectacion').val('');
                            $('#product_cantb').val(1);
                            productfull = "";
                            unid = "";
                        } else {
                            var productoinfo = r.split('|');
                            var fullproductname = productoinfo[0];
                            productfull = fullproductname;
                            unid =  productoinfo[1];
                            $('#product_nameb').val(fullproductname);
                            $('#id_productforsaleb').val(productoinfo[3]);
                            $('#product_stockb').val(productoinfo[2]);
                            $('#product_priceb').val(productoinfo[5]);
                            $('#product_totalb').val(productoinfo[5]);
                            $('#product_cantb').val(1);
                            $('#codigo_afectacion').val(productoinfo[7]);
                            $("#busqueda").show();
                            $("#detalle").show();
                            $("#detalle_").show();
                            $("#general").show();
                            //$("#mostrar").show();
                            respuesta('PRODUCTO ENCONTRADO');
                        }
                    }
                });
            }
        }

        function agregarProductoZ() {
            var cod = $('#id_productforsaleb').val();
            var cant = $("#product_cantb").val() * 1;
            var precio = $("#product_priceb").val() * 1;
            var stock = $("#product_stockb").val() * 1;
            var tipo_igv = $("#codigo_afectacion").val();
            var cadena = "codigo=" + cod +
                "&producto=" + productfull +
                "&unids=" + unid +
                "&precio=" + precio +
                "&cantidad=" + cant +
                "&tipo_igv=" + tipo_igv;

            if(stock >= cant){
                $.ajax({
                    type:"POST",
                    url: urlweb + "api/Ventas/addproduct",
                    data : cadena,
                    success:function (r) {
                        switch (r) {
                            case "1":
                                respuesta('Producto Agregado');
                                $('#tabla_productos').load(urlweb + 'Ventas/tabla_productos');
                                $('#product_nameb').val('');
                                $('#id_productforsaleb').val('');
                                $('#product_stockb').val('');
                                $('#product_priceb').val('');
                                $('#product_totalb').val('');
                                $('#product_barcode').val('');
                                $('#codigo_afectacion').val('');
                                productfull = "";
                                unid = "";
                                $("#product_barcode").focus();
                                $("#general").hide();
                                break;
                            case "2":
                                respuesta('Hubo Un Error','error');
                                break;
                            case "3":
                                respuesta('El Producto YA ESTA AGREGADO','error');
                                break;
                            default:
                                respuesta('Hubo Un Error','error');
                                break;
                        }
                    }
                });
            } else {
                respuesta('NO HAY STOCK DISPONIBLE','error');
            }

        }
        function selecttipoventa(valor){
            Consultar_serie();
            var tipo_comprobante =  valor;
            $.ajax({
                type: "POST",
                url: urlweb + "api/Ventas/tipo_nota_descripcion",
                data: "tipo_comprobante="+tipo_comprobante,
                dataType: 'json',
                success:function (r) {
                    $("#nota_descripcion").html(r);
                }
            });
        }
        function Consultar_serie(){
            var tipo_documento_modificar = $('#Tipo_documento_modificar').val();
            var tipo_venta =  $("#tipo_venta").val();
            var concepto = "LISTAR_SERIE";
            var cadena = "tipo_venta=" + tipo_venta +
                "&concepto=" + concepto +
            "&tipo_documento_modificar=" + tipo_documento_modificar;
            $.ajax({
                type: "POST",
                url: urlweb + "api/Ventas/consultar_serie_nota",
                data: cadena,
                dataType: 'json',
                success:function (r) {
                    var series = "";
                    //var series = "<option value='' selected>Seleccione</option>";
                    for (var i=0; i<r.serie.length; i++){
                        series += "<option value='"+r.serie[i].id_serie+"'>"+r.serie[i].serie+"</option>"
                    }
                    $("#serie").html(series);
                    ConsultarCorrelativo();
                }

            });
        }
        function ConsultarCorrelativo(){
            var id_serie =  $("#serie").val();
            var concepto = "LISTAR_NUMERO";
            var cadena = "id_serie=" + id_serie +
                "&concepto=" + concepto;
            $.ajax({
                type: "POST",
                url: urlweb + "api/Ventas/consultar_serie",
                data: cadena,
                dataType: 'json',
                success:function (r) {
                    $("#numero").val(r.correlativo);
                }

            });
        }

        function consultar_documento(valor){
            var tipo_doc = $('#select_tipodocumento').val();
            if(tipo_doc == "2"){
                ObtenerDatosDni(valor);
            }else if(tipo_doc == "4"){
                ObtenerDatosRuc(valor);
            }
        }
        function ObtenerDatosDni(valor){
            var numero_dni =  valor;

            $.ajax({
                type: "POST",
                url: urlweb + "api/Clientes/obtener_datos_x_dni",
                data: "numero_dni="+numero_dni,
                dataType: 'json',
                success:function (r) {
                    $("#client_name").val(r.result.name+ ' ' + r.result.first_name+ ' ' + r.result.last_name);
                }
            });
        }
        function ObtenerDatosRuc(valor){
            var numero_ruc =  valor;

            $.ajax({
                type: "POST",
                url: urlweb + "api/Clientes/obtener_datos_x_ruc",
                data: "numero_ruc="+numero_ruc,
                dataType: 'json',
                success:function (r) {
                    $("#client_name").val(r.result.razon_social);
                }
            });
        }

    </script>
