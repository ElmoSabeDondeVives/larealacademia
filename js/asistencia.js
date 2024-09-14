function  verificar_existencia(id){
    let num ='';
    num= $('#'+id).val()
    if(num.length>8){
        respuesta('El Dni no debe ser mayor de 8 Digitos')
    }else{
        if (num.length==8){
            $.ajax({
                type: "POST",
                url: urlweb + "api/Asistencias/registro_a",
                data: {id: num},
                dataType: 'json',
                success:function (r) {
                    switch (r.result.code) {
                        case 1:
                            respuesta('¡Asistencia Agregada Exitosamente!', 'success');
                            setTimeout(function () {
                                location.reload()
                            }, 1000);
                            break;
                        case 2:
                            respuesta('Error al agregar asistencia', 'error');
                            break;
                        case 8:
                            respuesta('El Alumno ya marco asistencia', 'error');
                            setTimeout(function () {
                                location.reload()
                            }, 1000);
                            break;
                        default:
                            respuesta('¡Algo catastrofico ha ocurrido!', 'error');
                            break;
                    }
                }
            });



        }
    }



}
function  verificar_existencia_doc(id){
    let num ='';
    num= $('#'+id).val()
    if(num.length>8){
        respuesta('El Dni no debe ser mayor de 8 Digitos')
    }else{
        if (num.length==8){
            $.ajax({
                type: "POST",
                url: urlweb + "api/Asistencias/registro_doc",
                data: {id: num},
                dataType: 'json',
                success:function (r) {
                    switch (r.result.code) {
                        case 1:
                            respuesta('¡SALIDA MARCADA Exitosamente!', 'success');
                            setTimeout(function () {
                                location.reload()
                            }, 1000);
                            break;
                        case 2:
                            respuesta('Error al MARCAR SALIDA', 'error');
                            break;
                        case 8:
                            respuesta('El Alumno no cuenta con una asistencia', 'error');
                            setTimeout(function () {
                                location.reload()
                            }, 1000);
                            break;
                        default:
                            respuesta('¡Algo catastrofico ha ocurrido!', 'error');
                            break;
                    }
                }
            });



        }
    }



}
function  verificar_existencia_sms(id){
    var cob = $('#cobro').is(':checked');
    let s_cobro =0;
    if (cob){

        s_cobro =1;
    }else{
        s_cobro =2
    }
    let num ='';
    let clase ='';
    num= $('#'+id).val()
    let id_producto = $('#id_producto').val();
    clase= $('#id_clase').val()
    if(num.length>8){
        respuesta('El Dni no debe ser mayor de 8 Digitos')
    }else{
        if (num.length==8){

            /* Verificar Exixstencia del cliente  */
            $.ajax({
                type: "POST",
                url: urlweb + "api/Asistencias/existencia_cliente",
                data: {id: num, clase: clase,id_producto : id_producto},
                dataType: 'json',
                success:function (r) {
                    if (r.result==2){
                        console.log(2)
                        Swal.fire({
                            title: 'Ingrese Nombre Alumno',
                            html: `<input type="text" id="nombre_alumno" maxlength="100" onkeyup="mayuscula(this.id)" class="swal2-input" placeholder="Ingrese Nombre Completo">`,

                            inputAttributes: {
                                autocapitalize: 'off',
                            },
                            showCancelButton: true,
                            confirmButtonText: 'Ok',
                            showLoaderOnConfirm: true,
                            preConfirm: ()=>{
                                var alumno = $('#nombre_alumno').val();
                                let valor = true;
                                valor = validar_campo_vacio('nombre_alumno', alumno, valor);
                                if (valor){
                                    $.ajax({
                                        type: "POST",
                                        url: urlweb + "api/Asistencias/registro_xdia",
                                        data: {id: num, clase: clase,tipo:1,nombre: alumno,id_producto:id_producto,cobro: s_cobro },
                                        dataType: 'json',
                                        success:function (r) {
                                            switch (r.result.code) {
                                                case 1:
                                                    respuesta('¡Asistencia Agregada Exitosamente!', 'success');
                                                    $('#dni_al').val('');
                                                    $('#nombre_alumno').val('');
                                                    $('#dni_al').focus();
                                                    break;
                                                case 2:
                                                    respuesta('Error al agregar asistencia', 'error');
                                                    break;
                                                case 8:
                                                    respuesta('El Alumno ya marco asistencia', 'error');
                                                    $('#nombre_alumno').val('');
                                                    $('#dni_al').focus();
                                                    break;
                                                default:
                                                    respuesta('¡Algo catastrofico ha ocurrido!', 'error');
                                                    break;
                                            }
                                        }

                                    });
                                }



                            }
                        })
                    }
                    else{
                        console.log(1)
                        $.ajax({
                            type: "POST",
                            url: urlweb + "api/Asistencias/registro_xdia",
                            data: {id: num, clase: clase,tipo:2,id_producto : id_producto, cobro: s_cobro},
                            dataType: 'json',
                            success:function (r) {
                                switch (r.result.code) {
                                    case 1:
                                        respuesta('¡Asistencia Agregada Exitosamente!', 'success');
                                        $('#dni_al').val('');
                                        $('#nombre_alumno').val('');
                                        $('#dni_al').focus();
                                        break;
                                    case 2:
                                        respuesta('Error al agregar asistencia', 'error');
                                        break;
                                    case 8:
                                        respuesta('Asistencia Agregada', 'success');
                                        $('#nombre_alumno').val('');
                                        $('#dni_al').focus();
                                        break;
                                    default:
                                        respuesta('¡Algo catastrofico ha ocurrido!', 'error');
                                        break;
                                }
                            }
                        });
                    }
                }
            });
            /*--------------------------------------*/





        }
    }



}