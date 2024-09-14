<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION['controlador'] . '/' . $_SESSION['accion'];?></h1>
        <a href="<?= _SERVER_.'Seminario/agregar' ?>" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i> Agregar Preguntas</a>
        <a href="<?= _SERVER_.'Seminario/materias' ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fa fa-paragraph fa-sm text-white-50"></i> Materias</a>

<!--        <button data-toggle="modal" data-target="#gestionMenu" onclick="cambiar_texto_formulario('exampleModalLabel', 'Agregar Nuevo Menú'); agregacion_menu()" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i> Agregar Nuevo</button>
-->    </div>

    <!-- /.row (main row) -->
    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de Menús Registrados</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-capitalize">
                            <tr>
                                <th>#</th>
                                <th>Pregunta</th>
                                <th>Materia</th>
                                <th>Nivel</th>
                                <th>Respuesta</th>
                                <th>Estado</th>
                                <th>Opciones</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a=1;
                            foreach ($preguntas as $m){
                                switch ($m->pregunta_respuesta){
                                    case 1: $respuesta_a = $m->alternativa1;break;
                                    case 2: $respuesta_a = $m->alternativa2;break;
                                    case 3: $respuesta_a = $m->alternativa3;break;
                                    case 4: $respuesta_a = $m->alternativa4;break;
                                    case 5: $respuesta_a = $m->alternativa5;break;
                                }
                                switch ($m->id_nivel){
                                    case 1: $nivel = '<i class="fa fa-circle text-success"></i>  BASICO ';break;
                                    case 2: $nivel = '<i class="fa fa-circle text-warning"></i>  MEDIO ';break;
                                    case 3: $nivel = '<i class="fa fa-circle text-danger"></i>  AVANZADO ';break;
                                }
                                ($m->pregunta_estado==0)? $estado = 'Habilitado': $estado = 'Deshabilitado';

                                ?>
                                <tr>

                                    <td><?= $a ?></td>
                                    <td> <?= $m->pregunta_descripcion ?> </td>
                                    <td> <?= $m->materia_descripcion ?> </td>
                                    <td> <?= $nivel ?> </td>
                                    <td> <?= $respuesta_a ?> </td>
                                    <td> <?= $estado ?> </td>
                                    <td>
                                        <a class="btn btn-sm btn-warning text-white"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-sm btn-danger text-white "><i class="fa fa-trash"></i></a>
                                    </td>

                                </tr>
                                <?php
                                $a++;}
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>