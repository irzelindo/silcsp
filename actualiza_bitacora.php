<?php
@Header("Content-type: text/html; charset=utf-8");

session_start();
include("conexion.php");
$con=Conectarse();

$codusu=$_SESSION['codusu'];
$codigo_usu=$_POST['codigo_usu'];
$codigo_opc=$_POST['codigo_opc'];

//echo '<br>'.$_POST['fecha1'].' '.$_POST['fecha2'];

$ff1 = " ".$_POST['fecha1'];
$ff1=trim($ff1);

$an1=1*substr($ff1,0,4);
$me1=1*substr($ff1,5,2);
$di1=1*substr($ff1,8,2);

// echo '<br>'.$di1.'/'.$me1.'/'.$an1; 

$ff2 = " ".$_POST['fecha2'];
$ff2=trim($ff2);

$an2=1*substr($ff2,0,4);
$me2=1*substr($ff2,5,2);
$di2=1*substr($ff2,8,2);

//echo '<br>'.$di2.'/'.$me2.'/'.$an2; 


$_SESSION['codigo_usu']=$_POST['codigo_usu'];
$_SESSION['codigo_opc']=$_POST['codigo_opc'];

$_SESSION['fecha1']=$_POST['fecha1'];
$_SESSION['fecha2']=$_POST['fecha2'];


$existef1="NO";
$existef2="NO";
$okk="SI";

if ($di1==0 && $me1==0 && $an1==0 && $di2==0 && $me2==0 && $an2==0 && $codigo_usu==""  && $codigo_opc=="")
    {
    $okk="NO";	
    header("Location: vaciar_bitacora.php?mensage=4");  
    }
else
   {
   if ($di1==0 && $me1==0 && $an1==0)  // SI TODO ESTA EN BLANCO
      {
      $ok1="SI";
  	  $existef1="NO";
      }
   else // esta con algo cargado
      {
  	     if (checkdate($me1,$di1,$an1))
            {
            if ($di1<10)
                {
      	        $di1="0".$di1;
                }
            if ($me1<10)
                {
  	            $me1="0".$me1;
                }
            if ($an1<100)
                {
  	            $an1=2000+$an1;
                }
            if ($an1<1000)
                {
  	            $an1=1990;
                }
	        $ff1=$di1."/".$me1."/".$an1;
	        $ff1x=$an1."-".$me1."-".$di1;
	        $ok1="SI";
	        $existef1="SI";
            } 	
         else
	        {
	        $ff1="";
	        $ok1="NO";
	        $existef1="NO";
            $okk="NO";	
            header("Location: vaciar_bitacora.php?mensage=1");	
	        } 	
         }
      
      
      if ($di2==0 && $me2==0 && $an2==0)  // SI FECHA HASTA ES BLANCO
         {
         $ok2="SI";
         $existef2="NO";
         }
      else // esta con algo cargado
         {
  	     if (checkdate($me2,$di2,$an2))
            {
            if ($di2<10)
                {
      	        $di2="0".$di2;
                }
            if ($me2<10)
                {
  	            $me2="0".$me2;
                }
            if ($an2<100)
                {
  	            $an2=2000+$an2;
                }
            if ($an2<1000)
                {
  	            $an2=1990;
                }
	        $ff2=$di2."/".$me2."/".$an2;
	        $ff2x=$an2."-".$me2."-".$di2;
	        $ok2="SI";
	        $existef2="SI";
            } 	
         else
	        {
	        $ff2="";
	        $ok2="NO";
	        $existef2="NO";
            $okk="NO";	
	        header("Location: vaciar_bitacora.php?mensage=2");	
	        } 	
         }
      }
      
   if ($existef1=="SI" && $existef2=="SI")
      {
      if ($ff2x < $ff1x)
         {
         $okk="NO";	
         header("Location: vaciar_bitacora.php?mensage=5");		
         }
      }

$condicion="";
$xcodigo_usu=trim($codigo_usu);
$xcodigo_opc=trim($codigo_opc);

if ($codigo_usu!="")
   {
   	if ($condicion=="")
   	   {
   	   	$condicion="codusu='$xcodigo_usu'";
   	   }
   	   else
   	   {
   	   	$condicion=$condicion." and codusu='$xcodigo_usu'";
   	   }
   	
   }
if ($codigo_opc!="")
   {
   	if ($condicion=="")
   	   {
   	   	$condicion="codopc='$xcodigo_opc'";
   	   }
   	   else
   	   {
   	   	$condicion=$condicion." and codopc='$xcodigo_opc'";
   	   }
   	
   }
if ($existef1=="SI")
   {
   	if ($condicion=="")
   	   {
   	   	$condicion="fecha>='$ff1x'";
   	   }
   	   else
   	   {
   	   	$condicion=$condicion." and fecha>='$ff1x'";
   	   }
   	
   }

if ($existef2=="SI")
   {
   	if ($condicion=="")
   	   {
   	   	$condicion="fecha<='$ff2x'";
   	   }
   	   else
   	   {
   	   	$condicion=$condicion." and fecha<='$ff2x'";
   	   }
   	
   }


$sql="DELETE FROM bitacora WHERE ".$condicion;
  $pbit="";
  if ($ff1!="")
     {
     $pbit=$pbit." Desde Fecha: ".$ff1;	
     }
  if ($ff2!="")
     {
     $pbit=$pbit." Hasta Fecha: ".$ff2;	
     }
  if ($codigo_usu!="")
     {
     $pbit=$pbit." Usuario: ".$codigo_usu;	
     }   
  if ($codigo_opc!="")
     {
     $pbit=$pbit." Opcion: ".$codigo_opc;	
     }   

if ($condicion!=""  && $okk=="SI")
   {
   $resultado=pg_query($con,$sql); 
   
//   echo '<br>'.$sql;
   
   // Bitacora
   include("bitacora.php");
   $codopcx = "V_53";
   $fechaxx=date("Y-n-j", time());
   $hora=date("G:i:s",time());
   $accion="Vaciar Bitacora: ".$pbit;
   $terminal = $_SERVER['REMOTE_ADDR'];
   $a=archdlog($_SESSION['codusu'],$codopcx,$fechaxx,$hora,$accion,$terminal);
   // Fin grabacion de registro de auditoria
   header("Location: vaciar_bitacora.php?mensage=99");
   }
 
?>