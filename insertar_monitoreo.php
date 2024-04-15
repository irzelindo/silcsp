<?php
session_start();
include("conexion.php");
$conn = Conectarse();

/*
* Agregar un nuevo Monitoreo
*/

// Verificar si el usuario está registrado
if ($_SESSION['codusu']) {

    // Verificar si el formulario fue enviado y la acción es agregar
    if (isset($_POST['accion']) && $_POST['accion'] == "agregar") {
        $codregion = $_POST["codregion"];
        // Separar el código de región en dos partes: los dos primeros dígitos son la región y el resto es la subregión
        $codreg = substr($codregion, 0, 2);
        $subreg = substr($codregion, 2);
        $laboratorio = $_POST["laboratorio"];
        $semana = $_POST["semana"];
        $horario = $_POST["horario"];
        $cantidad_paciente = $_POST["cantidad_paciente"];
        $cantidad_bio = $_POST["cantidad_paciente_bio"];
        $pruebas_total = $_POST['pruebas_total'];       
        $numero_muestras_bio = $_POST['numero_muestras_bio'];
        $pcr = $_POST['pcr'];
        $elisa_igc  = $_POST['elisa_igc'];
        $elisa_igm   = $_POST['elisa_igm'];
        $elisa_ns1 = $_POST['elisa_ns1'];
        $muestras_lcsp_enviadas = $_POST['muestras_lcsp_enviadas'];
        $hospitalizado = $_POST['hospitalizado'];        
        $obito = $_POST['obito'];       
        $ambulatoria = $_POST['ambulatoria'];       
        $personal_activo = $_POST['personal'];
        $bioquimico = $_POST['bioquimico'];
        $tecnico = $_POST['tecnico'];
        $apoyo = $_POST['apoyo'];
        $bioactivo = $_POST['bioactivo'];
        $stock = $_POST['stock']; 
        $rcpcr = $_POST['rcpcr'];
        $elisa_ns1_epi  = $_POST['elisa_ns1_epi'];
        $elisa_igc_epi = $_POST['elisa_igc_epi'];
        $elisa_igm_epi = $_POST['elisa_igm_epi'];
        $hemograma = $_POST['hemograma_epi'];
        $hepatograma = $_POST['hepatograma_epi'];
        $observaciones = empty($_POST['observaciones']) ? null : strtoupper($_POST['observaciones']);
        $rnombre = strtoupper($_POST['rnombre']);
        $rcontacto = $_POST['rcontacto'];
        $remail = $_POST['remail'];
        $codusu = $_SESSION['codusu'];
        $fecha = date("Y-m-d H:i:s");

        try {
            // Iniciar la transacción
            pg_query($conn, "BEGIN");

            $sql = "INSERT INTO public.monitoreo
            (codreg, subreg, laboratorio, codsemana, horario, cantidad_pacientes, cantidad_paciente_bio, pruebas_total, numero_muestras_bio, pcr, elisa_igc, elisa_igm, elisa_ns1, muestras_lcsp_enviadas, paciente_hospitalizado, paciente_obito, paciente_ambulatoria, personal_activo, bioquimico, tecnico, apoyo_administrativo, bioquimico_activo, stock_epidemiologico, rcpcr_epi, elisa_ns1_epi, elisa_igc_epi, elisa_igm_epi, hemograma, hepatograma, observacion, responsable_nombre, responsable_contacto, responsable_email, codusuario, fecha)
            VALUES('$codreg', '$subreg', '$laboratorio', $semana, '$horario', $cantidad_paciente, $cantidad_bio, $pruebas_total, $numero_muestras_bio, $pcr, $elisa_igc, $elisa_igm, $elisa_ns1, $muestras_lcsp_enviadas,$hospitalizado, $obito, $ambulatoria, $personal_activo, $bioquimico, $tecnico, $apoyo, $bioactivo, $stock, $rcpcr, $elisa_ns1_epi, $elisa_igc_epi, $elisa_igm_epi, $hemograma, $hepatograma, '$observaciones', '$rnombre', '$rcontacto', '$remail', '$codusu', '$fecha')";

            $result = pg_query($conn, $sql);      

            // Verificar el resultado de la primera consulta antes de continuar
            if ($result) { 
                // Bitacora
                include("bitacora.php");
	            $codopc = "V_455";
	            $fecha1=date("Y-n-j", time());
                $hora=date("G:i:s",time());
                $accion="Monitoreo/Laboratorios: Inserta-Reg.: ".$codempresa."-".$razonsocial;
                $terminal = $_SERVER['REMOTE_ADDR'];
                $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);              

                // Confirmar la transacción
                pg_query($conn, "COMMIT");

                print json_encode(array("status" => "success", "message" => "Datos guardados correctamente"));
            } else {
                // Si hay un error, revertir la transacción
                pg_query($conn, "ROLLBACK");
                print json_encode(array("status" => "error", "message" => "Error al guardar los datos en la base de datos"));
            }
        } catch (Exception $e) {
            // Si hay una excepción, revertir la transacción
            pg_query($conn, "ROLLBACK");

            print json_encode(array("status" => "error", "message" => "Error en la ejecución de la consulta:" . $e->getMessage()));
        }
    } else {
        print json_encode(array("status" => "error", "message" => "Formulario no enviado"));
    }
} else {
    print json_encode(array("status" => "error", "message" => "No autorizado"));
}
?>

