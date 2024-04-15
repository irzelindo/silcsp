<?php
function Conectarse() 
{
   $cnxString = "host=localhost port=5432 dbname=labcentral user=postgres password=vado";
   if (!($conn=pg_connect($cnxString, PGSQL_CONNECT_FORCE_NEW) or die ("Error conectando a la base de datos labcentral."))) 
   { 
      echo "Error conectando a la base de datos labcentral."; 
      exit(); 
   } 
   //echo pg_dbname($link);
   if (pg_dbname($conn) != "labcentral") 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   }
   return $conn; 
} 
?>