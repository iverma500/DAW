function comenzar(){
    //identificar la sección de datos
    zonaDatos = document.getElementById("zonaDatos");
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
    lector.addEventListener("load",mostrarEnWeb, false);

}

function mostrarEnWeb(e){
    //e es el lector y se le da lo que haya leido del fichero
    var resultado = e.target.result;
    
    var datos = new Array();
    datos = resultado.split('\n');
    //visualizar array completo en la página
    //en la sección datos incluya todo en código HTML
    zonaDatos.innerHTML = datos;    
    //visualizar linea por linea en consola 
    for(var linea of datos) {
        console.log('[linea]', linea)
    }
}
//al cargar la ventana se llamará a la función comenzar()
window.addEventListener("load",comenzar,false);