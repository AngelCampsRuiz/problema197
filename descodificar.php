<?php
function es_vocal($caracter) {
    return in_array($caracter, ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U']);
}

function reconstruir_X_prima($mensaje_codificado) {
    $n = strlen($mensaje_codificado);
    $izq = 0;
    $der = $n - 1;
    $mensaje_x_prima = [];
    
    for ($i = 0; $i < $n; $i++) {
        if ($i % 2 == 0) {
            $mensaje_x_prima[] = $mensaje_codificado[$izq++];
        } else {
            $mensaje_x_prima[] = $mensaje_codificado[$der--];
        }
    }
    return implode('', $mensaje_x_prima);
}

function descifrar_mensaje($mensaje_codificado) {
    // Etapa 1: Reconstruir X' a partir de X"
    $x_prima = reconstruir_X_prima($mensaje_codificado);
    
    // Etapa 2: Reconstruir X a partir de X'
    $mensaje_original = '';
    $n = strlen($x_prima);
    $buffer = '';
    
    for ($i = 0; $i < $n; $i++) {
        if (es_vocal($x_prima[$i]) || !ctype_alpha($x_prima[$i])) {
            // Si es vocal o no es letra, añadimos directamente
            $mensaje_original .= $buffer . $x_prima[$i];
            $buffer = '';  // Limpiar buffer
        } else {
            // Si es consonante, lo guardamos en el buffer
            $buffer = $x_prima[$i] . $buffer;
        }
    }
    // Añadir cualquier resto del buffer al final
    $mensaje_original .= $buffer;
    
    return $mensaje_original;
}

// Leer múltiples líneas de entrada desde stdin
while ($linea = trim(fgets(STDIN))) {
    // Procesar el mensaje cifrado
    $mensaje_descifrado = descifrar_mensaje($linea);
    
    // Imprimir el resultado en el formato deseado
    echo $linea . " => " . $mensaje_descifrado . PHP_EOL;
}
?>
