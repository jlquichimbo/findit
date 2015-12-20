<br>
<div class="container well" id="shaLogin">
    <div class="row">
        <?php echo validation_errors(); ?>
        <div class="col-xs-12">
            <center>
            <img class="img-responsive" id="avatar-login" src="<?php echo base_url(); ?>complementos/img/avatar-login.png">
            </center>
            </div>
        <form action="<?=base_url('index.php/login/verifylogin') ?>" class="login" method="post">
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Ingrese su correo" value="<?php echo set_value('username'); ?>" name="username" id="username" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Ingrese su password" value="<?php echo set_value('password'); ?>" name="password" id="password" required>
            </div>				
            <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesión</button>
            <br/>
            <p class="help-block">
                    <a  href="<?= base_url('portal/vistaRecuperarPass') ?>">¿Olvidastes tu contraseña?</a>
            </p>
        </form>
    </div>
</div>