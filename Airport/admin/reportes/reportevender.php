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
        $this->Cell(0, 10, "Reporte de Ventas de Eventos", 0, 1, 'C');
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, $this->convertxt("Página ") . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Función para obtener los datos de la tabla `vender`
function obtenerVentas() {
    $db = conectarDB(); // Establecer la conexión con la base de datos
    $sql = "SELECT id, organizador, email, telefono, id_evento, evento_mensaje FROM vender"; // Consulta para obtener todos los registros
    $result = mysqli_query($db, $sql); // Ejecutar la consulta

    // Comprobar si la consulta devolvió resultados
    if ($result) {
        $ventas = mysqli_fetch_all($result, MYSQLI_ASSOC); // Obtener los resultados como un array asociativo
        mysqli_free_result($result); // Liberar el resultado de la consulta
    } else {
        $ventas = []; // Si no hay resultados, retornar un array vacío
    }
    mysqli_close($db); // Cerrar la conexión a la base de datos
    return $ventas;
}

// Crear una nueva instancia del PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Cabecera de la tabla
$pdf->SetFont('Arial', 'B', 12);
$header = array($pdf->convertxt("ID"), $pdf->convertxt("Organizador"), $pdf->convertxt("Email"), $pdf->convertxt("Teléfono"), $pdf->convertxt("ID Evento"), $pdf->convertxt("Mensaje"));
$widths = array(15, 40, 60, 30, 25, 50);

for ($i = 0; $i < count($header); $i++) {
    $pdf->Cell($widths[$i], 7, $header[$i], 1);
}
$pdf->Ln();

// Obtener los datos de las ventas desde la base de datos
$ventas = obtenerVentas();

// Cuerpo de la tabla con los datos de la base de datos
$pdf->SetFont('Arial', '', 10);
if (!empty($ventas)) {
    foreach ($ventas as $venta) {
        $pdf->Cell($widths[0], 6, $pdf->convertxt($venta['id']), 1);
        $pdf->Cell($widths[1], 6, $pdf->convertxt($venta['organizador']), 1);
        $pdf->Cell($widths[2], 6, $pdf->convertxt($venta['email']), 1);
        $pdf->Cell($widths[3], 6, $pdf->convertxt($venta['telefono']), 1);
        $pdf->Cell($widths[4], 6, $pdf->convertxt($venta['id_evento']), 1);
        $pdf->MultiCell($widths[5], 6, $pdf->convertxt($venta['evento_mensaje']), 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No hay ventas registradas', 0, 1, 'C');
}

// Generar el archivo PDF
$pdf->Output();
?>
