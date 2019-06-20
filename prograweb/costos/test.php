<?php

require('conexion.php');
// Crea la conexión
$conn = new mysqli($servername, $username, $password);
// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión falló: " . $conn->connect_error);
} else {
    echo "Conectado correctamente<br>";
}
//
// Selecciona los datos ingresados
$sql = "select nombre from copesa.usuarios where nombre='$usuario' and clave = md5('$clave')";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "ok";

    while ($row = $result->fetch_assoc()) {

        echo $row["id_cuenta"];
        echo $row["nombre"];
        
    }
} else {
    echo "nok";
}
