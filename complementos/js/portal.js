var mapa;
var lastOpen = null;
function inicializar() {
    navigator.geolocation.getCurrentPosition( lecturaGPS , errorGPS , {enableHighAccuracy:true} );
    var latlng = new google.maps.LatLng(-3.989509, -79.204280);
    var myOptions = {
        zoom: 13,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    mapa = new google.maps.Map(document.getElementById("mapa_content"),myOptions);
    marcador = new google.maps.Marker( {
        position: latlng,
        map:mapa,
        title: 'Tu ubicación',
        icon: '<?php echo base_url(); ?>/complementos/img/chart.png'
    });
    $.ajax({
        url: 'portal/getLocalesCercanos/',
        dataType: 'json',
        success: function(locales, textStatus) {
            $.each(locales, function(id, local) {
                addMarca(local);
            });
        }
    });
}

function lecturaGPS(ubicacion){
    var miubicacion = new google.maps.LatLng(ubicacion.coords.latitude, ubicacion.coords.longitude);
    mapa.setCenter(miubicacion);
    marcador.setPosition(miubicacion);                      
}
function errorGPS(){
    alerta("No se puede localizar :(");
}
function addMarca(dataLocal) {
    var latlng = new google.maps.LatLng(dataLocal.latitud, dataLocal.longitud);
    var marca = new google.maps.Marker({
        position: latlng,
        map: mapa,
        title: dataLocal.nombre
    });
    addInfoWindow(marca, dataLocal);
    if(dataLocal.latitud!=""){
        Lista(dataLocal);
    }
}
function addInfoWindow(marca, dataLocal) {
    var html = getHtmlData(dataLocal);
    var infoWindow = new google.maps.InfoWindow({
        content: html,
        maxWidth: 500,
        maxHeight: 250
    });
    google.maps.event.addListener(marca, 'click', function() {
        if (lastOpen !== null) {
            lastOpen.close();
        }
        infoWindow.open(mapa, marca);
        lastOpen = infoWindow;
    });
}
function getHtmlData(dataLocal) {
    var html = "";
    html += "<h4>" + dataLocal.nombre + "</h4>"+"<br/>";
    html += "<b>Direcci&oacute;n:</b>&nbsp" + dataLocal.direccion + "<br/>";
    html += "<b>Hora inicio:</b>&nbsp" +dataLocal.hora_apertura + "<br/>";
    html += "<b>Hora cierre:</b>&nbsp" +dataLocal.hora_cierre + "<br/>";
    html += "<hr/>";
    return html;
}
function Lista(dataLocal){
    var option = document.createElement("option");
    option.text = dataLocal.nombre;
    option.value = dataLocal.identificador;
    var select = document.getElementById("mySelect");
    select.appendChild(option);
}
//Jquery del selector de categorias de locales       
$('#local_id').change(function () {
    $('#tipo_local').val($(this).val());
    var local_tipo = $('#local_id').val();
    var url = 'portal/get_locales_by_tipe/' + local_tipo;
    var mapOptions = {
        center: new google.maps.LatLng(-3.996083, -79.205675),
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        zoomControl: true
    };
    mapa = new google.maps.Map(document.getElementById("mapa_content"), mapOptions);
    $('#mySelect').find('option').remove();
    if (local_tipo!=='-1') {
        $.ajax({
            type: "POST",
            url: url, 
            dataType: 'json',
            success: function (locales) {
                $.each(locales, function (id, local) {
                    addMarca(local);
                });
            }
        });
    }else{
        inicializar();
    }
});


//jquery de local seleccionado
function localIndividual(){
    var local_seleccionado = $('#mySelect').val();
    var url = 'portal/getLocalSeleccionado/' + local_seleccionado;
    var mapOptions = {
        center: new google.maps.LatLng(-3.996083, -79.205675),
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        zoomControl: true
    };
    mapa = new google.maps.Map(document.getElementById("mapa_content"), mapOptions);
    $.ajax({
        type: "POST",
        url: url, 
        dataType: 'json',
        success: function (locales) {
            $.each(locales, function (id, local) {
                var latlng = new google.maps.LatLng(local.latitud, local.longitud);
                var marca = new google.maps.Marker({
                    position: latlng,
                    map: mapa,
                    title: local.nombre
                });
                var html = "<h3>" + local.nombre + "</h3>"+"<br/>";
                var html = getHtmlData(local);
                var infoWindow = new google.maps.InfoWindow({
                    content: html,
                    maxWidth: 500,
                    maxHeight: 250
                });
                google.maps.event.addListener(marca, 'click', function() {
                    if (lastOpen !== null) {
                        lastOpen.close();
                    }
                    infoWindow.open(mapa, marca);
                    lastOpen = infoWindow;
                });
            });
        }
    });
}