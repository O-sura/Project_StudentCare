<?php

require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

function generateReport($report){

// instantiate and use the dompdf class
    $options = new Options;
    $dompdf = new Dompdf($options);

    $options->setIsRemoteEnabled(true);
    $options->set('isJavascriptEnabled', true);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    $dompdf->loadHtml($report);

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream("report.pdf");

    $output = $dompdf->output();
    $path = APPROOT. "/uploads/";
    file_put_contents($path .'file.pdf', $output);

}

?>