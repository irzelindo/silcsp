<?php
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   
   $codusu=$_SESSION['codusu']; // usuario de la sesion      
   include("conexion.php");
   $con=Conectarse();
			
	$nroeval     = $_POST['nroeval'];
	 
    $archivo     = $_POST['archivo'];
	
	$nomarchivo=trim("Evaluacion_".$nroeval).".pdf";
	
	$direc = "upload/".$nomarchivo;
	
	if (file_exists ("upload/".$nomarchivo))
	{
		unlink("upload/$nomarchivo");
	}
	
	// Ahora voy a incluir en una carpeta el archivo
	
	$directorio = "upload";
	/* Comprobamos si el directorio temporal esta creado, si no lo esta lo creamos*/
	if (file_exists ($directorio) )
	{
		$documento 		= $_FILES['archivo']['name'];
		$tipo 				= $_FILES['archivo']['type'];
		$tamano_archivo 	= $_FILES['archivo']['size'];
		
		
		if (copy($_FILES['archivo']['tmp_name'], $directorio.'/'.$documento))
		{
			$documentonew = $nomarchivo; 
			
			rename ($directorio.'/'.$documento, $directorio.'/'.$documentonew);
			
		}
        
        header("Location: modifica_examen.php?nroeval=$nroeval");
		

	}	 	
	pg_close($con); 
?> 