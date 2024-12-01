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
        $this->Cell(0, 10, "Reporte de Usuarios", 0, 1, 'C');
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, $this->convertxt("Página ") . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Función para obtener los usuarios desde la base de datos
function obtenerUsuarios() {
    $db = conectarDB(); // Establecer la conexión con la base de datos
    $sql = "SELECT id, nombre, apellido, email, rol FROM usuario"; // Consulta para obtener todos los usuarios
    $result = mysqli_query($db, $sql); // Ejecutar la consulta

    // Comprobar si la consulta devolvió resultados
    if ($result) {
        $usuarios = mysqli_fetch_all($result, MYSQLI_ASSOC); // Obtener los resultados como un array asociativo
        mysqli_free_result($result); // Liberar el resultado de la consulta
    } else {
        $usuarios = []; // Si no hay resultados, retornar un array vacío
    }
    mysqli_close($db); // Cerrar la conexión a la base de datos
    return $usuarios;
}

// Crear una nueva instancia del PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Cabecera de la tabla
$pdf->SetFont('Arial', 'B', 12);
$header = array($pdf->convertxt("ID"), $pdf->convertxt("Nombre"), $pdf->convertxt("Apellido"), $pdf->convertxt("Email"), $pdf->convertxt("Rol"));
$widths = array(15, 40, 40, 60, 25);

for ($i = 0; $i < count($header); $i++) {
    $pdf->Cell($widths[$i], 7, $header[$i], 1);
}
$pdf->Ln();

// Obtener los usuarios desde la base de datos
$usuarios = obtenerUsuarios();

// Cuerpo de la tabla con los datos de la base de datos
$pdf->SetFont('Arial', '', 10);
if (!empty($usuarios)) {
    foreach ($usuarios as $usuario) {
        $pdf->Cell($widths[0], 6, $pdf->convertxt($usuario['id']), 1);
        $pdf->Cell($widths[1], 6, $pdf->convertxt($usuario['nombre']), 1);
        $pdf->Cell($widths[2], 6, $pdf->convertxt($usuario['apellido']), 1);
        $pdf->Cell($widths[3], 6, $pdf->convertxt($usuario['email']), 1);
        $pdf->Cell($widths[4], 6, $pdf->convertxt($usuario['rol']), 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No hay usuarios disponibles', 0, 1, 'C');
}

// Generar el archivo PDF
$pdf->Output();
?>
