<script src="<?php echo base_url(); ?>complementos/js/portal.js"></script>

<h2 class="page-header">Subir Anuncio:</h2>
<div id="res_msj" style="display: none">
    <?php
    //Si se ha subido una imagen
    if($upload_state){
        echo success_msg($msg);
    }
    ?>
</div>
<div class="well" id="div_form_anuncio">  
    <input type="hidden" name="upload_state" id="upload_state">
    <form id="form_anuncio_register" class="form-horizontal"  method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>empresa/crear_anuncio">
        <p style="text-align: center" class="col-sm-10"> Suba una imagen publicitaria para mostrar a los usuarios de FindIt</p>
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Titulo Anuncio:</label>
            <div class="col-sm-4">
                <input type="text" id="anunc_name" name="anunc_name" class="form-control campos" placeholder="Digite un titulo a mostrar de su anuncio" required autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Imagen:</label>
            <div class="col-sm-4">     
                <input type="file" name="userfile" multiple="multiple">

            </div>
        </div>  
        <div class="form-group">
            <label for="formGroup" class="col-sm-4 control-label">Local / Empresa:</label>
            <div class="col-sm-4">
                <select id="emp_tipo" name="anuncio_emp_id" class="form-control">
                    <?php
                    foreach ($locales as $local) {
                        echo '<option value="' . $local->id . '">' . $local->nombre . '</option>';
                    }
                    ?>
                </select>
            </div>  
        </div>
        <br>
        <div id="messages_div">

        </div>
        <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label"></label>
            <div class="pull-right">
                <div class="col-sm-4">

                    <button type="submit" class="btn btn-success btn-lg" value="Upload" id="ajaxformbtn" data-target="messages_div">
                        <span class="glyphicon glyphicon-ok"></span>
                        Crear
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="<?php echo base_url(); ?>complementos/js/ajaxfileupload.js"></script>

<script>
    $(document).ready(function () {
        //Variable para saber si la imagen se subio con exito
        var state_upload = $("#upload_state").val();
        if(state_upload == 1){
            $('#div_form_anuncio').hide(1000);
            $('#res_msj').show(1000);
        }
    });

    /*Envio del formulario por ajax*/
//    var BASE_URL = "<?php // echo base_url();   ?>";
//    $("#form_anuncio_register").submit(function (event) {
//        event.preventDefault(); //Evitamos que el evento submit siga en ejecución, evitando que se recargue toda la página
//        $.post(BASE_URL + 'empresa/crear_anuncio', //La variable url ha de contener la base_url() de nuestra aplicacion
//                $("#form_anuncio_register").serialize(), //Codificamos todo el formulario en formato de URL por medio de la receta
//                function (data) {
//
////            alert('Resgistro Guardada Exitosamente');
//                    $("#messages_div").html(data);
////             alert(data);
//                    if (data == '<div style="font-size:16px;font-weight: bold" class="text-success"><span class="glyphicon glyphicon-ok-sign"></span> El proceso se ha completado correctamente. Empresa registrada</div>') {
//                        $(".campos").val('');
//                    }
//                    // c.close();
////                    $('div#sending_form').prepend(data); //Añadimos la respuesta AJAX a nuestro div de notificación de respuesta
//                });
//  $.ajaxFileUpload({
//            url             :BASE_URL + 'empresa/crear_anuncio', 
//            secureuri       :false,
//            fileElementId   :'userfile',
//            dataType: 'JSON',
//            success : function (data)
//            {
//               var obj = jQuery.parseJSON(data);                
//                if(obj['status'] == 'success')
//                {
//                    $('#files').html(obj['msg']);
//                 }
//                else
//                 {
//                    $('#files').html('Some failure message');
//                  }
//            }
//        });
//    });

</script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

