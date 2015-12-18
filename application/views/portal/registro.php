<br>
<div class="well col-sm-8">    
    <h2>Registrate:</h2>
    <br/>

    <form id="form_usuario_register" class="form-horizontal" action="<?php echo base_url('usuario/registrar') ?>" method="post">
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Correo:</label>
            <div class="col-sm-6">
                <input type="mail" id="formGroup" name="txtMail" class="form-control" required autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Password:</label>
            <div class="col-sm-6">
                <input type="password" id="txtPassword" name="txtPassword" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Confirmar password:</label>
            <div class="col-sm-6">
                <input type="password" id="txtConfirmarPassword" name="txtConfirmarPassword" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-10 control-label" id="msjPassword" style="color: #ff4258; display: none"></label>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Cedula:</label>
            <div class="col-sm-6">
                <input type="text" id="formGroup" name="txtCedula" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Nombres:</label>
            <div class="col-sm-6">
                <input type="text" id="formGroup" name="txtNombre" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Apellidos:</label>
            <div class="col-sm-6">
                <input type="text" id="formGroup" name="txtApellido" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Foto:</label>
            <div class="col-sm-6">
                <input type="file" id="formGroup" name="file_name" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Telefono:</label>
            <div class="col-sm-6">
                <input type="text" id="formGroup" name="txtTelefono" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label"></label>
            <div class="col-sm-8"><br>
                <div class="pull-right">
                    <button type="submit" class="btn btn-success btn-lg">
                        <span class="glyphicon glyphicon-fire"></span>
                        Aceptar
                    </button>
                </div>
            </div>
        </div>			
    </form>
</div>
</div>
<script>
    $('#txtConfirmarPassword').blur(function(){
        validatePassword();
        console.log('perdida de focus');
    });
    var password = document.getElementById("txtPassword")
            , confirm_password = document.getElementById("txtConfirmarPassword");

    function validatePassword() {
        console.log('Ingreso a validacion password');
        if (password.value !== confirm_password.value) {
            console.log('No coinciden');
            confirm_password.setCustomValidity("Passwords No coinciden");
            $('#msjPassword').text("Passwords No coinciden");
            $('#msjPassword').show(1000);
        } else {
            console.log('Coinciden');
            confirm_password.setCustomValidity('');
            $('#msjPassword').hide(1000);
        }
    }

//    password.onchange = validatePassword;
//    confirm_password.onkeyup = validatePassword;
</script>