class Candidato{
    constructor(nombre,votos){
        this.nombre = nombre;
        this.votos = votos;
    }
}

let datos = [];
let arrayCandidatos = [];

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

        //crear select
        for(var i = 0; i < datos.length;i++){
            document.getElementById("selectAlumnos").options[i] = new Option(datos[i]);
        }

        //llamar botón
        var btn = document.getElementById("btnEnviar");
        btn.setAttribute("value","enviar");
        btn.onclick = function(){
            obtenerCandidatos();
        }

    }   
}


//al cargar la ventana se llamará a la función comenzar()
window.addEventListener("load",comenzar,false);

function obtenerCandidatos(){
   //llenar array de candidatos
    for(var i = 0; i < datos.length;i++){
        if(document.getElementById("selectAlumnos").options[i].selected){
            var candidato = new Candidato(datos[i],0);
            arrayCandidatos.push(candidato);
        }
    }

    //crear select
    for(var i = 0; i < arrayCandidatos.length;i++){
        document.getElementById("votosCandidatos").options[i] = new Option(arrayCandidatos[i].nombre);
    }

    //llamar botón
    var btn = document.getElementById("btnDelegado");
    btn.setAttribute("value","Resultados");
    btn.onclick = function(){
        obtenerDelegado();
    }
    var div = document.getElementById("votacion");

    for(var num = 0; num < datos.length; num++){

        let parrafo = document.createElement("p");
        parrafo.id = "personaVotar" + num;
        parrafo.textContent = "Elige tu voto: " + datos[num];

        div.appendChild(parrafo);

        let btnEnviar = document.createElement("input");
        btnEnviar.setAttribute("type","button");
        btnEnviar.id = "btnVotar" + num;
        btnEnviar.setAttribute("value","enviarVoto");
        btnEnviar.setAttribute("onclick", ""); 
        btnEnviar.onclick = function(){
            obtenerVotos();
            ocultar(btnEnviar.id,parrafo.id);
        }

        div.appendChild(btnEnviar);
    } 
}

function obtenerVotos(){
    for(var i = 0; i < arrayCandidatos.length;i++){
        var sel = document.getElementById("votosCandidatos");
        var text= sel.options[sel.selectedIndex].text;

        if(arrayCandidatos[i].nombre == text){
            arrayCandidatos[i].votos = arrayCandidatos[i].votos + 1;
        }
    } 
}

function obtenerDelegado(){

    mayor = arrayCandidatos[0].votos;
    persona = arrayCandidatos[0].nombre;

    let parrafoWin = document.getElementById("parrafoGanador");

    for(var i = 0; i < arrayCandidatos.length;i++){
        let parrafo = document.getElementById("parrafoResultado");
        parrafo.setAttribute('style', 'white-space: pre;');
        parrafo.textContent += `${arrayCandidatos[i].nombre} tiene: ${arrayCandidatos[i].votos} votos \r\n`;
        
        if(arrayCandidatos[i].votos > mayor){
            mayor = arrayCandidatos[i].votos;
            persona = arrayCandidatos[i].nombre;
        }  
    }

    parrafoWin.textContent = `${persona} es la persona elegida con: ${mayor} votos`;
    parrafoWin.style.color = "#00008B";
    parrafoWin.style.fontWeight = "bold";

    document.getElementById("btnDelegado").style.visibility = "hidden";
}

function ocultar(idBtn,idPar){ 
    var div = document.getElementById("votacion")
    var btn = document.getElementById(idBtn);
    var par = document.getElementById(idPar);

    document.getElementById("btnDelegado").style.visibility = "visible";

    var basura = div.removeChild(btn);
    basura = div.removeChild(par);
}