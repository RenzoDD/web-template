<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Implementation of PHP Excel
 */

require_once __DIR__."/PHPExcel/PHPExcel.php";

class Excel
{
    function __construct($table, $title, $autosize = false, $creator = "")
    {
        $objPHPExcel = new PHPExcel();

        // Propiedades del documento
        $objPHPExcel->getProperties()->setCreator($creator)->setTitle($title);

        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);            

        // Titulos de columna
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A1", "N");
        $l = 66;
        $keys = array_keys($table[0]);
        foreach ($keys as $key)
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue(chr($l++) . "1", $key);
    

        // Filas de datos
        $i = 2;
        foreach($table as $row)
        {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A" . $i, $i - 1);
            $l = 66;
            foreach ($keys as $key)
            {
                $cell = chr($l++) . $i;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cell, $row[$key]);
            }
            $i++;
        }

        // AutoSize
        if ($autosize)
        {
            $l = 65;
            foreach ($keys as $key)
                $objPHPExcel->getActiveSheet()->getColumnDimension(chr($l++))->setAutoSize(true);
        }
    
    
        $objPHPExcel->getActiveSheet()->setTitle($title);
        $objPHPExcel->setActiveSheetIndex(0);


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$title.'"');
        header('Cache-Control: max-age=0');
        
        header('Cache-Control: max-age=1');
        
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
}

?>