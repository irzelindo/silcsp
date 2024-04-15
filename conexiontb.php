<?php
function Conectarsetb() 
{
   $cnxString = "host=localhost port=5432 dbname=sepnacotu user=postgres password=vado";
   if (!($conn=pg_connect($cnxString, PGSQL_CONNECT_FORCE_NEW) or die ("Error conectando a la base de datos sepnacotu."))) 
   { 
      echo "Error conectando a la base de datos sepnacotu."; 
      exit(); 
   } 
   //echo pg_dbname($link);
   if (pg_dbname($conn) != "sepnacotu") 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   }
   return $conn; 
} 
?>