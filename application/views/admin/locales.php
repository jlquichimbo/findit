<div class="row formContEstablecer">  
    <div class="col-sm-12">
        <form id="form_horario">
            <h2>Establecer Horario:</h2>
            <hr>
            <div class="form-group">
                <label for="formGroup" class="col-sm-4 control-label">Nombre local:</label>
                <div class="col-sm-6">
                    <input type="text" id="nombreLocal" name="nombreLocal" class="form-control campos" value="tururu" disabled>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="formGroup" class="col-sm-12 control-label">Hora de apertura:</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" id="horaInicio" name="horaInicio" class="form-control campos" value="00 : 00" autofocus onclick="iniciarReloj()">                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-12" id="relojHoraInicio"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="formGroup" class="col-sm-12 control-label">Hora de cierre:</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" id="horaCierre" name="horaCierre" class="form-control campos" value="00 : 01" onclick="openReloj2()" disabled>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-12" id="relojHoraCierre"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            
            <div class="form-group">
                <label for="formGroup" class="col-sm-2 control-label"></label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-success btn-lg" id="ajaxformbtn" data-target="messages_div">
                        <span class=""></span>
                        Establecer
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Empresa</th>
                        <th>Id Admin</th>
                        <th>Latitud</th>
                        <th>Longitud</th>
                        <th>Disponibilidad</th>
                        <th>Apertura</th>
                        <th>Cierre</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    //print_r($locales);
                    $contBtn=0;
                    foreach ($locales as $empresa) {
                        //Iconos para editar / eliminar
                        $editar = '<a href="' . base_url("#") . '/' . $empresa->id
                                . '"> <i class="glyphicon glyphicon-pencil"> Editar</i></a>';

                        $eliminar = '<a  href="' . base_url("#") . '/' . $empresa->id . '">'
                                . '<i class= "glyphicon glyphicon-trash"/> Eliminar </a>';
                        echo Open('tr');
                        echo tagcontent('td', $empresa->id);
                        echo tagcontent('td', $empresa->nombre);
                        echo tagcontent('td', $empresa->direccion);
                        echo tagcontent('td', $empresa->tipo);
                        echo tagcontent('td', $empresa->nombre_admin);
                        echo tagcontent('td', $empresa->latitud);
                        echo tagcontent('td', $empresa->longitud);
                        echo tagcontent('td', "<div id='btn".$contBtn."'></div>");
                        $estados[$contBtn][0]=$empresa->id;
                        if($empresa->disponible==1){                    
                            $estados[$contBtn][1]=1;
                        }
                        else{
                            $estados[$contBtn][1]=0;
                        }
                        $contBtn=$contBtn+1;
                        echo tagcontent('td', $empresa->hora_apertura);
                        echo tagcontent('td', $empresa->hora_cierre);
                        echo tagcontent('td', $editar);
                        echo tagcontent('td', $eliminar);
                        echo Close('tr');
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--<div class='onoffswitch'><input type='checkbox' name='onoffswitch12345' class='onoffswitch-checkbox' id='myonoffswitch12345'><label class='onoffswitch-label' for='myonoffswitch12345'><span class='onoffswitch-inner'></span><span class='onoffswitch-switch'></span></label></div>-->
<script src='<?php echo base_url(); ?>complementos/js/admin.js'></script>
<script>
    var estados=<?php echo json_encode($estados);?>;
    crearBoton(estados);
</script>
<!--
<script>
    var BASE_URL = "<?php echo base_url(); ?>";
    $("#form_empresa_register").submit(function (event) {
        event.preventDefault(); //Evitamos que el evento submit siga en ejecución, evitando que se recargue toda la página
        $.post(BASE_URL + 'empresa/crear_local', //La variable url ha de contener la base_url() de nuestra aplicacion
                $("#form_empresa_register").serialize(), //Codificamos todo el formulario en formato de URL por medio de la receta
                function (data) {

//            alert('Resgistro Guardada Exitosamente');
                    $("#messages_div").html(data);
//             alert(data);
                    if (data == '<div style="font-size:16px;font-weight: bold" class="text-success"><span class="glyphicon glyphicon-ok-sign"></span> El proceso se ha completado correctamente. Empresa registrada</div>') {
                        setTimeout(function () {
//                   alert('entro alevento de tiempo');
//                   $("#cedula_usuario").removeAttr('value');
                            $(".campos").val('');
                        }, 200);
                    }
                    // c.close();
//                    $('div#sending_form').prepend(data); //Añadimos la respuesta AJAX a nuestro div de notificación de respuesta
                });
    });
</script>
-->