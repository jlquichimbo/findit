//Boton switch
var idLocales;
function crearBoton(estados){
    var boton="";
    for (var i = 0; i < estados.length; i++) {
        if (estados[i][1]==1) {
            boton="<div id='"+estados[i][0]+"' class='onoffswitch'><input type='checkbox' onclick='establecerHorario("+estados[i][0]+")' name='onoffswitch"+estados[i][0]+"' class='onoffswitch-checkbox' id='myonoffswitch"+estados[i][0]+"' checked><label class='onoffswitch-label' for='myonoffswitch"+estados[i][0]+"'><span class='onoffswitch-inner'></span><span class='onoffswitch-switch'></span></label></div>";
        }else{
            boton="<div id='"+estados[i][0]+"' class='onoffswitch'><input type='checkbox' onclick='establecerHorario("+estados[i][0]+")' name='onoffswitch"+estados[i][0]+"' class='onoffswitch-checkbox' id='myonoffswitch"+estados[i][0]+"'><label class='onoffswitch-label' for='myonoffswitch"+estados[i][0]+"'><span class='onoffswitch-inner'></span><span class='onoffswitch-switch'></span></label></div>";
        }       
        document.getElementById("btn"+estados[i][0]).innerHTML = boton;
    }
    idLocales=estados;
}
//funcion para actualizar el estado de disponibilidad a desactivado y visualiza el formulario de establecer horario
function establecerHorario(id){
    var i = 0, est =0;
    while ( i <idLocales.length) {
        if (idLocales[i][0]==id) {
            est=idLocales[i][1];
            i=idLocales.length;
        }
        i=i+1;
    }
    console.log(id);
//    event.preventDefault();//Para que no redirecciones a otro lado
//    var BASE_URL = "<?php echo base_url(); ?>";

    var url = 'estadolocal/desactivarHorario/' + id;
    if (est==1) {
        est=0;
        

        //variable que almacena el id de la empresa
        $.ajax({
            url: 'desactivarHorario/'+id+'/'+est,
            type: 'POST',
//            dataType: "html",
            success: function (data) {
//                console.log(data);
                alert(data);
            }
        });







        //url=url+'/'+est;    
        //$.ajax({
          //  type: "POST",
            //url: url,

            //success: function (locales) {
              //  alert(locales);
                /*$.each(locales, function (id, local) {
                    
                    var html = "<h3>" + local.nombre + "</h3>"+"<br/>";
                    alert(html);
                    //var html = getHtmlData(local);                    
                });*/
            //}
        //});
        /*$.ajax({
            type: "POST",
            url: ruta, 
            data: {
                id: id,
                estado: 0,
            },
            success: function (estHorario) {
                alert(estHorario);
            }
        });*/
        //$(idSwitch).remove();
        //Necesito actualizar el estado a cero con el id q obtengo
        //var ruta = 'admin/index/desactivarHorario/' + id; 


        //Se elimina los div de los switch creados anteriormente, se vuelve a crearlos y a cargar la lista de locales
    }else{
        //extraigo los datos de la base de datos segun el id q tengo
        document.getElementById("formContenedor").style.display = "block";
        document.getElementById("contTabla").style.display = "none";
    }
}


//reloj selector de horario
document.getElementById("relojHoraInicio").style.display = "none";
document.getElementById("relojHoraCierre").style.display = "none";
var cReloj=0;
var hor1="";
var min1="";
var hor2="";
var min2="";
var cancel=0;
function iniciarReloj(){
    var fecha = new Date();
    if (cReloj==0) {
        var h = fecha.getHours();
        var m = fecha.getMinutes();
        h=formatear(h);
        m=formatear(m);
        hor1=h;
        min1=m;
        cReloj=1;
        dibujarReloj(h, m);
    }else{
        if (cancel==0) {
            hor1 = fecha.getHours();
            min1 = fecha.getMinutes();
            hor1=formatear(hor1);
            min1=formatear(min1);
        }
        document.getElementById('hora').innerHTML = hor1;
        document.getElementById('minuto').innerHTML = min1;
        document.getElementById('infoHoraInicio').innerHTML = hor1+" : "+min1;
        document.getElementById('horaCierre').disabled=true;
        document.getElementById("relojHoraInicio").style.display = "block";
        /*Obtener la hora que se encuentra en la caja de texto y visualizar el primer reloj*/
    }

}

function formatear(hom){
    var f=hom;
    if (hom<10) {
        f="0"+hom;
    }
    return f;
}

function dibujarReloj(h, m){
    //Primer reloj
    var contenedor="<h4><label id='infoHoraInicio'>"+h+" : "+m+"</label></h4><hr><div class='row filaMando'><div class='col-md-6 colMandoIz'><h4 onclick='cambiarHora(11)'>+</h4></div><div class='col-md-6 colMandoDer'><h4 onclick='cambiarMinuto(11)'>+</h4></div></div>";
    contenedor=contenedor+"<div class='row filaReloj'><div class='col-md-6'><h2 id='hora'>"+h+"</h2></div><div class='col-md-6'><h2 id='minuto'>"+m+"</h2></div></div>";
    contenedor=contenedor+"<div class='row filaMando'><div class='col-md-6 colMandoIz'><h4 onclick='cambiarHora(21)'>-</h4></div><div class='col-md-6 colMandoDer'><h4 onclick='cambiarMinuto(21)'>-</h4></div></div>";
    contenedor=contenedor+"<div class='row filaEvento'><div class='col-md-6 col-Evento'><label class='col-Evento' id='btnAceptar' onclick='setHora(1)'>Seleccionar</label></div><div class='col-md-6 col-Evento'><label class='col-Evento' id='btnCancelar' onclick='cancelar(1)'>Cancelar</label></div></div>";
    document.getElementById("relojHoraInicio").innerHTML = contenedor;  
    document.getElementById("relojHoraInicio").style.display = "block";
    //Segundo reloj
    contenedor="<h4><label id='infoHoraCierre'>00 : 00</label></h4><hr><div class='row filaMando'><div class='col-md-6 colMandoIz'><h4 onclick='cambiarHora(12)'>+</h4></div><div class='col-md-6 colMandoDer'><h4 onclick='cambiarMinuto(12)'>+</h4></div></div>";
    contenedor=contenedor+"<div class='row filaReloj'><div class='col-md-6'><h2 id='rhoraCierre'>00</h2></div><div class='col-md-6'><h2 id='minutoCierre'>00</h2></div></div>";
    contenedor=contenedor+"<div class='row filaMando'><div class='col-md-6 colMandoIz'><h4 onclick='cambiarHora(22)'>-</h4></div><div class='col-md-6 colMandoDer'><h4 onclick='cambiarMinuto(22)'>-</h4></div></div>";
    contenedor=contenedor+"<div class='row filaEvento'><div class='col-md-6 col-Evento'><label class='col-Evento' id='btnAceptarCierre' onclick='setHora(2)'>Seleccionar</label></div><div class='col-md-6 col-Evento'><label class='col-Evento' id='btnCancelarCierre' onclick='cancelar(2)'>Cancelar</label></div></div>";
    document.getElementById("relojHoraCierre").innerHTML = contenedor;
}
function cambiarHora(indicador){
    var numReloj=indicador.toString();
    var indica=numReloj;
    numReloj=numReloj.substring(1,2);
    indica=indica.substring(0,1);
    if (parseInt(numReloj)==1) {
        var h=parseInt($("#hora").text());
    } else{
        var h=parseInt($("#rhoraCierre").text());
    }
    h=getHora(h, indica);
    h=formatear(h);
    if (parseInt(numReloj)==1) {
        document.getElementById('hora').innerHTML = h;
        document.getElementById('infoHoraInicio').innerHTML = h+" : "+$("#minuto").text();
    } else{
        document.getElementById('rhoraCierre').innerHTML = h;
        document.getElementById('infoHoraCierre').innerHTML = h+" : "+$("#minutoCierre").text();
    }
}
function getHora(h, indica){
    if (indica==1) {
        if ((h+1)<24) {
            h=h+1;
        }else{
            h=0;
        }   
    }else{
        if ((h-1)<0) {
            h=23;
        }else{
            h=h-1;
        }
    }
    return h;
}
function cambiarMinuto(indicador){
    var numReloj=indicador.toString();
    var indica=numReloj;
    numReloj=numReloj.substring(1,2);
    indica=indica.substring(0,1);
    if (parseInt(numReloj)==1) {
        var m=parseInt($("#minuto").text());
    } else{
        var m=parseInt($("#minutoCierre").text());
    }
    m=getMinuto(m, indica);
    m=formatear(m);
    if (parseInt(numReloj)==1) {
        document.getElementById('minuto').innerHTML = m;
        document.getElementById('infoHoraInicio').innerHTML = $("#hora").text()+" : "+m;
    } else{
        document.getElementById('minutoCierre').innerHTML = m;
        document.getElementById('infoHoraCierre').innerHTML = $("#rhoraCierre").text()+" : "+m;
    }
}

function getMinuto(m, indica){
    if (indica==1) {
        if ((m+1)<60) {
            m=m+1;
        }else{
            m=0;
        }
    }else{
        if ((m-1)<0) {
            m=59;
        }else{
            m=m-1;
        }
    }
    return m;
}
function setHora(indicador){
    if (indicador==1) {
        document.getElementById('horaInicio').value = $("#hora").text()+" : "+$("#minuto").text();
        document.getElementById("relojHoraInicio").style.display = "none";
        var h=$("#hora").text();
        var m=$("#minuto").text();
        hor1=h;
        min1=m;
        relojHoraCierre (h, m);
        cancel=1;
    } else{
        document.getElementById('horaCierre').value = $("#rhoraCierre").text()+" : "+$("#minutoCierre").text();
        document.getElementById("relojHoraCierre").style.display = "none";
        hor2=$("#rhoraCierre").text();
        min2=$("#minutoCierre").text();
    }
}
function relojHoraCierre(h, m){
    if ((parseInt(m)+1)>59) {
        h= getHora(parseInt(h), 1);
        m= getMinuto(parseInt(m), 1);
        h= formatear(h);
        m= formatear(m);        
    }else{
        m= getMinuto(parseInt(m), 1);
        m= formatear(m);
    }
    document.getElementById('rhoraCierre').innerHTML = h;
    document.getElementById('minutoCierre').innerHTML = m;
    document.getElementById('infoHoraCierre').innerHTML = h+" : "+m;
    document.getElementById('horaCierre').disabled=false;
    document.getElementById("relojHoraCierre").style.display = "block";
}
function cancelar(selecReloj){
    if (selecReloj==1) {
        document.getElementById("relojHoraInicio").style.display = "none";

    } else{
        document.getElementById("relojHoraCierre").style.display = "none";
    }
}
function openReloj2(){
    document.getElementById('rhoraCierre').innerHTML = hor2;
    document.getElementById('minutoCierre').innerHTML = min2;
    document.getElementById('infoHoraCierre').innerHTML = hor2+" : "+min2;
    document.getElementById("relojHoraCierre").style.display = "block";
}