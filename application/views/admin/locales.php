<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjSP5qZdefYhf1lI6iuBh0gT5BUgYQUWw&amp;sensor=true"></script>
<script type="text/javascript" src='https://www.google.com/jsapi'></script>
<div id="content_link"></div>
<div class="row formContEstablecer" id="formContenedor">  
    <?php
    $this->load->view('empresa/horario_form');
    ?>
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
                    <th>Disponibilidad</th>
                    <th>Apertura</th>
                    <th>Cierre</th>
                    <th> </th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                //print_r($locales);
                $contBtn = 0;
                foreach ($locales as $empresa) {
                    //Iconos para editar / eliminar
                    $editar = '<a emp_id="' . $empresa->id . '" class="link_edit" href="#"> <i class="glyphicon glyphicon-pencil"></i></a>';
                    $eliminar = '<a emp_id="' . $empresa->id . '" class="link_delete" href="#"><i class= "glyphicon glyphicon-trash"/></a>';
                    echo Open('tr');
                    echo tagcontent('td', $empresa->nombre);
                    echo tagcontent('td', $empresa->direccion);
                    echo tagcontent('td', $empresa->tipo);
                    //  echo tagcontent('td', $empresa->latitud);
                    // echo tagcontent('td', $empresa->longitud);
                    echo tagcontent('td', "<div id='btn" . $empresa->id . "'></div>");
                    $estados[$contBtn][0] = $empresa->id;
                    if ($empresa->disponible == 1) {
                        $estados[$contBtn][1] = 1;
                    } else {
                        $estados[$contBtn][1] = 0;
                    }
                    $contBtn = $contBtn + 1;
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
    var estad =<?php echo json_encode($estados); ?>;
    crearBoton(estad);
</script>
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf-8">

    $('#myDataTable').dataTable({
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": true});

</script> 
<script>
    //Abrir formulario editar local por ajax

    var BASE_URL = "<?php echo base_url(); ?>";
    //FUNCION PARA EDITAR CADA LOCAL
    var map;
    var marker = null;

    function initialize() {
        $('.link_edit').click(function (event) {
            var id = $(this).attr("emp_id");

            console.log(id);
            event.preventDefault();//Para que no redirecciones a otro lado
            //variable que almacena el id de la empresa
            $.ajax({
                url: BASE_URL + 'empresa/editar_local_view/' + id,
                type: 'GET',
//            dataType: "html",
                success: function (data) {
//                console.log(data);
                    $('#content_link').html(data);
                    var auxlat = $('#emp_lat').val();
                    var auxlong = $('#emp_lng').val();
                    var latlng = new google.maps.LatLng(auxlat, auxlong);
                    var myOptions = {
                        zoom: 13,
                        center: latlng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    map = new google.maps.Map(document.getElementById("googleMap"), myOptions);
                    marker = new google.maps.Marker({
                        position: latlng,
                        map: map
                    });
                    google.maps.event.addListener(map, 'click', function (event) {
                        marca(event.latLng);
                    });

                }
            });
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);


    //FUNCION PARA ELIMINAR CADA LOCAL
    $('.link_delete').click(function (event) {
//    $(document).on("click", ".link_edit", function (event) {
        // Obtener id del local clickeado
        var id = $(this).attr("emp_id");

        console.log(id);
        event.preventDefault();//Para que no redirecciones a otro lado
        //variable que almacena el id de la empresa
        $.ajax({
            url: BASE_URL + 'empresa/delete_local_view/' + id,
            type: 'GET',
//            dataType: "html",
            success: function (data) {
//                console.log(data);
                $('#content_link').html(data);
            }
        });
    });

    function marca(location) {
        $("#emp_lat").val(location.lat());
        $("#emp_lng").val(location.lng());
        //map.setCenter(location);
        marker.setPosition(location);
    }
</script>