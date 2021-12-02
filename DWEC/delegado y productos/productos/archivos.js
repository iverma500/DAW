class Productos{
    constructor(nombre, precio) {
      this.nombre= nombre;
      this.precio= precio;
    }
}
//-----------------------------------------------------------------------
let productos = [];
let productosObjetos = [];

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

        productos = resultado.split(/[;\n]/);
        productos.length = productos.length - 1;
        console.log(productos);

        //crear objeto array
        //crear select
        var n = 0;
        for(var i = 0; i < productos.length / 2;i++){
            var producto = new Productos(productos[n],productos[n+1]);
            productosObjetos.push(producto);
            document.getElementById("selectProductos").options[i] = new Option(productosObjetos[i].nombre);

            n+=2;
        }
        
        //llamar botón
        var btn = document.getElementById("btnEnviar");
        btn.setAttribute("value","enviar");
        btn.onclick = function(){
            obtenerResultado();
        }
    }   
}


//al cargar la ventana se llamará a la función comenzar()
window.addEventListener("load",comenzar,false);

function obtenerResultado(){
    //llenar array de candidatos
    console.log(productosObjetos);
    var n = 0;
   
    for(var i = 0; i < productos.length / 2;i++){
        if(document.getElementById("selectProductos").options[i].selected){
            
            let parrafo = document.getElementById("parrafo");
            parrafo.textContent = `El producto: ${productosObjetos[i].nombre}  cuesta: ${productosObjetos[i].precio}`;
        } 
        n+=2;
    }
}