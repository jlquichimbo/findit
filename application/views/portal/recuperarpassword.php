<div id="form_registro" class="container well">
    <div class="row">
        <div class="col-xs-12">
            <h2>Recuperar password:</h2>
        </div>
        <br/><br/>
    </div>
    <form class="form-horizontal" action="<?=base_url("portal/enviarEmail")?>" method="post" enctype="multipart/form-data">
         <div class="form-group">
            <label for="formGroup" class="col-sm-2 control-label">Correo:</label>
            <div class="col-sm-4">
                <input type="email" id="formGroup" name="txtMail" class="form-control" required autofocus>
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