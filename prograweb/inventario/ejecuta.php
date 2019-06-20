<?php
session_start();
$cuenta =    $_POST['cuenta'];
$instancia = $_POST['instancia'];
$comando = $_POST['comando'];


if($comando=="apagar"){
     $cmd = 'sudo /usr/bin/aws ec2 stop-instances --instance-ids '.$instancia.' --profile '.$cuenta;

   // $cmd = "aws --version";

   // try {
   // $exec = exec($cmd,$output, $return);
   // $exec2 = shell_exec($cmd);
   // echo $exec2;
//}
//	catch(Exception $e)
//{
  //  echo 'Message: ' .$e->getMessage();
//}
    
    $salida = shell_exec($cmd);    
   // $salida = shell_exec('aws ec2 stop-instances --instance-ids '.$instancia.' --profile '.$cuenta.' 2>&1');  
    //$salida = 'aws ec2 stop-instances --instance-ids '.$instancia.' --profile '.$cuenta;
    
  if ($salida==NULL) {
      echo"error al ejecutar comando";
    }  else {
        echo 'Se ha ejecutado correctamente el comando de '.$comando.' en la istancia '.$instancia;    
    }
   
}

if($comando=="encender"){    
    //echo 'Se ha ejecutado en comando de '.$comando.' en la istancia '.$instancia;

   $salida = shell_exec('sudo /usr/bin/aws ec2 start-instances --instance-ids '.$instancia.' --profile '.$cuenta);
    //$salida = 'aws ec2 stop-instances --instance-ids '.$instancia.' --profile '.$cuenta;

    if ($salida==NULL) {
        echo"error al ejecutar comando";
    }  else {
        echo 'Se ha ejecutado correctamente el comando de '.$comando.' en la istancia '.$instancia;
   }   
//echo 'Se ha ejecutado en comando de en la istancia '.$instancia;    
}

