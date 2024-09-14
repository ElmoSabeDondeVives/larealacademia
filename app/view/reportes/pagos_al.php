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
            <div class="col-lg-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <label for="">Alumno:  <?= $al->cliente_nombre ?></label>
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
                                    <div class="table-responsive">
                                        <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                            <th>#</th>
                                            <th>SERIE</th>
                                            <th>CORRELATIVO</th>
                                            <th>FECHA</th>
                                            <th>MONTO</th>
                                            <th>Opciones</th>
                                            </thead>
                                            <tbody>
                                            <?php $a=1; foreach ($config as $c){
                                                ?>
                                                <tr>
                                                    <td><?= $a ?> </td>
                                                    <td><?= $c->venta_serie. '-'.$c->venta_correlativo  ?> </td>
                                                    <td class="text-left">
                                                        <?php $detalles=$this->reporte->detalles_venta($c->id_venta); foreach ($detalles as $d){

                                                        ?>
                                                            <p><i class="fa fa-file-text"></i> <?= $d->venta_detalle_nombre_producto?></p>
                                                        <?php }  ?>

                                                    </td>
                                                    <td class="text-right"><?= $c->venta_fecha ?> </td>
                                                    <td class="text-right"><?= $c->venta_total ?> </td>
                                                    <td class="text-center">
                                                        <a href="<?= _SERVER_.'Notas/reporte/'.$c->id_cliente ?>" class="btn btn-sm btn-dark text-white"><i class="fa fa-eye"></i></a>
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