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
                                                    <a href="<?= _SERVER_.'Aula/consulta_d/'.$c->id_aula ?>" target="_blank" class="btn btn-sm btn-dark text-white"><i class="fa fa-eye"></i> Asistencia </a>


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