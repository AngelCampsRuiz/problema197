<?php
// Función que verifica si un carácter es una vocal
function es_vocal($caracter) {
    // Verifica si el carácter está en el array de vocales
    return in_array($caracter, ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U']);
}

// Función que reconstruye X' a partir de X''
function reconstruir_X_prima($mensaje_codificado) {
    $n = strlen($mensaje_codificado); // Longitud del mensaje codificado
    $izq = 0; // Índice para la parte izquierda
    $der = $n - 1; // Índice para la parte derecha
    $mensaje_x_prima = []; // Array para almacenar X'

    for ($i = 0; $i < $n; $i++) {
        // Alterna entre agregar desde la izquierda y la derecha
        if ($i % 2 == 0) {
            $mensaje_x_prima[] = $mensaje_codificado[$izq++]; // Agrega desde la izquierda
        } else {
            $mensaje_x_prima[] = $mensaje_codificado[$der--]; // Agrega desde la derecha
        }
    }
    // Convierte el array a una cadena y la devuelve
    return implode('', $mensaje_x_prima);
}

// Función que descifra el mensaje
function descifrar_mensaje($mensaje_codificado) {
    // Etapa 1: Reconstruir X' a partir de X"
    $x_prima = reconstruir_X_prima($mensaje_codificado);
    
    // Etapa 2: Reconstruir X a partir de X'
    $mensaje_original = ''; // Cadena para el mensaje original
    $n = strlen($x_prima); // Longitud de X'
    $buffer = ''; // Buffer para almacenar consonantes

    for ($i = 0; $i < $n; $i++) {
        // Si es vocal o no es letra, añadir directamente al mensaje original
        if (es_vocal($x_prima[$i]) || !ctype_alpha($x_prima[$i])) {
            $mensaje_original .= $buffer . $x_prima[$i]; // Agrega el contenido del buffer y la vocal
            $buffer = '';  // Limpia el buffer para la siguiente iteración
        } else {
            // Si es consonante, lo guardamos en el buffer
            $buffer = $x_prima[$i] . $buffer; // Agrega consonante al inicio del buffer
        }
    }
    // Añadir cualquier resto del buffer al final del mensaje original
    $mensaje_original .= $buffer;
    
    return $mensaje_original; // Devuelve el mensaje original descifrado
}

// Leer múltiples líneas de entrada desde stdin
while ($linea = trim(fgets(STDIN))) {
    // Procesar el mensaje cifrado
    $mensaje_descifrado = descifrar_mensaje($linea);
    
    echo $linea . " => " . $mensaje_descifrado . PHP_EOL; // Muestra el mensaje cifrado y su correspondiente descifrado
}
?>
