<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION['controlador'] . '/' . $_SESSION['accion'];?></h1>
    </div>

    <!-- /.row (main row) -->
    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Crear Pregunta</h6>
                </div>
                <div class="card-body">
                    <form id="form_pregunta" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="pregunta">Pregunta</label>
                            <textarea name="pregunta" id="pregunta" name="pregunta" cols="30" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="col-lg-6">
                            <label for="materia">Materia</label>

                            <select name="materia" id="materia"  class="form-control">
                                <?php foreach ($materias as $ma){ ?>
                                    <option value="<?= $ma->id_materia ?>"><?= $ma->materia_descripcion ?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="nivel">Nivel de Pregunta <i class="fa fa-circle text-success"></i> <i class="fa fa-circle text-warning"> </i> <i class="fa fa-circle text-danger"></i> </label>
                            <select name="nivel" id="nivel" class="form-control">
                                <option value="1">NIVEL BASICO </option>
                                <option value="2">NIVEL MEDIO  </option>
                                <option value="3">NIVEL AVANZADO </option>
                            </select>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <input type="radio" id="1" value="1" name="respuesta" ><label for="alter1"> &nbsp; 1. Alternativa.</label><br>
                            <input type="text" id="alter1" name="alter1" class="form-control" placeholder="1. ..." >
                        </div>
                        <div class="col-lg-6">
                            <input type="radio" id="2" value="2" name="respuesta"  ><label for="alter1"> &nbsp; 2. Alternativa.</label><br>
                            <input type="text" id="alter2" name="alter2" class="form-control" placeholder="2. ..." >
                        </div>
                        <div class="col-lg-6">
                            <input type="radio" id="3" value="3" name="respuesta" ><label for="alter1"> &nbsp; 3. Alternativa.</label><br>
                            <input type="text" id="alter3" name="alter3" class="form-control" placeholder="3. ..." >
                        </div>
                        <div class="col-lg-6">
                            <input type="radio" id="4" value="4" name="respuesta" ><label for="alter1"> &nbsp; 4. Alternativa.</label><br>
                            <input type="text" id="alter4" name="alter4"  class="form-control" placeholder="4. ..." >
                        </div>
                        <div class="col-lg-6">
                            <input type="radio" id="5" value="5" name="respuesta" ><label for="alter1"> &nbsp; 5. Alternativa.</label><br>
                            <input type="text" id="alter5" name="alter5" class="form-control" placeholder="5. ..." >
                        </div>
                        <div class="col-lg-6 mt-4">

                            <label for="imagen" class="mt-2 btn btn-sm btn-info text-white"> <i class="fa fa-upload"></i> Subir Imagen </label><br>
                            <input type="file"  id="imagen" name="imagen" class="d-none" placeholder="5. ..." >
                            <div id="carga_de_imagen">

                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">Estado</label>
                            <select name="estado" id="estado" class="form-control">
                                <option value="0" >Habilitado</option>
                                <option value="1" >Deshabilitado</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mt-2 text-center">
                            <button type="submit" class="btn btn-block btn-success text-white mt-4" >Guardar</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script>
    $("#form_pregunta").on('submit', function(e){
        e.preventDefault();
        var valor = true;
        //Definimos el botón que activa la función
        var boton = "btn-agregar-usuario";
        //Extraemos las variable según los valores del campo consultado
        let pregunta = $('#pregunta').val();
        let materia = $('#materia').val();
        let nivel = $('#nivel').val();
        let a1 = $('#alter1').val();
        let a2 = $('#alter2').val();
        let a3 = $('#alter3').val();
        let a4 = $('#alter4').val();
        let a5 = $('#alter5').val();
        let respuesta_ = $('input[name="respuesta"]:checked').attr('id');
        /* validacion de ingreso de informacion  */
        valor = validar_campo_vacio('pregunta', pregunta, valor)
        valor = validar_campo_vacio('materia', materia, valor)
        valor = validar_campo_vacio('nivel', nivel, valor)
        valor = validar_campo_vacio('pregunta', pregunta,valor)
        valor = validar_campo_vacio('alter1', a1, valor)
        valor = validar_campo_vacio('alter2', a2, valor)
        valor = validar_campo_vacio('alter3', a3, valor)
        valor = validar_campo_vacio('alter4', a4, valor)
        valor = validar_campo_vacio('alter5', a5, valor)

        //Si var valor no ha cambiado de valor, procedemos a hacer la llamada de ajax
        if(valor){
            //Cadena donde enviaremos los parametros por POST
            $.ajax({
                type: "POST",
                url: urlweb + "api/Seminario/guardar_pregunta",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                dataType: 'json',
                beforeSend: function () {
                    cambiar_estado_boton(boton, 'Guardando...', true);
                },
                success:function (r) {
                    cambiar_estado_boton(boton, "<i class=\"fa fa-save fa-sm text-white-50\"></i> Guardar", false);
                    switch (r.result.code) {
                        case 1:
                            respuesta('¡Guardado Correctamente! Recargando...', 'success');

                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                            break;
                        case 2:
                            respuesta('Error al guardar', 'error');
                            break;
                        default:
                            respuesta('¡Algo catastrofico ha ocurrido!', 'error');
                            break;
                    }
                }
            });
        }
    });


    /*---------------------------------------*/
    /*function guardar_pregunta (){
        var valor = true;
        let pregunta = $('#pregunta').val();
        let materia = $('#materia').val();
        let nivel = $('#nivel').val();
        let a1 = $('#alter1').val();
        let a2 = $('#alter2').val();
        let a3 = $('#alter3').val();
        let a4 = $('#alter4').val();
        let a5 = $('#alter5').val();
        let respuesta_ = $('input[name="respuesta"]:checked').attr('id');
        /!* validacion de ingreso de informacion  *!/
        valor = validar_campo_vacio('pregunta', pregunta, valor)
        valor = validar_campo_vacio('materia', materia, valor)
        valor = validar_campo_vacio('nivel', nivel, valor)
        valor = validar_campo_vacio('pregunta', pregunta,valor)
        valor = validar_campo_vacio('alter1', a1, valor)
        valor = validar_campo_vacio('alter2', a2, valor)
        valor = validar_campo_vacio('alter3', a3, valor)
        valor = validar_campo_vacio('alter4', a4, valor)
        valor = validar_campo_vacio('alter5', a5, valor)
        if (valor){
            $.ajax({
                type: "POST",
                url: urlweb + "api/Seminario/guardar_pregunta",
                data: {pregunta: pregunta, materia:materia, nivel:nivel, a1:a1, a2:a2, a3:a3, a4:a4,a5:a5,respuesta_:respuesta_},
                dataType: 'json',
                success:function (r) {
                    switch (r.result.code) {
                        case 1:
                            respuesta('¡Agregado Exitosamente!', 'success');
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






    }*/


    /*    script de carga de imagen           */
    document.getElementById("imagen").onchange = function(e) {
        // Creamos el objeto de la clase FileReader
        let reader = new FileReader();

        // Leemos el archivo subido y se lo pasamos a nuestro fileReader
        reader.readAsDataURL(e.target.files[0]);

        // Le decimos que cuando este listo ejecute el código interno
        reader.onload = function(){
            let preview = document.getElementById('carga_de_imagen'),
                image = document.createElement('img');

            image.src = reader.result;

            preview.innerHTML = '';
            preview.append(image);
        };
    }

</script>
<style>
    div #carga_de_imagen img {
        width:100%; height: 100%;
        border: dashed;
    }
</style>