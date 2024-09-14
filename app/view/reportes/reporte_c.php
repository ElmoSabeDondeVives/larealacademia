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
                        <form action="<?= _SERVER_.'Reporte/reporte_c/' ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-4">
                                    <input type="hidden" id="validate" name="validate" value="1">
                                    <label for="">Aulas</label>
                                    <select name="id_clase" id="id_clase" class="form-control">
                                        <?php foreach ($list as $l){ ?>
                                            <option value="<?= $l->id ?>"><?= $l->descripcion .' |'.$l->ingreso .'/'.$l->salida.' |'.$l->modalidad_nombre ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="">Fecha de Inicio</label>
                                    <input type="date" id="fecha_ini" name="fecha_ini" value="<?= $fecha_ini ?>" class="form-control">
                                </div>
                                <div class="col-lg-4">
                                    <label for="">Fecha de Fin</label>
                                    <input type="date" id="fecha_fin" name="fecha_fin" value="<?= $fecha_fin ?>" class="form-control">
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
                                            <th>Detalle</th>
                                            <th>Venta</th>
                                            <th>Monto</th>
                                            <th>Opciones</th>
                                            </thead>
                                            <tbody>
                                            <?php $a=1; foreach ($config as $c){
                                                $detalles= $this->reporte->detalles_venta($c->id_venta);
                                                ?>
                                                <tr>
                                                    <td><?= $a ?> </td>
                                                    <td>
                                                        <?= $c->cliente_nombre ?>
                                                        <p><?= $c->cliente_numero ?></p>
                                                    </td>
                                                    <td class="text-left"><?php foreach ($detalles as $d){ echo $d->venta_detalle_nombre_producto; } ?> </td>
                                                    <td class="text-left"><?= $c->venta_serie.'-'.$c->venta_correlativo ?> </td>
                                                    <td class="text-left"><?= $c->venta_total ?> </td>
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