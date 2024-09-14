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
            <div class="col-lg-4 mb-4">
                <label for="modalidad">Seleccione Modalidad</label>
                <select class="form-control" onchange="modalidad_change(this.id)" name="modalidad" id="modalidad">
                    <?php foreach ($modalidad as $m){?>
                        <option value="<?= $m->id ?>"> <?= $m->nombre ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-lg-4">
                <label for="">Seleccione Aula</label>
                <select class="form-control" name="id_clase" id="id_clase">

                </select>
            </div>
            <div class="col-lg-4">
                <label for="">Concepto de Cobro</label>
                <select name="id_producto" id="id_producto" class="form-control">
                    <?php foreach ($conceptos as $con){ ?>
                        <option value="<?= $con->id_producto ?>"> <?= $con->producto_nombre ?></option>
                    <?php } ?>
                </select>

            </div>
            <div class="col-lg-12">
                <input type="checkbox" id="cobro" > <label for="cobro">Realizar Cobro</label>
            </div>
            <div class="col-lg-12">
                <label for="">Ingrese DNI del Alumno</label>
            </div>
            <div class="col-12">
                <input class="form-control" type="text" onkeyup="verificar_existencia_sms(this.id)" id="dni_al" name="dni_al" placeholder="Ingrese numero de Dni del alumno" >

            </div>



        </div>
        <!-- /.row -->
    </section>

</div>
<script>
    $( document ).ready(function() {
        $('#dni_al').focus();
    });
    function modalidad_change(id){
        let id_modalidad = $('#'+id).val();
        var valor = true;
        if (valor){
            $.ajax({
                type: "POST",
                url: urlweb + "api/Asistencias/search_clases",
                data: {id:id_modalidad},
                dataType: 'json',
                success:function (r) {
                    var datos_recurso = "<option value='' selected>Seleccione</option>";
                    for(var j =0;j<r.result.length;j++){
                        datos_recurso +="<option value='"+r.result[j].id+"'>"+r.result[j].descripcion+"</option>";
                    }
                    $("#id_clase").html(datos_recurso);

                }
            });
        }
    }

</script>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>asistencia.js"></script>