<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codusux']=$_POST['codusux'];
   $_SESSION['nomyapex']=$_POST['nomyapex'];
   $_SESSION['clave']=$_POST['clave'];
   $_SESSION['estado']=$_POST['estado'];

  $_SESSION['cedula']   = $_POST['cedula'];
  $_SESSION['email']    = $_POST['email'];
  $_SESSION['telefono'] = $_POST['telefono'];
  $_SESSION['celular']  = $_POST['celular'];
  $_SESSION['dccion']   = $_POST['dccion'];
  $_SESSION['fechareg'] = $_POST['fechareg'];
  $_SESSION['fechauact'] = $_POST['fechauact'];
  $_SESSION['region']   = $_POST['region'];
  $_SESSION['codservicio'] = $_POST['codservicio'];
  $_SESSION['codarea']  = $_POST['codarea'];
  $_SESSION['recsms']   = $_POST['recsms'];
  $_SESSION['recemail'] = $_POST['recemail'];
  $_SESSION['recalerta'] = $_POST['recalerta'];
  $_SESSION['nroregprof'] = $_POST['nroregprof'];
  $_SESSION['laboratorio'] = $_POST['laboratorio'];
  $_SESSION['codempresa'] = $_POST['codempresa'];
  $_SESSION['codrol']   = $_POST['codrol'];
  $_SESSION['archivo']  = $_POST['archivo'];

   $_SESSION['permi']    = $_POST['permi'];
      
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
				   
	$codusux  = trim($_POST['codusux']);
	$nomyapex  = trim($_POST['nomyapex']);
	$clave  = trim($_POST['clave']);
	$estado  = 1*$_POST['estado'];
	$nomyapexx = trim($_POST['nomyapexx']);

   $cedula    = $_POST['cedula'];
   $email    = $_POST['email'];
   $telefono    = $_POST['telefono'];
   $celular    = $_POST['celular'];
   $dccion    = $_POST['dccion'];
   $fechareg    = $_POST['fechareg'];
   $fechauact    = date("Y-n-j", time());
   $region    = $_POST['region'];
   $codservicio    = $_POST['codservicio'];
   $codarea    = $_POST['codarea'];
   $recsms    = 1*$_POST['recsms'];
   $recemail    = 1*$_POST['recemail'];
   $recalerta    = 1*$_POST['recalerta'];
   $nroregprof    = $_POST['nroregprof'];
   $laboratorio    = $_POST['laboratorio'];
   $codempresa    = $_POST['codempresa'];
   $codrol    = $_POST['codrol'];
   $archivo    = $_POST['archivo'];

    $vector    = $_POST['permi'];

   $directorio1 = "firmas";
   $nomarchivo1 = $codusux."usuariofirma.jpg";
   
  $ok2="SI";
  if (file_exists ($directorio1) )
	{
	$documento1 		= $_FILES['archivo']['name'];
	$tipo1 				= $_FILES['archivo']['type'];
	$tamano_archivo1 	= $_FILES['archivo']['size'];

    if($tamano_archivo1>0)
       {
	    if($tamano_archivo1>500000 || ($tipo1!= 'image/jpeg' && $tipo1!= ''))
	      {
//	      header("Location: modifica_usuarios.php?mensage=2");
	      $ok2="NO";
		  }	  
       }
    else
	   {
	   	$nomarchivo1='';
	   }   
	}

   $ok1='SI'; // valida fecha

/*	
echo $codusux;
echo'<br>';
echo $nomyapex;
echo'<br>';
echo $nomyapexx;
*/  

    if 	($ok1=='SI' && $ok2=='SI') 
	{
 
	$query2 = "select * from usuarios where nomyape = '$nomyapex'";
    $result2 = pg_query($conn,$query2); 
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomyapex==$nomyapexx))
	   {
        $result = pg_query($conn,"UPDATE usuarios SET nomyape=upper('$nomyapex'), 
                                                      clave='$clave', 
                                                      estado=$estado, 
                                                      cedula='$cedula', 
                                                      email='$email', 
                                                      telefono='$telefono', 
                                                      celular='$celular', 
                                                      dccion='$dccion', 
                                                      fechareg='$fechareg', 
                                                      fechauact='$fechauact', 
                                                      codservicio='$codservicio', 
                                                      codarea='$codarea', 
                                                      recsms=$recsms, 
                                                      recemail=$recemail, 
                                                      recalerta=$recalerta, 
                                                      nroregprof='$nroregprof',
                                                      laboratorio='$laboratorio',
                                                      codempresa='$codempresa'
                                                      WHERE codusu='$codusux' ");  


    	pg_query($conn,"DELETE FROM perfiles WHERE codusu = '$codusux'");

        // Agregar registros en OPC_USUARIOS - Permisos
        $sql="select * from opciones ORDER BY codopc";
        $res=pg_query($conn,$sql);
        $i=0;
        while ($row = pg_fetch_assoc($res))
  	          {
              $i=$i+1;
              $valor=0;
              $valor=$vector[$i];
              $codopc=$row['codopc'];
	 	      $result = pg_query($conn,"insert into perfiles( codusu,codopc,modo) values('$codusux','$codopc',$valor)");               
              }


            if($tamano_archivo1>0)
    	       {
    		   $nomarchivo1 = $codusux."usuariofirma.jpg";
    		
    		   if (file_exists ("firmas/".$nomarchivo1))
    		      {
    		      unlink("firmas/$nomarchivo1");
    		      }       	
    	       	
                $documentox1='temporal.jpg';
    		   	if (copy($_FILES['archivo']['tmp_name'], $directorio1.'/'.$documentox1))
    				{
    				$documentonew1 = $nomarchivo1; // Nombre del documento 
    				rename ($directorio1.'/'.$documentox1, $directorio1.'/'.$documentonew1); // Cambia nombre de tapagrande
    				//unlink("fotos/$documento");
    		     	}
    	       }
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_411";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Usuarios: Modifica-Reg.: ".$codusux."-".$nomyapex;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: usuarios.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_usuarios.php?id=$codusux&mensage2=2"); 
       } 
    }
 else
    {
    if($ok1=='NO')
	  {
      header("Location: modifica_usuarios.php?mensage=1&id=$codusux");		
	  }
	else
	  {
      header("Location: modifica_usuarios.php?mensage=2&id=$codusux");		
	  }  	
    
	}        
?>
