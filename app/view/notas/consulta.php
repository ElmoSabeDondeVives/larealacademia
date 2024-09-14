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
                        Busqueda:
                    </div>
                    <div class="card-body shadow">
                        <form action="<?= _SERVER_.'Notas/consulta/'.$_GET['id'] ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="">Evaluaciones</label>
                                    <select name="id_evaluacion"  id="id_evaluacion" class="form-control">
                                        <option value="">------Seleccione-------</option>
                                        <?php foreach ($eva as $e){ ?>
                                            <option value="<?= $e->id_evaluacion ?>" <?= ($evalacion == $e->id_evaluacion ) ? 'SELECTED' : ''; ?> > <?= $e->evaluacion_concepto?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 mt-2 text-right">
                                    <button type="submit" class="btn btn-sm btn-success text-white"><i class="fa fa-search"></i>Buscar</button>
                                </div>
                            </div>
                        </form>

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
                            <div class="col-lg-12 mb-2 text-right">
                                    <a target='_blank' id="btn_printer" href="<?= _SERVER_.'Notas/notas_pdf/'.$evalacion ?>" class="btn btn-sm btn-danger text-white"><i class="fa fa-file-pdf-o"></i> Imprimir</a>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="" class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                        <th>#</th>
                                        <th>Alumno</th>
                                        <th>Nota de Evaluación</th>
                                        <th>Opciones</th>
                                        </thead>
                                        <tbody>
                                        <?php $a=1; foreach ($config as $c){
                                            ($c->nota_valor>10 )? $estado =' APROBADO  <i class="fa fa-smile-o text-success"></i> ': $estado='DESAPROBADO   <i class="fa fa-frown-o text-danger"></i> ';
                                            ?>
                                            <tr>
                                                <td><?= $a ?> </td>
                                                <td><?= $c->cliente_nombre ?> </td>
                                                <td class="text-right"><?= $c->nota_valor ?> </td>
                                                <td>
                                                    <?= $estado ?>
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
<script>
    function rutas_hrfe(id_){
    var id = $('#'+id_).val();
    var ruta = urlweb+'Notas/notas_pdf/'+id;
    var a=    document.getElementById('btn_printer');
    a.setAttribute('href',ruta);

    }
</script>