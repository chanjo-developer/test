<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
use Dompdf\Dompdf;
function pdf_create($html, $filename='', $stream=TRUE)
{
    require_once("dompdf/autoload.inc.php");

    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf");
    } else {
        return $dompdf->output();
    }
}
?>
