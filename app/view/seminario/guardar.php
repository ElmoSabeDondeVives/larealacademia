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
                    <h6 class="m-0 font-weight-bold text-primary">Crear Simulacro</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="titulo">Titulo de Simulacro</label>
                            <input type="text" id="titulo" name="titulo" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label for="fecha">Fecha</label>
                            <input type="date" id="fecha_s" value="<?= date('Y-m-d')?>" name="fecha_s" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label for="nivel_p">Nivel <i class="fa fa-circle text-success"></i> <i class="fa fa-circle text-warning"></i> <i class="fa fa-circle text-danger"></i> </label>
                            <select name="nivel_p" id="nivel_p" class="form-control" >
                                <option value="1">Básico</option>
                                <option value="2">Medio</option>
                                <option value="3">Avanzado</option>
                            </select>
                        </div>
                        <div class="col-lg-12 mt-4 text-center">
                            <h4>Preguntas</h4>
                        </div>
                        <div class="col-lg-12">
                            <div class="row text-center">
                            <?php $a=0; foreach ($materias as $ms ){
                                $cadena.=$ms->id_materia.'_';
                                ?>
                            <div class="card m-2">
                                <div class="card-body">
                                    <label for="" ><?= $ms->materia_descripcion?></label><br>
                                    <label for="">Cantidad de Preguntas</label>
                                    <input type="hidden" id="materia_<?= $a ?>" value="<?= $ms->id_materia ?>" >
                                    <input type="number" onclick="validar_numeros(this.id)" class="form-control" id="<?= 'cant_'.$ms->id_materia ?>">
                                </div>
                            </div>

                            <?php $a++; } ?>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a onclick="generar_cuestionario(<?= $a ?>)" class="btn btn-sm btn-info text-white">Generar Preguntas</a>
                                </div>
                            </div>
                            <div class="row" id="preguntas_d">
                                Mostar Resultados
                            </div>

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
<script>
    let arraylist = {};
    function generar_cuestionario(id){
        var valor = true;
        var ids = [];
        for(var i=0; i<id;i++){
            var num = $('#materia_'+i).val();
            var cant = $('#cant_'+num).val();
            ids.push({id: num,cant:  cant})
        }
        if (ids){valor=true}else{
            valor=false;
        }
        var nivel= $('#nivel_p').val();
        if(valor){
            $.ajax({
                type: "POST",
                url: urlweb + "api/Seminario/consulta_preguntas",
                data: {data: JSON.stringify(ids), nivel:nivel},
                dataType: 'json',
                success:function (r) {
                    if (r){
                        console.log(r)
                        arraylist = r;
                        crearTabla();

                    }
                }
            });



        }



    }

    /*  Función para crear tabla  */
    function crearTabla () {
        let cadena='';
        let a=1;
        Object.keys(arraylist).forEach((index, element) => {
            let el = arraylist[index]
            console.log(index, el)
            cadena +='<div class="col-lg-12">' + index +
                '</div> ';
            el.forEach( (ind) => {

                if(ind.pregunta_imagen != null){
                    var imagen = '  <div class="col-lg-12"> <center>' +'<img src="'+urlweb+ind.pregunta_imagen +'"  style="width:  220px" >'+ '</center></div>';
                }else{
                    var imagen='';
                }
                cadena += `<div class="col-lg-6">
                            <div class="row">
                            <div class="col-lg-12"><label for="">${a+'. '+ ind.pregunta_descripcion}</label></div>
                            `+ imagen +`
                            <div class="col-lg-12">
                                <div class="row">
                                <div class="col-lg-6">a. ${ind.alternativa1}</div>
                                <div class="col-lg-6">d. ${ind.alternativa4}</div>
                                <div class="col-lg-6">b. ${ind.alternativa2}</div>
                                <div class="col-lg-6">e. ${ind.alternativa5}</div>
                                <div class="col-lg-6">c. ${ind.alternativa3}</div>


                                </div>
                            </div>
                            </div>

                        </div>`;
                a++;
            } )

        });

        cadena+=`<div class="col-lg-12 text-center mt-3"> <a class="btn btn-sm btn-success text-white" onclick="preguntar('¿Estas seguro que desea guardar?','save_seminario','SI','NO')" > <i class="fa fa-save"></i> Guardar Preguntas</a>  </div>    `;
        console.log(cadena);
        $('#preguntas_d').html(cadena)
        /*arraylist.forEach((element) => {
            cadena +='<div class="col-lg-12">' +element+
                '</div> ';
            element.forEach((dato) => {
                cadena +='<div class="col-lg-6">' +dato.pregunta+
                    '</div> '
            });

        })*/


    }
    function save_seminario(){
        let valor = true ;
        let titulo = $('#titulo').val();
        let nivel = $('#nivel_p').val();
        let fecha = $('#fecha_s').val();

        valor = validar_campo_vacio('titulo',titulo,valor)
        valor = validar_campo_vacio('nivel_p',nivel,valor)
        valor = validar_campo_vacio('fecha_s',fecha,valor)

        if (valor){
            $.ajax({
                type: "POST",
                url: urlweb + "api/Seminario/guardar_seminario",
                data: {titulo:titulo,fecha: fecha, data : JSON.stringify(arraylist),nivel:nivel},
                dataType: 'json',
                success:function (r) {
                    switch (r.result.code) {
                        case 1:
                            respuesta('¡ Agregado Exitosamente!', 'success');
                            setTimeout(function () {
                                location.reload()
                            }, 1000);
                            break;
                        case 2:
                            respuesta('Error al agregar Materia', 'error');
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

