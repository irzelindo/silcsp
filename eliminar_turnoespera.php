<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['funcionariocodigo'];

   include("conexion.php");
   $con=Conectarse();
   
   $id=$_GET['id']; 
   $fecha=date("Y-n-j", time());
   
//   $sql="UPDATE ordtrabajo set atendido=2 WHERE nordentra = '$id' and fecharec='$fecha'";
   $sql="UPDATE ordtrabajo set atendido=2 WHERE nordentra = '$id' ";
   pg_query($con,$sql); 
   
   $ir="Location: tableroturnos.php";
//echo $id;           
   header($ir); //no se puede borrar
?>
