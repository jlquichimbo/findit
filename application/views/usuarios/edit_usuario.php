<div id="form_registro" class="container well">
    <div class="row">
        <div class="col-xs-12">
            <h2>Editar Usuario:</h2>
        </div>
        <br/><br/>
    </div>
    <form id="form_usuario_edit" class="form-horizontal" action="<?php echo base_url('usuario/editar') ?>" method="post">
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Cedula:</label>
            <div class="col-sm-2">
                <input value="<?php  echo $usuario[0]->cedula_ruc ?>" type="text" id="formGroup" name="txtCedula" class="form-control" required autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Nombres:</label>
            <div class="col-sm-4">
                <input type="text" id="formGroup" name="txtNombre" value="<?php echo $usuario[0]->nombres ?>" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Apellidos:</label>
            <div class="col-sm-4">
                <input type="text" id="formGroup" name="txtApellido" value="<?php echo $usuario[0]->apellidos ?>" class="form-control" required>
            </div>
        </div>
       <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Rol:</label>
            <div class="col-sm-4">
                <select id="rol" name="rol" class="form-control">
                    <?php
                    foreach ($roles as $rol) {
                        echo '<option value="' . $rol->id . '">' . $rol->nombre . '</option>';
                    }
                    ?>
                </select>
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
                <input type="text" id="formGroup" name="txtTelefono" value="<?php echo $usuario[0]->telefono ?>" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Correo:</label>
            <div class="col-sm-4">
                <input type="mail" id="formGroup" name="txtMail" value="<?php echo $usuario[0]->email ?>" class="form-control" required>
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

        <input type="hidden" id="id_user" name="id_user" value="<?php echo $id_user ?>">
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
                    $('#form_registro').html(data); //Añadimos la respuesta AJAX a nuestro div de notificación de respuesta
                });
    });
</script>