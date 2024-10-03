<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descifrar Mensaje - Agente 0069</title>
    <link rel="stylesheet" href="estilos.css">
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

    function esVocal($c) {
        return in_array(strtolower($c), ['a', 'e', 'i', 'o', 'u']);
    }

    function invertirNoVocales($texto) {
        $resultado = '';
        $i = 0;
        $n = strlen($texto);
        
        while ($i < $n) {
            if (!esVocal($texto[$i])) {
                $j = $i;
                while ($j < $n && !esVocal($texto[$j])) {
                    $j++;
                }
                $resultado .= strrev(substr($texto, $i, $j - $i));
                $i = $j;
            } else {
                $resultado .= $texto[$i];
                $i++;
            }
        }
        
        return $resultado;
    }

    function descifrar($mensaje) {
        $n = strlen($mensaje);
        $x_prim = array_fill(0, $n, '');
        $izquierda = 0;
        $derecha = $n - 1;
        
        for ($i = 0; $i < $n; $i++) {
            if ($i % 2 == 0) {
                $x_prim[$izquierda] = $mensaje[$i];
                $izquierda++;
            } else {
                $x_prim[$derecha] = $mensaje[$i];
                $derecha--;
            }
        }
        
        $x_prim_str = implode('', $x_prim);
        return invertirNoVocales($x_prim_str);
    }

    $mensaje_descifrado = descifrar($mensaje);

    echo "<div class='resultado'>";
    echo "<p><strong>Mensaje cifrado:</strong> $mensaje</p>";
    echo "<p><strong>Mensaje descifrado:</strong> $mensaje_descifrado</p>";
    echo "</div>";
}

// Si se envía el formulario para X2 a X1
if (isset($_POST['mensaje']) && isset($_POST['submit_x2aX1'])) {
    $mensaje = trim($_POST['mensaje']);

    function obtener_X1($mensaje) {
        $n = strlen($mensaje);
        $x_prim = array_fill(0, $n, '');
        $izquierda = 0;
        $derecha = $n - 1;

        for ($i = 0; $i < $n; $i++) {
            if ($i % 2 == 0) {
                $x_prim[$izquierda] = $mensaje[$i];
                $izquierda++;
            } else {
                $x_prim[$derecha] = $mensaje[$i];
                $derecha--;
            }
        }
        
        return implode('', $x_prim);
    }

    $mensaje_x1 = obtener_X1($mensaje);

    echo "<div class='resultado'>";
    echo "<p><strong>Mensaje cifrado:</strong> $mensaje</p>";
    echo "<p><strong>Mensaje X1 (X' obtenido):</strong> $mensaje_x1</p>";
    echo "</div>";
}


?>

</body>
</html>

