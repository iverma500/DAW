let datos = [];
let arrayCandidatos = [];
let arrayVotos = [];
let int = 0
function comenzar(){
    //identificar el botón input file
    var archivos = document.getElementById("archivos");
    //al pulsar o cambiar de estado se llamará a la función procesar()
    archivos.addEventListener("change",procesar,false);
}

function procesar(e){
    //e es el botón y tiene la propiedad files que es un array de los archivos seleccionados
    var archivos = e.target.files;
    //cogemos el primer archivo del array
    var miArchivo = archivos[0];
    //lector permite leer la información del objeto devuelto 
    var lector = new FileReader();

    //leemos el fichero como texto con codificación utf-8
    lector.readAsText(miArchivo, "utf-8");
    //al cargar el lector se llama a la función mostrarWeb()
    lector.onload = function(e){
       
        //e es el lector y se le da lo que haya leido del fichero
        var resultado = e.target.result;

        datos = resultado.split('\n');
        datos.length = datos.length -1;

        var div = document.getElementById("contenedor");

        let btnEnviar = document.createElement("INPUT");
            btnEnviar.setAttribute("type","button");
            btnEnviar.setAttribute("id","enviar");
            btnEnviar.setAttribute("value","enviar");
            btnEnviar.setAttribute("onclick", ""); 
            btnEnviar.onclick = function(){
                obtenerCandidatos();
            }

        for(var i = 0; i < datos.length;i++){
        
            let label = document.createElement("LABEL");
            label.textContent = datos[i];
            label.setAttribute("id","label");

            let checkBox = document.createElement("INPUT");
            checkBox.setAttribute("type","checkbox");
            checkBox.setAttribute("id",i);
            checkBox.setAttribute("name",i);
            checkBox.setAttribute("value",datos[i]);    
            soloTresCheckBox();

            let br = document.createElement("br");

            label.appendChild(checkBox);    

            div.appendChild(label);
            div.appendChild(br);
            
        }    
        div.appendChild(btnEnviar); 

        //visualizar linea por linea en consola 
        for(var linea of datos) {
            console.log('[alumnos]', linea);
        }
    };   //addEventListener("load",mostrarEnWeb, false);
}


//al cargar la ventana se llamará a la función comenzar()
window.addEventListener("load",comenzar,false);

function obtenerCandidatos(){
   
    for(var i = 0; i < datos.length;i++){
        
        if(document.getElementById(i).checked){
            arrayCandidatos.push(datos[i]);
        }
    }
    //ocultar todo del div
    document.getElementById("contenedor").innerHTML = "";
    document.getElementById("contenedor").style.visibility = "hidden";
    console.log(arrayCandidatos);

    contenedorVotos = document.getElementById("contenedorVotos");
    for(var j = 0; j < arrayCandidatos.length;j++){
        arrayVotos.push(0);
    }
    console.log(arrayVotos);

    let select = document.createElement("SELECT");   
    select.id = "votosCandidatos";
    select.setAttribute("name","select");
    select.setAttribute("widht","70px");
    select.style.fontSize = "20px";

    for(var j = 0; j < arrayCandidatos.length;j++){
        let option = document.createElement("option");
        option.value = arrayCandidatos[j];
        option.text = arrayCandidatos[j];
        select.appendChild(option);
    }
    contenedorVotos.appendChild(select);

    let btnDelegado = document.createElement("INPUT");
    btnDelegado.setAttribute("type","button");
    btnDelegado.setAttribute("id","btnDelegado");
    btnDelegado.setAttribute("value","Resultados");
    btnDelegado.setAttribute("onclick", ""); 
    btnDelegado.onclick = function(){
        obtenerDelegado();
        ocultarBtn(btnDelegado.id,select.id);
    }

    contenedorVotos.appendChild( document.createTextNode( '\u00A0' ) );

    contenedorVotos.appendChild(btnDelegado); 

    document.getElementById("btnDelegado").style.visibility = "hidden";

    for(var num = 0; num < datos.length; num++){
        let br = document.createElement("br");
        br.id = "br";

        let parrafo = document.createElement("p");
        parrafo.id = "parrafo"+num;
        parrafo.textContent = "Elige tu voto: " + datos[num];

        contenedorVotos.appendChild(br);
        contenedorVotos.appendChild(parrafo);
        
        let btnEnviar = document.createElement("INPUT");
        btnEnviar.setAttribute("type","button");
        btnEnviar.setAttribute("id","btn"+num);
        btnEnviar.setAttribute("value","enviarVoto");
        btnEnviar.setAttribute("onclick", ""); 
        btnEnviar.onclick = function(){
            obtenerVotos();
            ocultar(btnEnviar.id,parrafo.id);
        }
    
        contenedorVotos.appendChild(btnEnviar); 
    }     
}

function obtenerVotos(){
    for(var i = 0; i < arrayCandidatos.length;i++){
        var sel = document.getElementById("votosCandidatos");
        var text= sel.options[sel.selectedIndex].text;

        if(arrayCandidatos[i] == text){
            arrayVotos[i] = arrayVotos[i] + 1;
        }
    } 
    console.log(text);
    console.log(arrayVotos);
}

function ocultar(idBtn,idPar){ 
    var div = document.getElementById("contenedorVotos")
    var btn = document.getElementById(idBtn);//.style.visibility = "hidden";
    var par = document.getElementById(idPar);//.style.visibility = "hidden";
    var br = document.getElementById("br");
    document.getElementById("btnDelegado").style.visibility = "visible";

    var basura = div.removeChild(btn);
    basura = div.removeChild(par);
    basura = div.removeChild(br);

}

function ocultarBtn(idBtn, idSelect){ 
    var div = document.getElementById("contenedorVotos")
    var btn = document.getElementById(idBtn);//.style.visibility = "hidden";
    var select = document.getElementById(idSelect);

    var basura = div.removeChild(btn);
    basura = div.removeChild(select);
}

function obtenerDelegado(){
    contenedorVotos = document.getElementById("contenedorVotos");

    cabezera = document.getElementById("h1");
    cabezera.textContent = "RESULTADOS";
    
    mayor = arrayVotos[0];
    persona = arrayCandidatos[0];

    let parrafoWin = document.createElement("p");
    parrafoWin.id = "parrafoGanador";

    for(var i = 0; i < arrayCandidatos.length;i++){
        let parrafo = document.createElement("p");
        parrafo.id = "parrafoResultado";
        parrafo.textContent = `${arrayCandidatos[i]} tiene: ${arrayVotos[i]} votos`;
        contenedorVotos.appendChild(parrafo);

        if(arrayVotos[i] > mayor){
            mayor = arrayVotos[i];
            persona = arrayCandidatos[i];
        }  
    }

    parrafoWin.textContent = `${persona} es la persona elegida con: ${mayor} votos`;
    parrafoWin.style.color = "#00008B";
    parrafoWin.style.fontWeight = "bold";
    contenedorVotos.appendChild(parrafoWin);
}

function soloTresCheckBox() {
	var checkboxgroup = document.getElementById('contenedor').getElementsByTagName("input");
	var limit = 3;
	for (var i = 0; i < checkboxgroup.length; i++) {
		checkboxgroup[i].onclick = function() {
			var checkedcount = 0;
				for (var i = 0; i < checkboxgroup.length; i++) {
				checkedcount += (checkboxgroup[i].checked) ? 1 : 0;
			}
			if (checkedcount > limit) {
				alert("Solo puedes seleccionar un máximo de " + limit + " candidatos.");
				this.checked = false;
			}
		}
	}
}
