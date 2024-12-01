<?php
// Incluir la librería FPDF y la configuración de la base de datos
require_once('fpdf/fpdf.php');  // Ruta relativa para FPDF
require_once('../../includes/config/database.php');  // Ruta relativa para el archivo de base de datos

// Iniciar el buffer de salida para evitar errores de "Some data has already been output"
ob_start();

// Clase PDF personalizada
class PDF extends FPDF
{
    function convertxt($p_txt)
    {
        // Intentar convertir a ISO-8859-1, ignorando los caracteres ilegales
        return iconv('UTF-8', 'ISO-8859-1//IGNORE', $p_txt);
    }

    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, "Reporte de Atenciones", 0, 1, 'C');
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, $this->convertxt("Página ") . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Función para obtener las atenciones desde la base de datos
function obtenerAtenciones() {
    $db = conectarDB(); // Establecer la conexión con la base de datos
    $sql = "SELECT a.id, a.nombre, a.apellido, a.email, a.mensaje, a.captcha, e.titulo AS evento
            FROM atencion a
            LEFT JOIN evento e ON a.id_evento = e.id"; // Realizamos un JOIN con la tabla 'evento' para obtener el nombre del evento
    $result = mysqli_query($db, $sql); // Ejecutar la consulta

    if ($result) {
        $atenciones = mysqli_fetch_all($result, MYSQLI_ASSOC); // Obtener los resultados como un array asociativo
        mysqli_free_result($result); // Liberar el resultado de la consulta
    } else {
        $atenciones = []; // Si no hay resultados, retornar un array vacío
    }
    mysqli_close($db); // Cerrar la conexión a la base de datos
    return $atenciones;
}

// Crear una nueva instancia del PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Obtener las atenciones desde la base de datos
$atenciones = obtenerAtenciones();

// Cabecera de la tabla
$pdf->SetFont('Arial', 'B', 12);
$header = array($pdf->convertxt("ID"), $pdf->convertxt("Nombre"), $pdf->convertxt("Email"), $pdf->convertxt("Evento"), $pdf->convertxt("Mensaje"), $pdf->convertxt("Captcha"));
$widths = array(15, 45, 50, 40, 70, 30);

// Dibujar los encabezados de la tabla
for ($i = 0; $i < count($header); $i++) {
    $pdf->Cell($widths[$i], 7, $header[$i], 1, 0, 'C');
}
$pdf->Ln();

// Cuerpo de la tabla con los datos de las atenciones
$pdf->SetFont('Arial', '', 10);
if (!empty($atenciones)) {
    foreach ($atenciones as $atencion) {
        $pdf->Cell($widths[0], 6, $pdf->convertxt($atencion['id']), 1);
        $pdf->Cell($widths[1], 6, $pdf->convertxt($atencion['nombre'] . ' ' . $atencion['apellido']), 1);
        $pdf->Cell($widths[2], 6, $pdf->convertxt($atencion['email']), 1);
        $pdf->Cell($widths[3], 6, $pdf->convertxt($atencion['evento']), 1);
        $pdf->MultiCell($widths[4], 6, $pdf->convertxt($atencion['mensaje']), 1);
        $pdf->Cell($widths[5], 6, $pdf->convertxt($atencion['captcha']), 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No hay atenciones disponibles', 0, 1, 'C');
}

// Generar el archivo PDF
$pdf->Output();

// Limpiar el buffer de salida
ob_end_flush();
?>
