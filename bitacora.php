<?php 
function archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal) 
{

$conx=Conectarse();
$hora1="0".$hora;
$hora=substr($hora1, -8);
$accion=addslashes($accion);

$result=pg_query($conx,"insert into bitacora( codusu, codopc, fecha, hora, accion, nroip) values ('$codusu', '$codopc', '$fecha', '$hora', '$accion', '$terminal')"); 

pg_close($conx); 

return $result; 
} 
?>