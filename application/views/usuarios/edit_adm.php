<div id="form_registro" class="well">
    <div class="row">
        <div class="col-xs-12">
            <h2>Editar Usuario:</h2>
        </div>
        <br/><br/>
    </div>
    <form id="form_usuario_edit" class="form-horizontal" action="<?php echo base_url('usuario/editarADM') ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Cedula:</label>
            <div class="col-sm-2">
                <input value="<?php echo $data_user[0]->cedula_ruc ?>" type="text" id="formGroup" name="txtCedula" class="form-control" required autofocus  readonly="readonly">
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Nombres:</label>
            <div class="col-sm-4">
                <input type="text" id="formGroup" name="txtNombre" value="<?php echo $data_user[0]->nombres ?>" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Apellidos:</label>
            <div class="col-sm-4">
                <input type="text" id="formGroup" name="txtApellido" value="<?php echo $data_user[0]->apellidos ?>" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Foto:</label>
            <div class="col-sm-4">
                <input type="file" name="fileFoto"  >
            </div>
        </div>
        

        
        
        
        
        
        
        
        
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Telefono:</label>
            <div class="col-sm-4">
                <input type="text" id="formGroup" name="txtTelefono" value="<?php echo $data_user[0]->telefono ?>" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Correo:</label>
            <div class="col-sm-4">
                <input type="mail" id="formGroup" name="txtMail" value="<?php echo $data_user[0]->email ?>" class="form-control" required  readonly="readonly">
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Password:</label>
            <div class="col-sm-4">
                <input type="password" id="txtPassword" name="txtPassword" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Confirmar password:</label>
            <div class="col-sm-4">
                <input type="password" id="txtConfirmarPassword" name="txtConfirmarPassword" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-6 control-label" id="msjPassword" style="color: #ff4258; display: none"></label>
        </div>
        <!--Id del usuario a editar-->
        <input type="hidden" id="id_user" name="id_user" value="<?php echo $data_user[0]->id ?>">
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
        $.post(BASE_URL + 'usuario/editarADM', //La variable url ha de contener la base_url() de nuestra aplicacion
                $("#form_usuario_edit").serialize(), //Codificamos todo el formulario en formato de URL por medio de la receta
                function (data) {
                    console.log(data);
//                    $("#form_registro").html(data);
                    $('#form_registro').html(data); //Añadimos la respuesta AJAX a nuestro div de notificación de respuesta
                   // location.reload();
                });
    });
    
    //Ocultar el div al hacer clic en cancelar
    $('#btn_cancel').click(function (){
        $('#form_registro').hide(1000);
    });

    $('#txtConfirmarPassword').blur(function () {
        validatePassword();
    });
    var password = document.getElementById("txtPassword")
            , confirm_password = document.getElementById("txtConfirmarPassword");
    function validatePassword() {
//        console.log('Ingreso a validacion password');
        if (password.value !== confirm_password.value) {
//            console.log('No coinciden');
            confirm_password.setCustomValidity("Passwords No coinciden");
            $('#msjPassword').text("Passwords No coinciden");
            $('#msjPassword').show(1000);
        } else {
//            console.log('Coinciden');
            confirm_password.setCustomValidity('');
            $('#msjPassword').hide(1000);
        }
    }
//    password.onchange = validatePassword;
//    confirm_password.onkeyup = validatePassword;
</script>