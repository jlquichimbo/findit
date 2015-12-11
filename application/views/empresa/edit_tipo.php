
<!--<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js?ver=3.1.2'></script>-->
<script async="" type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjSP5qZdefYhf1lI6iuBh0gT5BUgYQUWw&amp;sensor=true&callback=initialize"></script>
<!--<script type="text/javascript" src='https://www.google.com/jsapi'></script>-->
<!--<script src="<?php echo base_url(); ?>complementos/js/portal.js"></script>-->


<h2 class="page-header">Editar Local:</h2>

<div class="row" id="form_registro">  
    <form id="form_empresa_edit" class="form-horizontal" action="<?php echo base_url('empresa/crear_local') ?>" method="post">
        <input value="<?php echo $tipo[0]->id ?>"  type="hidden" id="id_tipo" name="id_tipo" class="campos">
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Nombre Tipo:</label>
            <div class="col-sm-8">
                <input value="<?php echo $tipo[0]->nombre ?>" type="text" id="tipo_name" name="tipo_name" class="form-control campos" placeholder="Ingrese el nombre de su local" required autofocus>
            </div>
        </div>

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
            <label for="formGroup" class="col-sm-2 control-label"></label>
            <div class="col-sm-4">
                <button id="btn_cancel" type="reset" class="btn btn-danger btn-lg">
                    <span class="glyphicon glyphicon-remove"></span>
                    Cancelar
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
        $.post(BASE_URL + 'empresa/editar_tipo', //La variable url ha de contener la base_url() de nuestra aplicacion
                $("#form_empresa_edit").serialize(), //Codificamos todo el formulario en formato de URL por medio de la receta
                function (data) {
                    $("#form_registro").html(data);
                });
    });
    
    //Ocultar el div al hacer clic en cancelar
    $('#btn_cancel').click(function (){
        $('#form_registro').hide(1000);
    });


</script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

