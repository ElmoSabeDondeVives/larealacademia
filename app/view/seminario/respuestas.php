

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div  class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 id="myheader" class="h3 mb-0 text-gray-800"><?= $_SESSION['controlador'] . '/' . $_SESSION['accion'];?></h1>

        <!--        <button data-toggle="modal" data-target="#gestionMenu" onclick="cambiar_texto_formulario('exampleModalLabel', 'Agregar Nuevo Menú'); agregacion_menu()" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i> Agregar Nuevo</button>
        -->
    </div>

    <!-- /.row (main row) -->
    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales Example -->
            <div id="card_msm" class="card shadow mb-4" style="border: 1px solid white">
                <div class="card-body" style="padding: 0px">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h4 class="text-uppercase"><?='RESPUESTAS '. $seminario->seminario_titulo ?></h4>
                        </div>
                        <div id="nivel_up" class="col-lg-12">
                            <?php
                            switch ($seminario->seminario_nivel){
                                case 1: $nivel = '<i class="fa fa-circle text-success"></i> Básico'; break;
                                case 2: $nivel = '<i class="fa fa-circle text-warning"></i> Medio'; break;
                                case 3: $nivel = '<i class="fa fa-circle text-danger"></i> Avanzado'; break;
                            }

                            ?>
                            <p><?= $nivel ?> </p>
                        </div>
                        <div class="col-lg-12">



                        </div>
                    </div>

                    <div class="row">
                        <?php $f =1; foreach ($preguntas as $p){?>
                            <div class="col-lg-6 col-sm-6 mb-2">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <label for=""><?= $f.'. ' /*$p->pregunta_descripcion*/ ?></label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="">Respuesta : </label>
                                        <?php switch ($p->pregunta_respuesta){
                                            case 1 : $respuesta ='a.'. $p->alternativa1 ; break;
                                            case 2 : $respuesta ='b. '.$p->alternativa2 ; break;
                                            case 3 : $respuesta ='c. '.$p->alternativa3 ; break;
                                            case 4 : $respuesta ='d. '.$p->alternativa4 ; break;
                                            case 5 : $respuesta ='e. '.$p->alternativa5 ; break;
                                        } ?>
                                        <p><?= $respuesta ?></p>
                                    </div>
                                </div>

                                <hr>
                            </div>
                            <?php $f++; } ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <a onclick="imprimir()" id="btn_print" class="btn btn-sm btn-danger text-white"> <i class="fa fa-file-pdf-o"></i> Imprimir</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>


<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>