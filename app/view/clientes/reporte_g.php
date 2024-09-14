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
                            <div class="col-lg-12 text-right">
                                <a href="" class="btn btn-md btn-danger">Imprimir <i class="fa fa-file-pdf-o"></i></a>
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
                        <!-- SIGUIENTE REPORTE  -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h5>REPORTE DE PAGOS</h5>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="" class="table table-hover" width="100%" cellspacing="0">
                                        <thead>
                                        <th>#</th>
                                        <th>SERIE</th>
                                        <th>CORRELATIVO</th>
                                        <th>FECHA</th>
                                        <th>MONTO</th><!--
                                        <th>Opciones</th>-->
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
                                                <td class="text-left"><?= $c->venta_fecha ?> </td>
                                                <td class="text-left"><?= $c->venta_total ?> </td>
                                                <!--<td class="text-center">
                                                    <a href="<?/*= _SERVER_.'Notas/reporte/'.$c->id_cliente */?>" class="btn btn-sm btn-dark text-white"><i class="fa fa-eye"></i></a>
                                                </td>-->
                                            </tr>
                                            <?php $a++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- SIGUIENTE REPORTE -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h5>REPORTE DE ASISTENCIA DEL ALUMNO</h5>
                            </div>
                            <div class="col-lg-12 text-center">
                                <label > <i class="fa fa-square text-success"></i> Asistencia </label>
                                <label > <i class="fa fa-square text-warning"></i> Tardanza </label>
                                <label > <i class="fa fa-square text-danger"></i> Falta </label>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive" style="display: flex">
                                        <?php
                                        $tardanzas=0;
                                        $faltas=0;
                                        $puntualidades=0;
                                        foreach ($data as $d){

                                                switch ($d["dia"]){
                                                    case 1: $dia ='Domingo'; break;
                                                    case 2: $dia ='Lunes'; break;
                                                    case 3: $dia ='Martes'; break;
                                                    case 4: $dia ='Miercoles'; break;
                                                    case 5: $dia ='Jueves'; break;
                                                    case 6: $dia ='Viernes'; break;
                                                    case 7: $dia ='Sabado'; break;
                                                }
                                                ?>
                                            <table  class="table table-hover">
                                            <thead>
                                                <tr><th class="text-center"><?= $dia?></th></tr>
                                            </thead>
                                            <tbody>

                                            <?php

                                            foreach ($d["fecha"] as $f) {
                                                $dias = $f->DIASENTREFECHAS;
                                                $date1 = new DateTime('2023-01-24');
                                                $date2 = new DateTime(date('Y-m-d'));


                                                if ($f->DIASENTREFECHAS <= date('Y-m-d') ){
                                                    $estado = $this->asistencia->consulta_alumno_fecha($_GET['id'],$f->DIASENTREFECHAS);
                                                    switch ($estado){
                                                        case 0: $estado ='<i class="fa fa-square text-success"></i>  '; $puntualidades++; break;
                                                        case 1: $estado ='<i class="fa fa-square text-warning"></i>'; $tardanzas++; break;
                                                        case 8: $estado ='<i class="fa fa-square text-danger"></i>'; $faltas++; break;
                                                    }
                                                }else{
                                                    $estado='<i class="fa fa-square "></i>';
                                                }

                                                ?>
                                                    <tr>
                                                        <td class="text-center
">
                                                            <?= $estado ?>
                                                            <br>
                                                            <?= $f->DIASENTREFECHAS; ?>


                                                        </td>
                                                    </tr>
                                                    <?php
                                            }
                                            ?>
                                            </tbody>
                                            </table>
                                        <?php }  ?>



                                        <?php  ?>



                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label for=""><i class="fa fa-square text-success"></i> Total Asistencias: <?= $puntualidades ?></label><br>
                                <label for=""><i class="fa fa-square text-warning"></i> Total Tardanzas: <?= $tardanzas ?></label><br>
                                <label for=""><i class="fa fa-square text-danger"></i> Total Faltas: <?= $faltas ?></label>
                            </div>

                        </div>
                        <hr>
                        <!--   SIGUIENTE REPORTE  -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h5>REPORTE DE NOTAS</h5>
                            </div>
                            <?php
                            $fechas = array();
                            $notas = array();
                            foreach ($list as $l){
                                $name = $this->notas->notas_clase($l->id_curso,$_GET['id']);
                                foreach ($name as $n){
                                    $fechas[]='\''.$n->fecha_nota.'\'';
                                    $notas[]='\''.$n->notita.'\'';
                                }
                                $fechas_p = implode(',',$fechas);
                                $notas_p = implode(',',$notas);

                                ?>
                                <div class="col-lg-12">
                                    <label for=""><?= $l->descripcion ?></label>
                                </div>
                                <div class="col-lg-12">
                                    <canvas id="line-chart<?= $l->id_curso?>" style="width: 1000px !important; height: 500px !important;display: flex"></canvas>
                                    <script>

                                        new Chart(document.getElementById("line-chart<?= $l->id_curso ?>"), {
                                            type: 'line',
                                            data: {
                                                labels: [<?= $fechas_p ?>],
                                                datasets: [{
                                                    data: [<?= $notas_p ?>],
                                                    label: "<?= $l->descripcion ?>",
                                                    borderColor: "#6a0c0d",
                                                    fill: false
                                                }]
                                            },
                                            options: {
                                                title: {
                                                    display: true,
                                                    text: '<?= $l->descripcion ?>'
                                                }
                                            }
                                        });

                                    </script>
                                </div>


                                <?php  $notas = array();
                                $fechas  = array();  } ?>
                        </div>


                    </div>
                </div>
            </div>
        </div>



    </section>

</div>

<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>aula.js"></script>
