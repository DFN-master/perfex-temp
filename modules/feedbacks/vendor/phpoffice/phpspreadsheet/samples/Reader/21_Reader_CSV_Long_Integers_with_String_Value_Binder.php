<?php

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;
use PhpOffice\PhpSpreadsheet\IOFactory;

require __DIR__ . '/../Header.php';

Cell::setValueBinder(new StringValueBinder());

$inputFileType = 'Csv';
$inputFileName = __DIR__ . '/sampleData/longIntegers.csv';

$reader = IOFactory::createReader($inputFileType);
$helper->log('Loading file ' . /** @scrutinizer ignore-type */ pathinfo($inputFileName, PATHINFO_BASENAME) . ' into WorkSheet #1 using IOFactory with a defined reader type of ' . $inputFileType);

$spreadsheet = $reader->load($inputFileName);
$spreadsheet->getActiveSheet()->setTitle(/** @scrutinizer ignore-type */ pathinfo($inputFileName, PATHINFO_BASENAME));

$helper->log($spreadsheet->getSheetCount() . ' worksheet' . (($spreadsheet->getSheetCount() == 1) ? '' : 's') . ' loaded');
$loadedSheetNames = $spreadsheet->getSheetNames();
foreach ($loadedSheetNames as $sheetIndex => $loadedSheetName) {
    $helper->log('<b>Worksheet #' . $sheetIndex . ' -> ' . $loadedSheetName . ' (Formatted)</b>');
    $spreadsheet->setActiveSheetIndexByName($loadedSheetName);

    $activeRange = $spreadsheet->getActiveSheet()->calculateWorksheetDataDimension();
    $sheetData = $spreadsheet->getActiveSheet()->rangeToArray($activeRange, null, true, true, true);
    $helper->displayGrid($sheetData);
}
