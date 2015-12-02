<html>

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
                $boton="<div class='switch'><input id='cmn-toggle-1' class='cmn-toggle cmn-toggle-round' type='checkbox'><label for='cmn-toggle-1'></label></div>";
                if($empresa->disponible==1){
                    //echo tagcontent('td', $empresa->disponible);
                    echo tagcontent('td', $boton);
                     
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
    
</body>
</html>