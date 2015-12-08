<div id="content_link"></div>

<h3>Listado Usuarios</h3>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>C.I. / RUC</th>
                <th>Username</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($usuarios_list as $usuario) {
                //Iconos para editar / eliminar
                $editar = '<a id='.$usuario->id.' class="link_edit" href="#"> <i class="glyphicon glyphicon-pencil"> Editar</i></a>';

                $eliminar = '<a  href="' . base_url("#") . '/' . $usuario->id . '">'
                        . '<i class= "glyphicon glyphicon-trash"/> Eliminar </a>';
                echo Open('tr');
                echo tagcontent('td', $usuario->id);
                echo tagcontent('td', $usuario->nombres);
                echo tagcontent('td', $usuario->apellidos);
                echo tagcontent('td', $usuario->cedula_ruc);
                echo tagcontent('td', $usuario->usuario);
                echo tagcontent('td', $usuario->email);
                echo tagcontent('td', $usuario->rol);
                echo tagcontent('td', $editar);
                echo tagcontent('td', $eliminar);
                echo Close('tr');
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    //Abrir formulario editar usurio por ajax

    var BASE_URL = "<?php echo base_url(); ?>";
    $('.link_edit').click(function (event){
        // Obtener id del usuario clickeado
        var id = $(this).attr("id");	

        console.log(id);
        event.preventDefault();//Para que no redirecciones a otro lado
        //variable que almacena el id de la empresa
        $.ajax({
            url: BASE_URL + 'usuario/editar_view/'+id,
            type: 'GET',
//            dataType: "html",
            success: function (data) {
//                console.log(data);
                $('#content_link').html(data);
            }
        });
    });
    
    
</script>