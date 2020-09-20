<?php

require 'html2pdf/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    ob_start();
    include '../form/preview.php';
    $content = ob_get_clean();

    $html2pdf = new Html2Pdf('P','A4','en', false, 'utf-8', array(20, 19, 23, 20));
    $html2pdf->setDefaultFont("trebucc");
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->output('cv.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
?>