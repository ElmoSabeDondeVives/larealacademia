<!-- MODAL PARA REGISTRAR MATERIAS    -->
<div class="modal fade" id="modal_materia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Materia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div id="persona">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Nombre de Materia</label>
                                <input type="text" onkeyup="mayuscula(this.id)" class="form-control" id="materia_name" name="materia_name" placeholder="Ingrese un nombre para materia">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close fa-sm text-white-50"></i> Cerrar</button>
                <button type="button" class="btn btn-success" id="btn-editar-contra" onclick="preguntar('¿Esta seguro que desea guardar el Aula?','save_materia','SI','NO')"><i class="fa fa-save fa-sm text-white-50"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION['controlador'] . '/' . $_SESSION['accion'];?></h1>
        <a data-toggle="modal" data-target="#modal_materia" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm text-white"><i class="fa fa-plus fa-sm text-white-50"></i>  Nueva Materia</a>

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
                                <th>Descripcion</th>
                                <th>Estado</th>
                                <th>Opciones</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a=1;
                            foreach ($list as $m){

                                ($m->materia_estado==0)? $estado = 'Habilitado': $estado = 'Deshabilitado';

                                ?>
                                <tr>
                                    <td><?= $a ?></td>
                                    <td> <?= $m->materia_descripcion ?> </td>
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
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>materia.js"></script>