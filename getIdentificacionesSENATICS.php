<?php


function webservice_policia($nro, $conpol){
  try {
    $username = 'personas';
    $password = '@g3137c0120';
    $URL = 'https://ws.mspbs.gov.py/api/getPersonas.php?cedula=' . $nro;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Authorization: Basic ' . base64_encode("$username:$password")
    ));
    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $res = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
    //$error = curl_error($ch);
    curl_close($ch);

    $persona = json_decode($res, true);

    if ('200' == $status) {
      if (empty($persona['cedula_identidad'])) { // no se encontro a la persona retornamos FALSE
        return FALSE;
      }

      $cedula = $persona['cedula_identidad'];
      $nombres = $persona['nombres'];
      $apellidos = $persona['apellidos'];
      //Pasar Fecha de Nacimiento a formato 'Año-mes-dia'
      if (isset($persona['fecha_nacimiento'])) {
        $fecnac = date_format(date_create($persona['fecha_nacimiento']), 'Y-m-d');
        $fecnac = "'" . date("Y-m-d", strtotime($fecnac)) . "'";
      } else {
        $fecnac = 'Null';
      }
      $sexo = $persona['codigo_genero'];
      //Control de caracteres especiales en los nombres y apellidos
      $nombres = trim(pg_escape_string($nombres));
      $apellidos = trim(pg_escape_string($apellidos));
      //Carga en la base de datos 'policia'
      $sqlinsert = "INSERT INTO personas (cedula_identidad, nombres, apellidos, fecha_nacimiento, codigo_genero)

      VALUES ($cedula, '$nombres', '$apellidos', $fecnac, $sexo)";

      pg_query($conpol, $sqlinsert);
    } else {
      return FALSE;
    }
  } catch (Exception $e) {
    return FALSE;
  } 

}
?>

