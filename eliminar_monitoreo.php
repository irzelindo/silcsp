<?php
session_start();
include("conexion.php");
$con = Conectarse();

/*
* Delete monitory
*/

// Check if user is logged
if ($_SESSION['codusu']) {
    
    // Check if the form was sent and the action is SAVE
    if (isset($_POST['accion']) && $_POST['accion'] == "eliminar") {
        $id = $_POST['id'];

        try {
            // Inicia la transacción
            pg_query($con, "BEGIN");

            $sql = "DELETE FROM monitoreo WHERE codmonitoreo = $id";
            $result = pg_query($con, $sql);

            if ($result) {
                // Bitácora
                include("bitacora.php");
                $codopc = "V_455";
                $fecha = date("Y-n-j", time());
                $hora = date("G:i:s", time());
                $accion = "Monitoreo/Laboratorios: Elimina-Reg.: " . $id;
                $terminal = $_SERVER['REMOTE_ADDR'];
                $a = archdlog($_SESSION['codusu'], $codopc, $fecha, $hora, $accion, $terminal);

                // Confirma la transacción
                pg_query($con, "COMMIT");

                print json_encode(array("status" => "success", "message" => "Registro eliminado correctamente"));
            } else {
                // Si hay algún error, deshace la transacción
                pg_query($con, "ROLLBACK");

                print json_encode(array("status" => "error", "message" => "Error al eliminar el registro"));
            }
        } catch (Exception $e) {
            // Si hay una excepción, deshace la transacción
            pg_query($con, "ROLLBACK");

            print json_encode(array("status" => "error", "message" => "Error en la consulta: " . $e->getMessage()));
        }
    } else // FORM NOT SENT
    {
        print json_encode(array("status" => "error", "message" => "Formulario no enviado"));
    }
} else // NOT LOGGED
{
    print json_encode(array("status" => "error", "message" => "No autorizado"));
}
?>

