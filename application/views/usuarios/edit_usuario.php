<div id="form_registro" class="container well">
    <div class="row">
        <div class="col-xs-12">
            <h2>Editar Usuario:</h2>
        </div>
        <br/><br/>
    </div>
    <form id="form_usuario_edit" class="form-horizontal" action="<?php echo base_url('usuario/registrar') ?>" method="post">
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Cedula:</label>
            <div class="col-sm-2">
                <input type="text" id="formGroup" name="txtCedula" value="<?php echo $usuario->cedula_ruc ?>" class="form-control" required autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Nombres:</label>
            <div class="col-sm-4">
                <input type="text" id="formGroup" name="txtNombre" value="<?php echo $usuario->nombres ?>" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Apellidos:</label>
            <div class="col-sm-4">
                <input type="text" id="formGroup" name="txtApellido" value="<?php echo $usuario->apellidos ?>" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Foto:</label>
            <div class="col-sm-4">
                <input type="file" id="formGroup" name="fileFoto"  class="form-control">
            </div>
        </div>
        <!--			<div class="form-group">
                                        <label for="formGroup" class="col-sm-2 control-label">Direcci&oacute;n:</label>
                                        <div class="col-sm-4">
                                                <input type="text" id="formGroup" name="txtDireccion" class="form-control" required>
                                        </div>
                                </div>-->
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Telefono:</label>
            <div class="col-sm-4">
                <input type="text" id="formGroup" name="txtTelefono" value="<?php echo $usuario->telefono ?>" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Correo:</label>
            <div class="col-sm-4">
                <input type="mail" id="formGroup" name="txtMail" value="<?php echo $usuario->email ?>" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Password:</label>
            <div class="col-sm-4">
                <input type="password" id="formGroup" name="txtPassword" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Confirmar password:</label>
            <div class="col-sm-4">
                <input type="password" id="formGroup" name="txtConfirmarPassword" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label"></label>
            <div class="col-sm-4">
                <button type="submit" class="btn btn-success btn-lg">
                    <span class="glyphicon glyphicon-fire"></span>
                    Editar
                </button>
            </div>
        </div>			
    </form>
</div>
<script>
    /*Envio del formulario por ajax*/
    var BASE_URL = "<?php echo base_url(); ?>";
    $("#form_usuario_edit").submit(function (event) {

        event.preventDefault(); //Evitamos que el evento submit siga en ejecución, evitando que se recargue toda la página
        $.post(BASE_URL + 'usuario/editar', //La variable url ha de contener la base_url() de nuestra aplicacion
                $("#form_usuario_edit").serialize(), //Codificamos todo el formulario en formato de URL por medio de la receta
                function (data) {
                    console.log(data);
//                    $("#form_registro").html(data);
                    $('#form_registro').prepend(data); //Añadimos la respuesta AJAX a nuestro div de notificación de respuesta
                });
    });
</script>