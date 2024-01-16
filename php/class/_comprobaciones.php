<?php

// Clase para instanciar en todos los archivos php que queramos mediante un objeto tipo esta clase, pudiendo usar a través de ese objeto todos los métodos (funciones) que tiene esta clase

class clase_comprobaciones{

    public function comprobarVacio($var){

        //FORMA HABITUAL DE HACER UN IF ELSE
        if(empty($var)){
            return true;
        }else{
            return false;
        }

        // FORMA MODERNA DE HACER UN IF ELSE CON RETURN TRUE O FALSE
        return empty($var) ? true : false;
    }

    

    //FILTRAR DATOS SCRIPTS
    //DEVOLVEMOS EL VALOR YA FILTRADO
    public function filtrarValor($var) {
        $var = addslashes($var); //agregamos las contrabarras donde haya comillas
        //$var = stripslashes($var); //quitar contrabarras
        $var = strtolower($var); 
        $var = str_replace(array("*", "php", "<", ">", "</>", "script", "drop", "delete", "insert", "select","update", "where", "<?", "?>", "<?="), "", $var);//sustituir palabras o símbolos peligrosos
        $var = htmlspecialchars($var); //evitamos etiquetas html
        $var = trim($var); //quita el espacio en blanco del principio y final de la cadena (si lo hay)
        return $var;
    }
    //FILTRAR DATOS SCRIPTS LIGHT
    //DEVOLVEMOS EL VALOR YA FILTRADO
    public function filtrarValorLight($var) {       
        $var = str_replace(array("php", "script", "drop", "delete", "insert", "select","update", "where", "<?="), "", $var);//sustituir palabras o símbolos peligrosos
        $var = trim($var); //quita el espacio en blanco del principio y final de la cadena (si lo hay)
        return $var;
    }

    //FUNCIÓN PARA VALIDAR UN CORREO CON EXPRESIONES REGULARES
    //DEVUELVE TRUE SI ES CORRECTA LA SINTÁXIS DEL CORREO
    public function validar_email($email) {
        $regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
        /* echo preg_match($regex, $email) ? "El email es válido":"El email no es válido"; */
        return preg_match($regex, $email);
    }

    // FUNCIÓN PARA COMPROBAR SI ES UN NÚMERO
    //DEVUELVE TRUE SI ES NÚMERO
    public function validar_numero($var){
        return is_numeric($var) ? true : false;
    }


}


?>