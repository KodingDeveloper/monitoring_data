<?php


namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class SharedStyle
{

    public function defaultStyle(): array
    {
        return  [
            "title" => array(
                'font' => array(
                    'bold' => true
                ),
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['argb' => '0097FC'],
                ],
            ),
            "header_table_one" => array(
                'alignment' => array(
                    'horizontal' => "center",
                    'vertical' => "center"
                ),
                'font' => array(
                    'bold' => true
                ),
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => '3FAF46'],
                ],
            ),
            "header_table_two" => array(
                'alignment' => array(
                    'wrap' => true,
                    'horizontal' => "center",
                    'vertical' => "center"
                ),
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['argb' => '0097FC'],
                ],
            ),
            "extra" => array(
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF3838'],
                ],
            ),
            "border_table" => array(
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
            ),
        ];
    }

}
