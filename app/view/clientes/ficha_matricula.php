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

        </h2>

        <hr>
    </section>

    <section class="container-fluid">

        <!-- /.row -->

        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        INFORMACIÓN
                    </div>
                    <div class="card-body shadow">
                        <div class="row">
                            <div class="col-lg-6">
                                <i class="fa fa-square-o"></i> NOMBRES Y APELLIDOS : <label style="border-bottom: 1px solid gray"><?= $cliente->cliente_nombre?></label>
                            </div>
                            <div class="col-lg-6">
                                <label for=""><i class="fa fa-square-o"></i> NÚMERO DOCUMENTO : <label style="border-bottom: 1px solid gray"><?= $cliente->cliente_numero ?></label></label>
                            </div>
                            <div class="col-lg-12">
                                <label for=""><i class="fa fa-square-o"></i> DIRECCION : </label>
                                <p class="form-control"><?= $cliente->cliente_direccion ?></p>
                            </div>
                            <div class="col-lg-12">
                                <label for=""><i class="fa fa-square-o"></i> CELULAR: </label>
                                <p class="form-control"><?= $cliente->cliente_numero ?></p>
                            </div>
                            <div class="col-lg-12">
                                <label for=""><i class="fa fa-square-o"></i> COLEGIO DE PROCEDENCIA</label>
                                <p class="form-control"><?= $cliente->cliente_procedencia ?></p>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-3"><i class="fa fa-square-o"></i> NÚMERO DE POSTULACIONES : </div><div class="col-lg-1"><label class="form-control"><?= $cliente->cliente_num_postulacion ?></label></div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label><i class="fa fa-square-o"></i> FACEBOOK/CORREO ELECTRONICO: </label>
                                <p class="form-control"><?= $cliente->cliente_correo ?></p>
                            </div>
                            <div class="col-lg-12">
                                <label for=""><i class="fa fa-square-o"></i> APODERADO:</label>
                                <p class="form-control"><?= $cliente->cliente_apoderado ?></p>
                            </div>
                            <div class="col-lg-12">
                                <label for=""><i class="fa fa-square-o"></i> CELULAR: </label>
                                <p class="form-control"><?= $cliente->cliente_apoderado_cel ?> </p>
                            </div>
                            <div class="col-lg-12">
                                <label for=""><i class="fa fa-square-o"></i> OBSERVACIONES: </label>
                                <p class="form-control"><?= $cliente->cliente_obs ?> </p>
                            </div>
                            <div class="col-lg-12 text-center">
                                <a href="<?= _SERVER_.'Clientes/ficha_pdf/'.$_GET['id'] ?>" target="_blank " class="btn btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i> Imprimir </a>
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
