<style type="text/css">
.cuadro 
{
	border-style:  ridge;
	border-width: 2px;
    border-collapse: separate;
}

.hr 
{
	background-color: #000080;
	color: white;
    height: 30px;
	font-family: "verdana";
	font-size: 10px;
	padding-left: 5px;
	padding-right: 5px;
}

.tr
{
	background-color: #F4F4F4;
	font-family:"verdana";
	font-size:10px; 
    height: 40px;
	border: 0px solid black; padding: 0.1em;
	padding-left: 5px;
	padding-right: 5px;
}


tr a
{
	text-decoration:none;
	color:#3300FF;
	border-bottom:solid 1px #999;
	font-size: 10px;
}

tr a:hover
{
	color:#990000;
	border-bottom:solid 1px #990000;
}

.trpar
{
	font-family:"Times New Roman",Verdana,Tahoma,sans-serif;
	font-size:10px; 
	border: 1px solid black; padding: 0.1em;
	padding-left: 5px;
	padding-right: 5px;
	background-color: #EED8AE;
}
</style>
<?php
function acentos($cadena) 
{
   $search = explode(",","Ã,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã­,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ­,ÃÃ³,ÃÃº,ÃÃ±,Ã“,Ã ,Ã‰,Ã ,Ãš,â€œ,â€ ,Â¿,Ã‘,Ã,ü");
   $replace = explode(",","Í,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ó,Á,É,Í,Ú,\",\",¿,Ñ,Á,&uuml;");
   $cadena= str_replace($search, $replace, $cadena);
 
   return $cadena;
}

@Header("Content-type: text/html; charset=utf-8");

session_start();
include("conexion.php");
$con=Conectarse();

include("conexion.php");
$con=Conectarse();

$codusu=$_SESSION['codusu'];
$codigo_usu=trim($_POST['codigo_usu']);
$tiporeporte=$_POST['tiporeporte'];

if ($tiporeporte==1)//Navegador
   {
   print '<head><link rel="shortcut icon" href="images/icono.ico"/><link rel="stylesheet" type="text/css" href="images/style.css" />'
         .'<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes"/><title>Reporte - Historico de Contrase&ntilde;as</title><script type="text/javascript" src="reflection.js"></script></head><body style="color: black;background: white;font-size: 90%;">';	
   }


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


$_SESSION['codigo_usu']=$_POST['codigo_usu'];
$_SESSION['fecha1']=$_POST['fecha1'];
$_SESSION['fecha2']=$_POST['fecha2'];

$existef1="NO";
$existef2="NO";

if ($di1=="" && $me1=="" && $an1=="" && $di2=="" && $me2=="" && $an2=="" && $codigo_usu==""  && $codigo_opc=="")
    {
    echo "<div align='center'>";
    echo "<font face='Times New Roman' size='4'>Debe indicar al menos un par&aacute;metro</font>";
    echo "</div>";    	
    echo "<br /><br />";
	print '<p align="center"><a href="javascript:close()">Volver a la p&aacute;gina anterior</a></p>';  
    }
else
   {
   if ($di1=="" && $me1=="" && $an1=="")  // SI TODO ESTA EN BLANCO
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
	        
            echo "<div align='center'>";
            echo "<font face='Times New Roman' size='4'>Fecha DESDE incorrecta</font>";
            echo "</div>";    	
            echo "<br /><br />";
	        print '<p align="center"><a href="javascript:close()">Volver a la p&aacute;gina anterior</a></p>';
	        } 	
         }
      
      
         if ($di2=="" && $me2=="" && $an2=="")  // SI FECHA HASTA ES BLANCO
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
	        
	           echo "<div align='center'>";
               echo "<font face='Times New Roman' size='4'>Fecha HASTA incorrecta</font>";
               echo "</div>";    	
               echo "<br /><br />";
	           print '<p align="center"><a href="javascript:close()">Volver a la p&aacute;gina anterior</a></p>';
	           } 	
            }

            if ($ok1=="SI" && $ok2=="SI")
               {
               $mensage=0;
               if ($existef1=="SI" && $existef2=="SI")
                  {
                  if ($ff2x < $ff1x)
                     {
   	                 $mensage=5;  //RANGO de fechas incorrecto
                     }
                  }
               $condicion="";
               $subtit="";
               $xcodigo_usu=trim($codigo_usu);

               if ($codigo_usu!="")
                  {
   	              if ($condicion=="")
   	                 {
   	   	             $condicion="codusu='$xcodigo_usu'";
   	   	             if ($subtit=="")
   	   	                {
   	   	   	            $subtit="Usuario: ".$codigo_usu;
   	   	                }
   	   	             else
   	   	                {
   	   	   	            $subtit=$subtit.", Usuario: ".$codigo_usu;
   	                    }
   	                 }
   	              else
   	                 {
   	   	             $condicion=$condicion." and codusu='$xcodigo_usu'";
   	   	             if ($subtit=="")
   	   	                {
   	   	   	            $subtit="Usuario: ".$codigo_usu;
   	   	                }
   	   	             else
   	   	                {
   	   	   	            $subtit=$subtit.", Usuario: ".$codigo_usu;
   	   	                }
   	                 }
                  }
   
               
   
               if ($existef1=="SI")
                  {
	              if ($subtit=="")
                     {
   	   	             $subtit="Desde Fecha: ".$ff1;
   	                 }
   	              else
   	                 {
   	   	             $subtit=$subtit.", Desde Fecha: ".$ff1;
   	                 }

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
                  if ($subtit=="")
                     {
   	   	             $subtit="Hasta Fecha: ".$ff2;
   	                 }
                  else
   	                 {
   	   	             $subtit=$subtit.", Hasta Fecha: ".$ff2;
   	                 }

                  if ($condicion=="")
                     {
   	   	             $condicion="fecha<='$ff2x'";
   	                 }
                  else
   	                 {
   	   	             $condicion=$condicion." and fecha<='$ff2x'";
   	                 }
                  }

              if ($mensage==5)
                 {
                 echo "<div align='center'>";
                 echo "<font face='Times New Roman' size='4'>RANGO de fechas incorrecto</font>";
                 echo "</div>";    	
                 echo "<br /><br />";
	             print '<p align="center"><a href="javascript:close()">Volver a la p&aacute;gina anterior</a></p>';	
                 }
              else
                 {
                 $sql = "select * from contrasenias where codusu<>'' and ".$condicion." order by codusu,fecha,hora";
                 $res=pg_query($con,$sql);
                 $numeroRegistros=pg_num_rows($res);

                 if ($numeroRegistros<=0)
                    {
                    echo "<div align='center'>";
                    echo "<font face='Times New Roman' size='4'>No se encontraron registros para esos valores</font>";
                    echo "</div>";    	
                    echo "<br /><br />";
	                print '<p align="center"><a href="javascript:close()">Volver a la p&aacute;gina anterior</a></p>';
                    }
                 else
                    {
                   	if ($tiporeporte==1)  //NAVEGADOR
                   	{
	                echo '<table border="0px"><tr><td><img src="images/logolcsp.png" width="100px" height="100px"/></td>';	      
                    echo '<td><strong>&nbsp;Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica </strong>';
                  //  echo '<br /><strong>Sistema Nacional de Informaci&oacute;n en Salud (SINAIS)</strong>';
                    echo '<br />';

                    echo '<p style="margin-left:0px"><strong>&nbsp;REPORTE DE HISTORICO DE CONTRASE&Ntilde;A</strong></p></td>';
	                echo '</tr></table>';

                    echo '<b>&nbsp;Considerando:</b> '.$subtit.'<br />';
                    echo '<b>&nbsp;Fecha de emisi&oacute;n del reporte:</b> '.date("d/m/Y").'<br />';
                    echo '<b>&nbsp;Hora de emisi&oacute;n del reporte:</b> '.date("H:i:s").'<br/ >';

                    print '<br><table class="cuadro">'
		                  .'<tr><td class="hr">Usuario</td>'
		                  .'<td class="hr">Fecha</td>'
		                  .'<td class="hr">Hora</td>'
		                  .'<td class="hr">Clave Anterior</td>'
		                  .'<td class="hr">Clave Nueva</td></tr>';

                    while ($row = pg_fetch_array($res))
	                      {
                          $fu = $row["fecha"];
                          $fechax="  ".$fu;
                          $f = strtotime($fechax);
                          $dia=date("j",$f);
                          $mes=date("n",$f);
                          $anho=date("Y",$f);
                          if ($dia<10)
                             {
   	                         $dia="0".$dia;
                             }
                          if ($mes<10)
                             {
   	                         $mes="0".$mes;
                             }
                          $fcalc=$dia."/".$mes."/".$anho;
                          $acc=acentos($row['accion']);
 		                  print '<tr>'
                               .'<td class="tr" width="80px">'.$row['codusu'] .'</td>'
		                       .'<td class="tr" width="85px">'.$fcalc .'</td>'
		                       .'<td class="tr" width="70px">'.$row['hora'] .'</td>'
		                       .'<td class="tr" width="120px">'.$row['claveant'] .'</td>'
		                       .'<td class="tr" width="120px">'.$row['clavenueva'] .'</td>'
		                       .'</tr>';
	                       }
	                 print '</table><br />';
                     print '<p align="left">[ <a href="javascript:close()">VOLVER A LA PAGINA ANTERIOR</a> ]</p>';  
                     
                     print '</body>';
	
                     // Bitacora
                     include("bitacora.php");
                     $codopcx = "V_363";
                     $fechaxx=date("Y-n-j", time());
                     $hora=date("G:i:s",time());
                     $accion="Reporte Historico Clave: ".$subtit;
                     $terminal = $_SERVER['REMOTE_ADDR'];
                     $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal);
                     // Fin grabacion de registro de auditoria
					 }
					 else // EXCEL
					 {
                      header("Content-type: application/vnd.ms-excel");
                      header("Content-Disposition: attachment; filename=result.xls");
                      header("Pragma: no-cache");
                      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                      header("Expires: 0");


                      print  '<table border=1>'
	                        .'<tr><td style="font-weight:bold;font-size:1em;background-color:#F1F1F1;color:black;" colspan="5">REPORTE DE HISTORICO DE CONTRASE&Ntilde;A</td></tr>'
	                        .'<tr>'
	                        .'<td style="font-weight:bold;font-size:1em;background-color:#F1F1F1;color:black;" colspan="5"><b>Considerando:</b> '.$subtit.'<br /></td>'
	                        .'</tr>';
                      print '</table>';		
	
                      print  '<table border=1>';	
                      print  '<tr style="background-color:#F1F1F1;color:black;">'	
                            .'<td style="font-size:1em; width:70px;font-weight: bold;">Usuario</td>'
	                        .'<td style="font-size:1em; width:80px;font-weight: bold;">Fecha</td>'
                            .'<td style="font-size:1em; width:70px;font-weight: bold;">Hora</td>'
                            .'<td style="font-size:1em; width:900px;font-weight: bold;">Clave Anterior</td>'
                            .'<td style="font-size:1em; width:100px;font-weight: bold;">Clave Nueva</td>'
                            .'</tr>';
                    while ($row = pg_fetch_array($res))
	                      {
                          $fu = $row["fecha"];
                          $fechax="  ".$fu;
                          $f = strtotime($fechax);
                          $dia=date("j",$f);
                          $mes=date("n",$f);
                          $anho=date("Y",$f);
                          if ($dia<10)
                             {
   	                         $dia="0".$dia;
                             }
                          if ($mes<10)
                             {
   	                         $mes="0".$mes;
                             }
                          $fcalc=$dia."/".$mes."/".$anho;
                          $cv=acentos($row['claveant']);
                          $cn=acentos($row['clavenueva']);
 		                  print '<tr>'
                               .'<td>'.$row['codusu'].'</td>'
		                       .'<td>'.$fcalc.'</td>'
		                       .'<td>'.$row['hora'].'</td>'
		                       .'<td>'.acentos($cv).'</td>'
		                       .'<td>'.acentos($cn).'</td>'
		                       .'</tr>';
	                       }
	                 print '</table>';
		
                     // Bitacora
                     include("bitacora.php");
                     $codopcx = "V_363";
                     $fechaxx=date("Y-n-j", time());
                     $hora=date("G:i:s",time());
                     $accion="Reporte Historico Clave XLS: ".$subtit;
                     $terminal = $_SERVER['REMOTE_ADDR'];
                     $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal);
                     // Fin grabacion de registro de auditoria					 	
					 }	
         	         }        	
                  }
               }
   }  
?>