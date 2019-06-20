<?php

require('conexion.php');
// Crea la conexión
$conn = new mysqli($servername, $username, $password);
#$comando = 'aws ce get-cost-and-usage --time-period Start=2019-02-08,End=2019-02-09 --granularity DAILY --metrics "BlendedCost" "UnblendedCost" "UsageQuantity" --profile LaterceraV2 >archivo.json';
$comando = "aws ce get-cost-and-usage";

#$comando = 'aws ce get-cost-and-usage --time-period Start=2019-02-08,End=2019-02-09 --granularity DAILY --metrics "BlendedCost" "UnblendedCost" "UsageQuantity"';
// Verifica la conexión
if ($conn->connect_error) {
    die("No es posible realizar una conexión con la base de Datos: " . $conn->connect_error);
} else {
    echo "Conectado correctamente\n<br>";
}


$readjson = file_get_contents('./archivo.json');
$data = json_decode($readjson, true);
echo $data;

echo $comando;
$salida = shell_exec($comando);
echo $salida;
#$resultado = exec("ls -ls");
#echo "Salida: $resultado\n"; 
////
// Selecciona los datos ingresados
$sql = "select * from costos.cuenta\n";

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


 $conn->close();