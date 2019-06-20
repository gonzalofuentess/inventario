<?php
session_start();
$user = $_POST['user'];
$pass = $_POST['pass'];
require('conexion.php');
// Crea la conexión
$conn = new mysqli($servername, $username, $password);
// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión falló: " . $conn->connect_error);
     exit();
}  //else {
   // echo "Conectado correctamente<br>";
//}
//
// Selecciona los datos ingresados
$sql = "select nombre from inventario.usuarios where nombre='$user' and clave = md5('$pass')";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  //  echo "ok";  
    $_SESSION['usuario']=$user;
    //echo '<script>location.href = "usuario.php"</script>';
    //header("location:usuario.php");
   // echo "EXISTE";
    echo '<script>location.href = "./inventario/copesa.php"</script>';
}else{    
    //header("location:index.html");
    echo '<span>El usuario y/o clave son incorrectas, vuelva a intentarlo.</span>';
}
?>
