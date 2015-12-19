<div id="form_registro" class="container well">
    <div class="row">
        <div class="col-xs-12">
            <h2>Registrate:</h2>
        </div>
        <br/><br/>
    </div>
    
    
    <form id="form_usuario_register" class="form-horizontal" action="<?=base_url("usuario/registrar")?>" method="post" enctype="multipart/form-data">
         <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Correo:</label>
            <div class="col-sm-4">
                <input type="email" id="formGroup" name="txtMail" class="form-control" required autofocus>
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
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Foto:</label>
            <div class="col-sm-4">     
                <input type="file" name="userfile" >
                
            </div>
        </div>  
        
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Cedula:</label>
            <div class="col-sm-2">
                <input type="text" id="formGroup" name="txtCedula" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Nombres:</label>
            <div class="col-sm-4">
                <input type="text" id="formGroup" name="txtNombre" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Apellidos:</label>
            <div class="col-sm-4">
                <input type="text" id="formGroup" name="txtApellido" class="form-control" required>
            </div>
        </div>
        
          
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Telefono:</label>
            <div class="col-sm-4">
                <input type="text" id="formGroup" name="txtTelefono" class="form-control" required>
            </div>
        </div>
       
         

        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label"></label>
            <div class="col-sm-4">
                <!--<input type="submit" value="Enviar"/>-->
                <button type="submit" class="btn btn-success btn-lg">
                    <span class="glyphicon glyphicon-fire"></span>
                    Aceptar
                </button>
            </div>
        </div>			
    </form>
</div>
<script>
    $('#txtConfirmarPassword').blur(function(){
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