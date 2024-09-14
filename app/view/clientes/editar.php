<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 02/11/2018
 * Time: 0:36
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION['controlador'] . ' / ' . $_SESSION['accion'];?></h1>
    </section>

    <br>
    <section class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">

                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-form-label">Tipo de Documento</label>
                                <input type="hidden" id="id_cliente" name="id_cliente" value="<?= $id;?>">
                                <select id="id_tipo_documento" class="form-control" onchange="escoger_tipodocumento_editar(this.value)">
                                    <option value="0">Seleccione el tipo de documento...</option>
                                    <?php
                                    foreach($tipo_documento as $l){
                                        ?>
                                        <option <?php echo ($l->id_tipodocumento == $clientes->id_tipodocumento) ? 'selected' : '';?> value="<?php echo $l->id_tipodocumento;?>"><?php echo $l->tipodocumento_identidad;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="div_documento_dni">
                                <div class="form-group">
                                    <label class="col-form-label">Documento de Identidad</label>
                                    <input type="tel" class="form-control" id="cliente_numero" placeholder="Ingresar Número..." value="<?= $clientes->cliente_numero; ?>" pattern="[0-9]{8}" onkeypress="return valida(event)">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Nombre del Cliente</label>
                                    <input type="text" class="form-control" onkeyup="mayuscula(this.id)" id="cliente_nombre" value="<?= $clientes->cliente_nombre;?>" placeholder="Ingresar Nombre del Cliente...">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Razón social</label>
                                    <input type="text" class="form-control" id="cliente_razonsocial" value="<?= $clientes->cliente_razonsocial;?>" placeholder="Ingresar Nombre del Cliente...">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Domicilio Fiscal</label>
                                    <textarea type="text" class="form-control" id="cliente_direccion" placeholder="Ingresar Dirección..."><?= $clientes->cliente_direccion;?></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Teléfono o Celular</label>
                                    <input type="text" class="form-control" id="cliente_telefono" placeholder="Ingresar Teléfono o Celular..." value="<?= $clientes->cliente_telefono;?>" onkeypress="return valida(event)">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Correo</label>
                                    <input type="email" class="form-control" id="cliente_correo" value="<?= $clientes->cliente_correo;?>" placeholder="Ingresar correo válido..." >
                                </div>
                                <div class="form-group">
                                    <label for="id_tipo" class="col-form-label"  >Tipo</label>
                                    <select name="id_tipo" id="id_tipo" class="form-control">
                                        <option value="0" <?= ($clientes->cliente_tipo==0)?'selected':''; ?>>Alumno</option>
                                        <option value="1" <?= ($clientes->cliente_tipo == 1 )?'selected':''; ?> >Docente</option>
                                        <option value="2" <?= ($clientes->cliente_tipo == 1 )?'selected':''; ?> >Personal</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_curso">CURSOS <label class="text-danger">(*No necesario en caso de ser Docente)</label></label>
                                    <select name="id_curso" id="id_curso" class="form-control">
                                        <option value="0">----------</option>
                                        <?php foreach ($horarios as $h){ ?>
                                            <option value="<?= $h->id_horario ?>" <?= ($h->id_horario==$clientes->cliente_horario)?'selected':''; ?> ><?= $h->descripcion .' ('. $h->aula_nombre .') '.$h->modalidad_nombre.' |' .$h->ingreso.'/'.$h->salida  ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                        <label for="id_carrera">CARRERA A LA QUE POSTULA <label for="" class="text-danger">(* No necesario en Docente)</label></label>
                                        <select name="id_carrera" id="id_carrera" class="form-control">
                                            <option value="0">-----------------------------</option>
                                            <?php foreach ($carreras as $ca){ ?>
                                                <option value="<?= $ca->id_carrera ?>"   <?= ($ca->id_carrera==$clientes->id_carrera)?'selected':''; ?>  ><?= $ca->carrera_descripcion  ?></option>

                                            <?php } ?>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="procedencia">COLEGIO DE PROCEDENCIA</label>
                                    <input type="text" class="form-control" id="procedencia" value="<?= $clientes->cliente_procedencia ?>">
                                </div>
                                <div class="form-group">
                                    <label for="postulaciones">NUMERO DE POSTULACIONES</label>
                                    <input type="number" class="form-control" id="postulaciones" value="<?= $clientes->cliente_num_postulacion ?>">
                                </div>
                                <div class="form-group">
                                    <label for="apoderado">NOMBRES Y APELLIDOS APODERADO</label>
                                    <input type="text" class="form-control" id="apoderado" value="<?= $clientes->cliente_apoderado ?>">
                                </div>
                                <div class="form-group">
                                    <label for="apoderado">CELULAR APODERADO</label>
                                    <input type="text" class="form-control" id="cel_apoderado" value="<?= $clientes->cliente_apoderado_cel ?>">
                                </div>
                                <div class="form-group">
                                    <label for="apoderado">OBSERVACIONES</label>
                                    <input type="text" class="form-control" id="observaciones" value="<?= $clientes->cliente_obs ?>">
                                </div>
                                <div class="form-group">
                                    <form method="post" enctype="multipart/form-data" id="cliente_foto">
                                        <input type="hidden" id="id_cliente" name="id_cliente" value="<?= $_GET['id']?>">
                                    <label for="foto_cliente" class="btn btn-sm btn-success">Subir Foto</label>
                                    <input type="file" id="foto_cliente" name="foto_cliente" class="d-none">
                                        <div id="carga_de_imagen">

                                        </div>
                                        <div id="btn_guardar">
                                            <button type="submit" class="btn btn-sm btn-info"> Guardar Foto</button>
                                        </div>

                                    </form>
                                </div>
                                <div class="form-group" style="text-align: center">
                                    <button id="btn-agregar" class="btn btn-success" onclick="guardar_editar()"><i class="fa fa-check"></i> Guardar Cambios</button>
                                    <a class="btn btn-secondary" href="javascript:history.back()" role="button"><i class="fa fa-backward"></i> Regresar</a>
                                </div>
                            </div>

                            <!--FORMULARIO PARA LA AGREGACION DEL RUC-->
                            <div id="div_documento_ruc">
                                <div class="form-group">
                                    <label class="col-form-label">Razón social</label>
                                    <input type="text" class="form-control" onkeyup="mayuscula(this.id)" id="cliente_razonsocial_ruc" value="<?= $clientes->cliente_razonsocial;?>" placeholder="Ingresar Nombre del Cliente...">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">RUC</label>
                                    <input type="text" class="form-control" id="cliente_numero_ruc" value="<?= $clientes->cliente_numero;?>" placeholder="Ingresar Número..." onkeypress="return valida(event)">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Domicilio Fiscal</label>
                                    <textarea type="text" class="form-control" id="cliente_direccion_ruc" placeholder="Ingresar Dirección..."><?= $clientes->cliente_direccion;?></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Teléfono o Celular</label>
                                    <input type="text" class="form-control" id="cliente_telefono_ruc" value="<?= $clientes->cliente_telefono;?>" placeholder="Ingresar Teléfono o Celular..." onkeypress="return valida(event)">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Correo</label>
                                    <input type="email" class="form-control" id="cliente_correo_ruc" value="<?= $clientes->cliente_correo;?>" placeholder="Ingresar correo válido..." >
                                </div>

                                <div class="form-group">
                                    <button id="btn-editar" class="btn btn-success" onclick="guardar_editar_ruc()"><i class="fa fa-check"></i> Guardar Cambios</button>

                                    <a class="btn btn-secondary" href="javascript:history.back()" role="button"><i class="fa fa-backward"></i> Regresar</a>

                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
    <script src="<?php echo _SERVER_ . _JS_;?>clientes.js"></script>

    <script type="text/javascript">

        $(document).ready(function(){
            var valor = $('#id_tipo_documento').val();
            escoger_tipodocumento_editar(valor);
        });

        function escoger_tipodocumento_editar(valor){
            if(valor === '0'){
                $('#div_documento_dni').hide();
                $('#div_documento_ruc').hide();
            }else if(valor === '2'){
                $('#div_documento_dni').show();
                $('#div_documento_ruc').hide();
            }
            else if (valor === '4') {
                $('#div_documento_dni').hide();
                $('#div_documento_ruc').show();
            } else{
                $('#div_documento_dni').hide();
                $('#div_documento_ruc').hide();
            }
        }

        document.getElementById("foto_cliente").onchange = function(e) {
            // Creamos el objeto de la clase FileReader
            let reader = new FileReader();

            // Leemos el archivo subido y se lo pasamos a nuestro fileReader
            reader.readAsDataURL(e.target.files[0]);

            // Le decimos que cuando este listo ejecute el código interno
            reader.onload = function(){
                let preview = document.getElementById('carga_de_imagen'),
                    image = document.createElement('img');
                $('#btn_guardar').show();

                image.src = reader.result;

                preview.innerHTML = '';
                preview.append(image);
            };
        }
        $("#cliente_foto").on('submit', function(e){
            e.preventDefault();
            var valor = true;
            //Definimos el botón que activa la función
            var boton = "btn-agregar-usuario";
            //Extraemos las variable según los valores del campo consultado


            //Si var valor no ha cambiado de valor, procedemos a hacer la llamada de ajax
            if(valor){
                //Cadena donde enviaremos los parametros por POST
                $.ajax({
                    type: "POST",
                    url: urlweb + "api/Clientes/guardar_foto",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    dataType: 'json',

                    success:function (r) {

                        switch (r.result.code) {
                            case 1:
                                respuesta('¡Guardado Correctamente! Recargando...', 'success');

                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                                break;
                            case 2:
                                respuesta('Error al guardar', 'error');
                                break;
                            default:
                                respuesta('¡Algo catastrofico ha ocurrido!', 'error');
                                break;
                        }
                    }
                });
            }
        });


    </script>
    <style>
        div #carga_de_imagen img {
            width:50%; height: 50%;
            border: dashed;
        }
        div #btn_guardar {
            display: none;
        }

    </style>
