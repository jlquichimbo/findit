<h3>Listado roles:</h3>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Tipo</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($roles as $rol) {
                //Iconos para editar / eliminar
                $editar = '<a href="' . base_url("#") . '/' . $rol->id
                        . '"> <i class="glyphicon glyphicon-pencil"> Editar</i></a>';

                $eliminar = '<a  href="' . base_url("#") . '/' . $rol->id . '">'
                        . '<i class= "glyphicon glyphicon-trash"/> Eliminar </a>';
                echo Open('tr');
                echo tagcontent('td', $rol->id);
                echo tagcontent('td', $rol->nombre);
                echo tagcontent('td', $rol->descripcion);
                echo tagcontent('td', $editar);
                echo tagcontent('td', $eliminar);
                echo Close('tr');
            }
            ?>
        </tbody>
    </table>
</div>