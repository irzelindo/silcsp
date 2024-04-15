<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8"/>
    <title>Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes"/>
    <link rel="shortcut icon" href="favicon.ico"/>     

    <meta http-equiv="Content-Language" content="es-py"/>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1; Content-Encoding: gzip; Vary: Accept-Encoding;" />
    <meta name="description" content="Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica"/>
    <meta name="keywords" content="Estudios clinicos, bacteriologia, analisis, bioquimica, Paraguay, salud, muestras clinicas"/>
    <meta name="author" content="Victor Diaz Ovando"/>
    <meta name="Distribution" content="Global" />
    <meta name="Robots" content="index,follow" />


    <link rel='stylesheet prefetch' href='css/style.css?family=Open+Sans'/>
    <link rel="stylesheet" href="css/style.css"/>

    <script src='js/jquery.min.js'></script>
    <script src="js/index.js"></script>


    <script src="jquery-1.4.2.min.js" type="text/javascript"></script>
    <script src="jquery.ui.draggable.js" type="text/javascript"></script>

    <script src="js/sweetalert.min.js" type="text/javascript"></script>

<script type="text/javascript">  

function getfocusrusu()
    {
    //window.document.getElementById('usuario').focus();
    }

</script>  
  </head>

  <body onload="getfocusrusu()">

    <div class="cont">
      <div class="demo">
        <div class="login">
          <div class="login__check"></div>
          <div class="login__check_texto"><?php echo "Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica"; ?></div>
          <!----------------- FORMULARIO DE INGRESO DE CLAVE ------------------------->
            <form name="login" id="ajaxform" action="autenticacion.php" method="POST">
             <div class="login__form">
             <div class="login__row">
              <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
              </svg>
              <input type="text" id="usuario" name="usuario" class="login__input name" placeholder="usuario"/>
             </div>
             <div class="login__row">
              <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
              </svg>
              <input type="password" id="contrasena" name="contrasena" class="login__input pass" placeholder="contrase&ntilde;a"/>
             </div>
            
             <button type="submit" name="submit" class="login__submit">Ingresar</button>
             <input type="hidden" id="entrar" value="0" />
             <div class="login__petricola"></div>
             </div>
            </form>
            <!-------------------------------------------------------------------------->
        </div>
        
      </div>
    </div>

 </body>
 <?php 
 if ($_GET["error"]=="si")
   {
     echo "<script>swal('','Usuario Incorrecto','warning');</script>";
     echo "<script>getfocusrusu();</script>";
    } 
	
	if ($_GET["errorusuario"]=="si")
         {
         echo "<script>swal('','Datos Incorrectos','warning');</script>";
         echo "<script>getfocusrusu();</script>";
		 } 

      if ($_GET["blanco"]=="si")
      {
  	  echo "<script>swal('','Favor introduzca Usuario y Contrase\u00f1a correctos y activos','warning');</script>";
      echo "<script>getfocusrusu();</script>";
	  } 
?>
</html>
