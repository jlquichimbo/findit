<h2 class="page-header">Editar Local:</h2>

<div class="row">  
    <form id="form_empresa_edit" class="form-horizontal" action="<?php echo base_url('empresa/editar_local') ?>" method="post">
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Nombre local:</label>
            <div class="col-sm-8">
                <input type="text" id="emp_name" name="emp_name" class="form-control campos" placeholder="Ingrese el nombre de su local" required autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Direccion:</label>
            <div class="col-sm-8">
                <input type="text" id="emp_address" name="emp_address" class="form-control campos" placeholder="Ingrese un sector que referencie su local" required>
            </div>
        </div>
        <?php
        ?>
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Categoria:</label>
            <div class="col-sm-8">
                <select id="emp_tipo" name="emp_tipo" class="form-control">
                    <?php
                    foreach ($tipos_empresa as $tipo) {
                        echo '<option value="' . $tipo->id . '">' . $tipo->nombre . '</option>';
                    }
                    ?>
                    <!--                    <option value="normal">Local 1</option>
                                        <option value="ingeniero">Local 2</option>
                                        <option value="php">Local 3</option>-->
                </select>
            </div>  
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Seleccione ubicaci&oacute;n:</label>
            <div class="col-sm-8">
                <div id="googleMap" style="width:100%;height:20em;"></div>
                <br>
                <label id="txtLatitud"></label>
                <input type="hidden" id="emp_lat" name="emp_lat" class="campos" value="">
                <input type="hidden" id="emp_lng" name="emp_lng" class="campos">
                <input type="hidden" id="emp_id" name="emp_id" class="campos">
                <!--<div class="row">
                  <div class="col-sm-2">
                    <b>Longitud:</b>
                  </div>
                  <div class="col-sm-8">
                    <label id="txtLatitud"></label>
                  </div>
                </div>-->
            </div>
        </div>
        <br>
        <div id="messages_div">

        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label"></label>
            <div class="col-sm-4">
                <button type="submit" class="btn btn-success btn-lg" id="ajaxformbtn" data-target="messages_div">
                    <span class="glyphicon glyphicon-ok"></span>
                    Crear
                </button>
            </div>
        </div>
    </form>
</div>
<script>
    /*Envio del formulario por ajax*/
    var BASE_URL = "<?php echo base_url(); ?>";
    $("#form_empresa_edit").submit(function (event) {
        event.preventDefault(); //Evitamos que el evento submit siga en ejecución, evitando que se recargue toda la página
        $.post(BASE_URL + 'empresa/editar_local', //La variable url ha de contener la base_url() de nuestra aplicacion
                $("#form_empresa_edit").serialize(), //Codificamos todo el formulario en formato de URL por medio de la receta
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


    var center = new google.maps.LatLng(-3.99313, -79.20422);
    var map;
    function initialize() {
        // Create the map.
        var mapOptions = {
            zoom: 17,
            center: center,
            mapTypeId: google.maps.MapTypeId.TERRAIN
        };
        map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
        google.maps.event.addListener(map, 'click', function (event) {
            marca(event.latLng);
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    function marca(location) {
        $("#emp_lat").val(location.lat());
        $("#emp_lng").val(location.lng());
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }

</script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

