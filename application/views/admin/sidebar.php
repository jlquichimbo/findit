    <br>
    <div class="well">
        <center><a><img src="<?php echo base_url(). 'uploads/images/users/'. $data_user[0]->usuario; ?>" width="150" heigth="150"></a></center>
    </div>
    
    <!-- Blog Categories Well -->
    
        <ul class="nav nav-sidebar">
            <li><a href="<?= base_url('admin/index') ?>"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
            <li><a href="<?= base_url('admin/index/cargarCrearLocal') ?>"><i class="glyphicon glyphicon-plus"></i> Crear Local</a></li>
            <li><a href="<?= base_url('admin/index/CargarMisLocales') ?>"><i class="glyphicon glyphicon-tasks"></i> Mis Locales</a></li>
            <li><a href="<?= base_url('admin/index/loadAnuncios') ?>"><i class="glyphicon glyphicon-tags"></i> Anuncios</a></li>
 
        </ul>
<!-- /.row -->
<?php

