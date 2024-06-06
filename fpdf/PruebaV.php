<?php
/*
require '../config/config.php';
require '../config/database.php';
require 'fpdf.php';

$db = new Database();
$con = $db->conectar();

$id_transaccion = isset($_GET['id_transaccion']) ? $_GET['id_transaccion'] : '0';

if ($id_transaccion == '0') {
    die('Error al procesar la petición');
}

$sql = $con->prepare("SELECT id, fecha, email, total FROM compra WHERE id_transaccion=? AND estatus=? LIMIT 1");
$sql->execute([$id_transaccion, 'COMPLETED']);
$row = $sql->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die('Error al comprobar la compra');
}

$idCompra = $row['id'];
$total = $row['total'];
$fecha = $row['fecha'];

$sqlDet = $con->prepare("SELECT nombre, precio, cantidad FROM detalle_compra WHERE id_compra=?");
$sqlDet->execute([$idCompra]);

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('logo2.png', 160, 7, 40);
        $this->SetFont('Arial', 'B', 19);
        $this->Cell(5);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(30, 0, utf8_decode('Good Place'), 0, 1, 'C', 0);
        $this->Ln(3);
        $this->SetTextColor(103);

        $this->Cell(1);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(96, 10, utf8_decode("Brianna Denisse Medrano Castillo"), 0, 0, '', 0);
        $this->Ln(5);

        $this->Cell(1);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(59, 10, utf8_decode("Cel. 8714852903 "), 0, 0, '', 0);
        $this->Ln(5);

        $this->Cell(1);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(85, 10, utf8_decode("Email: brianna@himlaguna.com"), 0, 0, '', 0);
        $this->Ln(5);

        $this->Cell(1);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(85, 10, utf8_decode("Dirección: Torreon, Coahuila, Mexico."), 0, 0, '', 0);
        $this->Ln(10);

        $this->SetTextColor(0, 158, 255);
        $this->Cell(50);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(100, 20, utf8_decode("RESERVACION"), 0, 1, 'C', 0);
        $this->Ln(7);

        $this->SetFillColor(0, 158, 255);
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(163, 163, 163);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(90, 7, utf8_decode('Descripción'), 1, 0, 'C', 1);
        $this->Cell(50, 7, utf8_decode('Cantidad'), 1, 0, 'C', 1);
        $this->Cell(50, 7, utf8_decode('Precio'), 1, 1, 'C', 1);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');

        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $hoy = date('d/m/Y');
        $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163);

while ($row_det = $sqlDet->fetch(PDO::FETCH_ASSOC)) {
    $importe = $row_det['precio'] * $row_det['cantidad'];
    $pdf->Cell(90, 7, utf8_decode($row_det['nombre']), 1, 0, 'C', 0);
    $pdf->Cell(50, 7, utf8_decode($row_det['cantidad']), 1, 0, 'C', 0);
    $pdf->Cell(50, 7, '$' . number_format($importe, 2, '.', ','), 1, 1, 'C', 0);
}

$pdf->Output('D', 'ReciboCompra.pdf');
*/
?>
<?php

require '../config/config.php';
require '../config/database.php';
require 'fpdf.php';

$db = new Database();
$con = $db->conectar();

$id_transaccion = isset($_GET['id_transaccion']) ? $_GET['id_transaccion'] : '0';

if ($id_transaccion == '0') {
    die('Error al procesar la petición');
}

$sql = $con->prepare("SELECT id, fecha, email, total FROM compra WHERE id_transaccion=? AND estatus=? LIMIT 1");
$sql->execute([$id_transaccion, 'COMPLETED']);
$row = $sql->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die('Error al comprobar la compra');
}

$idCompra = $row['id'];
$total = $row['total'];
$fecha = $row['fecha'];

$sqlDet = $con->prepare("SELECT nombre, precio, cantidad FROM detalle_compra WHERE id_compra=?");
$sqlDet->execute([$idCompra]);

// Obtener las fechas de llegada y salida
$sqlFechas = $con->prepare("SELECT fecha_llegada, fecha_salida FROM fecha_detalle WHERE id_compra=? LIMIT 1");
$sqlFechas->execute([$idCompra]);
$rowFechas = $sqlFechas->fetch(PDO::FETCH_ASSOC);

$fechaLlegada = $rowFechas['fecha_llegada'];
$fechaSalida = $rowFechas['fecha_salida'];

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('logo2.png', 160, 7, 40);
        $this->SetFont('Arial', 'B', 19);
        $this->Cell(5);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(30, 0, utf8_decode('Good Place'), 0, 1, 'C', 0);
        $this->Ln(3);
        $this->SetTextColor(103);

        $this->Cell(1);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(96, 10, utf8_decode("Brianna Denisse Medrano Castillo"), 0, 0, '', 0);
        $this->Ln(5);

        $this->Cell(1);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(59, 10, utf8_decode("Cel. 8714852903 "), 0, 0, '', 0);
        $this->Ln(5);

        $this->Cell(1);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(85, 10, utf8_decode("Email: brianna@himlaguna.com"), 0, 0, '', 0);
        $this->Ln(5);

        $this->Cell(1);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(85, 10, utf8_decode("Dirección: Torreon, Coahuila, Mexico."), 0, 0, '', 0);
        $this->Ln(10);

        $this->SetTextColor(0, 158, 255);
        $this->Cell(50);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(100, 20, utf8_decode("RESERVACION"), 0, 1, 'C', 0);
        $this->Ln(7);

        $this->SetFillColor(0, 158, 255);
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(163, 163, 163);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(90, 7, utf8_decode('Descripción'), 1, 0, 'C', 1);
        $this->Cell(50, 7, utf8_decode('Cantidad'), 1, 0, 'C', 1);
        $this->Cell(50, 7, utf8_decode('Precio'), 1, 1, 'C', 1);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');

        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $hoy = date('d/m/Y');
        $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163);



while ($row_det = $sqlDet->fetch(PDO::FETCH_ASSOC)) {
    $importe = $row_det['precio'] * $row_det['cantidad'];
    $pdf->Cell(90, 7, utf8_decode($row_det['nombre']), 1, 0, 'C', 0);
    $pdf->Cell(50, 7, utf8_decode($row_det['cantidad']), 1, 0, 'C', 0);
    $pdf->Cell(50, 7, '$' . number_format($importe, 2, '.', ','), 1, 1, 'C', 0);
}

// Mostrar las fechas de llegada y salida
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, utf8_decode("Su fecha de llegada seria : " . $fechaLlegada), 0, 1, 'L');
$pdf->Cell(0, 10, utf8_decode("y su fecha de salida es: " . $fechaSalida), 0, 1, 'L');
$pdf->Cell(0, 10, utf8_decode("Ojo: el horario de entrada el primer dia seria a las 12pm y su hora de salida seria a las 12pm."), 0, 1, 'L');


$pdf->Output('D', 'ReciboCompra.pdf');

?>
