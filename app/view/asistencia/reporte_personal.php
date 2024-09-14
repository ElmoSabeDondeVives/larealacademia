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
                        ASISTENCIA A CLASES
                    </div>
                    <div class="card-body">
                        <div class="row">
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
                                                /*$dias = $f->DIASENTREFECHAS;*/
                                                /*$date1 = new DateTime('2023-01-24');
                                                $date2 = new DateTime(date('Y-m-d'));*/


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
                            <div class="col-lg-12 text-center d-none">
                                <a href="" class="btn btn-md btn-danger">Imprimir <i class="fa fa-file-pdf-o"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <div class="card shadow">
                    <div class="card-header">
                        ASISTENCIA SEMIARIOS Y/O SIMULACROS
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table table-responsive">
                                    <table id="dataTable" class="table table-hover">
                                        <thead>
                                        <th>#</th>
                                        <th>Modalidad</th>
                                        <th>Fecha - hora </th>
                                        </thead>
                                        <tbody>
                                        <?php $aa=1; foreach ($asistencias as $a ){ ?>
                                            <tr>
                                                <td><?= $aa ?></td>
                                                <td><?= $a->descripcion ?></td>
                                                <td><?= $a->asistencia_creacion ?></td>

                                            </tr>

                                        <?php $aa++; } ?>
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
