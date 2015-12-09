
<!--<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js?ver=3.1.2'></script>-->
<script async="" type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjSP5qZdefYhf1lI6iuBh0gT5BUgYQUWw&amp;sensor=true&callback=initialize"></script>
<!--<script type="text/javascript" src='https://www.google.com/jsapi'></script>-->
<!--<script src="<?php echo base_url(); ?>complementos/js/portal.js"></script>-->


<h2 class="page-header">Editar Local:</h2>

<div class="row" id="form_registro">  
    <form id="form_empresa_edit" class="form-horizontal" action="<?php echo base_url('empresa/crear_local') ?>" method="post">
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Nombre local:</label>
            <div class="col-sm-8">
                <input value="<?php echo $empresa[0]->nombre ?>" type="text" id="emp_name" name="emp_name" class="form-control campos" placeholder="Ingrese el nombre de su local" required autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Direccion:</label>
            <div class="col-sm-8">
                <input value="<?php echo $empresa[0]->direccion ?>" type="text" id="emp_address" name="emp_address" class="form-control campos" placeholder="Ingrese un sector que referencie su local" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Categoria:</label>
            <div class="col-sm-8">
                <select id="emp_tipo" name="emp_tipo" class="form-control">
                    <?php
                    foreach ($tipos_empresa as $tipo) {
                        echo '<option value="' . $tipo->id . '">' . $tipo->nombre . '</option>';
                    }
                    ?>
                    <option value="normal">Local 1</option>
                    <option value="ingeniero">Local 2</option>
                    <option value="php">Local 3</option>
                </select>
            </div>  
        </div>
        <!--Se desabilita el mapa por ahora-->
        <!--        <div class="form-group">
                    <label for="formGroup" class="col-sm-4 control-label">Seleccione ubicaci&oacute;n:</label>
                    <div class="col-sm-8">
                        <div id="googleMap" style="width:100%;height:20em;"></div>
                        <br>
                        <label id="txtLatitud"></label>
                    </div>
                </div>
                <br>
        -->           
        <input value="<?php echo $empresa[0]->latitud ?>"  type="hidden" id="emp_lat" name="emp_lat" class="campos">
        <input value="<?php echo $empresa[0]->longitud ?>"  type="hidden" id="emp_lng" name="emp_lng" class="campos">
        <input value="<?php echo $id_emp ?>" type="hidden" id="id_emp" name="id_emp" class="campos" >
        <input value="<?php echo $empresa[0]->id_admin ?>"  type="hidden" id="admin_id" name="id_admin" class="campos">

        <div id="messages_div">

        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label"></label>
            <div class="col-sm-4">
                <button type="submit" class="btn btn-success btn-lg" id="ajaxformbtn" data-target="messages_div">
                    <span class="glyphicon glyphicon-ok"></span>
                    Editar
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
        $.post(BASE_URL + 'empresa/editar', //La variable url ha de contener la base_url() de nuestra aplicacion
                $("#form_empresa_edit").serialize(), //Codificamos todo el formulario en formato de URL por medio de la receta
                function (data) {
                    $("#form_registro").html(data);
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

