<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['norden']  = $_POST['norden'];
   $_SESSION['archivo'] = $_POST['archivo'];
   $_SESSION['texto']   = $_POST['texto'];
   $_SESSION['fecha']   = $_POST['fecha'];  
   $_SESSION['texto']   = $_POST['texto'];
   $_SESSION['parafl']  = $_POST['parafl'];
   $_SESSION['paracli'] = $_POST['paracli'];

   
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
	  
   $norden    = 1*$_POST['norden'];
   $fecha     = $_POST['fecha'];	
   $texto      = $_POST['texto'];
   $parafl     = 1*$_POST['parafl'];
   $paracli    = 1*$_POST['paracli'];
   if($parafl==0){$parafl=2;}
   if($paracli==0){$paracli=2;}
   $archivo     = $_POST['archivo'];
  
   $directorio1 = "fotos";
   $nomarchivo1 = "anuncio".$norden.".jpg";

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
	      header("Location: modifica_anuncios.php?mensage=2");
	      $ok2="NO";
		  }	  
       }
    else
	   {
	   	$nomarchivo1='';
	   }   
	}

    $ok1='SI';   


if 	($ok1=='SI' && $ok2=='SI') 
	{
	   	//--------------------------------------------------------- //
	   	if($nomarchivo1!='')
	   	   {                                	   	       
		 	$result = pg_query($conn,"UPDATE anuncios SET  texto='$texto', 
													    archivo='$nomarchivo1', 
													    veempresa=$parafl,
													    vecliente=$paracli
												WHERE   norden=$norden"); 
	   	   }
	   	else
		   {
		 	$result = pg_query($conn,"UPDATE anuncios SET  texto='$texto',  
													    veempresa=$parafl,
													    vecliente=$paracli
												WHERE   norden=$norden"); 		   	
		   }   
	   	//--------------------------------------------------------- //

	    if($tamano_archivo1>0)
	       {
		   $nomarchivo1 = "anuncio".$norden.".jpg";
		
		   if (file_exists ("fotos/".$nomarchivo1))
		      {
		      unlink("fotos/$nomarchivo1");
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
	    $codopc = "V_54";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Anuncios: Modifica-Reg.: ".$norden."-".$texto;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: anuncios.php?mensage=7");
   		
    }
else
    {
    if($ok1=='NO')
	  {
      header("Location: modifica_anuncios.php?mensage=1");		
	  }
	else
	  {
      header("Location: modifica_anuncios.php?mensage=2");		
	  }  	
    
	}  
?>
