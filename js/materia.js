function save_materia(){
    var valor = true ;
    let nombre = $('#materia_name').val();
    valor = validar_campo_vacio('materia_name', nombre, valor);
    if (valor){
        $.ajax({
            type: "POST",
            url: urlweb + "api/Seminario/registro_materia",
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