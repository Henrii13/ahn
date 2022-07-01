<?php
require('../assets/libreria/fpdf/fpdf.php');
function conn(){
	$host = 'localhost';
	$basededatos = 'ahn_db';
	$usuario = 'root';
	$contraseña = '';
	
	$conexion = new mysqli($host, $usuario,$contraseña, $basededatos);
	if ($conexion -> connect_errno)
	{
		die("Fallo la conexion:(".$conexion -> mysqli_connect_errno().")".$conexion-> mysqli_connect_error());
	}
	return $conexion;
}
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo

    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(75);
    // Título
    $this->Cell(30,10,'Reporte Usuario',0,0);
    $this->Image('../imagen/Arch.jpg',160,8,33);
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
session_start();
$Usuario=$_SESSION['Busqueda'];
$sql ="Select * from usuarios where user_cedula='$Usuario'";
$result = mysqli_query(conn(),$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
// Creación del objeto de la clase heredada
$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(0,10,utf8_decode('Cedula: '.$Usuario.' '),0,1);
$pdf->Cell(0,10,utf8_decode('Nombre: '.$row["user_nombre"].' '),0,1);
$pdf->Cell(0,10,utf8_decode('Apellido: '.$row["user_apellido"].' '),0,1);
$pdf->Cell(0,10,utf8_decode('Correo: '.$row["user_correo"].' '),0,1);
$pdf->Cell(0,10,utf8_decode('Teléfono: '.$row["user_telefono"].' '),0,1);
$pdf->Cell(0,10,utf8_decode('Genero: '.$row["user_genero"].' '),0,1);
$pdf->Cell(0,10,utf8_decode('Nacionalidad: '.$row["user_nacionalidad"].' '),0,1);
$pdf->Cell(75);
$pdf->Cell(30,10,'Documentos En Uso',0,0);
$sql="SELECT * FROM documento WHERE doc_cedula_pk = '$Usuario'";
$result = mysqli_query(conn(),$sql);
$header = array('Documento', 'Repositorio', 'Estanteria', 'Columna','Nivel','Fondo');
$pdf->Ln();
foreach($header as $col)
$pdf->Cell(30,7,$col,1);
$pdf->Ln();
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $pdf->Cell(30,6,$row["doc_id"],1);
    $pdf->Cell(30,6,$row["doc_est"],1);
    $pdf->Cell(30,6,$row["doc_estanteria"],1);
    $pdf->Cell(30,6,$row["doc_columna"],1);
    $pdf->Cell(30,6,$row["doc_nivel"],1);
    $pdf->Cell(30,6,$row["doc_fondo"],1);
    $pdf->Ln();
}
$pdf->Cell(85);
$pdf->Cell(30,10,'Historial',0,0);
$sql="SELECT * FROM historial WHERE user_cedula = '$Usuario'";
$result = mysqli_query(conn(),$sql);
$header = array('Historial','Caja', 'Fecha');
$pdf->Ln();
$pdf->Cell(47);
foreach($header as $col)
$pdf->Cell(30,7,$col,1);
$pdf->Ln();
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $pdf->Cell(47);
    $pdf->Cell(30,6,$row["hist_id"],1);
    $pdf->Cell(30,6,$row["hist_id"],1);
    $pdf->Cell(30,6,$row["doc_fecha"],1);
    $pdf->Ln();
}
$pdf->Output('D');
?>