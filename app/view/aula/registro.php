<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 02/11/2018
 * Time: 0:36
 */
?>
<!-- Modal Restablecer Contraseña-->
<div class="modal fade" id="config" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CONFIGURAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div id="persona">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Descripción</label>
                                <input type="text" onkeyup="mayuscula(this.id)" class="form-control" id="descrip" name="descrip" placeholder="Ingrese un nombre para el aula">
                            </div>
                            <div class="col-lg-6">
                                <label for="id_aula">Aula: </label>
                                <select name="id_aula" id="id_aula" class="form-control">
                                    <?php foreach ($la as $l){ ?>
                                        <option value="<?= $l->id ?>"> <?= $l->nombre?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="id_turno">Turno: </label>
                                <select name="id_turno" id="id_turno" class="form-control">
                                    <?php foreach ($lt as $l_){ ?>
                                        <option value="<?= $l_->id ?>"> <?= $l_->ingreso.' / '.$l_->salida?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="id_modalidad">Modalidad: </label>
                                <select name="id_modalidad" id="id_modalidad" class="form-control">
                                    <?php foreach ($lti as $l_i){ ?>
                                        <option value="<?= $l_i->id ?>"> <?= $l_i->nombre  ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="">Fecha Inicio</label>
                                <input type="date" class="form-control" id="fecha_ini" name="fecha_ini" value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Fecha Término</label>
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="col-lg-12">
                                <label for="">Seleccione Días </label>
                            </div>
                            <div class="col-lg-12 text-justify" >
                                <input type="checkbox" class="ch" id="lunes" name="dia" value="2"> <label for="lunes">Lunes</label>
                                <input type="checkbox" id="martes" value="3"  name="dia"> <label for="martes">Martes</label>
                                <input type="checkbox" id="miercoles" value="4"  name="dia"> <label for="miercoles">Miercoles</label>
                                <input type="checkbox" id="jueves" value="5"  name="dia"> <label for="jueves">Jueves</label>
                            </div>
                            <div class="col-lg-12">

                                <input type="checkbox" id="viernes" value="6"  name="dia"> <label for="viernes">Viernes</label>
                                <input type="checkbox" id="sabado" value="7"  name="dia"> <label for="sabado">Sabado</label>
                                <input type="checkbox" id="domingo" value="1"  name="dia"> <label for="domingo">Domingo</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close fa-sm text-white-50"></i> Cerrar</button>
                <button type="button" class="btn btn-success" id="btn-editar-contra" onclick="preguntar('¿Esta seguro que desea guardar el Aula?','save_config','SI','NO')"><i class="fa fa-save fa-sm text-white-50"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_config" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">EDITAR CONFIGURAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div id="persona">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" id="id_aula_c">
                                <label for="edit_descrip">Descripción</label>
                                <input type="text" onkeyup="mayuscula(this.id)" class="form-control" id="edit_descrip" name="edit_descrip" placeholder="Ingrese un nombre para el aula">
                            </div>
                            <div class="col-lg-6">
                                <label for="edit_id_aula">Aula: </label>
                                <select name="edit_id_aula" id="edit_id_aula" class="form-control">
                                    <?php foreach ($la as $l){ ?>
                                        <option value="<?= $l->id ?>"> <?= $l->nombre?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="edit_id_turno">Turno: </label>
                                <select name="edit_id_turno" id="edit_id_turno" class="form-control">
                                    <?php foreach ($lt as $l_){ ?>
                                        <option value="<?= $l_->id ?>"> <?= $l_->ingreso.' / '.$l_->salida?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="edit_id_modalidad">Modalidad: </label>
                                <select name="edit_id_modalidad" id="edit_id_modalidad" class="form-control">
                                    <?php foreach ($lti as $l_i){ ?>
                                        <option value="<?= $l_i->id ?>"> <?= $l_i->nombre  ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="">Fecha Inicio</label>
                                <input type="date" class="form-control" id="edit_fecha_ini" name="edit_fecha_ini" value="">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Fecha Término</label>
                                <input type="date" class="form-control" id="edit_fecha_fin" name="edit_fecha_fin" value="">
                            </div>
                            <div class="col-lg-6">
                                <label for="edit_estado">Estado</label>
                                <select name="edit_estado" id="edit_estado" class="form-control">
                                    <option value="0">Habilitado</option>
                                    <option value="1">Deshabilitado</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label for="">Seleccione Días </label>
                            </div>
                            <div class="col-lg-12 text-justify" >
                                <input type="checkbox" id="e_lunes" name="e_dia" value="2"> <label for="e_lunes">Lunes</label>
                                <input type="checkbox" id="e_martes" value="3"  name="e_dia"> <label for="e_martes">Martes</label>
                                <input type="checkbox" id="e_miercoles" value="4"  name="e_dia"> <label for="e_miercoles">Miercoles</label>
                                <input type="checkbox" id="e_jueves" value="5"  name="e_dia"> <label for="e_jueves">Jueves</label>
                            </div>
                            <div class="col-lg-12">

                                <input type="checkbox" id="e_viernes" value="6"  name="e_dia"> <label for="e_viernes">Viernes</label>
                                <input type="checkbox" id="e_sabado" value="7"  name="e_dia"> <label for="e_sabado">Sabado</label>
                                <input type="checkbox" id="e_domingo" value="1"  name="e_dia"> <label for="e_domingo">Domingo</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close fa-sm text-white-50"></i> Cerrar</button>
                <button type="button" class="btn btn-success" id="btn-editar-contra" onclick="preguntar('¿Esta seguro que desea guardar el Aula?','edit_config','SI','NO')"><i class="fa fa-save fa-sm text-white-50"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- Content Wrapper. Contains page content -->
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header text-left">
        <hr>
        <h2 class="concss" style="text-align: left !important;">
            <a href="<?= _SERVER_?>"><i class="fa fa-fire"></i> INICIO</a> >
            <a href="<?= _SERVER_?>Clientes"><i class="<?php echo $_SESSION['icono'];?>"></i> <?php echo $_SESSION['controlador'];?></a> >
            <i class="<?php echo $_SESSION['icono'];?>" ></i> <?php echo $_SESSION['accion'];?>
        </h2>

        <hr>
    </section>

    <section class="container-fluid">
        <div class="row">
            <div class="col-lg-3 text-center">
                <a href="<?= _SERVER_.'aula/registro_aula' ?>" class="btn btn-md btn-info"> <i class="fa fa-pencil"></i>  Aulas</a>
            </div>
            <div class="col-lg-3 text-center">
                <a href="<?= _SERVER_.'aula/registro_turno' ?>" class="btn btn-md btn btn-warning"><i class="fa fa-pencil"></i>  Turnos </a>
            </div>
            <div class="col-lg-3 text-center">
                <a href="<?= _SERVER_.'aula/registro_tipo' ?>" class="btn btn-md btn-danger"><i class="fa fa-pencil"></i>   Modalidades</a>
            </div>
            <div class="col-lg-3 text-center">
                <a  class="btn btn-md btn-dark text-white" data-toggle="modal" data-target= "#config" > <i class="fa fa-cog"></i> Configurar</a>
            </div>



        </div>
        <!-- /.row -->

        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        RESULTADOS
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                        <th>#</th>
                                        <th>Descripción</th>
                                        <th>Aula</th>
                                        <th>Horario</th>
                                        <th>Modalidad</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                        </thead>
                                        <tbody>
                                        <?php $a=1; foreach ($config as $c){
                                            ($c->estado==0)?$estado='Habilitado': $estado='Deshabilitado';?>
                                            <tr>
                                                <td><?= $a ?> </td>
                                                <td><?= $c->descripcion ?> </td>
                                                <td><?= $c->aula_nombre ?> </td>
                                                <td><?= $c->ingreso. ' / '.$c->salida ?> </td>
                                                <td><?= $c->modalidad_nombre?> </td>
                                                <td><?= $estado?> </td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#edit_config" onclick="data('<?= $c->id_aula ?>','<?= $c->id_aula ?>','<?= $c->id_turno ?>','<?= $c->id_modalidad ?>','<?= $c->descripcion ?>','<?= $c->estado?>', '<?= $c->aula_fecha_ini ?>', '<?= $c->aula_fecha_fin ?>', '<?= $c->aula_dias ?>' )" class="btn btn-sm btn-success text-white"><i class="fa fa-edit"></i> </a>

                                                    <!--<a class="btn btn-sm btn-danger text-white"><i class="fa fa-trash"></i></a>-->
                                                </td>
                                            </tr>
                                        <?php $a++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>

</div>

<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>aula.js"></script>
<script>
    function data (id, aula, turno,modalidad,descripcion,estado, fecha_ini, fecha_fin,dias){
        $('#id_aula_c').val(id);
        $('#edit_id_aula').val(aula);
        $('#edit_id_turno').val(turno);
        $('#edit_id_modalidad').val(modalidad);
        $('#edit_descrip').val(descripcion);
        $('#edit_estado').val(estado);
        $('#edit_fecha_ini').val(fecha_ini);
        $('#edit_fecha_fin').val(fecha_fin);
        var dat = dias.split('/');

        dat.map( el => {
            console.log(el)
            switch (el){
                case '1': document.getElementById("e_domingo").checked = true; break;
                case '2': document.getElementById("e_lunes").checked = true; break;
                case '3': document.getElementById("e_martes").checked = true; break;
                case '4': document.getElementById("e_miercoles").checked = true; break;
                case '5': document.getElementById("e_jueves").checked = true; break;
                case '6': document.getElementById("e_viernes").checked = true; break;
                case '7': document.getElementById("e_sabado").checked = true; break;
            }

        } )
    }
    function edit_config(){
        var valor = true;
        let estado = $('#edit_estado').val();
        let id_c = $('#id_aula_c').val();
        let descrip = $('#edit_descrip').val();
        let aula = $('#edit_id_aula').val();
        let turno = $('#edit_id_turno').val();
        let moda = $('#edit_id_modalidad').val();
        var fecha_ini = $('#edit_fecha_ini').val();
        var fecha_fin = $('#edit_fecha_fin').val();
        var total = '';
        $('input[name="edit_dia"]:checked').each(function(){
            var tval = $(this).val();
            total += '/'+ parseFloat(tval);
        });

        valor = validar_campo_vacio('edit_descrip', descrip, valor);
        valor = validar_campo_vacio('edit_id_aula', aula, valor);
        valor = validar_campo_vacio('edit_id_turno', turno, valor);
        valor = validar_campo_vacio('edit_id_modalidad', moda, valor);

        if (valor){
            $.ajax({
                type: "POST",
                url: urlweb + "api/Aula/edit_config",
                data: {estado: estado,id_c: id_c,descrip: descrip, aula: aula, turno:turno, moda:moda, fecha_ini: fecha_ini, fecha_fin:fecha_fin,total:total},
                dataType: 'json',
                success:function (r) {
                    switch (r.result.code) {
                        case 1:
                            respuesta('¡Modalidad Agregada Exitosamente!', 'success');
                            setTimeout(function () {
                                location.reload()
                            }, 1000);
                            break;
                        case 2:
                            respuesta('Error al agregar Modalidad', 'error');
                            break;
                        default:
                            respuesta('¡Algo catastrofico ha ocurrido!', 'error');
                            break;
                    }
                }
            });
        }
    }
</script>