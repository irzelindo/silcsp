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
include("conexionsaa.php");
$con=Conectarse();
$consaa=Conectarsesaa();

$codusu=$_SESSION['codusu'];
$tiporeporte=$_POST['tiporeporte'];

if ($tiporeporte==1)//Navegador
   {
   print '<head><link rel="shortcut icon" href="images/icono.ico"/><link rel="stylesheet" type="text/css" href="images/style.css" />'
         .'<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes"/><title>Reporte - Usuarios de Sistema</title><script type="text/javascript" src="reflection.js"></script></head><body style="color: black;background: white;font-size: 90%;">';	
   }


                 $sql = "select * from usuarios order by codusu";
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
                    echo '<br />';

                    echo '<p style="margin-left:0px"><strong>&nbsp;REPORTE DE USUARIOS DEL SISTEMA</strong></p></td>';
	                echo '</tr></table>';

                    echo '<b>&nbsp;Fecha de emisi&oacute;n del reporte:</b> '.date("d/m/Y").'<br />';
                    echo '<b>&nbsp;Hora de emisi&oacute;n del reporte:</b> '.date("H:i:s").'<br/ >';

                    print '<br><table class="cuadro">'
		                  .'<tr><td class="hr">Usuario</td>'
		                  .'<td class="hr">Nombre y Apellido</td>'
                          .'<td class="hr">C&oacute;digo Regi&oacute;n</td>'
		                  .'<td class="hr">Regi&oacute;n</td>'
                          .'<td class="hr">C&oacute;digo Distrito</td>'
		                  .'<td class="hr">Distrito</td>'
		                  .'<td class="hr">C&oacute;digo Establecimiento</td>'
		                  .'<td class="hr">Establecimiento</td>'
                          .'</tr>';

                    while ($row = pg_fetch_array($res))
	                      {
                              $usuario=$row['codusu'];
                              
                              $tab2 = pg_query($con, "select * from usuariosareas where  codusu='$usuario'");
                              $row2 = pg_fetch_array($tab2);
                              $codservicio = $row2['codservicio'];
                              
                              
                              $tabest = pg_query($con, "select * from establecimientos where  codservicio='$codservicio'");
                              $rowest = pg_fetch_array($tabest);
                              $nomservicio = $rowest['nomservicio'];
                              $codreg = $rowest['codreg'];
                              $subcreg = $rowest['subcreg'];
                              $region= $codreg.$subcreg;
                              $coddist = $rowest['coddist'];
                              
                              $tabreg = pg_query($consaa, "select * from regiones where  codreg='$codreg' and subcreg='$subcreg'");
                              $rowreg = pg_fetch_array($tabreg);
                              $nomregion = $rowreg['nomreg'];
                              
                              $tabdist = pg_query($consaa, "select * from distritos where  codreg='$codreg' and subcreg='$subcreg' and coddist='$coddist'");
                              $rowdist = pg_fetch_array($tabdist);
                              $nomdistrito = $rowdist['nomdist'];
                              
    
    
 		                  print '<tr>'
                               .'<td class="tr" width="80px">'.$usuario .'</td>'
		                       .'<td class="tr" width="300px">'.$row['nomyape'] .'</td>'
                               .'<td class="tr" width="80px">'.$region .'</td>'
		                       .'<td class="tr" width="300px">'.$nomregion .'</td>'
                               .'<td class="tr" width="80px">'.$coddist .'</td>'
		                       .'<td class="tr" width="300px">'.$nomdistrito .'</td>'
		                       .'<td class="tr" width="80px">'.$codservicio .'</td>'
		                       .'<td class="tr" width="300px">'.$nomservicio .'</td>'
		                       .'</tr>';
	                       }
	                 print '</table><br />';
                     print '<p align="left">[ <a href="javascript:close()">VOLVER A LA PAGINA ANTERIOR</a> ]</p>';  
                     
                     print '</body>';
	
                     // Bitacora
                     include("bitacora.php");
                     $codopcx = "V_361";
                     $fechaxx=date("Y-n-j", time());
                     $hora=date("G:i:s",time());
                     $accion="Reporte Usuarios ";
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
	                        .'<tr><td style="font-weight:bold;font-size:1em;background-color:#F1F1F1;color:black;" colspan="8">REPORTE DE USUARIOS DEL SISTEMA</td></tr>';
                      print '</table>';		
	
                      print  '<table border=1>';	
                      print  '<tr style="background-color:#F1F1F1;color:black;">'	
                            .'<td style="font-size:1em; width:70px;font-weight: bold;">Usuario</td>'
	                        .'<td style="font-size:1em; width:300px;font-weight: bold;">Nombre y Apellido</td>'
                            .'<td style="font-size:1em; width:70px;font-weight: bold;">C&oacute;digo Regi&oacute;n</td>'
                            .'<td style="font-size:1em; width:300px;font-weight: bold;">Regi&oacute;n</td>'
                            .'<td style="font-size:1em; width:70px;font-weight: bold;">C&oacute;digo Distrito</td>'
                            .'<td style="font-size:1em; width:300px;font-weight: bold;">Distrito</td>'
                            .'<td style="font-size:1em; width:70px;font-weight: bold;">C&oacute;digo Establecimiento</td>'
                            .'<td style="font-size:1em; width:300px;font-weight: bold;">Establecimiento</td>'
                            .'</tr>';
                    while ($row = pg_fetch_array($res))
	                      {
                          
                              $usuario=$row['codusu'];
                              
                              $tab2 = pg_query($con, "select * from usuariosareas where  codusu='$usuario'");
                              $row2 = pg_fetch_array($tab2);
                              $codservicio = $row2['codservicio'];
                              
                              
                              $tabest = pg_query($con, "select * from establecimientos where  codservicio='$codservicio'");
                              $rowest = pg_fetch_array($tabest);
                              $nomservicio = $rowest['nomservicio'];
                              $codreg = $rowest['codreg'];
                              $subcreg = $rowest['subcreg'];
                              $region= $codreg.$subcreg;
                              $coddist = $rowest['coddist'];
                              
                              $tabreg = pg_query($consaa, "select * from regiones where  codreg='$codreg' and subcreg='$subcreg'");
                              $rowreg = pg_fetch_array($tabreg);
                              $nomregion = $rowreg['nomreg'];
                              
                              $tabdist = pg_query($consaa, "select * from distritos where  codreg='$codreg' and subcreg='$subcreg' and coddist='$coddist'");
                              $rowdist = pg_fetch_array($tabdist);
                              $nomdistrito = $rowdist['nomdist'];
    
 		                  print '<tr>'
                               .'<td>'.$usuario.'</td>'
		                       .'<td>'.$row['nomyape'].'</td>'
                               .'<td>'.$region.'</td>'
		                       .'<td>'.acentos($nomregion).'</td>'
                               .'<td>'.$coddist.'</td>'
		                       .'<td>'.acentos($nomdistrito).'</td>'
		                       .'<td>'.$codservicio.'</td>'
		                       .'<td>'.acentos($nomservicio).'</td>'
		                       .'</tr>';
	                       }
	                 print '</table>';
		
                     // Bitacora
                     include("bitacora.php");
                     $codopcx = "V_361";
                     $fechaxx=date("Y-n-j", time());
                     $hora=date("G:i:s",time());
                     $accion="Reporte Usuarios XLS ";
                     $terminal = $_SERVER['REMOTE_ADDR'];
                     $a=archdlog($codusu,$codopcx,$fechaxx,$hora,$accion,$terminal);
                     // Fin grabacion de registro de auditoria					 	
					 }	
         	         }        	

    
?>