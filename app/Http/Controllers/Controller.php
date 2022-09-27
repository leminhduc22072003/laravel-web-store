<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use PHPExcel;
use PHPExcel_IOFactory;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function downloadExcel($sheetName, $exportFields, $data, $fileNameDownload = 'data.xlsx', $rowStart = 1, $specialData = []) {

        $excel = new PHPExcel();
        $excel->setActiveSheetIndex(0);
        $excel->getActiveSheet()->setTitle($sheetName);

        $arrayColumnsName = range('A', 'Z');
        $arrayColumnsName = array_merge($arrayColumnsName, ['AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ']);
        $columnNumber = 0;
        foreach ($exportFields as $title) {
            $columnName = $arrayColumnsName[$columnNumber];
            $excel->getActiveSheet()->setCellValue($columnName.$rowStart, $title);
            $excel->getActiveSheet()->getColumnDimension($columnName)->setWidth(15);
            $columnNumber++;
        }
        $excel->getActiveSheet()->getStyle('A1:'.$columnName.$rowStart)->getFont()->setBold(true);

        $row = $rowStart+1;
        foreach ($data as $item) {
            $columnNumber = 0;
            foreach ($exportFields as $field => $title) {
                $columnName = $arrayColumnsName[$columnNumber];
                $excel->getActiveSheet()->setCellValue($columnName.$row, $item[$field]);
                $columnNumber++;
            }
            $row++;
        }

        foreach ($specialData as $cell => $text) {
            $excel->getActiveSheet()->setCellValue($cell, $text);
        }

        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="'.$fileNameDownload.'"');
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
    }
}
