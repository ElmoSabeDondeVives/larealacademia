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
                <h5 class="modal-title">Registrar Aula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div id="persona">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Descripcion</label>
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
                                                    <a href=" <?= _SERVER_.'Notas/ingreso/'.$c->id ?> " class="btn btn-sm btn-info"> Ingresar Notas </a>
                                                    <br>
                                                    <a href=" <?= _SERVER_.'Notas/consulta/'.$c->id ?> " class="btn btn-sm btn-success mt-1"> Consulta Notas </a>
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