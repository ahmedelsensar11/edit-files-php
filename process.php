<?php

echo 'works';
echo '<br>';


require 'vendor\autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

$template_name = "";
if (isset($_POST['template_name'])) {
    try {
        $template_name = (string)$_POST['template_name'];
        unset($_POST['template_name']);
        $file = 'templates/' . $template_name . '.docx';
        if (file_exists($file)) {
            $phpword = new TemplateProcessor($file);
            foreach ($_POST as $key => $value) {
                $phpword->setValue('${'.$key.'}' , $value);
            }
            $edited_file = 'outputs/' . $template_name . '_' . time() . '.docx';
            $phpword->saveAs($edited_file);
            //download file
            //downloadFile($edited_file);
            echo 'file downloaded';
        }else{
            echo 'file not exists';
        }
    } catch (Exception $e) {
        echo 'error : '.$e->getMessage();
    }
}
echo '<br>';
echo 'finish';

function downloadFile ($file){
    //$file = 'outputs/test.docx';
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }else{
        echo 'The file does not exist.';
    }
}