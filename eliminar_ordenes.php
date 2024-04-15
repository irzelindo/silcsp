<?php
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();

   $nordentra	=	$_GET['nordentra'];

   if($nordentra != '')
   {

      pg_query($con, "delete from datoagrupado where nordentra = '$nordentra'");
      pg_query($con, "delete from estrealizar where nordentra = '$nordentra'");
      pg_query($con, "delete from plantrabajo where nordentra = '$nordentra'");
      pg_query($con, "delete from procesoresultado where nordentra = '$nordentra'");
      pg_query($con, "delete from nobligatorias where nordentra = '$nordentra'");
      pg_query($con, "delete from resultadoantibiotico where nordentra = '$nordentra'");
      pg_query($con, "delete from resultadomicroorganismo where nordentra = '$nordentra'");
      pg_query($con, "delete from resultadorepeticion where nordentra = '$nordentra'");
      pg_query($con, "delete from resultadosmicro where nordentra = '$nordentra'");
      pg_query($con, "delete from resultados where nordentra = '$nordentra'");
      pg_query($con, "delete from ordenagrupado where nordentra = '$nordentra'");
      pg_query($con, "delete from ordtrabajo where nordentra = '$nordentra'");
      pg_query($con, "delete from otreventos where nordentra = '$nordentra'");
      pg_query($con, "delete from histocompatibilidad1 where nordentra = '$nordentra'");
      pg_query($con, "delete from histocompatibilidad2 where nordentra = '$nordentra'");
      pg_query($con, "delete from histocompatibilidad3 where nordentra = '$nordentra'");
      pg_query($con, "delete from iraginusitada where nordentra = '$nordentra'");
      pg_query($con, "delete from labdifteria where nordentra = '$nordentra'");
      pg_query($con, "delete from labrubeola where nordentra = '$nordentra'");
      pg_query($con, "delete from bolutismo where nordentra = '$nordentra'");
      pg_query($con, "delete from leishmaniosismucosa where nordentra = '$nordentra'");
      pg_query($con, "delete from leishmaniosisvh where nordentra = '$nordentra'");
      pg_query($con, "delete from malaria where nordentra = '$nordentra'");
      pg_query($con, "delete from meningitis where nordentra = '$nordentra'");
      pg_query($con, "delete from paralisisfla where nordentra = '$nordentra'");
      pg_query($con, "delete from parotiditis where nordentra = '$nordentra'");
      pg_query($con, "delete from psitacosis where nordentra = '$nordentra'");
      pg_query($con, "delete from rubeolacong where nordentra = '$nordentra'");
      pg_query($con, "delete from toscoquetos where nordentra = '$nordentra'");
      pg_query($con, "delete from varicela where nordentra = '$nordentra'");
      pg_query($con, "delete from labvaricela where nordentra = '$nordentra'");
      pg_query($con, "delete from carbunco_antrax where nordentra = '$nordentra'");
      pg_query($con, "delete from chagas where nordentra = '$nordentra'");
      pg_query($con, "delete from colera where nordentra = '$nordentra'");
      pg_query($con, "delete from creut_jakob where nordentra = '$nordentra'");
      pg_query($con, "delete from difteria where nordentra = '$nordentra'");
      pg_query($con, "delete from eta where nordentra = '$nordentra'");
      pg_query($con, "delete from etaantecend where nordentra = '$nordentra'");
      pg_query($con, "delete from etiirag where nordentra = '$nordentra'");
      pg_query($con, "delete from febrilagudo where nordentra = '$nordentra'");
      pg_query($con, "delete from febriles where nordentra = '$nordentra'");
      pg_query($con, "delete from hepatitisae where nordentra = '$nordentra'");
      pg_query($con, "delete from hepatitisbcd where nordentra = '$nordentra'");


  	   // Bitacora
  	  include("bitacora.php");
  	  $codopc = "V_13";
  	  $fecha=date("Y-n-j", time());
  	  $hora=date("G:i:s",time());
  	  $accion="Orden: Elimina-Reg.: Nro. Orden: ".$nordentra;
  	  $terminal = $_SERVER['REMOTE_ADDR'];
  	  $a=archdlog($codusu,$codopc,$fecha,$hora,$accion,$terminal);

  	  // Fin grabacion de registro de auditoria
  	  header("Location: ordenes.php");

   }
   else
   {
      header("Location: ordenes.php?mensage=4"); //no se puede borrar
   }
?>
