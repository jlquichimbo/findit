<!-- Page Sidebar -->
<!-- Blog Sidebar Widgets Column -->
<!-- Blog Search Well -->
<span class="x-label-value" id="ext-gen30"><br></span>
<div class="well">
    <center><a><img src="<?php echo base_url(); ?>/complementos/img/avatar-login.png" width="130" heigth="150"></a></center>
  <!--<center><a href="index-portal.php"><img src="../img/usuario.jpeg" width="150" heigth="150"></a></center>-->
</div>
<!-- Blog Categories Well -->
<ul class="nav nav-sidebar">
    <li><a href="<?= base_url('superadmin/index') ?>"><i class="glyphicon glyphicon-plus"></i> Inicio</a></li>
    <li><a href="<?= base_url('superadmin/index/load_users') ?>"><i class="glyphicon glyphicon-tasks"></i> Usuarios</a></li>
    <li><a href="<?= base_url('superadmin/index/load_empresas') ?>"><i class="glyphicon glyphicon-tasks"></i> Empresas</a></li>
    <li><a href="<?= base_url('superadmin/index/load_tipo_empresas') ?>"><i class="glyphicon glyphicon-tasks"></i> Tipo servicios</a></li>
    <li><a href="<?= base_url('superadmin/index/load_roles') ?>"><i class="glyphicon glyphicon-tasks"></i> Roles</a></li>
    <li><a href="<?= base_url('superadmin/index/crear_local') ?>"><i class="glyphicon glyphicon-tasks"></i> Crear Local</a></li>
</ul>
<!-- /.row -->
<!--<div class="user-panel">
    <?php
    echo $this->load->view('login/user_logo', '', TRUE);
    ?>
</div>-->



<?php

