<div id="content_link"></div>
<h3>Listado Usuarios</h3>
<div class="table-responsive">
    <table id="myDataTable">
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>C.I. / RUC</th>
                <th>Foto</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Telefono</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($usuarios_list as $usuario) {
                
                //Iconos para editar / eliminar
                $editar = '<a user_id='.$usuario->id.' class="link_edit" href="#"> '
                        . '<i class="glyphicon glyphicon-pencil"></i></a>';

                $eliminar = '<a user_id='.$usuario->id.' class="link_delete"  href="#">'
                        . '<i class= "glyphicon glyphicon-trash"/></a>';
                 
                $imagen=  base_url();
                
                echo Open('tr');
                echo tagcontent('td', $usuario->nombres);
                echo tagcontent('td', $usuario->apellidos);
                echo tagcontent('td', $usuario->cedula_ruc);
                echo tagcontent('td', "<a><img src= '$imagen.$usuario->usuario' width='50' heigth='60'></a>");
                echo tagcontent('td', $usuario->email);
                echo tagcontent('td', $usuario->rol);
                echo tagcontent('td', $usuario->telefono);
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
        var id = $(this).attr("user_id");	

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
    
    //Abrir formulario eliminar usuario por ajax
    var BASE_URL = "<?php echo base_url(); ?>";
    $('.link_delete').click(function (event){
        // Obtener id del usuario clickeado
        var id = $(this).attr("user_id");	

        console.log(id);
        event.preventDefault();//Para que no redirecciones a otro lado
        //variable que almacena el id de la empresa
        $.ajax({
            url: BASE_URL + 'usuario/delete_view/'+id,
            type: 'GET',
//            dataType: "html",
            success: function (data) {
//                console.log(data);
                $('#content_link').html(data);
            }
        });
    });
    
    
</script>
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">



<script type="text/javascript" charset="utf-8"> 
	
		$('#myDataTable').dataTable( {
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": true } );

</script> 