<div id="content_link"></div>
<h3>Listado empresas</h3>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Administrador</th>
                <th>Tipo</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($empresas_list as $empresa) {
                //Iconos para editar / eliminar
//                $editar = '<a id="link_edit" href="' . base_url("#") . '/' . $empresa->id
                $editar = '<a id="' . $empresa->id . '" class="link_edit" href="#"> <i class="glyphicon glyphicon-pencil"> Editar</i></a>';

                $eliminar = '<a id="link_delete" href="' . base_url("#") . '/' . $empresa->id . '">'
                        . '<i class= "glyphicon glyphicon-trash"/> Eliminar </a>';
                echo Open('tr');
                echo tagcontent('td', $empresa->id);
                echo tagcontent('td', $empresa->nombre);
                echo tagcontent('td', $empresa->nombre_admin);
                echo tagcontent('td', $empresa->tipo);
                echo tagcontent('td', $editar);
                echo tagcontent('td', $eliminar);
                echo Close('tr');
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    //Abrir formulario editar local por ajax

    var BASE_URL = "<?php echo base_url(); ?>";
    $('.link_edit').click(function (event){
//    $(document).on("click", ".link_edit", function (event) {
        // Obtener id del local clickeado
        var id = $(this).attr("id");	

        console.log(id);
        event.preventDefault();//Para que no redirecciones a otro lado
        //variable que almacena el id de la empresa
        $.ajax({
            url: BASE_URL + 'superadmin/index/editar_local_view/'+id,
            type: 'GET',
//            dataType: "html",
            success: function (data) {
//                console.log(data);
                $('#content_link').html(data);
            }
        });
    });
    
    
</script>