<?php
function Conectarsepol() 
{
   $cnxString = "host=localhost port=5432 dbname=policia user=postgres password=vado";
   if (!($conn=pg_connect($cnxString, PGSQL_CONNECT_FORCE_NEW) or die ("Error conectando a la base de datos policia."))) 
   { 
      echo "Error conectando a la base de datos policia."; 
      exit(); 
   } 
   //echo pg_dbname($link);
   if (pg_dbname($conn) != "policia") 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   }
   return $conn; 
} 
?>