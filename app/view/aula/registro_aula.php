<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 02/11/2018
 * Time: 0:36
 */
?>
<!-- Modal Restablecer Contraseña-->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Aula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div id="persona">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Nombre de Aula</label>
                                <input type="text" onkeyup="mayuscula(this.id)" class="form-control" id="aula_name" name="aula_name" placeholder="Ingrese un nombre para el aula">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close fa-sm text-white-50"></i> Cerrar</button>
                <button type="button" class="btn btn-success" id="btn-editar-contra" onclick="preguntar('¿Esta seguro que desea guardar el Aula?','save_aula','SI','NO')"><i class="fa fa-save fa-sm text-white-50"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Aula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div id="persona">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" id="id_aula" name="id_aula">
                                <label for="">Nombre de Aula</label>
                                <input type="text" onkeyup="mayuscula(this.id)" class="form-control" id="edit_name" name="edit_name" placeholder="Ingrese un nombre para el aula">
                            </div>
                            <div class="col-lg-12">
                                <label for="">Estado</label>
                                <select name="edit_estado" id="edit_estado" class="form-control">
                                    <option value="0">Habilitado</option>
                                    <option value="1">Deshabilitado</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close fa-sm text-white-50"></i> Cerrar</button>
                <button type="button" class="btn btn-success" id="btn-editar-contra" onclick="preguntar('¿Esta seguro que desea editar el Aula?','edit_aula','SI','NO')"><i class="fa fa-save fa-sm text-white-50"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>

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
            <div class="col-lg-12 mb-3 text-right">
                <a class="btn btn-sm btn-success text-white" data-toggle="modal" data-target="#register" >  <i class="fa fa-plus"></i> Agregar</a>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Lista de Aulas
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable">
                                <thead >
                                <th>#</th>
                                <th>AULA</th>
                                <th>FECHA CREACION</th>
                                <th>ESTADO</th>
                                <th>OPCIONES</th>
                                </thead>
                                <tbody>
                                <?php $a=1; foreach ( $list as $l){
                                    ($l->estado==0)?$estado='Habilitado': $estado='Deshabilitado';
                                    ?>

                                    <tr class="text-center">
                                        <td><?=  $a   ?></td>
                                        <td><?=  $l->nombre   ?></td>
                                        <td><?=  $l->creacion   ?></td>
                                        <td><?=  $estado   ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-success text-white" data-toggle="modal" data-target="#edit_register" onclick="data('<?= $l->id ?>','<?= $l->nombre ?>','<?= $l->estado ?>')" ><i class="fa fa-edit"></i></a>
                                            <!--<a class="btn btn-sm btn-danger text-white"><i class="fa fa-trash"></i></a>-->
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
    </section>

</div>

<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>aula.js"></script>
<script>
    function data(id, nombre, estado){
        $('#id_aula').val(id);
        $('#edit_name').val(nombre);
        $('#edit_estado').val(estado);

    }


    function edit_aula(){
        var valor = true;
        let id = $('#id_aula').val();
        let name = $('#edit_name').val();
        let estado = $('#edit_estado').val();

        valor = validar_campo_vacio('edit_name', name, valor);

        if (valor){
            $.ajax({
                type: "POST",
                url: urlweb + "api/Aula/edit_aula",
                data: {name: name, estado: estado,id:id},
                dataType: 'json',
                success:function (r) {
                    switch (r.result.code) {
                        case 1:
                            respuesta('¡Aula Editado Exitosamente!', 'success');
                            setTimeout(function () {
                                location.reload()
                            }, 1000);
                            break;
                        case 2:
                            respuesta('Error al agregar Aula', 'error');
                            break;
                        default:
                            respuesta('¡Algo catastrofico ha ocurrido!', 'error');
                            break;
                    }
                }
            });
        }
    }
</script>