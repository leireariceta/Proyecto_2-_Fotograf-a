/* DECLARACIÓN VARIABLES */
var numfotos = 12; /* número total de fotos*/
var ordenPrincipal, ordenSiguiente;
var intervalo;
var tiempoEspera = 5000;
/*var numAleatorio*/ 

const flechaIzd = document.getElementById("flechaIzd"); console.log("flechaIzd");
const flechaDer = document.getElementById("flechaDer"); console.log("flechaDer");
const fotoActiva = document.getElementById("fotoActiva"); console.log("fotoActiva");

/* CÓDIGO PARA LA ACCIÓN DE LAS FLECHAS */

/* ESCUCHAMOS CLICK EN LA IMAGEN FLECHA IZQUIERDA */
flechaIzd.addEventListener("click", function(){
    ordenPrincipal = fotoActiva.getAttribute("orden");
    ordenPrincipal = Number(ordenPrincipal);

    if(ordenPrincipal ===1){
        ordenSiguiente = numfotos;
    }else{
        ordenSiguiente = ordenPrincipal-1
    }

    fotoActiva.src=`./assets/img/slider${ordenSiguiente}_2560.jpg`

    fotoActiva.setAttribute("orden", ordenSiguiente)

    crearIntervalo(tiempoEspera+2000);
})

flechaDer.addEventListener("click", function(){
    ordenPrincipal = fotoActiva.getAttribute("orden");
    ordenPrincipal = Number(ordenPrincipal);

    if(ordenPrincipal ===numfotos){
        ordenSiguiente = 1;
    }else{
        ordenSiguiente = ordenPrincipal+1
    }

    fotoActiva.src=`./assets/img/slider${ordenSiguiente}_2560.jpg`

    fotoActiva.setAttribute("orden", ordenSiguiente)

    crearIntervalo(tiempoEspera+2000);
})

/*ZONA DE EJECUCIÓN DE FOTO RANDOM*/
/*IMAGEN RANDOM CADA VEZ QUE CARGA LA PÁGINA WEB*/


/*ZONA DE FUNCIONES*/
function funcion_random(){
    let numAleatorio;
    numAleatorio = Number(numAleatorio);
    numAleatorio = Math.random()*numfotos;
    numAleatorio = Math.ceil(numAleatorio);
    fotoActiva.src=`./assets/img/slider${numAleatorio}_2560.jpg`
    fotoActiva.setAttribute("orden", numAleatorio)
    console.log(numAleatorio)
}

funcion_random()

/*CAMBIO AUTOMÁTICO DE IMÁGENES CADA X SEGUNDOS*/

crearIntervalo(tiempoEspera);

function crearIntervalo(valorRecibido){
    if(intervalo != undefined){
        clearInterval(intervalo)
    }
    intervalo = window.setInterval(funcion_random,valorRecibido)
}


