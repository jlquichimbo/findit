<br>
<div class="well">  
    <br>
<div class="table-responsive">
    <table id="myDataTable">
        <thead>
            <tr>
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
                        . '"> <i class="glyphicon glyphicon-pencil"></i></a>';

                $eliminar = '<a  href="' . base_url("#") . '/' . $empresa->id . '">'
                        . '<i class= "glyphicon glyphicon-trash"/></a>';
                echo Open('tr');
                echo tagcontent('td', $empresa->nombre);
                echo tagcontent('td', $empresa->direccion);
                echo tagcontent('td', $empresa->tipo);
                echo tagcontent('td', $empresa->nombre_admin);
                echo tagcontent('td', $empresa->latitud);
                echo tagcontent('td', $empresa->longitud);
                echo tagcontent('td', "<div id='btn".$contBtn."'></div>");
                if($empresa->disponible==1){                    
                    $estados[$contBtn]=1;
                }
                else{
                    $estados[$contBtn]=0;
                }
                $contBtn=$contBtn+1;
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
    </div>
<!--<div class='onoffswitch'><input type='checkbox' name='onoffswitch12345' class='onoffswitch-checkbox' id='myonoffswitch12345'><label class='onoffswitch-label' for='myonoffswitch12345'><span class='onoffswitch-inner'></span><span class='onoffswitch-switch'></span></label></div>-->
<script src='<?php echo base_url(); ?>complementos/js/admin.js'></script>
<script>
    var estados=<?php echo json_encode($estados);?>;
    crearBoton(estados);
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