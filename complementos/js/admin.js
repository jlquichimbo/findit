
function crearBoton(identificador){
	var boton="";
	//botones = [boton];
	for (var i = 0; i < identificador; i++) {
		boton="<div class='onoffswitch'><input type='checkbox' name='onoffswitch"+i+"' class='onoffswitch-checkbox' id='myonoffswitch"+i+"'><label class='onoffswitch-label' for='myonoffswitch"+i+"'><span class='onoffswitch-inner'></span><span class='onoffswitch-switch'></span></label></div>";
		document.getElementById("btn"+i).innerHTML = boton;
	}
}
