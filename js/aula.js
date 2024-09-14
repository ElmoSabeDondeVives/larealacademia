function save_aula(){
    var valor = true;
    let nombre = $('#aula_name').val();
    valor = validar_campo_vacio('aula_name', nombre, valor);
    if (valor){
        $.ajax({
            type: "POST",
            url: urlweb + "api/Aula/registro_a",
            data: {name: nombre},
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
function delete_i (id){
    var valor=true;
    if (valor){
        $.ajax({
            type: "POST",
            url: urlweb + "api/Aula/delete_i",
            data: {id: id},
            dataType: 'json',
            success:function (r) {
                switch (r.result.code) {
                    case 1:
                        respuesta('¡Aula Agregada Exitosamente!', 'success');
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
function save_turno(){
    var valor = true;
    let ingreso = $('#ingreso').val();
    let salida = $('#salida').val();
    valor = validar_campo_vacio('ingreso', ingreso, valor);
    valor = validar_campo_vacio('salida', salida, valor);
    if (valor){
        $.ajax({
            type: "POST",
            url: urlweb + "api/Aula/registro_t",
            data: {ingreso: ingreso, salida: salida},
            dataType: 'json',
            success:function (r) {
                switch (r.result.code) {
                    case 1:
                        respuesta('¡Aula Agregada Exitosamente!', 'success');
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
function save_tipo(){
    var valor = true;
    let modalidad = $('#modalidad').val();
    let asistencia = $('#tipo_asis').val();
    valor = validar_campo_vacio('modalidad', modalidad, valor);

    if (valor){
        $.ajax({
            type: "POST",
            url: urlweb + "api/Aula/registro_ti",
            data: {nombre: modalidad, asistencia: asistencia},
            dataType: 'json',
            success:function (r) {
                switch (r.result.code) {
                    case 1:
                        respuesta('¡Modalidad Agregada Exitosamente!', 'success');
                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                        break;
                    case 2:
                        respuesta('Error al agregar Modalidad', 'error');
                        break;
                    default:
                        respuesta('¡Algo catastrofico ha ocurrido!', 'error');
                        break;
                }
            }
        });
    }
}
function save_tipo_edit(){
    var valor = true;
    let modalidad = $('#modalidad_edit').val();
    let asistencia = $('#tipo_asis_edit').val();
    let estado = $('#estado_tipo').val();
    let id = $('#id_oc').val();
    valor = validar_campo_vacio('modalidad_edit', modalidad, valor);

    if (valor){
        $.ajax({
            type: "POST",
            url: urlweb + "api/Aula/registro_ti_edit",
            data: {nombre: modalidad, asistencia: asistencia,id:id,estado:estado},
            dataType: 'json',
            success:function (r) {
                switch (r.result.code) {
                    case 1:
                        respuesta('¡Modalidad Agregada Exitosamente!', 'success');
                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                        break;
                    case 2:
                        respuesta('Error al agregar Modalidad', 'error');
                        break;
                    default:
                        respuesta('¡Algo catastrofico ha ocurrido!', 'error');
                        break;
                }
            }
        });
    }
}
function save_config(){
    var valor = true;
    let descrip = $('#descrip').val();
    let aula = $('#id_aula').val();
    let turno = $('#id_turno').val();
    let moda = $('#id_modalidad').val();
    var fecha_ini = $('#fecha_ini').val();
    var fecha_fin = $('#fecha_fin').val();
    var total = '';
    $('input[name="dia"]:checked').each(function(){
        var tval = $(this).val();
        total += '/'+ parseFloat(tval);
    });
    console.log(total);

    valor = validar_campo_vacio('descrip', descrip, valor);
    valor = validar_campo_vacio('id_aula', aula, valor);
    valor = validar_campo_vacio('id_turno', turno, valor);
    valor = validar_campo_vacio('id_modalidad', moda, valor);

    if (valor){
        $.ajax({
            type: "POST",
            url: urlweb + "api/Aula/registro_config",
            data: {descrip: descrip, aula: aula, turno:turno, moda:moda, fecha_ini: fecha_ini, fecha_fin:fecha_fin,total:total},
            dataType: 'json',
            success:function (r) {
                switch (r.result.code) {
                    case 1:
                        respuesta('¡Modalidad Agregada Exitosamente!', 'success');
                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                        break;
                    case 2:
                        respuesta('Error al agregar Modalidad', 'error');
                        break;
                    default:
                        respuesta('¡Algo catastrofico ha ocurrido!', 'error');
                        break;
                }
            }
        });
    }
}