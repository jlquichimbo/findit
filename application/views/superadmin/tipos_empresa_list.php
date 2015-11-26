<h3>Listado tipos de empresa:</h3>
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

            foreach ($tipos_list as $empresa) {
                //Iconos para editar / eliminar
                $editar = '<a href="' . base_url("#") . '/' . $empresa->id
                        . '"> <i class="glyphicon glyphicon-pencil"> Editar</i></a>';

                $eliminar = '<a  href="' . base_url("#") . '/' . $empresa->id . '">'
                        . '<i class= "glyphicon glyphicon-trash"/> Eliminar </a>';
                echo Open('tr');
                echo tagcontent('td', $empresa->id);
                echo tagcontent('td', $empresa->nombre);
                echo tagcontent('td', $editar);
                echo tagcontent('td', $eliminar);
                echo Close('tr');
            }
            ?>
        </tbody>
    </table>
</div>