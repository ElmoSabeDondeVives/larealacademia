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
                        Busqueda de Alumno
                    </div>
                    <div class="card-body shadow">
                        <form action="<?= _SERVER_.'Reporte/pagos/' ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="hidden" id="validate" name="validate" value="1">
                                    <label for="">Ingrese DNI o Nombre del Alumno</label>
                                    <input type="text" class="form-control" id="data_al" name="data_al" value="<?= $text ?>">
                                </div>
                                <div class="col-lg-12 mt-2 text-right">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-search"></i>Buscar</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <?php if ($data){ ?>
                <div class="col-lg-12 mt-4">
                    <div class="card shadow">
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
                                            <th>Numero Documento</th>
                                            <th>Opciones</th>
                                            </thead>
                                            <tbody>
                                            <?php $a=1; foreach ($config as $c){
                                                ?>
                                                <tr>
                                                    <td><?= $a ?> </td>
                                                    <td><?= $c->cliente_nombre ?> </td>
                                                    <td class="text-right"><?= $c->cliente_numero ?> </td>
                                                    <td class="text-center">
                                                        <a href="<?= _SERVER_.'Reporte/pagos_al/'.$c->id_cliente ?>" class="btn btn-sm btn-dark text-white"><i class="fa fa-eye"></i></a>
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
            <?php } ?>

        </div>



    </section>

</div>

<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>aula.js"></script>