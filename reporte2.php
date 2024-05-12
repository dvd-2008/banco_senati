<?php
require('fpdf/fpdf.php');
require('conexion.php');

$v1 = $_POST['variable1'];

// Establecer la conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$query = "SELECT c.n_cuenta, c.nombre, c.apellido, c.dni FROM cliente c WHERE n_cuenta = $v1";
$resultado = mysqli_query($conn, $query);

if (!$resultado) {
    die("Error al ejecutar la consulta: " . mysqli_error($conn));
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,6,'',0,0,'C');
$pdf->Cell(100,6,'LISTA DE CLIENTES',1,0,'C');
$pdf->Ln(10);

$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,6,'N_cuenta',1,0,'C',1);
$pdf->Cell(40,6,'Nombre',1,0,'C',1);
$pdf->Cell(40,6,'Apellido',1,0,'C',1);
$pdf->Cell(40,6,'Dni',1,0,'C',1);
$pdf->Ln(10);

$pdf->SetFillColor(255,255,255);

while ($fila = mysqli_fetch_array($resultado)) {
    $n_cuenta = $fila['n_cuenta'];
    $nombre = $fila['nombre'];
    $apellido = $fila['apellido'];
    $dni = $fila['dni'];

    $pdf->Cell(40,6,$n_cuenta,1,0,'R',1);
    $pdf->Cell(40,6,$nombre,1,0,'R',1);
    $pdf->Cell(40,6,$apellido,1,0,'R',1);
    $pdf->Cell(40,6,$dni,1,0,'R',1);
    $pdf->Ln(5);
}

$pdf->Output();

mysqli_close($conn);
?>
