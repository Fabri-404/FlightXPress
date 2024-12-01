<?php
// Incluir la librería FPDF y la configuración de la base de datos
require_once('fpdf/fpdf.php');  // Ruta relativa para FPDF
require_once('../../includes/config/database.php');  // Ruta relativa para el archivo de base de datos

// Clase PDF personalizada
class PDF extends FPDF
{
    function convertxt($p_txt)
    {
        return iconv('UTF-8', 'iso-8859-1', $p_txt);
    }

    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, "Reporte de Eventos", 0, 1, 'C');
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, $this->convertxt("Página ") . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Función para obtener los eventos desde la base de datos
function obtenerEventos() {
    $db = conectarDB(); // Establecer la conexión con la base de datos
    $sql = "SELECT * FROM evento"; // Consulta para obtener todos los eventos
    $result = mysqli_query($db, $sql); // Ejecutar la consulta

    // Comprobar si la consulta devolvió resultados
    if ($result) {
        $eventos = mysqli_fetch_all($result, MYSQLI_ASSOC); // Obtener los resultados como un array asociativo
        mysqli_free_result($result); // Liberar el resultado de la consulta
    } else {
        $eventos = []; // Si no hay resultados, retornar un array vacío
    }
    mysqli_close($db); // Cerrar la conexión a la base de datos
    return $eventos;
}

// Crear una nueva instancia del PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Cabecera de la tabla
$pdf->SetFont('Arial', 'B', 12);
$header = array($pdf->convertxt("ID"), $pdf->convertxt("Título"), $pdf->convertxt("Ubicación"), $pdf->convertxt("Fecha"), $pdf->convertxt("Hora"), $pdf->convertxt("Precio"));
$widths = array(10, 50, 50, 30, 30, 30);

for ($i = 0; $i < count($header); $i++) {
    $pdf->Cell($widths[$i], 7, $header[$i], 1);
}
$pdf->Ln();

// Obtener los eventos desde la base de datos
$eventos = obtenerEventos();

// Cuerpo de la tabla con los datos de la base de datos
$pdf->SetFont('Arial', '', 10);
if (!empty($eventos)) {
    foreach ($eventos as $evento) {
        $pdf->Cell($widths[0], 6, $pdf->convertxt($evento['id']), 1);
        $pdf->Cell($widths[1], 6, $pdf->convertxt($evento['titulo']), 1);
        $pdf->Cell($widths[2], 6, $pdf->convertxt($evento['ubicacion']), 1);
        $pdf->Cell($widths[3], 6, $pdf->convertxt($evento['fecha_evento']), 1);
        $pdf->Cell($widths[4], 6, $pdf->convertxt($evento['hora']), 1);
        $pdf->Cell($widths[5], 6, $pdf->convertxt(number_format($evento['precio'], 2)), 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No hay eventos disponibles', 0, 1, 'C');
}

// Generar el archivo PDF
$pdf->Output();
?>
