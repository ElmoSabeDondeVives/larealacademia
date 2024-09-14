

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
                        <div class="col-lg-12">
                            <img src="<?= _SERVER_.'media/logo/logo_real.png' ?>" width="20%" alt="">
                        </div>
                        <div class="col-lg-12 text-center">
                            <h4 class="text-uppercase"><?= $seminario->seminario_titulo ?></h4>
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
                                <div class="col-lg-12 col-sm-12 text-justify">
                                    <label for=""><?= $f.'. '. $p->pregunta_descripcion ?></label>
                                </div>
                                <!--si hay imagenes -->
                                <?php if($p->pregunta_imagen != '' || $p->pregunta_imagen != null){ ?>
                                    <div class="col-lg-12 col-sm-12 text-justify">
                                        <center>
                                            <img src="<?= _SERVER_.$p->pregunta_imagen ?>" alt="" style="width: 220px">
                                        </center>
                                    </div>
                                <?php } ?>


                                <div class="col-lg-6 col-sm-6 text-justify">
                                    <label for="">a. <?= $p->alternativa1 ?></label>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <label for="">d. <?= $p->alternativa4 ?></label>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <label for="">b. <?= $p->alternativa2 ?></label>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <label for="">e. <?= $p->alternativa5 ?></label>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <label for="">c. <?= $p->alternativa3 ?></label>
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
<style>
    @media print {
        #btn-print{
            display:none;
        }
        label {
            color: black;
        }
    }
</style>
<script>
    function imprimir(){
        $('#accordionSidebar').hide();
        $('#btn_print').hide();
        $('#myheader').hide();
        $('#myfooter').hide();
        $('#nivel_up').hide();
        $('#card_msm').removeClass('shadow');


        document.title='SEMINARIO';
        print()
    }
</script>