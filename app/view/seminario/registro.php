<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION['controlador'] . '/' . $_SESSION['accion'];?></h1>
        <a href="<?= _SERVER_.'Seminario/preguntas' ?>" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i> Agregar Preguntas</a>
        <a href="<?= _SERVER_.'Seminario/guardar' ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i> Agregar Simulacro</a>

<!--        <button data-toggle="modal" data-target="#gestionMenu" onclick="cambiar_texto_formulario('exampleModalLabel', 'Agregar Nuevo Menú'); agregacion_menu()" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i> Agregar Nuevo</button>
-->    </div>

    <!-- /.row (main row) -->
    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de Preguntas</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-capitalize">
                            <tr>
                                <th>#</th>
                                <th>Seminario</th>
                                <th>Creación</th>

                                <th>Nivel</th>
                                <th class="text-center">Opciones</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $a=1; foreach ($seminarios as $s){
                                switch ($s->seminario_nivel){
                                    case 1: $nivel='Básico';break;
                                    case 2: $nivel='Medio';break;
                                    case 3: $nivel='Avanzado';break;
                                }
                                ?>
                            <tr>
                                <td><?= $a ?></td>
                                <td><?= $s->seminario_titulo ?></td>
                                <td><?= $s->seminario_creacion ?></td>
                                <td><?= $nivel ?></td>
                                <td class="text-center">
                                    <a href="<?= _SERVER_.'Seminario/seminario/'.$s->id_seminario ?>" class="btn btn-sm btn-dark text-white"><i class="fa fa-eye"></i></a>
                                    <a href="<?= _SERVER_.'Seminario/respuestas/'.$s->id_seminario ?>" class="btn btn-sm btn-danger text-white"><i class="fa fa-file-pdf-o"></i> Respuestas  </a> </td>
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
<!-- /.container-fluid -->
</div>