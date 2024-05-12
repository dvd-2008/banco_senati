<?php
require('/fpdf/fpdf.php');
require('conexion.php');

$query = "select * from cliente";
$resultado = mysql_query($query); 
 
//Instaciamos la clase para genrear el documento pdf
$pdf=new FPDF();
//Agregamos la primera pagina al documento pdf
$pdf->AddPage();
//Seteamos el inicio del margen superior en 25 pixeles
$y_axis_initial = 25;
//Seteamos el tipo de letra y creamos el titulo de la pagina. No es un encabezado no se repetira
$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,6,'',0,0,'C');
$pdf->Cell(100,6,'LISTA DE CLIENTES',1,0,'C');
$pdf->Ln(10);
//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,6,'N_cuenta',1,0,'C',1);
$pdf->Cell(40,6,'Nombre',1,0,'C',1);
$pdf->Cell(40,6,'Apellido',1,0,'C',1);
$pdf->Cell(40,6,'Dni',1,0,'C',1);
$pdf->Ln(10);
$pdf->SetFillColor(255,255,255);
//Comienzo a crear las fiulas de clientes según la consulta mysql
while($fila = mysql_fetch_array($resultado))
{
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
//Mostramos el documento pdf
$pdf->Output();
 
?>