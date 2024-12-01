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
        $this->Cell(0, 10, "Reporte de Servicios", 0, 1, 'C');
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, $this->convertxt("Página ") . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Función para obtener los servicios desde la base de datos
function obtenerServicios() {
    $db = conectarDB(); // Establecer la conexión con la base de datos
    $sql = "SELECT id, servicios_adicionales, precio, caracteristicas, detalle FROM servicios"; // Consulta actualizada
    $result = mysqli_query($db, $sql); // Ejecutar la consulta

    // Comprobar si la consulta devolvió resultados
    if ($result) {
        $servicios = mysqli_fetch_all($result, MYSQLI_ASSOC); // Obtener los resultados como un array asociativo
        mysqli_free_result($result); // Liberar el resultado de la consulta
    } else {
        $servicios = []; // Si no hay resultados, retornar un array vacío
    }
    mysqli_close($db); // Cerrar la conexión a la base de datos
    return $servicios;
}

// Crear una nueva instancia del PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

// Obtener los servicios desde la base de datos
$servicios = obtenerServicios();

// Generar el reporte con el nuevo formato
if (!empty($servicios)) {
    foreach ($servicios as $servicio) {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 10, "ID: " . $pdf->convertxt($servicio['id']), 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, "Precio: $" . number_format($servicio['precio'], 2), 0, 1);
        $pdf->Cell(0, 10, "Servicios Adicionales: " . $pdf->convertxt($servicio['servicios_adicionales']), 0, 1);
        $pdf->Ln(2);
        $pdf->MultiCell(0, 10, "Características:\n" . $pdf->convertxt($servicio['caracteristicas']), 0, 'L');
        $pdf->Ln(2);
        $pdf->MultiCell(0, 10, "Detalle:\n" . $pdf->convertxt($servicio['detalle']), 0, 'L');
        $pdf->Ln(10); // Espaciado entre servicios
    }
} else {
    $pdf->Cell(0, 10, 'No hay servicios disponibles', 0, 1, 'C');
}

// Generar el archivo PDF
$pdf->Output();
?>
