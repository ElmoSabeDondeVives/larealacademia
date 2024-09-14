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
                        Alumno:
                    </div>
                    <div class="card-body shadow">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="">Nombre:</label><br>
                                <label for=""><?= $cursos->cliente_nombre ?></label>
                            </div>
                            <div class="col-lg-4">
                                <label for="">Documento:</label><br>
                                <label for=""><?= $cursos->cliente_numero ?></label>
                            </div>
                            <div class="col-lg-4">
                                <label for="">Clase:</label><br>
                                <label for=""><?= $cursos->descripcion ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <div class="card shadow">
                    <div class="card-header">
                        RESULTADOS
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12">
                               <div class="table table-responsive">
                                   <table id="dataTable" class="table table-bordered">
                                       <thead>
                                       <th>#</th>
                                       <th>Fecha de Ingreso</th>
                                       <th>Fecha de Salida</th>
                                       </thead>
                                       <tbody>
                                       <?php $a =1; foreach ($list as $l){ ?>
                                       <tr>
                                           <td><?= $a ?></td>
                                           <td><?= $l->asistencia_creacion ?></td>
                                           <td><?= $l->asistencia_salida ?></td>
                                       </tr>
                                       <?php $a++; } ?>
                                       </tbody>
                                   </table>
                               </div>
                            </div>
                            <div class="col-lg-12 text-center d-none">
                                <a href="" class="btn btn-md btn-danger">Imprimir <i class="fa fa-file-pdf-o"></i></a>
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
