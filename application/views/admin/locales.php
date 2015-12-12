<div class="row formContEstablecer" id="formContenedor">  
    <div class="col-sm-12">
        <form id="form_horario">
            <h2>Establecer Horario:</h2>
            <hr id ="LineaHorario">
            <div class="row">
                <div class="col-md-9">
                    <div class="row nomLocal">
                        <div class="col-sm-2 etiquetaHora ">
                            <h4><b>Nombre local:</b></h4>
                        </div>                
                        <div class="col-sm-4">
                            <input type="text" id="nombreLocal" class="form-control" name="nombreLocal" value="tururu" disabled>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-md-5 etiquetaHora">
                                    <h4><b>Hora de apertura:</b></h4>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="horaInicio" name="horaInicio" value="00 : 00" autofocus onclick="iniciarReloj()">                                
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-sm-12" id="relojHoraInicio"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-4 etiquetaHora">
                                    <h4><b>Hora de cierre:</b></h4>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="horaCierre" name="horaCierre" class="form-control" value="00 : 01" onclick="openReloj2()" disabled>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-sm-12" id="relojHoraCierre"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-success btn-lg" id="ajaxformbtn" data-target="messages_div">
                                <span class="glyphicon glyphicon-fire"></span>
                                Establecer
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <img src="<?php echo base_url(); ?>complementos/img/reloj.gif" class="img-responsive" width="65%" alt="Reloj animado">
                </div>
            </div>          
        </form>
    </div>
</div>
<br>
<div class="well" id ="contTabla">  
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
                    echo tagcontent('td', "<div id='btn".$empresa->id."'></div>");
                            $estados[$contBtn][0]=$empresa->id;
                            if($empresa->disponible==1){                    
                                $estados[$contBtn][1]=1;
                            }
                            else{
                                $estados[$contBtn][1]=0;
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
    var estad=<?php echo json_encode($estados);?>;
    crearBoton(estad);
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