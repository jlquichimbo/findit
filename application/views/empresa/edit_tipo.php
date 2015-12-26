<br>
<div class="well" id="form_registro">
    <h2 class="page-header">Editar Tipo de Local:</h2>
    <form id="form_empresa_edit" class="form-horizontal" action="<?php echo base_url('empresa/crear_local') ?>" method="post">
        <input value="<?php echo $tipo[0]->id ?>"  type="hidden" id="id_tipo" name="id_tipo" class="campos">
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Nombre Tipo:</label>
            <div class="col-sm-5">
                <input value="<?php echo $tipo[0]->nombre ?>" type="text" id="tipo_name" name="tipo_name" class="form-control campos" placeholder="Ingrese el nombre de su local" required autofocus>
            </div>
        </div>

        <div class="form-group">
            <label for="formGroup" class="col-sm-12 control-label">
            <div class="col-sm-9">
                <button type="submit" class="btn btn-success btn-lg" id="ajaxformbtn" data-target="messages_div">
                    <span class="glyphicon glyphicon-ok"></span>
                    Editar
                </button>
            </div>
            <div class="col-sm-2">
                <button id="btn_cancel" type="reset" class="btn btn-danger btn-lg">
                    <span class="glyphicon glyphicon-remove"></span>
                    Cancelar
                </button>
            </div>
                </label>
        </div>	
        </div>
    </form>

<script>
    /*Envio del formulario por ajax*/
    var BASE_URL = "<?php echo base_url(); ?>";
    $("#form_empresa_edit").submit(function (event) {
        event.preventDefault(); //Evitamos que el evento submit siga en ejecución, evitando que se recargue toda la página
        $.post(BASE_URL + 'empresa/editar_tipo', //La variable url ha de contener la base_url() de nuestra aplicacion
                $("#form_empresa_edit").serialize(), //Codificamos todo el formulario en formato de URL por medio de la receta
                function (data) {
                    $("#form_registro").html(data);
                     location.reload();
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

