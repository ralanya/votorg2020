<?php
require_once '../resource/others/phpspreadsheet/vendor/autoload.php';
require "../config/Conexion.php";
$mesa=$_REQUEST["mesa"];
$sql_1="SELECT * FROM ie ";
$rspta_1 = mysqli_query($conexion,$sql_1);

$reg_1=$rspta_1->fetch_object();
$nombre=$reg_1->nombre;
$anio=$reg_1->anio;
$logo=$reg_1->logo;
$departamento=$reg_1->departamento;
$provincia=$reg_1->provincia;
$distrito=$reg_1->distrito;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\style\Alignment;
use PhpOffice\PhpSpreadsheet\style\Fill;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

$reader=IOFactory::createReader('Xlsx');

$spreadsheet=$reader->load("report_padron.xlsx");

$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(18);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);

$spreadsheet->getActiveSheet()->setCellValue('A2', $nombre);
$spreadsheet->getActiveSheet()->mergeCells("A2:F2");
$spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setSize(10);
$spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$spreadsheet->getActiveSheet()->setCellValue('A3', 'PADRON ELECTORAL');
$spreadsheet->getActiveSheet()->mergeCells("A3:F3");
$spreadsheet->getActiveSheet()->getStyle('A3')->getFont()->setSize(11);
$spreadsheet->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$spreadsheet->getActiveSheet()->setCellValue('C5', $mesa);
$spreadsheet->getActiveSheet()->setCellValue('C6', $departamento);
$spreadsheet->getActiveSheet()->setCellValue('E6', $provincia);
$spreadsheet->getActiveSheet()->setCellValue('C7', $distrito);


$sql="SELECT * FROM persona p where p.mesa='$mesa' order by p.grado asc ";
$rspta = mysqli_query($conexion,$sql);
$contentStartRow=1;
$currentContentRow=10;
while ($reg=mysqli_fetch_array($rspta)) {
$spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1,1);
$spreadsheet->getActiveSheet()
    ->setCellValue('A'.$currentContentRow,$contentStartRow)
    ->setCellValue('B'.$currentContentRow,$reg['dni'])
    ->setCellValue('C'.$currentContentRow,$reg['apellidos'])
    ->setCellValue('D'.$currentContentRow,$reg['nombre']);
$currentContentRow++;
$contentStartRow++;
}

$spreadsheet->getActiveSheet()->removeRow($currentContentRow,1);
$spreadsheet->getActiveSheet()->setTitle('DATA');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte_votos.xlsx"');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

