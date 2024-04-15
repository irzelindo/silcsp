<?php
@Header("Content-type: text/html; charset=utf-8");
session_start();

$codusu = $_SESSION[ 'codusu' ];

include("conexion.php");
$con=Conectarse();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer/src/Exception.php';

require 'phpmailer/PHPMailer/src/PHPMailer.php';

require 'phpmailer/PHPMailer/src/SMTP.php';

$nroeval	=	$_POST['nroeval'];
$txtMensaje	=	$_POST['txtMensaje'];
$grupo		=	$_POST['grupo'];


$respuesta = new stdClass();

//Crear una instancia de PHPMailer
$mail = new PHPMailer(true);  
$mail->IsSMTP(); 

$mail->CharSet="UTF-8";
$mail->Host = "mail.mspbs.gov.py";
$mail->SMTPDebug = 1; 
$mail->Port = 465 ; //465 or 587

/*$mail->SMTPSecure = 'ssl'; */ 
$mail->SMTPAuth = true; 
$mail->IsHTML(true);

//Authentication
$mail->Username = "estadistica.lcsp@mspbs.gov.py";
$mail->Password = "Estadistica.2021**Py";
$mail->SMTPSecure = 'ssl';

//Set Params
$mail->SetFrom("estadistica.lcsp@mspbs.gov.py");

$mail->Subject = "Evaluacion";
$mail->Body = $txtMensaje;
//Enviamos el correo

$sql1 = "select distinct u.codusu, u.email
from usuarios u, evalucionparticipante e
where e.codusu = u.codusu
and   u.email is not null
and   e.nroeval = '$nroeval'";
	
$res1=pg_query($con,$sql1);

while ($row = pg_fetch_array($res1)) 
{

    $mail->AddAddress($row["email"]);
    // Enviar el email
    if(!$mail->Send()) 
	{
        $respuesta->grupo = 0;
    }
	else
	{
		$respuesta->grupo = 1;
	}
    $mail->ClearAddresses();  
}

echo json_encode($respuesta);*/
?>