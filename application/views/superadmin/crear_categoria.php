<script src="<?php echo base_url(); ?>complementos/js/portal.js"></script>

<h2 class="page-header">Crear Categoria:</h2>
<div class="well" id="div_form_categoria">  
    <form id="form_categoria_register" class="form-horizontal"  method="post">
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Nombre Categoria/Tipo:</label>
            <div class="col-sm-4">
                <input type="text" id="categoria" name="categoria" class="form-control" required autofocus>
            </div>
        </div>
        <div id="messages_div">

        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label"></label>
            <div class="pull-right">
                <div class="col-sm-4">

                    <button type="submit" class="btn btn-success btn-lg"  id="add_categoria" data-target="messages_div">
                        <span class="glyphicon glyphicon-ok"></span>
                        Crear
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    /*Envio del formulario por ajax*/
    var BASE_URL = "<?php echo base_url(); ?>";
    $("#form_categoria_register").submit(function (event) {
        event.preventDefault(); //Evitamos que el evento submit siga en ejecución, evitando que se recargue toda la página
        $.post(BASE_URL + 'superadmin/index/create_category', //La variable url ha de contener la base_url() de nuestra aplicacion
                $("#form_categoria_register").serialize(), //Codificamos todo el formulario en formato de URL
                function (data) {
                    if (data == 1) {//Si el proceso se completo
                        res_msj = '<?php echo success_msg('. <br>El tipo/categoria se ha guardado correctamente en la base de datos.'); ?>';
                        $("#div_form_categoria").html(res_msj);
                    } else {
                        res_msj = '<?php echo error_msg('. <br>Ha ocurrido un error en la base de datos'); ?>';
                        $("#messages_div").html(res_msj);
                    }
                });
    });

</script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

