<div class="well-sm">
    <h2>Registrate:</h2>
    <form id="form_usuario_register" class="form-horizontal" action="<?= base_url("usuario/registrar") ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Cedula:</label>
            <div class="col-sm-4">
                <input type="text" id="txtCedula" name="txtCedula" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-6 control-label" id="msjCedula" style="color: #ff4258; display: none"></label>
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
                <input type="text" id="txtTelefono" name="txtTelefono" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-6 control-label" id="msjTelefono" style="color: #ff4258; display: none"></label>
        </div> 
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Correo:</label>
            <div class="col-sm-4">
                <input type="email" id="txtMail" name="txtMail" class="form-control" required autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-6 control-label" id="msjEmail" style="color: #ff4258; display: none"></label>
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
            <label for="formGroup" class="col-sm-2 control-label"></label>
            <div class="col-sm-4">
                <!--<input type="submit" value="Enviar"/>-->
                <button type="submit" class="btn btn-success btn-lg" id="btnGuardar">
                    <span class="glyphicon glyphicon-fire"></span>
                    Aceptar
                </button>
            </div>
        </div>			
    </form>
    <br><br>
</div>
<script>
    /*Validacion de coincidencia de passwords*/
    $('#txtConfirmarPassword').blur(function () {
        validatePassword();
    });
    var password = document.getElementById("txtPassword")
            , confirm_password = document.getElementById("txtConfirmarPassword");
    function validatePassword() {
//        console.log('Ingreso a validacion password');
        if (password.value !== confirm_password.value) {
//            console.log('No coinciden');
            $('#msjPassword').text("Passwords No coinciden");
            $('#msjPassword').show(1000);
            document.getElementById("btnGuardar").disabled = true;
        } else {
//            console.log('Coinciden');
            $('#msjPassword').hide(1000);
            document.getElementById("btnGuardar").disabled = false;

        }
    }

    /*Validacion de solo numeros en cedula*/
    $('#txtCedula').keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $("#msjCedula").html("Solo digitos!").show().fadeOut("slow");
            return false;
        }
    });
    /*Validacion de solo numeros en telefono*/
    $('#txtTelefono').keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $("#msjTelefono").html("Solo digitos!").show().fadeOut("slow");
            return false;
        }
    });

    /*Validacion de longitud de cedula*/
    $('#txtCedula').blur(function () {
        cedula_length = $(this).val().length;
        console.log(cedula_length);
        if (cedula_length !== 10) {
            $("#msjCedula").html("Digite un numero de cedula de 10 digitos").show(1000);
            document.getElementById("btnGuardar").disabled = true;
        }
        else {
            $('#msjCedula').hide(1000);
            document.getElementById("btnGuardar").disabled = false;
        }

    });
    /*Validacion de longitud de telefono*/
    $('#txtTelefono').blur(function () {
        cedula_length = $(this).val().length;
        console.log(cedula_length);
        if (cedula_length !== 10) {
            $("#msjTelefono").html("Digite un numero de telefono de 10 digitos").show(1000);
            document.getElementById("btnGuardar").disabled = true;
        }
        else {
            $('#msjTelefono').hide(1000);
            document.getElementById("btnGuardar").disabled = false;
        }

    });
    
    /*Validacion si correo ya ha sido registrado*/
    $('#txtMail').blur(function(){
        check_email();
    });
    function check_email() {
            main_path = "<?php echo base_url(); ?>";

            var email = $("#txtMail").val();
            var url = main_path+'usuario/check_email';
            $.ajax({
                type: "POST",
                url: url,
                data: { email: email},// sitaxis ci: nombre de una variable para acceder desde elcontrolador php datum.ci=> este puede ser el nombre del input o campo html
                success: function(data){
                    console.log(data);
                    if(data != -1){
                        $('#msjEmail').html(data);
                        $('#msjEmail').show(1000);
                        document.getElementById("btnGuardar").disabled = true;
                    }else{
                        $('#msjEmail').hide(1000);
                        document.getElementById("btnGuardar").disabled = false;
                    }
                    
                },
                error: function(){
                    //alertaError("Error!! No se pudo alcanzar el archivo de proceso", "Error!!");
                }              
            });
            
    }   
    

</script>