
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Empresa</th>
                <th>Id Admin</th>
                <th>Latitud</th>
                <th>Longitud</th>
                <th>Disponibilidad</th>
                <th>Apertura</th>
                <th>Cierre</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php

            //print_r($locales);
            $contBtn=0;
            foreach ($locales as $empresa) {
                //Iconos para editar / eliminar
                $editar = '<a href="' . base_url("#") . '/' . $empresa->id
                        . '"> <i class="glyphicon glyphicon-pencil"> Editar</i></a>';

                $eliminar = '<a  href="' . base_url("#") . '/' . $empresa->id . '">'
                        . '<i class= "glyphicon glyphicon-trash"/> Eliminar </a>';
                echo Open('tr');
                echo tagcontent('td', $empresa->id);
                echo tagcontent('td', $empresa->nombre);
                echo tagcontent('td', $empresa->direccion);
                echo tagcontent('td', $empresa->tipo);
                echo tagcontent('td', $empresa->nombre_admin);
                echo tagcontent('td', $empresa->latitud);
                echo tagcontent('td', $empresa->longitud);
                if($empresa->disponible==1){
                    //echo tagcontent('td', $empresa->disponible);
                    echo tagcontent('td', "<div id='btn".$contBtn."'></div>");
                    $contBtn=$contBtn+1;
                }
                else{
                    echo tagcontent('td', "desavilitada");
                }
                echo tagcontent('td', $empresa->hora_apertura);
                echo tagcontent('td', $empresa->hora_cierre);
                echo tagcontent('td', $editar);
                echo tagcontent('td', $eliminar);
                echo Close('tr');
            }
            ?>
        </tbody>
    </table>
</div>
<!--<div class='onoffswitch'><input type='checkbox' name='onoffswitch12345' class='onoffswitch-checkbox' id='myonoffswitch12345'><label class='onoffswitch-label' for='myonoffswitch12345'><span class='onoffswitch-inner'></span><span class='onoffswitch-switch'></span></label></div>-->
<script src='<?php echo base_url(); ?>complementos/js/admin.js'></script>
<script>
    var total=<?php echo $contBtn ?>;
    crearBoton(total);
</script>