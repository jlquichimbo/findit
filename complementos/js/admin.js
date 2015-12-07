
function crearBoton(estados){
	var boton="";
	for (var i = 0; i < estados.length; i++) {
		if (estados[i]==1) {
			boton="<div class='onoffswitch'><input type='checkbox' name='onoffswitch"+i+"' class='onoffswitch-checkbox' id='myonoffswitch"+i+"' checked><label class='onoffswitch-label' for='myonoffswitch"+i+"'><span class='onoffswitch-inner'></span><span class='onoffswitch-switch'></span></label></div>";
		}else{
			boton="<div class='onoffswitch'><input type='checkbox' name='onoffswitch"+i+"' class='onoffswitch-checkbox' id='myonoffswitch"+i+"'><label class='onoffswitch-label' for='myonoffswitch"+i+"'><span class='onoffswitch-inner'></span><span class='onoffswitch-switch'></span></label></div>";
		}
		
		document.getElementById("btn"+i).innerHTML = boton;
	}
}
