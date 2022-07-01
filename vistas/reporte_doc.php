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
    $this->Cell(30,10,'Reporte Documentos',0,0);
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $busqueda = mysqli_real_escape_string(conn(), $_POST['Consulta']);
    $busqueda2 = mysqli_real_escape_string(conn(), $_POST['Consultas']);

}
// Creación del objeto de la clase heredada
$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(0,10,utf8_decode('Fecha Desde: '.$busqueda.' '),0,1);
$pdf->Cell(0,10,utf8_decode('Fecha Hasta: '.$busqueda2.' '),0,1);
$pdf->Cell(85);
$pdf->Cell(30,10,'Historial',0,0);
$sql="SELECT h.hist_id ,h.user_cedula ,h.doc_id,h.doc_fecha, d.doc_fondo, d.doc_seccion,d.doc_serie FROM historial h, documento d  WHERE h.doc_fecha BETWEEN '$busqueda' AND '$busqueda2' AND h.doc_id = d.doc_id ORDER BY h.hist_id  ";
$result = mysqli_query(conn(),$sql);
$header = array('Historial','Cedula Usuario','Caja', 'Fecha', 'Fondo', 'Seccion', 'Serie');
$pdf->Ln();

$pdf->Cell(15);
    $pdf->Cell(30,6,'Historial',1);
    $pdf->Cell(30,6,'Cedula Usuario',1);
    $pdf->Cell(15,6,'Caja',1);
    $pdf->Cell(30,6,'Fecha',1);
    $pdf->Cell(20,6,'Fondo',1);
    $pdf->Cell(20,6,'Seccion',1);
    $pdf->Cell(20,6,'Serie',1);
    $pdf->Ln();

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $pdf->Cell(15);
    $pdf->Cell(30,6,$row["hist_id"],1);
    $pdf->Cell(30,6,$row["user_cedula"],1);
    $pdf->Cell(15,6,$row["doc_id"],1);
    $pdf->Cell(30,6,$row["doc_fecha"],1);
    $pdf->Cell(20,6,$row["doc_fondo"],1);
    $pdf->Cell(20,6,$row["doc_seccion"],1);
    $pdf->Cell(20,6,$row["doc_serie"],1);
    $pdf->Ln();
}
$pdf->Output('D');
?>