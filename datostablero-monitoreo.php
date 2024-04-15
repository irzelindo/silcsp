<?php
session_start();
include("conexion.php");
$conn = Conectarse();

// Verificar si la acción es para traer una consulta
if (isset($_GET['accion']) && $_GET['accion'] == "muestra_region") {
  try {
    // Obtener el valor del campo del formulario
    $codreg = 0;
    $desde = isset($_GET["desde"]) && !empty($_GET["desde"]) ? $_GET["desde"] : null;
    $hasta = isset($_GET["hasta"]) && !empty($_GET["hasta"]) ? $_GET["hasta"] : null;

    // Construir la condición de la consulta SQL para las fechas
    $w = "";
    if (!is_null($desde) && !is_null($hasta)) {
      $w = "AND m.fecha BETWEEN '$desde' AND '$hasta'";
    }

    // Consulta SQL para obtener los datos deseados
    $sql = "SELECT r.nomreg AS region, COALESCE(SUM(m.pruebas_total), 0) AS cantidad
      FROM regiones r 
      INNER JOIN public.monitoreo m ON m.codreg = r.codreg AND m.subreg = r.subcreg 
      WHERE r.codreg <> '50' $w
      GROUP BY r.codreg, r.subcreg, r.nomreg
      ORDER BY r.codreg;";

    // Ejecutar la consulta
    $result = pg_query($conn, $sql);

    // Verificar si la consulta fue exitosa
    if ($result) {
      // Convertir el resultado a un arreglo asociativo
      $data = pg_fetch_all($result);

      // Si hay resultados, enviarlos como JSON
      if ($data) {
        print json_encode($data);
      } else {
        print json_encode(array("status" => "error", "message" => "No se encontraron datos para el código de región proporcionado"));
      }
    } else {
      print json_encode(array("status" => "error", "message" => "Error al ejecutar la consulta"));
    }
  } catch (Exception $e) {
    print json_encode(array("status" => "error", "message" => "Error en la ejecución de la consulta: " . $e->getMessage()));
  }
}else if (isset($_GET['accion']) && $_GET['accion'] == "muestra_laboratorio") {
  try {
    // Obtener el valor del campo del formulario
    $codreg = 0;
    $desde = isset($_GET["desde"]) && !empty($_GET["desde"]) ? $_GET["desde"] : null;
    $hasta = isset($_GET["hasta"]) && !empty($_GET["hasta"]) ? $_GET["hasta"] : null;

    // Construir la condición de la consulta SQL para las fechas
    $w = "";
    if (!is_null($desde) && !is_null($hasta)) {
      $w = " WHERE fecha BETWEEN '$desde' AND '$hasta'";
    }

    // Consulta SQL para obtener los datos deseados
    $sql = "SELECT 
    CASE 
            WHEN l.laboratorio_simplificado ILIKE 'de %' THEN TRIM(SUBSTRING(l.laboratorio_simplificado FROM 4))
            ELSE l.laboratorio_simplificado 
        END AS laboratorio,
        l.cantidad
    FROM (
        SELECT 
            CASE 
                WHEN laboratorio ILIKE 'Laboratorio %' THEN TRIM(SUBSTRING(laboratorio FROM 12))
                ELSE laboratorio 
            END AS laboratorio_simplificado, 
            COALESCE(SUM(pruebas_total), 0) AS cantidad
        FROM 
            monitoreo $w
        GROUP BY 
            laboratorio_simplificado
    ) l";

    // Ejecutar la consulta
    $result = pg_query($conn, $sql);

    // Verificar si la consulta fue exitosa
    if ($result) {
      // Convertir el resultado a un arreglo asociativo
      $data = pg_fetch_all($result);

      // Si hay resultados, enviarlos como JSON
      if ($data) {
        print json_encode($data);
      } else {
        print json_encode(array("status" => "error", "message" => "No se encontraron datos para el código de región proporcionado"));
      }
    } else {
      print json_encode(array("status" => "error", "message" => "Error al ejecutar la consulta"));
    }
  } catch (Exception $e) {
    print json_encode(array("status" => "error", "message" => "Error en la ejecución de la consulta: " . $e->getMessage()));
  }
}else if (isset($_GET['accion']) && $_GET['accion'] == "muestra_estudio") {
  try {
    // Obtener el valor del campo del formulario
    $codreg = 0;
    $desde = isset($_GET["desde"]) && !empty($_GET["desde"]) ? $_GET["desde"] : null;
    $hasta = isset($_GET["hasta"]) && !empty($_GET["hasta"]) ? $_GET["hasta"] : null;

    // Construir la condición de la consulta SQL para las fechas
    $w = "";
    if (!is_null($desde) && !is_null($hasta)) {
      $w = " WHERE fecha BETWEEN '$desde' AND '$hasta'";
    }

    // Consulta SQL para obtener los datos deseados
    $sql = "SELECT 'PCR'::varchar as estudio, COALESCE(SUM(pcr), 0) AS cantidad FROM monitoreo $w
            UNION ALL
            SELECT 'Elisa_igc'::varchar as estudio, COALESCE(SUM(elisa_igc), 0) AS cantidad FROM monitoreo $w
            UNION ALL
            SELECT 'Elisa_igm'::varchar as estudio, COALESCE(SUM(elisa_igm), 0) AS cantidad FROM monitoreo $w
            UNION ALL
            SELECT 'Elisa_ns1'::varchar as estudio, COALESCE(SUM(elisa_ns1), 0) AS cantidad FROM monitoreo $w";

    // Ejecutar la consulta
    $result = pg_query($conn, $sql);

    // Verificar si la consulta fue exitosa
    if ($result) {
      // Convertir el resultado a un arreglo asociativo
      $data = pg_fetch_all($result);

      // Si hay resultados, enviarlos como JSON
      if ($data) {
        print json_encode($data);
      } else {
        print json_encode(array("status" => "error", "message" => "No se encontraron datos para el código de región proporcionado"));
      }
    } else {
      print json_encode(array("status" => "error", "message" => "Error al ejecutar la consulta"));
    }
  } catch (Exception $e) {
    print json_encode(array("status" => "error", "message" => "Error en la ejecución de la consulta: " . $e->getMessage()));
  }
}else if (isset($_GET['accion']) && $_GET['accion'] == "muestra_semana") {
  try {
    // Obtener el valor del campo del formulario
    $codreg = 0;
    $desde = isset($_GET["desde"]) && !empty($_GET["desde"]) ? $_GET["desde"] : null;
    $hasta = isset($_GET["hasta"]) && !empty($_GET["hasta"]) ? $_GET["hasta"] : null;

    // Construir la condición de la consulta SQL para las fechas
    $w = "";
    if (!is_null($desde) && !is_null($hasta)) {
      $w = " WHERE fecha BETWEEN '$desde' AND '$hasta'";
    }

    // Consulta SQL para obtener los datos deseados
    $sql = "SELECT 
    CONCAT(s.numero_semana, ' - ', s.mes) AS semana,
    COALESCE(SUM(m.pruebas_total), 0) AS cantidad
    FROM semana_epidemiologica s LEFT JOIN monitoreo m ON m.codsemana = s.codsemana
    GROUP BY s.numero_semana, s.mes ORDER BY s.numero_semana ASC";

    // Ejecutar la consulta
    $result = pg_query($conn, $sql);

    // Verificar si la consulta fue exitosa
    if ($result) {
      // Convertir el resultado a un arreglo asociativo
      $data = pg_fetch_all($result);

      // Si hay resultados, enviarlos como JSON
      if ($data) {
        print json_encode($data);
      } else {
        print json_encode(array("status" => "error", "message" => "No se encontraron datos para el código de región proporcionado"));
      }
    } else {
      print json_encode(array("status" => "error", "message" => "Error al ejecutar la consulta"));
    }
  } catch (Exception $e) {
    print json_encode(array("status" => "error", "message" => "Error en la ejecución de la consulta: " . $e->getMessage()));
  }
}else if (isset($_GET['accion']) && $_GET['accion'] == "personal_region") {
  try {
    // Obtener el valor del campo del formulario
    $codreg = 0;
    $desde = isset($_GET["desde"]) && !empty($_GET["desde"]) ? $_GET["desde"] : null;
    $hasta = isset($_GET["hasta"]) && !empty($_GET["hasta"]) ? $_GET["hasta"] : null;

    // Construir la condición de la consulta SQL para las fechas
    $w = "";
    if (!is_null($desde) && !is_null($hasta)) {
      $w = " WHERE m.fecha BETWEEN '$desde' AND '$hasta'";
    }

    // Consulta SQL para obtener los datos deseados
    $sql = "SELECT r.nomreg AS region, COALESCE(SUM(m.personal_activo), 0) AS cantidad
    FROM regiones r 
    INNER JOIN public.monitoreo m ON m.codreg = r.codreg AND m.subreg = r.subcreg 
    WHERE r.codreg <> '50' $w
    GROUP BY r.codreg, r.subcreg, r.nomreg
    ORDER BY r.codreg;";

    // Ejecutar la consulta
    $result = pg_query($conn, $sql);

    // Verificar si la consulta fue exitosa
    if ($result) {
      // Convertir el resultado a un arreglo asociativo
      $data = pg_fetch_all($result);

      // Si hay resultados, enviarlos como JSON
      if ($data) {
        print json_encode($data);
      } else {
        print json_encode(array("status" => "error", "message" => "No se encontraron datos para el código de región proporcionado"));
      }
    } else {
      print json_encode(array("status" => "error", "message" => "Error al ejecutar la consulta"));
    }
  } catch (Exception $e) {
    print json_encode(array("status" => "error", "message" => "Error en la ejecución de la consulta: " . $e->getMessage()));
  }
}else if (isset($_GET['accion']) && $_GET['accion'] == "personal_laboratorio") {
  try {
    // Obtener el valor del campo del formulario
    $codreg = 0;
    $desde = isset($_GET["desde"]) && !empty($_GET["desde"]) ? $_GET["desde"] : null;
    $hasta = isset($_GET["hasta"]) && !empty($_GET["hasta"]) ? $_GET["hasta"] : null;

    // Construir la condición de la consulta SQL para las fechas
    $w = "";
    if (!is_null($desde) && !is_null($hasta)) {
      $w = " WHERE fecha BETWEEN '$desde' AND '$hasta'";
    }

    // Consulta SQL para obtener los datos deseados
    $sql = "SELECT 
    CASE 
            WHEN l.laboratorio_simplificado ILIKE 'de %' THEN TRIM(SUBSTRING(l.laboratorio_simplificado FROM 4))
            ELSE l.laboratorio_simplificado 
        END AS laboratorio,
        l.cantidad
    FROM (
        SELECT 
            CASE 
                WHEN laboratorio ILIKE 'Laboratorio %' THEN TRIM(SUBSTRING(laboratorio FROM 12))
                ELSE laboratorio 
            END AS laboratorio_simplificado, 
            COALESCE(SUM(personal_activo), 0) AS cantidad
        FROM 
            monitoreo  $w
        GROUP BY 
            laboratorio_simplificado
    ) l;";

    // Ejecutar la consulta
    $result = pg_query($conn, $sql);

    // Verificar si la consulta fue exitosa
    if ($result) {
      // Convertir el resultado a un arreglo asociativo
      $data = pg_fetch_all($result);

      // Si hay resultados, enviarlos como JSON
      if ($data) {
        print json_encode($data);
      } else {
        print json_encode(array("status" => "error", "message" => "No se encontraron datos para el código de región proporcionado"));
      }
    } else {
      print json_encode(array("status" => "error", "message" => "Error al ejecutar la consulta"));
    }
  } catch (Exception $e) {
    print json_encode(array("status" => "error", "message" => "Error en la ejecución de la consulta: " . $e->getMessage()));
  }
}else if (isset($_GET['accion']) && $_GET['accion'] == "personal_semana") {
  try {
    // Obtener el valor del campo del formulario
    $codreg = 0;
    $desde = isset($_GET["desde"]) && !empty($_GET["desde"]) ? $_GET["desde"] : null;
    $hasta = isset($_GET["hasta"]) && !empty($_GET["hasta"]) ? $_GET["hasta"] : null;

    // Construir la condición de la consulta SQL para las fechas
    $w = "";
    if (!is_null($desde) && !is_null($hasta)) {
      $w = " WHERE fecha BETWEEN '$desde' AND '$hasta'";
    }

    // Consulta SQL para obtener los datos deseados
    $sql = "SELECT 
    CONCAT(s.numero_semana, ' - ', s.mes) AS semana,
    COALESCE(SUM(m.personal_activo), 0) AS cantidad
    FROM semana_epidemiologica s LEFT JOIN monitoreo m ON m.codsemana = s.codsemana
    GROUP BY s.numero_semana, s.mes ORDER BY s.numero_semana ASC";

    // Ejecutar la consulta
    $result = pg_query($conn, $sql);

    // Verificar si la consulta fue exitosa
    if ($result) {
      // Convertir el resultado a un arreglo asociativo
      $data = pg_fetch_all($result);

      // Si hay resultados, enviarlos como JSON
      if ($data) {
        print json_encode($data);
      } else {
        print json_encode(array("status" => "error", "message" => "No se encontraron datos para el código de región proporcionado"));
      }
    } else {
      print json_encode(array("status" => "error", "message" => "Error al ejecutar la consulta"));
    }
  } catch (Exception $e) {
    print json_encode(array("status" => "error", "message" => "Error en la ejecución de la consulta: " . $e->getMessage()));
  }
}else if (isset($_GET['accion']) && $_GET['accion'] == "reactivo_tipo") {
  try {
    // Obtener el valor del campo del formulario
    $codreg = 0;
    $desde = isset($_GET["desde"]) && !empty($_GET["desde"]) ? $_GET["desde"] : null;
    $hasta = isset($_GET["hasta"]) && !empty($_GET["hasta"]) ? $_GET["hasta"] : null;

    // Construir la condición de la consulta SQL para las fechas
    $w = "";
    if (!is_null($desde) && !is_null($hasta)) {
      $w = " WHERE fecha BETWEEN '$desde' AND '$hasta'";
    }

    // Consulta SQL para obtener los datos deseados
    $sql = "SELECT 'RTP-PCR'::varchar as tipo, COALESCE(SUM(rcpcr_epi), 0) AS cantidad FROM monitoreo $w
    UNION ALL
    SELECT 'Elisa NS1'::varchar as tipo, COALESCE(SUM(elisa_ns1_epi), 0) AS cantidad FROM monitoreo  $w
    UNION ALL
    SELECT 'Elisa IgC'::varchar as tipo, COALESCE(SUM(elisa_igc_epi), 0) AS cantidad FROM monitoreo $w
    UNION ALL
    SELECT 'Elisa IgM'::varchar as tipo, COALESCE(SUM(elisa_igm_epi), 0) AS cantidad FROM monitoreo $w
    UNION ALL
    SELECT 'Hemograma'::varchar as tipo, COALESCE(SUM(hemograma), 0) AS cantidad FROM monitoreo $w
    UNION ALL
    SELECT 'Hepatograma'::varchar as tipo, COALESCE(SUM(hepatograma), 0) AS cantidad FROM monitoreo $w" ;

    // Ejecutar la consulta
    $result = pg_query($conn, $sql);

    // Verificar si la consulta fue exitosa
    if ($result) {
      // Convertir el resultado a un arreglo asociativo
      $data = pg_fetch_all($result);

      // Si hay resultados, enviarlos como JSON
      if ($data) {
        print json_encode($data);
      } else {
        print json_encode(array("status" => "error", "message" => "No se encontraron datos para el código de región proporcionado"));
      }
    } else {
      print json_encode(array("status" => "error", "message" => "Error al ejecutar la consulta"));
    }
  } catch (Exception $e) {
    print json_encode(array("status" => "error", "message" => "Error en la ejecución de la consulta: " . $e->getMessage()));
  }
}else if (isset($_GET['accion']) && $_GET['accion'] == "reactivo_region") {
  try {
    // Obtener el valor del campo del formulario
    $codreg = 0;
    $desde = isset($_GET["desde"]) && !empty($_GET["desde"]) ? $_GET["desde"] : null;
    $hasta = isset($_GET["hasta"]) && !empty($_GET["hasta"]) ? $_GET["hasta"] : null;

    // Construir la condición de la consulta SQL para las fechas
    $w = "";
    if (!is_null($desde) && !is_null($hasta)) {
      $w = "AND m.fecha BETWEEN '$desde' AND '$hasta'";
    }

    // Consulta SQL para obtener los datos deseados
    $sql = "SELECT r.nomreg AS region, COALESCE(SUM(m.stock_epidemiologico), 0) AS cantidad
      FROM regiones r 
      INNER JOIN public.monitoreo m ON m.codreg = r.codreg AND m.subreg = r.subcreg 
      WHERE r.codreg <> '50' $w
      GROUP BY r.codreg, r.subcreg, r.nomreg
      ORDER BY r.codreg;";

    // Ejecutar la consulta
    $result = pg_query($conn, $sql);

    // Verificar si la consulta fue exitosa
    if ($result) {
      // Convertir el resultado a un arreglo asociativo
      $data = pg_fetch_all($result);

      // Si hay resultados, enviarlos como JSON
      if ($data) {
        print json_encode($data);
      } else {
        print json_encode(array("status" => "error", "message" => "No se encontraron datos para el código de región proporcionado"));
      }
    } else {
      print json_encode(array("status" => "error", "message" => "Error al ejecutar la consulta"));
    }
  } catch (Exception $e) {
    print json_encode(array("status" => "error", "message" => "Error en la ejecución de la consulta: " . $e->getMessage()));
  }
}else if (isset($_GET['accion']) && $_GET['accion'] == "reactivo_laboratorio") {
  try {
    // Obtener el valor del campo del formulario
    $codreg = 0;
    $desde = isset($_GET["desde"]) && !empty($_GET["desde"]) ? $_GET["desde"] : null;
    $hasta = isset($_GET["hasta"]) && !empty($_GET["hasta"]) ? $_GET["hasta"] : null;

    // Construir la condición de la consulta SQL para las fechas
    $w = "";
    if (!is_null($desde) && !is_null($hasta)) {
      $w = " WHERE fecha BETWEEN '$desde' AND '$hasta'";
    }

    // Consulta SQL para obtener los datos deseados
    $sql = "SELECT 
    CASE 
            WHEN l.laboratorio_simplificado ILIKE 'de %' THEN TRIM(SUBSTRING(l.laboratorio_simplificado FROM 4))
            ELSE l.laboratorio_simplificado 
        END AS laboratorio,
        l.cantidad
    FROM (
        SELECT 
            CASE 
                WHEN laboratorio ILIKE 'Laboratorio %' THEN TRIM(SUBSTRING(laboratorio FROM 12))
                ELSE laboratorio 
            END AS laboratorio_simplificado, 
            COALESCE(SUM(stock_epidemiologico), 0) AS cantidad
        FROM 
            monitoreo  $w
        GROUP BY 
            laboratorio_simplificado
    ) l;";

    // Ejecutar la consulta
    $result = pg_query($conn, $sql);

    // Verificar si la consulta fue exitosa
    if ($result) {
      // Convertir el resultado a un arreglo asociativo
      $data = pg_fetch_all($result);

      // Si hay resultados, enviarlos como JSON
      if ($data) {
        print json_encode($data);
      } else {
        print json_encode(array("status" => "error", "message" => "No se encontraron datos para el código de región proporcionado"));
      }
    } else {
      print json_encode(array("status" => "error", "message" => "Error al ejecutar la consulta"));
    }
  } catch (Exception $e) {
    print json_encode(array("status" => "error", "message" => "Error en la ejecución de la consulta: " . $e->getMessage()));
  }
}else if (isset($_GET['accion']) && $_GET['accion'] == "reactivo_semana") {
  try {
    // Obtener el valor del campo del formulario
    $codreg = 0;
    $desde = isset($_GET["desde"]) && !empty($_GET["desde"]) ? $_GET["desde"] : null;
    $hasta = isset($_GET["hasta"]) && !empty($_GET["hasta"]) ? $_GET["hasta"] : null;

    // Construir la condición de la consulta SQL para las fechas
    $w = "";
    if (!is_null($desde) && !is_null($hasta)) {
      $w = " WHERE fecha BETWEEN '$desde' AND '$hasta'";
    }

    // Consulta SQL para obtener los datos deseados
    $sql = "SELECT 
    CONCAT(s.numero_semana, ' - ', s.mes) AS semana,
    COALESCE(SUM(m.stock_epidemiologico), 0) AS cantidad
    FROM semana_epidemiologica s LEFT JOIN monitoreo m ON m.codsemana = s.codsemana
    GROUP BY s.numero_semana, s.mes ORDER BY s.numero_semana ASC";

    // Ejecutar la consulta
    $result = pg_query($conn, $sql);

    // Verificar si la consulta fue exitosa
    if ($result) {
      // Convertir el resultado a un arreglo asociativo
      $data = pg_fetch_all($result);

      // Si hay resultados, enviarlos como JSON
      if ($data) {
        print json_encode($data);
      } else {
        print json_encode(array("status" => "error", "message" => "No se encontraron datos para el código de región proporcionado"));
      }
    } else {
      print json_encode(array("status" => "error", "message" => "Error al ejecutar la consulta"));
    }
  } catch (Exception $e) {
    print json_encode(array("status" => "error", "message" => "Error en la ejecución de la consulta: " . $e->getMessage()));
  }
}else if (isset($_GET['accion']) && $_GET['accion'] == "paciente_tipo") {
  try {
    // Obtener el valor del campo del formulario
    $codreg = 0;
    $desde = isset($_GET["desde"]) && !empty($_GET["desde"]) ? $_GET["desde"] : null;
    $hasta = isset($_GET["hasta"]) && !empty($_GET["hasta"]) ? $_GET["hasta"] : null;

    // Construir la condición de la consulta SQL para las fechas
    $w = "";
    if (!is_null($desde) && !is_null($hasta)) {
      $w = " WHERE fecha BETWEEN '$desde' AND '$hasta'";
    }

    // Consulta SQL para obtener los datos deseados
    $sql = "SELECT 'Hospitalizado'::varchar as paciente, COALESCE(SUM(paciente_hospitalizado), 0) AS cantidad FROM monitoreo $w
    UNION ALL
    SELECT 'Obito'::varchar as paciente, COALESCE(SUM(paciente_obito), 0) AS cantidad FROM monitoreo  $w
    UNION ALL
    SELECT 'Ambulatoria'::varchar as paciente, COALESCE(SUM(paciente_ambulatoria), 0) AS cantidad FROM monitoreo $w

";

    // Ejecutar la consulta
    $result = pg_query($conn, $sql);

    // Verificar si la consulta fue exitosa
    if ($result) {
      // Convertir el resultado a un arreglo asociativo
      $data = pg_fetch_all($result);

      // Si hay resultados, enviarlos como JSON
      if ($data) {
        print json_encode($data);
      } else {
        print json_encode(array("status" => "error", "message" => "No se encontraron datos para el código de región proporcionado"));
      }
    } else {
      print json_encode(array("status" => "error", "message" => "Error al ejecutar la consulta"));
    }
  } catch (Exception $e) {
    print json_encode(array("status" => "error", "message" => "Error en la ejecución de la consulta: " . $e->getMessage()));
  }
}else {
  print json_encode(array("status" => "error", "message" => "Acción no válida"));
}
?>

