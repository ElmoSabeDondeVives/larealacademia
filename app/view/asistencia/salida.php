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
                <label for="">REGISTRO DE SALIDA </label>
            </div>
            <div class="col-12">
                <input class="form-control" type="text" onkeyup="verificar_existencia_doc(this.id)" id="dni_docente" name="dni_docente" placeholder="Ingrese numero de Dni" >

            </div>



        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Salidas Marcadas el dia de Hoy
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
                                        <th>Tipo</th>
                                        </thead>
                                        <tbody>

                                        <?php $a=1; foreach ($list as $l){
                                            ($l->cliente_tipo==0)?$text ='<i class="fa fa-users text-success"></i> Alumno' :$text ='<i class="fa fa-black-tie text-danger"></i> Docente' ;
                                            ?>
                                            <tr>
                                                <td><?= $a ?></td>
                                                <td><?= $l->cliente_numero ?></td>
                                                <td><?= $l->cliente_nombre ?></td>
                                                <td><?= $l->asistencia_salida ?></td>
                                                <td><?= $text ?></td>
                                            </tr>
                                        <?php } ?>
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