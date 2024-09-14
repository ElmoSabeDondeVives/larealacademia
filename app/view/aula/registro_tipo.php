<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 02/11/2018
 * Time: 0:36
 */
?>
<!-- Modal Restablecer Contraseña-->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Modalidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div id="persona">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="">Modalidad de Enseñanza</label>
                                <input type="text" class="form-control" id="modalidad" name="modalidad" placeholder="Ingrese Modalidad" >
                            </div>
                            <div class="col-lg-6">
                                <label for="">Tipo de Asistencia</label>
                                <select name="tipo_asis" id="tipo_asis" class="form-control">
                                    <option value="0">POR CLASE</option>
                                    <option value="1">POR DIA</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close fa-sm text-white-50"></i> Cerrar</button>
                <button type="button" class="btn btn-success" id="btn-editar-contra" onclick="preguntar('¿Esta seguro que desea guardar el Aula?','save_tipo','SI','NO')"><i class="fa fa-save fa-sm text-white-50"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- EDITAR OPCION  -->
<div class="modal fade" id="edit_tipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Modalidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div id="persona">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="hidden" id="id_oc" >
                                <label for="">Modalidad de Enseñanza</label>
                                <input type="text" class="form-control" id="modalidad_edit" name="modalidad_edit" placeholder="Ingrese Modalidad" >
                            </div>
                            <div class="col-lg-6">
                                <label for="">Tipo de Asistencia</label>
                                <select name="tipo_asis_edit" id="tipo_asis_edit" class="form-control">
                                    <option value="0">POR CLASE</option>
                                    <option value="1">POR DIA</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label for="">Estado</label>
                                <select name="estado_tipo" id="estado_tipo" class="form-control">
                                    <option value="0">HABILITADO</option>
                                    <option value="1">DESHABILITADO</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close fa-sm text-white-50"></i> Cerrar</button>
                <button type="button" class="btn btn-success" id="btn-editar-contra" onclick="preguntar('¿Esta seguro que desea guardar el Aula?','save_tipo_edit','SI','NO')"><i class="fa fa-save fa-sm text-white-50"></i> Guardar</button>
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
            <div class="col-lg-12 mb-3 text-right">
                <a class="btn btn-sm btn-success text-white" data-toggle="modal" data-target="#register" >  <i class="fa fa-plus"></i> Agregar</a>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Lista de MODALIDADES
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable">
                                <thead >
                                <th>#</th>
                                <th>MODALIDAD</th>
                                <th>FECHA CREACION</th>
                                <th>ESTADO</th>
                                <th>OPCIONES</th>
                                </thead>
                                <tbody>
                                <?php $a=1; foreach ( $list as $l){
                                    ($l->estado==0)?$estado='Habilitado': $estado='Deshabilitado';
                                    ?>

                                    <tr class="text-center">
                                        <td><?=  $a   ?></td>
                                        <td><?=  $l->nombre   ?></td>
                                        <td><?=  $l->creacion   ?></td>
                                        <td><?=  $estado   ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-success text-white" data-toggle="modal" data-target="#edit_tipo" onclick="data('<?= $l->id ?>','<?= $l->nombre ?>','<?= $l->estado ?>','<?= $l->modalidad_asistencia    ?>')" ><i class="fa fa-edit"></i></a>
                                            <!--<a class="btn btn-sm btn-danger text-white" onclick="preguntar('La información se deshabilitara, ¿ Estas Seguro ?','delete_i', 'SI','NO','<?/*= $l->id */?>')"><i class="fa fa-trash"></i></a>-->
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
    </section>

</div>
<script>
    function data(id, nombre, estado,tipo){
        $('#id_oc').val(id);
        $('#modalidad_edit').val(nombre);
        $('#estado_tipo').val(estado);
        $('#tipo_asis_edit').val(tipo);
    }
</script>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>aula.js"></script>