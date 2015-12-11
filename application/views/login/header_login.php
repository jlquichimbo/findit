
<div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacion-fm">
        <span class="sr-only">Desplegar / Ocultar menu</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a href="<?= base_url('portal') ?>" class="navbar-brand"><img src="<?php echo base_url(); ?>/complementos/img/icon-logo.jpg" alt="Loguito"></a>
</div>
<!--Inicia menu-->
<div class="collapse navbar-collapse" id="navegacion-fm">
    <!--<a href ="login.php" type="button" class="btn btn-primary navbar-btn navbar-right">Ingresa</a>-->
    <a href ="<?= base_url('#') ?>" type="button" class="btn btn-primary navbar-btn navbar-right">Mi perfil</a>

    <a href ="<?= base_url('login/login/logout') ?>" type="button" class="btn btn-primary navbar-btn navbar-right">Salir</a>

    <form action="#" class="navbar-form navbar-right" role="search">
        <div class="form-group"><input type="text" class="form-control" placeholder="Buscar..."></div>
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
    </form>
</div>
