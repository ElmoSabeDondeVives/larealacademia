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
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        BUSQUEDA
                    </div>
                    <div class="card-body">
                        <form action="<?= _SERVER_.'Aula/consulta_d/'.$_GET['id'] ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-6 ">
                                    <input type="hidden" id="validate" name="validate" value="1">
                                    <label for="fecha_b">Fecha:</label>
                                    <input type="date" id="fecha_b" name="fecha_b" value="<?= $fecha_b ?>" class="form-control"  >
                                </div>
                                <div class="col-lg-6 mt-4">
                                    <button type="submit" class="btn btn-md btn-success mt-2"> <i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
                                        <th>Alumno</th>
                                        <th>Documento</th>
                                        <th>Fecha - Hora</th>

                                        <th>Estado</th>

                                        </thead>
                                        <tbody>
                                        <?php $a=1; foreach ($lista as $c){
                                            ($c->estado==0)?$estado='Habilitado': $estado='Deshabilitado';?>
                                            <tr>
                                                <td><?= $a ?> </td>
                                                <td><?= $c->cliente_nombre ?> </td>
                                                <td><?= $c->cliente_numero ?> </td>
                                                <td><?= $c->asistencia_creacion?> </td>
                                                <td><?= $estado?> </td>

                                            </tr>
                                            <?php $a++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <a href="<?= _SERVER_ ; ?>index.php?c=Aula&a=consulta_pdf&fecha_b=<?= $fecha_b?>&id=<?= $_GET['id']?>" class="btn btn-md btn-danger" > <i class="fa fa-file-pdf-o"></i> IMPRIMIR</a>
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