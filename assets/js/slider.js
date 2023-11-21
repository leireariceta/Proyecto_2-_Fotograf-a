/* DECLARACIÓN VARIABLES */
var numfotos = 12; /* número total de fotos*/
var ordenPrincipal, ordenSiguiente;
var intervalo, temporizador;
var tiempoEspera = 5000;

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
})