<?php
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
            /*
            foreach ($_POST as $key => $value) {
                $phpword->setValue('${'.$key.'}' , $value);
            }
            $phpword->saveAs('outputs/' . $template_name . '_' . time() . '.docx');
            */
            echo $template_name.'.docx';
        }else{
            echo 'file not exists';
        }
    } catch (Exception $e) {
        echo 'error : '.$e->getMessage();
    }
}
