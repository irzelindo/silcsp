<?php
function Conectarsesaa() 
{
   $cnxString = "host=localhost port=5432 dbname=saa user=postgres password=vado";
   if (!($conn=pg_connect($cnxString, PGSQL_CONNECT_FORCE_NEW) or die ("Error conectando a la base de datos."))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   //echo pg_dbname($link);
   if (pg_dbname($conn) != "saa") 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   }
   return $conn; 
} 
?>