<div id="content_link"></div>
<h3>Listado tipos de empresa:</h3>
<div class="well well-sm">
    <table id="myDataTable">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Editar</th>
                <!--<th>Eliminar</th>-->
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($tipos_list as $tipo) {
                //Iconos para editar / eliminar
                $editar = '<a tipo_id="' . $tipo->id . '" class="link_edit" href="#"> <i class="glyphicon glyphicon-pencil"></i></a>';
                $eliminar = '<a tipo_id="' . $tipo->id . '" class="link_delete" href="#"><i class= "glyphicon glyphicon-trash"/></a>';
                echo Open('tr');
                echo tagcontent('td', $tipo->nombre);
                echo tagcontent('td', $editar);
//                echo tagcontent('td', $eliminar);
                echo Close('tr');
            }
            ?>
        </tbody>
    </table>
</div>
<br><br>
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">

<script>
//Abrir formulario editar local por ajax

    var BASE_URL = "<?php echo base_url(); ?>";
    //FUNCION PARA EDITAR CADA LOCAL
    $('.link_edit').click(function (event){
//    $(document).on("click", ".link_edit", function (event) {
        // Obtener id del local clickeado
        var id = $(this).attr("tipo_id");	

        console.log(id);
        event.preventDefault();//Para que no redirecciones a otro lado
        //variable que almacena el id de la empresa
        $.ajax({
            url: BASE_URL + 'empresa/editar_tipo_view/'+id,
            type: 'GET',
//            dataType: "html",
            success: function (data) {
//                console.log(data);
                $('#content_link').html(data);
            }
        });
    });
    
    //FUNCION PARA ELIMINAR CADA LOCAL
    $('.link_delete').click(function (event){
//    $(document).on("click", ".link_edit", function (event) {
        // Obtener id del local clickeado
        var id = $(this).attr("tipo_id");	

        console.log(id);
        event.preventDefault();//Para que no redirecciones a otro lado
        //variable que almacena el id de la empresa
        $.ajax({
            url: BASE_URL + 'empresa/delete_tipo_view/'+id,
            type: 'GET',
//            dataType: "html",
            success: function (data) {
//                console.log(data);
                $('#content_link').html(data);
            }
        });
    });
</script>
<script type="text/javascript" charset="utf-8"> 
	
		$('#myDataTable').dataTable( {
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": true } );

</script> 