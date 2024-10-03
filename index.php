<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descifrar Mensaje - Agente 0069</title>
</head>
<body>

<h1>Descifrar Mensaje Secreto</h1>
<form action="index.php" method="post">
    <label for="mensaje">Introduce el mensaje cifrado:</label><br>
    <textarea name="mensaje" id="mensaje" rows="4" cols="50" required></textarea><br><br>
    <input type="submit" name="submit_x2aX" value="X2 a X">
    <input type="submit" name="submit_x2aX1" value="X2 a X1">
</form>

<?php
// Si se envía el formulario para X2 a X
if (isset($_POST['mensaje']) && isset($_POST['submit_x2aX'])) {
    $mensaje = trim($_POST['mensaje']);
    
    // Función que verifica si un carácter es vocal
    function esVocal($c) {
        return in_array(strtolower($c), ['a', 'e', 'i', 'o', 'u']);
    }

    // Función que invierte las secuencias de no vocales en la cadena
    function invertirNoVocales($texto) {
        $resultado = '';
        $i = 0;
        $n = strlen($texto);
        
        while ($i < $n) {
            if (!esVocal($texto[$i])) {
                $j = $i;
                // Encontramos la secuencia de no vocales
                while ($j < $n && !esVocal($texto[$j])) {
                    $j++;
                }
                // Invertimos la secuencia de no vocales
                $resultado .= strrev(substr($texto, $i, $j - $i));
                $i = $j;
            } else {
                // Si es vocal, lo agregamos directamente
                $resultado .= $texto[$i];
                $i++;
            }
        }
        
        return $resultado;
    }

    // Función que descifra el mensaje (X'' a X)
    function descifrar($mensaje) {
        $n = strlen($mensaje);
        $x_prim = array_fill(0, $n, '');  // Creamos un arreglo vacío de longitud $n
        $izquierda = 0;
        $derecha = $n - 1;
        
        // Construimos X' a partir de X''
        for ($i = 0; $i < $n; $i++) {
            if ($i % 2 == 0) {
                $x_prim[$izquierda] = $mensaje[$i];
                $izquierda++;
            } else {
                $x_prim[$derecha] = $mensaje[$i];
                $derecha--;
            }
        }
        
        // Convertimos el arreglo X' a una cadena
        $x_prim_str = implode('', $x_prim);
        
        // Invertimos las secuencias de no vocales en X' para obtener el mensaje original
        return invertirNoVocales($x_prim_str);
    }

    // Llamamos a la función de descifrado completa
    $mensaje_descifrado = descifrar($mensaje);

    // Mostramos el resultado
    echo "<p><strong>Mensaje cifrado:</strong> $mensaje</p>";
    echo "<p><strong>Mensaje descifrado:</strong> $mensaje_descifrado</p>";
}

// Si se envía el formulario para X2 a X1
if (isset($_POST['mensaje']) && isset($_POST['submit_x2aX1'])) {
    $mensaje = trim($_POST['mensaje']);

    // Función que reconstruye X' a partir de X''
    function obtener_X1($mensaje) {
        $n = strlen($mensaje);
        $x_prim = array_fill(0, $n, '');  // Creamos un arreglo vacío de longitud $n
        $izquierda = 0;
        $derecha = $n - 1;

        // Construimos X' a partir de X''
        for ($i = 0; $i < $n; $i++) {
            if ($i % 2 == 0) {
                $x_prim[$izquierda] = $mensaje[$i];
                $izquierda++;
            } else {
                $x_prim[$derecha] = $mensaje[$i];
                $derecha--;
            }
        }
        
        return implode('', $x_prim);  // Convertimos el arreglo a una cadena
    }

    // Llamamos a la función para obtener X'
    $mensaje_x1 = obtener_X1($mensaje);

    // Mostramos el resultado
    echo "<p><strong>Mensaje cifrado:</strong> $mensaje</p>";
    echo "<p><strong>Mensaje X1 (X' obtenido):</strong> $mensaje_x1</p>";
}
?>

</body>
</html>
