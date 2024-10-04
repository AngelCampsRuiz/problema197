<!DOCTYPE html>
<html lang="es"> 
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Descifrar Mensaje - Agente 0069</title>
    <link rel="stylesheet" href="./estilos.css"> <!-- Enlace al archivo CSS para aplicar estilos -->
</head>
<body>

<h1>Descifrar Mensaje Secreto</h1> 
<form action="index.php" method="post"> <!-- Formulario que se enviará a 'index.php' utilizando el método POST -->
    <label for="mensaje">Introduce el mensaje cifrado:</label><br>
    <textarea name="mensaje" id="mensaje" rows="4" cols="50" required></textarea><br><br> <!-- Área de texto donde se introduce el mensaje cifrado -->
    
    <!-- Botones de envío del formulario -->
    <input type="submit" name="submit_x2aX" value="X2 a X"> 
    <input type="submit" name="submit_x2aX1" value="X2 a X1">
    <input type="submit" name="submit_x1aX" value="X1 a X"> 
</form>

<?php
// Función que verifica si un carácter es vocal
function esVocal($c) {
    // Convierte el carácter a minúsculas y verifica si está en el array de vocales
    return in_array(strtolower($c), ['a', 'e', 'i', 'o', 'u']);
}

// Función que invierte todo lo que no sea una vocal en la cadena
function invertirNoVocales($texto) {
    $resultado = ''; // Inicializa una cadena vacía para el resultado
    $i = 0; // Inicializa el índice de recorrido
    $n = strlen($texto); // Longitud del texto
    
    while ($i < $n) { // Mientras no se haya recorrido todo el texto
        if (!esVocal($texto[$i])) { // Si el carácter actual no es una vocal
            $j = $i; // Inicializa un nuevo índice para encontrar la secuencia de no vocales
            
            while ($j < $n && !esVocal($texto[$j])) { // Mientras se encuentren caracteres que no son vocales
                $j++; 
            }
            // Invertimos la secuencia de no vocales y la agregamos al resultado
            $resultado .= strrev(substr($texto, $i, $j - $i));
            $i = $j; // Actualiza i al final de la secuencia de no vocales
        } else {
            // Si es vocal, lo agregamos directamente
            $resultado .= $texto[$i]; 
            $i++; 
        }
    }
    
    return $resultado; // Devuelve la cadena con las no vocales invertidas
}

// Función que descifra el mensaje (X'' a X)
function descifrar($mensaje) {
    $n = strlen($mensaje); // Longitud del mensaje cifrado
    $x_prim = array_fill(0, $n, '');  // Creamos un array vacío de longitud $n
    $izquierda = 0; // Índice para la parte izquierda del array
    $derecha = $n - 1; // Índice para la parte derecha del array
    
    // Construimos X' a partir de X''
    for ($i = 0; $i < $n; $i++) { // Iteramos a través de cada carácter del mensaje
        if ($i % 2 == 0) { 
            $x_prim[$izquierda] = $mensaje[$i]; // Asigna el carácter a la posición izquierda
            $izquierda++; 
        } else { 
            $x_prim[$derecha] = $mensaje[$i]; // Asigna el carácter a la posición derecha
            $derecha--; // Retrocede el índice derecho
        }
    }
    
    // Convertimos el arreglo X' a una cadena
    $x_prim_str = implode('', $x_prim); // Une los elementos del array en una cadena
    
    // Invertimos las secuencias de no vocales en X' para obtener el mensaje original
    return invertirNoVocales($x_prim_str); // Devuelve el mensaje descifrado
}

// Si se envía el formulario para X2 a X
if (isset($_POST['mensaje']) && isset($_POST['submit_x2aX'])) {
    $mensaje = trim($_POST['mensaje']); // Elimina espacios en blanco al principio y al final
    $mensaje_descifrado = descifrar($mensaje); // Descifra el mensaje utilizando la función

    // Resultado
    echo "<div class='resultado'>"; 
    echo "<p><strong>Mensaje cifrado:</strong> $mensaje</p>"; // Muestra el mensaje cifrado
    echo "<p><strong>Mensaje descifrado:</strong> $mensaje_descifrado</p>"; // Muestra el mensaje descifrado
    echo "</div>";
}

// Función que reconstruye X' a partir de X''
function obtener_X1($mensaje) {
    $n = strlen($mensaje); // Longitud del mensaje
    $x_prim = array_fill(0, $n, '');  // Creamos un arreglo vacío de longitud $n
    $izquierda = 0; // Índice para la parte izquierda del array
    $derecha = $n - 1; // Índice para la parte derecha del array

    // Construimos X' a partir de X''
    for ($i = 0; $i < $n; $i++) { // Iteramos a través de cada carácter del mensaje
        if ($i % 2 == 0) { 
            $x_prim[$izquierda] = $mensaje[$i]; // Asigna el carácter a la posición izquierda
            $izquierda++; 
        } else { 
            $x_prim[$derecha] = $mensaje[$i]; // Asigna el carácter a la posición derecha
            $derecha--; // Retrocede el índice derecho
        }
    }
    
    return implode('', $x_prim);  // Convertimos el arreglo a una cadena y la devolvemos
}

// Si se envía el formulario para X2 a X1
if (isset($_POST['mensaje']) && isset($_POST['submit_x2aX1'])) {
    $mensaje = trim($_POST['mensaje']); // Elimina espacios en blanco al principio y al final
    $mensaje_x1 = obtener_X1($mensaje); // Obtiene X1 utilizando la función

    // Resultado
    echo "<div class='resultado'>"; 
    echo "<p><strong>Mensaje cifrado:</strong> $mensaje</p>"; // Muestra el mensaje cifrado
    echo "<p><strong>Mensaje descifrado:</strong> $mensaje_x1</p>"; // Muestra el mensaje descifrado
    echo "</div>";
}

// Función que descifra el mensaje (X' a X)
function descifrar_X1_a_X($mensaje) {
    return invertirNoVocales($mensaje); // Invierte las no vocales del mensaje para descifrarlo
}

// Si se envía el formulario para X1 a X
if (isset($_POST['mensaje']) && isset($_POST['submit_x1aX'])) {
    $mensaje = trim($_POST['mensaje']); // Elimina espacios en blanco al principio y al final
    $mensaje_descifrado = descifrar_X1_a_X($mensaje); // Descifra el mensaje utilizando la función

    // Resultado
    echo "<div class='resultado'>"; 
    echo "<p><strong>Mensaje cifrado:</strong> $mensaje</p>"; // Muestra el mensaje cifrado
    echo "<p><strong>Mensaje descifrado:</strong> $mensaje_descifrado</p>"; // Muestra el mensaje descifrado
    echo "</div>";
}
?>

</body>
</html>
