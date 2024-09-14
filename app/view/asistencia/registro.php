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
                <label for="">Ingrese DNI del Alumno</label>
            </div>
            <div class="col-12">
                <input class="form-control" type="text" onkeyup="verificar_existencia(this.id)" id="dni_al" name="dni_al" placeholder="Ingrese numero de Dni del alumno" >

            </div>



        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Asistencias Marcadas el dia de Hoy
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table table-responsive">
                                    <table id="dataTable" class="table table-bordered"  >
                                        <thead>
                                        <th>#</th>
                                        <th>Documento</th>
                                        <th>Nombre</th>
                                        <th>Fecha - Hora</th>
                                        <th>Turno</th>
                                        <th>Tipo</th>
                                        </thead>
                                        <tbody>

                                        <?php $a=1; foreach ($list as $l){
                                            switch($l->cliente_tipo){
                                                case 0: $text ='<i class="fa fa-users text-success"></i> Alumno' ;break;
                                                case 1: $text ='<i class="fa fa-black-tie text-success"></i> Docente' ;break;
                                                case 2: $text ='<i class="fa fa-thumbs-up text-warning"></i> Personal' ;break;
                                            }

                                            ?>
                                            <tr>
                                                <td><?= $a ?></td>
                                                <td><?= $l->cliente_numero ?></td>
                                                <td><?= $l->cliente_nombre ?></td>
                                                <td><?= $l->asistencia_creacion ?></td>
                                                <td><?= $l->descripcion ?></td>
                                                <td><?= $text ?></td>
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
        <!-- /.row -->
    </section>

</div>
<script>
    $( document ).ready(function() {
        $('#dni_al').focus();
    });
</script>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>asistencia.js"></script>